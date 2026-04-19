<?php

use App\Http\Controllers\AudiobooksController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BookContentController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DiscountCodeController;
use App\Http\Controllers\MyOrderController;
use App\Http\Controllers\NewsletterAdminController;
use App\Http\Controllers\NewsletterCampaignController;
use App\Http\Controllers\NewsletterController;
use App\Http\Controllers\OnlineLezenController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\PickupLocationController;
use App\Http\Controllers\ProductCategoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProductCopyController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ShippingCostController;
use App\Http\Controllers\ShopController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

// Both admin and user can access
Route::middleware(['auth', 'role:admin,user'])->group(function () {

    // Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Profile
    Route::get('/dashboard/profile', [ProfileController::class, 'editPage'])->name('editProfile');
    Route::post('/dashboard/profile', [ProfileController::class, 'updateProfile'])->name('updateProfile');

    // My Orders
    Route::get('/dashboard/my-orders', [MyOrderController::class, 'showMyOrders'])->name('showMyOrders');
    Route::get('/dashboard/my-orders/{id}', [MyOrderController::class, 'showMyOrder'])->name('showMyOrder');
    Route::get('/dashboard/my-orders/{id}/invoice', [MyOrderController::class, 'download_invoice'])->name('my_orders.invoice');

});

// Only admin can access
Route::middleware(['auth', 'role:admin'])->group(function () {

    // Products
    Route::get('/dashboard/products', [ProductController::class, 'index'])->name('productIndex');
    Route::get('/dashboard/products/create', [ProductController::class, 'create'])->name('productCreatePage');
    Route::post('/dashboard/products/create', [ProductController::class, 'store'])->name('productStore');
    Route::get('/dashboard/products/edit/{id}', [ProductController::class, 'edit'])->name('productEditPage');
    Route::put('/dashboard/products/edit/{id}', [ProductController::class, 'update'])->name('productUpdate');
    Route::delete('/dashboard/products/delete/{id}', [ProductController::class, 'destroy'])->name('productDelete');
    Route::get('/dashboard/products/delete/{id}', [ProductController::class, 'get'])->name('productDelete_get');

    // Productcategories
    Route::get('/dashboard/productcategories', [ProductCategoryController::class, 'index'])->name('productCategoryIndex');
    Route::get('/dashboard/productcategories/create', [ProductCategoryController::class, 'create'])->name('productCategoryCreatePage');
    Route::post('/dashboard/productcategories/create', [ProductCategoryController::class, 'store'])->name('productCategoryStore');
    Route::get('/dashboard/productcategories/edit/{id}', [ProductCategoryController::class, 'edit'])->name('productCategoryEditPage');
    Route::put('/dashboard/productcategories/edit/{id}', [ProductCategoryController::class, 'update'])->name('productCategoryUpdate');
    Route::delete('/dashboard/productcategories/delete/{id}', [ProductCategoryController::class, 'destroy'])->name('productCategoryDelete');
    Route::get('/dashboard/productcategories/delete/{id}', [ProductCategoryController::class, 'get'])->name('productCategoryDeleteGet');

    // MyParcel: update package type
    Route::post('/dashboard/myparcel/shipments/update-package-type/{id}', [OrderController::class, 'orderUpdatePackageType'])->name('orderUpdatePackageType');
    // MyParcel: generate label
    Route::post('/dashboard/myparcel/shipments/generate-label/{id}', [OrderController::class, 'generateLabel'])->name('orderGenerateLabel');
    // Get and update MyParcel Shipments
    Route::get('/dashboard/myparcel/shipments/{shipmentID}', [OrderController::class, 'getSipmentDetails'])->name('getSipmentDetails');

    // Orders
    Route::get('/dashboard/orders/create', [OrderController::class, 'create'])->name('orderCreatePage');
    Route::get('/dashboard/orders', [OrderController::class, 'index'])->name('orderIndex');
    // Export orders
    Route::get('/dashboard/orders/export', [OrderController::class, 'exportOrders'])->name('exportOrders');
    Route::post('/dashboard/orders/create', [OrderController::class, 'store'])->name('orderStore');
    Route::put('/dashboard/orders/{id}', [OrderController::class, 'update'])->name('orderUpdate');
    Route::post('/dashboard/orders/generate-invoice/{id}', [OrderController::class, 'generateInvoice'])->name('generateInvoice');
    Route::post('/dashboard/orders/send-email/{id}', [OrderController::class, 'sendOrderEmailWithInvoice'])->name('sendOrderEmailWithInvoice');
    Route::get('/dashboard/orders/invoice/{id}', [OrderController::class, 'download_invoice'])->name('orders.invoice');
    Route::get('/dashboard/orders/{id}', [OrderController::class, 'show'])->name('orderShow');

    // Customers
    Route::get('/dashboard/customers', [CustomerController::class, 'index'])->name('customerIndex');
    Route::get('/dashboard/customers/{id}', [CustomerController::class, 'show'])->name('customerShow');

    // Users
    Route::get('/dashboard/users', [UserController::class, 'index'])->name('userIndex');
    Route::get('/dashboard/users/create', [UserController::class, 'create'])->name('userCreate');
    Route::post('/dashboard/users/create', [UserController::class, 'store'])->name('userStore');
    Route::get('/dashboard/users/{id}', [UserController::class, 'show'])->name('userShow');
    Route::put('/dashboard/users/{id}', [UserController::class, 'update'])->name('userEdit');

    // Discount codes
    Route::get('/dashboard/discount-codes', [DiscountCodeController::class, 'index'])->name('discountIndex');
    Route::get('/dashboard/discount-codes/create', [DiscountCodeController::class, 'create'])->name('discountCreate');
    Route::post('/dashboard/discount-codes/create', [DiscountCodeController::class, 'store'])->name('discountStore');
    Route::get('/dashboard/discount-codes/edit/{id}', [DiscountCodeController::class, 'edit'])->name('discountEdit');
    Route::put('/dashboard/discount-codes/edit/{id}', [DiscountCodeController::class, 'update'])->name('discountUpdate');
    Route::delete('/dashboard/discount-codes/delete/{id}', [DiscountCodeController::class, 'destroy'])->name('discountDelete');
    Route::get('/dashboard/discount-codes/delete/{id}', [DiscountCodeController::class, 'get'])->name('discountDelete_get');

    // Product copies
    Route::get('/dashboard/productcopies', [ProductCopyController::class, 'index'])->name('productCopyIndex');
    Route::get('/dashboard/productcopies/create', [ProductCopyController::class, 'create'])->name('productCopyCreatePage');
    Route::post('/dashboard/productcopies/create', [ProductCopyController::class, 'store'])->name('productCopyStore');
    Route::get('/dashboard/productcopies/edit/{id}', [ProductCopyController::class, 'edit'])->name('productCopyEditPage');
    Route::put('/dashboard/productcopies/edit/{id}', [ProductCopyController::class, 'update'])->name('productCopyUpdate');
    Route::delete('/dashboard/productcopies/delete/{id}', [ProductCopyController::class, 'destroy'])->name('productCopyDelete');
    Route::get('/dashboard/productcopies/delete/{id}', [ProductCopyController::class, 'get'])->name('productCopyDeleteGet');

    // Shipping costs
    Route::get('/dashboard/shippingcosts', [ShippingCostController::class, 'index'])->name('shippingCostIndex');
    Route::get('/dashboard/shippingcosts/create', [ShippingCostController::class, 'create'])->name('shippingCostCreatePage');
    Route::post('/dashboard/shippingcosts/create', [ShippingCostController::class, 'store'])->name('shippingCostStore');
    Route::get('/dashboard/shippingcosts/edit/{id}', [ShippingCostController::class, 'edit'])->name('shippingCostEditPage');
    Route::put('/dashboard/shippingcosts/edit/{id}', [ShippingCostController::class, 'update'])->name('shippingCostUpdate');
    Route::delete('/dashboard/shippingcosts/delete/{id}', [ShippingCostController::class, 'destroy'])->name('shippingCostDelete');
    Route::get('/dashboard/shippingcosts/delete/{id}', [ShippingCostController::class, 'get'])->name('shippingCostDeleteGet');

    // Newsletter subscribers - Full CRUD
    Route::get('/dashboard/newsletter', [NewsletterAdminController::class, 'index'])->name('admin.newsletter.index');
    Route::get('/dashboard/newsletter/create', [NewsletterAdminController::class, 'create'])->name('admin.newsletter.create');
    Route::post('/dashboard/newsletter', [NewsletterAdminController::class, 'store'])->name('admin.newsletter.store');
    Route::get('/dashboard/newsletter/{id}/edit', [NewsletterAdminController::class, 'edit'])->name('admin.newsletter.edit');
    Route::put('/dashboard/newsletter/{id}', [NewsletterAdminController::class, 'update'])->name('admin.newsletter.update');
    Route::post('/dashboard/newsletter/{id}/toggle', [NewsletterAdminController::class, 'toggleStatus'])->name('admin.newsletter.toggle');
    Route::delete('/dashboard/newsletter/{id}', [NewsletterAdminController::class, 'destroy'])->name('admin.newsletter.destroy');
    Route::post('/dashboard/newsletter/bulk-delete', [NewsletterAdminController::class, 'bulkDelete'])->name('admin.newsletter.bulkDelete');
    Route::get('/dashboard/newsletter/export', [NewsletterAdminController::class, 'export'])->name('admin.newsletter.export');

    // Newsletter campaigns
    Route::get('/dashboard/newsletter/campaigns', [NewsletterCampaignController::class, 'index'])->name('newsletter.campaigns.index');
    Route::get('/dashboard/newsletter/campaigns/create', [NewsletterCampaignController::class, 'create'])->name('newsletter.campaigns.create');
    Route::post('/dashboard/newsletter/campaigns', [NewsletterCampaignController::class, 'store'])->name('newsletter.campaigns.store');
    Route::get('/dashboard/newsletter/campaigns/{newsletter}', [NewsletterCampaignController::class, 'show'])->name('newsletter.campaigns.show');
    Route::get('/dashboard/newsletter/campaigns/{newsletter}/edit', [NewsletterCampaignController::class, 'edit'])->name('newsletter.campaigns.edit');
    Route::put('/dashboard/newsletter/campaigns/{newsletter}', [NewsletterCampaignController::class, 'update'])->name('newsletter.campaigns.update');
    Route::delete('/dashboard/newsletter/campaigns/{newsletter}', [NewsletterCampaignController::class, 'destroy'])->name('newsletter.campaigns.destroy');
    Route::post('/dashboard/newsletter/campaigns/{newsletter}/send', [NewsletterCampaignController::class, 'send'])->name('newsletter.campaigns.send');
    Route::post('/dashboard/newsletter/campaigns/{newsletter}/duplicate', [NewsletterCampaignController::class, 'duplicate'])->name('newsletter.campaigns.duplicate');
    Route::post('/dashboard/newsletter/campaigns/{newsletter}/resend', [NewsletterCampaignController::class, 'resend'])->name('newsletter.campaigns.resend');

    // Book Content (HTML boekinhoud — per pagina)
    Route::get('/dashboard/book-content',                          [BookContentController::class, 'index'])->name('bookContent.index');
    Route::get('/dashboard/book-content/{id}/edit',                [BookContentController::class, 'edit'])->name('bookContent.edit');
    Route::put('/dashboard/book-content/{id}',                     [BookContentController::class, 'update'])->name('bookContent.update');
    Route::post('/dashboard/book-content/{id}/pages',              [BookContentController::class, 'storePage'])->name('bookContent.storePage');
    Route::delete('/dashboard/book-content/{id}/pages/{pageId}',   [BookContentController::class, 'destroyPage'])->name('bookContent.destroyPage');
    Route::post('/dashboard/book-content/{id}/reorder',            [BookContentController::class, 'reorder'])->name('bookContent.reorder');

});

