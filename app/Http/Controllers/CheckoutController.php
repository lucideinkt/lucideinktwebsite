<?php

namespace App\Http\Controllers;

use App\Mail\NewOrderMail;
use App\Mail\OrderPaidMail;
use App\Mail\WelcomeMail;
use Carbon\Carbon;
use App\Models\{Customer, DiscountCode, Order, Product, User};
use App\Services\MyParcelService;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\{DB, Hash, Log, Mail, Storage};
use Illuminate\Validation\ValidationException;
use Mollie\Api\MollieApiClient;

class CheckoutController extends Controller
{
    protected MollieApiClient $mollie;

    public function __construct()
    {
        $this->mollie = new MollieApiClient();
        $this->mollie->setApiKey(config('mollie.key'));
    }

    /* ------------------ Checkout Flow ------------------ */

    public function create()
    {
        $cart = session('cart', []);
        if (empty($cart)) {
            return redirect('/winkel')->with('error', 'Je winkelwagen is leeg.');
        }
        $totaalZonderVerzendkosten = collect($cart)->sum(fn($item) => $item['price'] * $item['quantity']);
        return view('checkout.index', compact('cart', 'totaalZonderVerzendkosten'));
    }

    public function store(Request $request)
    {
        $cart = session('cart', []);

        if (empty($cart)) {
            return redirect('/winkel')->with('error', 'Je winkelwagen is leeg.');
        }

        $this->normalizeCheckboxes($request);

        try {
            $this->validateCheckout($request);
            $this->validateShippingCostExists($request);
        } catch (ValidationException $e) {
            return redirect()->route('storeCheckout')
                ->withErrors($e->validator)
                ->withInput();
        }

        // Create or update user and customer
        $this->createUserIfNeeded($request);
        $customer = $this->createOrUpdateCustomer($request);

        // Calculate discount
        $discountData = $this->calculateDiscount($cart);

        // Create order with items
        $order = $this->createOrderWithItems($cart, $customer, $request, $discountData);

        // Setup MyParcel shipment
        $this->validateAndSaveMyParcel($order, $request);

        // Create Mollie payment
        return $this->createMolliePayment($order, $order->total);
    }

    public function paymentSuccess(Request $request)
    {
        $order = Order::find($request->query('order'));
        if (!$order) {
            return $this->checkoutError('Order niet gevonden.');
        }
        if (!$order->mollie_payment_id) {
            return $this->checkoutError('Geen betaling gevonden bij deze order.');
        }

        $payment = $this->mollie->payments->get($order->mollie_payment_id);

        if ($payment->isPaid()) {
            return $this->handlePaidOrder($order);
        }

        if ($payment->isOpen() || $payment->isPending()) {
            return $this->checkoutInfo('Je betaling is nog niet afgerond.');
        }

        $order->update(['status' => 'cancelled', 'payment_status' => 'failed']);
        return $this->checkoutError('Je betaling is mislukt of geannuleerd.');
    }

    public function checkoutSuccess($id = null)
    {
        // Try to get order ID from URL parameter first, then fallback to session
        $orderId = $id ?: session('checkout_success_order_id');

        if (!$orderId) {
            return redirect()->route('home');
        }

        $order = Order::with('items')->find($orderId);

        if (!$order) {
            return redirect()->route('home')->with('error', 'Order niet gevonden.');
        }

        $delivery = json_decode($order->myparcel_delivery_json, true);
        $pickupLocation = '';
        if (!empty($delivery['deliveryType']) && strtolower($delivery['deliveryType']) === 'pickup') {
            $pickupLocation = $delivery['pickup'] ?? $delivery['pickupLocation'] ?? null;
        }

        // Clear session data if it exists (for backward compatibility)
        session()->forget('checkout_success_order_id');

        return view('checkout.success',
            [
                'success' => true,
                'order' => $order,
                'pickupLocation' => $pickupLocation,
                'delivery' => $delivery
            ]);
    }

    public function paymentWebhook(Request $request)
    {
        $paymentId = $request->input('id');
        if (!$paymentId) {
            return response()->json(['error' => 'No payment id'], 400);
        }

        $payment = $this->mollie->payments->get($paymentId);
        $order = Order::find($payment->metadata->order_id ?? null);

        if ($order) {
            $this->updateOrderPaymentStatus($order, $payment);
        }

        return response()->json(['status' => 'ok']);
    }

