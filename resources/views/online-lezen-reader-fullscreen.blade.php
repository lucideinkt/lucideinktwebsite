<x-reader-layout :seo-data="$SEOData">
    @push('head')
        <style>
            /* Fullscreen PDF reader - geen margins, geen padding */
            .fullscreen-pdf-container {
                position: fixed;
                top: 0;
                left: 0;
                width: 100vw;
                height: 100vh;
                margin: 0;
                padding: 0;
                background: #1a1a1a;
                z-index: 9999;
            }

            .fullscreen-close-btn {
                position: fixed;
                top: 40px;
                right: 30px;
                background-color: rgba(255, 255, 255, 0.9);
                border: none;
                border-radius: 50%;
                width: 40px;
                height: 40px;
                font-size: 24px;
                cursor: pointer;
                z-index: 10000;
                display: flex;
                align-items: center;
                justify-content: center;
                transition: all 0.3s ease;
                box-shadow: 0 4px 6px rgba(0, 0, 0, 0.3);
            }

            .fullscreen-close-btn:hover {
                background-color: #fff;
                transform: scale(1.1);
            }

            .fullscreen-close-btn i {
                color: #333;
            }

            .pdf-iframe-fullscreen {
                position: absolute;
                top: 0;
                left: 0;
                width: 100%;
                height: 100%;
                border: none;
                background: white;
            }

            /* Prevent zoom and touch gestures */
            * {
                -webkit-user-select: none;
                -webkit-touch-callout: none;
                -webkit-tap-highlight-color: transparent;
            }

            html, body {
                touch-action: pan-y pan-x;
                -ms-touch-action: pan-y pan-x;
                overscroll-behavior: none;
            }

            @media (max-width: 768px) {
                .fullscreen-close-btn {
                    top: 35px;
                    right: 10px;
                    width: 25px;
                    height: 25px;
                    font-size: 20px;
                }

                .fullscreen-close-btn .fa-xmark {
                    font-size: 15px;
                }
            }
        </style>
    @endpush

    <div class="fullscreen-pdf-container">
        <button id="closeFullscreenBtn" class="fullscreen-close-btn" title="Sluiten">
            <i class="fa-solid fa-xmark"></i>
        </button>

        @if($product->pdf_file)
            <iframe
                id="pdf-viewer-fullscreen"
                class="pdf-iframe-fullscreen"
                title="{{ $product->title }}"
                frameborder="0"
                allowfullscreen>
            </iframe>
        @else
            <div style="display: flex; align-items: center; justify-content: center; height: 100vh; color: white;">
                <div style="text-align: center;">
                    <i class="fa-solid fa-file-pdf" style="font-size: 48px; margin-bottom: 20px;"></i>
                    <p>Er is momenteel geen PDF beschikbaar voor dit boek.</p>
                </div>
            </div>
        @endif
    </div>


    @if($product->pdf_file)
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const pdfViewer = document.getElementById('pdf-viewer-fullscreen');
            const closeBtn = document.getElementById('closeFullscreenBtn');
            const pdfUrl = "{{ route('pdf.proxy', ['path' => $product->pdf_file]) }}";
            const storageKey = 'pdf_last_page_{{ $product->id }}';

            // Ophalen laatst gelezen pagina
            const savedPage = localStorage.getItem(storageKey);
            const startPage = savedPage ? parseInt(savedPage) : 1;

            if (startPage > 1) {
                console.log('📖 Terugkeren naar laatst gelezen pagina:', startPage);
            }

            // PDF.js configuratie
            const pdfConfig = {
                file: pdfUrl,
                zoom: 'auto',
                page: startPage,
                pagemode: 'none',
                scrollmode: 0,
                spreadmode: 0
            };

            // Build viewer URL
            let viewerUrl = '/pdfjs/web/viewer.html?file=' + encodeURIComponent(pdfConfig.file);
            viewerUrl += '#page=' + pdfConfig.page;

            if (pdfConfig.zoom !== 'auto') {
                viewerUrl += '&zoom=' + pdfConfig.zoom;
            }

            pdfViewer.src = viewerUrl;

            // Comprehensive zoom prevention
            let lastTouchEnd = 0;

            // Prevent double-tap zoom
            pdfViewer.addEventListener('touchend', function(e) {
                const now = Date.now();
                if (now - lastTouchEnd <= 300) {
                    e.preventDefault();
                }
                lastTouchEnd = now;
            }, { passive: false });

            // Prevent pinch zoom gesture
            pdfViewer.addEventListener('gesturestart', function(e) {
                e.preventDefault();
            }, { passive: false });

            pdfViewer.addEventListener('gesturechange', function(e) {
                e.preventDefault();
            }, { passive: false });

            pdfViewer.addEventListener('gestureend', function(e) {
                e.preventDefault();
            }, { passive: false });

            // Prevent multi-touch zoom
            pdfViewer.addEventListener('touchmove', function(e) {
                if (e.touches.length > 1) {
                    e.preventDefault();
                }
            }, { passive: false });

            // Opslaan huidige pagina elke 2 seconden
            setInterval(function() {
                try {
                    const iframeWindow = pdfViewer.contentWindow;
                    if (iframeWindow?.PDFViewerApplication?.pdfViewer) {
                        const currentPage = iframeWindow.PDFViewerApplication.pdfViewer.currentPageNumber;
                        if (currentPage) {
                            localStorage.setItem(storageKey, currentPage);
                            console.log('💾 Pagina opgeslagen:', currentPage);
                        }
                    }
                } catch (e) {
                    const pageMatch = pdfViewer.src.match(/[#&]page=(\d+)/);
                    if (pageMatch?.[1]) {
                        localStorage.setItem(storageKey, pageMatch[1]);
                    }
                }
            }, 2000);

            // Close button - terug naar overzicht
            closeBtn.addEventListener('click', function() {
                console.log('🔙 Terugkeren naar boeken overzicht');
                window.location.href = '{{ route("onlineLezen") }}';
            });

            // ESC key - terug naar overzicht
            document.addEventListener('keydown', function(e) {
                if (e.key === 'Escape') {
                    console.log('🔙 Terugkeren naar boeken overzicht (ESC)');
                    window.location.href = '{{ route("onlineLezen") }}';
                }
            });
        });
    </script>
    @endif
</x-reader-layout>

