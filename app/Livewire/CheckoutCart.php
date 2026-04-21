<?php

namespace App\Livewire;

use App\Models\Product;
use Livewire\Component;

class CheckoutCart extends Component
{
    public array $items = [];
    public float $subtotal = 0;
    public int $totalQuantity = 0;
    public string $errorMessage = '';

    protected $listeners = ['cart-updated' => 'refreshCart'];

    public function mount(): void
    {
        $this->refreshCart();
    }

    public function refreshCart(): void
    {
        $cart = session()->get('cart', []);

        $this->items = [];
        $this->subtotal = 0;
        $this->totalQuantity = 0;

        foreach ($cart as $key => $item) {
            $price    = (float) ($item['price'] ?? 0);
            $quantity = (int)   ($item['quantity'] ?? 0);
            $lineTotal = $price * $quantity;

            $image = $item['image_1'] ?? '';
            if (!empty($image)) {
                if (!str_starts_with($image, 'http://') && !str_starts_with($image, 'https://')) {
                    if (str_starts_with($image, 'images/books/') || str_starts_with($image, 'image/books/')) {
                        $image = asset($image);
                    } else {
                        $image = asset('storage/' . $image);
                    }
                }
            }

            $this->items[] = [
                'product_id' => $item['product_id'] ?? $key,
                'name'       => $item['name'] ?? 'Onbekend product',
                'image'      => $image,
                'price'      => $price,
                'quantity'   => $quantity,
                'subtotal'   => $lineTotal,
                'slug'       => $item['slug'] ?? '',
            ];

            $this->subtotal      += $lineTotal;
            $this->totalQuantity += $quantity;
        }
    }

    public function increment(int $productId): void
    {
        $this->errorMessage = '';
        $cart = session()->get('cart', []);
        $cartKey = (string) $productId;

        if (isset($cart[$cartKey])) {
            $product = Product::find($productId);
            if ($product) {
                $newQty = $cart[$cartKey]['quantity'] + 1;
                if ($newQty > $product->stock) {
                    $this->errorMessage = 'Geen voldoende voorraad meer. Er zijn nog maar ' . $product->stock . ' op voorraad.';
                    return;
                }
                $cart[$cartKey]['quantity'] = $newQty;
                session(['cart' => $cart]);
                $this->dispatch('cart-updated', totalQuantity: collect($cart)->sum('quantity'));
                $this->refreshCart();
            }
        }
    }

    public function decrement(int $productId): void
    {
        $this->errorMessage = '';
        $cart = session()->get('cart', []);
        $cartKey = (string) $productId;

        if (isset($cart[$cartKey])) {
            $currentQty = $cart[$cartKey]['quantity'];
            if ($currentQty > 1) {
                $cart[$cartKey]['quantity'] = $currentQty - 1;
                session(['cart' => $cart]);
                $this->dispatch('cart-updated', totalQuantity: collect($cart)->sum('quantity'));
                $this->refreshCart();
            } else {
                $this->removeItem($productId);
            }
        }
    }

    public function removeItem(int $productId): void
    {
        $this->errorMessage = '';
        $cart = session()->get('cart', []);
        $cartKey = (string) $productId;

        if (isset($cart[$cartKey])) {
            unset($cart[$cartKey]);
            session(['cart' => $cart]);
        }

        $this->dispatch('cart-updated', totalQuantity: collect($cart)->sum('quantity'));
        $this->refreshCart();

        // If cart is now empty, redirect to shop
        if (empty($cart)) {
            $this->redirect(route('shop'));
        }
    }

    public function render()
    {
        return view('livewire.checkout-cart');
    }
}