// Shop
Route::get('/winkel', [ShopController::class, 'index'])->name('shop');
Route::get('/winkel/product/{slug}', [ShopController::class, 'show'])->name('productShow');

// Cart
Route::get('/winkel/cart', [CartController::class, 'index'])->name('cartPage');
Route::post('/winkel/cart', [CartController::class, 'addToCart'])->name('addToCart');
Route::post('/winkel/cart/update', [CartController::class, 'updateCart'])->name('updateCart');
Route::post('/winkel/cart/remove', [CartController::class, 'removeCart'])->name('removeCart');
Route::delete('/winkel/cart/delete', [CartController::class, 'deleteItemFromCart'])->name('deleteItemFromCart');

// Checkout
Route::get('/winkel/checkout', [CheckoutController::class, 'create'])->name('checkoutPage');
Route::post('/winkel/checkout', [CheckoutController::class, 'store'])->name('storeCheckout');
Route::get('/winkel/checkout/success/{id?}', [CheckoutController::class, 'checkoutSuccess'])->name('checkoutSuccessPage');
Route::post('/winkel/checkout/apply-discount-code', [CheckoutController::class, 'applyDiscountCode'])->name('applyDiscountCode');
Route::delete('/winkel/checkout/remove-discount-code', [CheckoutController::class, 'removeDiscountCode'])->name('removeDiscountCode');

