<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover">

    @if(isset($SEOData))
        {!! seo($SEOData) !!}
    @else
        <title>Bibliotheek | Lucide Inkt</title>
        <meta name="description" content="Blader door onze digitale bibliotheek en lees boeken online.">
    @endif

    <link rel="icon" type="image/x-icon" href="{{ asset('favicon.ico') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.0/css/all.min.css"
        integrity="sha512-DxV+EoADOkOygM4IR9yXP8Sb2qwgidEmeqAEmDKIOfPRQZOWbXCzLC6vjbZyy0vPisbH2SyW27+ddLVCN+OMzQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

    @vite(['resources/css/bookshelf.css'])
</head>
<body>

<div class="bookshelf-page">

    {{-- Back to website link --}}
    <a href="{{ route('home') }}" class="bookshelf-back-link">
        <i class="fa-solid fa-chevron-left"></i> Terug naar de website
    </a>

    {{-- The wooden cabinet --}}
    <div class="bookshelf-cabinet">

        {{-- Header sign --}}
        <div class="bookshelf-header-sign">
            <h1 class="bookshelf-title">Bibliotheek</h1>
            <div class="bookshelf-title-ornament">
                <span>❧ Klik op een boek om te lezen ❧</span>
            </div>
            <p class="bookshelf-subtitle">Lucide Inkt</p>
        </div>

        {{-- Flat book pool — JS will build shelf rows --}}
        <div class="bookshelf-books-pool" style="display:none;">
            @forelse ($products as $product)
                @php
                    $href = $product->book_pages_count > 0
                        ? route('onlineLezenReadHtml', $product->slug)
                        : route('onlineLezenRead', ['slug' => $product->slug, 'fullscreen' => '1']);
                @endphp
                <a href="{{ $href }}" class="shelf-book" title="{{ $product->title }}">
                    <div class="shelf-book-cover">
                        <div class="shelf-book-spine"></div>
                        <span class="shelf-book-ornament">✦</span>
                        <span class="shelf-book-title">{{ $product->title }}</span>
                        <span class="shelf-book-ornament-bottom">— ✦ —</span>
                    </div>
                    <span class="shelf-book-tooltip">{{ $product->title }}</span>
                </a>
            @empty
                <div class="bookshelf-empty">
                    <i class="fa-solid fa-book-open"></i>
                    <p>Binnenkort insha'ALLAH!</p>
                </div>
            @endforelse
        </div>

        {{-- Shelf rows injected here by JS --}}
        <div class="bookshelf-shelves" id="bookshelf-shelves"></div>

    </div>{{-- /.bookshelf-cabinet --}}

</div>{{-- /.bookshelf-page --}}

<script>
(function () {
    const BREAKPOINT_MOBILE = 768;

    function buildShelves() {
        const pool   = document.querySelector('.bookshelf-books-pool');
        const target = document.getElementById('bookshelf-shelves');
        const books  = Array.from(pool.querySelectorAll('.shelf-book, .bookshelf-empty'));
        const perRow = window.innerWidth <= BREAKPOINT_MOBILE ? 2 : 4;

        target.innerHTML = '';

        for (let i = 0; i < books.length; i += perRow) {
            const chunk = books.slice(i, i + perRow);
            const row   = document.createElement('div');
            row.className = 'bookshelf-shelf-row';
            const plank = document.createElement('div');
            plank.className = 'bookshelf-plank';
            chunk.forEach(book => plank.appendChild(book.cloneNode(true)));
            row.appendChild(plank);
            target.appendChild(row);
        }
    }

    buildShelves();

    let resizeTimer;
    window.addEventListener('resize', function () {
        clearTimeout(resizeTimer);
        resizeTimer = setTimeout(buildShelves, 150);
    });
})();
</script>

</body>
</html>
