<div class="product-detail-grid">
    @if (count($productImages) > 0)
        <div class="product-detail-image-section" wire:ignore>
            <div class="product-detail-image-wrapper">
                <div id="main-slider" class="splide">
                    <div class="splide__track">
                        <ul class="splide__list">
                            @foreach ($productImages as $idx => $img)
                                <li class="splide__slide">
                                    <a data-lightbox="books" href="{{ $img }}"
                                       data-title="{{ $product->title }}">
                                        <img data-lightbox="books" src="{{ $img }}"
                                             alt="{{ $product->title }} {{ $idx + 1 }}" loading="lazy">
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>

                @if (count($productImages) > 1)
                    <ul id="thumbnails" class="product-detail-thumbnails">
                        @foreach ($productImages as $idx => $img)
                            <li class="product-detail-thumbnail">
                                <img src="{{ $img }}" alt="{{ $product->title }} {{ $idx + 1 }}"
                                     loading="lazy">
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

<script>
    document.addEventListener('livewire:init', () => {
        Livewire.hook('morph.added', ({
                                          el
                                      }) => {
            if (el.id === 'main-slider') {
                setTimeout(() => {
                    const mainSlider = document.getElementById('main-slider');
                    if (!mainSlider) return;

                    const track = mainSlider.querySelector('.splide__track');
                    const list = mainSlider.querySelector('.splide__list');

                    if (!track || !list) return;
                    if (typeof Splide === 'undefined') return;

                    try {
                        if (mainSlider.splide) {
                            mainSlider.splide.destroy();
                            mainSlider.splide = null;
                        }

                        const splide = new Splide('#main-slider', {
                            pagination: false,
                            type: 'fade',
                            rewind: true,
                            speed: 400,
                        });

                        const thumbnails = document.querySelectorAll(
                            '.product-detail-thumbnail');
                        let current;

                        thumbnails.forEach((thumbnail, index) => {
                            thumbnail.addEventListener('click', function() {
                                splide.go(index);
                            });
                        });

                        splide.on('mounted move', function() {
                            const thumbnail = thumbnails[splide.index];

                            if (thumbnail) {
                                if (current) {
                                    current.classList.remove('is-active', 'active');
                                }
                                thumbnail.classList.add('is-active', 'active');
                                current = thumbnail;
                            }
                        });

                        splide.mount();
                        mainSlider.splide = splide;
                    } catch (error) {
                        console.error('Failed to initialize Splide:', error);
                    }
                }, 100);
            }
        });
    });

    // Also initialize immediately if slider already exists
    (function() {
        setTimeout(() => {
            const mainSlider = document.getElementById('main-slider');
            if (!mainSlider) return;
            if (mainSlider.splide) return; // Already initialized

            const track = mainSlider.querySelector('.splide__track');
            const list = mainSlider.querySelector('.splide__list');

            if (!track || !list) return;
            if (typeof Splide === 'undefined') return;

            try {
                const splide = new Splide('#main-slider', {
                    pagination: false,
                    type: 'fade',
                    rewind: true,
                    speed: 400,
                });

                const thumbnails = document.querySelectorAll('.product-detail-thumbnail');
                let current;

                thumbnails.forEach((thumbnail, index) => {
                    thumbnail.addEventListener('click', function() {
                        splide.go(index);
                    });
                });

                splide.on('mounted move', function() {
                    const thumbnail = thumbnails[splide.index];

                    if (thumbnail) {
                        if (current) {
                            current.classList.remove('is-active', 'active');
                        }
                        thumbnail.classList.add('is-active', 'active');
                        current = thumbnail;
                    }
                });

                splide.mount();
                mainSlider.splide = splide;
            } catch (error) {
                console.error('Failed to initialize Splide:', error);
            }
        }, 150);
    })();
</script>
