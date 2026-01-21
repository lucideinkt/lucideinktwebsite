<x-layout>
    <main class="container page online-reader">
        <x-breadcrumbs :items="[
          ['label' => 'Home', 'url' => route('home')],
          ['label' => 'Online Lezen', 'url' => route('onlineLezen')],
          ['label' => $product->title, 'url' => route('onlineLezenRead', $product->slug)],
        ]" />

        <div class="pdf-reader-container">
            <div class="pdf-viewer-wrapper" id="pdf-container">
                {{-- PDF.js Viewer iframe --}}
                @if($product->pdf_file)
                    <iframe
                        id="pdf-viewer"
                        class="pdf-iframe"
                        title="{{ $product->title }}"
                        frameborder="0"
                        allowfullscreen
                        style="width: 100%; height: 800px; border: none;">
                    </iframe>
                @else
                    {{-- Fallback message if no PDF is available --}}
                    <div class="pdf-no-file" id="no-pdf-message">
                        <i class="fa-solid fa-file-pdf"></i>
                        <p>Er is momenteel geen PDF beschikbaar voor dit boek.</p>
                        <a href="{{ route('productShow', $product->slug) }}" class="btn btn-primary">
                            Bekijk productpagina
                        </a>
                    </div>
                @endif
            </div>

            @if ($product->short_description || $product->long_description)
                <div class="reader-description">
                    <h2>Over dit boek</h2>
                    @if ($product->short_description)
                        <p class="description-short">{{ $product->short_description }}</p>
                    @endif
                    @if ($product->long_description)
                        <p class="description-long">{{ $product->long_description }}</p>
                    @endif
                </div>
            @endif
        </div>

        <div class="reader-footer">
            <div class="reader-cta">
                <h3>Wilt u dit boek ook in uw collectie?</h3>
                <p>Bestel {{ $product->title }} direct in onze webshop</p>
                <div class="reader-cta-actions">
                    <a href="{{ route('productShow', $product->slug) }}" class="btn btn-primary">
                        <i class="fa-solid fa-eye"></i>
                        Bekijk product
                    </a>
                    @if ($product->stock > 0)
                        <a href="{{ route('shop') }}" class="btn btn-secondary">
                            <i class="fa-solid fa-shopping-bag"></i>
                            Naar winkel
                        </a>
                    @endif
                </div>
            </div>
        </div>
    </main>

    @vite(['resources/js/main.js'])

    @if($product->pdf_file)
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const pdfViewer = document.getElementById('pdf-viewer');

            // Use PDF proxy route with CORS headers
            const pdfUrl = "{{ route('pdf.proxy', ['path' => $product->pdf_file]) }}";

            // Use simple custom PDF.js viewer
            const viewerUrl = '/pdfjs/simple-viewer.html?file=' + encodeURIComponent(pdfUrl);
            pdfViewer.src = viewerUrl;
        });
    </script>
    @endif


    <div class="gradient-border"></div>
    <x-footer></x-footer>
</x-layout>
