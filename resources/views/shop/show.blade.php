<x-layout>
    <main class="container page product">
        @if (session('success_add_to_cart'))
            <div class="alert alert-success" style="position: relative;z-index: 1000;">
                <div>
                    {{ session('success_add_to_cart') }} <a style="" href="{{ route('cartPage') }}"> Bekijk
                        winkelwagen</a>
                </div>
                <button type="button" class="alert-close"
                    onclick="this.parentElement.style.display='none';">&times;</button>
            </div>
        @endif

        @if($errors->has('stock'))
            <div class="alert alert-error">
                <div>
                    {!! $errors->first('stock') !!}
                </div>
                <button type="button" class="alert-close"
                    onclick="this.parentElement.style.display='none';">&times;</button>
            </div>
        @endif

        @if (session('success'))
            <div class="alert alert-success" style="position: relative;">
                {{ session('success') }}
                <button type="button" class="alert-close"
                    onclick="this.parentElement.style.display='none';">&times;</button>
            </div>
        @endif

        <x-breadcrumbs :items="[
        ['label' => 'Home', 'url' => route('home')],
        ['label' => 'Winkel', 'url' => route('shop')],
        ['label' => $product->title, 'url' => ''],
    ]" />

        <div class="product-detail">
            @if ($product)
                @php
                    // Build an array of available product images (image_1..image_4)
                    $productImages = [];
                    for ($si = 1; $si <= 4; $si++) {
                        $f = 'image_' . $si;
                        if (!empty($product->$f)) {
                            if (str_starts_with($product->$f, 'http://') || str_starts_with($product->$f, 'https://')) {
                                $productImages[] = $product->$f;
                            } elseif (str_starts_with($product->$f, 'image/books/') || str_starts_with($product->$f, 'images/books/')) {
                                $productImages[] = asset($product->$f);
                            } else {
                                $productImages[] = asset('storage/' . $product->$f);
                            }
                        }
                    }
                @endphp

                <div class="product-detail-grid">
                    @if(count($productImages) > 0)
                        <div class="product-detail-image-section">
                            <div class="product-detail-image-wrapper">
                                <div id="main-slider" class="splide">
                                    <div class="splide__track">
                                        <ul class="splide__list">
                                            @foreach($productImages as $idx => $img)
                                                <li class="splide__slide">
                                                    <a data-lightbox="books" href="{{ $img }}" data-title="{{ $product->title }}">
                                                        <img data-lightbox="books" src="{{ $img }}"
                                                            alt="{{ $product->title }} {{ $idx + 1 }}" loading="lazy">
                                                    </a>
                                                </li>
                                            @endforeach
                                        </ul>
                                    </div>
                                </div>

                                @if(count($productImages) > 1)
                                    <ul id="thumbnails" class="product-detail-thumbnails">
                                        @foreach($productImages as $idx => $img)
                                            <li class="product-detail-thumbnail">
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
                            @if (isset($product->category) && !empty($product->category->name))
                                <span class="product-detail-category">{{ $product->category->name }}</span>
                            @endif
                            <h1 class="product-detail-title">{{ $product->title }}</h1>
                        </div>

                        <div class="product-detail-price-section">
                            <span class="product-detail-price">€{{ number_format($product->price, 2) }}</span>
                            @if ($product->stock > 0 && $product->stock <= 3)
                                <span class="product-detail-stock-badge product-detail-stock-warning">Lage voorraad</span>
                            @elseif ($product->stock == 0)
                                <span class="product-detail-stock-badge product-detail-stock-error">Niet op voorraad</span>
                            @endif
                        </div>

                        @if ($product->long_description)
                            <div class="product-detail-description">
                                <p>{{ $product->long_description }}</p>
                            </div>
                        @endif

                        <form action="{{ route('addToCart') }}" method="POST" id="addToCartForm" class="product-detail-form">
                            @csrf
                            <input type="hidden" name="product_id" value="{{ $product->id }}">
                            
                            <div class="product-detail-quantity">
                                <label for="quantity">Aantal</label>
                                <select name="quantity" id="quantity" class="product-detail-quantity-select">
                                    @for ($i = 1; $i <= 5; $i++)
                                        <option value="{{ $i }}" {{ (int) old('quantity', 1) === $i ? 'selected' : '' }}>{{ $i }}</option>
                                    @endfor
                                </select>
                                @error('quantity')
                                    <div class="error">{{ $message }}</div>
                                @enderror
                            </div>

                            <button type="submit" class="product-detail-add-to-cart" @if($product->stock == 0) disabled @endif>
                                <span class="loader"></span>
                                <i class="fa-solid fa-cart-plus"></i>
                                <span>Aan winkelmand toevoegen</span>
                            </button>
                        </form>
                    </div>
                </div>
            @else
                <p>Geen product gevonden</p>
            @endif
        </div>
    </main>
</x-layout>