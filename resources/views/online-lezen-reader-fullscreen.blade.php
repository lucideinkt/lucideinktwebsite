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
            {{-- Loading overlay: shown until PDF.js fires its first page render --}}
            <div id="pdf-loading-overlay" style="
                position:fixed;inset:0;background:#1a1a1a;z-index:10000;
                display:flex;flex-direction:column;align-items:center;justify-content:center;
                color:#c9a84c;font-family:serif;gap:16px;transition:opacity .4s ease;">
                <i class="fa-solid fa-book-open" style="font-size:48px;animation:pulse 1.5s infinite;"></i>
                <div id="pdf-loading-label" style="font-size:16px;letter-spacing:.05em;">Boek wordt geladen…</div>
                <div style="width:220px;height:4px;background:#333;border-radius:2px;overflow:hidden;">
                    <div id="pdf-loading-bar" style="height:100%;width:0%;background:#c9a84c;border-radius:2px;transition:width .3s ease;"></div>
                </div>
            </div>
            <style>@keyframes pulse{0%,100%{opacity:.5}50%{opacity:1}}</style>
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
            const loadingOverlay = document.getElementById('pdf-loading-overlay');
            const loadingBar     = document.getElementById('pdf-loading-bar');
            const loadingLabel   = document.getElementById('pdf-loading-label');

            @php
                $pdfFullPath = storage_path('app/public/' . $product->pdf_file);
                $pdfVersion  = file_exists($pdfFullPath) ? filemtime($pdfFullPath) : 0;
            @endphp

            {{-- Serve directly via /storage/ (Nginx, no PHP overhead) with cache-busting version --}}
            const pdfUrl = "{{ asset('storage/' . $product->pdf_file) }}?v={{ $pdfVersion }}";
            const storageKey = 'pdf_last_page_{{ $product->id }}';
            const PRODUCT_ID    = {{ $product->id }};
            const PRODUCT_TITLE = @json($product->title);
            const READER_URL    = "{{ route('onlineLezenRead', $product->slug) }}";

            // Track current page for save-on-leave
            let currentPage = 1;

            // Helper: save page to bibliotheek_reading_history for the bookshelf sidebar
            function saveToHistory(page) {
                try {
                    const meta = {
                        productId:    PRODUCT_ID,
                        productTitle: PRODUCT_TITLE,
                        readerUrl:    READER_URL,
                        page:         page,
                        timestamp:    Date.now()
                    };
                    let history = JSON.parse(localStorage.getItem('bibliotheek_reading_history') || '[]');
                    history = history.filter(function(h) { return h.productId !== PRODUCT_ID; });
                    history.unshift(meta);
                    if (history.length > 20) history = history.slice(0, 20);
                    localStorage.setItem('bibliotheek_reading_history', JSON.stringify(history));
                    localStorage.setItem('bibliotheek_last_read', JSON.stringify(meta));
                } catch(_) {}
            }

            // Check URL ?page= param first (set by "Laatste gelezen" click), fall back to localStorage
            const urlParams = new URLSearchParams(window.location.search);
            const urlPage   = urlParams.get('page') ? parseInt(urlParams.get('page')) : null;
            const searchQuery = urlParams.get('q') || '';
            const savedPage = localStorage.getItem(storageKey);
            const startPage = urlPage || (savedPage ? parseInt(savedPage) : 1);
            currentPage = startPage;

            if (startPage > 1) {
                console.log('📖 Terugkeren naar laatst gelezen pagina:', startPage);
            }

            // Save immediately so book appears in "Laatste gelezen" from the first second
            saveToHistory(startPage);

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
            let viewerUrl = '/pdfjs/web/viewer.html?v={{ filemtime(public_path("pdfjs/web/viewer.html")) }}&file=' + encodeURIComponent(pdfConfig.file);
            viewerUrl += '#page=' + pdfConfig.page;

            if (pdfConfig.zoom !== 'auto') {
                viewerUrl += '&zoom=' + pdfConfig.zoom;
            }

            pdfViewer.src = viewerUrl;

            // ── Loading overlay: animate bar, dismiss when PDF.js renders page 1 ──
            let loadProgress = 5;
            const progressTimer = setInterval(function () {
                // Fake progress bar that crawls to 85% while waiting
                if (loadProgress < 85) {
                    loadProgress += (85 - loadProgress) * 0.04;
                    if (loadingBar) loadingBar.style.width = loadProgress.toFixed(1) + '%';
                }
            }, 150);

            function dismissOverlay() {
                clearInterval(progressTimer);
                if (loadingBar)     loadingBar.style.width = '100%';
                if (loadingLabel)   loadingLabel.textContent = 'Klaar!';
                setTimeout(function () {
                    if (loadingOverlay) {
                        loadingOverlay.style.opacity = '0';
                        setTimeout(function () {
                            if (loadingOverlay) loadingOverlay.style.display = 'none';
                        }, 450);
                    }
                }, 200);
            }

            // Poll until PDF.js fires its first pagerendered event inside the iframe
            pdfViewer.addEventListener('load', function () {
                let attempts = 0;
                (function waitForPdfJs() {
                    try {
                        const iWin = pdfViewer.contentWindow;
                        if (iWin && iWin.PDFViewerApplication && iWin.PDFViewerApplication.eventBus) {
                            iWin.PDFViewerApplication.eventBus.on('pagerendered', function handler() {
                                iWin.PDFViewerApplication.eventBus.off('pagerendered', handler);
                                dismissOverlay();
                            });
                            return;
                        }
                    } catch (e) {}
                    if (++attempts < 100) setTimeout(waitForPdfJs, 100);
                    else dismissOverlay(); // fallback: give up after 10s
                })();
            });

            // Fallback: dismiss after 12 seconds regardless
            setTimeout(dismissOverlay, 12000);

            // ── Search highlighting ───────────────────────────────────────────
            // When a ?q= parameter is present, trigger PDF.js find after load.
            // Poll every 100ms so highlighting fires as soon as PDF.js is ready.
            if (searchQuery) {
                pdfViewer.addEventListener('load', function () {
                    let attempts = 0;
                    const maxAttempts = 80; // give up after ~8 seconds
                    (function triggerFind() {
                        try {
                            const iWin = pdfViewer.contentWindow;
                            if (iWin && iWin.PDFViewerApplication && iWin.PDFViewerApplication.eventBus) {
                                iWin.PDFViewerApplication.eventBus.dispatch('find', {
                                    type:         '',
                                    query:        searchQuery,
                                    phraseSearch: true,
                                    caseSensitive: false,
                                    entireWord:   false,
                                    highlightAll: true,
                                    findPrevious: false,
                                });
                            } else if (++attempts < maxAttempts) {
                                setTimeout(triggerFind, 100);
                            }
                        } catch(e) {
                            if (++attempts < maxAttempts) setTimeout(triggerFind, 100);
                        }
                    })();
                });
            }

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

            // Opslaan huidige pagina elke 2 seconden + update reading history
            setInterval(function() {
                try {
                    const iframeWindow = pdfViewer.contentWindow;
                    if (iframeWindow?.PDFViewerApplication?.pdfViewer) {
                        const page = iframeWindow.PDFViewerApplication.pdfViewer.currentPageNumber;
                        if (page) {
                            currentPage = page;
                            localStorage.setItem(storageKey, page);
                            saveToHistory(page);
                            console.log('💾 Pagina opgeslagen:', page);
                        }
                    }
                } catch (e) {
                    const pageMatch = pdfViewer.src.match(/[#&]page=(\d+)/);
                    if (pageMatch?.[1]) {
                        const p = parseInt(pageMatch[1]);
                        currentPage = p;
                        localStorage.setItem(storageKey, p);
                        saveToHistory(p);
                    }
                }
            }, 2000);

            // Save on page hide / navigate-away so the entry is never lost
            function saveBeforeLeave() {
                saveToHistory(currentPage);
            }
            document.addEventListener('visibilitychange', function() {
                if (document.visibilityState === 'hidden') saveBeforeLeave();
            });
            window.addEventListener('beforeunload', saveBeforeLeave);

            // Close button - terug naar overzicht
            closeBtn.addEventListener('click', function() {
                saveBeforeLeave();
                console.log('🔙 Terugkeren naar boeken overzicht');
                window.location.href = '{{ route("onlineLezen") }}';
            });

            // ESC key - terug naar overzicht
            document.addEventListener('keydown', function(e) {
                if (e.key === 'Escape') {
                    saveBeforeLeave();
                    console.log('🔙 Terugkeren naar boeken overzicht (ESC)');
                    window.location.href = '{{ route("onlineLezen") }}';
                }
            });
        });
    </script>
    @endif
</x-reader-layout>

