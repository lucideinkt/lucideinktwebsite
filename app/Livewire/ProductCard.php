<?php

namespace App\Livewire;

use App\Models\Product;
use Livewire\Component;

class ProductCard extends Component
{
    public Product $product;
    public $quantity = 1;

    public function mount(Product $product)
    {
        $this->product = $product;
    }

    public function addToCart()
    {
        if ($this->product->stock == 0) {
            $this->dispatch('cart-error', message: 'Dit product is niet op voorraad.');
            return;
        }

        if ($this->quantity > $this->product->stock) {
            $this->dispatch('cart-error', message: 'Geen voldoende voorraad meer. Er zijn nog maar '.$this->product->stock.' op voorraad.');
            return;
        }

        $cart = session()->get('cart', []);
        $cartKey = (string) $this->product->id;
        $currentQty = isset($cart[$cartKey]) ? $cart[$cartKey]['quantity'] : 0;
        $newQty = $currentQty + $this->quantity;

        if ($newQty > $this->product->stock) {
            $this->dispatch('cart-error', message: 'Geen voldoende voorraad meer. Er zijn nog maar '.$this->product->stock.' op voorraad.');
            return;
        }

        if (isset($cart[$cartKey])) {
            $cart[$cartKey]['quantity'] = $newQty;
            $cart[$cartKey]['price'] = $this->product->price;
            $cart[$cartKey]['image_1'] = $this->product->image_1 ?? '';
            $cart[$cartKey]['name'] = $this->product->title;
        } else {
            $cart[$cartKey] = [
                'product_id' => $this->product->id,
                'name' => $this->product->title,
                'price' => $this->product->price,
                'image_1' => $this->product->image_1 ?? '',
                'quantity' => $this->quantity,
            ];
        }

        session(['cart' => $cart]);

        $totalQuantity = collect($cart)->sum('quantity');
        $subtotal = collect($cart)->sum(fn($item) => ($item['price'] ?? 0) * ($item['quantity'] ?? 0));

        // Dispatch browser events - Livewire v3 automatically creates browser events
        $this->dispatch('cart-updated', totalQuantity: $totalQuantity);
        $this->dispatch('cart-success',
            message: 'Product toegevoegd aan winkelwagen!',
            productName: $this->product->title,
            productImage: $this->imageUrl,
            productPrice: number_format($this->product->price, 2, ',', '.'),
            productSlug: $this->product->slug ?? '',
            cartCount: $totalQuantity,
            cartSubtotal: number_format($subtotal, 2, ',', '.'),
        );
    }

    public function getImageUrlProperty()
    {
        $image = $this->product->image_1;

        if (empty($image)) {
            return null;
        }

        if (str_starts_with($image, 'https://') || str_starts_with($image, 'http://')) {
            return $image;
        }

        if (str_starts_with($image, 'image/books/') || str_starts_with($image, 'images/books/')) {
            return asset($image);
        }

        return asset('storage/' . $image);
    }

    public function render()
    {
        return view('livewire.product-card');
    }
}

