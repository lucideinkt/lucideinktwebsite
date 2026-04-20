{{-- =========================================================
     Cookie Consent Banner – AVG/GDPR compliant
     Categories: necessary (always on), analytics, marketing
     Consent stored in cookie "cookie_consent" for 365 days
     ========================================================= --}}

{{-- ── Banner ──────────────────────────────────────────────── --}}
<div id="cookie-banner" class="cookie-banner--hidden" role="dialog" aria-live="polite" aria-label="Cookievoorkeur">
    <div class="cookie-banner__text">
        <strong><i class="fa-solid fa-cookie-bite"></i> Wij gebruiken cookies</strong>
        Wij gebruiken cookies om uw ervaring te verbeteren en onze website te analyseren.
        Lees ons <a href="{{ route('privacybeleid') }}">privacybeleid</a> voor meer informatie.
    </div>
    <div class="cookie-banner__actions">
        <button class="cookie-btn cookie-btn--accept" id="cookie-accept-all">Alles accepteren</button>
        <button class="cookie-btn cookie-btn--reject" id="cookie-reject">Alleen noodzakelijk</button>
        <button class="cookie-btn cookie-btn--settings" id="cookie-open-settings">Voorkeuren instellen</button>
    </div>
</div>

{{-- ── Preferences modal ───────────────────────────────────── --}}
<div id="cookie-modal-overlay" class="cookie-modal--hidden" role="dialog" aria-modal="true" aria-label="Cookievoorkeuren">
    <div id="cookie-modal">
        <div class="cookie-modal__title"><i class="fa-solid fa-sliders"></i> Cookievoorkeuren</div>
        <p class="cookie-modal__subtitle">
            Kies welke cookies u toestaat. U kunt uw keuze op elk moment aanpassen.
            Meer informatie vindt u in ons <a href="{{ route('privacybeleid') }}">privacybeleid</a>.
        </p>

        {{-- Necessary (always on) --}}
        <div class="cookie-category">
            <div class="cookie-category__info">
                <div class="cookie-category__name">Noodzakelijke cookies <small style="font-size:11px;opacity:.6;">(altijd aan)</small></div>
                <div class="cookie-category__desc">Vereist voor het functioneren van de website: winkelwagen, sessie, beveiliging.</div>
            </div>
            <label class="cookie-toggle">
                <input type="checkbox" checked disabled>
                <span class="cookie-toggle__slider"></span>
            </label>
        </div>

        {{-- Analytics --}}
        <div class="cookie-category">
            <div class="cookie-category__info">
                <div class="cookie-category__name">Analytische cookies</div>
                <div class="cookie-category__desc">Helpen ons begrijpen hoe bezoekers de website gebruiken (bijv. Google Analytics). Gegevens zijn geanonimiseerd.</div>
            </div>
            <label class="cookie-toggle">
                <input type="checkbox" id="cookie-pref-analytics">
                <span class="cookie-toggle__slider"></span>
            </label>
        </div>

        {{-- Marketing --}}
        <div class="cookie-category">
            <div class="cookie-category__info">
                <div class="cookie-category__name">Marketingcookies</div>
                <div class="cookie-category__desc">Worden gebruikt om advertenties relevanter te maken voor u en uw interesses.</div>
            </div>
            <label class="cookie-toggle">
                <input type="checkbox" id="cookie-pref-marketing">
                <span class="cookie-toggle__slider"></span>
            </label>
        </div>

        <div class="cookie-modal__actions">
            <button class="cookie-btn cookie-btn--reject" id="cookie-modal-reject">Alleen noodzakelijk</button>
            <button class="cookie-btn cookie-btn--accept" id="cookie-modal-save">Opslaan &amp; sluiten</button>
        </div>
    </div>
</div>

{{-- ── Re-open trigger (hidden – footer link is used instead) ── --}}
<button id="cookie-settings-trigger" aria-label="Cookievoorkeuren aanpassen" style="display:none;" aria-hidden="true"></button>

