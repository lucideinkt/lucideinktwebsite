<section class="white-section footer-section">
    <div class="container footer-container">
        <div class="footer-grid">
            <!-- Column 1: Over Lucide Inkt -->
            <div class="footer-column">
                <h3 class="footer-title">Over Lucide Inkt</h3>
                <p class="footer-description">
                    Een non-profit organisatie toegewijd aan het verspreiden van de Risale-i Nur door middel van Nederlandse en Engelse vertalingen.
                </p>
                <p style="font-weight: 500;font-size: 14px;margin-bottom: 5px;">
                    <strong>In samenwerking met</strong>
                </p>
                <div class="sozler-grid">
                    <h4 class="sozler-logo">
                       Sözler
                    </h4>
                    <p class="sozler-nesriyat">Neşriyat</p>
                </div>
{{--                <div class="footer-social">--}}
{{--                    <a href="mailto:info@lucideinkt.nl" aria-label="Email"><i class="fa-solid fa-envelope"></i></a>--}}
{{--                </div>--}}
                <img src="" alt="">
            </div>

            <!-- Column 3: Informatie -->
            <div class="footer-column">
                <h3 class="footer-title">Informatie</h3>
                <ul class="footer-links">
                    <li><a href="#">Verzending & Levering</a></li>
                    <li><a href="#">Algemene Voorwaarden</a></li>
                    <li><a href="#">Privacybeleid</a></li>
                    <li><a href="#">Retourbeleid</a></li>
                    <li><a href="#">Veelgestelde Vragen</a></li>
                </ul>
            </div>

            <!-- Column 2: Snelle Links -->
            <div class="footer-column">
                <h3 class="footer-title">Snelle Links</h3>
                <ul class="footer-links">
                    <li><a href="{{ route('home') }}">Home</a></li>
                    <li><a href="{{ route('shop') }}">Winkel</a></li>
                    <li><a href="{{ route('saidnursi') }}">Said Nursi</a></li>
                    <li><a href="{{ route('risale') }}">De Risale-i Nur</a></li>
                    <li><a href="{{ route('onlineLezen') }}">Online Lezen</a></li>
                    <li><a href="{{ route('contact') }}">Contact</a></li>
                </ul>
            </div>

            <!-- Column 4: Contact -->
            <div class="footer-column">
                <h3 class="footer-title">Contact</h3>
                <ul class="footer-contact">
                    <li>
                        <i class="fa-solid fa-location-dot"></i>
                        <span>Nederland</span>
                    </li>
                    <li>
                        <i class="fa-solid fa-envelope"></i>
                        <span>info@lucideinkt.nl</span>
                    </li>
                </ul>
            </div>

        </div>

        <!-- Footer Bottom -->
        <div class="footer-bottom">
            <p>&copy; {{ date('Y') }} Lucide Inkt. Alle rechten voorbehouden.</p>
        </div>
    </div>
</section>
