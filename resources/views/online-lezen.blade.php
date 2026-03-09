<x-layout :seo-data="$SEOData">
    <main class="container page online-lezen">
        <x-breadcrumbs :items="[
          ['label' => 'Home', 'url' => route('home')],
          ['label' => 'Online Lezen', 'url' => route('onlineLezen')],
        ]" />

        <div class="online-lezen-header">
            <h1 class="online-lezen-title">Online Bibliotheek</h1>
{{--            <p class="online-lezen-subtitle">Ontdek en lees onze boeken direct online, waar en wanneer je maar wilt</p>--}}
        </div>


        <div class="online-lezen-grid" style="margin-bottom: 20px;justify-content: center;align-items: center">
            @forelse ($products as $product)
                <a href="{{ route('onlineLezenRead', ['slug' => $product->slug, 'fullscreen' => '1']) }}" class="online-book-link">
                    @if($product->online_lezen_image)
                        <img src="{{ asset($product->online_lezen_image) }}" alt="{{ $product->title }}" style="width: 90%; background: transparent; display: block; margin: 0 auto;">
                    @elseif($product->image_1)
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
                        <img src="{{ $imageUrl }}" alt="{{ $product->title }}" style="width: 90%; background: transparent; display: block; margin: 0 auto;">
                    @else
                        <img src="{{ asset('/images/natuur_online_lezen.webp') }}" alt="{{ $product->title }}" style="width: 90%; background: transparent; display: block; margin: 0 auto;">
                    @endif
                </a>

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
