<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Product;

class MiniCart extends Component
{
    public array $items = [];
    public float $subtotal = 0;
    public int $totalQuantity = 0;

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

    public function removeItem(int $productId): void
    {
        $cart = session()->get('cart', []);
        $cartKey = (string) $productId;
        if (isset($cart[$cartKey])) {
            unset($cart[$cartKey]);
            session(['cart' => $cart]);
        }
        $totalQuantity = collect($cart)->sum('quantity');
        $this->dispatch('cart-updated', totalQuantity: $totalQuantity);
        $this->refreshCart();
    }

    public function updateQuantity(int $productId, int $quantity): void
    {
        if ($quantity < 1) {
            $this->removeItem($productId);
            return;
        }
        $cart = session()->get('cart', []);
        $cartKey = (string) $productId;
        if (isset($cart[$cartKey])) {
            $cart[$cartKey]['quantity'] = min($quantity, 10);
            session(['cart' => $cart]);
        }
        $totalQuantity = collect($cart)->sum('quantity');
        $this->dispatch('cart-updated', totalQuantity: $totalQuantity);
        $this->refreshCart();
    }

    public function clearCart(): void
    {
        session()->forget('cart');
        $this->dispatch('cart-updated', totalQuantity: 0);
        $this->refreshCart();
    }

    public function render()
    {
        return view('livewire.mini-cart');
    }
}