<script>
(function () {
    'use strict';

    const COOKIE_NAME = 'cookie_consent';
    const COOKIE_DAYS = 365;

    // ── Registered callbacks per category ────────────────────
    // Other scripts can register via:
    //   window.CookieConsent.on('analytics', function() { /* load GA */ });
    //   window.CookieConsent.on('marketing', function() { /* load Meta pixel */ });
    var _callbacks = { analytics: [], marketing: [] };
    var _ran       = { analytics: false, marketing: false };

    // ── Public API ───────────────────────────────────────────
    window.CookieConsent = {
        /**
         * Register a callback to run when/if a category is accepted.
         * If consent was already given before this call, it runs immediately.
         *
         * Usage:
         *   window.CookieConsent.on('analytics', function() {
         *       // load Google Analytics here
         *   });
         */
        on: function (category, fn) {
            if (!_callbacks[category]) return;
            _callbacks[category].push(fn);
            // If already accepted, run immediately
            if (_ran[category]) fn();
        },

        /** Read the current stored consent object (or null) */
        get: function () {
            return getCookie(COOKIE_NAME);
        },

        /** Check a single category */
        allowed: function (category) {
            var c = getCookie(COOKIE_NAME);
            return c ? !!c[category] : false;
        }
    };

    // ── Helpers ──────────────────────────────────────────────
    function setCookie(name, value, days) {
        var expires = new Date(Date.now() + days * 864e5).toUTCString();
        document.cookie = name + '=' + encodeURIComponent(JSON.stringify(value))
            + '; expires=' + expires + '; path=/; SameSite=Lax';
    }

    function getCookie(name) {
        var match = document.cookie.match(new RegExp('(?:^|; )' + name + '=([^;]*)'));
        if (!match) return null;
        try { return JSON.parse(decodeURIComponent(match[1])); } catch(e) { return null; }
    }

    // ── Elements ─────────────────────────────────────────────
    var banner          = document.getElementById('cookie-banner');
    var overlay         = document.getElementById('cookie-modal-overlay');
    var trigger         = document.getElementById('cookie-settings-trigger');
    var analyticsToggle = document.getElementById('cookie-pref-analytics');
    var marketingToggle = document.getElementById('cookie-pref-marketing');

    // ── Show / hide banner ───────────────────────────────────
    function showBanner() {
        banner.classList.remove('cookie-banner--hidden');
    }

    function hideBanner() {
        banner.classList.add('cookie-banner--hidden');
    }

    // ── Show / hide modal ────────────────────────────────────
    function openModal() {
        var consent = getCookie(COOKIE_NAME);
        if (consent) {
            analyticsToggle.checked = !!consent.analytics;
            marketingToggle.checked = !!consent.marketing;
        }
        overlay.classList.remove('cookie-modal--hidden');
    }

    function closeModal() {
        overlay.classList.add('cookie-modal--hidden');
    }

    // ── Save consent ─────────────────────────────────────────
    function saveConsent(analytics, marketing) {
        setCookie(COOKIE_NAME, {
            necessary: true,
            analytics: analytics,
            marketing: marketing,
            timestamp: new Date().toISOString(),
            version: '1'
        }, COOKIE_DAYS);
        hideBanner();
        closeModal();
        applyConsent(analytics, marketing);
    }

    // ── Apply consent ────────────────────────────────────────
    function applyConsent(analytics, marketing) {
        // Fire registered callbacks for each accepted category (once only)
        ['analytics', 'marketing'].forEach(function (cat) {
            var accepted = cat === 'analytics' ? analytics : marketing;
            if (accepted && !_ran[cat]) {
                _ran[cat] = true;
                _callbacks[cat].forEach(function (fn) { try { fn(); } catch(e) {} });
            }
        });

        // Also dispatch the CustomEvent for any ad-hoc listeners
        window.dispatchEvent(new CustomEvent('cookieConsentUpdate', {
            detail: { necessary: true, analytics: analytics, marketing: marketing }
        }));
    }

    // ── Button handlers ──────────────────────────────────────
    document.getElementById('cookie-accept-all').addEventListener('click', function () {
        saveConsent(true, true);
    });

    document.getElementById('cookie-reject').addEventListener('click', function () {
        saveConsent(false, false);
    });

    document.getElementById('cookie-open-settings').addEventListener('click', function () {
        openModal();
    });

    document.getElementById('cookie-modal-reject').addEventListener('click', function () {
        saveConsent(false, false);
    });

    document.getElementById('cookie-modal-save').addEventListener('click', function () {
        saveConsent(analyticsToggle.checked, marketingToggle.checked);
    });

    trigger.addEventListener('click', function () {
        openModal();
    });

    // Footer link – open modal
    var footerLink = document.getElementById('footer-cookie-settings');
    if (footerLink) {
        footerLink.addEventListener('click', function (e) {
            e.preventDefault();
            openModal();
        });
    }

    // Close modal when clicking overlay backdrop
    overlay.addEventListener('click', function (e) {
        if (e.target === overlay) closeModal();
    });

    // Close modal on Escape key
    document.addEventListener('keydown', function (e) {
        if (e.key === 'Escape') closeModal();
    });

    // ── Init ─────────────────────────────────────────────────
    var existing = getCookie(COOKIE_NAME);
    if (existing) {
        hideBanner();
        applyConsent(existing.analytics, existing.marketing);
    } else {
        setTimeout(showBanner, 600);
    }
})();

/*
 * ═══════════════════════════════════════════════════════════
 *  HOE GOOGLE ANALYTICS (OF ANDERE SCRIPTS) TOEVOEGEN
 * ═══════════════════════════════════════════════════════════
 *
 *  Plak dit in een apart <script> blok in je layout, NADAT
 *  dit cookie-consent component is geladen:
 *
 *  window.CookieConsent.on('analytics', function () {
 *      // Vervang G-XXXXXXXXXX met jouw eigen GA4-meetId
 *      var s = document.createElement('script');
 *      s.async = true;
 *      s.src = 'https://www.googletagmanager.com/gtag/js?id=G-XXXXXXXXXX';
 *      document.head.appendChild(s);
 *      window.dataLayer = window.dataLayer || [];
 *      function gtag(){ dataLayer.push(arguments); }
 *      gtag('js', new Date());
 *      gtag('config', 'G-XXXXXXXXXX', { anonymize_ip: true });
 *  });
 *
 *  window.CookieConsent.on('marketing', function () {
 *      // Meta Pixel, TikTok Pixel, enz.
 *  });
 *
 *  Het systeem zorgt automatisch dat:
 *  - De callback NIET wordt uitgevoerd als de bezoeker weigert
 *  - De callback WEL direct wordt uitgevoerd als iemand al eerder
 *    toestemming heeft gegeven (herbezoek)
 *  - De callback wordt uitgevoerd zodra de bezoeker alsnog
 *    accepteert (zelfde sessie)
 * ═══════════════════════════════════════════════════════════
 */
</script>