    /* ------------------ Discount ------------------ */

    public function applyDiscountCode(Request $request)
    {
        $validated = $request->validate([
            'code' => 'required|string|max:255',
            'billing_email' => 'required|email|max:255',
        ]);
        $discount = DiscountCode::where('code', $validated['code'])->first();

        if (!$discount) {
            return response()->json(['success' => false, 'message' => 'Code bestaat niet.']);
        }

        // Check if code is published
        if ($discount->is_published === 0) {
            return response()->json(['success' => false, 'message' => 'Deze kortingscode is niet actief.']);
        }

        // Check expiration date
        if ($discount->expiration_date && Carbon::parse($discount->expiration_date)->lt(now()->startOfDay())) {
            return response()->json(['success' => false, 'message' => 'Deze kortingscode is verlopen.']);
        }

        // Check usage_limit (total times code can be used)
        $totalUsed = Order::where('discount_code_checkout', $discount->code)->count();
        if ($discount->usage_limit && $totalUsed >= $discount->usage_limit) {
            return response()->json(['success' => false, 'message' => 'Deze kortingscode is niet meer geldig.']);
        }

        // Check usage_limit_per_customer (per email)
        $customerUsed = Order::where('discount_code_checkout', $discount->code)
            ->whereHas('customer', function ($q) use ($validated) {
                $q->where('billing_email', $validated['billing_email']);
            })
            ->count();
        if ($discount->usage_limit_per_customer && $customerUsed >= $discount->usage_limit_per_customer) {
            return response()->json([
                'success' => false, 'message' => 'Je hebt deze kortingscode al te vaak gebruikt.'
            ]);
        }

        session(['discount_code' => $discount->code]);

        $cart = session('cart', []);
        $total = collect($cart)->sum(fn($item) => $item['price'] * $item['quantity']);
        $discountAmount = $discount->discount_type === 'percent'
            ? $total * ($discount->discount / 100)
            : $discount->discount;

        return response()->json([
            'success' => true,
            'discount' => $discount,
            'discount_amount' => round($discountAmount, 2),
            'total' => round($total, 2),
            'new_total' => max(0, round($total - $discountAmount, 2)),
        ]);
    }

    public function removeDiscountCode()
    {
        session()->forget('discount_code');
        $cart = session('cart', []);
        $total = collect($cart)->sum(fn($item) => $item['price'] * $item['quantity']);

        return response()->json([
            'success' => true,
            'discount_amount' => 0,
            'total' => round($total, 2),
            'new_total' => round($total, 2),
        ]);
    }

    /* ------------------ Private Helpers ------------------ */

    private function normalizeCheckboxes(Request $request): void
    {
        $request->merge(['alt-shipping' => $request->has('alt-shipping') ? 1 : 0]);
    }

