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
        <p class="text-base font-medium text-blue-700 dark:text-blue-400 leading-snug truncate" id="preview-title">
          {{ $previewTitle }}
        </p>
        <p class="text-sm text-gray-600 dark:text-gray-400 mt-1 line-clamp-2" id="preview-desc">
          {{ $effectiveDescription ?? 'Geen beschrijving ingesteld.' }}
        </p>
      </div>
      <p class="text-xs text-gray-400 dark:text-gray-500 mt-2">
        De titel in zoekresultaten krijgt automatisch de suffix <em>" | Online Lezen | Lucide Inkt"</em>.
      </p>
    </div>

    {{-- Edit Form --}}
    <form action="{{ route('admin.online-lezen-seo.update', $product->id) }}" method="POST">
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
            <label for="seo_title" class="text-sm font-medium text-gray-700 dark:text-gray-300">
              SEO Titel
              <span class="font-normal text-gray-400 ml-1">(aanbevolen: 50–65 tekens)</span>
            </label>
            <button type="button"
              data-fill-target="seo_title"
              data-fill-value="{{ $product->title }}"
              class="fill-default-btn text-xs text-primary-600 dark:text-primary-400 hover:underline whitespace-nowrap flex items-center gap-1">
              <i class="fa-solid fa-arrow-right-to-bracket text-xs"></i> Gebruik standaard
            </button>
          </div>
          <input
            type="text"
            id="seo_title"
            name="seo_title"
            value="{{ old('seo_title', $product->seo_title) }}"
            maxlength="70"
            placeholder="{{ $product->title }}"
            class="w-full px-3 py-2 text-sm border border-gray-300 rounded-lg focus:ring-primary-500 focus:border-primary-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white dark:placeholder-gray-400"
          >
          <div class="flex justify-between items-center mt-1">
            <p class="text-xs text-gray-400 dark:text-gray-500">
              Leeg laten = producttitel als standaard. Suffix <em>" | Online Lezen | Lucide Inkt"</em> wordt automatisch toegevoegd.
            </p>
            <span class="text-xs font-medium ml-2 whitespace-nowrap" id="title-count">
              <span id="title-len">{{ mb_strlen($product->seo_title ?? '') }}</span>/70
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
            <label for="seo_description" class="text-sm font-medium text-gray-700 dark:text-gray-300">
              SEO Beschrijving
              <span class="font-normal text-gray-400 ml-1">(aanbevolen: 120–165 tekens)</span>
            </label>
            @if($product->short_description)
              <button type="button"
                data-fill-target="seo_description"
                data-fill-value="{{ $product->short_description }}"
                class="fill-default-btn text-xs text-primary-600 dark:text-primary-400 hover:underline whitespace-nowrap flex items-center gap-1">
                <i class="fa-solid fa-arrow-right-to-bracket text-xs"></i> Gebruik standaard
              </button>
            @endif
          </div>
          <textarea
            id="seo_description"
            name="seo_description"
            rows="3"
            maxlength="320"
            placeholder="{{ $product->short_description ?? 'Voeg een beschrijving toe…' }}"
            class="w-full px-3 py-2 text-sm border border-gray-300 rounded-lg focus:ring-primary-500 focus:border-primary-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white dark:placeholder-gray-400"
          >{{ old('seo_description', $product->seo_description) }}</textarea>
          <div class="flex justify-between items-center mt-1">
            <p class="text-xs text-gray-400 dark:text-gray-500">
              Leeg laten = korte productbeschrijving als standaard.
            </p>
            <span class="text-xs font-medium ml-2 whitespace-nowrap" id="desc-count">
              <span id="desc-len">{{ mb_strlen($product->seo_description ?? '') }}</span>/320
            </span>
          </div>
          <div class="mt-1.5 flex items-center gap-2">
            <div class="flex-1 h-1.5 bg-gray-200 dark:bg-gray-600 rounded-full overflow-hidden">
              <div id="desc-bar" class="h-full rounded-full transition-all duration-200"></div>
            </div>
            <span class="text-xs text-gray-400 dark:text-gray-500" id="desc-range-label">Ideaal: 120–165 tekens</span>
          </div>
          @error('seo_description')
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
  const titleInput = document.getElementById('seo_title');
  const descInput  = document.getElementById('seo_description');
  const previewTitle = document.getElementById('preview-title');
  const previewDesc  = document.getElementById('preview-desc');
  const SUFFIX = ' | Online Lezen | Lucide Inkt';
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
    previewTitle.textContent = (val || DEFAULT_TITLE) + SUFFIX;
  }

  function updateDesc() {
    const val = descInput.value.trim();
    const len = val.length;
    document.getElementById('desc-len').textContent = len;
    updateBar('desc-bar', 'desc-range-label', len, 120, 165, 320);
    previewDesc.textContent = val || DEFAULT_DESC || 'Geen beschrijving ingesteld.';
  }

  titleInput.addEventListener('input', updateTitle);
  descInput.addEventListener('input', updateDesc);

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





