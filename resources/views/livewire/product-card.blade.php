<div class="product-card" wire:key="product-{{ $product->id }}">
    <a href="{{ route('productShow', $product->slug) }}" class="product-card-link">
        <div class="product-card-image-wrapper">
            @if ($this->imageUrl)
                <img src="{{ $this->imageUrl }}" alt="{{ $product->title }}" class="product-card-image" loading="lazy" decoding="async">
            @else
                <div class="product-card-image-placeholder">
                    <i class="fa-solid fa-book"></i>
                </div>
            @endif

            @if ($product->stock > 0 && $product->stock <= 3)
                <div class="product-card-badge product-card-badge-warning">
                    <i class="fa-solid fa-fire-flame-simple"></i>
                    <span>Beperkte voorraad</span>
                </div>
            @elseif ($product->stock == 0)
                <div class="product-card-badge product-card-badge-error">
                    <i class="fa-solid fa-ban"></i>
                    <span>Uitverkocht</span>
                </div>
            @endif
        </div>
    </a>

    <div class="product-card-content">
{{--        @if ($product->category)--}}
{{--            <p class="product-card-category">{{ $product->category->name }}</p>--}}
{{--        @endif--}}

        <a href="{{ route('productShow', $product->slug) }}" class="product-card-title-link">
            @php
                [$mainTitle, $subTitle] = array_pad(
                    explode(' - ', $product->title, 2),
                    2,
                    null
                );

                [$markupTitle] = array_pad(
                    explode(' - ', $product->mark_up_product_title ?? $product->title, 2),
                    2,
                    null
                );

            @endphp

            @php
                $titleParts = array_map('trim', explode('|', $markupTitle));
                $titleLineCount = count($titleParts);
            @endphp

            <h3 class="product-card-title product-card-title-lines-{{ $titleLineCount }}">
                @foreach ($titleParts as $titlePart)
                    <span>{!! $titlePart === '&' ? '<span class="inline-and">&</span>' : $titlePart !!}</span>
                @endforeach
            </h3>
            @if($subTitle)
                <p class="product-card-subtitle">{{ $subTitle }}</p>
            @endif
        </a>


        <div class="product-card-footer">
            <div class="product-card-price">
                <span class="product-card-price-amount">€{{ number_format($product->price, 2, ',', '.') }}</span>
            </div>

            <button type="button" class="product-card-button" wire:click="addToCart" wire:loading.attr="disabled"
                    @if ($product->stock == 0) disabled @endif>
                <span wire:loading.remove wire:target="addToCart">
                    <i class="fa-solid fa-basket-shopping"></i>
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