    private function validateCheckout(Request $request): void
    {
        $request->validate([
            'billing_email' => 'required|email',
            'billing_first_name' => 'required|string',
            'billing_last_name' => 'required|string',
            'billing_street' => 'required|string',
            'billing_house_number' => 'required|numeric',
            'billing_house_number-add' => 'nullable|string',
            'billing_postal_code' => 'required|string',
            'billing_city' => 'required|string',
            'billing_country' => 'required|string',
            'order_note' => 'nullable|string|max:1000',
            'password' => 'nullable|string|min:8|confirmed',
            'shipping_first_name' => 'required_if:alt-shipping,1|string|nullable',
            'shipping_last_name' => 'required_if:alt-shipping,1|string|nullable',
            'shipping_street' => 'required_if:alt-shipping,1|string|nullable',
            'shipping_house_number' => 'required_if:alt-shipping,1|numeric|nullable',
            'shipping_house_number-add' => 'nullable|string',
            'shipping_postal_code' => 'required_if:alt-shipping,1|string|nullable',
            'shipping_city' => 'required_if:alt-shipping,1|string|nullable',
            'shipping_country' => 'required_if:alt-shipping,1|string|nullable',
        ], [
            'billing_email.required' => 'Het e-mailadres is verplicht.',
            'billing_email.email' => 'Voer een geldig e-mailadres in.',
            'billing_first_name.required' => 'De voornaam is verplicht.',
            'billing_last_name.required' => 'De achternaam is verplicht.',
            'billing_street.required' => 'De straat is verplicht.',
            'billing_house_number.required' => 'Het huisnummer is verplicht.',
            'billing_house_number.numeric' => 'Het huisnummer moet een getal zijn.',
            'billing_postal_code.required' => 'De postcode is verplicht.',
            'billing_city.required' => 'De plaats is verplicht.',
            'billing_country.required' => 'Het land is verplicht.',
            'password.min' => 'Het wachtwoord moet minimaal 8 tekens bevatten.',
            'password.confirmed' => 'De wachtwoorden komen niet overeen.',
            'shipping_first_name.required_if' => 'De voornaam is verplicht.',
            'shipping_last_name.required_if' => 'De achternaam is verplicht.',
            'shipping_street.required_if' => 'De straat is verplicht.',
            'shipping_house_number.required_if' => 'Het huisnummer is verplicht.',
            'shipping_house_number.numeric' => 'Het huisnummer moet een getal zijn.',
            'shipping_postal_code.required_if' => 'De postcode is verplicht.',
            'shipping_city.required_if' => 'De plaats is verplicht.',
            'shipping_country.required_if' => 'Het land is verplicht.',
        ]);
    }

    private function validateShippingCostExists(Request $request): void
    {
        $country = $request->boolean('alt-shipping')
            ? $request->input('shipping_country')
            : $request->input('billing_country');

        $shippingCost = \App\Models\ShippingCost::where('country', $country)
            ->where('is_published', 1)
            ->orderByDesc('amount')
            ->first();

        if (!$shippingCost) {
            $fieldName = $request->boolean('alt-shipping') ? 'shipping_country' : 'billing_country';
            throw ValidationException::withMessages([
                $fieldName => 'Geen verzendkosten beschikbaar voor het gekozen land.'
            ]);
        }
    }

    private function createUserIfNeeded(Request $request): ?User
    {
        if (User::where('email', $request->billing_email)->exists() || !$request->filled('password')) {
            return null;
        }

        $user = User::create([
            'first_name' => $request->billing_first_name,
            'last_name' => $request->billing_last_name,
            'email' => $request->billing_email,
            'password' => Hash::make($request->password),
        ]);

        event(new Registered($user));
        Mail::to($user->email)->queue(new WelcomeMail($user));

        return $user;
    }

    private function createOrUpdateCustomer(Request $request): Customer
    {
        return Customer::updateOrCreate(
            ['billing_email' => $request->billing_email],
            $request->only([
                'billing_first_name', 'billing_last_name', 'billing_email', 'billing_company',
                'billing_street', 'billing_house_number', 'billing_house_number-add',
                'billing_postal_code', 'billing_city', 'billing_country', 'billing_phone'
            ])
        );
    }

    private function calculateDiscount(array $cart): array
    {
        $totalBefore = collect($cart)->sum(fn($item) => $item['price'] * $item['quantity']);
        $discountCode = session('discount_code');

        $result = [
            'code' => null,
            'type' => null,
            'value' => 0,
            'amount' => 0,
            'total_before' => round($totalBefore, 2),
            'total_after' => round($totalBefore, 2),
        ];

        if (!$discountCode) {
            return $result;
        }

        $discount = DiscountCode::where('code', $discountCode)->first();

        if (!$discount) {
            return $result;
        }

        $result['code'] = $discount->code;
        $result['type'] = $discount->discount_type;
        $result['value'] = $discount->discount;

        $discountAmount = $discount->discount_type === 'percent'
            ? round($totalBefore * ($discount->discount / 100), 2)
            : round($discount->discount, 2);

        $discountAmount = min($discountAmount, $totalBefore);

        $result['amount'] = $discountAmount;
        $result['total_after'] = round($totalBefore - $discountAmount, 2);

        return $result;
    }

