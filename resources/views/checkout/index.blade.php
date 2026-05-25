<x-layout :seo-data="$SEOData">
    @push('head')
        @if(config('services.google.maps_api_key'))
        <script src="https://maps.googleapis.com/maps/api/js?key={{ config('services.google.maps_api_key') }}&libraries=places&callback=initAddressAutocomplete&loading=async" async defer></script>
        @endif
        <style>
            /* Suppress browser autofill blue/yellow background on all checkout inputs */
            .checkout input:-webkit-autofill,
            .checkout input:-webkit-autofill:hover,
            .checkout input:-webkit-autofill:focus,
            .checkout input:-webkit-autofill:active {
                -webkit-box-shadow: 0 0 0px 1000px #ffffff inset !important;
                box-shadow: 0 0 0px 1000px #ffffff inset !important;
                -webkit-text-fill-color: inherit !important;
                transition: background-color 9999s ease-in-out 0s !important;
            }
            /* 1Password, Dashlane, LastPass and other extension autofill overrides */
            .checkout input[data-com-onepassword-filled],
            .checkout select[data-com-onepassword-filled],
            .checkout input[data-com-onepassword-filled="light"],
            .checkout input[data-com-onepassword-filled="dark"] {
                background-color: #ffffff !important;
            }
        </style>
    @endpush
    <div class="page-normal-background">
    <main class="container page checkout">

        <div class="checkout-hero">
            <div class="container">
                <x-breadcrumbs :items="[
                    ['label' => 'Home', 'url' => route('home')],
                    ['label' => 'Winkelmand', 'url' => route('cartPage')],
                    ['label' => 'Afrekenen', 'url' => route('checkoutPage')]
                ]" />
                <h1 class="checkout-hero__title font-herina">Afrekenen</h1>
            </div>
        </div>

        <div class="gradient-border checkout-hero-border"></div>

        <div class="checkout-content-section">
        <div class="container">

        @if (session('success'))
            <div class="alert alert-success">
                <span class="alert-icon"><i class="fa-solid fa-circle-check"></i></span>
                <span class="alert-text">{{ session('success') }}</span>
                <button type="button" class="alert-close" aria-label="Sluiten">&times;</button>
            </div>
        @endif

        @if (session('error'))
            <div class="alert alert-error">
                <span class="alert-icon"><i class="fa-solid fa-circle-exclamation"></i></span>
                <span class="alert-text">{{ session('error') }}</span>
                <button type="button" class="alert-close" aria-label="Sluiten">&times;</button>
            </div>
        @endif

        @if ($errors->has('stock'))
            <div class="alert alert-error">
                <span class="alert-icon"><i class="fa-solid fa-circle-exclamation"></i></span>
                <span class="alert-text">
                    <a style="text-decoration: none; display: block; margin-bottom: 4px;" href="{{ route('cartPage') }}">← Terug naar winkelmand</a>
                    {!! $errors->first('stock') !!}
                </span>
                <button type="button" class="alert-close" aria-label="Sluiten">&times;</button>
            </div>
        @endif

        <form class="form checkout" action="{{ route('storeCheckout') }}" method="POST">
            @csrf
            <div class="checkout-grid">

                <div>
                    <div class="item customer-details checkout-card">
                        <div class="checkout-section-header">
                            <h3 class="checkout-section-title">Factuurgegevens</h3>
                            <button type="button" id="clear-billing-fields" class="btn-clear-fields">
                                <i class="fa fa-rotate-left"></i>Wissen
                            </button>
                        </div>

                        @auth
                            <div>
                                <p>Je bent ingelogd als <strong>{{ auth()->user()->email }}</strong>.</p>
                            </div>
                        @else
                            <div>
                                <p>Je rekent af als gast.</p>
                            </div>
                        @endauth

                        <div class="form-input">
                            <label for="billing_email">E-mailadres <span class="required">*</span></label>
                            <input type="email" name="billing_email" autocomplete="email"
                                value="{{ old('billing_email', auth()->check() ? auth()->user()->email : '') }}"
                                @auth readonly style="background-color: #f5f5f5;" @endauth>
                            @error('billing_email')
                                <div class="error">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="name-box">
                            <div class="form-input">
                                <label for="billing_first_name">Voornaam <span class="required">*</span></label>
                                <input type="text" name="billing_first_name" autocomplete="given-name" data-1p-ignore
                                    value="{{ old('billing_first_name') }}">
                                @error('billing_first_name')
                                    <div class="error">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-input">
                                <label for="billing_last_name">Achternaam <span class="required">*</span></label>
                                <input type="text" name="billing_last_name" autocomplete="family-name" data-1p-ignore
                                    value="{{ old('billing_last_name') }}">
                                @error('billing_last_name')
                                    <div class="error">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        {{-- Google Places address search --}}
                        <div class="form-input address-autocomplete-wrap" id="billing-autocomplete-wrap">
                            <label for="billing_address_search">
                                <i class="fa-solid fa-magnifying-glass" style="margin-right:4px;"></i>
                                Snel zoeken <span style="font-weight:400; color:#888; font-size:13px;">(typ volledig adres incl. huisnummer)</span>
                            </label>
                            <input
                                type="text"
                                id="billing_address_search"
                                placeholder="bijv. Keizersgracht 1, Amsterdam"
                                class="address-search-input"
                                onkeydown="if(event.key==='Enter'){event.preventDefault();}"
                            >
                        </div>

                        {{-- Postcode + Huisnummer + Toevoeging (NL: vul deze in voor automatisch straat/stad) --}}
                        <div class="postcode-housenumber-row">
                            <div class="form-input postcode-field">
                                <label for="billing_postal_code">Postcode <span class="required">*</span></label>
                                <div class="input-wrap">
                                    <input type="text" name="billing_postal_code" id="billing_postal_code" autocomplete="postal-code" data-1p-ignore
                                        value="{{ old('billing_postal_code') }}"
                                        placeholder="1234 AB">
                                </div>
                                @error('billing_postal_code')
                                    <div class="error">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-input housenumber-field">
                                <label for="billing_house_number">Huisnr. <span class="required">*</span></label>
                                <input type="text" inputmode="text" name="billing_house_number" id="billing_house_number" autocomplete="address-line2" data-1p-ignore
                                    value="{{ old('billing_house_number') }}"
                                    placeholder="Nr.">
                                @error('billing_house_number')
                                    <div class="error">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-input suffix-field">
                                <label for="billing_house_number-add">Toevoeging</label>
                                <input type="text" name="billing_house_number-add" id="billing_house_number-add" autocomplete="address-line2" data-1p-ignore
                                    value="{{ old('billing_house_number-add') }}"
                                    placeholder="A, B…">
                                @error('billing_house_number-add')
                                    <div class="error">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <span id="billing-pdok-status" class="pdok-status"></span>

                        <div class="form-input">
                            <label for="billing_street">Straatnaam <span class="required">*</span></label>
                            <input type="text" name="billing_street" id="billing_street" autocomplete="address-line1" data-1p-ignore
                                value="{{ old('billing_street') }}"
                                placeholder="Straatnaam">
                            @error('billing_street')
                                <div class="error">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-input">
                            <label for="billing_city">Plaats <span class="required">*</span></label>
                            <input type="text" name="billing_city" id="billing_city" autocomplete="address-level2" data-1p-ignore
                                value="{{ old('billing_city') }}"
                                placeholder="Plaats">
                            @error('billing_city')
                                <div class="error">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-input">
                            <label for="billing_phone">Telefoonnummer</label>
                            <input type="text" name="billing_phone" autocomplete="tel" data-1p-ignore
                                value="{{ old('billing_phone') }}"
                                placeholder="Telefoonnummer">
                            @error('billing_phone')
                                <div class="error">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-input">
                            <label for="billing_company">Bedrijfsnaam</label>
                            <input type="text" name="billing_company" autocomplete="organization" data-1p-ignore
                                value="{{ old('billing_company') }}">
                            @error('billing_company')
                                <div class="error">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-input">
                            <label for="billing_country">Land <span class="required">*</span></label>
                            <select name="billing_country" id="billing_country" autocomplete="off" data-1p-ignore>
                                <option value="" disabled {{ old('billing_country', '') === '' ? 'selected' : '' }}>— Kies een land —</option>
                                @foreach($shippingCountries as $code => $name)
                                    <option value="{{ $code }}" {{ old('billing_country') === $code ? 'selected' : '' }}>{{ $name }}</option>
                                @endforeach
                            </select>
                            @error('billing_country')
                                <div class="error">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-input">
                            <label for="order_note">Bestelnotitie (optioneel)</label>
                            <textarea name="order_note" id="order_note" rows="4" placeholder="Eventuele opmerkingen bij je bestelling...">{{ old('order_note') }}</textarea>
                            @error('order_note')
                                <div class="error">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-input alt-shipping">
                            <label for="alt-shipping">Verzenden naar een ander adres?</label>
                            <input type="checkbox" name="alt-shipping" id="alt-shipping"
                                {{ old('alt-shipping') ? 'checked' : '' }}>
                        </div>

                    </div>

                    <div class="item customer-details alternate checkout-card" id="shipping-fields">
                        <div class="checkout-section-header">
                            <h3 class="checkout-section-title">Alternatief verzendadres</h3>
                            <button type="button" id="clear-shipping-fields" class="btn-clear-fields">
                                <i class="fa fa-rotate-left"></i>Wissen
                            </button>
                        </div>

                        <div class="name-box">
                            <div class="form-input">
                                <label for="shipping_first_name">Voornaam</label>
                                <input type="text" name="shipping_first_name" autocomplete="shipping given-name" data-1p-ignore
                                    value="{{ old('shipping_first_name') }}">
                                @error('shipping_first_name')
                                    <div class="error">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-input">
                                <label for="shipping_last_name">Achternaam</label>
                                <input type="text" name="shipping_last_name" autocomplete="shipping family-name" data-1p-ignore
                                    value="{{ old('shipping_last_name') }}">
                                @error('shipping_last_name')
                                    <div class="error">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        {{-- Google Places address search --}}
                        <div class="form-input address-autocomplete-wrap" id="shipping-autocomplete-wrap">
                            <label for="shipping_address_search">
                                <i class="fa-solid fa-magnifying-glass" style="margin-right:4px;"></i>
                                Snel zoeken <span style="font-weight:400; color:#888; font-size:13px;">(typ volledig adres incl. huisnummer)</span>
                            </label>
                            <input
                                type="text"
                                id="shipping_address_search"
                                placeholder="bijv. Keizersgracht 1, Amsterdam"
                                class="address-search-input"
                                onkeydown="if(event.key==='Enter'){event.preventDefault();}"
                            >
                        </div>

                        {{-- Postcode + Huisnummer + Toevoeging --}}
                        <div class="postcode-housenumber-row">
                            <div class="form-input postcode-field">
                                <label for="shipping_postal_code">Postcode</label>
                                <div class="input-wrap">
                                    <input type="text" name="shipping_postal_code" id="shipping_postal_code" autocomplete="shipping postal-code" data-1p-ignore
                                        value="{{ old('shipping_postal_code') }}"
                                        placeholder="1234 AB">
                                </div>
                                @error('shipping_postal_code')
                                    <div class="error">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-input housenumber-field">
                                <label for="shipping_house_number">Huisnr.</label>
                                <input type="text" inputmode="text" name="shipping_house_number" id="shipping_house_number"
                                    autocomplete="shipping address-line2" data-1p-ignore
                                    value="{{ old('shipping_house_number') }}"
                                    placeholder="Nr.">
                                @error('shipping_house_number')
                                    <div class="error">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-input suffix-field">
                                <label for="shipping_house_number-add">Toevoeging</label>
                                <input type="text" name="shipping_house_number-add" id="shipping_house_number-add" data-1p-ignore
                                    value="{{ old('shipping_house_number-add') }}"
                                    placeholder="A, B…">
                                @error('shipping_house_number-add')
                                    <div class="error">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <span id="shipping-pdok-status" class="pdok-status"></span>

                        <div class="form-input">
                            <label for="shipping_street">Straatnaam</label>
                            <input type="text" name="shipping_street" id="shipping_street" autocomplete="shipping address-line1" data-1p-ignore
                                value="{{ old('shipping_street') }}"
                                placeholder="Straatnaam">
                            @error('shipping_street')
                                <div class="error">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-input">
                            <label for="shipping_city">Plaats</label>
                            <input type="text" name="shipping_city" id="shipping_city" autocomplete="shipping address-level2" data-1p-ignore
                                value="{{ old('shipping_city') }}"
                                placeholder="Plaats">
                            @error('shipping_city')
                                <div class="error">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-input">
                            <label for="shipping_phone">Telefoonnummer</label>
                            <input type="text" name="shipping_phone" autocomplete="shipping tel" data-1p-ignore
                                value="{{ old('shipping_phone') }}">
                            @error('shipping_phone')
                                <div class="error">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-input">
                            <label for="shipping_company">Bedrijfsnaam</label>
                            <input type="text" name="shipping_company" autocomplete="shipping organization" data-1p-ignore
                                value="{{ old('shipping_company') }}">
                            @error('shipping_company')
                                <div class="error">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-input">
                            <label for="shipping_country">Land</label>
                            <select name="shipping_country" id="shipping_country" autocomplete="off" data-1p-ignore>
                                <option value="" disabled {{ old('shipping_country', '') === '' ? 'selected' : '' }}>— Kies een land —</option>
                                @foreach($shippingCountries as $code => $name)
                                    <option value="{{ $code }}" {{ old('shipping_country') === $code ? 'selected' : '' }}>{{ $name }}</option>
                                @endforeach
                            </select>
                            @error('shipping_country')
                                <div class="error">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="item order-details checkout-card">
                    <p class="back-to-cart"><a href="{{ route('cartPage') }}">← Terug naar winkelmand</a></p>

                    <h3 class="checkout-section-title">Bestelling</h3>

                    <div class="form-input">
                        <div style="display: flex;flex-direction: column">
                            <input style="width: fit-content; margin-bottom: 10px" type="text"
                                name="discount_code" id="discount_code" value="{{ old('discount_code') }}"
                                placeholder="Vul kortingscode in">
                            <button type="button" id="add_discount_code" style="height: 32px" class="btn small"><span
                                    class="loader" style="display:none"></span>Kortingscode toepassen</button>
                        </div>
                        @error('discount_code')
                            <div class="error">{{ $message }}</div>
                        @enderror
                    </div>

                    @livewire('checkout-cart')
                    <div id="remove-discount-container" style="display:none;margin-bottom:10px;">
                        <button type="button" id="remove_discount_code" class="btn small"
                            style="background:#eee;color:#b30000;">Verwijder kortingscode</button>
                    </div>

                    <div id="myparcel-loader-wrap"></div>

                    <div id="custom-delivery-options" class="custom-delivery-options" style="display:none;">

                        <div class="cdo-tabs">
                            <button type="button" class="cdo-tab active" data-tab="home">
                                <i class="fa-solid fa-house"></i> Thuisbezorging
                            </button>
                            <button type="button" class="cdo-tab" data-tab="pickup">
                                <i class="fa-solid fa-store"></i> Afhaalpunt
                            </button>
                        </div>

                        <div class="cdo-panel" id="cdo-panel-home">
                            <div class="cdo-list" id="cdo-home-list"></div>
                        </div>

                        <div class="cdo-panel" id="cdo-panel-pickup" style="display:none;">
                            <div class="cdo-list" id="cdo-pickup-list"></div>
                        </div>

                        <div id="cdo-loader" class="cdo-loader" style="display:none;">
                            <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 24 24" fill="none"
                                 style="animation:cdo-spin 0.8s linear infinite;">
                                <circle cx="12" cy="12" r="10" stroke="#d0d0d0" stroke-width="3"/>
                                <path d="M12 2a10 10 0 0 1 10 10" stroke="#6c8ebf" stroke-width="3" stroke-linecap="round"/>
                            </svg>
                            <span>Bezorgopties worden geladen…</span>
                        </div>

                        <div id="cdo-error" class="cdo-error" style="display:none;">
                            <i class="fa-solid fa-circle-exclamation"></i>
                            <span id="cdo-error-msg">Bezorgopties konden niet worden geladen.</span>
                        </div>

                    </div>

                    <div id="opening-hours" class="pickup-opening-hours"></div>

                    <input type="hidden" name="myparcel_delivery_options" id="myparcel_delivery_options"
                        value="{{ old('myparcel_delivery_options') }}" />

                    @guest
                        <div class="checkout-create-account">
                            <div class="form-input customer-account">
                                <p>
                                    <b>Nog geen account? (optioneel)</b><br>
                                    Vul hieronder je gegevens en een wachtwoord in, we maken dan automatisch een account
                                    voor je aan.
                                    Heb je al een account? <a style="text-decoration: underline"
                                        href="{{ route('login') }}">Log dan in</a> om je eerdere bestellingen te bekijken.
                                </p>
                            </div>

                            <div class="create-account-box">
                                <div class="form-input">
                                    <label for="password">Wachtwoord</label>
                                    <input type="password" name="password" data-1p-ignore>
                                    @error('password')
                                        <div class="error">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-input">
                                    <label for="password_confirmation">Bevestig wachtwoord</label>
                                    <input type="password" name="password_confirmation" data-1p-ignore>
                                </div>
                            </div>
                        </div>
                    @endguest

                    <div class="place-order">
                        @error('myparcel_delivery_options')
                            <div class="error" style="color:#b30000; margin-bottom:10px;">{{ $message }}</div>
                        @enderror
                        <div class="terms-agreement">
                            <input type="checkbox" id="agree_terms" name="agree_terms" required>
                            <label for="agree_terms">
                                Ik ga akkoord met de <a href="{{ route('algemeneVoorwaarden') }}" target="_blank">algemene voorwaarden</a>
                                en heb het <a href="{{ route('privacybeleid') }}" target="_blank">privacybeleid</a> gelezen.
                            </label>
                        </div>
                        <button type="submit" class="btn"><span class="loader"></span>Plaats bestelling</button>
                    </div>
                </div>
            </div>
        </form>

        </div>{{-- /.container --}}
        </div>{{-- /.checkout-content-section --}}
    </main>

    <div class="gradient-border"></div>
    <x-footer></x-footer>
    <script>
        // ─── Helpers ──────────────────────────────────────────────────────────
        // Flag: set to true only when Google Places is actively filling the country
        var _googlePlacesFillingCountry = false;

        function resetMyParcelWidget() {
            if (typeof window.resetDeliveryOptions === 'function') {
                window.resetDeliveryOptions();
            }
        }

        function fireAddressEvents(prefix) {
            // Fire input + change on every address field so the MyParcel widget
            // detects the address is now empty and resets itself
            ['street', 'house_number', 'postal_code', 'city', 'country'].forEach(function (field) {
                var el = document.querySelector('[name="' + prefix + field + '"]');
                if (el) {
                    el.dispatchEvent(new Event('input',  { bubbles: true }));
                    el.dispatchEvent(new Event('change', { bubbles: true }));
                }
            });
        }

        // ─── Clear billing fields button ─────────────────────────────────────
        document.addEventListener('DOMContentLoaded', function () {
            var clearBtn = document.getElementById('clear-billing-fields');
            if (clearBtn) {
                clearBtn.addEventListener('click', function () {
                    // Clear all visible text/email/tel/textarea inputs in the billing card
                    var billingCard = clearBtn.closest('.item.customer-details');
                    if (billingCard) {
                        billingCard.querySelectorAll('input:not([type="checkbox"]):not([type="radio"]):not([name="_token"]):not([readonly]), textarea').forEach(function (el) {
                            el.value = '';
                        });
                        billingCard.querySelectorAll('select').forEach(function (el) {
                            el.selectedIndex = 0;
                        });
                    }

                    // Also clear the autocomplete search box
                    var search = document.getElementById('billing_address_search');
                    if (search) search.value = '';

                    // Also clear password fields
                    document.querySelectorAll('[name="password"], [name="password_confirmation"]').forEach(function (el) {
                        el.value = '';
                    });

                    // Reset the MyParcel widget (clears stale delivery options)
                    resetMyParcelWidget();

                    // Fire events so the widget's own listeners detect empty address
                    fireAddressEvents('billing_');

                    document.dispatchEvent(new CustomEvent('countryChanged'));
                });
            }

            // ─── Clear shipping fields button ─────────────────────────────────
            var clearShippingBtn = document.getElementById('clear-shipping-fields');
            if (clearShippingBtn) {
                clearShippingBtn.addEventListener('click', function () {
                    // Clear all visible text inputs in the shipping card
                    var shippingCard = document.getElementById('shipping-fields');
                    if (shippingCard) {
                        shippingCard.querySelectorAll('input:not([type="checkbox"]):not([type="radio"]):not([name="_token"]), textarea').forEach(function (el) {
                            el.value = '';
                        });
                        shippingCard.querySelectorAll('select').forEach(function (el) {
                            el.selectedIndex = 0;
                        });
                    }

                    // Also clear the autocomplete search box
                    var search = document.getElementById('shipping_address_search');
                    if (search) search.value = '';

                    // If alternate shipping is active, also reset the widget
                    if (document.getElementById('alt-shipping')?.checked) {
                        resetMyParcelWidget();
                        fireAddressEvents('shipping_');
                    }

                    document.dispatchEvent(new CustomEvent('countryChanged'));
                });
            }
        });

        // ─── Reset country when user types in address fields (prevent browser/plugin autofill) ──
        document.addEventListener('DOMContentLoaded', function () {
            // ── MutationObserver: remove blue background injected by 1Password / extensions ──
            var checkoutForm = document.querySelector('.form.checkout');
            if (checkoutForm) {
                var bgObserver = new MutationObserver(function (mutations) {
                    mutations.forEach(function (mutation) {
                        if (mutation.type === 'attributes') {
                            var el = mutation.target;
                            // Force white background via inline style (overrides extension !important via specificity+inline)
                            el.style.setProperty('background-color', '#ffffff', 'important');
                        }
                    });
                });
                checkoutForm.querySelectorAll('input, select').forEach(function (el) {
                    bgObserver.observe(el, { attributes: true, attributeFilter: ['data-com-onepassword-filled', 'data-dashlane-rid', 'data-lpignore', 'style'] });
                });
            }

            // ── Reset country selects: only Google Places is allowed to set these ──
            // Use multiple timeouts to catch slow-loading extensions (1Password fills at ~500-800ms)
            function resetCountryIfNotGoogle() {
                var billing = document.getElementById('billing_country');
                @if(!old('billing_country'))
                if (billing && billing.value !== '' && !_googlePlacesFillingCountry) {
                    billing.value = '';
                }
                @endif
                var shipping = document.getElementById('shipping_country');
                @if(!old('shipping_country'))
                if (shipping && shipping.value !== '' && !_googlePlacesFillingCountry) {
                    shipping.value = '';
                }
                @endif
            }
            setTimeout(resetCountryIfNotGoogle, 300);
            setTimeout(resetCountryIfNotGoogle, 800);
            setTimeout(resetCountryIfNotGoogle, 1500);

        });

        // ─── Toggle alternate shipping address ───────────────────────────────
        document.addEventListener('DOMContentLoaded', function() {
            const altShippingCheckbox = document.getElementById('alt-shipping');
            const shippingFields = document.getElementById('shipping-fields');

            if (altShippingCheckbox && shippingFields) {
                altShippingCheckbox.addEventListener('change', function() {
                    if (this.checked) {
                        shippingFields.classList.add('show');
                    } else {
                        shippingFields.classList.remove('show');
                    }
                });

                if (altShippingCheckbox.checked) {
                    shippingFields.classList.add('show');
                }
            }
        });

        // ─── Google Places Autocomplete ──────────────────────────────────────
        @if(config('services.google.maps_api_key'))

        // Dutch country names (from backend)
        const countryNames = @json($countryNames);

        // Countries with shipping configured (lowercase for Google Places API)
        const shippingCountryCodes = @json(array_map('strtolower', array_keys($shippingCountries)));

        function initAddressAutocomplete() {
            setupAutocomplete('billing_address_search', {
                street:         '[name="billing_street"]',
                houseNumber:    '[name="billing_house_number"]',
                postalCode:     '[name="billing_postal_code"]',
                city:           '[name="billing_city"]',
                countrySelect:  'billing_country',
            });

            setupAutocomplete('shipping_address_search', {
                street:         '[name="shipping_street"]',
                houseNumber:    '[name="shipping_house_number"]',
                postalCode:     '[name="shipping_postal_code"]',
                city:           '[name="shipping_city"]',
                countrySelect:  'shipping_country',
            });
        }

        function setupAutocomplete(inputId, fields) {
            const input = document.getElementById(inputId);
            if (!input) return;

            const autocomplete = new google.maps.places.Autocomplete(input, {
                types: ['address'],
                componentRestrictions: { country: shippingCountryCodes },
                fields: ['address_components'],
            });

            autocomplete.addListener('place_changed', function () {
                const place = autocomplete.getPlace();
                if (!place.address_components) return;

                // Reset all target fields first
                [fields.street, fields.houseNumber, fields.postalCode, fields.city].forEach(sel => {
                    const el = document.querySelector(sel);
                    if (el) el.value = '';
                });

                let streetName = '';
                let houseNumber = '';

                place.address_components.forEach(component => {
                    const types = component.types;

                    if (types.includes('route')) {
                        streetName = component.long_name;
                    }
                    if (types.includes('street_number')) {
                        houseNumber = component.long_name;
                    }
                    if (types.includes('postal_code')) {
                        const el = document.querySelector(fields.postalCode);
                        if (el) el.value = component.long_name;
                    }
                    if (types.includes('locality') || types.includes('postal_town')) {
                        const el = document.querySelector(fields.city);
                        if (el && !el.value) el.value = component.long_name;
                    }
                    if (types.includes('country')) {
                        const countryCode = component.short_name.toUpperCase();
                        const countryName = countryNames[countryCode] || component.long_name;

                        // Set select value — flag so our country-reset logic knows this is intentional
                        _googlePlacesFillingCountry = true;
                        const selectEl = document.getElementById(fields.countrySelect);
                        if (selectEl) {
                            selectEl.value = countryCode;
                            // Trigger change event for any listeners
                            selectEl.dispatchEvent(new Event('change', { bubbles: true }));
                        }
                        setTimeout(function () { _googlePlacesFillingCountry = false; }, 100);

                        // Check shipping availability, passing the name for the popup
                        checkShippingAvailability(countryCode, countryName);
                    }
                });

                const streetEl = document.querySelector(fields.street);
                if (streetEl) streetEl.value = streetName;

                const houseEl = document.querySelector(fields.houseNumber);
                if (houseEl) houseEl.value = houseNumber;

                // Clear the search box
                input.value = '';

                // ── Warn about missing / incomplete fields after Google Places ──
                const NL_PC_FULL = /^\d{4}\s?[A-Z]{2}$/i;

                function markMissing(el, hintText) {
                    if (!el) return;
                    el.classList.add('field-missing-hint');
                    const wrap = el.closest('.form-input') || el.parentElement;
                    // Remove stale hint first
                    wrap?.querySelector('.missing-field-hint')?.remove();
                    if (wrap) {
                        const hint = document.createElement('span');
                        hint.className = 'missing-field-hint';
                        hint.innerHTML = '<i class="fa-solid fa-triangle-exclamation" style="font-size:10px;margin-right:3px;"></i>' + hintText;
                        wrap.appendChild(hint);
                        el.addEventListener('input', function removeMissing() {
                            el.classList.remove('field-missing-hint');
                            hint.remove();
                            el.removeEventListener('input', removeMissing);
                        });
                    }
                }

                const pcEl = document.querySelector(fields.postalCode);

                // Read the country that was just set by Google Places
                const gpCountry = (document.getElementById(fields.countrySelect)?.value || '').toUpperCase();

                // Google Places sometimes returns incomplete NL postcodes (e.g. "7827" without letters).
                // Only clear it for NL – other countries have their own formats.
                if (pcEl && pcEl.value && gpCountry === 'NL' && !NL_PC_FULL.test(pcEl.value)) {
                    pcEl.value = '';
                }

                if (!houseNumber) markMissing(houseEl, 'Vul je huisnummer in');
                // Only hint "will be filled after house number" for NL (PDOK lookup); for other countries the user fills it
                if (pcEl && !pcEl.value && gpCountry === 'NL') markMissing(pcEl, 'Wordt ingevuld na huisnummer');

                // ── Auto-fill postcode when user types housenumber after Google Places ──
                // Uses PDOK lookup: straat + huisnummer + stad → volledige postcode
                if (!houseNumber && houseEl) {
                    const onceHandler = function () {
                        const num  = houseEl.value.trim();
                        const str  = (document.querySelector(fields.street)  || {}).value || '';
                        const city = (document.querySelector(fields.city)    || {}).value || '';
                        if (!num || !str) return;

                        const country = (document.getElementById(fields.countrySelect) || {}).value || '';
                        if (country && country !== 'NL') return; // Only for NL

                        const q = encodeURIComponent(str + ' ' + num + (city ? ' ' + city : ''));
                        fetch(`https://api.pdok.nl/bzk/locatieserver/search/v3_1/free?q=${q}&fq=type:adres&fl=postcode,straatnaam,woonplaatsnaam&rows=1`)
                            .then(r => r.ok ? r.json() : null)
                            .then(data => {
                                const doc = data?.response?.docs?.[0];
                                if (doc?.postcode && pcEl) {
                                    pcEl.value = doc.postcode;
                                    pcEl.classList.remove('field-missing-hint');
                                    pcEl.closest('.form-input')?.querySelector('.missing-field-hint')?.remove();
                                    pcEl.classList.add('address-autofilled');
                                    setTimeout(() => pcEl.classList.remove('address-autofilled'), 2500);
                                    // ── Don't dispatch input/change on pcEl — that would retrigger
                                    // the standard PDOK lookup which would redundantly re-fill
                                    // street/city (already done by Google Places) and reload MyParcel.
                                    // Instead, mark the address as done and fire addressAutofilled once.
                                    window._pdokLookup?.[fields.postalCode]?.markLookedUp(doc.postcode, num);
                                    document.dispatchEvent(new CustomEvent('addressAutofilled'));
                                }
                            })
                            .catch(() => {});
                    };
                    // Trigger after a short pause when the user stops typing
                    let pcLookupTimer;
                    houseEl.addEventListener('input', function pcLookup() {
                        clearTimeout(pcLookupTimer);
                        pcLookupTimer = setTimeout(() => {
                            onceHandler();
                            houseEl.removeEventListener('input', pcLookup);
                        }, 600);
                    });

                    setTimeout(() => {
                        houseEl.focus();
                        houseEl.scrollIntoView({ behavior: 'smooth', block: 'center' });
                    }, 150);
                }

                // Highlight filled fields briefly
                [fields.street, fields.houseNumber, fields.postalCode, fields.city].forEach(sel => {
                    const el = document.querySelector(sel);
                    if (el && el.value) {
                        el.classList.add('address-autofilled');
                        setTimeout(() => el.classList.remove('address-autofilled'), 2500);
                    }
                });

                // Fire input + change events on street/city so delivery-options.js reacts.
                // DO NOT dispatch on postalCode or houseNumber — those would silently
                // trigger the standard PDOK lookup which would redundantly re-fill
                // street + city (and reload MyParcel) right after Google Places just did it.
                [fields.street, fields.city].forEach(sel => {
                    const el = document.querySelector(sel);
                    if (el && el.value) {
                        el.dispatchEvent(new Event('input',  { bubbles: true }));
                        el.dispatchEvent(new Event('change', { bubbles: true }));
                    }
                });
                // Also fire on the select country field so shipping cost + MyParcel update
                const countrySelectEl = document.getElementById(fields.countrySelect);
                if (countrySelectEl && countrySelectEl.value) {
                    countrySelectEl.dispatchEvent(new Event('input',  { bubbles: true }));
                    countrySelectEl.dispatchEvent(new Event('change', { bubbles: true }));
                }

                // ── Silence the standard PDOK lookup for this address ──
                // If Google Places already filled postcode + house number, mark it as
                // "already looked up" so the standard PDOK won't re-run and re-fill.
                const _gpPc  = (document.querySelector(fields.postalCode)  || {}).value || '';
                const _gpNum = (document.querySelector(fields.houseNumber) || {}).value || '';
                if (_gpPc && _gpNum) {
                    window._pdokLookup?.[fields.postalCode]?.markLookedUp(_gpPc, _gpNum);
                }

                // Signal MyParcel to reload pickup locations for the new address
                document.dispatchEvent(new CustomEvent('addressAutofilled'));
            });
        }

        // Expose callback for the async Google Maps loader
        window.initAddressAutocomplete = initAddressAutocomplete;

        // Also try immediately in case the script already loaded
        if (typeof google !== 'undefined' && google.maps && google.maps.places) {
            initAddressAutocomplete();
        }

        @else
        // Google Maps API key not configured – autocomplete disabled.
        document.querySelectorAll('.address-autocomplete-wrap').forEach(el => el.style.display = 'none');
        @endif

        // ─── Country-aware: postcode placeholder + pdok-status visibility ─────
        // Runs always (with or without Google Maps)
        const postcodePlaceholders = {
            'NL': '1234 AB', 'BE': '1000',  'DE': '12345',
            'FR': '75001',   'GB': 'SW1A 2AA', 'LU': 'L-1234',
            'AT': '1010',    'CH': '8001',     'ES': '28001',
            'IT': '00100',   'PL': '00-001',   'SE': '111 20',
            'DK': '1000',    'NO': '0150',     'FI': '00100',
        };

        function applyCountryUI(prefix) {
            const countryEl = document.getElementById(prefix + 'country');
            const pcEl      = document.querySelector('[name="' + prefix + 'postal_code"]');
            const statusEl  = document.getElementById(prefix.replace('_', '-') + 'pdok-status');
            if (!countryEl) return;

            const cc = countryEl.value.toUpperCase();
            const isNL = cc === '' || cc === 'NL'; // treat empty as NL (default)

            // Update postcode placeholder
            if (pcEl) {
                pcEl.placeholder = postcodePlaceholders[cc] || 'Postcode';
            }

            // Hide PDOK status for non-NL (no auto-lookup)
            if (statusEl) {
                statusEl.style.display = isNL ? '' : 'none';
            }
        }

        document.addEventListener('DOMContentLoaded', function () {
            // Apply on page load
            applyCountryUI('billing_');
            applyCountryUI('shipping_');

            // Re-apply whenever country select changes
            document.getElementById('billing_country')?.addEventListener('change',  () => applyCountryUI('billing_'));
            document.getElementById('shipping_country')?.addEventListener('change', () => applyCountryUI('shipping_'));
        });

        // ─── Shipping availability popup (used by Google Places callback) ────
        function checkShippingAvailability(countryCode, countryName) {
            fetch(`/api/shipping-cost?country=${countryCode}`)
                .then(r => r.json())
                .then(data => {
                    // Dispatch event so app.js shipping calculator updates too
                    document.dispatchEvent(new CustomEvent('countryChanged'));

                    if (!data.found) {
                        showNoShippingPopup(countryName);
                    }
                });
        }

        function showNoShippingPopup(countryName) {
            // Remove existing popup if any
            const existing = document.getElementById('no-shipping-popup');
            if (existing) existing.remove();

            const overlay = document.createElement('div');
            overlay.id = 'no-shipping-popup';
            overlay.innerHTML = `
                <div class="no-shipping-overlay">
                    <div class="no-shipping-modal">
                        <div class="no-shipping-icon">🚫</div>
                        <h3>Bezorging niet beschikbaar</h3>
                        <p>
                            Helaas bieden wij momenteel nog geen bezorging aan naar
                            <strong>${countryName}</strong>.
                        </p>
                        <p style="font-size:14px; color:#666; margin-top:8px;">
                            Wij bezorgen momenteel niet naar het gekozen land.<br>
                            Kies een ander afleveradres of neem contact met ons op.
                        </p>
                        <div style="display:flex; gap:12px; justify-content:center; margin-top:20px; flex-wrap:wrap;">
                            <button class="btn no-shipping-close-btn" onclick="document.getElementById('no-shipping-popup').remove();">
                                Ander adres kiezen
                            </button>
                        </div>
                    </div>
                </div>
            `;

            document.body.appendChild(overlay);

            // Close on overlay click
            overlay.querySelector('.no-shipping-overlay').addEventListener('click', function(e) {
                if (e.target === this) overlay.remove();
            });
        }

        // ─── PDOK Postcode Lookup (Netherlands, free government API) ─────────────
        (function () {
            function setupPostcodeLookup(config) {
                let lookupTimeout = null;
                let lastLookedUpKey = ''; // cache: skip re-lookup of same postcode+housenumber

                function getCountry() {
                    const el = document.getElementById(config.countryId);
                    return el ? el.value.toUpperCase() : '';
                }

                function shouldLookup() {
                    const country = getCountry();
                    // Only run for NL addresses or when no country selected yet (default for this NL shop)
                    return country === '' || country === 'NL';
                }

                function triggerLookup() {
                    // Always cancel any pending lookup first, even when fields are empty
                    clearTimeout(lookupTimeout);
                    lookupTimeout = null;

                    if (!shouldLookup()) {
                        clearLoadingState();
                        return;
                    }
                    const pcEl  = document.querySelector(config.postalCode);
                    const numEl = document.querySelector(config.houseNumber);
                    if (!pcEl || !numEl) return;

                    const pc  = pcEl.value.replace(/\s/g, '').toUpperCase();
                    const num = numEl.value.trim();

                    // Clear loading state if fields are empty or postcode is incomplete
                    if (!pc || !num || !/^\d{4}[A-Z]{2}$/.test(pc)) {
                        clearLoadingState();
                        lastLookedUpKey = ''; // reset cache when fields are cleared
                        return;
                    }

                    // ── Skip if this exact postcode+number was already looked up ──
                    // Prevents re-triggering when focus leaves the house-number field
                    // (e.g. clicking a delivery option causes a blur → change event)
                    const lookupKey = pc + '|' + num;
                    if (lookupKey === lastLookedUpKey) return;

                    // ── Show loading feedback IMMEDIATELY (before the debounce timer fires) ──
                    // This gives the user instant confirmation that a lookup is about to happen
                    if (pcEl) pcEl.classList.add('pdok-loading-input');
                    const statusEl = document.getElementById(config.statusId);
                    if (statusEl) {
                        statusEl.innerHTML = '<span class="pdok-searching-dots">Adres wordt opgezocht</span>';
                        statusEl.className = 'pdok-status pdok-searching';
                    }

                    lookupTimeout = setTimeout(() => doLookup(pc, num), 400);
                }

                function clearLoadingState() {
                    const pcEl  = document.querySelector(config.postalCode);
                    const statusEl = document.getElementById(config.statusId);
                    if (pcEl)  pcEl.classList.remove('pdok-loading-input');
                    if (statusEl) { statusEl.textContent = ''; statusEl.className = 'pdok-status'; }
                    // Note: do NOT reset lastLookedUpKey here — clearLoadingState is called when
                    // fields are empty/invalid, but the key should only reset when the user
                    // actually types a new (different) postcode/number combination.
                }

                async function doLookup(postcode, number) {
                    const statusEl = document.getElementById(config.statusId);
                    const pcEl = document.querySelector(config.postalCode);
                    const numEl = document.querySelector(config.houseNumber);

                    // Loading state is already shown from triggerLookup — nothing to do here

                    try {
                        const url = `https://api.pdok.nl/bzk/locatieserver/search/v3_1/free?q=${encodeURIComponent(postcode + ' ' + number)}&fq=type:adres&fl=straatnaam,woonplaatsnaam,postcode,huisnummer&rows=1`;
                        const response = await fetch(url);
                        const data = response.ok ? await response.json() : null;

                        if (pcEl)  pcEl.classList.remove('pdok-loading-input');

                        // If the fields were cleared while we were waiting for the API response, abort
                        if (!pcEl || !pcEl.value.trim()) return;

                        if (data && data.response && data.response.docs && data.response.docs.length > 0) {
                            const doc = data.response.docs[0];

                            // ── Cache this key so re-blur / delivery option clicks don't re-trigger ──
                            lastLookedUpKey = postcode + '|' + number;

                            const streetEl = document.querySelector(config.street);
                            if (streetEl && doc.straatnaam) {
                                streetEl.value = doc.straatnaam;
                                streetEl.classList.add('address-autofilled');
                                setTimeout(() => streetEl.classList.remove('address-autofilled'), 2500);
                            }

                            const cityEl = document.querySelector(config.city);
                            if (cityEl && doc.woonplaatsnaam) {
                                cityEl.value = doc.woonplaatsnaam;
                                cityEl.classList.add('address-autofilled');
                                setTimeout(() => cityEl.classList.remove('address-autofilled'), 2500);
                            }

                            // Auto-set country to NL (PDOK is NL-only) so MyParcel gets
                            // a complete address and can render delivery options
                            const countryEl = document.getElementById(config.countryId);
                            if (countryEl && !countryEl.value) {
                                countryEl.value = 'NL';
                                countryEl.dispatchEvent(new Event('change', { bubbles: true }));
                            }

                            // Status stays empty on success — fields lighting up is feedback enough
                            if (statusEl) { statusEl.textContent = ''; statusEl.className = 'pdok-status'; }

                            // Fire addressAutofilled ONCE — delivery-options.js listens for this
                            // to reload delivery options. Avoid dispatching individual field events
                            // which would cause multiple redundant delivery-option re-checks.
                            setTimeout(() => {
                                document.dispatchEvent(new CustomEvent('addressAutofilled'));
                            }, 50);

                        } else {
                            // Only show text when address truly not found
                            lastLookedUpKey = ''; // allow retry after correction
                            if (statusEl) {
                                statusEl.textContent = 'Adres niet gevonden — vul straatnaam en plaats zelf in.';
                                statusEl.className = 'pdok-status pdok-not-found';
                            }
                        }
                    } catch (e) {
                        lastLookedUpKey = ''; // allow retry on network error
                        if (pcEl)  pcEl.classList.remove('pdok-loading-input');
                        if (statusEl) { statusEl.textContent = ''; statusEl.className = 'pdok-status'; }
                    }
                }

                const pcEl  = document.querySelector(config.postalCode);
                const numEl = document.querySelector(config.houseNumber);
                if (pcEl)  { pcEl.addEventListener('input',  triggerLookup); pcEl.addEventListener('change', triggerLookup); }
                if (numEl) { numEl.addEventListener('input', triggerLookup); numEl.addEventListener('change', triggerLookup); }

                // ── Expose markLookedUp so Google Places can silence a re-run ──
                // After Google Places (or its postcode recovery) fills the address,
                // calling markLookedUp(pc, num) updates the cache so the standard
                // PDOK lookup skips this address rather than re-fetching street/city.
                window._pdokLookup = window._pdokLookup || {};
                window._pdokLookup[config.postalCode] = {
                    markLookedUp: function (pc, num) {
                        lastLookedUpKey = (pc || '').replace(/\s/g, '').toUpperCase()
                                        + '|'
                                        + (num || '').trim();
                        clearLoadingState();
                    }
                };
            }

            document.addEventListener('DOMContentLoaded', function () {
                setupPostcodeLookup({
                    postalCode:  '[name="billing_postal_code"]',
                    houseNumber: '[name="billing_house_number"]',
                    street:      '[name="billing_street"]',
                    city:        '[name="billing_city"]',
                    countryId:   'billing_country',
                    statusId:    'billing-pdok-status',
                });
                setupPostcodeLookup({
                    postalCode:  '[name="shipping_postal_code"]',
                    houseNumber: '[name="shipping_house_number"]',
                    street:      '[name="shipping_street"]',
                    city:        '[name="shipping_city"]',
                    countryId:   'shipping_country',
                    statusId:    'shipping-pdok-status',
                });
            });
        })();

        // ─── Client-side form validation ────────────────────────────────────
        (function () {
            const form = document.querySelector('form.checkout');
            if (!form) return;

            // Fields that are always required
            const alwaysRequired = [
                { name: 'billing_email',        label: 'E-mailadres' },
                { name: 'billing_first_name',   label: 'Voornaam' },
                { name: 'billing_last_name',    label: 'Achternaam' },
                { name: 'billing_street',       label: 'Straatnaam' },
                { name: 'billing_house_number', label: 'Huisnummer' },
                { name: 'billing_postal_code',  label: 'Postcode' },
                { name: 'billing_city',         label: 'Plaats' },
                { name: 'billing_country',      label: 'Land' },
            ];

            // Fields required only when alt-shipping is checked
            const shippingRequired = [
                { name: 'shipping_first_name',   label: 'Voornaam (verzendadres)' },
                { name: 'shipping_last_name',    label: 'Achternaam (verzendadres)' },
                { name: 'shipping_street',       label: 'Straatnaam (verzendadres)' },
                { name: 'shipping_house_number', label: 'Huisnummer (verzendadres)' },
                { name: 'shipping_postal_code',  label: 'Postcode (verzendadres)' },
                { name: 'shipping_city',         label: 'Plaats (verzendadres)' },
                { name: 'shipping_country',      label: 'Land (verzendadres)' },
            ];

            function clearErrors() {
                form.querySelectorAll('.js-error').forEach(el => el.remove());
            }

            function showError(input, message) {
                // Don't duplicate
                const existing = input.parentElement.querySelector('.js-error');
                if (existing) existing.remove();

                const div = document.createElement('div');
                div.className = 'error js-error';
                div.textContent = message;
                input.insertAdjacentElement('afterend', div);
            }

            function validate() {
                clearErrors();
                let firstError = null;
                let hasErrors = false;

                function checkField(name, label) {
                    const el = form.querySelector(`[name="${name}"]`);
                    if (!el) return;
                    const val = el.tagName === 'SELECT' ? el.value : el.value.trim();
                    if (!val) {
                        showError(el, `${label} is verplicht.`);
                        if (!firstError) firstError = el;
                        hasErrors = true;
                    }
                }

                alwaysRequired.forEach(f => checkField(f.name, f.label));

                const altShipping = document.getElementById('alt-shipping');
                if (altShipping && altShipping.checked) {
                    shippingRequired.forEach(f => checkField(f.name, f.label));
                }

                // agree_terms checkbox
                const terms = document.getElementById('agree_terms');
                if (terms && !terms.checked) {
                    showError(terms, 'Je moet akkoord gaan met de algemene voorwaarden.');
                    if (!firstError) firstError = terms;
                    hasErrors = true;
                }

                // delivery option
                const delivery = document.getElementById('myparcel_delivery_options');
                if (delivery && !delivery.value) {
                    const container = document.getElementById('custom-delivery-options');
                    if (container && container.style.display !== 'none') {
                        const errTarget = container;
                        const existing = errTarget.parentElement.querySelector('.js-error-delivery');
                        if (!existing) {
                            const div = document.createElement('div');
                            div.className = 'error js-error js-error-delivery';
                            div.style.marginTop = '6px';
                            div.textContent = 'Kies een bezorgoptie.';
                            errTarget.insertAdjacentElement('afterend', div);
                        }
                        if (!firstError) firstError = container;
                        hasErrors = true;
                    }
                }

                if (firstError) {
                    firstError.scrollIntoView({ behavior: 'smooth', block: 'center' });
                }

                return !hasErrors;
            }

            form.addEventListener('submit', function (e) {
                if (!validate()) {
                    e.preventDefault();
                    e.stopImmediatePropagation();
                }
            });

            // Clear js-errors on input
            form.addEventListener('input',  () => clearErrors(), { passive: true });
            form.addEventListener('change', () => clearErrors(), { passive: true });
        })();

        // ─── Restore CDO state after server-side redirect ────────────────────
        (function () {
            const oldValue = @json(old('myparcel_delivery_options', ''));
            if (!oldValue) return;

            let parsed;
            try { parsed = JSON.parse(oldValue); } catch(e) { return; }

            // Called by delivery-options.js after rendering is complete
            window._cdoRestoreValue = oldValue;

            function tryRestore() {
                const h = document.getElementById('myparcel_delivery_options');
                if (h && !h.value) h.value = oldValue;

                // Switch to correct tab
                if (parsed.deliveryType === 'pickup') {
                    const pickupTab = document.querySelector('.cdo-tab[data-tab="pickup"]');
                    if (pickupTab) pickupTab.click();
                }

                // Try to find matching radio and check it
                const radios = document.querySelectorAll('input[name="cdo_choice"]');
                let matched = false;
                radios.forEach(radio => {
                    try {
                        const rv = JSON.parse(radio.value);
                        if (parsed.deliveryType === 'pickup' && rv.deliveryType === 'pickup'
                            && rv.pickup && parsed.pickup
                            && rv.pickup.location_code === parsed.pickup.location_code) {
                            radio.checked = true;
                            if (h) h.value = radio.value;
                            matched = true;
                        } else if (parsed.deliveryType !== 'pickup' && rv.deliveryType !== 'pickup') {
                            radio.checked = true;
                            if (h) h.value = radio.value;
                            matched = true;
                        }
                    } catch(e) {}
                });

                return matched;
            }

            // Retry until the delivery options have rendered (up to 8s)
            let attempts = 0;
            const interval = setInterval(() => {
                if (tryRestore() || ++attempts > 16) clearInterval(interval);
            }, 500);
        })();
    </script>
</div>
</x-layout>
