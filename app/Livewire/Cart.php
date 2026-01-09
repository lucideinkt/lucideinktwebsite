<?php

namespace App\Livewire;

use App\Models\Product;
use Livewire\Component;

class Cart extends Component
{
    public $quantities = [];

    public function mount()
    {
        $cart = session()->get('cart', []);
        foreach ($cart as $key => $item) {
            if (isset($item['product_id'])) {
                $this->quantities[$item['product_id']] = $item['quantity'];
            }
        }
    }

    public function increment($productId)
    {
        $cart = session()->get('cart', []);
        $cartKey = (string) $productId;
        
        if (isset($cart[$cartKey])) {
            $product = Product::find($productId);
            if ($product) {
                $newQty = ($this->quantities[$productId] ?? 0) + 1;
                if ($newQty > $product->stock) {
                    $this->dispatch('cart-error', message: 'Geen voldoende voorraad meer. Er zijn nog maar '.$product->stock.' op voorraad.');
                    return;
                }
                $this->quantities[$productId] = $newQty;
                $cart[$cartKey]['quantity'] = $newQty;
                session(['cart' => $cart]);
                $totalQuantity = collect($cart)->sum('quantity');
                $this->dispatch('cart-updated', totalQuantity: $totalQuantity);
            }
        }
    }

    public function decrement($productId)
    {
        $cart = session()->get('cart', []);
        $cartKey = (string) $productId;
        
        if (isset($cart[$cartKey])) {
            $currentQty = $this->quantities[$productId] ?? 0;
            if ($currentQty > 1) {
                $this->quantities[$productId] = $currentQty - 1;
                $cart[$cartKey]['quantity'] = $this->quantities[$productId];
                session(['cart' => $cart]);
                $totalQuantity = collect($cart)->sum('quantity');
                $this->dispatch('cart-updated', totalQuantity: $totalQuantity);
            }
        }
    }

    public function updateQuantity($productId, $quantity)
    {
        $cart = session()->get('cart', []);
        $cartKey = (string) $productId;
        
        if (isset($cart[$cartKey])) {
            $product = Product::find($productId);
            if ($product) {
                $quantity = (int) $quantity;
                if ($quantity <= 0) {
                    $this->removeItem($productId);
                    return;
                }
                if ($quantity > $product->stock) {
                    $this->dispatch('cart-error', message: 'Geen voldoende voorraad meer. Er zijn nog maar '.$product->stock.' op voorraad.');
                    $this->quantities[$productId] = $cart[$cartKey]['quantity'];
                    return;
                }
                $this->quantities[$productId] = $quantity;
                $cart[$cartKey]['quantity'] = $quantity;
                session(['cart' => $cart]);
                $totalQuantity = collect($cart)->sum('quantity');
                $this->dispatch('cart-updated', totalQuantity: $totalQuantity);
            }
        }
    }

    public function removeItem($productId)
    {
        $cart = session()->get('cart', []);
        $cartKey = (string) $productId;
        
        if (isset($cart[$cartKey])) {
            unset($cart[$cartKey]);
            unset($this->quantities[$productId]);
            session(['cart' => $cart]);
            $totalQuantity = collect($cart)->sum('quantity');
            $this->dispatch('cart-updated', totalQuantity: $totalQuantity);
        }
    }

    public function clearCart()
    {
        session()->forget('cart');
        $this->quantities = [];
        $this->dispatch('cart-updated', totalQuantity: 0);
    }

    public function render()
    {
        $cart = session()->get('cart', []);
        
        // Normalize cart
        $normalized = [];
        foreach ($cart as $key => $item) {
            if (!empty($item['product_id'])) {
                $pid = (string) $item['product_id'];
                if (isset($normalized[$pid])) {
                    $normalized[$pid]['quantity'] = ($normalized[$pid]['quantity'] ?? 0) + ($item['quantity'] ?? 0);
                } else {
                    $normalized[$pid] = $item;
                }
            }
        }
        $cart = $normalized;

        // Sync with database and update prices
        $changed = false;
        foreach ($cart as $key => $item) {
            if (!empty($item['product_id'])) {
                $p = Product::find($item['product_id']);
                if ($p) {
                    $newPrice = $p->price;
                    if (!isset($item['price']) || $item['price'] != $newPrice) {
                        $cart[$key]['price'] = $newPrice;
                        $changed = true;
                    }
                    $cart[$key]['name'] = $p->title;
                    $cart[$key]['image_1'] = $p->image_1 ?? $cart[$key]['image_1'] ?? '';
                    $cart[$key]['slug'] = $p->slug ?? null;
                }
            }
        }
        if ($changed) {
            session(['cart' => $cart]);
        }

        // Calculate total
        $total = 0;
        foreach ($cart as $item) {
            $total += ($item['price'] ?? 0) * ($item['quantity'] ?? 0);
        }

        return view('livewire.cart', [
            'cart' => $cart,
            'total' => $total,
        ]);
    }
}

