<?php

namespace App\Livewire;

use App\Models\Customer;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithPagination;

class CustomerOrders extends Component
{
    use WithPagination;

    public function orderAgain($orderId)
    {
        $user = Auth::user();
        $customer = Customer::where('billing_email', $user->email)->first();
        
        if (!$customer) {
            $this->dispatch('order-again-error', message: 'Klant niet gevonden.');
            return;
        }

        $order = Order::where('id', $orderId)
            ->where('customer_id', $customer->id)
            ->with('items')
            ->first();

        if (!$order) {
            $this->dispatch('order-again-error', message: 'Bestelling niet gevonden.');
            return;
        }

        if ($order->items->isEmpty()) {
            $this->dispatch('order-again-error', message: 'Deze bestelling bevat geen producten.');
            return;
        }

        $cart = session()->get('cart', []);
        $addedCount = 0;
        $errors = [];

        foreach ($order->items as $item) {
            // Check if product still exists
            $product = Product::find($item->product_id);
            
            if (!$product) {
                $errors[] = "Product '{$item->product_name}' is niet meer beschikbaar.";
                continue;
            }

            if (!$product->is_published) {
                $errors[] = "Product '{$item->product_name}' is niet meer beschikbaar.";
                continue;
            }

            // Check stock
            if ($product->stock == 0) {
                $errors[] = "Product '{$item->product_name}' is niet op voorraad.";
                continue;
            }

            $quantity = $item->quantity;
            if ($quantity > $product->stock) {
                $quantity = $product->stock;
                $errors[] = "Product '{$item->product_name}' heeft onvoldoende voorraad. Er zijn {$product->stock} toegevoegd in plaats van {$item->quantity}.";
            }

            $cartKey = (string) $product->id;
            
            if (isset($cart[$cartKey])) {
                $currentQty = $cart[$cartKey]['quantity'];
                $newQty = $currentQty + $quantity;
                
                if ($newQty > $product->stock) {
                    $newQty = $product->stock;
                    $errors[] = "Product '{$item->product_name}' heeft onvoldoende voorraad. Maximum aantal toegevoegd.";
                }
                
                $cart[$cartKey]['quantity'] = $newQty;
            } else {
                $cart[$cartKey] = [
                    'product_id' => $product->id,
                    'name' => $product->title,
                    'price' => $product->price,
                    'image_1' => $product->image_1 ?? '',
                    'quantity' => $quantity,
                ];
            }
            
            $addedCount++;
        }

        session(['cart' => $cart]);
        
        $totalQuantity = collect($cart)->sum('quantity');
        $this->dispatch('cart-updated', totalQuantity: $totalQuantity);

        if ($addedCount > 0) {
            if (!empty($errors)) {
                $this->dispatch('order-again-warning', message: $addedCount . ' product(en) toegevoegd aan winkelwagen. ' . implode(' ', $errors));
            } else {
                $this->dispatch('order-again-success', message: $addedCount . ' product(en) toegevoegd aan winkelwagen!');
            }
        } else {
            $this->dispatch('order-again-error', message: 'Geen producten konden worden toegevoegd. ' . implode(' ', $errors));
        }
    }

    public function render()
    {
        $user = Auth::user();
        $customer = Customer::where('billing_email', $user->email)->first();
        
        if (!$customer) {
            $orders = Order::whereRaw('1=0')->paginate(10);
        } else {
            $orders = Order::where('customer_id', $customer->id)
                ->with(['items', 'customer'])
                ->orderBy('created_at', 'desc')
                ->paginate(10);
        }

        return view('livewire.customer-orders', [
            'orders' => $orders,
        ]);
    }
}

