<x-layout>
    <main class="page home">

        <div class="hero-bg-wrapper" style="background-image: url('{{ asset('images/006_background_new.webp') }}');">

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
            <div class="text-container">
{{--                <h2 class="title">Welkom op L<span class="title-u"></span>cide In<span class="title-k"></span>t</h2>--}}
                {{--                <h2 class="title">Welkom op Lucide Inkt</h2> --}}
                <div class="sub-text">
                    <p>
                        Lucide Inkt is een non-profit organisatie toegewijd aan het verlenen van diensten volgens de
                        Qur'anische richtlijen van de Risale-i Nur. Met Nederlandse en Engelse vertalingen van deze
                        boekenreeks streven wij ernaar zoekers te voorzien van antwoorden op de belangrijkste
                        bestaansvragen van de mens.
                    </p>
                </div>
            </div>
        </section>

        <div class="gradient-border"></div>


        <section class="colored-section">
            <div class="container new-translation">
                <div class="title-wrapper">
                    <img class="rose-decoration" src="{{ asset('images/Rose1.webp') }}" alt="">
                    <h2 class="title">Onze Nieuwste Vertaling:<br><span class="title-h"></span>et <span
                            class="title-t"></span><span class="title-r"></span>akta<span class="title-a-one"></span>t
                        ov<span class="title-e-r"></span> de Herza<span class="title-me"></span>l<span
                            class="title-in"></span>g</h2>
                </div>
                <div class="divider"></div>
                <div class="sub-text">
                    <p>
                        Is de mens op deze rusteloze wereld gekomen om in een waan van aards geluk een ellendig leven te
                        leiden en vervolgens voorgoed te verdwijnen? Of schuilt er meer achter zijn bestaan dan alleen
                        het aardse, waarin zijn menselijke potenties nooit volwaardig tot hun recht kunnen komen?
                        Definitieve antwoorden op zulke cruciale bestaansvragen zijn te vinden in dit waardevolle werk.
                    </p>
                </div>
                <div class="home-book-grid">
                    <div class="book one">
                        <img src="{{ asset('images/books/herzameling/NederlandsHerzameling.webp') }}" alt="">
                        <p class="under-text">- Nederlands -</p>
                        <a href="#">
                            <button class="btn">Bekijken</button>
                        </a>
                    </div>
                    <div class="book two">
                        <img src="{{ asset('images/books/herzameling/TurksNederlandsHerzameling.webp') }}"
                            alt="">
                        <p class="under-text">- Nederlands & Turks -</p>
                        <a href="#">
                            <button class="btn">Bekijken</button>
                        </a>
                    </div>
                    <div class="book three">
                        <img src="{{ asset('images/books/herzameling/EngelsHerzameling.webp') }}" alt="">
                        <p class="under-text">- Engels -</p>
                        <a href="#">
                            <button class="btn">Bekijken</button>
                        </a>
                    </div>
                    <div class="book four">
                        <img src="{{ asset('images/books/herzameling/TurksEngelsHerzameling.webp') }}" alt="">
                        <p class="under-text">- Engels & Turks -</p>
                        <a href="#">
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
                    <h2 class="title">Wat is de Risale-i Nur?</h2>
                    <div class="sub-text">
                        <p>
                            Tafsirs zijn Qur'anexegeses die in twee categorieën worden onderscheiden: de letterlijke en
                            de spirituele. Bij de bekende, letterlijke Tafsirs worden Qur'anische verzen aangehaald,
                            waarna de betekenissen van de woorden en zinnen met bewijzen worden toegelicht. Bij de
                            tweede, spirituele Tafsirs worden Qur'anische geloofswaarheden met krachtige redeneringen
                            aan het licht gebracht, beargumenteerd en ontvouwd. Hoewel deze tweede soort van eminent
                            belang is, wordt ze in de letterlijke Tafsirs soms slechts ter aanvulling beknopt opgenomen.
                            De Risale-i Nur daarentegen heeft direct deze tweede benadering als grondslag genomen.
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
                    <h2 class="title">Wie is Said Nursi?</h2>
                    <div class="sub-text">
                        <p>
                            Tafsirs zijn Qur'anexegeses die in twee categorieën worden onderscheiden: de letterlijke en
                            de spirituele. Bij de bekende, letterlijke Tafsirs worden Qur'anische verzen aangehaald,
                            waarna de betekenissen van de woorden en zinnen met bewijzen worden toegelicht. Bij de
                            tweede, spirituele Tafsirs worden Qur'anische geloofswaarheden met krachtige redeneringen
                            aan het licht gebracht, beargumenteerd en ontvouwd. Hoewel deze tweede soort van eminent
                            belang is, wordt ze in de letterlijke Tafsirs soms slechts ter aanvulling beknopt opgenomen.
                            De Risale-i Nur daarentegen heeft direct deze tweede benadering als grondslag genomen.
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
                    <h2 class="title newsletter-title">Schrijf je in voor onze Niewsbrief</h2>
                    <p class="newsletter-description">
                        Ontvang updates over nieuwe vertalingen, inspirerende citaten en belangrijke aankondigingen van
                        Lucide Inkt.
                    </p>
                    <form class="newsletter-form" action="#" method="POST">
                        @csrf
                        <div class="newsletter-input-group">
                            <input type="email" name="email" placeholder="Uw e-mailadres" required
                                class="newsletter-input">
                            <button type="submit" class="newsletter-btn">
                                <span>Aanmelden</span>
                                <i class="fa-solid fa-paper-plane"></i>
                            </button>
                        </div>
                        <p class="newsletter-privacy">
                            We respecteren uw privacy. U kunt zich op elk moment afmelden.
                        </p>
                    </form>
                </div>
            </div>
        </section>

        <div class="gradient-border"></div>

        <x-footer></x-footer>

        <div class="gradient-border"></div>

        <script>
            document.addEventListener('DOMContentLoaded', function() {
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
            });
        </script>

        <!-- Modal Structure -->
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

    </main>
</x-layout>
