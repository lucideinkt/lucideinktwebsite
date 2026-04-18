<div class="product-detail-grid">
    @if (count($productImages) > 0)
        <div class="product-detail-image-section" wire:ignore>
            {{-- Custom gallery: no external libraries --}}
            <div class="pd-gallery"
                 data-title="{{ $product->title }}"
                 data-images="{{ json_encode($productImages) }}">

                {{-- Main stage --}}
                <div class="pd-gallery__stage">
                    @foreach ($productImages as $idx => $img)
                        <img class="pd-gallery__img {{ $idx === 0 ? 'is-active' : '' }}"
                             src="{{ $img }}"
                             alt="{{ $product->title }} {{ $idx + 1 }}"
                             loading="{{ $idx === 0 ? 'eager' : 'lazy' }}"
                             data-index="{{ $idx }}">
                    @endforeach

                    @if (count($productImages) > 1)
                        <button class="pd-gallery__arrow pd-gallery__arrow--prev" aria-label="Vorige">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="15 18 9 12 15 6"/></svg>
                        </button>
                        <button class="pd-gallery__arrow pd-gallery__arrow--next" aria-label="Volgende">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="9 6 15 12 9 18"/></svg>
                        </button>
                    @endif

                    <button class="pd-gallery__zoom" aria-label="Vergroot">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="11" cy="11" r="8"/><line x1="21" y1="21" x2="16.65" y2="16.65"/><line x1="11" y1="8" x2="11" y2="14"/><line x1="8" y1="11" x2="14" y2="11"/></svg>
                    </button>
                </div>

                {{-- Thumbnails --}}
                @if (count($productImages) > 1)
                    <ul class="pd-gallery__thumbs">
                        @foreach ($productImages as $idx => $img)
                            <li class="pd-gallery__thumb {{ $idx === 0 ? 'is-active' : '' }}"
                                data-index="{{ $idx }}" role="button" tabindex="0"
                                aria-label="Afbeelding {{ $idx + 1 }}">
                                <img src="{{ $img }}" alt="{{ $product->title }} {{ $idx + 1 }}" loading="lazy">
                            </li>
                        @endforeach
                    </ul>
                @endif
            </div>
        </div>
    @else
        <div class="product-detail-image-section">
            <div class="product-detail-image-placeholder">
                <i class="fa-solid fa-book"></i>
                <p>Geen afbeelding beschikbaar</p>
            </div>
        </div>
    @endif

    <div class="product-detail-info">
        <div class="product-detail-header">
            @php
                [$mainTitle, $subTitle] = array_pad(
                    explode(' - ', $product->title, 2),
                    2,
                    null
                );
            @endphp

            <h1 class="product-detail-title">
                {{ $mainTitle }}
                @if($subTitle)
                    <br>
                    <span class="product-detail-subtitle">{{ $subTitle }}</span>
                @endif
            </h1>

        @if (isset($product->category) && !empty($product->category->name))
                <span class="product-detail-category">{{ $product->category->name }}</span>
            @endif
        </div>

        <div class="product-detail-price-wrapper">
            <div class="product-detail-price-section">
                <span class="product-detail-price">€{{ number_format($product->price, 2) }}</span>
                @if ($product->stock > 0 && $product->stock <= 3)
                    <span class="product-detail-stock-badge product-detail-stock-warning">Lage voorraad</span>
                @elseif ($product->stock == 0)
                    <span class="product-detail-stock-badge product-detail-stock-error">Niet op voorraad</span>
                @endif
            </div>

            @if ($product->short_description)
                <div class="product-detail-short-description">
                    <p>{{ $product->short_description }}</p>
                </div>
            @endif

            <div class="product-detail-form">
                <div class="product-detail-quantity">
                    <label for="quantity">Aantal</label>
                    <select wire:model="quantity" id="quantity" class="product-detail-quantity-select">
                        @for ($i = 1; $i <= 10; $i++)
                            <option value="{{ $i }}">{{ $i }}</option>
                        @endfor
                    </select>
                </div>

                <button type="button" class="product-detail-add-to-cart" wire:click="addToCart"
                        wire:loading.attr="disabled" @if ($product->stock == 0) disabled @endif>
                    <span wire:loading.remove wire:target="addToCart">
                        <i class="fa-solid fa-bag-shopping"></i>
                        <i class="fa-solid fa-plus small-plus"></i>
                        <span>In winkelmand</span>
                    </span>
                    <span wire:loading wire:target="addToCart">
                        <i class="fa-solid fa-spinner fa-spin"></i>
                        <span>Toevoegen...</span>
                    </span>
                </button>
            </div>
        </div>

        {{-- Product Details / Book Information --}}
        @if ($product->pages || $product->binding_type || $product->ean_code)
            <div class="product-detail-specifications">
                <div class="product-detail-book-info">
                    @if ($product->pages)
                        <div class="product-detail-info-item">
                            <span class="product-detail-info-label">Aantal pagina's</span>
                            <span class="product-detail-info-value">{{ $product->pages }}</span>
                        </div>
                    @endif
                    @if ($product->binding_type)
                        <div class="product-detail-info-item">
                            <span class="product-detail-info-label">Uitvoering</span>
                            <span class="product-detail-info-value">
                                @if ($product->binding_type === 'hardcover')
                                    Hardcover
                                @elseif($product->binding_type === 'softcover')
                                    Softcover
                                @else
                                    {{ $product->binding_type }}
                                @endif
                            </span>
                        </div>
                    @endif
                    @if ($product->ean_code)
                        <div class="product-detail-info-item">
                            <span class="product-detail-info-label">EAN Code</span>
                            <span class="product-detail-info-value">{{ $product->ean_code }}</span>
                        </div>
                    @endif
                </div>
            </div>
        @endif

        @if ($product->long_description)
            <div class="product-detail-description">
                <p>{{ $product->long_description }}</p>
            </div>
        @endif
    </div>
</div>

{{-- Gallery initialised via resources/js/features/product-swiper.js --}}