Route::get('/api/shipping-cost', [ShippingCostController::class, 'getCost']);

// Auth pages
Route::get('/login', [AuthController::class, 'loginPage'])->name('login')->middleware('guest');
Route::post('/login', [AuthController::class, 'loginUser'])->name('loginUser')->middleware(['guest', 'throttle:10,1']); // max 10 attempts per minute
Route::get('/logout', [AuthController::class, 'logoutGet'])->name('logout_get')->middleware('guest');
Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth')->name('logout');

// Forgot password
Route::get('/forgot-password', [AuthController::class, 'forgotPassword'])->name('password.request')->middleware('guest');
Route::post('/forgot-password', [AuthController::class, 'sendPasswordResetLink'])->name('password.email')->middleware(['guest', 'throttle:10,1']); // max 10 requests per minute
Route::get('/reset-password/{token}', [AuthController::class, 'resetPassword'])->name('password.reset')->middleware('guest');
Route::get('/reset-password', [AuthController::class, 'get'])->name('resetNoToken')->middleware('guest');
Route::post('/reset-password', [AuthController::class, 'resetPasswordHandler'])->name('password.update')->middleware(['guest', 'throttle:10,1']); // max 10 attempts per minute

// Newsletter
Route::post('/newsletter/subscribe', [NewsletterController::class, 'subscribe'])->name('newsletter.subscribe');
Route::get('/newsletter/unsubscribe/{token}', [NewsletterController::class, 'unsubscribe'])->name('newsletter.unsubscribe');

