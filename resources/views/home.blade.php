<x-layout>
    <main class="page home">

        <div class="hero-bg-wrapper" style="background-image: url('{{ asset('images/011_background.webp') }}');">

            <section class="home-hero">
                <div class="clock-image">

                    <div class="hero-section" style="position: relative; overflow: visible;">
                        <img class="hero-bg-img" src="{{ asset('images/001_sun_clock_background.webp') }}" alt=""
                            style="position: absolute; left: 49%; top: 51.5%; transform: translate(-50%, -50%); width: 150%; height: auto; pointer-events: none; z-index: -1;">

                        <!-- Achterste laag: draaiende rotor -->
                        <div class="layer layer-rotor">
                            <img class="rotating-image" src="{{ asset('images/sun-ring-2.png') }}" alt="">
                        </div>

                        <!-- Middenlaag: text inside clock -->
                        <div class="text-clock">
                            <div class="text-lucideinkt">
                                <img src="{{ asset('images/bismillah_2.png') }}" alt="">
                            </div>
                            <div class="text-life-minutes">
                                <img src="{{ asset('images/life-minutes.png') }}" alt="">
                            </div>
                            <button class="clock-button" id="openModalBtn">Lees meer</button>
                        </div>

                        <!-- Bovenlaag: sier-ring -->
                        <!--
                            <div class="layer layer-ring">
                                <img src="{{ asset('images/clockeffect_2.png') }}" alt="">
                            </div>
                            -->

                        <!-- Voorste laag: CSS klok -->
                        <div class="layer layer-clock">
                            <div class="css-clock-wrapper">
                                <div class="css-clock">
                                    <div class="css-hour-hand"></div>
                                    <div class="css-minute-hand"></div>
                                    <div class="css-second-hand"></div>
                                    <div class="css-clock-center"></div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>

            </section>
        </div>
        <div class="gradient-border"></div>

        <section class="home white-section intro-section">
            <img class="moon-left" src="{{ asset('images/half_moon.webp') }}" alt="">
            <img class="moon-right" src="{{ asset('images/half_moon.webp') }}" alt="">

