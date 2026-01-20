<div class="product-card" wire:key="product-{{ $product->id }}">
    <a href="{{ route('productShow', $product->slug) }}" class="product-card-link">
        <div class="product-card-image-wrapper">
            @if ($this->imageUrl)
                <img src="{{ $this->imageUrl }}" alt="{{ $product->title }}" class="product-card-image" loading="lazy">
            @else
                <div class="product-card-image-placeholder">
                    <i class="fa-solid fa-book"></i>
                </div>
            @endif

            @if ($product->stock > 0 && $product->stock <= 3)
                <div class="product-card-badge product-card-badge-warning">
                    <span>Lage voorraad</span>
                </div>
            @elseif ($product->stock == 0)
                <div class="product-card-badge product-card-badge-error">
                    <span>Niet op voorraad</span>
                </div>
            @endif
        </div>
    </a>

    <div class="product-card-content">
        <a href="{{ route('productShow', $product->slug) }}" class="product-card-title-link">
            <h3 class="product-card-title">{{ $product->title }}</h3>
        </a>

        @if ($product->category)
            <p class="product-card-category">{{ $product->category->name }}</p>
        @endif

        <div class="product-card-footer">
            <div class="product-card-price">
                <span class="product-card-price-amount">€{{ number_format($product->price, 2) }}</span>
            </div>

            <button type="button" class="product-card-button" wire:click="addToCart" wire:loading.attr="disabled"
                    @if ($product->stock == 0) disabled @endif>
                <span wire:loading.remove wire:target="addToCart">
                    <i class="fa-solid fa-bag-shopping"></i>
                    <i class="fa-solid fa-plus small-plus"></i>
                    <span class="in-cart">In winkelmand</span>
                </span>
                <span wire:loading wire:target="addToCart" class="product-card-button-loading">
                    <i class="fa-solid fa-spinner fa-spin"></i>
                    <span class="adding">Toevoegen...</span>
                </span>
            </button>
        </div>
    </div>
</div>
