<x-dashboard-layout>

@section('title', 'Nieuw Artikel')

@push('head')
<style>
  .image-preview { max-height: 160px; border-radius: 0.375rem; margin-top: 0.5rem; border: 1px solid #e5e7eb; }
  .dark .image-preview { border-color: #374151; }
</style>
@endpush

<div class="max-w-[1100px]">
  <div class="mb-4">
    <a href="{{ route('admin.artikelen.index') }}" class="text-sm text-primary-600 hover:underline dark:text-primary-400">
      ← Terug naar overzicht
    </a>
  </div>

  <div class="bg-white dark:bg-gray-800 shadow-md sm:rounded-lg p-6">
    <h2 class="text-lg font-semibold text-gray-900 dark:text-white mb-6">Nieuw Artikel</h2>

    @if($errors->any())
    <div class="mb-4 p-4 text-sm text-red-800 rounded-lg bg-red-50 dark:bg-gray-800 dark:text-red-400">
      <ul class="list-disc list-inside space-y-1">
        @foreach($errors->all() as $error)
          <li>{{ $error }}</li>
        @endforeach
      </ul>
    </div>
    @endif

    <form action="{{ route('admin.artikelen.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
      @csrf

      {{-- Titel --}}
      <div>
        <label for="title" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Titel <span class="text-red-500">*</span></label>
        <input type="text" id="title" name="title" value="{{ old('title') }}" required
          class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white"
          placeholder="Bijv. De betekenis van Tawakkul in de Risale-i Nur">
      </div>

      {{-- Uitgelichte afbeelding --}}
      <div class="space-y-3">
        <label class="block text-sm font-medium text-gray-900 dark:text-white">Uitgelichte afbeelding (header)</label>
        <input type="file" name="featured_image" accept="image/*" id="featured_image_input"
          class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-medium file:bg-primary-50 file:text-primary-700 hover:file:bg-primary-100 dark:text-gray-400">
        <div id="featured_image_preview_wrapper" class="hidden">
          <img id="featured_image_preview" src="" alt="Voorbeeld" class="image-preview">
        </div>

        {{-- Toon afbeelding onder de titel --}}
        <label class="flex items-center gap-2 cursor-pointer select-none">
          <input type="checkbox" name="show_featured_image" value="1" checked
            class="w-4 h-4 text-primary-600 bg-gray-100 border-gray-300 rounded focus:ring-primary-500 dark:focus:ring-primary-600 dark:ring-offset-gray-800 dark:bg-gray-700 dark:border-gray-600">
          <span class="text-sm text-gray-700 dark:text-gray-300">Afbeelding tonen onder de titel op de artikelpagina</span>
        </label>
      </div>

      {{-- Alt-tekst --}}
      <div>
        <label for="featured_image_alt" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Alt-tekst uitgelichte afbeelding</label>
        <input type="text" id="featured_image_alt" name="featured_image_alt" value="{{ old('featured_image_alt') }}"
          class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white"
          placeholder="Beschrijvende tekst voor de afbeelding (SEO & toegankelijkheid)">
      </div>

      {{-- Inhoud (TinyMCE) --}}
      <div>
        <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Inhoud</label>
        <textarea id="body-editor" name="body">{{ old('body') }}</textarea>
      </div>

      {{-- SEO --}}
      <div class="pt-2 border-t border-gray-200 dark:border-gray-700">
        <h3 class="text-sm font-semibold text-gray-700 dark:text-gray-300 mb-3 flex items-center gap-2">
          <i class="fa-solid fa-magnifying-glass text-xs text-gray-400"></i> SEO
        </h3>
        <div>
          <label for="seo_description" class="block mb-1 text-sm font-medium text-gray-900 dark:text-white">
            SEO-beschrijving
            <span class="ml-1 text-xs font-normal text-gray-400">(optioneel — max 165 tekens, ideaal 120–165)</span>
          </label>
          <textarea id="seo_description" name="seo_description" rows="3" maxlength="165"
            placeholder="Laat leeg om automatisch te genereren uit de eerste alinea van de inhoud..."
            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white">{{ old('seo_description') }}</textarea>
          <p class="mt-1 text-xs text-gray-500 dark:text-gray-400 flex items-center gap-1">
            <span id="seo_desc_count">0</span> / 165 tekens
            <span id="seo_desc_feedback" class="ml-2"></span>
          </p>
        </div>
      </div>
      <div class="grid grid-cols-2 gap-4 pt-2 border-t border-gray-200 dark:border-gray-700">
        <div>
          <label for="sort_order" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Volgorde</label>
          <input type="number" id="sort_order" name="sort_order" value="{{ old('sort_order', 0) }}" min="0"
            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-32 p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white">
          <p class="mt-1 text-xs text-gray-500 dark:text-gray-400">Lager = eerder weergegeven.</p>
        </div>
        <div class="flex items-start pt-7">
          <input type="checkbox" id="is_published" name="is_published" value="1" {{ old('is_published') ? 'checked' : '' }}
            class="w-4 h-4 text-primary-600 bg-gray-100 border-gray-300 rounded focus:ring-primary-500 dark:focus:ring-primary-600 dark:ring-offset-gray-800 dark:bg-gray-700 dark:border-gray-600">
          <label for="is_published" class="ms-2 text-sm font-medium text-gray-900 dark:text-gray-300">Gepubliceerd (zichtbaar op website)</label>
        </div>
      </div>

      <div class="flex gap-3 pt-2">
        <button type="submit"
          class="text-white bg-primary-700 hover:bg-primary-800 focus:ring-4 focus:outline-none focus:ring-primary-300 font-medium rounded-lg text-sm px-5 py-2.5 dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800">
          Artikel opslaan
        </button>
        <a href="{{ route('admin.artikelen.index') }}"
          class="text-gray-900 bg-white border border-gray-300 hover:bg-gray-100 focus:ring-4 focus:ring-gray-200 font-medium rounded-lg text-sm px-5 py-2.5 dark:bg-gray-800 dark:text-white dark:border-gray-600 dark:hover:bg-gray-700 dark:focus:ring-gray-700">
          Annuleren
        </a>
      </div>
    </form>
  </div>
</div>

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/tinymce@7/tinymce.min.js" referrerpolicy="origin"></script>
<script>
document.getElementById('featured_image_input').addEventListener('change', function () {
    const file = this.files[0];
    if (!file) return;
    document.getElementById('featured_image_preview').src = URL.createObjectURL(file);
    document.getElementById('featured_image_preview_wrapper').classList.remove('hidden');
});

const isDark = document.documentElement.classList.contains('dark');

tinymce.init({
    selector: '#body-editor',
    skin: isDark ? 'oxide-dark' : 'oxide',
    content_css: 'default',
    plugins: 'image link lists table code autoresize anchor',
    toolbar: 'undo redo | blocks | bold italic underline | alignleft aligncenter alignright | bullist numlist | link image | table | removeformat | code',
    toolbar_mode: 'wrap',
    min_height: 500,
    menubar: false,
    branding: false,
    promotion: false,
    object_resizing: true,
    resize_img_proportional: true,
    image_advtab: true,
    image_caption: true,
    image_class_list: [
        { title: 'Geen uitlijning (blok)', value: '' },
        { title: 'Links (tekst eromheen)', value: 'align-left' },
        { title: 'Rechts (tekst eromheen)', value: 'align-right' },
    ],
    images_upload_handler: function (blobInfo) {
        return new Promise(function (resolve, reject) {
            const formData = new FormData();
            formData.append('file', blobInfo.blob(), blobInfo.filename());
            formData.append('_token', document.querySelector('meta[name="csrf-token"]').content);
            fetch('{{ route('admin.artikelen.upload-image') }}', { method: 'POST', body: formData })
                .then(r => r.json())
                .then(data => data.location ? resolve(data.location) : reject('Upload mislukt'))
                .catch(() => reject('Upload mislukt'));
        });
    },
    automatic_uploads: true,
    file_picker_types: 'image',
    convert_urls: false,
    content_style: `
        @font-face {
            font-family: 'DelimaMTProRegular';
            src: url('/fonts/DelimaMTPro-Regular.woff2') format('woff2');
            font-weight: 500;
            font-style: normal;
        }
        body {
            font-family: 'DelimaMTProRegular', sans-serif;
            font-weight: 500;
            font-size: 19px;
            line-height: 1.8;
            color: #1f2937;
            background: #f7e9c4;
            max-width: 952px;
            margin: 0 auto;
            padding: 16px 0;
        }
        p { margin: 0 0 0.9em 0; }
        p.indent-p, h1.indent-p, h2.indent-p, h3.indent-p, h4.indent-p, h5.indent-p, h6.indent-p { text-indent: 50px; }
        h1,h2,h3,h4,h5,h6 { margin: 1.25em 0 0.4em 0; line-height: 1.3; }
        img { max-width: 100%; height: auto; border-radius: 4px; }
        img[style*="float: left"], img[style*="float:left"]   { float: left;  margin: 2px 1rem 0.4rem 0 !important; display: inline; }
        img[style*="float: right"], img[style*="float:right"] { float: right; margin: 2px 0 0.4rem 1rem !important; display: inline; }
        figure { margin: 0 0 1em 0; }
        figure.align-left  { float: left;  margin: 2px 1rem 0.4rem 0; }
        figure.align-right { float: right; margin: 2px 0 0.4rem 1rem; }
        figure img { margin: 0; width: 100%; }
        figcaption { font-size: 0.82em; color: #9ca3af; text-align: center; margin-top: 0.35rem; }
        blockquote { border-left: 4px solid #6b7280; padding-left: 1rem; color: #6b7280; margin: 1rem 0; }
        ul, ol { padding-left: 1.5rem; margin: 0 0 0.9em 0; }
        table { border-collapse: collapse; width: 100%; margin-bottom: 1em; }
        td, th { border: 1px solid #d1d5db; padding: 6px 10px; }
    `,
});
// SEO description counter
(function () {
    const ta = document.getElementById('seo_description');
    const count = document.getElementById('seo_desc_count');
    const feedback = document.getElementById('seo_desc_feedback');
    function update() {
        const len = ta.value.length;
        count.textContent = len;
        if (len === 0) { feedback.textContent = ''; feedback.className = ''; }
        else if (len >= 120 && len <= 165) { feedback.textContent = '✓ Optimaal'; feedback.className = 'text-green-500'; }
        else if (len >= 80 && len < 120) { feedback.textContent = '⚠ Iets te kort'; feedback.className = 'text-yellow-500'; }
        else { feedback.textContent = '✗ Te kort'; feedback.className = 'text-red-500'; }
    }
    ta.addEventListener('input', update);
    update();
})();
</script>
@endpush

</x-dashboard-layout>
