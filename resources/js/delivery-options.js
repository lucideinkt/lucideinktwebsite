// resources/js/delivery-options.js
// Parses the actual MyParcel API v2 response structure

(function () {

    // ── State ──────────────────────────────────────────────────────────────
    let debounceTimer = null;
    let lastAddress   = '';
    let selectedValue = '';

    // ── Address reader ─────────────────────────────────────────────────────
    function readAddress() {
        const useShipping = document.getElementById('alt-shipping')?.checked;
        const p = useShipping ? 'shipping_' : 'billing_';

        const cc         = document.querySelector(`[name="${p}country"]`)?.value || '';
        const postalCode = (document.querySelector(`[name="${p}postal_code"]`)?.value || '')
                            .replace(/\s+/g, '').toUpperCase();
        const number     = document.querySelector(`[name="${p}house_number"]`)?.value || '';
        const street     = document.querySelector(`[name="${p}street"]`)?.value || '';
        const city       = document.querySelector(`[name="${p}city"]`)?.value || '';

        return { cc, postal_code: postalCode, number, street, city };
    }

    function addressKey(a) {
        return [a.cc, a.postal_code, a.number].join('|').toLowerCase();
    }

    function isComplete(a) {
        return a.cc && a.postal_code && a.number;
    }

    // ── UI helpers ─────────────────────────────────────────────────────────
    const getContainer = () => document.getElementById('custom-delivery-options');
    const getLoader    = () => document.getElementById('cdo-loader');
    const getErrorEl   = () => document.getElementById('cdo-error');
    const getErrorMsg  = () => document.getElementById('cdo-error-msg');

    function showLoader() {
        const c = getContainer();
        if (c) c.style.display = '';
        const l = getLoader();
        if (l) l.style.display = 'flex';
        const e = getErrorEl();
        if (e) e.style.display = 'none';
        const hl = document.getElementById('cdo-home-list');
        if (hl) hl.innerHTML = '';
        const pl = document.getElementById('cdo-pickup-list');
        if (pl) pl.innerHTML = '';
    }

    function hideLoader() {
        const l = getLoader();
        if (l) l.style.display = 'none';
    }

    function showError(msg) {
        hideLoader();
        const e = getErrorEl();
        if (e) e.style.display = 'flex';
        const m = getErrorMsg();
        if (m) m.textContent = msg || 'Bezorgopties konden niet worden geladen.';
    }

    function hideAll() {
        const c = getContainer();
        if (c) c.style.display = 'none';
        selectedValue = '';
        const h = document.getElementById('myparcel_delivery_options');
        if (h) h.value = '';
    }

    // ── Tab switching ──────────────────────────────────────────────────────
    function initTabs() {
        document.querySelectorAll('.cdo-tab').forEach(btn => {
            btn.addEventListener('click', () => {
                document.querySelectorAll('.cdo-tab').forEach(b => b.classList.remove('active'));
                btn.classList.add('active');
                const tab = btn.dataset.tab;
                const homePanel   = document.getElementById('cdo-panel-home');
                const pickupPanel = document.getElementById('cdo-panel-pickup');
                if (homePanel)   homePanel.style.display   = tab === 'home'   ? '' : 'none';
                if (pickupPanel) pickupPanel.style.display = tab === 'pickup' ? '' : 'none';
            });
        });
    }

    // ── Formatting helpers ─────────────────────────────────────────────────
    // dateStr = "2026-04-24 00:00:00.000000"
    function formatDate(dateStr) {
        if (!dateStr) return '';
        const d = new Date(dateStr.replace(' ', 'T').split('.')[0]);
        const today    = new Date(); today.setHours(0,0,0,0);
        const tomorrow = new Date(today); tomorrow.setDate(today.getDate() + 1);
        const dDay = new Date(d); dDay.setHours(0,0,0,0);

        if (dDay.getTime() === today.getTime())    return 'Vandaag';
        if (dDay.getTime() === tomorrow.getTime()) return 'Morgen';

        return dDay.toLocaleDateString('nl-NL', { weekday: 'long', day: 'numeric', month: 'long' });
    }

    // frames = [{ type: "start", date_time: { date: "..." } }, { type: "end", ... }]
    function formatTimeRange(frames) {
        if (!frames || !frames.length) return '';
        const startFrame = frames.find(f => f.type === 'start');
        const endFrame   = frames.find(f => f.type === 'end');
        if (!startFrame || !endFrame) return '';

        const toTime = (dateStr) => {
            const d = new Date(dateStr.replace(' ', 'T').split('.')[0]);
            return d.toLocaleTimeString('nl-NL', { hour: '2-digit', minute: '2-digit' });
        };

        return toTime(startFrame.date_time.date) + '–' + toTime(endFrame.date_time.date);
    }

    function slotLabel(type, frames) {
        const timeRange = formatTimeRange(frames);
        const tr = timeRange ? ` (${timeRange})` : '';
        const labels = {
            morning:  `Ochtend${tr}`,
            standard: `Standaard bezorging${tr}`,
            evening:  `Avond${tr}`,
        };
        return labels[type] || `${type}${tr}`;
    }

    function formatDistance(meters) {
        if (!meters) return '';
        const m = parseInt(meters, 10);
        if (isNaN(m)) return '';
        return m >= 1000
            ? (m / 1000).toFixed(1).replace('.', ',') + ' km'
            : m + ' m';
    }

    function escAttr(str) {
        return str.replace(/'/g, '&#39;');
    }

    // ── Rendering: home delivery ───────────────────────────────────────────
    // Shows a single "Bezorging op het aangegeven verzendadres" option with carrier logo
    function renderHome(deliveries) {
        const list = document.getElementById('cdo-home-list');
        if (!list) return;
        list.innerHTML = '';

        if (!deliveries || !deliveries.length) {
            list.innerHTML = '<p class="cdo-empty">Geen thuisbezorging beschikbaar voor dit adres.</p>';
            return;
        }

        // Pick first standard slot, fallback to first available slot
        let chosenDay  = deliveries[0];
        let chosenSlot = null;
        outer: for (const day of deliveries) {
            for (const slot of (day.possibilities || [])) {
                if (slot.type === 'standard') { chosenDay = day; chosenSlot = slot; break outer; }
            }
        }
        if (!chosenSlot && chosenDay.possibilities && chosenDay.possibilities.length) {
            chosenSlot = chosenDay.possibilities[0];
        }
        if (!chosenSlot) {
            list.innerHTML = '<p class="cdo-empty">Geen thuisbezorging beschikbaar voor dit adres.</p>';
            return;
        }

        const dateStr = chosenDay.date && chosenDay.date.date ? chosenDay.date.date : '';
        const value = JSON.stringify({
            deliveryType: chosenSlot.type ?? 'standard',   // controller reads 'deliveryType'
            date:         dateStr,
            slot:         chosenSlot.type,
            frames:       chosenSlot.delivery_time_frames || [],
        });

        const label = document.createElement('label');
        label.className = 'cdo-option cdo-home-single';
        label.innerHTML = `
            <input type="radio" name="cdo_choice" value='${escAttr(value)}' checked>
            <span class="cdo-option-inner">
                <span class="cdo-home-carrier-row">
                    <span class="cdo-carrier-badge">
                        <i class="fa-solid fa-truck" style="color:#f60;font-size:18px;"></i>
                        <span class="cdo-carrier-name">PostNL</span>
                    </span>
                    <span class="cdo-option-name">Bezorging op het aangegeven verzendadres</span>
                </span>
            </span>
        `;
        list.appendChild(label);

        // Auto-select this single option
        selectedValue = value;
        const h = document.getElementById('myparcel_delivery_options');
        if (h) h.value = selectedValue;

        attachRadioListeners(list);
    }

    // ── Rendering: pickup locations ────────────────────────────────────────
    // Real API: data.pickup_locations[].address + .location.location_name + .location.distance
    function renderPickup(locations) {
        const list = document.getElementById('cdo-pickup-list');
        if (!list) return;
        list.innerHTML = '';

        if (!locations || !locations.length) {
            list.innerHTML = '<p class="cdo-empty">Geen afhaalpunten gevonden in de buurt.</p>';
            return;
        }

        const INITIAL_COUNT = 4;

        // Scrollable wrapper
        const scrollWrap = document.createElement('div');
        scrollWrap.className = 'cdo-pickup-scroll';
        list.appendChild(scrollWrap);

        function buildLabel(loc) {
            const addr = loc.address  || {};
            const info = loc.location || {};

            const value = JSON.stringify({
                deliveryType: 'pickup',         // controller checks deliveryType === 'pickup'
                pickup: {                       // controller reads delivery['pickup']
                    location_code:    info.location_code  ?? '',
                    locationName:     info.location_name  ?? '',
                    street:           addr.street         ?? '',
                    number:           addr.number         ?? '',
                    city:             addr.city           ?? '',
                    postalCode:       addr.postal_code    ?? '',   // API returns snake_case
                    cc:               addr.cc             ?? 'NL',
                    retail_network_id: info.retail_network_id ?? 'PNPNL-01',
                    carrier:          info.carrier        ?? 'postnl',
                },
            });

            const distText = info.distance
                ? `<span class="cdo-option-distance">${formatDistance(info.distance)}</span>`
                : '';

            const label = document.createElement('label');
            label.className = 'cdo-option cdo-pickup';
            label.innerHTML = `
                <input type="radio" name="cdo_choice" value='${escAttr(value)}'>
                <span class="cdo-option-inner">
                    <span class="cdo-option-name">${info.location_name || ''}</span>
                    <span class="cdo-option-address">${addr.street || ''} ${addr.number || ''}, ${addr.city || ''}</span>
                    ${distText}
                </span>
            `;
            return label;
        }

        // Render initial batch
        locations.slice(0, INITIAL_COUNT).forEach(loc => scrollWrap.appendChild(buildLabel(loc)));
        attachRadioListeners(scrollWrap);

        // "Toon meer" button if more locations available
        if (locations.length > INITIAL_COUNT) {
            const remaining = locations.length - INITIAL_COUNT;
            const moreBtn = document.createElement('button');
            moreBtn.type      = 'button';
            moreBtn.className = 'cdo-more-btn';
            moreBtn.innerHTML = `<i class="fa-solid fa-chevron-down"></i> Toon meer afhaalpunten (${remaining} meer)`;
            moreBtn.addEventListener('click', () => {
                locations.slice(INITIAL_COUNT).forEach(loc => scrollWrap.appendChild(buildLabel(loc)));
                attachRadioListeners(scrollWrap);
                moreBtn.remove();
            });
            list.appendChild(moreBtn);
        }
    }

    function attachRadioListeners(container) {
        container.querySelectorAll('input[type="radio"]').forEach(radio => {
            radio.addEventListener('change', e => {
                selectedValue = e.target.value;
                const h = document.getElementById('myparcel_delivery_options');
                if (h) h.value = selectedValue;
            });
        });
    }

    // ── API fetch ──────────────────────────────────────────────────────────
    async function fetchOptions(address) {
        const params = new URLSearchParams({
            cc:          address.cc,
            postal_code: address.postal_code,
            number:      address.number,
        }).toString();

        const csrfMeta  = document.querySelector('meta[name="csrf-token"]');
        const headers   = csrfMeta ? { 'X-CSRF-TOKEN': csrfMeta.content } : {};

        const [deliveryRes, pickupRes] = await Promise.all([
            fetch(`/api/myparcel/delivery-options?${params}`, { headers }),
            fetch(`/api/myparcel/pickup-locations?${params}`,  { headers }),
        ]);

        if (!deliveryRes.ok || !pickupRes.ok) {
            throw new Error(`API error: delivery=${deliveryRes.status} pickup=${pickupRes.status}`);
        }

        const delivery = await deliveryRes.json();
        const pickup   = await pickupRes.json();

        return {
            deliveries: delivery?.data?.deliveries        ?? [],
            locations:  pickup?.data?.pickup_locations     ?? [],
        };
    }

    // ── Main trigger ───────────────────────────────────────────────────────
    function triggerFetch() {
        clearTimeout(debounceTimer);
        debounceTimer = setTimeout(async () => {
            const address = readAddress();

            if (!isComplete(address)) {
                hideAll();
                return;
            }

            const key = addressKey(address);
            if (key === lastAddress) return;
            lastAddress = key;

            showLoader();

            try {
                const { deliveries, locations } = await fetchOptions(address);
                hideLoader();
                renderHome(deliveries);
                renderPickup(locations);
            } catch (err) {
                console.error('[CDO] Fetch failed:', err);
                showError('Bezorgopties konden niet worden geladen. Probeer het opnieuw.');
                lastAddress = '';
            }
        }, 600);
    }

    // ── Event listeners ────────────────────────────────────────────────────
    const watchedFields = [
        'billing_country',  'billing_postal_code',  'billing_house_number',
        'billing_street',   'billing_city',
        'shipping_country', 'shipping_postal_code', 'shipping_house_number',
        'shipping_street',  'shipping_city',
    ];

    function attachFieldListeners() {
        watchedFields.forEach(name => {
            const el = document.querySelector(`[name="${name}"]`);
            if (!el) return;
            el.addEventListener('input',  triggerFetch);
            el.addEventListener('change', triggerFetch);
        });

        const altShipping = document.getElementById('alt-shipping');
        altShipping?.addEventListener('change', () => {
            lastAddress = '';
            triggerFetch();
        });

        document.addEventListener('addressAutofilled', () => {
            lastAddress = '';
            setTimeout(triggerFetch, 200);
        });

        // Polling fallback for autofill (password managers etc.)
        let pollCount = 0;
        const poll = setInterval(() => {
            triggerFetch();
            if (++pollCount >= 10) clearInterval(poll);
        }, 800);
    }

    // ── Init ───────────────────────────────────────────────────────────────
    document.addEventListener('DOMContentLoaded', () => {
        if (!document.getElementById('custom-delivery-options')) return;

        if (!document.getElementById('cdo-spin-style')) {
            const style = document.createElement('style');
            style.id = 'cdo-spin-style';
            style.textContent = '@keyframes cdo-spin { to { transform: rotate(360deg); } }';
            document.head.appendChild(style);
        }

        initTabs();
        attachFieldListeners();

        setTimeout(triggerFetch, 300);
        setTimeout(triggerFetch, 1000);
    });

    // Exposed for clear-fields buttons
    window.resetDeliveryOptions = function () {
        lastAddress   = '';
        selectedValue = '';
        const h = document.getElementById('myparcel_delivery_options');
        if (h) h.value = '';
        hideAll();
    };

})();
