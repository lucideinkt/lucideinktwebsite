<x-layout :seo-data="$SEOData">
    <div class="page-normal-background">
    <main class="container page audiobooks">

        <div class="audiobooks-hero">
            <div class="container">
                <x-breadcrumbs :items="[
                  ['label' => 'Home', 'url' => route('home')],
                  ['label' => 'Audioboeken', 'url' => route('audiobooks')],
                ]" />
            </div>
        </div>

        <div class="gradient-border"></div>
        <div class="text-box-background">
            <div class="audiobooks-page__text-box">

                <div class="audiobooks-header">
                    <h1 class="audiobooks-title">Risale-i Nur Audioboeken</h1>
                    <p class="audiobooks-subtitle">Beluister de <strong>Risale-i Nur audioboeken</strong> in het Nederlands en Engels</p>
                </div>

                <h2 class="sr-only">Risale-i Nur audioboeken — Nederlandse en Engelse vertalingen van Said Nursi</h2>

                <div class="audiobooks-grid">
                    @forelse ($products as $product)
                        <div class="audio-book-card">
                            <a href="{{ route('audiobooksListen', ['slug' => $product->slug]) }}" class="audio-book-link">
                                <div class="audio-book-image-wrapper">
                                    @if ($product->image_1)
                                        @php
                                            $imagePath = $product->image_1;
                                            if (Str::startsWith($imagePath, 'https://')) {
                                                $imageUrl = $imagePath;
                                            } elseif (Str::startsWith($imagePath, 'image/books/') || Str::startsWith($imagePath, 'images/books/')) {
                                                $imageUrl = asset($imagePath);
                                            } else {
                                                $imageUrl = asset('storage/' . $imagePath);
                                            }
                                        @endphp
                                        <img src="{{ $imageUrl }}" alt="{{ $product->title }} — Risale-i Nur audioboeken" title="{{ $product->title }} — Risale-i Nur audioboeken" class="audio-book-image" loading="lazy">
                                    @else
                                        <div class="audio-book-placeholder">
                                            <i class="fa-solid fa-headphones"></i>
                                        </div>
                                    @endif
                                    <div class="audio-play-button">
                                        <i class="fa-solid fa-play"></i>
                                    </div>
                                </div>
                                <div class="audio-book-content">
                                    @php
                                        [$mainTitle, $subTitle] = array_pad(
                                            explode(' - ', $product->title, 2),
                                            2,
                                            null
                                        );
                                    @endphp

                                    <h3 class="audio-book-title">
                                        {{ $mainTitle }}
                                        @if($subTitle)
                                            <br>
                                            <span class="audio-book-subtitle">{{ $subTitle }}</span>
                                        @endif
                                    </h3>
                                @if ($product->category)
                                        <p class="audio-book-category">{{ $product->category->name }}</p>
                                    @endif
                                </div>
                            </a>
                        </div>
                    @empty
                        <div class="audiobooks-empty">
                            <i class="fa-solid fa-headphones"></i>
                            <p>Binnenkort insha’ALLAH!</p>
                        </div>
                    @endforelse
                </div>

            </div>
        </div>

    </main>
    <div class="gradient-border"></div>
    <x-footer></x-footer>
    </div>
</x-layout>
