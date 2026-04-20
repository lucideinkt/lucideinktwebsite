<x-layout :seo-data="$SEOData">
    @push('head')
        @if(config('services.google.maps_api_key'))
        <script src="https://maps.googleapis.com/maps/api/js?key={{ config('services.google.maps_api_key') }}&libraries=places&callback=initAddressAutocomplete&loading=async" async defer></script>
        @endif
    @endpush
    <div class="page-normal-background">
    <main class="container page checkout">
        <x-breadcrumbs :items="[
            ['label' => 'Home', 'url' => route('home')],
            ['label' => 'Winkelmand', 'url' => route('cartPage')],
            ['label' => 'Afrekenen', 'url' => route('checkoutPage')]
        ]" />

        <div class="checkout-header">
            <h1 class="checkout-page-title font-herina">Afrekenen</h1>
        </div>

        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
                <button type="button" class="alert-close"
                    onclick="this.parentElement.style.display='none';">&times;</button>
            </div>
        @endif

        @if (session('error'))
            <div class="alert alert-error">
                {{ session('error') }}
                <button type="button" class="alert-close"
                    onclick="this.parentElement.style.display='none';">&times;</button>
            </div>
        @endif

        @if ($errors->has('stock'))
            <div class="alert alert-error">
                <div>
                    <div>
                        <a style="text-decoration: none" href="{{ route('cartPage') }}">← Terug naar winkelmand</a>
                    </div>
                    {!! $errors->first('stock') !!}
                </div>
                <button type="button" class="alert-close"
                    onclick="this.parentElement.style.display='none';">&times;</button>
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
                                <input type="text" name="billing_first_name" autocomplete="given-name"
                                    value="{{ old('billing_first_name') }}">
                                @error('billing_first_name')
                                    <div class="error">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-input">
                                <label for="billing_last_name">Achternaam <span class="required">*</span></label>
                                <input type="text" name="billing_last_name" autocomplete="family-name"
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
                                Adres zoeken <span style="font-weight:400; color:#888; font-size:13px;">(typ om automatisch in te vullen)</span>
                            </label>
                            <input
                                type="text"
                                id="billing_address_search"
                                placeholder="bijv. Keizersgracht 1, Amsterdam"
                                autocomplete="off"
                                class="address-search-input"
                                onkeydown="if(event.key==='Enter'){event.preventDefault();}"
                            >
                        </div>

                        <div class="street-box">
                            <div class="form-input street">
                                <label for="billing_street">Straatnaam <span class="required">*</span></label>
                                <input type="text" name="billing_street" autocomplete="address-line1"
                                    value="{{ old('billing_street') }}"
                                    placeholder="Straatnaam">
                                @error('billing_street')
                                    <div class="error">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="housnumber-box">
                                <div class="form-input">
                                    <label for="billing_house_number">Huisnummer <span class="required">*</span></label>
                                    <input type="number" name="billing_house_number" autocomplete="address-line2"
                                        value="{{ old('billing_house_number') }}"
                                        placeholder="Nr.">
                                    @error('billing_house_number')
                                        <div class="error">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-input">
                                    <label for="billing_house_number-add">Toevoeging</label>
                                    <input type="text" name="billing_house_number-add" autocomplete="address-line2"
                                        value="{{ old('billing_house_number-add') }}">
                                    @error('billing_house_number-add')
                                        <div class="error">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="form-input">
                            <label for="billing_postal_code">Postcode <span class="required">*</span></label>
                            <input type="text" name="billing_postal_code" autocomplete="postal-code"
                                value="{{ old('billing_postal_code') }}"
                                placeholder="Postcode">
                            @error('billing_postal_code')
                                <div class="error">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-input">
                            <label for="billing_city">Plaats <span class="required">*</span></label>
                            <input type="text" name="billing_city" autocomplete="address-level2"
                                value="{{ old('billing_city') }}"
                                placeholder="Plaats">
                            @error('billing_city')
                                <div class="error">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-input">
                            <label for="billing_phone">Telefoonnummer</label>
                            <input type="text" name="billing_phone" autocomplete="tel"
                                value="{{ old('billing_phone') }}">
                            @error('billing_phone')
                                <div class="error">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-input">
                            <label for="billing_company">Bedrijfsnaam</label>
                            <input type="text" name="billing_company" autocomplete="organization"
                                value="{{ old('billing_company') }}">
                            @error('billing_company')
                                <div class="error">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-input">
                            <label for="billing_country">Land <span class="required">*</span></label>
                            <select name="billing_country" id="billing_country" autocomplete="country">
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


                        <div style="height: 0px; margin-bottom: 0" class="form-input myparcel_choice"
                            style="visibility: hidden">
                            <input hidden style="height: 0px" type="radio" checked name="myparcel_choice"
                                value="with_myparcel" id="with_myparcel">
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
                                <input type="text" name="shipping_first_name" autocomplete="shipping given-name"
                                    value="{{ old('shipping_first_name') }}">
                                @error('shipping_first_name')
                                    <div class="error">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-input">
                                <label for="shipping_last_name">Achternaam</label>
                                <input type="text" name="shipping_last_name" autocomplete="shipping family-name"
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
                                Adres zoeken <span style="font-weight:400; color:#888; font-size:13px;">(typ om automatisch in te vullen)</span>
                            </label>
                            <input
                                type="text"
                                id="shipping_address_search"
                                placeholder="bijv. Keizersgracht 1, Amsterdam"
                                autocomplete="off"
                                class="address-search-input"
                                onkeydown="if(event.key==='Enter'){event.preventDefault();}"
                            >
                        </div>

                        <div class="street-box">
                            <div class="form-input street">
                                <label for="shipping_street">Straatnaam</label>
                                <input type="text" name="shipping_street" autocomplete="shipping address-line1"
                                    value="{{ old('shipping_street') }}"
                                    placeholder="Straatnaam">
                                @error('shipping_street')
                                    <div class="error">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="housnumber-box">
                                <div class="form-input">
                                    <label for="shipping_house_number">Huisnummer</label>
                                    <input type="number" name="shipping_house_number"
                                        autocomplete="shipping address-line2"
                                        value="{{ old('shipping_house_number') }}"
                                        placeholder="Nr.">
                                    @error('shipping_house_number')
                                        <div class="error">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-input">
                                    <label for="shipping_house_number-add">Toevoeging</label>
                                    <input type="text" name="shipping_house_number-add"
                                        value="{{ old('shipping_house_number-add') }}">
                                    @error('shipping_house_number-add')
                                        <div class="error">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="form-input">
                            <label for="shipping_postal_code">Postcode</label>
                            <input type="text" name="shipping_postal_code" autocomplete="shipping postal-code"
                                value="{{ old('shipping_postal_code') }}"
                                placeholder="Postcode">
                            @error('shipping_postal_code')
                                <div class="error">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-input">
                            <label for="shipping_city">Plaats</label>
                            <input type="text" name="shipping_city" autocomplete="shipping address-level2"
                                value="{{ old('shipping_city') }}"
                                placeholder="Plaats">
                            @error('shipping_city')
                                <div class="error">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-input">
                            <label for="shipping_phone">Telefoonnummer</label>
                            <input type="text" name="shipping_phone" autocomplete="shipping tel"
                                value="{{ old('shipping_phone') }}">
                            @error('shipping_phone')
                                <div class="error">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-input">
                            <label for="shipping_company">Bedrijfsnaam</label>
                            <input type="text" name="shipping_company" autocomplete="shipping organization"
                                value="{{ old('shipping_company') }}">
                            @error('shipping_company')
                                <div class="error">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-input">
                            <label for="shipping_country">Land</label>
                            <select name="shipping_country" id="shipping_country" autocomplete="shipping country">
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

                    <table class="order-table" style="width:100%;">
                        <thead>
                            <tr>
                                <th>Product</th>
                                <th style="text-align:right">Subtotaal</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($cart as $item)
                                <tr>
                                    <td>{{ $item['quantity'] }} &times; {{ $item['name'] }}</td>
                                    <td style="text-align:right">&euro;
                                        {{ number_format($item['subtotal'] ?? $item['price'] * $item['quantity'], 2, ',', '.') }}
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr>
                                <td colspan="2" style="text-align:right; border:none;">
                                    <span id="shipping-cost" style="font-weight:normal;"></span>
                                </td>
                            </tr>
                            <tr class="total-price" id="total-row">
                                <td><strong>Totaal</strong></td>
                                <td style="text-align:right">
                                    <strong id="order-total"
                                        data-subtotal="{{ collect($cart)->sum(fn($i) => $i['price'] * $i['quantity']) }}">&euro;
                                        {{ number_format(collect($cart)->sum(fn($i) => $i['price'] * $i['quantity']), 2, ',', '.') }}</strong>
                                </td>
                            </tr>
                            <tr id="discount-row" style="display:none">
                                <td><span>Korting</span> <span id="discount-code-label"
                                        style="font-size:12px;color:#666;"></span></td>
                                <td style="text-align:right;color:#b30000;">-<span id="discount-amount">0,00</span>
                                </td>
                            </tr>
                            <tr id="new-total-row" style="display:none">
                                <td><strong>Totaal na korting</strong></td>
                                <td style="text-align:right"><strong id="order-new-total">&euro; 0,00</strong></td>
                            </tr>
                        </tfoot>
                    </table>
                    <div id="remove-discount-container" style="display:none;margin-bottom:10px;">
                        <button type="button" id="remove_discount_code" class="btn small"
                            style="background:#eee;color:#b30000;">Verwijder kortingscode</button>
                    </div>

                    <div id="myparcel-delivery-options"></div>

                    <div id="opening-hours" class="pickup-opening-hours"></div>

                    <input type="hidden" name="myparcel_delivery_options" id="myparcel_delivery_options" />

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
                                    <input type="password" name="password">
                                    @error('password')
                                        <div class="error">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-input">
                                    <label for="password_confirmation">Bevestig wachtwoord</label>
                                    <input type="password" name="password_confirmation">
                                </div>
                            </div>
                        </div>
                    @endguest

                    <div class="place-order">
                        @error('myparcel_delivery_options')
                            <div class="error" style="color:#b30000; margin-bottom:10px;">{{ $message }}</div>
                        @enderror
                        <button type="submit" class="btn"><span class="loader"></span>Plaats bestelling</button>
                    </div>
                </div>
            </div>
        </form>
    </main>

    <div class="gradient-border"></div>
    <x-footer></x-footer>
    <script>
        // ─── Helpers ──────────────────────────────────────────────────────────
        function resetMyParcelWidget() {
            // Clear only the hidden input value — do NOT touch innerHTML so the
            // MyParcel library can re-render when a new complete address is entered.
            var myparcelOptions = document.getElementById('myparcel_delivery_options');
            if (myparcelOptions) myparcelOptions.value = '';

            // Ensure the radio is back to the default choice so the widget stays enabled
            var defaultChoice = document.getElementById('with_myparcel');
            if (defaultChoice && !defaultChoice.checked) {
                defaultChoice.checked = true;
                defaultChoice.dispatchEvent(new Event('change', { bubbles: true }));
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
                        billingCard.querySelectorAll('input:not([type="checkbox"]):not([type="radio"]):not([name="_token"]), textarea').forEach(function (el) {
                            el.value = '';
                        });
                        billingCard.querySelectorAll('select').forEach(function (el) {
                            el.selectedIndex = 0;
                        });
                    }

                    // Also clear the autocomplete search box
                    var search = document.getElementById('billing_address_search');
                    if (search) search.value = '';

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

                        // Set select value
                        const selectEl = document.getElementById(fields.countrySelect);
                        if (selectEl) {
                            selectEl.value = countryCode;
                            // Trigger change event for any listeners
                            selectEl.dispatchEvent(new Event('change', { bubbles: true }));
                        }

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

                // Highlight filled fields briefly
                [fields.street, fields.houseNumber, fields.postalCode, fields.city].forEach(sel => {
                    const el = document.querySelector(sel);
                    if (el && el.value) {
                        el.classList.add('address-autofilled');
                        setTimeout(() => el.classList.remove('address-autofilled'), 2500);
                    }
                });

                // Fire input + change events on all filled fields so MyParcel widget
                // and other listeners (shipping cost etc.) react to the new values
                [fields.street, fields.houseNumber, fields.postalCode, fields.city].forEach(sel => {
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

        // ─── Shipping availability popup ─────────────────────────────────────
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
                            Wij bezorgen momenteel naar Nederland en België.<br>
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
        @else
        // Google Maps API key not configured – autocomplete disabled.
        document.querySelectorAll('.address-autocomplete-wrap').forEach(el => el.style.display = 'none');
        @endif
    </script>
</div>
</x-layout>
