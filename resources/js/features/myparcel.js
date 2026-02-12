// MyParcel delivery options widget

/**
 * Initialize MyParcel widget
 */
export function initMyParcelWidget() {

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

            return {
                cc: document.querySelector(`[name="${prefix}country"]`)?.value || 'NL',
                postalCode: (document.querySelector(`[name="${prefix}postal_code"]`)?.value || '')
                    .replace(/\s+/g, '')
                    .toUpperCase(),
                number: number,
                street: street && number ? `${street} ${number}` : street,
                city: document.querySelector(`[name="${prefix}city"]`)?.value || '',
            };
        }

        // Check if address is complete
        function isAddressComplete(address) {
            return address && address.cc && address.postalCode &&
                address.number && address.street && address.city;
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

        // Update MyParcel widget
        function updateWidget() {
            if (!myparcelEnabled) return;

            const address = getCurrentAddress();
            const container = document.querySelector(WIDGET_SELECTOR);

            if (!container) return;

            // Hide if address incomplete
            if (!isAddressComplete(address)) {
                container.style.display = 'none';
                ensureHiddenInput().value = '';
                return;
            }

            container.style.display = '';

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

            // Dispatch to widget
            document.dispatchEvent(
                new CustomEvent('myparcel_update_delivery_options', {
                    detail: configuration
                })
            );
        }

        // Listen for widget updates
        document.addEventListener('myparcel_updated_delivery_options', (event) => {
            if (!myparcelEnabled) return;

            console.log('[MyParcel] Updated:', event.detail);
            const input = ensureHiddenInput();
            input.value = event.detail ? JSON.stringify(event.detail) : '';
        });

        // Listen for errors
        document.addEventListener('myparcel_error_delivery_options', (event) => {
            console.error('[MyParcel] Error:', event.detail);
        });

        // Attach address field listeners (only once)
        let listenersAttached = false;
        function attachAddressListeners() {
            if (listenersAttached) return;
            listenersAttached = true;

            const fields = [
                'billing_country', 'billing_postal_code', 'billing_street',
                'billing_house_number', 'billing_city',
                'shipping_country', 'shipping_postal_code', 'shipping_street',
                'shipping_house_number', 'shipping_city', 'alt-shipping'
            ];

            fields.forEach(fieldName => {
                const element = document.querySelector(`[name="${fieldName}"]`);
                if (element) {
                    element.addEventListener('input', updateWidget);
                    element.addEventListener('change', updateWidget);
                }
            });
        }

        // Enable MyParcel widget
        function enableWidget() {
            if (myparcelEnabled) return;

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