    private function createOrderWithItems(
        array $cart,
        Customer $customer,
        Request $request,
        array $discountData
    ): Order {
        return DB::transaction(function () use ($cart, $customer, $request, $discountData) {
            $shippingCountry = $this->getShippingCountry($request);
            $shippingCost = $this->findShippingCost($shippingCountry);

            $shippingAmount = $shippingCost?->amount ?? 0;
            $totalWithShipping = $discountData['total_after'] + $shippingAmount;

            $order = $customer->orders()->create([
                'total_before' => $discountData['total_before'],
                'total' => $totalWithShipping,
                'status' => 'pending',
                'shipping_first_name' => $this->getShippingField($request, 'first_name'),
                'shipping_last_name' => $this->getShippingField($request, 'last_name'),
                'shipping_company' => $this->getShippingField($request, 'company'),
                'shipping_street' => $this->getShippingField($request, 'street'),
                'shipping_house_number' => $this->getShippingField($request, 'house_number'),
                'shipping_postal_code' => $this->getShippingField($request, 'postal_code'),
                'shipping_city' => $this->getShippingField($request, 'city'),
                'shipping_country' => $shippingCountry,
                'discount_type' => $discountData['type'],
                'discount_value' => $discountData['value'],
                'discount_price_total' => $discountData['amount'],
                'total_after_discount' => $discountData['total_after'],
                'discount_code_checkout' => $discountData['code'],
                'shipping_cost_id' => $shippingCost?->id,
                'shipping_cost' => $shippingAmount,
                'shipping_cost_amount' => $shippingAmount,
                'total_with_shipping' => $totalWithShipping,
                'order_note' => $request->input('order_note'),
            ]);

            $this->createOrderItems($order, $cart);

            return $order;
        });
    }

    private function getShippingCountry(Request $request): string
    {
        return $request->boolean('alt-shipping')
            ? $request->input('shipping_country', 'NL')
            : $request->input('billing_country', 'NL');
    }

    private function findShippingCost(string $country)
    {
        return \App\Models\ShippingCost::where('country', $country)
            ->where('is_published', 1)
            ->orderByDesc('amount')
            ->first();
    }

    private function getShippingField(Request $request, string $field): ?string
    {
        $shippingField = "shipping_{$field}";
        $billingField = "billing_{$field}";

        return $request->boolean('alt-shipping')
            ? $request->input($shippingField)
            : $request->input($billingField);
    }

    private function createOrderItems(Order $order, array $cart): void
    {
        foreach ($cart as $item) {
            $product = Product::lockForUpdate()->find($item['product_id']);

            if (!$product || $product->stock < $item['quantity']) {
                throw ValidationException::withMessages([
                    'stock' => "Niet voldoende voorraad voor {$item['name']}"
                ]);
            }

            $product->decrement('stock', $item['quantity']);

            $order->items()->create([
                'product_id' => $product->id,
                'product_name' => $item['name'],
                'product_copy_id' => $item['product_copy_id'] ?? null,
                'quantity' => $item['quantity'],
                'unit_price' => $item['price'],
                'subtotal' => $item['price'] * $item['quantity'],
            ]);
        }
    }

    private function validateAndSaveMyParcel(Order $order, Request $request): void
    {
        $deliveryJson = $request->input('myparcel_delivery_options');

        if (!$deliveryJson) {
            throw ValidationException::withMessages([
                'myparcel_delivery_options' => 'Kies een bezorgoptie voordat je de bestelling plaatst.'
            ]);
        }

        $delivery = json_decode($deliveryJson, true) ?? [];
        $isPickup = strtolower($delivery['deliveryType'] ?? '') === 'pickup';

        if ($isPickup && empty($delivery['pickup'] ?? $delivery['pickupLocation'])) {
            throw ValidationException::withMessages([
                'myparcel_delivery_options' => 'Kies eerst een volledig afhaalpunt.'
            ]);
        }

        $address = $this->buildShipmentAddress($order);

        $this->saveDeliveryOptions($order, $deliveryJson, $delivery, $isPickup);

        $this->createMyParcelShipment($order, $address, $delivery, $isPickup);
    }

