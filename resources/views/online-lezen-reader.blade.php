<x-layout>
    <main class="container page online-reader">
        <x-breadcrumbs :items="[
          ['label' => 'Home', 'url' => route('home')],
          ['label' => 'Online Lezen', 'url' => route('onlineLezen')],
          ['label' => $product->title, 'url' => route('onlineLezenRead', $product->slug)],
        ]" />

        <div class="pdf-reader-container">
            <!-- Fullscreen button -->
            @if($product->pdf_file)
                <button id="openFullscreenBtn" class="btn btn-primary fullscreen-toggle-btn">
                    <i class="fa-solid fa-expand"></i> Volledig scherm
                </button>
            @endif

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
                    <a href="{{ route('productShow', $product->slug) }}" class="btn btn-primary view-product">
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
            const pdfUrl = "{{ route('pdf.proxy', ['path' => $product->pdf_file]) }}";
            const storageKey = 'pdf_last_page_{{ $product->id }}';

            // Shared variable voor huidige pagina (toegankelijk voor modal script)
            window.currentPdfPage = 1;

            // Ophalen laatst gelezen pagina
            const savedPage = localStorage.getItem(storageKey);
            const startPage = savedPage ? parseInt(savedPage) : 1;
            window.currentPdfPage = startPage;

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

            // Opslaan huidige pagina elke 2 seconden EN update window.currentPdfPage
            setInterval(function() {
                try {
                    const iframeWindow = pdfViewer.contentWindow;
                    if (iframeWindow?.PDFViewerApplication?.pdfViewer) {
                        const currentPage = iframeWindow.PDFViewerApplication.pdfViewer.currentPageNumber;
                        if (currentPage) {
                            window.currentPdfPage = currentPage;
                            localStorage.setItem(storageKey, currentPage);
                        }
                    }
                } catch (e) {
                    const pageMatch = pdfViewer.src.match(/[#&]page=(\d+)/);
                    if (pageMatch?.[1]) {
                        window.currentPdfPage = parseInt(pageMatch[1]);
                        localStorage.setItem(storageKey, pageMatch[1]);
                    }
                }
            }, 2000);
        });
    </script>
    @endif

    {{-- Fullscreen Modal Popup --}}
    @if($product->pdf_file)
    <div id="fullscreenModal" class="fullscreen-modal">
        <div class="fullscreen-modal-content">
            <button id="closeFullscreenBtn" class="fullscreen-close-btn" title="Sluiten">
                <i class="fa-solid fa-xmark"></i>
            </button>
            <iframe
                id="pdf-viewer-fullscreen"
                class="pdf-iframe-fullscreen"
                title="{{ $product->title }}"
                frameborder="0"
                allowfullscreen>
            </iframe>
        </div>
    </div>

    <style>
        .btn.btn-primary:hover {
            background: var(--green-2);
            transform: none;
            box-shadow: none;
        }

        .btn.btn-primary.view-product:hover {
            background: #ece5c2;
            border-color: #ece5c2;
            transform: translateY(-2px);
            box-shadow: 0 6px 16px rgba(0, 0, 0, 0.3);
        }

        /* Fullscreen toggle button */
        .fullscreen-toggle-btn {
            margin-bottom: 1rem;
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
        }

        /* Fullscreen Modal */
        .fullscreen-modal {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.95);
            z-index: 9999;
            animation: fadeIn 0.3s ease;
        }

        .fa-expand {
            color: #fff;
        }

        .fullscreen-modal.active {
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .fullscreen-modal-content {
            position: relative;
            width: 100%;
            height: 100%;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        /* Close button */
        .fullscreen-close-btn {
            position: absolute;
            top: 20px;
            right: 20px;
            background-color: rgba(255, 255, 255, 0.9);
            border: none;
            border-radius: 50%;
            width: 50px;
            height: 50px;
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

        /* PDF iframe in fullscreen */
        .pdf-iframe-fullscreen {
            width: 95%;
            height: 95%;
            border: none;
            background: white;
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.5);
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
            }
            to {
                opacity: 1;
            }
        }

        /* Responsive */
        @media (max-width: 768px) {
            .pdf-iframe-fullscreen {
                width: 100%;
                height: 100%;
            }

            .fullscreen-close-btn {
                top: 0px;
                right: 100px;
                width: 30px;
                height: 30px;
                font-size: 20px;
            }
        }
    </style>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const openBtn = document.getElementById('openFullscreenBtn');
            const closeBtn = document.getElementById('closeFullscreenBtn');
            const modal = document.getElementById('fullscreenModal');
            const fullscreenIframe = document.getElementById('pdf-viewer-fullscreen');
            const normalIframe = document.getElementById('pdf-viewer');
            const pdfContainer = document.getElementById('pdf-container');
            const storageKey = 'pdf_last_page_{{ $product->id }}';

            let lastKnownPage = 1;
            let currentPageInModal = 1;
            let pageCheckInterval = null;

            if (!openBtn || !modal || !fullscreenIframe) return;

            function detectPageNumber() {
                if (!modal.classList.contains('active')) return;

                try {
                    // Direct access to PDFViewerApplication
                    const iframeWindow = fullscreenIframe.contentWindow;
                    if (iframeWindow?.PDFViewerApplication?.pdfViewer) {
                        const currentPage = iframeWindow.PDFViewerApplication.pdfViewer.currentPageNumber;

                        if (currentPage && currentPage !== currentPageInModal) {
                            currentPageInModal = currentPage;
                            lastKnownPage = currentPageInModal;
                            localStorage.setItem(storageKey, currentPageInModal);
                            console.log('📄 Huidige pagina in modal:', currentPageInModal);
                        }
                        return;
                    }
                } catch (e) {
                    // Fallback to URL detection
                    const pageMatch = fullscreenIframe.src.match(/[#&]page=(\d+)/);
                    if (pageMatch?.[1]) {
                        const urlPage = parseInt(pageMatch[1]);
                        if (urlPage !== currentPageInModal) {
                            currentPageInModal = urlPage;
                            lastKnownPage = currentPageInModal;
                            localStorage.setItem(storageKey, currentPageInModal);
                            console.log('📄 Pagina gedetecteerd via URL:', currentPageInModal);
                        }
                    }
                }
            }

            function startPageDetection() {
                pageCheckInterval = setInterval(detectPageNumber, 200);
            }

            function stopPageDetection() {
                if (pageCheckInterval) {
                    clearInterval(pageCheckInterval);
                    pageCheckInterval = null;
                }
            }

            function openModal() {
                // Gebruik window.currentPdfPage voor meest actuele pagina
                lastKnownPage = window.currentPdfPage || 1;
                currentPageInModal = lastKnownPage;

                console.log('🚀 Opening modal op pagina:', lastKnownPage);

                // Build URL met huidige pagina
                const baseUrl = normalIframe.src.split('#')[0].split('?')[0];
                const fileParam = normalIframe.src.match(/\?file=([^#]+)/);

                if (fileParam) {
                    const modalUrl = `${baseUrl}?file=${fileParam[1]}#page=${lastKnownPage}`;
                    fullscreenIframe.src = modalUrl;
                } else {
                    fullscreenIframe.src = normalIframe.src;
                }

                modal.classList.add('active');
                document.body.style.overflow = 'hidden';

                if (pdfContainer) pdfContainer.style.display = 'none';

                startPageDetection();
            }

            function closeModal() {
                console.log('✅ Modal sluiten - laatste pagina:', lastKnownPage);

                // Update window.currentPdfPage zodat normale viewer de juiste pagina heeft
                window.currentPdfPage = lastKnownPage;

                stopPageDetection();
                modal.classList.remove('active');
                document.body.style.overflow = '';

                if (pdfContainer) pdfContainer.style.display = 'block';

                // Reload normal iframe with last known page
                if (normalIframe && lastKnownPage > 0) {
                    const baseUrl = normalIframe.src.split('#')[0].split('?')[0];
                    const fileParam = normalIframe.src.match(/\?file=([^#]+)/);

                    if (fileParam) {
                        const newUrl = `${baseUrl}?file=${fileParam[1]}#page=${lastKnownPage}`;
                        console.log('🔄 Normale viewer herladen naar pagina:', lastKnownPage);

                        normalIframe.src = '';
                        setTimeout(() => normalIframe.src = newUrl, 100);
                    }
                }

                setTimeout(() => fullscreenIframe.src = '', 500);
            }

            openBtn.addEventListener('click', openModal);
            closeBtn.addEventListener('click', closeModal);

            document.addEventListener('keydown', (e) => {
                if (e.key === 'Escape' && modal.classList.contains('active')) {
                    closeModal();
                }
            });

            modal.addEventListener('click', (e) => {
                if (e.target === modal) closeModal();
            });
        });
    </script>
    @endif


    <div class="gradient-border"></div>
    <x-footer></x-footer>
</x-layout>
