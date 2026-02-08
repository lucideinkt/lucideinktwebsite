<x-layout>
    <main class="container page online-lezen">
        <x-breadcrumbs :items="[
          ['label' => 'Home', 'url' => route('home')],
          ['label' => 'Online Lezen', 'url' => route('onlineLezen')],
        ]" />

        <div class="online-lezen-header">
            <h1 class="online-lezen-title">Online Bibliotheek</h1>
{{--            <p class="online-lezen-subtitle">Ontdek en lees onze boeken direct online, waar en wanneer je maar wilt</p>--}}
        </div>

        <div class="online-lezen-grid">
            @forelse ($products as $product)
                <div class="online-book-card">
                    <a href="{{ route('onlineLezenRead', $product->slug) }}" class="online-book-link">
                        <div class="online-book-image-wrapper">
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
                                <img src="{{ $imageUrl }}" alt="{{ $product->title }}" class="online-book-image" loading="lazy">
                            @else
                                <div class="online-book-placeholder">
                                    <i class="fa-solid fa-book"></i>
                                </div>
                            @endif
                            <div class="online-book-overlay">
                                <i class="fa-solid fa-book-open"></i>
                                <span>Lees Online</span>
                            </div>
                        </div>
                        <div class="online-book-content">
                            <h3 class="online-book-title">{{ $product->title }}</h3>
                            @if ($product->category)
                                <p class="online-book-category">{{ $product->category->name }}</p>
                            @endif
                            @if ($product->productCopy)
                                <p class="online-book-language">{{ $product->productCopy->name }}</p>
                            @endif
                        </div>
                    </a>
                </div>
            @empty
                <div class="online-lezen-empty">
                    <i class="fa-solid fa-book-open"></i>
                    <p>Er zijn momenteel geen boeken beschikbaar om online te lezen.<br>Kom binnenkort terug voor nieuwe toevoegingen!</p>
                </div>
            @endforelse
        </div>
    </main>

    <div class="gradient-border"></div>
    <x-footer></x-footer>
</x-layout>
