<x-layout>
    <main class="page home">

        <div class="hero-bg-wrapper">

                <section class="home-hero">

                    <div class="book-image">
                        <img class="book-shot" src="{{ asset('images/books_composiet.png') }}" alt="">
                    </div>

                    <div class="clock-image">

                        <div class="hero-section" style="position: relative; overflow: visible;">
                            <img class="hero-bg-img" src="{{ asset('images/sun_clock_new_4.png') }}" alt="" style="position: absolute; left: 47%; top: 53%; transform: translate(-50%, -50%); width: 190%; height: auto; pointer-events: none; z-index: -1;">

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
                            <div class="layer layer-ring">
{{--                                <img src="{{ asset('images/clockassets/clockeffect_2.png') }}" alt="">--}}
                            </div>

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
        </div>

            <section class="home intro-section">
                <div class="text-container">
                    <h2 class="title">Welkom op Lucide Inkt</h2>
                    <div class="sub-text">
                        <p>
                            Lucide Inkt is een non-profit organisatie toegewijd aan de vertaling en publicatie van de <em>Risale-i Nur</em>, in het Nederlands en Engels. Wij brengen deze betekenisvolle werken uit om geloofswaarheden helder en toegankelijk te maken.
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
                            Waarlijk, dit voortrazende leven is een diepe slaap; het vloeit als een droom voorbij… Maar wees beraden, want de vluchtige minuten des levens dienen als zaden. Terwijl ze ogenschijnlijk verwelken en vergaan tijdens dit aardse bestaan, ontkiemen en floreren ze in het rijk der eeuwigheid. Afhankelijk van de wijze waarop ze verstrijken, zullen ze ofwel als duistere voortbrengselen van onachtzaamheid, ofwel als stralende vruchten van weldaden tot de mens wederkeren.
                        </p>
                    </div>
                </div>
            </div>

        <!-- Include clock script at the end of the file so it can auto-init -->
        <script src="{{ asset('js/clock.js') }}"></script>

    </main>
</x-layout>
