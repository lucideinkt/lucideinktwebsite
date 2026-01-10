<section class="white-section footer-section">
    <div class="container footer-container">
        <div class="footer-grid">
            <!-- Column 1: Over Lucide Inkt -->
            <div class="footer-column">
                <h3 class="footer-title">Over Lucide Inkt</h3>
                <p class="footer-description">
                    Een non-profit organisatie toegewijd aan het verspreiden van de Risale-i Nur door middel van Nederlandse en Engelse vertalingen.
                </p>
                <div class="footer-social">
                    <a href="#" aria-label="Facebook"><i class="fa-brands fa-facebook"></i></a>
                    <a href="#" aria-label="Instagram"><i class="fa-brands fa-instagram"></i></a>
                    <a href="#" aria-label="YouTube"><i class="fa-brands fa-youtube"></i></a>
                    <a href="#" aria-label="Email"><i class="fa-solid fa-envelope"></i></a>
                </div>
            </div>

            <!-- Column 2: Snelle Links -->
            <div class="footer-column">
                <h3 class="footer-title">Snelle Links</h3>
                <ul class="footer-links">
                    <li><a href="{{ route('home') }}">Home</a></li>
                    <li><a href="{{ route('shop') }}">Winkel</a></li>
                    <li><a href="#">Over Ons</a></li>
                    <li><a href="#">De Risale-i Nur</a></li>
                    <li><a href="#">Contact</a></li>
                </ul>
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

            <!-- Column 4: Contact -->
            <div class="footer-column">
                <h3 class="footer-title">Contact</h3>
                <ul class="footer-contact">
                    <li>
                        <i class="fa-solid fa-location-dot"></i>
                        <span>Nederland</span>
                    </li>
                    <li>
                        <i class="fa-solid fa-phone"></i>
                        <span>+31 (0)6 123 4567</span>
                    </li>
                    <li>
                        <i class="fa-solid fa-envelope"></i>
                        <span>info@lucideinkt.nl</span>
                    </li>
                    <li>
                        <i class="fa-solid fa-clock"></i>
                        <span>Ma-Vr: 9:00 - 17:00</span>
                    </li>
                </ul>
            </div>
        </div>

        <!-- Footer Bottom -->
        <div class="footer-bottom">
            <p>&copy; {{ date('Y') }} Lucide Inkt. Alle rechten voorbehouden.</p>
            <p class="footer-tagline">Verlichtend inzicht door de Risale-i Nur</p>
        </div>
    </div>
</section>