    private function buildShipmentAddress(Order $order): array
    {
        return [
            'cc' => $order->shipping_country ?? $order->customer->billing_country,
            'city' => $order->shipping_city ?? $order->customer->billing_city,
            'postalCode' => strtoupper(preg_replace('/\s+/', '',
                $order->shipping_postal_code ?? $order->customer->billing_postal_code)),
            'street' => $order->shipping_street ?? $order->customer->billing_street,
            'number' => $order->shipping_house_number ?? $order->customer->billing_house_number,
            'addition' => $order->shipping_house_number_addition ?? $order->customer->{'billing_house_number-add'} ?? '',
            'name' => trim(($order->shipping_first_name ?? $order->customer->billing_first_name) . ' ' .
                ($order->shipping_last_name ?? $order->customer->billing_last_name)),
            'company' => $order->shipping_company ?? $order->customer->billing_company,
            'email' => $order->customer->billing_email,
            'phone' => $order->shipping_phone ?? $order->customer->billing_phone,
        ];
    }

    private function saveDeliveryOptions(Order $order, string $deliveryJson, array $delivery, bool $isPickup): void
    {
        $order->update([
            'myparcel_delivery_json' => $deliveryJson,
            'myparcel_is_pickup' => $isPickup,
            'myparcel_carrier' => $delivery['carrier'] ?? 'postnl',
            'myparcel_delivery_type' => $delivery['deliveryType'] ?? null,
            'myparcel_package_type_id' => $this->mapPackageTypeId($delivery['packageType'] ?? null),
        ]);
    }

    private function createMyParcelShipment(Order $order, array $address, array $delivery, bool $isPickup): void
    {
        Log::debug('MyParcel address debug', [
            'postal' => $address['postalCode'],
            'cc' => $address['cc'],
            'street' => $address['street'],
            'number' => $address['number'],
        ]);

        try {
            $result = app(MyParcelService::class)->createShipment([
                'order_id' => $order->id,
                'reference' => 'order-' . $order->id,
                'carrier' => $order->myparcel_carrier ?? 'postnl',
                'address' => $address,
                'delivery' => [
                    'packageTypeId' => $order->myparcel_package_type_id ?: 1,
                    'deliveryType' => $delivery['deliveryType'] ?? 'standard',
                    'is_pickup' => $isPickup,
                    'pickup' => $delivery['pickup'] ?? $delivery['pickupLocation'] ?? null,
                    'onlyRecipient' => (bool) data_get($delivery, 'shipmentOptions.onlyRecipient'),
                    'signature' => (bool) data_get($delivery, 'shipmentOptions.signature'),
                    'insurance' => data_get($delivery, 'shipmentOptions.insurance'),
                ],
            ]);

            if (empty($result['consignment_id'])) {
                Log::error('MyParcel consignment_id missing', [
                    'order' => $order->id,
                    'result' => $result
                ]);
                throw ValidationException::withMessages([
                    'myparcel_delivery_options' => 'Verzending aanmaken bij MyParcel is mislukt. Probeer het opnieuw.'
                ]);
            }

            $order->update([
                'myparcel_consignment_id' => $result['consignment_id'],
                'myparcel_track_trace_url' => $result['track_trace_url'] ?? null,
                'myparcel_label_link' => $result['label_link'] ?? null,
            ]);
        } catch (\Throwable $e) {
            Log::error('Checkout MyParcel shipment create failed', [
                'order' => $order->id,
                'error' => $e->getMessage(),
            ]);
            // Re-throw ValidationException, but catch other exceptions
            if ($e instanceof ValidationException) {
                throw $e;
            }
        }
    }


