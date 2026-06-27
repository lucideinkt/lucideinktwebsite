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
                  <label for="title" class="block mb-2 text-sm font-medium text-gray-700 dark:text-gray-300">Mark-up Titel</label>
                  <input type="text" name="mark_up_product_title" id="mark_up_product_title" value="{{ old('mark_up_product_title', $product->mark_up_product_title ?? '') }}"
                         class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:text-white @error('mark_up_product_title') border-red-500 @enderror">
                  @error('mark_up_product_title')<p class="mt-1 text-xs text-red-600 dark:text-red-400">{{ $message }}</p>@enderror
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
        @php
          $defaultSeoTitle = isset($product) ? (($product->title ?? '') . ' | Lucide Inkt') : '';
          $defaultSeoDesc  = isset($product) ? ($product->short_description ?? '') : '';
          $defaultSeoAuthor = 'Said Nursi';
          $defaultCanonical = isset($product) && $product->slug ? route('productShow', $product->slug) : '';
          $hasSeoTitle    = isset($product) && !empty($product->seo_title);
          $hasSeoDesc     = isset($product) && !empty($product->seo_description);
          $hasSeoAuthor   = isset($product) && !empty($product->seo_author);
          $hasCanonical   = isset($product) && !empty($product->seo_canonical_url);
        @endphp
        <div class="bg-white dark:bg-gray-800 rounded-lg shadow-sm border border-gray-200 dark:border-gray-700">
          <div class="p-4 border-b border-gray-200 dark:border-gray-700">
            <h2 class="text-base font-semibold text-gray-900 dark:text-white">SEO instellingen</h2>
          </div>
          <div class="p-4 space-y-4">

            {{-- SEO Titel --}}
            <div>
              <div class="flex items-center justify-between mb-1">
                <label for="seo_title" class="text-sm font-medium text-gray-700 dark:text-gray-300">
                  SEO Titel <span class="font-normal text-gray-400">(aanbevolen: 50–65 tekens)</span>
                </label>
                <div class="flex items-center gap-2">
                  @if($hasSeoTitle)
                    <span class="text-xs bg-primary-100 text-primary-700 dark:bg-primary-900 dark:text-primary-300 px-2 py-0.5 rounded font-medium">Aangepast</span>
                  @else
                    <span class="text-xs bg-gray-100 text-gray-500 dark:bg-gray-700 dark:text-gray-400 px-2 py-0.5 rounded font-medium">Standaard</span>
                  @endif
                  @if($defaultSeoTitle)
                    <button type="button"
                      data-fill-target="prod_seo_title"
                      data-fill-value="{{ $defaultSeoTitle }}"
                      class="prod-fill-default-btn text-xs text-primary-600 dark:text-primary-400 hover:underline whitespace-nowrap flex items-center gap-1">
                      <i class="fa-solid fa-arrow-right-to-bracket text-xs"></i> Gebruik standaard
                    </button>
                  @endif
                </div>
              </div>
              <input type="text" name="seo_title" id="prod_seo_title" maxlength="70"
                value="{{ old('seo_title', isset($product) ? ($product->seo_title ?? '') : '') }}"
                placeholder="{{ $defaultSeoTitle ?: 'Laat leeg om producttitel te gebruiken' }}"
                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:text-white">
              <div class="flex justify-between mt-1">
                <p class="text-xs text-gray-400">Laat leeg om de producttitel te gebruiken.</p>
                <span id="prod_title_counter" class="text-xs text-gray-400">0 / 70</span>
              </div>
            </div>

            {{-- SEO Beschrijving --}}
            <div>
              <div class="flex items-center justify-between mb-1">
                <label for="seo_description" class="text-sm font-medium text-gray-700 dark:text-gray-300">
                  SEO beschrijving <span class="font-normal text-gray-400">(aanbevolen: 120–165 tekens)</span>
                </label>
                <div class="flex items-center gap-2">
                  @if($hasSeoDesc)
                    <span class="text-xs bg-primary-100 text-primary-700 dark:bg-primary-900 dark:text-primary-300 px-2 py-0.5 rounded font-medium">Aangepast</span>
                  @else
                    <span class="text-xs bg-gray-100 text-gray-500 dark:bg-gray-700 dark:text-gray-400 px-2 py-0.5 rounded font-medium">Standaard</span>
                  @endif
                  @if($defaultSeoDesc)
                    <button type="button"
                      data-fill-target="prod_seo_desc"
                      data-fill-value="{{ $defaultSeoDesc }}"
                      class="prod-fill-default-btn text-xs text-primary-600 dark:text-primary-400 hover:underline whitespace-nowrap flex items-center gap-1">
                      <i class="fa-solid fa-arrow-right-to-bracket text-xs"></i> Gebruik standaard
                    </button>
                  @endif
                </div>
              </div>
              <textarea name="seo_description" id="prod_seo_desc" rows="3" maxlength="320"
                placeholder="{{ $defaultSeoDesc ?: 'Laat leeg voor korte omschrijving.' }}"
                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:text-white">{{ old('seo_description', $product->seo_description ?? '') }}</textarea>
              <div class="flex justify-between mt-1">
                <p class="text-xs text-gray-400">Laat leeg voor korte omschrijving.</p>
                <span id="prod_desc_counter" class="text-xs text-gray-400">0 / 320</span>
              </div>
              @error('seo_description')<p class="mt-1 text-xs text-red-600 dark:text-red-400">{{ $message }}</p>@enderror
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">

              {{-- SEO Tags/Keywords --}}
              <div>
                <label for="seo_tags" class="block mb-2 text-sm font-medium text-gray-700 dark:text-gray-300">SEO tags/keywords</label>
                <input type="text" name="seo_tags" id="seo_tags" placeholder="bijv. Risale-i Nur, Islam, Geloof"
                  value="{{ old('seo_tags', isset($product) && $product->seo_tags ? implode(', ', $product->seo_tags) : '') }}"
                  class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                <p class="mt-1 text-xs text-gray-400">Komma-gescheiden, bijv. Risale-i Nur, Geloof, Qur'an</p>
                @error('seo_tags')<p class="mt-1 text-xs text-red-600 dark:text-red-400">{{ $message }}</p>@enderror
              </div>

              {{-- SEO Auteur --}}
              <div>
                <div class="flex items-center justify-between mb-2">
                  <label for="seo_author" class="text-sm font-medium text-gray-700 dark:text-gray-300">SEO auteur</label>
                  <div class="flex items-center gap-2">
                    @if($hasSeoAuthor)
                      <span class="text-xs bg-primary-100 text-primary-700 dark:bg-primary-900 dark:text-primary-300 px-2 py-0.5 rounded font-medium">Aangepast</span>
                    @else
                      <span class="text-xs bg-gray-100 text-gray-500 dark:bg-gray-700 dark:text-gray-400 px-2 py-0.5 rounded font-medium">Standaard</span>
                    @endif
                    <button type="button"
                      data-fill-target="seo_author"
                      data-fill-value="{{ $defaultSeoAuthor }}"
                      class="prod-fill-default-btn text-xs text-primary-600 dark:text-primary-400 hover:underline whitespace-nowrap flex items-center gap-1">
                      <i class="fa-solid fa-arrow-right-to-bracket text-xs"></i> Gebruik standaard
                    </button>
                  </div>
                </div>
                <input type="text" name="seo_author" id="seo_author"
                  value="{{ old('seo_author', $product->seo_author ?? '') }}"
                  placeholder="{{ $defaultSeoAuthor }}"
                  class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                @error('seo_author')<p class="mt-1 text-xs text-red-600 dark:text-red-400">{{ $message }}</p>@enderror
              </div>

              {{-- SEO Robots --}}
              <div>
                <label for="seo_robots" class="block mb-2 text-sm font-medium text-gray-700 dark:text-gray-300">SEO robots</label>
                <select name="seo_robots" id="prod_seo_robots"
                  class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                  <option value="">Standaard (index, follow)</option>
                  <option value="noindex, nofollow" {{ old('seo_robots', $product->seo_robots ?? '') == 'noindex, nofollow' ? 'selected' : '' }}>noindex, nofollow</option>
                  <option value="noindex, follow"   {{ old('seo_robots', $product->seo_robots ?? '') == 'noindex, follow'   ? 'selected' : '' }}>noindex, follow</option>
                  <option value="index, nofollow"   {{ old('seo_robots', $product->seo_robots ?? '') == 'index, nofollow'   ? 'selected' : '' }}>index, nofollow</option>
                </select>
                @error('seo_robots')<p class="mt-1 text-xs text-red-600 dark:text-red-400">{{ $message }}</p>@enderror
              </div>

              {{-- Canonical URL --}}
              <div>
                <div class="flex items-center justify-between mb-2">
                  <label for="seo_canonical_url" class="text-sm font-medium text-gray-700 dark:text-gray-300">Canonical URL</label>
                  <div class="flex items-center gap-2">
                    @if($hasCanonical)
                      <span class="text-xs bg-primary-100 text-primary-700 dark:bg-primary-900 dark:text-primary-300 px-2 py-0.5 rounded font-medium">Aangepast</span>
                    @else
                      <span class="text-xs bg-gray-100 text-gray-500 dark:bg-gray-700 dark:text-gray-400 px-2 py-0.5 rounded font-medium">Standaard</span>
                    @endif
                    @if($defaultCanonical)
                      <button type="button"
                        data-fill-target="seo_canonical_url"
                        data-fill-value="{{ $defaultCanonical }}"
                        class="prod-fill-default-btn text-xs text-primary-600 dark:text-primary-400 hover:underline whitespace-nowrap flex items-center gap-1">
                        <i class="fa-solid fa-arrow-right-to-bracket text-xs"></i> Gebruik standaard
                      </button>
                    @endif
                  </div>
                </div>
                <input type="text" name="seo_canonical_url" id="seo_canonical_url"
                  placeholder="{{ $defaultCanonical ?: 'https://lucideinkt.nl/winkel/product/...' }}"
                  value="{{ old('seo_canonical_url', $product->seo_canonical_url ?? '') }}"
                  class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                <p class="mt-1 text-xs text-gray-400">Laat leeg om standaard-URL te gebruiken.</p>
                @error('seo_canonical_url')<p class="mt-1 text-xs text-red-600 dark:text-red-400">{{ $message }}</p>@enderror
              </div>
            </div>

            {{-- Google Preview --}}
            <div class="mt-2 border border-gray-100 dark:border-gray-700 rounded-lg p-3 bg-gray-50 dark:bg-gray-900">
              <p class="text-xs font-semibold text-gray-500 dark:text-gray-400 mb-2">Google zoekresultaat preview</p>
              <p id="prod_preview_url" class="text-xs text-green-700 mb-0.5">{{ isset($product) ? url('/winkel/product/' . ($product->slug ?? '...')) : url('/winkel/product/...') }}</p>
              <p id="prod_preview_title" class="text-base text-blue-600 font-medium leading-tight">{{ old('seo_title', isset($product) ? ($product->seo_title ?? $product->title ?? 'Producttitel…') : 'Producttitel…') }}</p>
              <p id="prod_preview_desc" class="text-xs text-gray-600 dark:text-gray-400 mt-0.5">{{ old('seo_description', isset($product) ? ($product->seo_description ?? $product->short_description ?? 'Omschrijving…') : 'Omschrijving…') }}</p>
            </div>
          </div>
        </div>

        {{-- SEO Score --}}
        <div class="bg-white dark:bg-gray-800 rounded-lg shadow-sm border border-gray-200 dark:border-gray-700">
          <div class="p-4 border-b border-gray-200 dark:border-gray-700">
            <h2 class="text-base font-semibold text-gray-900 dark:text-white">SEO Score</h2>
          </div>
          <div class="p-4">
            <div class="flex items-center gap-5 mb-4">
              <div class="relative w-20 h-20 shrink-0">
                <svg class="w-20 h-20 -rotate-90" viewBox="0 0 36 36">
                  <circle cx="18" cy="18" r="15.9155" fill="none" stroke="#e5e7eb" stroke-width="3"/>
                  <circle id="prod_score_ring" cx="18" cy="18" r="15.9155" fill="none" stroke="#10b981"
                    stroke-width="3" stroke-dasharray="0 100" stroke-linecap="round" class="transition-all duration-700"/>
                </svg>
                <div class="absolute inset-0 flex flex-col items-center justify-center">
                  <span id="prod_score_number" class="text-xl font-bold text-gray-900 dark:text-white">–</span>
                  <span class="text-xs text-gray-400">/ 100</span>
                </div>
              </div>
              <div>
                <div id="prod_score_label" class="text-sm font-semibold text-gray-400 mb-1">Vul de SEO-velden in…</div>
                <div id="prod_seo_checks" class="space-y-1 text-xs"></div>
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

      // ── PDF remove ──
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

      // ── SEO Checker ──
      const seoTitleInput = document.getElementById('prod_seo_title');
      const seoDescInput  = document.getElementById('prod_seo_desc');
      const seoTagsInput  = document.getElementById('seo_tags');
      const seoRobotsSel  = document.getElementById('prod_seo_robots');
      const titleInput    = document.getElementById('title');
      const shortDescInput= document.getElementById('short_description');

      const titleCounter  = document.getElementById('prod_title_counter');
      const descCounter   = document.getElementById('prod_desc_counter');
      const previewTitle  = document.getElementById('prod_preview_title');
      const previewDesc   = document.getElementById('prod_preview_desc');
      const scoreRing     = document.getElementById('prod_score_ring');
      const scoreNumber   = document.getElementById('prod_score_number');
      const scoreLabel    = document.getElementById('prod_score_label');
      const checksDiv     = document.getElementById('prod_seo_checks');

      // Default values (server-side rendered as JS vars)
      const defaultSeoTitle  = @json($defaultSeoTitle ?? '');
      const defaultSeoDesc   = @json($defaultSeoDesc ?? '');

      function updateCounter(input, counter, max) {
        counter.textContent = input.value.length + ' / ' + max;
      }

      function runSeoChecker() {
        const seoTitle  = seoTitleInput ? seoTitleInput.value.trim() : '';
        const prodTitle = titleInput ? titleInput.value.trim() : '';
        // Use SEO title override, then live title input, then server default
        const effectiveTitle = seoTitle || (prodTitle ? prodTitle + ' | Lucide Inkt' : defaultSeoTitle) || 'Producttitel…';

        const seoDesc   = seoDescInput ? seoDescInput.value.trim() : '';
        const shortDesc = shortDescInput ? shortDescInput.value.trim() : '';
        const effectiveDesc = seoDesc || shortDesc || defaultSeoDesc || '';

        // Update preview
        if (previewTitle) previewTitle.textContent = effectiveTitle;
        if (previewDesc)  previewDesc.textContent  = effectiveDesc || 'Geen omschrijving.';

        // Counters
        if (seoTitleInput && titleCounter) updateCounter(seoTitleInput, titleCounter, 70);
        if (seoDescInput  && descCounter)  updateCounter(seoDescInput,  descCounter,  320);

        // Score checks
        const checks = [];
        let score = 0;

        // Title (0–35 pts)
        if (effectiveTitle && effectiveTitle.length > 3) {
          score += 15;
          checks.push({ ok: true, msg: 'Titel aanwezig' });
          const tlen = effectiveTitle.length;
          if (tlen >= 50 && tlen <= 65) {
            score += 20; checks.push({ ok: true, msg: 'Titellengte optimaal (' + tlen + ' tekens)' });
          } else if (tlen >= 35 && tlen < 50) {
            score += 10; checks.push({ warn: true, msg: 'Titel iets te kort (' + tlen + ' tekens, doel: 50–65)' });
          } else if (tlen > 65 && tlen <= 80) {
            score += 10; checks.push({ warn: true, msg: 'Titel iets te lang (' + tlen + ' tekens, doel: 50–65)' });
          } else {
            score += 3; checks.push({ ok: false, msg: 'Titellengte niet optimaal (' + tlen + ' tekens)' });
          }
        } else {
          checks.push({ ok: false, msg: 'Geen titel ingesteld' });
        }

        // Description (0–35 pts)
        if (effectiveDesc && effectiveDesc.length > 0) {
          score += 15;
          checks.push({ ok: true, msg: 'Omschrijving aanwezig' + (seoDesc ? ' (SEO-veld)' : ' (korte omschrijving)') });
          const dlen = effectiveDesc.length;
          if (dlen >= 120 && dlen <= 165) {
            score += 20; checks.push({ ok: true, msg: 'Omschrijvingslengte optimaal (' + dlen + ' tekens)' });
          } else if (dlen >= 80 && dlen < 120) {
            score += 10; checks.push({ warn: true, msg: 'Omschrijving iets te kort (' + dlen + ' tekens, doel: 120–165)' });
          } else if (dlen > 165 && dlen <= 220) {
            score += 10; checks.push({ warn: true, msg: 'Omschrijving iets te lang (' + dlen + ' tekens, doel: 120–165)' });
          } else {
            score += 3; checks.push({ ok: false, msg: 'Omschrijvingslengte niet optimaal (' + dlen + ' tekens)' });
          }
        } else {
          checks.push({ ok: false, msg: 'Geen omschrijving — vul korte omschrijving of SEO-omschrijving in' });
        }

        // Keywords (0–10 pts)
        if (seoTagsInput && seoTagsInput.value.trim()) {
          const tags = seoTagsInput.value.split(',').map(t => t.trim()).filter(t => t);
          if (tags.length >= 3) {
            score += 10; checks.push({ ok: true, msg: tags.length + ' SEO-keywords ingesteld' });
          } else {
            score += 5; checks.push({ warn: true, msg: tags.length + ' keyword(s) — aanbevolen: 3 of meer' });
          }
        } else {
          checks.push({ warn: true, msg: 'Geen SEO-keywords ingesteld (aanbevolen voor zoekwoorden)' });
        }

        // Robots (0–10 pts)
        const robots = seoRobotsSel ? seoRobotsSel.value : '';
        if (!robots || robots.startsWith('index')) {
          score += 10; checks.push({ ok: true, msg: 'Product wordt geïndexeerd door zoekmachines' });
        } else if (robots === 'noindex, nofollow') {
          checks.push({ ok: false, msg: 'Product geblokkeerd voor zoekmachines (noindex, nofollow)' });
        } else {
          score += 5; checks.push({ warn: true, msg: 'Robots: ' + robots });
        }

        // SEO Title explicitly set (0–10 pts)
        if (seoTitle) {
          score += 10; checks.push({ ok: true, msg: 'SEO-titel expliciet ingesteld (niet alleen producttitel)' });
        } else {
          checks.push({ warn: true, msg: 'Geen aparte SEO-titel — producttitel wordt gebruikt' });
        }

        score = Math.min(100, Math.max(0, score));
        scoreNumber.textContent = score;
        scoreRing.setAttribute('stroke-dasharray', score + ' 100');

        if (score >= 75) {
          scoreRing.setAttribute('stroke', '#10b981');
          scoreLabel.textContent = '🟢 Uitstekend';
          scoreLabel.className   = 'text-sm font-semibold mb-1 text-green-600 dark:text-green-400';
        } else if (score >= 50) {
          scoreRing.setAttribute('stroke', '#f59e0b');
          scoreLabel.textContent = '🟡 Kan beter';
          scoreLabel.className   = 'text-sm font-semibold mb-1 text-yellow-600 dark:text-yellow-400';
        } else {
          scoreRing.setAttribute('stroke', '#ef4444');
          scoreLabel.textContent = '🔴 Verbetering nodig';
          scoreLabel.className   = 'text-sm font-semibold mb-1 text-red-600 dark:text-red-400';
        }

        if (checksDiv) {
          checksDiv.innerHTML = checks.map(c => {
            const icon  = c.ok ? '✅' : (c.warn ? '⚠️' : '❌');
            const color = c.ok ? 'text-green-700 dark:text-green-400'
                        : c.warn ? 'text-yellow-700 dark:text-yellow-400'
                        : 'text-red-700 dark:text-red-400';
            return `<div class="flex items-start gap-1.5 ${color}"><span class="shrink-0 text-xs">${icon}</span><span>${c.msg}</span></div>`;
          }).join('');
        }
      }

      // Bind events
      [seoTitleInput, seoDescInput, seoTagsInput, titleInput, shortDescInput].forEach(el => {
        if (el) el.addEventListener('input', runSeoChecker);
      });
      if (seoRobotsSel) seoRobotsSel.addEventListener('change', runSeoChecker);

      // ── "Gebruik standaard" fill buttons ──
      document.querySelectorAll('.prod-fill-default-btn').forEach(function(btn) {
        btn.addEventListener('click', function() {
          const targetId = btn.getAttribute('data-fill-target');
          const value    = btn.getAttribute('data-fill-value');
          const el       = document.getElementById(targetId);
          if (!el || !value) return;
          el.value = value;
          el.focus();
          // Flash highlight
          el.classList.add('ring-2', 'ring-primary-400');
          setTimeout(() => el.classList.remove('ring-2', 'ring-primary-400'), 1200);
          runSeoChecker();
        });
      });

      // Initial run
      runSeoChecker();
    });
  </script>

</x-dashboard-layout>
