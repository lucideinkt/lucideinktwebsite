<x-layout>
    <main class="page home">

        <div class="hero-bg-wrapper">

            <section class="home-hero">

                <div class="book-image">
                    <img class="book-shot" src="{{ asset('images/banner_hero_with_buttherfly.png') }}" alt="">
                </div>

                <div class="clock-image">

                    <div class="hero-section" style="position: relative; overflow: visible;">
                        <img class="hero-bg-img" src="{{ asset('images/sun_clock_new_4.png') }}" alt=""
                             style="position: absolute; left: 47%; top: 53%; transform: translate(-50%, -50%); width: 190%; height: auto; pointer-events: none; z-index: -1;">

                        <!-- Achterste laag: draaiende rotor -->
                        <div class="layer layer-rotor">
                            <img class="rotating-image" src="{{ asset('images/sun-flare-transparant.png') }}" alt="">
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
        <section class="home intro-section">
            <div class="text-container">
                <h2 class="title">Welkom op L<span class="title-u"></span>cide In<span class="title-k"></span>t</h2>
                <div class="sub-text">
                    <p>
                        Lucide Inkt is een non-profit organisatie toegewijd aan het verlenen van diensten volgens de Qur'anische richtlijen van de Risale-i Nur. Met Nederlandse en Engelse vertalingen van deze boekenreeks streven wij ernaar zoekers te voorzien van antwoorden op de belangrijkste bestaansvragen van de mens.
                    </p>
                </div>
            </div>
        </section>

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
