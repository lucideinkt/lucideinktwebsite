<x-dashboard-layout>

  <div class="max-w-3xl mx-auto space-y-6">

    {{-- Breadcrumb --}}
    <nav class="flex text-sm text-gray-500 dark:text-gray-400" aria-label="Breadcrumb">
      <ol class="inline-flex items-center space-x-1 md:space-x-2">
        <li><a href="{{ route('admin.online-lezen-seo.index') }}" class="hover:text-primary-600 dark:hover:text-primary-400">Online Lezen SEO</a></li>
        <li><span class="mx-1">/</span></li>
        <li class="text-gray-700 dark:text-gray-300 font-medium truncate max-w-xs">{{ $product->title }}</li>
      </ol>
    </nav>

    {{-- Google Preview --}}
    <div class="bg-white dark:bg-gray-800 shadow-md rounded-lg p-5">
      <h2 class="text-xs font-semibold uppercase text-gray-400 dark:text-gray-500 mb-3 tracking-wider">
        <i class="fa-brands fa-google mr-1"></i> Zoekresultaat preview
      </h2>
      <div class="border border-gray-200 dark:border-gray-700 rounded-lg p-4 bg-gray-50 dark:bg-gray-900">
        <p class="text-xs text-green-700 dark:text-green-400 mb-0.5 truncate" id="preview-url">
          {{ $previewUrl }}
        </p>
        <p class="text-base font-medium text-blue-700 dark:text-blue-400 leading-snug">
          <span id="preview-title-base">{{ $effectiveTitle }}</span>
        </p>
        <p class="text-sm text-gray-600 dark:text-gray-400 mt-1 line-clamp-2" id="preview-desc">
          {{ $effectiveDescription ?? 'Geen beschrijving ingesteld.' }}
        </p>
      </div>
      <p class="text-xs text-gray-400 dark:text-gray-500 mt-2">
        De preview toont de titel precies zoals die in zoekmachines verschijnt.
      </p>
    </div>

    {{-- Edit Form --}}
    <form action="{{ route('admin.online-lezen-seo.update', $product->id) }}" method="POST" enctype="multipart/form-data">
      @csrf
      @method('PUT')

      <div class="bg-white dark:bg-gray-800 shadow-md rounded-lg divide-y divide-gray-200 dark:divide-gray-700">

        {{-- Header --}}
        <div class="p-5 flex items-center gap-3">
          @php
            $imgSrc = $product->image_1
              ? (Str::startsWith($product->image_1, 'https://')
                  ? $product->image_1
                  : (Str::startsWith($product->image_1, 'image/books/') || Str::startsWith($product->image_1, 'images/books/')
                      ? asset($product->image_1)
                      : asset('storage/' . $product->image_1)))
              : null;
          @endphp
          @if($imgSrc)
            <img src="{{ e($imgSrc) }}" alt="{{ $product->title }}" class="w-10 h-10 object-contain rounded shrink-0">
          @endif
          <div>
            <h3 class="text-sm font-semibold text-gray-900 dark:text-white">{{ $product->title }}</h3>
            <a href="{{ $previewUrl }}" target="_blank" class="text-xs text-primary-600 hover:underline dark:text-primary-400">
              Bekijk online <i class="fa-solid fa-arrow-up-right-from-square text-[10px]"></i>
            </a>
          </div>
        </div>

        {{-- SEO Title --}}
        <div class="p-5">
          <div class="flex items-center justify-between mb-1">
            <label for="seo_title_online" class="text-sm font-medium text-gray-700 dark:text-gray-300">
              SEO Titel <span class="font-normal text-gray-400 ml-1">(aanbevolen: 50–65 tekens)</span>
            </label>
            <button type="button"
              data-fill-target="seo_title_online"
              data-fill-value="{{ $product->seo_title ?: $product->title }}"
              class="fill-default-btn text-xs text-primary-600 dark:text-primary-400 hover:underline whitespace-nowrap flex items-center gap-1">
              <i class="fa-solid fa-arrow-right-to-bracket text-xs"></i> Gebruik standaard
            </button>
          </div>
          <input
            type="text"
            id="seo_title_online"
            name="seo_title_online"
            value="{{ old('seo_title_online', $product->seo_title_online) }}"
            maxlength="70"
            placeholder="{{ $product->seo_title ?: $product->title }}"
            class="w-full px-3 py-2 text-sm border border-gray-300 rounded-lg focus:ring-primary-500 focus:border-primary-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white dark:placeholder-gray-400"
          >
          <div class="flex justify-between items-center mt-1">
            <p class="text-xs text-gray-400 dark:text-gray-500">
              Leeg laten = producttitel als standaard.
            </p>
            <span class="text-xs font-medium ml-2 whitespace-nowrap" id="title-count">
              <span id="title-len">{{ mb_strlen($product->seo_title_online ?? '') }}</span>/70
            </span>
          </div>
          {{-- Character range indicator --}}
          <div class="mt-1.5 flex items-center gap-2">
            <div class="flex-1 h-1.5 bg-gray-200 dark:bg-gray-600 rounded-full overflow-hidden">
              <div id="title-bar" class="h-full rounded-full transition-all duration-200"></div>
            </div>
            <span class="text-xs text-gray-400 dark:text-gray-500" id="title-range-label">Ideaal: 50–65 tekens</span>
          </div>
          @error('seo_title')
            <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
          @enderror
        </div>

        {{-- SEO Description --}}
        <div class="p-5">
          <div class="flex items-center justify-between mb-1">
            <label for="seo_description_online" class="text-sm font-medium text-gray-700 dark:text-gray-300">
              SEO Beschrijving
              <span class="font-normal text-gray-400 ml-1">(aanbevolen: 120–165 tekens)</span>
            </label>
            @php $defaultDesc = $product->seo_description ?: $product->short_description; @endphp
            @if($defaultDesc)
              <button type="button"
                data-fill-target="seo_description_online"
                data-fill-value="{{ $defaultDesc }}"
                class="fill-default-btn text-xs text-primary-600 dark:text-primary-400 hover:underline whitespace-nowrap flex items-center gap-1">
                <i class="fa-solid fa-arrow-right-to-bracket text-xs"></i> Gebruik standaard
              </button>
            @endif
          </div>
          <textarea
            id="seo_description_online"
            name="seo_description_online"
            rows="3"
            maxlength="320"
            placeholder="{{ $defaultDesc ?? 'Voeg een beschrijving toe…' }}"
            class="w-full px-3 py-2 text-sm border border-gray-300 rounded-lg focus:ring-primary-500 focus:border-primary-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white dark:placeholder-gray-400"
          >{{ old('seo_description_online', $product->seo_description_online) }}</textarea>
          <div class="flex justify-between items-center mt-1">
            <p class="text-xs text-gray-400 dark:text-gray-500">
              Leeg laten = product SEO-beschrijving of korte beschrijving als standaard.
            </p>
            <span class="text-xs font-medium ml-2 whitespace-nowrap" id="desc-count">
              <span id="desc-len">{{ mb_strlen($product->seo_description_online ?? '') }}</span>/320
            </span>
          </div>
          <div class="mt-1.5 flex items-center gap-2">
            <div class="flex-1 h-1.5 bg-gray-200 dark:bg-gray-600 rounded-full overflow-hidden">
              <div id="desc-bar" class="h-full rounded-full transition-all duration-200"></div>
            </div>
            <span class="text-xs text-gray-400 dark:text-gray-500" id="desc-range-label">Ideaal: 120–165 tekens</span>
          </div>
          @error('seo_description_online')
            <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
          @enderror
        </div>

        {{-- Author + Robots + Canonical --}}
        <div class="p-5 grid grid-cols-1 sm:grid-cols-2 gap-5">

          {{-- Author --}}
          <div>
            <div class="flex items-center justify-between mb-1">
              <label for="seo_author" class="text-sm font-medium text-gray-700 dark:text-gray-300">Auteur</label>
              <button type="button"
                data-fill-target="seo_author"
                data-fill-value="Lucide Inkt"
                class="fill-default-btn text-xs text-primary-600 dark:text-primary-400 hover:underline flex items-center gap-1">
                <i class="fa-solid fa-arrow-right-to-bracket text-xs"></i> Gebruik standaard
              </button>
            </div>
            <input type="text" id="seo_author" name="seo_author"
              value="{{ old('seo_author', $product->seo_author) }}"
              placeholder="Lucide Inkt"
              maxlength="100"
              class="w-full px-3 py-2 text-sm border border-gray-300 rounded-lg focus:ring-primary-500 focus:border-primary-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white dark:placeholder-gray-400">
          </div>

          {{-- Robots --}}
          <div>
            <label for="seo_robots_online" class="block mb-1 text-sm font-medium text-gray-700 dark:text-gray-300">Robots</label>
            <select id="seo_robots_online" name="seo_robots_online"
              class="w-full px-3 py-2 text-sm border border-gray-300 rounded-lg focus:ring-primary-500 focus:border-primary-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white">
              <option value=""   {{ old('seo_robots_online', $product->seo_robots_online) == ''                   ? 'selected' : '' }}>Standaard (index, follow)</option>
              <option value="noindex, nofollow" {{ old('seo_robots_online', $product->seo_robots_online) == 'noindex, nofollow' ? 'selected' : '' }}>noindex, nofollow</option>
              <option value="noindex, follow"   {{ old('seo_robots_online', $product->seo_robots_online) == 'noindex, follow'   ? 'selected' : '' }}>noindex, follow</option>
              <option value="index, nofollow"   {{ old('seo_robots_online', $product->seo_robots_online) == 'index, nofollow'   ? 'selected' : '' }}>index, nofollow</option>
            </select>
            <p class="mt-1 text-xs text-gray-400 dark:text-gray-500">Standaard = zoekmachines mogen indexeren.</p>
          </div>

          {{-- Canonical URL --}}
          <div class="sm:col-span-2">
            <label for="seo_canonical_url_online" class="block mb-1 text-sm font-medium text-gray-700 dark:text-gray-300">
              Canonical URL
              <span class="font-normal text-gray-400 ml-1">(optioneel)</span>
            </label>
            <input type="url" id="seo_canonical_url_online" name="seo_canonical_url_online"
              value="{{ old('seo_canonical_url_online', $product->seo_canonical_url_online) }}"
              placeholder="{{ route('onlineLezenRead', $product->slug) }}"
              class="w-full px-3 py-2 text-sm border border-gray-300 rounded-lg focus:ring-primary-500 focus:border-primary-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white dark:placeholder-gray-400">
            <p class="mt-1 text-xs text-gray-400 dark:text-gray-500">Leeg laten = automatisch de URL van deze pagina.</p>
            @error('seo_canonical_url_online')
              <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
            @enderror
          </div>

        </div>

        {{-- Online Lezen Afbeelding --}}
        <div class="p-5">
          <div class="flex items-center justify-between mb-2">
            <label class="text-sm font-medium text-gray-700 dark:text-gray-300">
              Online Lezen Afbeelding
              <span class="font-normal text-gray-400 ml-1">Aanbevolen: 800×1200px</span>
            </label>
          </div>

          {{-- Current / default image preview --}}
          <div class="flex items-start gap-4 mb-3">
            <div>
              <p class="text-xs text-gray-400 dark:text-gray-500 mb-1">Huidige afbeelding</p>
              @php
                $currentImg = $product->online_lezen_image
                  ? asset($product->online_lezen_image)
                  : null;
                $defaultImg = $product->image_1
                  ? (Str::startsWith($product->image_1, 'https://')
                      ? $product->image_1
                      : (Str::startsWith($product->image_1, 'image/') || Str::startsWith($product->image_1, 'images/')
                          ? asset($product->image_1)
                          : asset('storage/' . $product->image_1)))
                  : null;
              @endphp
              <div id="ol-image-preview">
                @if($currentImg)
                  <img src="{{ $currentImg }}" alt="Online lezen afbeelding" class="w-24 h-32 object-contain rounded border border-gray-200 dark:border-gray-600">
                @elseif($defaultImg)
                  <img src="{{ $defaultImg }}" alt="Product afbeelding (standaard)" class="w-24 h-32 object-contain rounded border border-dashed border-gray-300 dark:border-gray-600 opacity-60">
                  <p class="text-[10px] text-gray-400 dark:text-gray-500 mt-1 text-center">product (standaard)</p>
                @else
                  <div class="w-24 h-32 flex items-center justify-center rounded border border-dashed border-gray-300 dark:border-gray-600 text-gray-400">
                    <i class="fa-solid fa-image text-2xl"></i>
                  </div>
                @endif
              </div>
            </div>
          </div>

          <input type="file" name="online_lezen_image" id="online_lezen_image_input" accept="image/*"
            class="block w-full text-sm text-gray-500 file:mr-3 file:py-1.5 file:px-3 file:rounded-lg file:border-0 file:text-sm file:font-medium file:bg-primary-50 file:text-primary-700 hover:file:bg-primary-100 dark:text-gray-400 dark:file:bg-gray-700 dark:file:text-gray-300 cursor-pointer">

          @if($product->online_lezen_image)
            <div class="flex items-center gap-2 mt-2" id="ol-delete-wrapper">
              <input type="checkbox" name="delete_online_lezen_image" id="delete_online_lezen_image" value="1" class="hidden">
              <button type="button" id="ol-remove-btn"
                class="text-xs text-red-600 hover:underline dark:text-red-400">
                <i class="fa-solid fa-trash-can mr-1"></i> Huidige afbeelding verwijderen
              </button>
            </div>
          @endif
          <p class="mt-1 text-xs text-gray-400 dark:text-gray-500">
            Leeg laten = productafbeelding wordt als standaard gebruikt.
          </p>
          @error('online_lezen_image')
            <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
          @enderror
        </div>

        {{-- Actions --}}
        <div class="p-5 flex items-center justify-between gap-3">
          <a href="{{ route('admin.online-lezen-seo.index') }}"
            class="text-sm text-gray-500 hover:text-gray-700 dark:text-gray-400 dark:hover:text-gray-200">
            ← Terug
          </a>
          <div class="flex gap-2">
            <a href="{{ route('productEditPage', $product->id) }}"
              class="text-xs px-3 py-2 border border-gray-300 rounded-lg text-gray-600 hover:bg-gray-50 dark:border-gray-600 dark:text-gray-400 dark:hover:bg-gray-700">
              <i class="fa-solid fa-box-open mr-1"></i> Product bewerken
            </a>
            <button type="submit"
              class="px-4 py-2 text-sm font-medium text-white bg-primary-600 rounded-lg hover:bg-primary-700 focus:ring-4 focus:ring-primary-300 dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800">
              <i class="fa-solid fa-floppy-disk mr-1"></i> Opslaan
            </button>
          </div>
        </div>

      </div>
    </form>

  </div>

