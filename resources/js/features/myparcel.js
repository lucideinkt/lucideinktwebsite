// MyParcel delivery options widget

/**
 * Initialize MyParcel widget
 */
export function initMyParcelWidget() {

        // ─── MyParcel loader helpers ─────────────────────────────────────────
        const LOADER_ID = 'myparcel-loading-spinner';
        const LOADER_MIN_MS = 1500; // minimum time the loader stays visible
        let _loaderShownAt = 0;
        let _loaderHideTimer = null;

        function showMyParcelLoader(container) {
            if (!container) return;
            clearTimeout(_loaderHideTimer);

            // Collapse the widget with no visible space while loading
            container.classList.remove('myparcel-revealed');
            container.classList.add('myparcel-hidden');

            // Inject transition styles once
            if (!document.getElementById('myparcel-spin-style')) {
                const style = document.createElement('style');
                style.id = 'myparcel-spin-style';
                style.textContent = `
                    @keyframes myparcel-spin{to{transform:rotate(360deg)}}
                    .myparcel-hidden{max-height:0!important;overflow:hidden!important;opacity:0!important;margin:0!important;padding:0!important;}
                    .myparcel-revealed{max-height:600px;overflow:visible;opacity:1;transition:max-height 0.45s ease,opacity 0.35s ease 0.1s;}
                `;
                document.head.appendChild(style);
            }

            // Use a sibling wrapper so the Vue mount doesn't destroy the loader
            let wrap = document.getElementById('myparcel-loader-wrap');
            if (!wrap) {
                wrap = document.createElement('div');
                wrap.id = 'myparcel-loader-wrap';
                container.parentNode.insertBefore(wrap, container);
            }

            wrap.innerHTML = `
                <div id="${LOADER_ID}" style="
                    display:flex;align-items:center;gap:10px;
                    padding:14px 0 6px;
                    color:#888;font-size:14px;
                ">
                    <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 24 24" fill="none"
                         style="animation:myparcel-spin 0.8s linear infinite;flex-shrink:0;">
                        <circle cx="12" cy="12" r="10" stroke="#d0d0d0" stroke-width="3"/>
                        <path d="M12 2a10 10 0 0 1 10 10" stroke="#6c8ebf" stroke-width="3" stroke-linecap="round"/>
                    </svg>
                    <span>Bezorgopties worden geladen…</span>
                </div>
            `;
            _loaderShownAt = Date.now();
        }

        function hideMyParcelLoader() {
            clearTimeout(_loaderHideTimer);
            const elapsed = Date.now() - _loaderShownAt;
            const remaining = LOADER_MIN_MS - elapsed;
            if (remaining > 0) {
                _loaderHideTimer = setTimeout(() => _doHideLoader(true), remaining);
            } else {
                _doHideLoader(true);
            }
        }

        // Cancel the loader without revealing the widget (used when address becomes incomplete)
        function cancelMyParcelLoader() {
            clearTimeout(_loaderHideTimer);
            _doHideLoader(false);
        }

        function _doHideLoader(reveal) {
            // Clear the loader UI
            const wrap = document.getElementById('myparcel-loader-wrap');
            if (wrap) wrap.innerHTML = '';

            if (reveal) {
                // Smoothly reveal the widget
                const container = document.querySelector(WIDGET_SELECTOR);
                if (container) {
                    container.classList.remove('myparcel-hidden');
                    container.classList.add('myparcel-revealed');
                }
            }
        }

        // ─── MyParcel widget events ──────────────────────────────────────────
        const WIDGET_SELECTOR = '#myparcel-delivery-options';
        const myparcelRadios = document.querySelectorAll('input[name="myparcel_choice"]');

        let myparcelEnabled = false;

        // Get currently selected MyParcel choice
        function getCurrentChoice() {
            const checked = document.querySelector('input[name="myparcel_choice"]:checked');
            return checked ? checked.value : undefined;
        }

        // Get current address details
        function getCurrentAddress() {
            const useAlternate = document.getElementById('alt-shipping')?.checked;
            const prefix = useAlternate ? 'shipping_' : 'billing_';

            const street = document.querySelector(`[name="${prefix}street"]`)?.value || '';
            const number = document.querySelector(`[name="${prefix}house_number"]`)?.value || '';
            const cc     = document.querySelector(`[name="${prefix}country"]`)?.value || '';

            return {
                cc: cc,
                postalCode: (document.querySelector(`[name="${prefix}postal_code"]`)?.value || '')
                    .replace(/\s+/g, '')
                    .toUpperCase(),
                number: number,
                street: street && number ? `${street} ${number}` : street,
                city: document.querySelector(`[name="${prefix}city"]`)?.value || '',
            };
        }

        // Check if address is complete (country must be explicitly chosen)
        function isAddressComplete(address) {
            return address &&
                address.cc && address.cc.trim() !== '' &&
                address.postalCode && address.number &&
                address.street && address.city;
        }

        // Ensure hidden input exists
        function ensureHiddenInput() {
            let input = document.getElementById('myparcel_delivery_options');

            if (!input) {
                input = document.createElement('input');
                input.type = 'hidden';
                input.id = 'myparcel_delivery_options';
                input.name = 'myparcel_delivery_options';
                document.querySelector('form')?.appendChild(input);
            }

            return input;
        }

        // Get locale strings for widget
        function getLocaleStrings(locale) {
            const strings = {
                nl: {
                    deliveryTitle: 'Levering thuis of op het werk',
                    pickupTitle: 'Ophalen bij een afleverpunt',
                    deliveryStandardTitle: 'Standaard bezorging',
                    deliveryMorningTitle: 'Ochtend bezorging',
                    deliveryEveningTitle: 'Avond bezorging',
                    deliveryStandard: 'Thuisbezorging',
                    deliveryMorning: 'Ochtend bezorging (08:00 - 12:00)',
                    deliveryEvening: 'Avond bezorging (18:00 - 22:00)',
                    pickupAt: 'Ophalen bij',
                    pickupLocationsListButton: 'Lijst',
                    pickupLocationsMapButton: 'Kaart',
                    signatureTitle: 'Handtekening bij ontvangst',
                    onlyRecipientTitle: 'Alleen aan geadresseerde',
                    insuranceTitle: 'Extra verzekerd tot',
                    insurance500: '€ 500',
                    insurance1000: '€ 1.000',
                    insurance1500: '€ 1.500',
                    insurance2000: '€ 2.000',
                    insurance2500: '€ 2.500',
                    free: 'Gratis',
                    close: 'Sluiten',
                    loading: 'Opties laden...',
                    retry: 'Opnieuw proberen',
                    address: 'Adres',
                    city: 'Plaats',
                    openingHours: 'Openingstijden',
                    closed: 'Gesloten',
                    from: 'Vanaf',
                    loadMore: 'Meer laden',
                    pickupLocation: 'Afhaalpunt',
                    wrongPostalCodeCity: 'Verkeerde postcode/plaats combinatie',
                    addressNotFound: 'Adres niet gevonden',
                    saturdayDelivery: 'Zaterdag bezorgen',
                    mondayDelivery: 'Maandag bezorgen',
                    showMoreLocations: 'Laat meer locaties zien',
                    parcelLocker: 'Pakketkluis',
                    list: 'Lijst',
                    map: 'Kaart'
                },
                en: {
                    deliveryTitle: 'Home or work delivery',
                    pickupTitle: 'Pick up at a service point',
                    deliveryStandardTitle: 'Standard delivery',
                    deliveryMorningTitle: 'Morning delivery',
                    deliveryEveningTitle: 'Evening delivery',
                    deliveryStandard: 'Home delivery',
                    deliveryMorning: 'Morning delivery (08:00 - 12:00)',
                    deliveryEvening: 'Evening delivery (18:00 - 22:00)',
                    pickupAt: 'Pick up at',
                    pickupLocationsListButton: 'List',
                    pickupLocationsMapButton: 'Map',
                    signatureTitle: 'Signature on receipt',
                    onlyRecipientTitle: 'Deliver to recipient only',
                    insuranceTitle: 'Extra insured up to',
                    insurance500: '€ 500',
                    insurance1000: '€ 1,000',
                    insurance1500: '€ 1,500',
                    insurance2000: '€ 2,000',
                    insurance2500: '€ 2,500',
                    free: 'Free',
                    close: 'Close',
                    loading: 'Loading options...',
                    retry: 'Retry',
                    address: 'Address',
                    city: 'City',
                    openingHours: 'Opening hours',
                    closed: 'Closed',
                    from: 'From',
                    loadMore: 'Load more',
                    pickupLocation: 'Pickup location',
                    wrongPostalCodeCity: 'Wrong postal code/city combination',
                    addressNotFound: 'Address not found',
                    saturdayDelivery: 'Saturday delivery',
                    mondayDelivery: 'Monday delivery',
                    showMoreLocations: 'Show more locations',
                    parcelLocker: 'Parcel locker',
                    list: 'List',
                    map: 'Map'
                }
            };

            return strings[locale] || strings['en'];
        }

        // Debounce timer for widget updates
        let updateWidgetTimer = null;
        let lastDispatchedCountry = null;

        // Address signature — used to skip redundant widget reloads
        let lastAddressSignature = '';

        function buildAddressSignature(address) {
            return [
                address.cc,
                address.postalCode,
                address.number,
                address.street,
                address.city
            ].join('|').toLowerCase();
        }

        function updateWidget() {
            if (!myparcelEnabled) return;

            const address = getCurrentAddress();
            const container = document.querySelector(WIDGET_SELECTOR);
            if (!container) return;

            // Hide immediately when address is incomplete
            if (!isAddressComplete(address)) {
                clearTimeout(updateWidgetTimer);
                container.classList.remove('myparcel-revealed');
                container.classList.add('myparcel-hidden');
                cancelMyParcelLoader();
                ensureHiddenInput().value = '';
                lastDispatchedCountry = null;
                lastAddressSignature = '';
                return;
            }

            // When country changes hide immediately so stale locations aren't visible
            if (address.cc !== lastDispatchedCountry) {
                clearTimeout(updateWidgetTimer);
                container.classList.remove('myparcel-revealed');
                container.classList.add('myparcel-hidden');
                ensureHiddenInput().value = '';
                lastAddressSignature = '';
            }

            // Skip if the address hasn't actually changed
            const sig = buildAddressSignature(address);
            if (sig === lastAddressSignature) return;

            // Debounce so we don't fire on every keystroke
            clearTimeout(updateWidgetTimer);
            updateWidgetTimer = setTimeout(function () {
                // Re-check signature inside the timeout in case several fields
                // changed together (autofill) and the last one just arrived
                const freshAddress = getCurrentAddress();
                const freshSig = buildAddressSignature(freshAddress);
                if (freshSig === lastAddressSignature) return;
                lastAddressSignature = freshSig;
                dispatchWidgetUpdate(freshAddress, container);
            }, 600);
        }

        // Actually dispatch the update to the MyParcel library
        function dispatchWidgetUpdate(address, container) {
            if (!myparcelEnabled) return;

            // Record the country we are about to load, so the next updateWidget()
            // call can detect a country change and clear stale pickup locations.
            lastDispatchedCountry = address.cc;

            showMyParcelLoader(container);

            // Get locale
            let locale = document.documentElement.lang ||
                document.querySelector('meta[name="app-locale"]')?.content;
            if (!locale || locale.length < 2) locale = 'en';

            // Configure widget
            const configuration = {
                selector: WIDGET_SELECTOR,
                address: address,
                config: {
                    platform: 'myparcel',
                    locale: locale,
                    packageType: 'package',
                    dropOffDelay: 1,
                    deliveryDaysWindow: 0,
                    allowPickupLocationsViewSelection: true,
                    pickupLocationsDefaultView: 'list',
                    showPriceZeroAsFree: false,
                    carrierSettings: {
                        postnl: {
                            allowDeliveryOptions: true,
                            allowStandardDelivery: true,
                            allowPickupLocations: true,
                            allowSignature: false,           // Handtekening uitschakelen
                            allowOnlyRecipient: false        // Alleen aan geadresseerde uitschakelen
                        }
                    }
                },
                strings: getLocaleStrings(locale)
            };

            // Always use myparcel_render_delivery_options — this event re-initialises
            // the Vue app from scratch every time, re-registers itself as a listener,
            // and fully replaces any previously rendered pickup locations.
            // (myparcel_update_delivery_options removes itself after the first render,
            //  so it cannot be used for subsequent updates.)
            document.dispatchEvent(
                new CustomEvent('myparcel_render_delivery_options', {
                    detail: configuration
                })
            );
        }

        // Listen for Google Places address autofill.
        // Wait 300ms so all fields are fully set, then force a fresh widget update
        // so pickup locations reload for the new address.
        document.addEventListener('addressAutofilled', () => {
            setTimeout(() => updateWidget(), 300);
        });

        // Listen for widget updates
        document.addEventListener('myparcel_updated_delivery_options', (event) => {
            if (!myparcelEnabled) return;
            hideMyParcelLoader();
            console.log('[MyParcel] Updated:', event.detail);
            const input = ensureHiddenInput();
            input.value = event.detail ? JSON.stringify(event.detail) : '';
        });

        // Listen for errors
        document.addEventListener('myparcel_error_delivery_options', (event) => {
            hideMyParcelLoader();
            console.error('[MyParcel] Error:', event.detail);
        });

        // Attach address field listeners (only once)
        let listenersAttached = false;

        // Selector list used for both event delegation and polling
        const ADDRESS_FIELD_NAMES = [
            'billing_country', 'billing_postal_code', 'billing_street',
            'billing_house_number', 'billing_city',
            'shipping_country', 'shipping_postal_code', 'shipping_street',
            'shipping_house_number', 'shipping_city',
        ];
        const ADDRESS_FIELD_SELECTOR = ADDRESS_FIELD_NAMES.map(n => `[name="${n}"]`).join(',');

        function scheduleUpdate() {
            setTimeout(updateWidget, 100);
        }

        function attachAddressListeners() {
            if (listenersAttached) return;
            listenersAttached = true;

            ADDRESS_FIELD_NAMES.forEach(fieldName => {
                const element = document.querySelector(`[name="${fieldName}"]`);
                if (element) {
                    // input + change for manual typing/selecting; blur catches autofill on tab
                    element.addEventListener('input',  scheduleUpdate);
                    element.addEventListener('change', scheduleUpdate);
                    element.addEventListener('blur',   scheduleUpdate);
                }
            });

            // When the alt-shipping checkbox changes, always re-evaluate the widget
            // so it immediately shows/hides based on whichever address is now active
            const altShipping = document.querySelector('[name="alt-shipping"]') ||
                                 document.getElementById('alt-shipping');
            if (altShipping) {
                altShipping.addEventListener('change', updateWidget);
            }

            // ── Autofill-safe detection ──────────────────────────────────────
            // Browser autofill can bypass input/change/blur — so we add extra fallbacks.

            // 1. focusin: re-check whenever the user enters an address field
            document.addEventListener('focusin', (e) => {
                if (e.target.matches(ADDRESS_FIELD_SELECTOR)) {
                    scheduleUpdate();
                }
            });

            // 2. Delayed checks after page load (catches autocomplete that fires on render)
            window.addEventListener('load', () => {
                setTimeout(updateWidget, 300);
                setTimeout(updateWidget, 1000);
                setTimeout(updateWidget, 2500);
            });

            // 3. Short-lived polling fallback — checks for 10 s after listeners are first attached.
            //    This catches browser autofill that fires asynchronously (e.g. iOS, Chrome on Android).
            let pollCount = 0;
            const autofillWatcher = setInterval(() => {
                updateWidget();
                pollCount++;
                if (pollCount >= 20) clearInterval(autofillWatcher);
            }, 500);
        }

        // Enable MyParcel widget
        function enableWidget() {
            if (myparcelEnabled) {
                // Already enabled — still re-evaluate in case the active address changed
                updateWidget();
                return;
            }

            myparcelEnabled = true;
            const container = document.querySelector(WIDGET_SELECTOR);
            if (container) container.style.display = '';

            attachAddressListeners();
            updateWidget();
        }

        // Disable MyParcel widget
        function disableWidget() {
            if (!myparcelEnabled) return;

            myparcelEnabled = false;
            lastDispatchedCountry = null;
            lastAddressSignature = '';
            const container = document.querySelector(WIDGET_SELECTOR);

            if (container) {
                container.style.display = 'none';
                container.innerHTML = '';
            }

            const input = document.getElementById('myparcel_delivery_options');
            if (input) {
                input.value = '';
                input.remove();
            }
        }

        // Force resize SVG icons to 15px (fixes iOS display issue)
        function forceSvgResize() {
            const svgs = document.querySelectorAll('.myparcel-delivery-options svg');
            const spans = document.querySelectorAll('.myparcel-delivery-options label > span > span');

            svgs.forEach(svg => {
                svg.style.setProperty('height', '15px', 'important');
                svg.style.setProperty('width', '15px', 'important');
                svg.style.setProperty('max-height', '15px', 'important');
                svg.style.setProperty('max-width', '15px', 'important');
                svg.setAttribute('height', '15');
                svg.setAttribute('width', '15');
            });

            spans.forEach(span => {
                span.style.setProperty('height', '15px', 'important');
                span.style.setProperty('width', '15px', 'important');
                span.style.setProperty('max-height', '15px', 'important');
                span.style.setProperty('max-width', '15px', 'important');
            });
        }

        // Observe widget container for changes and resize SVGs
        const container = document.querySelector(WIDGET_SELECTOR);
        if (container) {
            const observer = new MutationObserver((mutations) => {
                // Check if SVGs were added
                const hasSvgChanges = mutations.some(mutation =>
                    Array.from(mutation.addedNodes).some(node =>
                        node.nodeType === 1 && (node.tagName === 'SVG' || node.querySelector('svg'))
                    )
                );

                if (hasSvgChanges) {
                    forceSvgResize();
                }
            });

            observer.observe(container, {
                childList: true,
                subtree: true
            });

            // Also run on initial load with delay
            setTimeout(forceSvgResize, 100);
            setTimeout(forceSvgResize, 500);
            setTimeout(forceSvgResize, 1000);
        }

        // Listen for radio changes
        myparcelRadios.forEach(radio => {
            radio.addEventListener('change', (event) => {
                if (!event.target.checked) return;

                const choice = event.target.value;
                console.log('MyParcel choice:', choice);

                if (choice === 'with_myparcel') {
                    enableWidget();
                } else {
                    disableWidget();
                }
            });
        });

        // Initialize based on current selection
        const currentChoice = getCurrentChoice();
        if (currentChoice === 'with_myparcel') {
            enableWidget();
        } else {
            disableWidget();
        }

}
