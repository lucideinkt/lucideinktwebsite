<x-dashboard-layout>

  @if(session('success'))
    <div class="flex items-center p-4 mb-4 text-sm text-green-800 rounded-lg bg-green-50 dark:bg-gray-800 dark:text-green-400" role="alert">
      <svg class="shrink-0 inline w-4 h-4 me-3" fill="currentColor" viewBox="0 0 20 20"><path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z"/></svg>
      {{ session('success') }}
    </div>
  @endif

  <form action="{{ isset($product) ? route('productUpdate', $product->id) : route('productStore') }}" method="POST" enctype="multipart/form-data">
    @if(isset($product))
      @method('PUT')
    @endif
    @csrf

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-4">

      {{-- LEFT: main content --}}
      <div class="lg:col-span-2 space-y-4">

        {{-- Basic info --}}
        <div class="bg-white dark:bg-gray-800 rounded-lg shadow-sm border border-gray-200 dark:border-gray-700">
          <div class="p-4 border-b border-gray-200 dark:border-gray-700">
            <h2 class="text-base font-semibold text-gray-900 dark:text-white">Productinformatie</h2>
          </div>
          <div class="p-4 space-y-4">
            <div>
              <label for="title" class="block mb-2 text-sm font-medium text-gray-700 dark:text-gray-300">Titel</label>
              <input type="text" name="title" id="title" value="{{ old('title', $product->title ?? '') }}"
                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:text-white @error('title') border-red-500 @enderror">
              @error('title')<p class="mt-1 text-xs text-red-600 dark:text-red-400">{{ $message }}</p>@enderror
            </div>
            <div>
              <label for="short_description" class="block mb-2 text-sm font-medium text-gray-700 dark:text-gray-300">Korte omschrijving</label>
              <textarea name="short_description" id="short_description" rows="3"
                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:text-white @error('short_description') border-red-500 @enderror">{{ old('short_description', $product->short_description ?? '') }}</textarea>
              @error('short_description')<p class="mt-1 text-xs text-red-600 dark:text-red-400">{{ $message }}</p>@enderror
            </div>
            <div>
              <label for="long_description" class="block mb-2 text-sm font-medium text-gray-700 dark:text-gray-300">Lange omschrijving</label>
              <textarea name="long_description" id="long_description" rows="6"
                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:text-white @error('long_description') border-red-500 @enderror">{{ old('long_description', $product->long_description ?? '') }}</textarea>
              @error('long_description')<p class="mt-1 text-xs text-red-600 dark:text-red-400">{{ $message }}</p>@enderror
            </div>
          </div>
        </div>

        {{-- Dimensions + Book info --}}
        <div class="bg-white dark:bg-gray-800 rounded-lg shadow-sm border border-gray-200 dark:border-gray-700">
          <div class="p-4 border-b border-gray-200 dark:border-gray-700">
            <h2 class="text-base font-semibold text-gray-900 dark:text-white">Afmetingen & boekinfo</h2>
          </div>
          <div class="p-4">
            <div class="grid grid-cols-2 sm:grid-cols-4 gap-4 mb-4">
              <div>
                <label for="weight" class="block mb-2 text-sm font-medium text-gray-700 dark:text-gray-300">Gewicht (gr.)</label>
                <input type="number" name="weight" id="weight" value="{{ old('weight', $product->weight ?? '') }}"
                  class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                @error('weight')<p class="mt-1 text-xs text-red-600 dark:text-red-400">{{ $message }}</p>@enderror
              </div>
              <div>
                <label for="height" class="block mb-2 text-sm font-medium text-gray-700 dark:text-gray-300">Hoogte (cm)</label>
                <input type="number" name="height" id="height" value="{{ old('height', $product->height ?? '') }}"
                  class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                @error('height')<p class="mt-1 text-xs text-red-600 dark:text-red-400">{{ $message }}</p>@enderror
              </div>
              <div>
                <label for="width" class="block mb-2 text-sm font-medium text-gray-700 dark:text-gray-300">Breedte (cm)</label>
                <input type="number" name="width" id="width" value="{{ old('width', $product->width ?? '') }}"
                  class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                @error('width')<p class="mt-1 text-xs text-red-600 dark:text-red-400">{{ $message }}</p>@enderror
              </div>
              <div>
                <label for="depth" class="block mb-2 text-sm font-medium text-gray-700 dark:text-gray-300">Diepte (cm)</label>
                <input type="number" name="depth" id="depth" value="{{ old('depth', $product->depth ?? '') }}"
                  class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                @error('depth')<p class="mt-1 text-xs text-red-600 dark:text-red-400">{{ $message }}</p>@enderror
              </div>
            </div>
            <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
              <div>
                <label for="pages" class="block mb-2 text-sm font-medium text-gray-700 dark:text-gray-300">Aantal pagina's</label>
                <input type="number" name="pages" id="pages" value="{{ old('pages', $product->pages ?? '') }}" min="0"
                  class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                @error('pages')<p class="mt-1 text-xs text-red-600 dark:text-red-400">{{ $message }}</p>@enderror
              </div>
              <div>
                <label for="binding_type" class="block mb-2 text-sm font-medium text-gray-700 dark:text-gray-300">Uitvoering</label>
                <select name="binding_type" id="binding_type"
                  class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                  <option value="">-- Kies uitvoering --</option>
                  <option value="hardcover" {{ old('binding_type', $product->binding_type ?? '') == 'hardcover' ? 'selected' : '' }}>Hardcover</option>
                  <option value="softcover" {{ old('binding_type', $product->binding_type ?? '') == 'softcover' ? 'selected' : '' }}>Softcover</option>
                </select>
                @error('binding_type')<p class="mt-1 text-xs text-red-600 dark:text-red-400">{{ $message }}</p>@enderror
              </div>
              <div>
                <label for="ean_code" class="block mb-2 text-sm font-medium text-gray-700 dark:text-gray-300">EAN Code</label>
                <input type="text" name="ean_code" id="ean_code" value="{{ old('ean_code', $product->ean_code ?? '') }}" maxlength="13" placeholder="9781234567890"
                  class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                @error('ean_code')<p class="mt-1 text-xs text-red-600 dark:text-red-400">{{ $message }}</p>@enderror
              </div>
            </div>
          </div>
        </div>

        {{-- Images --}}
        <div class="bg-white dark:bg-gray-800 rounded-lg shadow-sm border border-gray-200 dark:border-gray-700">
          <div class="p-4 border-b border-gray-200 dark:border-gray-700">
            <h2 class="text-base font-semibold text-gray-900 dark:text-white">Afbeeldingen</h2>
          </div>
          <div class="p-4 grid grid-cols-1 sm:grid-cols-2 gap-4">
            @for ($i = 1; $i <= 4; $i++)
              <div class="border border-gray-200 dark:border-gray-700 rounded-lg p-3">
                <label class="block mb-2 text-sm font-medium text-gray-700 dark:text-gray-300">
                  {{ $i == 1 ? 'Hoofdafbeelding' : 'Afbeelding ' . $i }}
                </label>
                <div id="image_{{ $i }}_preview" class="mb-2">
                  @if(isset($product) && $product->{'image_'.$i})
                    @php
                      $src = Str::startsWith($product->{'image_'.$i}, 'https://')
                        ? $product->{'image_'.$i}
                        : (Str::startsWith($product->{'image_'.$i}, 'image/books/') || Str::startsWith($product->{'image_'.$i}, 'images/books/')
                          ? asset($product->{'image_'.$i})
                          : asset('storage/' . $product->{'image_'.$i}));
                    @endphp
                    <img src="{{ e($src) }}" alt="" class="w-16 h-16 object-contain rounded border border-gray-200 dark:border-gray-600">
                  @endif
                </div>
                <input type="file" name="image_{{ $i }}" id="image_{{ $i }}" accept="image/*"
                  class="block w-full text-sm text-gray-500 file:mr-3 file:py-1.5 file:px-3 file:rounded-lg file:border-0 file:text-sm file:font-medium file:bg-primary-50 file:text-primary-700 hover:file:bg-primary-100 dark:text-gray-400 dark:file:bg-gray-700 dark:file:text-gray-300 cursor-pointer">
                @if(isset($product))
                  <button type="button"
                    data-input="image_{{ $i }}"
                    data-preview="image_{{ $i }}_preview"
                    style="{{ $product->{'image_'.$i} ? '' : 'display:none;' }}"
                    class="mt-2 text-xs text-red-600 hover:underline dark:text-red-400">
                    Verwijder afbeelding
                  </button>
                  <input type="checkbox" name="delete_image_{{ $i }}" id="delete_image_{{ $i }}" value="1" class="hidden">
                @else
                  <button type="button"
                    data-input="image_{{ $i }}"
                    data-preview="image_{{ $i }}_preview"
                    class="mt-2 text-xs text-red-600 hover:underline dark:text-red-400 hidden">
                    Verwijder afbeelding
                  </button>
                @endif
                @error('image_' . $i)<p class="mt-1 text-xs text-red-600 dark:text-red-400">{{ $message }}</p>@enderror
              </div>
            @endfor
          </div>
        </div>

        {{-- PDF --}}
        <div class="bg-white dark:bg-gray-800 rounded-lg shadow-sm border border-gray-200 dark:border-gray-700">
          <div class="p-4 border-b border-gray-200 dark:border-gray-700">
            <h2 class="text-base font-semibold text-gray-900 dark:text-white">Online lezen</h2>
          </div>
          <div class="p-4 space-y-4">
            <div>
              <label for="pdf_file" class="block mb-2 text-sm font-medium text-gray-700 dark:text-gray-300">PDF bestand</label>
              @if(isset($product) && $product->pdf_file)
                <div id="pdf-current" class="flex items-center gap-3 mb-2 p-2 bg-gray-50 dark:bg-gray-700 rounded-lg border border-gray-200 dark:border-gray-600">
                  <i class="fa-solid fa-file-pdf text-red-500"></i>
                  <a href="{{ asset('storage/' . $product->pdf_file) }}" target="_blank" class="text-sm text-primary-600 hover:underline dark:text-primary-400">Bekijk huidige PDF</a>
                  <button type="button" id="remove-pdf-btn" class="ml-auto text-xs text-red-600 hover:underline dark:text-red-400">Verwijder</button>
                  <input type="checkbox" name="delete_pdf_file" id="delete_pdf_file" value="1" class="hidden">
                </div>
              @endif
              <input type="file" name="pdf_file" id="pdf_file" accept="application/pdf"
                class="block w-full text-sm text-gray-500 file:mr-3 file:py-1.5 file:px-3 file:rounded-lg file:border-0 file:text-sm file:font-medium file:bg-primary-50 file:text-primary-700 hover:file:bg-primary-100 dark:text-gray-400 dark:file:bg-gray-700 dark:file:text-gray-300 cursor-pointer">
              <p class="mt-1 text-xs text-gray-500 dark:text-gray-400">Max 50MB. Maakt boek beschikbaar in Online Lezen bibliotheek.</p>
              @error('pdf_file')<p class="mt-1 text-xs text-red-600 dark:text-red-400">{{ $message }}</p>@enderror
            </div>
            <div>
              <label for="online_lezen_image" class="block mb-2 text-sm font-medium text-gray-700 dark:text-gray-300">Online lezen afbeelding</label>
              <div id="online_lezen_image_preview" class="mb-2">
                @if(isset($product) && $product->online_lezen_image)
                  <img src="{{ asset($product->online_lezen_image) }}" alt="Online Lezen" class="w-24 h-24 object-contain rounded border border-gray-200 dark:border-gray-600">
                @endif
              </div>
              <input type="file" name="online_lezen_image" id="online_lezen_image" accept="image/*"
                class="block w-full text-sm text-gray-500 file:mr-3 file:py-1.5 file:px-3 file:rounded-lg file:border-0 file:text-sm file:font-medium file:bg-primary-50 file:text-primary-700 hover:file:bg-primary-100 dark:text-gray-400 dark:file:bg-gray-700 dark:file:text-gray-300 cursor-pointer">
              @if(isset($product) && $product->online_lezen_image)
                <button type="button" id="remove-online-lezen-image-btn" class="mt-2 text-xs text-red-600 hover:underline dark:text-red-400">Verwijder afbeelding</button>
                <input type="checkbox" name="delete_online_lezen_image" id="delete_online_lezen_image" value="1" class="hidden">
              @endif
              <p class="mt-1 text-xs text-gray-500 dark:text-gray-400">Aanbevolen: 800x1200px. Max 5MB.</p>
              @error('online_lezen_image')<p class="mt-1 text-xs text-red-600 dark:text-red-400">{{ $message }}</p>@enderror
            </div>
          </div>
        </div>

        {{-- Audio --}}
        <div class="bg-white dark:bg-gray-800 rounded-lg shadow-sm border border-gray-200 dark:border-gray-700">
          <div class="p-4 border-b border-gray-200 dark:border-gray-700">
            <h2 class="text-base font-semibold text-gray-900 dark:text-white">Online luisteren</h2>
          </div>
          <div class="p-4">
            <label for="audio_file" class="block mb-2 text-sm font-medium text-gray-700 dark:text-gray-300">Audiobestand</label>
            @if(isset($product) && $product->audio_file)
              <div id="audio-current" class="flex items-center gap-3 mb-2 p-2 bg-gray-50 dark:bg-gray-700 rounded-lg border border-gray-200 dark:border-gray-600">
                <i class="fa-solid fa-headphones text-primary-600"></i>
                <a href="{{ asset('storage/' . $product->audio_file) }}" target="_blank" class="text-sm text-primary-600 hover:underline dark:text-primary-400">Beluister huidig bestand</a>
                <button type="button" id="remove-audio-btn" class="ml-auto text-xs text-red-600 hover:underline dark:text-red-400">Verwijder</button>
                <input type="checkbox" name="delete_audio_file" id="delete_audio_file" value="1" class="hidden">
              </div>
            @endif
            <input type="file" name="audio_file" id="audio_file" accept="audio/*,.mp3,.m4a,.ogg,.wav"
              class="block w-full text-sm text-gray-500 file:mr-3 file:py-1.5 file:px-3 file:rounded-lg file:border-0 file:text-sm file:font-medium file:bg-primary-50 file:text-primary-700 hover:file:bg-primary-100 dark:text-gray-400 dark:file:bg-gray-700 dark:file:text-gray-300 cursor-pointer">
            <p class="mt-1 text-xs text-gray-500 dark:text-gray-400">Max 100MB. Formaten: MP3, M4A, OGG, WAV.</p>
            @error('audio_file')<p class="mt-1 text-xs text-red-600 dark:text-red-400">{{ $message }}</p>@enderror
          </div>
        </div>

        {{-- SEO --}}
        <div class="bg-white dark:bg-gray-800 rounded-lg shadow-sm border border-gray-200 dark:border-gray-700">
          <div class="p-4 border-b border-gray-200 dark:border-gray-700">
            <h2 class="text-base font-semibold text-gray-900 dark:text-white">SEO instellingen</h2>
          </div>
          <div class="p-4 space-y-4">
            <div>
              <label for="seo_description" class="block mb-2 text-sm font-medium text-gray-700 dark:text-gray-300">SEO beschrijving</label>
              <textarea name="seo_description" id="seo_description" rows="3" maxlength="160"
                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:text-white">{{ old('seo_description', $product->seo_description ?? '') }}</textarea>
              <p class="mt-1 text-xs text-gray-500 dark:text-gray-400">Aanbevolen: 150-160 tekens. Laat leeg voor korte omschrijving.</p>
              @error('seo_description')<p class="mt-1 text-xs text-red-600 dark:text-red-400">{{ $message }}</p>@enderror
            </div>
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
              <div>
                <label for="seo_tags" class="block mb-2 text-sm font-medium text-gray-700 dark:text-gray-300">SEO tags/keywords</label>
                <input type="text" name="seo_tags" id="seo_tags" placeholder="tag1, tag2, tag3"
                  value="{{ old('seo_tags', isset($product) && $product->seo_tags ? implode(', ', $product->seo_tags) : '') }}"
                  class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                @error('seo_tags')<p class="mt-1 text-xs text-red-600 dark:text-red-400">{{ $message }}</p>@enderror
              </div>
              <div>
                <label for="seo_author" class="block mb-2 text-sm font-medium text-gray-700 dark:text-gray-300">SEO auteur</label>
                <input type="text" name="seo_author" id="seo_author" value="{{ old('seo_author', $product->seo_author ?? '') }}"
                  class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                @error('seo_author')<p class="mt-1 text-xs text-red-600 dark:text-red-400">{{ $message }}</p>@enderror
              </div>
              <div>
                <label for="seo_robots" class="block mb-2 text-sm font-medium text-gray-700 dark:text-gray-300">SEO robots</label>
                <select name="seo_robots" id="seo_robots"
                  class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                  <option value="">Standaard (index, follow)</option>
                  <option value="noindex, nofollow" {{ old('seo_robots', $product->seo_robots ?? '') == 'noindex, nofollow' ? 'selected' : '' }}>noindex, nofollow</option>
                  <option value="noindex, follow" {{ old('seo_robots', $product->seo_robots ?? '') == 'noindex, follow' ? 'selected' : '' }}>noindex, follow</option>
                  <option value="index, nofollow" {{ old('seo_robots', $product->seo_robots ?? '') == 'index, nofollow' ? 'selected' : '' }}>index, nofollow</option>
                </select>
                @error('seo_robots')<p class="mt-1 text-xs text-red-600 dark:text-red-400">{{ $message }}</p>@enderror
              </div>
              <div>
                <label for="seo_canonical_url" class="block mb-2 text-sm font-medium text-gray-700 dark:text-gray-300">Canonical URL</label>
                <input type="text" name="seo_canonical_url" id="seo_canonical_url" placeholder="https://example.com/product"
                  value="{{ old('seo_canonical_url', $product->seo_canonical_url ?? '') }}"
                  class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                @error('seo_canonical_url')<p class="mt-1 text-xs text-red-600 dark:text-red-400">{{ $message }}</p>@enderror
              </div>
            </div>
          </div>
        </div>

      </div>

      {{-- RIGHT sidebar --}}
      <div class="space-y-4">

        {{-- Publish & save --}}
        <div class="bg-white dark:bg-gray-800 rounded-lg shadow-sm border border-gray-200 dark:border-gray-700">
          <div class="p-4 border-b border-gray-200 dark:border-gray-700">
            <h2 class="text-base font-semibold text-gray-900 dark:text-white">Publiceren</h2>
          </div>
          <div class="p-4 space-y-4">
            <div>
              <label for="is_published" class="block mb-2 text-sm font-medium text-gray-700 dark:text-gray-300">Status</label>
              <select name="is_published" id="is_published"
                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                <option value="0" {{ old('is_published', isset($product) ? $product->is_published : '0') == '0' ? 'selected' : '' }}>Concept</option>
                <option value="1" {{ old('is_published', isset($product) ? $product->is_published : '0') == '1' ? 'selected' : '' }}>Gepubliceerd</option>
              </select>
              @error('is_published')<p class="mt-1 text-xs text-red-600 dark:text-red-400">{{ $message }}</p>@enderror
            </div>
            <div class="flex items-center gap-3 pt-2">
              <button type="submit"
                class="text-white bg-primary-700 hover:bg-primary-800 focus:ring-4 focus:ring-primary-300 font-medium rounded-lg text-sm px-5 py-2.5 dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800">
                Opslaan
              </button>
              <a href="{{ route('productIndex') }}" class="text-sm font-medium text-gray-500 hover:text-gray-700 dark:text-gray-400 dark:hover:text-gray-300">Annuleren</a>
            </div>
          </div>
        </div>

        {{-- Pricing & inventory --}}
        <div class="bg-white dark:bg-gray-800 rounded-lg shadow-sm border border-gray-200 dark:border-gray-700">
          <div class="p-4 border-b border-gray-200 dark:border-gray-700">
            <h2 class="text-base font-semibold text-gray-900 dark:text-white">Prijs & voorraad</h2>
          </div>
          <div class="p-4 space-y-4">
            <div>
              <label for="price" class="block mb-2 text-sm font-medium text-gray-700 dark:text-gray-300">Prijs (euro)</label>
              <input type="number" name="price" id="price" value="{{ old('price', $product->price ?? '') }}" step="0.01"
                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:text-white @error('price') border-red-500 @enderror">
              @error('price')<p class="mt-1 text-xs text-red-600 dark:text-red-400">{{ $message }}</p>@enderror
            </div>
            <div>
              <label for="stock" class="block mb-2 text-sm font-medium text-gray-700 dark:text-gray-300">Voorraad</label>
              <input type="number" name="stock" id="stock" value="{{ old('stock', $product->stock ?? '') }}"
                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:text-white @error('stock') border-red-500 @enderror">
              @error('stock')<p class="mt-1 text-xs text-red-600 dark:text-red-400">{{ $message }}</p>@enderror
            </div>
          </div>
        </div>

        {{-- Category & exemplaar --}}
        <div class="bg-white dark:bg-gray-800 rounded-lg shadow-sm border border-gray-200 dark:border-gray-700">
          <div class="p-4 border-b border-gray-200 dark:border-gray-700">
            <h2 class="text-base font-semibold text-gray-900 dark:text-white">Categorie</h2>
          </div>
          <div class="p-4 space-y-4">
            <div>
              <label for="category_id" class="block mb-2 text-sm font-medium text-gray-700 dark:text-gray-300">Categorie</label>
              <select name="category_id" id="category_id"
                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                <option value="">-- Kies categorie --</option>
                @foreach ($categories as $category)
                  <option value="{{ $category->id }}" {{ old('category_id', $product->category_id ?? '') == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                @endforeach
              </select>
              @error('category_id')<p class="mt-1 text-xs text-red-600 dark:text-red-400">{{ $message }}</p>@enderror
            </div>
            <div>
              <label for="product_copy_id" class="block mb-2 text-sm font-medium text-gray-700 dark:text-gray-300">Exemplaar</label>
              <select name="product_copy_id" id="product_copy_id"
                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                <option value="">-- Kies exemplaar --</option>
                @foreach ($productCopies as $productCopy)
                  <option value="{{ $productCopy->id }}" {{ old('product_copy_id', $product->product_copy_id ?? '') == $productCopy->id ? 'selected' : '' }}>{{ $productCopy->name }}</option>
                @endforeach
              </select>
              @error('product_copy_id')<p class="mt-1 text-xs text-red-600 dark:text-red-400">{{ $message }}</p>@enderror
            </div>
          </div>
        </div>

      </div>
    </div>
  </form>

  <script>
    document.addEventListener('DOMContentLoaded', function() {
      const removePdfBtn = document.getElementById('remove-pdf-btn');
      const deletePdfCheckbox = document.getElementById('delete_pdf_file');
      if (removePdfBtn && deletePdfCheckbox) {
        removePdfBtn.addEventListener('click', function() {
          if (confirm('Weet je zeker dat je dit PDF bestand wilt verwijderen?')) {
            deletePdfCheckbox.checked = true;
            document.getElementById('pdf-current').innerHTML = '<span class="text-xs text-gray-500 dark:text-gray-400">PDF wordt verwijderd bij opslaan.</span>';
          }
        });
      }

      const removeOnlineLezenImageBtn = document.getElementById('remove-online-lezen-image-btn');
      const deleteOnlineLezenImageCheckbox = document.getElementById('delete_online_lezen_image');
      const onlineLezenImagePreview = document.getElementById('online_lezen_image_preview');
      if (removeOnlineLezenImageBtn && deleteOnlineLezenImageCheckbox) {
        removeOnlineLezenImageBtn.addEventListener('click', function() {
          if (confirm('Weet je zeker dat je deze afbeelding wilt verwijderen?')) {
            deleteOnlineLezenImageCheckbox.checked = true;
            removeOnlineLezenImageBtn.style.display = 'none';
            if (onlineLezenImagePreview) onlineLezenImagePreview.innerHTML = '';
          }
        });
      }

      const onlineLezenImageInput = document.getElementById('online_lezen_image');
      if (onlineLezenImageInput && onlineLezenImagePreview) {
        onlineLezenImageInput.addEventListener('change', function(e) {
          if (e.target.files.length > 0) {
            const reader = new FileReader();
            reader.onload = function(event) {
              onlineLezenImagePreview.innerHTML = '<img src="' + event.target.result + '" alt="Preview" class="w-24 h-24 object-contain rounded border border-gray-200 dark:border-gray-600">';
            };
            reader.readAsDataURL(e.target.files[0]);
          }
        });
      }

      const removeAudioBtn = document.getElementById('remove-audio-btn');
      const deleteAudioCheckbox = document.getElementById('delete_audio_file');
      if (removeAudioBtn && deleteAudioCheckbox) {
        removeAudioBtn.addEventListener('click', function() {
          if (confirm('Weet je zeker dat je dit audiobestand wilt verwijderen?')) {
            deleteAudioCheckbox.checked = true;
            document.getElementById('audio-current').innerHTML = '<span class="text-xs text-gray-500 dark:text-gray-400">Audio wordt verwijderd bij opslaan.</span>';
          }
        });
      }

      document.querySelectorAll('[data-input][data-preview]').forEach(function(btn) {
        btn.addEventListener('click', function() {
          const inputId = btn.getAttribute('data-input');
          const previewId = btn.getAttribute('data-preview');
          const deleteCheckbox = document.getElementById('delete_' + inputId);
          if (confirm('Weet je zeker dat je deze afbeelding wilt verwijderen?')) {
            if (deleteCheckbox) deleteCheckbox.checked = true;
            const preview = document.getElementById(previewId);
            if (preview) preview.innerHTML = '';
            btn.style.display = 'none';
          }
        });
      });
    });
  </script>

</x-dashboard-layout>
