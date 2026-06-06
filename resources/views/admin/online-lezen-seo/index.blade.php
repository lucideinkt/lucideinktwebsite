<x-dashboard-layout>

  @if(session('success'))
    <div class="flex items-center p-4 mb-4 text-sm text-green-800 rounded-lg bg-green-50 dark:bg-gray-800 dark:text-green-400" role="alert">
      <svg class="shrink-0 inline w-4 h-4 me-3" fill="currentColor" viewBox="0 0 20 20"><path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z"/></svg>
      {{ session('success') }}
    </div>
  @endif

  <div class="relative overflow-hidden bg-white shadow-md dark:bg-gray-800 sm:rounded-lg">

    {{-- Toolbar --}}
    <div class="flex flex-col items-center justify-between p-4 space-y-3 md:flex-row md:space-y-0 md:space-x-4">
      <div class="flex items-center gap-3">
        <i class="fa-solid fa-book-open-reader text-primary-600 dark:text-primary-400"></i>
        <div>
          <h5 class="text-sm font-semibold text-gray-900 dark:text-white">Online Lezen — SEO</h5>
          <p class="text-xs text-gray-500 dark:text-gray-400">SEO-instellingen voor boeken die beschikbaar zijn in de online bibliotheek.</p>
        </div>
      </div>
      <div class="flex items-center gap-2">
        <span class="text-sm text-gray-500 dark:text-gray-400">Totaal:</span>
        <span class="font-semibold text-gray-900 dark:text-white">{{ $products->total() }}</span>
      </div>
    </div>

    {{-- Table --}}
    <div class="overflow-x-auto">
      <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
          <tr>
            <th scope="col" class="px-4 py-3">Product</th>
            <th scope="col" class="px-4 py-3">
              SEO Titel
              <span class="block normal-case font-normal text-gray-400 dark:text-gray-500 text-xs">Zichtbaar in zoekresultaten</span>
            </th>
            <th scope="col" class="px-4 py-3">
              SEO Beschrijving
              <span class="block normal-case font-normal text-gray-400 dark:text-gray-500 text-xs">Meta description</span>
            </th>
            <th scope="col" class="px-4 py-3">
              Beschikbaar via
              <span class="block normal-case font-normal text-gray-400 dark:text-gray-500 text-xs">HTML / PDF lezer</span>
            </th>
            <th scope="col" class="px-4 py-3">Actie</th>
          </tr>
        </thead>
        <tbody>
          @forelse ($products as $product)
            @php
              $imgSrc = $product->image_1
                ? (Str::startsWith($product->image_1, 'https://')
                    ? $product->image_1
                    : (Str::startsWith($product->image_1, 'image/books/') || Str::startsWith($product->image_1, 'images/books/')
                        ? asset($product->image_1)
                        : asset('storage/' . $product->image_1)))
                : null;
              // Effective online-lezen specific SEO (does NOT fall back to shared fields for display purposes)
              $onlineTitle = $product->seo_title_online;
              $onlineDesc  = $product->seo_description_online;
              // Fallback labels for display
              $displayTitle = $onlineTitle ?: ($product->seo_title ?: $product->title);
              $displayDesc  = $onlineDesc  ?: ($product->seo_description ?: $product->short_description);
              $titleLen = mb_strlen($displayTitle ?? '');
              $descLen  = mb_strlen($displayDesc  ?? '');
            @endphp
            <tr class="border-b border-gray-200 dark:border-gray-700 hover:bg-gray-100 dark:hover:bg-gray-700">

              {{-- Product --}}
              <th scope="row" class="flex items-center px-4 py-2 font-medium text-gray-900 dark:text-white min-w-[200px]">
                @if($imgSrc)
                  <img src="{{ e($imgSrc) }}" alt="{{ $product->title }}"
                    class="w-auto h-8 mr-3 object-contain shrink-0" loading="lazy">
                @else
                  <div class="w-8 h-8 mr-3 rounded bg-gray-100 dark:bg-gray-700 flex items-center justify-center shrink-0">
                    <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/></svg>
                  </div>
                @endif
                <span class="whitespace-nowrap">{{ $product->title }}</span>
              </th>

              {{-- SEO Titel --}}
              <td class="px-4 py-2 max-w-[220px]">
                <p class="text-xs text-gray-800 dark:text-gray-200 truncate" title="{{ $displayTitle }}">
                  {{ $displayTitle }}
                </p>
                <div class="flex items-center gap-1.5 mt-0.5">
                  <span class="text-xs {{ $titleLen >= 50 && $titleLen <= 65 ? 'text-green-600 dark:text-green-400' : ($titleLen > 65 ? 'text-red-500' : 'text-amber-500') }}">
                    {{ $titleLen }} tekens
                  </span>
                  @if($onlineTitle)
                    <span class="inline-flex items-center px-1.5 py-0.5 rounded text-[10px] font-medium bg-primary-100 text-primary-700 dark:bg-primary-900/40 dark:text-primary-300">online</span>
                  @else
                    <span class="text-[10px] text-gray-400 dark:text-gray-500">(standaard)</span>
                  @endif
                </div>
              </td>

              {{-- SEO Beschrijving --}}
              <td class="px-4 py-2 max-w-[260px]">
                @if($displayDesc)
                  <p class="text-xs text-gray-800 dark:text-gray-200 line-clamp-2" title="{{ $displayDesc }}">
                    {{ $displayDesc }}
                  </p>
                  <div class="flex items-center gap-1.5 mt-0.5">
                    <span class="text-xs {{ $descLen >= 120 && $descLen <= 165 ? 'text-green-600 dark:text-green-400' : ($descLen > 165 ? 'text-amber-500' : 'text-red-500') }}">
                      {{ $descLen }} tekens
                    </span>
                    @if($onlineDesc)
                      <span class="inline-flex items-center px-1.5 py-0.5 rounded text-[10px] font-medium bg-primary-100 text-primary-700 dark:bg-primary-900/40 dark:text-primary-300">online</span>
                    @else
                      <span class="text-[10px] text-gray-400 dark:text-gray-500">(standaard)</span>
                    @endif
                  </div>
                @else
                  <span class="text-xs text-red-500">Geen beschrijving</span>
                @endif
              </td>

              {{-- Beschikbaar via --}}
              <td class="px-4 py-2">
                <div class="flex flex-col gap-1">
                  @if($product->book_content_published && $product->book_pages_count > 0)
                    <span class="inline-flex items-center gap-1 text-xs font-medium text-green-700 dark:text-green-400">
                      <i class="fa-solid fa-code w-3"></i> HTML ({{ $product->book_pages_count }} pag.)
                    </span>
                  @endif
                  @if($product->pdf_reader_enabled && $product->pdf_file)
                    <span class="inline-flex items-center gap-1 text-xs font-medium text-blue-700 dark:text-blue-400">
                      <i class="fa-solid fa-file-pdf w-3"></i> PDF lezer
                    </span>
                  @endif
                </div>
              </td>

              {{-- Actie --}}
              <td class="px-4 py-2 whitespace-nowrap">
                <a href="{{ route('admin.online-lezen-seo.edit', $product->id) }}"
                  class="text-xs font-medium text-primary-700 hover:underline dark:text-primary-400">
                  Bewerken
                </a>
              </td>

            </tr>
          @empty
            <tr>
              <td colspan="5" class="px-4 py-6 text-center text-gray-500 dark:text-gray-400">
                Geen producten gevonden in de online bibliotheek.
              </td>
            </tr>
          @endforelse
        </tbody>
      </table>
    </div>

    {{-- Pagination --}}
    <nav class="flex flex-col items-start justify-between p-4 space-y-3 md:flex-row md:items-center md:space-y-0" aria-label="Table navigation">
      <span class="text-sm font-normal text-gray-500 dark:text-gray-400">
        Showing
        <span class="font-semibold text-gray-900 dark:text-white">{{ $products->firstItem() }}-{{ $products->lastItem() }}</span>
        of
        <span class="font-semibold text-gray-900 dark:text-white">{{ $products->total() }}</span>
      </span>
      <ul class="inline-flex items-stretch -space-x-px">
        <li>
          <a href="{{ $products->previousPageUrl() ?? '#' }}"
            class="flex items-center justify-center h-full py-1.5 px-3 ml-0 text-gray-500 bg-white rounded-l-lg border border-gray-300 hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white {{ $products->onFirstPage() ? 'pointer-events-none opacity-50' : '' }}">
            <span class="sr-only">Vorige</span>
            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z" clip-rule="evenodd"/></svg>
          </a>
        </li>
        @foreach ($products->getUrlRange(1, $products->lastPage()) as $page => $url)
          <li>
            <a href="{{ $url }}"
              class="flex items-center justify-center px-3 py-2 text-sm leading-tight border {{ $page == $products->currentPage() ? 'z-10 text-primary-600 bg-primary-50 border-primary-300 hover:bg-primary-100 hover:text-primary-700 dark:border-gray-700 dark:bg-gray-700 dark:text-white' : 'text-gray-500 bg-white border-gray-300 hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white' }}">{{ $page }}</a>
          </li>
        @endforeach
        <li>
          <a href="{{ $products->nextPageUrl() ?? '#' }}"
            class="flex items-center justify-center h-full py-1.5 px-3 leading-trailing text-gray-500 bg-white rounded-r-lg border border-gray-300 hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white {{ !$products->hasMorePages() ? 'pointer-events-none opacity-50' : '' }}">
            <span class="sr-only">Volgende</span>
            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"/></svg>
          </a>
        </li>
      </ul>
    </nav>

  </div>

</x-dashboard-layout>