// Pages
Route::get('/', [PageController::class, 'home'])->name('home');
Route::get('/risale-i-nur', [PageController::class, 'risale'])->name('risale');
Route::get('/herzameling', [PageController::class, 'herzameling'])->name('herzameling');
Route::get('/said-nursi', [PageController::class, 'saidNursi'])->name('saidnursi');
Route::get('/contact', [PageController::class, 'contact'])->name('contact');
Route::get('/algemene-voorwaarden', function () {
    return view('algemene-voorwaarden');
})->name('algemeneVoorwaarden');
Route::get('/privacybeleid', function () {
    return view('privacybeleid');
})->name('privacybeleid');
Route::get('/retourbeleid', function () {
    return view('retourbeleid');
})->name('retourbeleid');
Route::get('/verzending-levering', function () {
    return view('verzending-levering');
})->name('verzendingLevering');

// Online Reading
Route::get('/bibliotheek', [OnlineLezenController::class, 'index'])->name('onlineLezen');
Route::get('/bibliotheek/{slug}/lees', [OnlineLezenController::class, 'readHtml'])->name('onlineLezenReadHtml');
Route::get('/bibliotheek/{slug}/paginas', [OnlineLezenController::class, 'pagesApi'])->name('onlineLezenPagesApi');
Route::get('/bibliotheek/{slug}/zoeken', [OnlineLezenController::class, 'searchApi'])->name('onlineLezenSearchApi');
Route::get('/bibliotheek/{slug}', [OnlineLezenController::class, 'read'])->name('onlineLezenRead');

// Audioboeken (Audiobooks)
Route::get('/audioboeken', [AudiobooksController::class, 'index'])->name('audiobooks');
Route::get('/audioboeken/{slug}', [AudiobooksController::class, 'listen'])->name('audiobooksListen');

// Audio streaming route (same method as PDF proxy - more reliable on Cloudways)
Route::get('/stream/audio/{path}', function ($path) {
    try {
        // Try multiple possible locations for the audio file
        $possiblePaths = [
            storage_path('app/public/audio/' . $path),
            storage_path('app/public/' . $path),
            public_path('storage/audio/' . $path),
            public_path('audio/' . $path),
        ];

        \Log::info('Audio stream request', [
            'requested_path' => $path,
            'trying_paths' => $possiblePaths,
        ]);

        $fullPath = null;
        $checkedPaths = [];

        foreach ($possiblePaths as $testPath) {
            $exists = file_exists($testPath);
            $isFile = $exists && is_file($testPath);
            $checkedPaths[] = [
                'path' => $testPath,
                'exists' => $exists,
                'is_file' => $isFile,
                'readable' => $exists && is_readable($testPath),
            ];

            if ($isFile) {
                $fullPath = $testPath;
                break;
            }
        }

        if (!$fullPath) {
            \Log::error('Audio file not found after checking all paths', [
                'requested_path' => $path,
                'checked_paths' => $checkedPaths,
            ]);
            abort(404, 'Audio file not found');
        }

        \Log::info('Audio file found', [
            'path' => $fullPath,
            'size' => filesize($fullPath),
        ]);

        // Detect mime type based on extension
        $extension = strtolower(pathinfo($fullPath, PATHINFO_EXTENSION));
        $mimeTypes = [
            'mp3' => 'audio/mpeg',
            'm4a' => 'audio/mp4',
            'ogg' => 'audio/ogg',
            'wav' => 'audio/wav',
        ];
        $mimeType = $mimeTypes[$extension] ?? 'audio/mpeg';

        // Use response()->file() like PDF proxy (more reliable than stream)
        return response()->file($fullPath, [
            'Content-Type' => $mimeType,
            'Accept-Ranges' => 'bytes',
            'Cache-Control' => 'public, max-age=31536000',
            'Access-Control-Allow-Origin' => '*',
            'Access-Control-Allow-Methods' => 'GET, OPTIONS',
            'Access-Control-Allow-Headers' => 'Range',
        ]);
    } catch (\Exception $e) {
        \Log::error('Audio stream exception', [
            'path' => $path,
            'error' => $e->getMessage(),
            'trace' => $e->getTraceAsString(),
        ]);
        abort(500, 'Error streaming audio: ' . $e->getMessage());
    }
})->where('path', '.*')->name('audio.stream');

