<?php

namespace App\Livewire;

use App\Models\Product;
use Livewire\Component;

class ProductDetail extends Component
{
    public Product $product;
    public $quantity = 1;
    public $productImages = [];

    public function mount(Product $product)
    {
        $this->product = $product;
        $this->loadProductImages();
    }

    protected function loadProductImages()
    {
        $this->productImages = [];
        for ($i = 1; $i <= 4; $i++) {
            $field = 'image_' . $i;
            if (!empty($this->product->$field)) {
                $image = $this->product->$field;
                if (str_starts_with($image, 'http://') || str_starts_with($image, 'https://')) {
                    $this->productImages[] = $image;
                } elseif (str_starts_with($image, 'image/books/') || str_starts_with($image, 'images/books/')) {
                    $this->productImages[] = asset($image);
                } else {
                    $this->productImages[] = asset('storage/' . $image);
                }
            }
        }
    }

    public function addToCart()
    {
        // Validate quantity
        if ($this->quantity < 1 || $this->quantity > 10) {
            $this->dispatch('cart-error', message: 'Kies een geldige hoeveelheid tussen 1 en 10.');
            return;
        }

        if ($this->product->stock == 0) {
            $this->dispatch('cart-error', message: 'Dit product is niet op voorraad.');
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
            $cart[$cartKey]['slug'] = $this->product->slug;
        } else {
            $cart[$cartKey] = [
                'product_id' => $this->product->id,
                'name' => $this->product->title,
                'price' => $this->product->price,
                'image_1' => $this->product->image_1 ?? '',
                'slug' => $this->product->slug,
                'quantity' => $this->quantity,
            ];
        }

        session(['cart' => $cart]);

        $totalQuantity = collect($cart)->sum('quantity');
        $subtotal = collect($cart)->sum(fn($item) => ($item['price'] ?? 0) * ($item['quantity'] ?? 0));

        // Dispatch events
        $this->dispatch('cart-updated', totalQuantity: $totalQuantity);

        $imageUrl = $this->productImages[0] ?? null;
        $quantityText = $this->quantity == 1 ? '1 product' : $this->quantity . ' producten';
        $this->dispatch('cart-success',
            message: $quantityText . ' toegevoegd aan winkelwagen!',
            productName: $this->product->title,
            productImage: $imageUrl,
            productPrice: number_format($this->product->price, 2, ',', '.'),
            productSlug: $this->product->slug ?? '',
            cartCount: $totalQuantity,
            cartSubtotal: number_format($subtotal, 2, ',', '.'),
        );

        // Reset quantity to 1 after adding
        $this->quantity = 1;
    }

    public function render()
    {
        return view('livewire.product-detail');
    }
}

