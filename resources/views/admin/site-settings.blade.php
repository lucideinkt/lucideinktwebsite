<x-dashboard-layout>

  @if(session('success'))
    <div class="flex items-center p-4 mb-6 text-sm text-green-800 rounded-lg bg-green-50 dark:bg-gray-800 dark:text-green-400" role="alert">
      <svg class="shrink-0 inline w-4 h-4 me-3" fill="currentColor" viewBox="0 0 20 20"><path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z"/></svg>
      {{ session('success') }}
    </div>
  @endif

  @if(session('mail_test_success'))
    <div class="flex items-center p-4 mb-6 text-sm text-green-800 rounded-lg bg-green-50 dark:bg-gray-800 dark:text-green-400" role="alert">
      <svg class="shrink-0 inline w-4 h-4 me-3" fill="currentColor" viewBox="0 0 20 20"><path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z"/></svg>
      ✅ {{ session('mail_test_success') }}
    </div>
  @endif

  @if(session('mail_test_error'))
    <div class="flex items-center p-4 mb-6 text-sm text-red-800 rounded-lg bg-red-50 dark:bg-gray-800 dark:text-red-400" role="alert">
      <svg class="shrink-0 inline w-4 h-4 me-3" fill="currentColor" viewBox="0 0 20 20"><path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z"/></svg>
      ❌ {{ session('mail_test_error') }}
    </div>
  @endif

  <div class="mb-6">
    <h2 class="text-2xl font-bold text-gray-900 dark:text-white">Site-instellingen</h2>
    <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">Beheer de live-instellingen van de webshop zonder de server aan te raken.</p>
  </div>

  <form method="POST" action="{{ route('admin.settings.update') }}">
    @csrf

    <div class="grid grid-cols-1 gap-6 lg:grid-cols-2">

      {{-- ── Onderhoudsmodus ── --}}
      <div class="p-6 bg-white rounded-lg shadow dark:bg-gray-800">
        <div class="flex items-center gap-3 mb-4">
          <div class="p-2 bg-orange-100 dark:bg-orange-900 rounded-lg">
            <svg class="w-5 h-5 text-orange-600 dark:text-orange-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01M10.29 3.86L1.82 18a2 2 0 001.71 3h16.94a2 2 0 001.71-3L13.71 3.86a2 2 0 00-3.42 0z"/>
            </svg>
          </div>
          <div>
            <h3 class="font-semibold text-gray-900 dark:text-white">Onderhoudsmodus</h3>
            <p class="text-xs text-gray-500 dark:text-gray-400">Bezoekers zien een "Binnenkort online" pagina. Admins kunnen gewoon inloggen.</p>
          </div>
        </div>
        <label class="inline-flex items-center cursor-pointer">
          <input type="checkbox" name="maintenance_mode" value="1" class="sr-only peer"
            {{ $settings['maintenance_mode'] === '1' ? 'checked' : '' }}>
          <div class="relative w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-orange-300 dark:peer-focus:ring-orange-800 rounded-full peer dark:bg-gray-700 peer-checked:after:translate-x-full rtl:peer-checked:after:-translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:start-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all dark:border-gray-600 peer-checked:bg-orange-500"></div>
          <span class="ms-3 text-sm font-medium text-gray-700 dark:text-gray-300">
            {{ $settings['maintenance_mode'] === '1' ? 'Ingeschakeld' : 'Uitgeschakeld' }}
          </span>
        </label>
        @if($settings['maintenance_mode'] === '1')
          <p class="mt-3 text-xs text-orange-600 dark:text-orange-400 font-semibold">⚠️ Site is nu offline voor bezoekers</p>
        @endif
      </div>

      {{-- ── Mollie betalingsmodus ── --}}
      <div class="p-6 bg-white rounded-lg shadow dark:bg-gray-800">
        <div class="flex items-center gap-3 mb-4">
          <div class="p-2 bg-blue-100 dark:bg-blue-900 rounded-lg">
            <svg class="w-5 h-5 text-blue-600 dark:text-blue-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"/>
            </svg>
          </div>
          <div>
            <h3 class="font-semibold text-gray-900 dark:text-white">Mollie betalingen</h3>
            <p class="text-xs text-gray-500 dark:text-gray-400">Schakel tussen test- en livemodus voor betalingen.</p>
          </div>
        </div>
        <div class="flex gap-3">
          <label class="flex items-center gap-2 cursor-pointer px-4 py-2 rounded-lg border-2 transition-all
            {{ $settings['mollie_mode'] === 'test' ? 'border-blue-500 bg-blue-50 dark:bg-blue-900/30' : 'border-gray-200 dark:border-gray-700' }}">
            <input type="radio" name="mollie_mode" value="test" class="accent-blue-500"
              {{ $settings['mollie_mode'] === 'test' ? 'checked' : '' }}>
            <span class="text-sm font-medium text-gray-700 dark:text-gray-300">Test</span>
          </label>
          <label class="flex items-center gap-2 cursor-pointer px-4 py-2 rounded-lg border-2 transition-all
            {{ $settings['mollie_mode'] === 'live' ? 'border-green-500 bg-green-50 dark:bg-green-900/30' : 'border-gray-200 dark:border-gray-700' }}">
            <input type="radio" name="mollie_mode" value="live" class="accent-green-500"
              {{ $settings['mollie_mode'] === 'live' ? 'checked' : '' }}>
            <span class="text-sm font-medium text-gray-700 dark:text-gray-300">Live</span>
          </label>
        </div>
        <p class="mt-3 text-xs {{ $settings['mollie_mode'] === 'live' ? 'text-green-600 dark:text-green-400 font-semibold' : 'text-blue-600 dark:text-blue-400' }}">
          {{ $settings['mollie_mode'] === 'live' ? '✓ Echte betalingen actief' : 'ℹ Testmodus — geen echte betalingen' }}
        </p>
      </div>

      {{-- ── E-mail provider (read-only, determined by APP_ENV) ── --}}
      <div class="p-6 bg-white rounded-lg shadow dark:bg-gray-800">
        <div class="flex items-center gap-3 mb-4">
          <div class="p-2 bg-purple-100 dark:bg-purple-900 rounded-lg">
            <svg class="w-5 h-5 text-purple-600 dark:text-purple-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
            </svg>
          </div>
          <div>
            <h3 class="font-semibold text-gray-900 dark:text-white">E-mail provider</h3>
            <p class="text-xs text-gray-500 dark:text-gray-400">Automatisch bepaald op basis van de omgeving (APP_ENV).</p>
          </div>
        </div>
        @if(app()->environment('production'))
          <p class="text-sm font-semibold text-green-600 dark:text-green-400">✓ Productie — Eigen SMTP (info@lucideinkt.nl)</p>
        @else
          <p class="text-sm font-semibold text-yellow-600 dark:text-yellow-400">ℹ {{ ucfirst(app()->environment()) }} — Mailtrap (test-inbox)</p>
        @endif
        {{-- Test mail button --}}
        <button type="submit" form="test-mail-form"
          class="mt-4 inline-flex items-center gap-2 px-4 py-2 text-xs font-medium text-white bg-indigo-600 hover:bg-indigo-700 rounded-lg transition-colors">
          <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
          </svg>
          Test e-mail versturen
        </button>
      </div>

      {{-- ── Debug informatie ── --}}
      <div class="p-6 bg-white rounded-lg shadow dark:bg-gray-800">
        <div class="flex items-center gap-3 mb-4">
          <div class="p-2 bg-gray-100 dark:bg-gray-700 rounded-lg">
            <svg class="w-5 h-5 text-gray-600 dark:text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 20l4-16m4 4l4 4-4 4M6 16l-4-4 4-4"/>
            </svg>
          </div>
          <div>
            <h3 class="font-semibold text-gray-900 dark:text-white">Debug-informatie</h3>
            <p class="text-xs text-gray-500 dark:text-gray-400">Toon extra technische informatie voor admins (foutmeldingen, logs). Nooit inschakelen voor klanten.</p>
          </div>
        </div>
        <label class="inline-flex items-center cursor-pointer">
          <input type="checkbox" name="debug_info" value="1" class="sr-only peer"
            {{ $settings['debug_info'] === '1' ? 'checked' : '' }}>
          <div class="relative w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-gray-300 dark:peer-focus:ring-gray-600 rounded-full peer dark:bg-gray-700 peer-checked:after:translate-x-full rtl:peer-checked:after:-translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:start-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all dark:border-gray-600 peer-checked:bg-gray-600"></div>
          <span class="ms-3 text-sm font-medium text-gray-700 dark:text-gray-300">
            {{ $settings['debug_info'] === '1' ? 'Ingeschakeld' : 'Uitgeschakeld' }}
          </span>
        </label>
      </div>

      {{-- ── Zoekmachines ── --}}
      <div class="p-6 bg-white rounded-lg shadow dark:bg-gray-800">
        <div class="flex items-center gap-3 mb-4">
          <div class="p-2 bg-teal-100 dark:bg-teal-900 rounded-lg">
            <svg class="w-5 h-5 text-teal-600 dark:text-teal-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
            </svg>
          </div>
          <div>
            <h3 class="font-semibold text-gray-900 dark:text-white">Zoekmachines (SEO indexering)</h3>
            <p class="text-xs text-gray-500 dark:text-gray-400">Sta Google en andere zoekmachines toe de site te indexeren. Schakel dit alleen in als de site live en klaar is.</p>
          </div>
        </div>
        <label class="inline-flex items-center cursor-pointer">
          <input type="checkbox" name="allow_indexing" value="1" class="sr-only peer"
            {{ $settings['allow_indexing'] === '1' ? 'checked' : '' }}>
          <div class="relative w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-teal-300 dark:peer-focus:ring-teal-800 rounded-full peer dark:bg-gray-700 peer-checked:after:translate-x-full rtl:peer-checked:after:-translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:start-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all dark:border-gray-600 peer-checked:bg-teal-500"></div>
          <span class="ms-3 text-sm font-medium text-gray-700 dark:text-gray-300">
            {{ $settings['allow_indexing'] === '1' ? '✓ Toegestaan — Google kan de site indexeren' : 'Geblokkeerd — noindex, nofollow' }}
          </span>
        </label>
      </div>

      {{-- ── Live SEO status checker ── --}}
      <div class="p-6 bg-white rounded-lg shadow dark:bg-gray-800" id="seo-checker-card">
        <div class="flex items-center justify-between gap-3 mb-4">
          <div class="flex items-center gap-3">
            <div class="p-2 bg-indigo-100 dark:bg-indigo-900 rounded-lg">
              <svg class="w-5 h-5 text-indigo-600 dark:text-indigo-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
              </svg>
            </div>
            <div>
              <h3 class="font-semibold text-gray-900 dark:text-white">Live SEO check</h3>
              <p class="text-xs text-gray-500 dark:text-gray-400">Wat Google nu werkelijk ziet op deze server.</p>
            </div>
          </div>
          <button type="button" id="seo-check-btn"
            class="inline-flex items-center gap-1.5 px-3 py-1.5 text-xs font-medium text-indigo-700 bg-indigo-50 hover:bg-indigo-100 dark:text-indigo-300 dark:bg-indigo-900/40 dark:hover:bg-indigo-900/70 rounded-lg transition-colors">
            <svg id="seo-check-spin" class="w-3.5 h-3.5 hidden animate-spin" fill="none" viewBox="0 0 24 24">
              <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"/>
              <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8v8z"/>
            </svg>
            <svg id="seo-check-icon" class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582M20 20v-5h-.581M4.582 9A8 8 0 0120 15M19.418 15A8 8 0 014 9"/>
            </svg>
            Controleer nu
          </button>
        </div>

        {{-- Results --}}
        <div id="seo-check-results" class="space-y-3">
          <div class="flex items-center gap-2 text-xs text-gray-400 dark:text-gray-500 italic">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
            </svg>
            Klik op "Controleer nu" om de live status te zien.
          </div>
        </div>
      </div>

    </div>

    {{-- Save button --}}
    <div class="mt-6 flex justify-end">
      <button type="submit"
        class="px-6 py-2.5 text-sm font-medium text-white bg-primary-700 hover:bg-primary-800 focus:ring-4 focus:ring-primary-300 rounded-lg dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800 transition-colors">
        Instellingen opslaan
      </button>
    </div>

  </form>

  {{-- Standalone form for test mail (outside the main form to avoid nesting) --}}
  <form id="test-mail-form" method="POST" action="{{ route('admin.settings.test-mail') }}">
    @csrf
  </form>

  <script>
    const BASE_RADIO_LABEL = 'flex items-center gap-2 cursor-pointer px-4 py-2 rounded-lg border-2 transition-all ';

    // ── Maintenance mode toggle ──
    const maintenanceCheckbox = document.querySelector('input[name="maintenance_mode"]');
    const maintenanceLabel    = maintenanceCheckbox.closest('label').querySelector('span');

    function updateMaintenance() {
      const on = maintenanceCheckbox.checked;
      maintenanceLabel.textContent = on ? 'Ingeschakeld' : 'Uitgeschakeld';
      let w = maintenanceCheckbox.closest('.p-6').querySelector('.js-maintenance-warning');
      if (on && !w) {
        w = document.createElement('p');
        w.className = 'js-maintenance-warning mt-3 text-xs text-orange-600 dark:text-orange-400 font-semibold';
        w.textContent = '⚠️ Site is nu offline voor bezoekers';
        maintenanceCheckbox.closest('.p-6').appendChild(w);
      } else if (!on && w) {
        w.remove();
      }
    }
    maintenanceCheckbox.addEventListener('change', updateMaintenance);

    // ── Debug info toggle ──
    const debugCheckbox = document.querySelector('input[name="debug_info"]');
    const debugLabel    = debugCheckbox.closest('label').querySelector('span');
    debugCheckbox.addEventListener('change', () => {
      debugLabel.textContent = debugCheckbox.checked ? 'Ingeschakeld' : 'Uitgeschakeld';
    });

    // ── Allow indexing toggle ──
    const indexingCheckbox = document.querySelector('input[name="allow_indexing"]');
    const indexingLabel    = indexingCheckbox.closest('label').querySelector('span');
    indexingCheckbox.addEventListener('change', () => {
      indexingLabel.textContent = indexingCheckbox.checked
        ? '✓ Toegestaan — Google kan de site indexeren'
        : 'Geblokkeerd — noindex, nofollow';
    });

    // ── Mollie mode radio buttons ──
    const mollieRadios    = document.querySelectorAll('input[name="mollie_mode"]');
    const mollieStatus    = mollieRadios[0].closest('.p-6').querySelector('p.mt-3');
    const mollieContainer = mollieRadios[0].parentElement.parentElement; // input → label → div.flex
    const mollieLabels    = mollieContainer.querySelectorAll('label');

    function updateMollie() {
      const val = [...mollieRadios].find(r => r.checked)?.value;
      mollieStatus.className = 'mt-3 text-xs ' + (val === 'live'
        ? 'text-green-600 dark:text-green-400 font-semibold'
        : 'text-blue-600 dark:text-blue-400');
      mollieStatus.textContent = val === 'live' ? '✓ Echte betalingen actief' : 'ℹ Testmodus — geen echte betalingen';
      mollieLabels.forEach(lbl => {
        const input = lbl.querySelector('input');
        if (input.checked) {
          lbl.className = BASE_RADIO_LABEL + (input.value === 'live'
            ? 'border-green-500 bg-green-50 dark:bg-green-900/30'
            : 'border-blue-500 bg-blue-50 dark:bg-blue-900/30');
        } else {
          lbl.className = BASE_RADIO_LABEL + 'border-gray-200 dark:border-gray-700';
        }
      });
    }
    mollieRadios.forEach(r => r.addEventListener('change', updateMollie));


    // ── Live SEO checker ──
    const seoCheckBtn  = document.getElementById('seo-check-btn');
    const seoResults   = document.getElementById('seo-check-results');
    const seoSpin      = document.getElementById('seo-check-spin');
    const seoIcon      = document.getElementById('seo-check-icon');
    const isProduction = {{ app()->isProduction() ? 'true' : 'false' }};

    function badge(ok, text) {
        const color = ok
            ? 'bg-green-100 text-green-800 dark:bg-green-900/40 dark:text-green-300'
            : 'bg-red-100 text-red-800 dark:bg-red-900/40 dark:text-red-300';
        return `<span class="inline-flex items-center px-2 py-0.5 rounded text-xs font-semibold ${color}">${text}</span>`;
    }
    function badgeWarn(text) {
        return `<span class="inline-flex items-center px-2 py-0.5 rounded text-xs font-semibold bg-yellow-100 text-yellow-800 dark:bg-yellow-900/40 dark:text-yellow-300">${text}</span>`;
    }

    function row(label, valueHtml) {
        return `<div class="flex items-start justify-between gap-2 text-xs">
            <span class="text-gray-500 dark:text-gray-400 shrink-0">${label}</span>
            <span class="text-right font-medium text-gray-800 dark:text-gray-200">${valueHtml}</span>
        </div>`;
    }

    async function runSeoCheck() {
        seoSpin.classList.remove('hidden');
        seoIcon.classList.add('hidden');
        seoCheckBtn.disabled = true;
        seoResults.innerHTML = '<p class="text-xs text-gray-400 italic">Bezig met controleren…</p>';

        try {
            // 1. Fetch robots.txt
            const robotsResp = await fetch('/robots.txt?_=' + Date.now(), { cache: 'no-store' });
            const robotsText = await robotsResp.text();
            const robotsBlocked = robotsText.includes('Disallow: /') && !robotsText.includes('Allow: /');

            // 2. Fetch homepage and read meta robots
            const homeResp = await fetch('/?_=' + Date.now(), { cache: 'no-store' });
            const homeHtml = await homeResp.text();
            const metaMatch = homeHtml.match(/<meta\s+name=["']robots["']\s+content=["']([^"']+)["']/i)
                           || homeHtml.match(/<meta\s+content=["']([^"']+)["']\s+name=["']robots["']/i);
            const metaRobots = metaMatch ? metaMatch[1] : null;
            // On non-production the meta noindex is intentional (dev/staging protection), not a problem
            const metaBlockedReal = isProduction && metaRobots && metaRobots.includes('noindex');

            // On production: both must allow. On dev/staging: only robots.txt matters for the toggle setting.
            const settingEnabled = !robotsBlocked;
            const fullyIndexed   = isProduction ? (settingEnabled && !metaBlockedReal) : settingEnabled;

            let headline, metaRowHtml;

            if (!isProduction) {
                // Dev/staging: meta noindex is always forced — explain this
                headline = settingEnabled
                    ? `<span class="text-lg">✅</span><span class="text-sm font-semibold text-green-700 dark:text-green-400">Instelling staat op: geïndexeerd</span>`
                    : `<span class="text-lg">🚫</span><span class="text-sm font-semibold text-red-700 dark:text-red-400">Instelling staat op: geblokkeerd</span>`;
                metaRowHtml = row(
                    '&lt;meta name="robots"&gt;',
                    (metaRobots ? badgeWarn(metaRobots) : '<span class="text-gray-400 italic">niet gevonden</span>')
                    + `<span class="ms-1 text-gray-400 dark:text-gray-500 text-xs italic">(altijd noindex op dev/staging)</span>`
                );
            } else {
                headline = fullyIndexed
                    ? `<span class="text-lg">✅</span><span class="text-sm font-semibold text-green-700 dark:text-green-400">Site wordt geïndexeerd door Google</span>`
                    : `<span class="text-lg">🚫</span><span class="text-sm font-semibold text-red-700 dark:text-red-400">Site is geblokkeerd voor zoekmachines</span>`;
                metaRowHtml = row(
                    '&lt;meta name="robots"&gt;',
                    metaRobots
                        ? (metaBlockedReal ? badge(false, metaRobots) : badge(true, metaRobots))
                        : '<span class="text-gray-400 italic">niet gevonden (standaard: index)</span>'
                );
            }

            seoResults.innerHTML = `
                <div class="mb-3 flex items-center gap-2">${headline}</div>
                <div class="space-y-2 border-t border-gray-100 dark:border-gray-700 pt-3">
                    ${row('robots.txt', robotsBlocked
                        ? badge(false, 'Disallow: / (geblokkeerd)')
                        : badge(true, 'Allow: / (toegestaan)'))}
                    ${metaRowHtml}
                    ${!isProduction ? `<div class="text-xs text-yellow-600 dark:text-yellow-400 bg-yellow-50 dark:bg-yellow-900/20 rounded px-2 py-1.5">
                        ℹ️ <strong>Dev/staging omgeving</strong> — de meta noindex is hier altijd actief om te voorkomen dat de testsite geïndexeerd wordt. Op productie geldt alleen de toggle hierboven.
                    </div>` : ''}
                    <div class="pt-1 text-xs text-gray-400 dark:text-gray-500">
                        Omgeving: <strong>${isProduction ? 'productie' : '{{ app()->environment() }}'}</strong>
                        &nbsp;·&nbsp; Gecontroleerd op: ${new Date().toLocaleTimeString('nl-NL')}
                        &nbsp;·&nbsp;
                        <a href="/robots.txt" target="_blank" class="underline hover:text-indigo-500">robots.txt bekijken →</a>
                    </div>
                </div>`;
        } catch (err) {
            seoResults.innerHTML = `<p class="text-xs text-red-600 dark:text-red-400">❌ Fout bij controleren: ${err.message}</p>`;
        } finally {
            seoSpin.classList.add('hidden');
            seoIcon.classList.remove('hidden');
            seoCheckBtn.disabled = false;
        }
    }

    seoCheckBtn.addEventListener('click', runSeoCheck);
    // Auto-run on page load
    runSeoCheck();
  </script>

</x-dashboard-layout>