// PDF Proxy for PDF.js viewer (with CORS headers)
Route::get('/pdf-proxy/{path}', function ($path) {
    $fullPath = storage_path('app/public/'.$path);

    if (! file_exists($fullPath)) {
        abort(404);
    }

    return response()->file($fullPath, [
        'Content-Type' => 'application/pdf',
        'Access-Control-Allow-Origin' => '*',
        'Access-Control-Allow-Methods' => 'GET, OPTIONS',
        'Access-Control-Allow-Headers' => 'Origin, X-Requested-With, Content-Type, Accept',
    ]);
})->where('path', '.*')->name('pdf.proxy');

// Audio Proxy (simpler route, like PDF proxy - most reliable)
Route::get('/audio-proxy/{path}', function ($path) {
    try {
        $fullPath = storage_path('app/public/audio/' . $path);

        \Log::info('Audio proxy request', [
            'requested_path' => $path,
            'full_path' => $fullPath,
            'exists' => file_exists($fullPath),
            'is_file' => file_exists($fullPath) && is_file($fullPath),
            'readable' => file_exists($fullPath) && is_readable($fullPath),
        ]);

        if (!file_exists($fullPath)) {
            \Log::error('Audio proxy: file not found', [
                'path' => $fullPath,
                'storage_path_base' => storage_path('app/public/audio/'),
            ]);
            abort(404, 'Audio file not found');
        }

        $extension = strtolower(pathinfo($fullPath, PATHINFO_EXTENSION));
        $mimeTypes = [
            'mp3' => 'audio/mpeg',
            'm4a' => 'audio/mp4',
            'ogg' => 'audio/ogg',
            'wav' => 'audio/wav',
        ];
        $mimeType = $mimeTypes[$extension] ?? 'audio/mpeg';

        return response()->file($fullPath, [
            'Content-Type' => $mimeType,
            'Access-Control-Allow-Origin' => '*',
            'Access-Control-Allow-Methods' => 'GET, OPTIONS',
            'Access-Control-Allow-Headers' => 'Range, Origin, X-Requested-With, Content-Type, Accept',
            'Accept-Ranges' => 'bytes',
        ]);
    } catch (\Exception $e) {
        \Log::error('Audio proxy exception', [
            'path' => $path,
            'error' => $e->getMessage(),
            'trace' => $e->getTraceAsString(),
        ]);
        abort(500, 'Error in audio proxy: ' . $e->getMessage());
    }
})->where('path', '.*')->name('audio.proxy');

// Dynamic robots.txt — blocks all crawlers outside production
Route::get('/robots.txt', function () {
    $isProduction = app()->environment('production');

    $content = $isProduction
        ? implode("\n", [
            'User-agent: *',
            'Disallow: /dashboard',
            'Disallow: /dashboard/',
            'Allow: /',
            '',
            'Sitemap: ' . url('/sitemap.xml'),
        ])
        : implode("\n", [
            '# Non-production environment — block all crawlers',
            'User-agent: *',
            'Disallow: /',
        ]);

    return response($content, 200)
        ->header('Content-Type', 'text/plain');
})->name('robots');

// Mollie payments
Route::get('/payment/success/', [CheckoutController::class, 'paymentSuccess'])->name('payment.success');
Route::post('/webhooks/mollie', [CheckoutController::class, 'paymentWebhook'])->name('webhooks.mollie');

// Admin/custom pickup locations API (used by admin order page custom widget)
Route::get('/pickup-locations', [PickupLocationController::class, 'index'])->name('pickup.locations');
