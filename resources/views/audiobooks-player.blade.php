<x-layout :seo-data="$SEOData">
    <main class="container page audiobooks-player">
        <x-breadcrumbs :items="[
          ['label' => 'Home', 'url' => route('home')],
          ['label' => 'Audioboeken', 'url' => route('audiobooks')],
          ['label' => $product->title, 'url' => route('audiobooksListen', ['slug' => $product->slug])],
        ]" />

        <div class="audio-player-container">
            <div class="audio-player-header">
                @php
                    [$mainTitle, $subTitle] = array_pad(
                        explode(' - ', $product->title, 2),
                        2,
                        null
                    );
                @endphp
                <h1 class="audio-player-title">{{ $mainTitle }}</h1>
                @if($subTitle)
                    <p class="audio-player-subtitle">{{ $subTitle }}</p>
                @endif
            </div>

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
                <img src="{{ $imageUrl }}" alt="{{ $product->title }}" class="audio-player-image">
            @endif

            <div class="audio-player-controls">
                @if ($product->audio_file)
                    @php
                        $audioPath = $product->audio_file;
                        if (Str::startsWith($audioPath, 'https://') || Str::startsWith($audioPath, 'http://')) {
                            $audioUrl = $audioPath;
                        } else {
                            // Use streaming route to bypass permission issues
                            $filename = basename($audioPath);
                            $audioUrl = route('audio.stream', ['path' => $filename]);
                        }
                    @endphp
                    <audio controls preload="metadata">
                        <source src="{{ $audioUrl }}" type="audio/mpeg">
                        <source src="{{ $audioUrl }}" type="audio/ogg">
                        <source src="{{ $audioUrl }}" type="audio/mp4">
                        Uw browser ondersteunt het audio element niet.
                    </audio>
                @else
                    <p style="text-align: center; color: var(--ink-muted);">
                        <i class="fa-solid fa-exclamation-circle"></i>
                        Geen audiobestand beschikbaar voor dit boek.
                    </p>
                @endif
            </div>

            <div class="audio-player-info">
                @if ($product->category)
                    <div class="audio-player-info-item">
                        <i class="fa-solid fa-tag"></i>
                        <span>{{ $product->category->name }}</span>
                    </div>
                @endif

                @if ($product->productCopy)
                    <div class="audio-player-info-item">
                        <i class="fa-solid fa-language"></i>
                        <span>{{ $product->productCopy->name }}</span>
                    </div>
                @endif

                @if ($product->short_description)
                    <div class="audio-player-info-item" style="margin-top: 10px; display: block;">
                        <p style="margin: 0; line-height: 1.6;">{{ $product->short_description }}</p>
                    </div>
                @endif
            </div>
        </div>
    </main>

    <div class="gradient-border"></div>
    <x-footer></x-footer>
</x-layout>