    private function createMolliePayment(Order $order, float $amount)
    {
        $amount = max(0, $amount);

        // Handle free orders (no payment needed)
        if ($amount <= 0) {
            $order->update([
                'status' => 'completed',
                'payment_status' => 'paid',
                'paid_at' => now()
            ]);
            session()->forget(['cart', 'discount_code']);
            return redirect()->route('checkoutSuccessPage', ['id' => $order->id]);
        }

        try {
            $payment = $this->mollie->payments->create([
                'amount' => [
                    'currency' => 'EUR',
                    'value' => number_format($amount, 2, '.', '')
                ],
                'description' => "Bestelling #{$order->id}",
                'redirectUrl' => route('payment.success', ['order' => $order->id]),
                'webhookUrl' => config('app.webhook_url'),
                'metadata' => ['order_id' => $order->id],
            ]);

            $order->update(['mollie_payment_id' => $payment->id]);
            session()->forget(['cart', 'discount_code']);

            return redirect($payment->getCheckoutUrl(), 303);
        } catch (\Throwable $e) {
            Log::error('Mollie payment creation failed', [
                'order_id' => $order->id,
                'amount' => $amount,
                'error' => $e->getMessage(),
            ]);

            return redirect()->route('storeCheckout')
                ->withErrors(['payment' => 'Er is een fout opgetreden bij het aanmaken van de betaling. Probeer het opnieuw.'])
                ->withInput();
        }
    }

    private function handlePaidOrder(Order $order)
    {
        // Check if order was already paid to avoid duplicate processing
        $wasAlreadyPaid = $order->payment_status === 'paid';

        $order->update(['status' => 'completed', 'payment_status' => 'paid', 'paid_at' => now()]);

        // Only generate invoice and send emails for newly paid orders
        if (!$wasAlreadyPaid) {
            $this->generateInvoiceAndSendEmails($order);
        }

        session()->forget('cart');

        return redirect()->route('checkoutSuccessPage', ['id' => $order->id]);
    }

    private function generateInvoiceAndSendEmails(Order $order): void
    {
        $this->generateInvoicePdf($order);
        $this->sendCustomerEmail($order);
        $this->sendAdminEmail($order);

        $order->update(['customer_email_sent_at' => now()]);
    }

    private function generateInvoicePdf(Order $order): void
    {
        $pdf = Pdf::loadView('invoices.order', ['order' => $order])->output();
        $path = 'invoices/factuur_' . $order->id . '.pdf';
        Storage::disk('public')->put($path, $pdf);
        $order->forceFill(['invoice_pdf_path' => $path])->save();
    }

    private function sendCustomerEmail(Order $order): void
    {
        try {
            Mail::to($order->customer->billing_email)->queue(new OrderPaidMail($order->fresh()));
        } catch (\Throwable $e) {
            Log::error('Failed to queue OrderPaidMail to customer', [
                'order_id' => $order->id,
                'customer_email' => $order->customer->billing_email,
                'error' => $e->getMessage(),
            ]);
        }
    }

    private function sendAdminEmail(Order $order): void
    {
        $adminEmail = env('LUCIDE_INKT_MAIL');

        if (!$adminEmail) {
            Log::warning('Admin email not configured (LUCIDE_INKT_MAIL missing)', [
                'order_id' => $order->id
            ]);
            return;
        }

        try {
            Mail::to($adminEmail)->queue(new NewOrderMail($order->fresh()));
        } catch (\Throwable $e) {
            Log::error('Failed to queue NewOrderMail to admin', [
                'order_id' => $order->id,
                'admin_email' => $adminEmail,
                'error' => $e->getMessage(),
            ]);
        }
    }

    private function updateOrderPaymentStatus(Order $order, $payment): void
    {
        if ($payment->isPaid()) {
            $order->update(['status' => 'completed', 'payment_status' => 'paid', 'paid_at' => now()]);
        } elseif ($payment->isOpen() || $payment->isPending()) {
            $order->update(['status' => 'pending', 'payment_status' => 'pending']);
        } elseif ($payment->isFailed() || $payment->isExpired() || $payment->isCanceled()) {
            $order->update(['status' => 'cancelled', 'payment_status' => 'failed']);
        } elseif ($payment->status === 'refunded') {
            $order->update(['status' => 'cancelled', 'payment_status' => 'refunded']);
        }
    }

    private function checkoutError(string $msg)
    {
        return view('checkout.success', ['error' => $msg, 'success' => null, 'info' => null]);
    }

    private function checkoutInfo(string $msg)
    {
        return view('checkout.success', ['info' => $msg, 'success' => null, 'error' => null]);
    }

    private function mapPackageTypeId(?string $name): int
    {
        return [
            'package' => 1,
            'mailbox' => 2,
            'letter' => 3,
            'digital_stamp' => 4,
        ][$name] ?? 1;
    }
}