@push('scripts')
<script>
(function () {
  const titleInput    = document.getElementById('seo_title_online');
  const descInput     = document.getElementById('seo_description_online');
  const previewBase   = document.getElementById('preview-title-base');
  const previewDesc   = document.getElementById('preview-desc');
  const DEFAULT_TITLE = @json($product->title);
  const DEFAULT_DESC  = @json($product->short_description ?? '');

  function updateBar(barId, labelId, len, min, max, total) {
    const bar   = document.getElementById(barId);
    const label = document.getElementById(labelId);
    const pct   = Math.min((len / total) * 100, 100);
    bar.style.width = pct + '%';
    if (len === 0) {
      bar.className = 'h-full rounded-full transition-all duration-200 bg-gray-300 dark:bg-gray-500';
      label.textContent = 'Ideaal: ' + min + '–' + max + ' tekens';
    } else if (len >= min && len <= max) {
      bar.className = 'h-full rounded-full transition-all duration-200 bg-green-500';
      label.textContent = '✓ Ideale lengte';
    } else if (len > max) {
      bar.className = 'h-full rounded-full transition-all duration-200 bg-amber-500';
      label.textContent = 'Te lang (' + len + ' tekens)';
    } else {
      bar.className = 'h-full rounded-full transition-all duration-200 bg-red-400';
      label.textContent = 'Te kort (' + len + ' tekens)';
    }
  }

  function updateTitle() {
    const val = titleInput.value.trim();
    const len = val.length;
    document.getElementById('title-len').textContent = len;
    updateBar('title-bar', 'title-range-label', len, 50, 65, 70);
    if (previewBase) previewBase.textContent = val || DEFAULT_TITLE;
  }

  function updateDesc() {
    const val = descInput.value.trim();
    const len = val.length;
    document.getElementById('desc-len').textContent = len;
    updateBar('desc-bar', 'desc-range-label', len, 120, 165, 320);
    if (previewDesc) previewDesc.textContent = val || DEFAULT_DESC || 'Geen beschrijving ingesteld.';
  }

  titleInput.addEventListener('input', updateTitle);
  descInput.addEventListener('input', updateDesc);

  // Image upload preview
  const olImageInput   = document.getElementById('online_lezen_image_input');
  const olImagePreview = document.getElementById('ol-image-preview');
  if (olImageInput && olImagePreview) {
    olImageInput.addEventListener('change', function (e) {
      if (e.target.files.length > 0) {
        const reader = new FileReader();
        reader.onload = function (ev) {
          olImagePreview.innerHTML = '<img src="' + ev.target.result + '" alt="Preview" class="w-24 h-32 object-contain rounded border border-gray-200 dark:border-gray-600">';
        };
        reader.readAsDataURL(e.target.files[0]);
      }
    });
  }

  // Delete existing image
  const olRemoveBtn  = document.getElementById('ol-remove-btn');
  const olDeleteChk  = document.getElementById('delete_online_lezen_image');
  const olDeleteWrap = document.getElementById('ol-delete-wrapper');
  if (olRemoveBtn && olDeleteChk) {
    olRemoveBtn.addEventListener('click', function () {
      if (confirm('Weet je zeker dat je de huidige afbeelding wilt verwijderen?')) {
        olDeleteChk.checked = true;
        if (olImagePreview) olImagePreview.innerHTML = '';
        if (olDeleteWrap)   olDeleteWrap.style.display = 'none';
      }
    });
  }

  // "Gebruik standaard" buttons
  document.querySelectorAll('.fill-default-btn').forEach(function (btn) {
    btn.addEventListener('click', function () {
      const targetId = btn.getAttribute('data-fill-target');
      const value    = btn.getAttribute('data-fill-value');
      const el       = document.getElementById(targetId);
      if (!el || !value) return;
      el.value = value;
      el.focus();
      el.classList.add('ring-2', 'ring-primary-400');
      setTimeout(function () { el.classList.remove('ring-2', 'ring-primary-400'); }, 1200);
      // Trigger live preview update
      el.dispatchEvent(new Event('input'));
    });
  });

  // Init
  updateTitle();
  updateDesc();
})();
</script>
@endpush

</x-dashboard-layout>





