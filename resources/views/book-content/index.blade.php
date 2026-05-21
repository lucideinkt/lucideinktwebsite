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
        <i class="fa-solid fa-book-open text-primary-600 dark:text-primary-400"></i>
        <div>
          <h5 class="text-sm font-semibold text-gray-900 dark:text-white">HTML Boekinhoud</h5>
          <p class="text-xs text-gray-500 dark:text-gray-400">Als product HTML inhoud heeft, wordt de HTML-lezer getoond i.p.v. de PDF-viewer.</p>
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
            <th scope="col" class="px-4 py-3">Status</th>
            <th scope="col" class="px-4 py-3">HTML inhoud</th>
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
            @endphp
            <tr class="border-b border-gray-200 dark:border-gray-700 hover:bg-gray-100 dark:hover:bg-gray-700">
              <th scope="row" class="flex items-center px-4 py-2 font-medium text-gray-900 dark:text-white">
                @if($imgSrc)
                  <img src="{{ e($imgSrc) }}" alt="{{ $product->title }}"
                    class="w-auto h-8 mr-3 object-contain cursor-pointer shrink-0"
                    loading="lazy"
                    data-tooltip-target="img-tooltip-bc-{{ $product->id }}"
                    data-tooltip-placement="right">
                  <div id="img-tooltip-bc-{{ $product->id }}" role="tooltip"
                    class="absolute z-50 invisible inline-block p-1 bg-white border border-gray-200 rounded-lg shadow-lg dark:bg-gray-800 dark:border-gray-700 opacity-0 transition-opacity duration-300">
                    <img src="{{ e($imgSrc) }}" alt="{{ $product->title }}" class="w-48 h-48 object-contain rounded">
                    <div class="tooltip-arrow" data-popper-arrow></div>
                  </div>
                @else
                  <div class="w-8 h-8 mr-3 rounded bg-gray-100 dark:bg-gray-700 flex items-center justify-center shrink-0">
                    <svg class="w-4 h-4 text-gray-400 dark:text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                  </div>
                @endif
                <span class="whitespace-nowrap">{{ $product->title }}</span>
              </th>
              <td class="px-4 py-2">
                @if($product->is_published)
                  <span class="bg-green-100 text-green-800 text-xs font-medium px-2 py-0.5 rounded dark:bg-green-900 dark:text-green-300">Gepubliceerd</span>
                @else
                  <span class="bg-gray-100 text-gray-800 text-xs font-medium px-2 py-0.5 rounded dark:bg-gray-700 dark:text-gray-300">Concept</span>
                @endif
              </td>
              <td class="px-4 py-2">
                @if($product->book_pages_count > 0)
                  <span class="inline-flex items-center gap-1.5 text-xs font-medium text-green-700 dark:text-green-400">
                    <svg class="w-3.5 h-3.5" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/></svg>
                    {{ $product->book_pages_count }} pagina's
                  </span>
                @else
                  <span class="inline-flex items-center gap-1.5 text-xs text-gray-400 dark:text-gray-500">
                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><circle cx="12" cy="12" r="10" stroke-width="2"/></svg>
                    Geen pagina's
                  </span>
                @endif
              </td>
              <td class="px-4 py-2 whitespace-nowrap">
                <a href="{{ route('bookContent.edit', $product->id) }}"
                  class="text-xs font-medium text-primary-700 hover:underline dark:text-primary-400">Bewerken</a>
              </td>
            </tr>
          @empty
            <tr>
              <td colspan="4" class="px-4 py-6 text-center text-gray-500 dark:text-gray-400">Geen producten gevonden.</td>
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
            class="flex items-center justify-center h-full py-1.5 px-3 leading-tight text-gray-500 bg-white rounded-r-lg border border-gray-300 hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white {{ !$products->hasMorePages() ? 'pointer-events-none opacity-50' : '' }}">
            <span class="sr-only">Volgende</span>
            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"/></svg>
          </a>
        </li>
      </ul>
    </nav>

  </div>

</x-dashboard-layout>