{{--            <img style="width: 100%;height: 50%" class="letters-stars" src="{{ asset('images/letters_stars.webp') }}" alt="">--}}

            <div class="text-container">
{{--                <h2 class="title">Welkom op L<span class="title-u"></span>cide In<span class="title-k"></span>t</h2>--}}
                {{--                <h2 class="title">Welkom op Lucide Inkt</h2> --}}
                <div class="sub-text one">
                    <p>Lucide Inkt is een non-profit organisatie, toegewijd aan het verlenen van</p>
                    <p>diensten volgens de Qur'anische richtlijen van de Risale-i Nur.</p>
                    <p>Met Nederlandse en Engelse vertalingen van deze boekenreeks</p>
                    <p>streven wij ernaar zoekers te voorzien van antwoorden</p>
                    <p>op de belangrijkste bestaansvragen van de mens.</p>
                    <button class="read-more-btn" onclick="openIntroModal()">
                        <span class="read-more-text">Meer informatie</span>
{{--                        <i class="fa-solid fa-arrow-right read-more-icon"></i>--}}
                    </button>
                </div>

                <div class="sub-text two">
                    <p>
                    Lucide Inkt is een non-profit organisatie, toegewijd aan het verlenen van diensten
                    volgens de Qur'anische richtlijen van de Risale-i Nur.
                    Met Nederlandse en Engelse vertalingen van deze boekenreeks
                    streven wij ernaar zoekers te voorzien van antwoorden
                    op de belangrijkste bestaansvragen van de mens.
                    </p>
                    <button class="read-more-btn" onclick="openIntroModal()">
                        <span class="read-more-text">Meer informatie</span>
                        {{--                        <i class="fa-solid fa-arrow-right read-more-icon"></i>--}}
                    </button>
                </div>
            </div>
        </section>


        <div class="gradient-border"></div>


        <section class="colored-section">
            <div class="container new-translation">
                <div class="title-wrapper">
                    <img class="rose-decoration" src="{{ asset('images/Rose1.webp') }}" alt="">
                    <h2 class="title trans">Onze Nieuwste Vertaling:<br><span class="title-h"></span>et <span
                            class="title-t"></span><span class="title-r"></span>akta<span class="title-a-one"></span>t
                        ov<span class="title-e-r"></span> de Herza<span class="title-me"></span>l<span
                            class="title-in"></span>g</h2>
                </div>
                <div class="divider"></div>
                <div class="sub-text one">
                        <p>Is de mens op deze rusteloze wereld gekomen om in een waan van aards geluk</p>
                        <p>een ellendig leven te leiden en vervolgens voorgoed te verdwijnen?</p>
                        <p>Of schuilt er meer achter zijn bestaan dan alleen het aardse,</p>
                        <p>waarin zijn menselijke potenties nooit volwaardig tot hun recht kunnen komen?</p>
                        <p>Definitieve antwoorden op zulke cruciale bestaansvragen zijn te vinden</p>
                        <p>in dit waardevolle werk.</p>
                </div>

                <div class="sub-text two">
                    Is de mens op deze rusteloze wereld gekomen om in een waan van aards geluk
                    een ellendig leven te leiden en vervolgens voorgoed te verdwijnen?
                    Of schuilt er meer achter zijn bestaan dan alleen het aardse,
                    waarin zijn menselijke potenties nooit volwaardig tot hun recht kunnen komen?
                    Definitieve antwoorden op zulke cruciale bestaansvragen zijn te vinden
                    in dit waardevolle werk.
                </div>

                <div class="home-book-grid">
                    <div class="book one">
                        <a href="{{ url('/winkel/product/het-traktaat-over-de-herzameling-nederlands-turks') }}">
                            <img src="{{ asset('images/books/herzameling/NederlandsHerzameling.webp') }}" alt="">
                        </a>
                        <p class="under-text">- Nederlands -</p>
                        <a href="{{ url('/winkel/product/het-traktaat-over-de-herzameling-nederlands') }}">
                            <button class="btn">Bekijken</button>
                        </a>
                    </div>
                    <div class="book two">
                        <a href="{{ url('/winkel/product/het-traktaat-over-de-herzameling-nederlands-turks') }}">
                        <img src="{{ asset('images/books/herzameling/TurksNederlandsHerzameling.webp') }}"
                            alt="">
                        </a>
                        <p class="under-text">- Nederlands & Turks -</p>
                        <a href="{{ url('/winkel/product/het-traktaat-over-de-herzameling-nederlands-turks') }}">
                            <button class="btn">Bekijken</button>
                        </a>
                    </div>

                    <img class="rose-patels" src="{{ asset('images/Petals2.webp') }}" alt="">

                    <div class="book three">
                        <a href="{{ url('/winkel/product/het-traktaat-over-de-herzameling-engels') }}">
                            <img src="{{ asset('images/books/herzameling/EngelsHerzameling.webp') }}" alt="">
                        </a>
                        <p class="under-text">- Engels -</p>
                        <a href="{{ url('/winkel/product/het-traktaat-over-de-herzameling-engels') }}">
                            <button class="btn">Bekijken</button>
                        </a>
                    </div>
                    <div class="book four">
                        <a href="{{ url('/winkel/product/het-traktaat-over-de-herzameling-engels-turks') }}">
                            <img src="{{ asset('images/books/herzameling/TurksEngelsHerzameling.webp') }}" alt="">
                        </a>
                        <p class="under-text">- Engels & Turks -</p>
                        <a href="{{ url('/winkel/product/het-traktaat-over-de-herzameling-engels-turks') }}">
                            <button class="btn">Bekijken</button>
                        </a>
                    </div>
                </div>
            </div>
        </section>

        <div class="gradient-border"></div>

        <section class="white-section risale-section">
            <div class="text-container risale-grid">
                <div class="risale-content">
                    <h2 class="title"><span class="risale-w"></span>at is de R<span class="risale-is"></span>ale-i <span class="risale-nu">r</span>?</h2>
                    <div class="sub-text">
                        <p>
                            Tafsirs zijn Qur’anexegeses die in twee categorieën worden onderscheiden: de letterlijke en de spirituele.

                            Bij de bekende, letterlijke Tafsirs worden Qur’anische verzen aangehaald, waarna de betekenissen van de woorden en zinnen met bewijzen worden toegelicht.

                            Bij de tweede, spirituele Tafsirs worden Qur’anische geloofswaarheden met krachtige redeneringen aan het licht gebracht, beargumenteerd en ontvouwd. Hoewel deze tweede soort van eminent belang is, wordt ze in de letterlijke Tafsirs soms slechts ter aanvulling beknopt opgenomen.
                        </p>
                        <a href="{{ route('risale') }}" class="read-more-link">
                            Lees meer <i class="fa-solid fa-arrow-right"></i>
                        </a>
                    </div>
                </div>
                <div class="risale-image">
                    <img src="{{ asset('images/books_standing_new.webp') }}" alt="Risale-i Nur">
                </div>
            </div>
        </section>

        <div class="gradient-border"></div>

        <section class="colored-section quotes-section">
            <div class="container quote-section">
                <div id="quotes-slider" class="splide">
                    <div class="splide__track">
                        <ul class="splide__list">
                            <li class="splide__slide">
                                <div class="quote-card">
                                    <div class="quote-icon">
                                        <i class="fa-solid fa-quote-left"></i>
                                    </div>
                                    <p class="quote-text">
                                        "Wanneer jij jouw weg en jouw opvattingen juist acht, dan heb jij het recht om:
                                        'Mijn weg is juist' of 'Mijn weg is beter' te zeggen. Jij hebt echter niet het
                                        recht om: 'Slechts mijn weg is juist' te zeggen."
                                    </p>
                                    <div class="quote-source">- Risale-i Nur</div>
                                </div>
                            </li>
                            <li class="splide__slide">
                                <div class="quote-card">
                                    <div class="quote-icon">
                                        <i class="fa-solid fa-quote-left"></i>
                                    </div>
                                    <p class="quote-text">
                                        "Aldus impliceert de uitvoering van het middaggebed dat de menselijke ziel zich
                                        verlost van die druk, losbreekt uit onachtzaamheid en ontsnapt van onbeduidende
                                        en voorbijgaande aangelegenheden."
                                    </p>
                                    <div class="quote-source">- Risale-i Nur</div>
                                </div>
                            </li>
                            <li class="splide__slide">
                                <div class="quote-card">
                                    <div class="quote-icon">
                                        <i class="fa-solid fa-quote-left"></i>
                                    </div>
                                    <p class="quote-text">
                                        "Als alles niet wordt geattribueerd aan de Majestueuze Almachtige, Die de Ene
                                        Individuele is, maar aan oorzaken wordt toegedicht, dan is de interventie van
                                        vele kosmische elementen en oorzaken voor de vorming van ieder schepsel een
                                        vereiste."
                                    </p>
                                    <div class="quote-source">- Risale-i Nur</div>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </section>

        <div class="gradient-border"></div>

        <section class="white-section risale-section said-nursi-section">
            <div class="text-container risale-grid">
                <div class="risale-image said-nursi-image">
                    <img src="{{ asset('images/said_nursi_sharp.jpg') }}" alt="Said Nursi">
                </div>
                <div class="risale-content">
                    <h2 class="title"><span class="said-title-w"></span>ie is <span class="said-title-s"></span>aid N<span class="said-title-ur"></span>sî?</h2>
                    <div class="sub-text">
                        <p>
                            Om het geloof van de gemeenschap in veiligheid te brengen, heb ik op dat pad ook mijn hiernamaals opgeofferd. In mijn ogen bestaat er noch liefde voor het paradijs, noch vrees voor de hel. Namens het geloof van niet alleen de Turkse gemeenschap van 25 miljoen, maar van de gehele Islamitische gemeenschap van honderden miljoenen mensen, mogen niet één, maar duizend Saids opgeofferd worden. Als onze Qur’an op aarde zonder volgers achterblijft, dan verlang ik ook niet naar het paradijs; ook daar zal het dan een gevangenis voor mij zijn. Als ik zou zien dat het geloof van mijn volk is veiliggesteld, dan ben ik bereid om in de vlammen van de hel te branden. Want terwijl mijn lichaam dan knettert in het vuur, zal in mijn hart een rozentuin van gelukzaligheid ontbloeien.
                        </p>
                        <a href="{{ route('saidnursi') }}" class="read-more-link">
                            Lees meer <i class="fa-solid fa-arrow-right"></i>
                        </a>
                    </div>
                </div>
            </div>
        </section>

        <div class="gradient-border"></div>

        <section class="colored-section newsletter-section">
            <div class="container newsletter-container">
                <div class="newsletter-content">
                    <h2 class="title newsletter-title">Schrijf je in voor onze Nieuwsbrief</h2>
                    <p class="newsletter-description">
                        Ontvang updates over nieuwe vertalingen, inspirerende citaten en belangrijke aankondigingen van
                        Lucide Inkt.
                    </p>

                    <livewire:newsletter-form />
                </div>
            </div>
        </section>

        <div class="gradient-border"></div>

        <x-footer></x-footer>

        <div class="gradient-border"></div>

        <script>
            // Intro Modal Functions - MUST be global for onclick to work
            function openIntroModal() {
                const introModal = document.getElementById('introModal');
                const introContent = document.getElementById('introModalContent');

                if (introModal && introContent) {
                    introModal.classList.remove('hidden');
                    void introModal.offsetWidth;
                    introModal.classList.add('show');
                    introModal.classList.remove('fading-out');
                    introContent.classList.remove('close');
                    setTimeout(() => introContent.classList.add('open'), 10);
                }
            }

            function closeIntroModal() {
                const introModal = document.getElementById('introModal');
                const introContent = document.getElementById('introModalContent');

                if (introModal && introContent) {
                    introContent.classList.remove('open');
                    introContent.classList.add('close');
                    introModal.classList.add('fading-out');
                    introModal.classList.remove('show');

                    setTimeout(() => {
                        introModal.classList.add('hidden');
                        introModal.classList.remove('fading-out');
                        introContent.classList.remove('close');
                    }, 1100);
                }
            }

            document.addEventListener('DOMContentLoaded', function() {
                // Quotes Slider
                const quotesSlider = document.getElementById('quotes-slider');
                if (quotesSlider && typeof Splide !== 'undefined') {
                    new Splide('#quotes-slider', {
                        type: 'loop',
                        autoplay: true,
                        interval: 5000,
                        speed: 800,
                        pauseOnHover: true,
                        pauseOnFocus: true,
                        arrows: true,
                        pagination: false,
                        perPage: 1,
                        gap: '2rem',
                        breakpoints: {
                            768: {
                                arrows: false,
                            }
                        }
                    }).mount();
                }

                // Add event listeners for close button and overlay
                const closeBtn = document.getElementById('closeIntroModalBtn');
                const introModal = document.getElementById('introModal');

                if (closeBtn) {
                    closeBtn.addEventListener('click', closeIntroModal);
                }

                if (introModal) {
                    window.addEventListener('click', (event) => {
                        if (event.target === introModal || event.target.classList.contains('custom-modal-overlay')) {
                            if (introModal.classList.contains('show')) {
                                closeIntroModal();
                            }
                        }
                    });

                    window.addEventListener('keydown', (event) => {
                        if (event.key === 'Escape' && introModal.classList.contains('show')) {
                            closeIntroModal();
                        }
                    });
                }
            });
        </script>

        <!-- Clock Modal Structure -->
        <div id="leesMeerModal" class="custom-modal">
            <div class="custom-modal-overlay"></div>
            <div class="custom-modal-content scroll-effect" id="scrollModalContent">
                <span class="custom-modal-close" id="closeModalBtn">&times;</span>
                <div class="scroll-inner">
                    <p>
                        Waarlijk, dit voortrazende leven is een diepe slaap; het vloeit als een droom voorbij… Maar wees
                        beraden, want de vluchtige minuten des levens dienen als zaden. Terwijl ze ogenschijnlijk
                        verwelken en vergaan tijdens dit aardse bestaan, ontkiemen en floreren ze in het rijk der
                        eeuwigheid. Afhankelijk van de wijze waarop ze verstrijken, zullen ze ofwel als duistere
                        voortbrengselen van onachtzaamheid, ofwel als stralende vruchten van weldaden tot de mens
                        wederkeren..
                    </p>
                </div>
            </div>
        </div>

        <!-- Intro Modal Structure -->
        <div id="introModal" class="custom-modal hidden">
            <div class="custom-modal-overlay"></div>
            <div class="custom-modal-content scroll-effect" id="introModalContent">
                <span class="custom-modal-close" id="closeIntroModalBtn">&times;</span>
                <div class="scroll-inner">
                    <p>
                        Lucide Inkt is een non-profit organisatie,
                        toegewijd aan het verlenen van diensten
                        volgens de Qur'anische richtlijen
                        van de Risale-i Nur.
                        Met Nederlandse en Engelse
                        vertalingen van deze boekenreeks
                        streven wij ernaar zoekers te voorzien
                        van antwoorden op de belangrijkste
                        bestaansvragen van de mens.
                    </p>
                    <p>
                        Omdat de mens geschapen is voor de oneindige eeuwigheid, schuilt zijn diepste behoefte in de antwoorden op geloofsvragen die zijn eeuwige hiernamaals aanbelangen. In een tijd waarin geloofswaarheden zoals nooit tevoren bespot en verloochend worden, biedt de Risale-i Nur zulke krachtige traktaten ten bewijze van die waarheden, dat geen enkele tegenspraak ze ooit nog tot wankelen kan brengen. Tevens wordt in deze boekenreeks beschreven hoe Godsdienstigheid op de Godgevalligste wijze rechtzinnig kan worden betracht.
                    </p>
                    <p style="margin-bottom: 0">
                        Met zulke essentiële elementen voor ogen bestaat het uiteindelijke doel van Lucide Inkt uit dienstverlening volgens de principes van de Risale-i Nur, in overeenstemming met de scheppingsreden van onze Heer; opdat wij Zijn Tevredenheid mogen verwerven en zoveel mogelijk broeders en zusters mogen bijstaan op hun levensweg — die insha’ALLAH zal uitmonden in eeuwige gelukzaligheid.
                    </p>
                </div>
            </div>
        </div>

    </main>
</x-layout>
