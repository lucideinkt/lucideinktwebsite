<x-dashboard-layout>

  @if(session('success'))
    <div class="flex items-center p-4 mb-4 text-sm text-green-800 rounded-lg bg-green-50 dark:bg-gray-800 dark:text-green-400" role="alert">
      <svg class="shrink-0 inline w-4 h-4 me-3" fill="currentColor" viewBox="0 0 20 20"><path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z"/></svg>
      {{ session('success') }}
    </div>
  @endif

  <div class="mb-4 flex items-center gap-2 text-sm text-gray-500 dark:text-gray-400">
    <a href="{{ route('admin.page-seo.index') }}" class="hover:underline text-primary-600 dark:text-primary-400">Pagina SEO</a>
    <span>/</span>
    <span class="text-gray-700 dark:text-gray-300">{{ $pageInfo['label'] }}</span>
  </div>

  <form action="{{ route('admin.page-seo.update', $pageKey) }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-4">

      {{-- LEFT: SEO Fields --}}
      <div class="lg:col-span-2 space-y-4">

        <div class="bg-white dark:bg-gray-800 rounded-lg shadow-sm border border-gray-200 dark:border-gray-700">
          <div class="p-4 border-b border-gray-200 dark:border-gray-700 flex items-center gap-2">
            <i class="fa-solid {{ $pageInfo['icon'] }} text-gray-400 text-sm"></i>
            <h2 class="text-base font-semibold text-gray-900 dark:text-white">SEO – {{ $pageInfo['label'] }}</h2>
          </div>
          <div class="p-4 space-y-4">

            {{-- Title --}}
            <div>
              <div class="flex items-center justify-between mb-1">
                <label for="title" class="text-sm font-medium text-gray-700 dark:text-gray-300">
                  SEO Titel
                  <span class="font-normal text-gray-400 ml-1">(aanbevolen: 50–65 tekens)</span>
                </label>
                @if(!empty($defaults['title']))
                  <button type="button"
                    data-fill-target="seo_title_input"
                    data-fill-value="{{ $defaults['title'] }}"
                    class="fill-default-btn text-xs text-primary-600 dark:text-primary-400 hover:underline whitespace-nowrap flex items-center gap-1">
                    <i class="fa-solid fa-arrow-right-to-bracket text-xs"></i> Gebruik standaard
                  </button>
                @endif
              </div>
              <input type="text" name="title" id="seo_title_input" maxlength="70"
                value="{{ old('title', $setting->title ?? '') }}"
                placeholder="{{ $defaults['title'] ?? '' }}"
                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:text-white @error('title') border-red-500 @enderror">
              <div class="flex justify-between mt-1">
                <p class="text-xs text-gray-400 dark:text-gray-500">Laat leeg om standaardtitel te gebruiken.</p>
                <span id="title_counter" class="text-xs text-gray-400">0 / 70</span>
              </div>
              @error('title')<p class="mt-1 text-xs text-red-600 dark:text-red-400">{{ $message }}</p>@enderror
            </div>

            {{-- Description --}}
            <div>
              <div class="flex items-center justify-between mb-1">
                <label for="description" class="text-sm font-medium text-gray-700 dark:text-gray-300">
                  SEO Omschrijving
                  <span class="font-normal text-gray-400 ml-1">(aanbevolen: 120–165 tekens)</span>
                </label>
                @if(!empty($defaults['description']))
                  <button type="button"
                    data-fill-target="seo_desc_input"
                    data-fill-value="{{ $defaults['description'] }}"
                    class="fill-default-btn text-xs text-primary-600 dark:text-primary-400 hover:underline whitespace-nowrap flex items-center gap-1">
                    <i class="fa-solid fa-arrow-right-to-bracket text-xs"></i> Gebruik standaard
                  </button>
                @endif
              </div>
              <textarea name="description" id="seo_desc_input" rows="3" maxlength="320"
                placeholder="{{ $defaults['description'] ?? '' }}"
                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:text-white @error('description') border-red-500 @enderror">{{ old('description', $setting->description ?? '') }}</textarea>
              <div class="flex justify-between mt-1">
                <p class="text-xs text-gray-400 dark:text-gray-500">Laat leeg om standaardomschrijving te gebruiken.</p>
                <span id="desc_counter" class="text-xs text-gray-400">0 / 320</span>
              </div>
              @error('description')<p class="mt-1 text-xs text-red-600 dark:text-red-400">{{ $message }}</p>@enderror
            </div>

            {{-- Author --}}
            <div>
              <div class="flex items-center justify-between mb-1">
                <label for="author" class="text-sm font-medium text-gray-700 dark:text-gray-300">Auteur</label>
                <button type="button"
                  data-fill-target="author"
                  data-fill-value="Lucide Inkt"
                  class="fill-default-btn text-xs text-primary-600 dark:text-primary-400 hover:underline whitespace-nowrap flex items-center gap-1">
                  <i class="fa-solid fa-arrow-right-to-bracket text-xs"></i> Gebruik standaard
                </button>
              </div>
              <input type="text" name="author" id="author" maxlength="100"
                value="{{ old('author', $setting->author ?? '') }}"
                placeholder="Lucide Inkt"
                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:text-white">
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
              {{-- Robots --}}
              <div>
                <label for="robots" class="block mb-1 text-sm font-medium text-gray-700 dark:text-gray-300">Robots</label>
                <select name="robots" id="robots"
                  class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                  <option value="">Standaard (index, follow)</option>
                  <option value="noindex, nofollow" {{ old('robots', $setting->robots ?? '') == 'noindex, nofollow' ? 'selected' : '' }}>noindex, nofollow</option>
                  <option value="noindex, follow"   {{ old('robots', $setting->robots ?? '') == 'noindex, follow'   ? 'selected' : '' }}>noindex, follow</option>
                  <option value="index, nofollow"   {{ old('robots', $setting->robots ?? '') == 'index, nofollow'   ? 'selected' : '' }}>index, nofollow</option>
                </select>
              </div>

              {{-- Type --}}
              <div>
                @php $defaultType = $defaults['type'] ?? 'website'; @endphp
                <label for="type" class="block mb-1 text-sm font-medium text-gray-700 dark:text-gray-300">OG Type</label>
                <select name="type" id="type"
                  class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                  <option value="website" {{ old('type', $setting->type ?? $defaultType) == 'website' ? 'selected' : '' }}>website</option>
                  <option value="article" {{ old('type', $setting->type ?? $defaultType) == 'article' ? 'selected' : '' }}>article</option>
                </select>
                @if(!$setting->type)
                  <p class="mt-1 text-xs text-gray-400">Standaard voor deze pagina: <code>{{ $defaultType }}</code></p>
                @endif
              </div>
            </div>

            {{-- Canonical URL --}}
            <div>
              <div class="flex items-center justify-between mb-1">
                <label for="canonical_url" class="text-sm font-medium text-gray-700 dark:text-gray-300">Canonical URL</label>
                <button type="button"
                  data-fill-target="canonical_url"
                  data-fill-value="{{ url('/' . $pageKey) }}"
                  class="fill-default-btn text-xs text-primary-600 dark:text-primary-400 hover:underline whitespace-nowrap flex items-center gap-1">
                  <i class="fa-solid fa-arrow-right-to-bracket text-xs"></i> Gebruik standaard
                </button>
              </div>
              <input type="url" name="canonical_url" id="canonical_url" maxlength="500"
                value="{{ old('canonical_url', $setting->canonical_url ?? '') }}"
                placeholder="{{ url('/' . $pageKey) }}"
                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:text-white">
              <p class="mt-1 text-xs text-gray-400">Laat leeg om standaard-URL te gebruiken.</p>
            </div>

            {{-- OG Image --}}
            <div>
              <label class="block mb-1 text-sm font-medium text-gray-700 dark:text-gray-300">OG Afbeelding (Social Share)</label>

              @php
                $defaultImgPath = isset($defaults['image']) ? ltrim(parse_url($defaults['image'], PHP_URL_PATH), '/') : null;
                $currentOgImage = old('og_image', $setting->og_image ?? null);
                // Determine preview URL
                if ($currentOgImage) {
                    $previewImgUrl = str_starts_with($currentOgImage, 'seo/og/')
                        ? asset('storage/' . $currentOgImage)
                        : asset($currentOgImage);
                } elseif ($defaultImgPath) {
                    $previewImgUrl = asset($defaultImgPath);
                } else {
                    $previewImgUrl = null;
                }
              @endphp

              {{-- Image preview --}}
              <div id="og_image_preview_wrap" class="mb-3">
                @if($previewImgUrl)
                  <div class="relative inline-block">
                    <img id="og_image_preview" src="{{ $previewImgUrl }}" alt="OG Preview"
                      class="rounded-lg border border-gray-200 dark:border-gray-600 object-cover w-full max-w-sm"
                      style="aspect-ratio:1200/630; max-height:180px;">
                    @if($currentOgImage)
                      <span class="absolute top-1 left-1 bg-primary-600 text-white text-xs px-1.5 py-0.5 rounded font-medium">Aangepast</span>
                    @else
                      <span class="absolute top-1 left-1 bg-gray-500 text-white text-xs px-1.5 py-0.5 rounded font-medium">Standaard</span>
                    @endif
                  </div>
                @else
                  <div id="og_image_preview" class="flex items-center justify-center w-full max-w-sm bg-gray-100 dark:bg-gray-700 rounded-lg border-2 border-dashed border-gray-300 dark:border-gray-600" style="aspect-ratio:1200/630; max-height:180px;">
                    <span class="text-xs text-gray-400 dark:text-gray-500">Geen afbeelding</span>
                  </div>
                @endif
              </div>

              {{-- Upload new image --}}
              <div class="flex flex-col gap-2">
                <label class="text-xs font-medium text-gray-600 dark:text-gray-400">Nieuwe afbeelding uploaden</label>
                <input type="file" name="og_image_upload" id="og_image_upload" accept="image/jpeg,image/png,image/webp"
                  class="block w-full text-sm text-gray-500 file:mr-3 file:py-1.5 file:px-3 file:rounded-lg file:border-0 file:text-sm file:font-medium file:bg-primary-50 file:text-primary-700 hover:file:bg-primary-100 dark:text-gray-400 dark:file:bg-gray-700 dark:file:text-gray-300 cursor-pointer">
                <p class="text-xs text-gray-400">Aanbevolen: 1200×630px JPEG/WebP. Max 5MB. <strong>Ideaal formaat voor Facebook, Twitter/X, WhatsApp.</strong></p>
              </div>

              {{-- Manual path (advanced) --}}
              <details class="mt-2">
                <summary class="text-xs text-gray-400 dark:text-gray-500 cursor-pointer hover:text-gray-600 dark:hover:text-gray-300 select-none">
                  Of geef handmatig een pad op (geavanceerd)
                </summary>
                <div class="mt-2">
                  <input type="text" name="og_image" id="og_image" maxlength="500"
                    value="{{ $currentOgImage ?? '' }}"
                    placeholder="{{ $defaultImgPath ?? 'images/social_share_logo.jpg' }}"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                  <p class="mt-1 text-xs text-gray-400">Relatief pad vanuit <code>public/</code> of <code>storage/</code>-pad.</p>
                </div>
              </details>

              {{-- Remove custom image --}}
              @if($currentOgImage)
                <div class="mt-2 flex items-center gap-2">
                  <input type="checkbox" name="delete_og_image" id="delete_og_image" value="1" class="hidden">
                  <button type="button" id="delete_og_image_btn"
                    class="text-xs text-red-600 hover:underline dark:text-red-400 flex items-center gap-1">
                    <i class="fa-solid fa-trash text-xs"></i> Aangepaste afbeelding verwijderen (gebruik standaard)
                  </button>
                </div>
              @endif

              @if($defaultImgPath && !$currentOgImage)
                <p class="mt-1 text-xs text-green-600 dark:text-green-400">
                  ✓ Huidige standaard: <code>{{ $defaultImgPath }}</code>
                </p>
              @endif
            </div>
          </div>
        </div>

        {{-- Google Search Preview --}}
        <div class="bg-white dark:bg-gray-800 rounded-lg shadow-sm border border-gray-200 dark:border-gray-700">
          <div class="p-4 border-b border-gray-200 dark:border-gray-700">
            <h2 class="text-base font-semibold text-gray-900 dark:text-white">Google zoekresultaat preview</h2>
          </div>
          <div class="p-4">
            <div class="bg-white rounded-lg border border-gray-100 p-4 font-sans">
              <p id="preview_url" class="text-xs text-green-700 mb-1">{{ url('/' . $pageKey) }}</p>
              <p id="preview_title" class="text-lg text-blue-600 font-medium leading-tight hover:underline cursor-pointer">
                {{ $setting->title ?? ($defaults['title'] ?? $pageInfo['label'] . ' | Lucide Inkt') }}
              </p>
              <p id="preview_desc" class="text-sm text-gray-600 mt-1 leading-relaxed">
                {{ $setting->description ?? ($defaults['description'] ?? 'Geen omschrijving ingesteld.') }}
              </p>
            </div>
          </div>
        </div>

      </div>

      {{-- RIGHT: SEO Score + Actions --}}
      <div class="space-y-4">

        {{-- Save --}}
        <div class="bg-white dark:bg-gray-800 rounded-lg shadow-sm border border-gray-200 dark:border-gray-700">
          <div class="p-4 border-b border-gray-200 dark:border-gray-700">
            <h2 class="text-base font-semibold text-gray-900 dark:text-white">Opslaan</h2>
          </div>
          <div class="p-4 flex items-center gap-3">
            <button type="submit"
              class="text-white bg-primary-700 hover:bg-primary-800 focus:ring-4 focus:ring-primary-300 font-medium rounded-lg text-sm px-5 py-2.5 dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800">
              Opslaan
            </button>
            <a href="{{ route('admin.page-seo.index') }}" class="text-sm font-medium text-gray-500 hover:text-gray-700 dark:text-gray-400 dark:hover:text-gray-300">Annuleren</a>
          </div>
          <div class="px-4 pb-4">
            <a href="{{ route($pageInfo['route']) }}" target="_blank"
              class="inline-flex items-center gap-1 text-xs text-primary-600 dark:text-primary-400 hover:underline">
              <i class="fa-solid fa-arrow-up-right-from-square text-xs"></i>
              Pagina bekijken →
            </a>
          </div>
        </div>

        {{-- SEO Score --}}
        <div class="bg-white dark:bg-gray-800 rounded-lg shadow-sm border border-gray-200 dark:border-gray-700">
          <div class="p-4 border-b border-gray-200 dark:border-gray-700">
            <h2 class="text-base font-semibold text-gray-900 dark:text-white">SEO Score</h2>
          </div>
          <div class="p-4">
            {{-- Score ring --}}
            <div class="flex items-center justify-center mb-4">
              <div class="relative w-24 h-24">
                <svg class="w-24 h-24 -rotate-90" viewBox="0 0 36 36">
                  <circle cx="18" cy="18" r="15.9155" fill="none" stroke="#e5e7eb" stroke-width="3"/>
                  <circle id="score_ring" cx="18" cy="18" r="15.9155" fill="none" stroke="#10b981"
                    stroke-width="3" stroke-dasharray="0 100" stroke-linecap="round" class="transition-all duration-700"/>
                </svg>
                <div class="absolute inset-0 flex flex-col items-center justify-center">
                  <span id="score_number" class="text-2xl font-bold text-gray-900 dark:text-white">–</span>
                  <span class="text-xs text-gray-400">/ 100</span>
                </div>
              </div>
            </div>
            <div id="score_label" class="text-center text-sm font-semibold mb-4 text-gray-400">Vul de velden in…</div>

            {{-- Checks --}}
            <div id="seo_checks" class="space-y-2 text-xs">
              <div class="text-gray-400 dark:text-gray-500 italic text-center">Begin met typen om feedback te zien.</div>
            </div>
          </div>
        </div>

        {{-- Keyword Checker --}}
        <div class="bg-white dark:bg-gray-800 rounded-lg shadow-sm border border-gray-200 dark:border-gray-700">
          <div class="p-4 border-b border-gray-200 dark:border-gray-700">
            <h2 class="text-base font-semibold text-gray-900 dark:text-white flex items-center gap-2">
              <i class="fa-solid fa-magnifying-glass text-purple-500 text-sm"></i>
              Zoekwoord Checker
            </h2>
          </div>
          <div class="p-4 space-y-3">

            {{-- Focus keyword input --}}
            <div>
              <label for="focus_keyword" class="block mb-1 text-xs font-medium text-gray-600 dark:text-gray-400 uppercase tracking-wide">Focus zoekwoord</label>
              <input type="text" id="focus_keyword" placeholder="bijv. Risale-i Nur"
                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-purple-500 focus:border-purple-500 block w-full p-2 dark:bg-gray-700 dark:border-gray-600 dark:text-white">
              <p class="mt-1 text-xs text-gray-400">Tikken = live meta-checks. Knop = analyse live pagina.</p>
            </div>

            {{-- Live meta checks --}}
            <div id="kw_meta_checks" class="space-y-1.5 text-xs hidden">
              <p class="text-xs font-semibold text-gray-500 dark:text-gray-400 uppercase tracking-wide">Meta checks</p>
            </div>

            {{-- Analyze button --}}
            <button type="button" id="kw_analyze_btn"
              class="w-full inline-flex items-center justify-center gap-2 px-3 py-2 text-sm font-medium text-white bg-purple-600 hover:bg-purple-700 rounded-lg transition-colors disabled:opacity-50">
              <svg id="kw_spin" class="w-4 h-4 hidden animate-spin" fill="none" viewBox="0 0 24 24">
                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"/>
                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8v8z"/>
              </svg>
              <i id="kw_btn_icon" class="fa-solid fa-search-plus text-sm"></i>
              Analyseer pagina-inhoud
            </button>

            <p class="text-xs text-gray-400 dark:text-gray-500 text-center -mt-1">Haalt live HTML op en controleert koppen, tekst, afbeeldingen…</p>

            {{-- Page content results --}}
            <div id="kw_page_results" class="space-y-2 text-xs hidden">
              <p class="text-xs font-semibold text-gray-500 dark:text-gray-400 uppercase tracking-wide border-t border-gray-100 dark:border-gray-700 pt-2">Pagina-inhoud analyse</p>
            </div>

          </div>
        </div>

      </div>
    </div>
  </form>

  <script>
    // ── Counters ──
    const titleInput = document.getElementById('seo_title_input');
    const descInput  = document.getElementById('seo_desc_input');
    const titleCounter = document.getElementById('title_counter');
    const descCounter  = document.getElementById('desc_counter');

    function updateCounter(input, counter, max) {
      const len = input.value.length;
      counter.textContent = len + ' / ' + max;
    }

    titleInput.addEventListener('input', () => { updateCounter(titleInput, titleCounter, 70); updatePreviewAndScore(); });
    descInput.addEventListener('input',  () => { updateCounter(descInput,  descCounter,  320); updatePreviewAndScore(); });

    // Init counters
    updateCounter(titleInput, titleCounter, 70);
    updateCounter(descInput,  descCounter,  320);

    // ── Preview ──
    const previewTitle = document.getElementById('preview_title');
    const previewDesc  = document.getElementById('preview_desc');
    const defaultTitle = @json($defaults['title'] ?? ($pageInfo['label'] . ' | Lucide Inkt'));
    const defaultDesc  = @json($defaults['description'] ?? '');
    const defaultImage = @json(isset($defaults['image']) ? (str_starts_with($defaults['image'], 'http') ? parse_url($defaults['image'], PHP_URL_PATH) : $defaults['image']) : null);

    function updatePreviewAndScore() {
      const title = titleInput.value.trim() || defaultTitle;
      const desc  = descInput.value.trim()  || defaultDesc;

      previewTitle.textContent = title;
      previewDesc.textContent  = desc || 'Geen omschrijving ingesteld.';

      calcScore(title, desc);
    }

    // ── SEO Score ──
    const scoreRing   = document.getElementById('score_ring');
    const scoreNumber = document.getElementById('score_number');
    const scoreLabel  = document.getElementById('score_label');
    const checksDiv   = document.getElementById('seo_checks');

    const circumference = 2 * Math.PI * 15.9155; // ≈ 100 in SVG units => use stroke-dasharray trick

    function calcScore(title, desc) {
      const checks = [];
      let score = 0;

      // Title checks (0–35 pts)
      if (title && title.length > 0) {
        score += 15;
        checks.push({ ok: true, msg: 'Titel is ingesteld' });
        const tlen = title.length;
        if (tlen >= 50 && tlen <= 65) {
          score += 20; checks.push({ ok: true, msg: 'Titellengte optimaal (' + tlen + ' tekens, doel 50–65)' });
        } else if (tlen >= 35 && tlen < 50) {
          score += 10; checks.push({ warn: true, msg: 'Titel iets te kort (' + tlen + ' tekens, doel 50–65)' });
        } else if (tlen > 65 && tlen <= 75) {
          score += 10; checks.push({ warn: true, msg: 'Titel iets te lang (' + tlen + ' tekens, doel 50–65)' });
        } else {
          score += 3; checks.push({ ok: false, msg: 'Titellengte niet optimaal (' + tlen + ' tekens, doel 50–65)' });
        }
      } else {
        checks.push({ ok: false, msg: 'Geen SEO-titel ingesteld (standaard wordt gebruikt)' });
      }

      // Description checks (0–35 pts)
      if (desc && desc.length > 0) {
        score += 15;
        checks.push({ ok: true, msg: 'Omschrijving is ingesteld' });
        const dlen = desc.length;
        if (dlen >= 120 && dlen <= 165) {
          score += 20; checks.push({ ok: true, msg: 'Omschrijvingslengte optimaal (' + dlen + ' tekens, doel 120–165)' });
        } else if (dlen >= 80 && dlen < 120) {
          score += 10; checks.push({ warn: true, msg: 'Omschrijving iets te kort (' + dlen + ' tekens, doel 120–165)' });
        } else if (dlen > 165 && dlen <= 200) {
          score += 10; checks.push({ warn: true, msg: 'Omschrijving iets te lang (' + dlen + ' tekens, doel 120–165)' });
        } else {
          score += 3; checks.push({ ok: false, msg: 'Omschrijvingslengte niet optimaal (' + dlen + ' tekens, doel 120–165)' });
        }
      } else {
        checks.push({ ok: false, msg: 'Geen SEO-omschrijving ingesteld (standaard wordt gebruikt)' });
      }

      // Individu
      const robotsSel = document.getElementById('robots');
      const robotsVal = robotsSel ? robotsSel.value : '';
      if (!robotsVal || robotsVal === '' || robotsVal.startsWith('index')) {
        score += 15; checks.push({ ok: true, msg: 'Robots: pagina wordt geïndexeerd' });
      } else {
        checks.push({ ok: false, msg: 'Robots: pagina wordt NIET geïndexeerd (' + robotsVal + ')' });
      }

      // OG Image
      const ogImg = document.getElementById('og_image');
      const ogImgValue = ogImg ? ogImg.value.trim() : '';
      if (ogImgValue) {
        score += 15; checks.push({ ok: true, msg: 'Aangepaste OG afbeelding ingesteld: ' + ogImgValue });
      } else if (defaultImage) {
        score += 15; checks.push({ ok: true, msg: 'Standaard OG afbeelding aanwezig: ' + defaultImage });
      } else {
        score += 5; checks.push({ warn: true, msg: 'Geen OG afbeelding geconfigureerd' });
      }

      score = Math.min(100, Math.max(0, score));

      // Update ring
      scoreNumber.textContent = score;
      const dash = (score / 100) * 100;
      scoreRing.setAttribute('stroke-dasharray', dash + ' 100');

      // Color
      if (score >= 75) {
        scoreRing.setAttribute('stroke', '#10b981');
        scoreLabel.textContent = '🟢 Uitstekend';
        scoreLabel.className   = 'text-center text-sm font-semibold mb-4 text-green-600 dark:text-green-400';
      } else if (score >= 50) {
        scoreRing.setAttribute('stroke', '#f59e0b');
        scoreLabel.textContent = '🟡 Kan beter';
        scoreLabel.className   = 'text-center text-sm font-semibold mb-4 text-yellow-600 dark:text-yellow-400';
      } else {
        scoreRing.setAttribute('stroke', '#ef4444');
        scoreLabel.textContent = '🔴 Verbetering nodig';
        scoreLabel.className   = 'text-center text-sm font-semibold mb-4 text-red-600 dark:text-red-400';
      }

      // Render checks
      checksDiv.innerHTML = checks.map(c => {
        const icon  = c.ok    ? '✅' : (c.warn ? '⚠️' : '❌');
        const color = c.ok    ? 'text-green-700 dark:text-green-400'
                    : c.warn  ? 'text-yellow-700 dark:text-yellow-400'
                    : 'text-red-700 dark:text-red-400';
        return `<div class="flex items-start gap-1.5 ${color}">
          <span class="shrink-0">${icon}</span>
          <span>${c.msg}</span>
        </div>`;
      }).join('');
    }

    // Live robots update
    const robotsSel = document.getElementById('robots');
    if (robotsSel) robotsSel.addEventListener('change', updatePreviewAndScore);
    const ogImgInput = document.getElementById('og_image');
    if (ogImgInput) ogImgInput.addEventListener('input', updatePreviewAndScore);

    // ── OG Image upload preview ──
    const ogUpload      = document.getElementById('og_image_upload');
    const ogPreviewWrap = document.getElementById('og_image_preview_wrap');

    if (ogUpload) {
      ogUpload.addEventListener('change', function () {
        const file = ogUpload.files[0];
        if (!file) return;
        const reader = new FileReader();
        reader.onload = function (e) {
          ogPreviewWrap.innerHTML = `
            <div class="relative inline-block">
              <img src="${e.target.result}" alt="OG Preview"
                class="rounded-lg border border-gray-200 dark:border-gray-600 object-cover w-full max-w-sm"
                style="aspect-ratio:1200/630; max-height:180px;">
              <span class="absolute top-1 left-1 bg-green-600 text-white text-xs px-1.5 py-0.5 rounded font-medium">Nieuwe upload</span>
            </div>`;
          updatePreviewAndScore();
        };
        reader.readAsDataURL(file);
      });
    }

    // ── Delete custom OG image ──
    const deleteOgBtn      = document.getElementById('delete_og_image_btn');
    const deleteOgCheckbox = document.getElementById('delete_og_image');
    if (deleteOgBtn && deleteOgCheckbox) {
      deleteOgBtn.addEventListener('click', function () {
        if (confirm('Weet je zeker dat je de aangepaste OG afbeelding wilt verwijderen? De standaardafbeelding wordt dan gebruikt.')) {
          deleteOgCheckbox.checked = true;
          deleteOgBtn.textContent = '⚠️ Wordt verwijderd bij opslaan';
          deleteOgBtn.disabled = true;
          // Show default image preview if available
          @if($defaultImgPath)
            ogPreviewWrap.innerHTML = `
              <div class="relative inline-block">
                <img src="{{ asset($defaultImgPath) }}" alt="OG Preview"
                  class="rounded-lg border border-gray-200 dark:border-gray-600 object-cover w-full max-w-sm"
                  style="aspect-ratio:1200/630; max-height:180px;">
                <span class="absolute top-1 left-1 bg-gray-500 text-white text-xs px-1.5 py-0.5 rounded font-medium">Standaard (na opslaan)</span>
              </div>`;
          @endif
        }
      });
    }

    // Initial calc
    updatePreviewAndScore();

    // ════════════════════════════════════════════════════
    // ZOEKWOORD CHECKER
    // ════════════════════════════════════════════════════
    const focusKwInput   = document.getElementById('focus_keyword');
    const kwMetaChecks   = document.getElementById('kw_meta_checks');
    const kwPageResults  = document.getElementById('kw_page_results');
    const kwAnalyzeBtn   = document.getElementById('kw_analyze_btn');
    const kwSpin         = document.getElementById('kw_spin');
    const kwBtnIcon      = document.getElementById('kw_btn_icon');
    const pageUrl        = @json(route($pageInfo['route']));

    // Helper: check if a string contains the keyword (case-insensitive)
    function kwIn(text, kw) {
      if (!text || !kw) return false;
      return text.toLowerCase().includes(kw.toLowerCase());
    }

    // Helper: count occurrences
    function kwCount(text, kw) {
      if (!text || !kw) return 0;
      const regex = new RegExp(kw.replace(/[.*+?^${}()|[\]\\]/g, '\\$&'), 'gi');
      return (text.match(regex) || []).length;
    }

    // Helper: render a check row
    function kwRow(ok, warn, msg, detail = '') {
      const icon  = ok ? '✅' : (warn ? '⚠️' : '❌');
      const color = ok ? 'text-green-700 dark:text-green-400'
                  : warn ? 'text-yellow-700 dark:text-yellow-400'
                  : 'text-red-700 dark:text-red-400';
      return `<div class="flex items-start gap-1.5 ${color}">
        <span class="shrink-0">${icon}</span>
        <span>${msg}${detail ? `<span class="text-gray-400 dark:text-gray-500 ml-1">${detail}</span>` : ''}</span>
      </div>`;
    }

    // ── Live meta checks ──
    function runMetaChecks() {
      const kw = focusKwInput.value.trim();
      if (!kw) {
        kwMetaChecks.classList.add('hidden');
        kwMetaChecks.innerHTML = '<p class="text-xs font-semibold text-gray-500 dark:text-gray-400 uppercase tracking-wide">Meta checks</p>';
        return;
      }

      const title = titleInput.value.trim() || defaultTitle;
      const desc  = descInput.value.trim()  || defaultDesc;
      const url   = '/' + @json($pageKey);

      const rows = [];
      rows.push(kwRow(kwIn(title, kw), false, !kwIn(title, kw) ? 'Zoekwoord <strong>ontbreekt</strong> in SEO-titel' : 'Zoekwoord gevonden in SEO-titel',
        kwIn(title, kw) ? `(${kwCount(title, kw)}×)` : ''));
      rows.push(kwRow(kwIn(desc, kw), false, !kwIn(desc, kw) ? 'Zoekwoord <strong>ontbreekt</strong> in SEO-omschrijving' : 'Zoekwoord gevonden in SEO-omschrijving',
        kwIn(desc, kw) ? `(${kwCount(desc, kw)}×)` : ''));
      rows.push(kwRow(kwIn(url, kw.replace(/\s+/g, '-')), true,
        kwIn(url, kw.replace(/\s+/g, '-')) ? 'Zoekwoord gevonden in URL' : 'Zoekwoord niet in URL-slug (optioneel)'));

      kwMetaChecks.classList.remove('hidden');
      kwMetaChecks.innerHTML = '<p class="text-xs font-semibold text-gray-500 dark:text-gray-400 uppercase tracking-wide mb-1">Meta checks</p>' + rows.join('');
    }

    focusKwInput.addEventListener('input', runMetaChecks);

    // ── Page content analysis ──
    kwAnalyzeBtn.addEventListener('click', async function () {
      const kw = focusKwInput.value.trim();
      if (!kw) {
        alert('Voer eerst een focus zoekwoord in.');
        focusKwInput.focus();
        return;
      }

      kwAnalyzeBtn.disabled = true;
      kwSpin.classList.remove('hidden');
      kwBtnIcon.classList.add('hidden');
      kwPageResults.classList.remove('hidden');
      kwPageResults.innerHTML = '<p class="text-xs font-semibold text-gray-500 dark:text-gray-400 uppercase tracking-wide border-t border-gray-100 dark:border-gray-700 pt-2">Pagina-inhoud analyse</p>' +
        '<p class="text-gray-400 italic">Pagina ophalen…</p>';

      try {
        const resp = await fetch(pageUrl, {
          cache: 'no-store',
          headers: { 'X-SEO-Checker': '1' }
        });
        if (!resp.ok) throw new Error('HTTP ' + resp.status);
        const html = await resp.text();

        const parser = new DOMParser();
        const doc    = parser.parseFromString(html, 'text/html');

        // Remove script/style/nav/footer/header/aside from body text
        ['script','style','nav','footer','header','aside'].forEach(tag => {
          doc.querySelectorAll(tag).forEach(el => el.remove());
        });

        const pageTitle    = doc.title || '';
        const metaDesc     = doc.querySelector('meta[name="description"]')?.getAttribute('content') || '';
        const h1s          = [...doc.querySelectorAll('h1')].map(el => el.textContent.trim());
        const h2s          = [...doc.querySelectorAll('h2')].map(el => el.textContent.trim());
        const h3s          = [...doc.querySelectorAll('h3')].map(el => el.textContent.trim());
        const paragraphs   = [...doc.querySelectorAll('p')].map(el => el.textContent.trim()).filter(t => t.length > 20);
        const firstPara    = paragraphs[0] || '';
        const bodyText     = doc.body?.textContent || '';
        const imgAlts      = [...doc.querySelectorAll('img[alt]')].map(img => img.getAttribute('alt')).filter(Boolean);
        const allText      = doc.body?.innerText || bodyText;

        // Word count & density
        const words        = allText.trim().split(/\s+/).filter(w => w.length > 1);
        const totalWords   = words.length;
        const kwOccAll     = kwCount(allText, kw);
        const density      = totalWords > 0 ? ((kwOccAll / totalWords) * 100).toFixed(2) : 0;
        const densityNum   = parseFloat(density);

        // H1 check
        const h1Match  = h1s.some(h => kwIn(h, kw));
        const h2Match  = h2s.some(h => kwIn(h, kw));
        const h3Match  = h3s.some(h => kwIn(h, kw));
        const firstParaMatch = kwIn(firstPara, kw);
        const altMatch = imgAlts.some(a => kwIn(a, kw));
        const pageTitleMatch = kwIn(pageTitle, kw);
        const metaDescMatch  = kwIn(metaDesc, kw);

        // Density rating
        let densityOk = false, densityWarn = false;
        let densityMsg = '';
        if (densityNum === 0) {
          densityMsg = `Zoekwoord <strong>niet gevonden</strong> in paginatekst (0%)`;
        } else if (densityNum < 0.3) {
          densityWarn = true;
          densityMsg = `Zoekwoorddichtheid laag: <strong>${density}%</strong> — verhoog aanwezigheid`;
        } else if (densityNum <= 2.5) {
          densityOk = true;
          densityMsg = `Zoekwoorddichtheid optimaal: <strong>${density}%</strong>`;
        } else {
          densityWarn = true;
          densityMsg = `Zoekwoorddichtheid hoog: <strong>${density}%</strong> — risico op over-optimalisatie`;
        }

        const rows = [
          kwRow(pageTitleMatch,  false, pageTitleMatch  ? `Zoekwoord in live &lt;title&gt;` : `Zoekwoord <strong>ontbreekt</strong> in live &lt;title&gt;`),
          kwRow(metaDescMatch,   false, metaDescMatch   ? `Zoekwoord in live meta description` : `Zoekwoord <strong>ontbreekt</strong> in live meta description`),
          kwRow(h1Match,         false, h1Match ? `Zoekwoord gevonden in H1` + (h1s.length > 1 ? ` (${h1s.length} H1s)` : '') : (h1s.length ? `Zoekwoord <strong>ontbreekt</strong> in H1: "${h1s[0]?.substring(0,50)}"` : 'Geen H1 gevonden op de pagina')),
          kwRow(h2Match,         !h2Match && h2s.length > 0, h2Match ? `Zoekwoord gevonden in een H2` : (h2s.length ? `Zoekwoord ontbreekt in alle H2's (${h2s.length} gevonden)` : 'Geen H2-koppen gevonden')),
          kwRow(firstParaMatch,  !firstParaMatch, firstParaMatch ? `Zoekwoord in eerste alinea` : `Zoekwoord <strong>ontbreekt</strong> in eerste alinea`),
          kwRow(densityOk,       densityWarn,     densityMsg, `(${kwOccAll}× in ~${totalWords} woorden)`),
          kwRow(altMatch,        !altMatch,        altMatch ? `Zoekwoord gevonden in alt-tekst afbeelding` : `Zoekwoord ontbreekt in alt-teksten van afbeeldingen`),
        ];

        // Overall keyword score
        const kwScore = [pageTitleMatch, metaDescMatch, h1Match, h2Match || h3Match, firstParaMatch, densityOk, altMatch]
          .filter(Boolean).length;
        const kwScorePct = Math.round((kwScore / 7) * 100);
        const kwScoreColor = kwScorePct >= 70 ? 'text-green-600' : kwScorePct >= 45 ? 'text-yellow-600' : 'text-red-600';

        kwPageResults.innerHTML =
          `<p class="text-xs font-semibold text-gray-500 dark:text-gray-400 uppercase tracking-wide border-t border-gray-100 dark:border-gray-700 pt-2">Pagina-inhoud analyse</p>` +
          `<div class="flex items-center justify-between bg-gray-50 dark:bg-gray-700/50 rounded-lg px-3 py-2 mb-1">
            <span class="text-xs text-gray-600 dark:text-gray-300 font-medium">Zoekwoord score</span>
            <span class="text-sm font-bold ${kwScoreColor}">${kwScore}/7 — ${kwScorePct}%</span>
          </div>` +
          rows.join('') +
          `<p class="text-xs text-gray-400 dark:text-gray-500 pt-1 border-t border-gray-100 dark:border-gray-700 mt-1">
            Geanalyseerd: <a href="${pageUrl}" target="_blank" class="underline hover:text-purple-500">${pageUrl}</a>
            · ${new Date().toLocaleTimeString('nl-NL')}
          </p>`;

      } catch (err) {
        kwPageResults.innerHTML =
          `<p class="text-xs font-semibold text-gray-500 dark:text-gray-400 uppercase tracking-wide border-t border-gray-100 dark:border-gray-700 pt-2">Pagina-inhoud analyse</p>` +
          `<p class="text-xs text-red-600 dark:text-red-400">❌ Kon pagina niet ophalen: ${err.message}</p>`;
      } finally {
        kwAnalyzeBtn.disabled = false;
        kwSpin.classList.add('hidden');
        kwBtnIcon.classList.remove('hidden');
      }
    });
    // ── "Gebruik standaard" fill buttons ──
    document.querySelectorAll('.fill-default-btn').forEach(btn => {
      btn.addEventListener('click', function () {
        const targetId = btn.getAttribute('data-fill-target');
        const value    = btn.getAttribute('data-fill-value');
        const el       = document.getElementById(targetId);
        if (!el || !value) return;
        el.value = value;
        el.focus();
        // Flash highlight
        el.classList.add('ring-2', 'ring-primary-400');
        setTimeout(() => el.classList.remove('ring-2', 'ring-primary-400'), 1200);
        updatePreviewAndScore();
        runMetaChecks();
      });
    });
  </script>

</x-dashboard-layout>

