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
      <div class="w-full md:w-1/2">
        <form method="GET" action="{{ route('productIndex') }}" class="flex items-center">
          <label for="product-search" class="sr-only">Zoeken</label>
          <div class="relative w-full">
            <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
              <svg aria-hidden="true" class="w-5 h-5 text-gray-500 dark:text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z" clip-rule="evenodd" />
              </svg>
            </div>
            <input type="text" name="search" id="product-search" value="{{ request('search') }}"
              class="block w-full p-2 pl-10 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-primary-500 focus:border-primary-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
              placeholder="Zoek op productnaam...">
            @foreach(request('categories', []) as $cat)
              <input type="hidden" name="categories[]" value="{{ $cat }}">
            @endforeach
          </div>
        </form>
      </div>
      <div class="flex flex-col items-stretch justify-end flex-shrink-0 w-full space-y-2 md:w-auto md:flex-row md:space-y-0 md:items-center md:space-x-3">
        <a href="{{ route('productCreatePage') }}"
          class="flex items-center justify-center px-4 py-2 text-sm font-medium text-white rounded-lg bg-primary-700 hover:bg-primary-800 focus:ring-4 focus:ring-primary-300 dark:bg-primary-600 dark:hover:bg-primary-700 focus:outline-none dark:focus:ring-primary-800">
          <svg class="h-3.5 w-3.5 mr-2" fill="currentColor" viewBox="0 0 20 20" aria-hidden="true">
            <path clip-rule="evenodd" fill-rule="evenodd" d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z" />
          </svg>
          Nieuw product
        </a>
        <div class="flex items-center w-full space-x-3 md:w-auto">
          {{-- Filter dropdown --}}
          <form method="GET" action="{{ route('productIndex') }}" id="filter-form">
            @if(request('search'))
              <input type="hidden" name="search" value="{{ request('search') }}">
            @endif
            <button id="filterDropdownButton" data-dropdown-toggle="filterDropdown" type="button"
              class="flex items-center justify-center w-full px-4 py-2 text-sm font-medium text-gray-900 bg-white border border-gray-200 rounded-lg md:w-auto focus:outline-none hover:bg-gray-100 hover:text-primary-700 focus:z-10 focus:ring-4 focus:ring-gray-200 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700">
              <svg xmlns="http://www.w3.org/2000/svg" aria-hidden="true" class="w-4 h-4 mr-2 text-gray-400" viewBox="0 0 20 20" fill="currentColor">
                <path fill-rule="evenodd" d="M3 3a1 1 0 011-1h12a1 1 0 011 1v3a1 1 0 01-.293.707L12 11.414V15a1 1 0 01-.293.707l-2 2A1 1 0 018 17v-5.586L3.293 6.707A1 1 0 013 6V3z" clip-rule="evenodd" />
              </svg>
              Filter
              @if(count(request('categories', [])) > 0)
                <span class="ml-1.5 bg-primary-100 text-primary-800 text-xs font-medium px-1.5 py-0.5 rounded dark:bg-primary-900 dark:text-primary-300">{{ count(request('categories', [])) }}</span>
              @endif
              <svg class="-mr-1 ml-1.5 w-5 h-5" fill="currentColor" viewBox="0 0 20 20" aria-hidden="true">
                <path clip-rule="evenodd" fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" />
              </svg>
            </button>
            <div id="filterDropdown" class="z-10 hidden w-56 p-3 bg-white rounded-lg shadow dark:bg-gray-700">
              <h6 class="mb-3 text-sm font-medium text-gray-900 dark:text-white">Categorie</h6>
              <ul class="space-y-2 text-sm max-h-48 overflow-y-auto" aria-labelledby="filterDropdownButton">
                @foreach($categories as $category)
                  <li class="flex items-center">
                    <input id="cat-{{ $category->id }}" type="checkbox" name="categories[]" value="{{ $category->id }}"
                      {{ in_array($category->id, request('categories', [])) ? 'checked' : '' }}
                      onchange="document.getElementById('filter-form').submit()"
                      class="w-4 h-4 bg-gray-100 border-gray-300 rounded text-primary-600 focus:ring-primary-500 dark:focus:ring-primary-600 dark:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500">
                    <label for="cat-{{ $category->id }}" class="ml-2 text-sm font-medium text-gray-900 dark:text-gray-100 cursor-pointer">{{ $category->name }}</label>
                  </li>
                @endforeach
              </ul>
            </div>
          </form>
        </div>
      </div>
    </div>

    {{-- Table --}}
    <div class="overflow-x-auto">
      <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
          <tr>
            <th scope="col" class="px-4 py-3">Product</th>
            <th scope="col" class="px-4 py-3">Categorie</th>
            <th scope="col" class="px-4 py-3">Voorraad</th>
            <th scope="col" class="px-4 py-3">Prijs</th>
            <th scope="col" class="px-4 py-3">Status</th>
            <th scope="col" class="px-4 py-3">Aangemaakt</th>
            <th scope="col" class="px-4 py-3">Acties</th>
          </tr>
        </thead>
        <tbody>
          @forelse ($products as $product)
            @php
              $imgSrc = Str::startsWith($product->image_1, 'https://')
                ? $product->image_1
                : (Str::startsWith($product->image_1, 'image/books/') || Str::startsWith($product->image_1, 'images/books/')
                  ? asset($product->image_1)
                  : asset('storage/' . $product->image_1));
            @endphp
            <tr class="border-b border-gray-200 dark:border-gray-700 hover:bg-gray-100 dark:hover:bg-gray-700">
              <th scope="row" class="flex items-center px-4 py-2 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                @if($product->image_1)
                  <img src="{{ e($imgSrc) }}" alt="{{ $product->title }}"
                    class="w-auto h-8 mr-3 object-contain cursor-pointer"
                    loading="lazy"
                    data-tooltip-target="img-tooltip-{{ $product->id }}"
                    data-tooltip-placement="right">
                  <div id="img-tooltip-{{ $product->id }}" role="tooltip"
                    class="absolute z-50 invisible inline-block p-1 bg-white border border-gray-200 rounded-lg shadow-lg dark:bg-gray-800 dark:border-gray-700 opacity-0 transition-opacity duration-300">
                    <img src="{{ e($imgSrc) }}" alt="{{ $product->title }}" class="w-64 h-64 object-contain rounded">
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
                @if($product->category)
                  <span class="bg-primary-100 text-primary-800 text-xs font-medium px-2 py-0.5 rounded dark:bg-primary-900 dark:text-primary-300 whitespace-nowrap">{{ $product->category->name }}</span>
                @else
                  <span class="text-gray-400 dark:text-gray-500">—</span>
                @endif
              </td>
              <td class="px-4 py-2 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                <div class="flex items-center">
                  @if($product->stock > 10)
                    <div class="inline-block w-3 h-3 mr-2 bg-green-400 rounded-full"></div>
                  @elseif($product->stock > 0)
                    <div class="inline-block w-3 h-3 mr-2 bg-yellow-300 rounded-full"></div>
                  @else
                    <div class="inline-block w-3 h-3 mr-2 bg-red-500 rounded-full"></div>
                  @endif
                  {{ $product->stock }}
                </div>
              </td>
              <td class="px-4 py-2 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                €{{ number_format($product->price, 2, ',', '.') }}
              </td>
              <td class="px-4 py-2">
                @if($product->is_published)
                  <span class="bg-green-100 text-green-800 text-xs font-medium px-2 py-0.5 rounded dark:bg-green-900 dark:text-green-300">Gepubliceerd</span>
                @else
                  <span class="bg-gray-100 text-gray-800 text-xs font-medium px-2 py-0.5 rounded dark:bg-gray-700 dark:text-gray-300">Concept</span>
                @endif
              </td>
              <td class="px-4 py-2 whitespace-nowrap">{{ $product->created_at->format('d-m-Y') }}</td>
              <td class="px-4 py-2 whitespace-nowrap">
                <div class="flex items-center gap-2">
                  <a href="{{ route('productEditPage', $product->id) }}"
                    class="text-xs font-medium text-primary-700 hover:underline dark:text-primary-400">Bewerken</a>
                  <form action="{{ route('productDelete', $product->id) }}" method="POST"
                    onsubmit="return confirm('Weet je zeker dat je dit product wilt verwijderen?')">
                    @csrf
                    @method('DELETE')
                    <button type="submit"
                      class="text-xs font-medium text-red-600 hover:underline dark:text-red-500">Verwijderen</button>
                  </form>
                </div>
              </td>
            </tr>
          @empty
            <tr>
              <td colspan="7" class="px-4 py-6 text-center text-gray-500 dark:text-gray-400">Geen producten gevonden.</td>
            </tr>
          @endforelse
        </tbody>
      </table>
    </div>

    {{-- Pagination --}}
    <nav class="flex flex-col items-start justify-between p-4 space-y-3 md:flex-row md:items-center md:space-y-0" aria-label="Table navigation">
      <span class="text-sm font-normal text-gray-500 dark:text-gray-400">
        Showing
        <span class="font-semibold text-gray-900 dark:text-white">{{ $products->firstItem() }}–{{ $products->lastItem() }}</span>
        of
        <span class="font-semibold text-gray-900 dark:text-white">{{ $products->total() }}</span>
      </span>
      <ul class="inline-flex items-stretch -space-x-px">
        <li>
          <a href="{{ $products->previousPageUrl() ?? '#' }}"
            class="flex items-center justify-center h-full py-1.5 px-3 ml-0 text-gray-500 bg-white rounded-l-lg border border-gray-300 hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white {{ $products->onFirstPage() ? 'pointer-events-none opacity-50' : '' }}">
            <span class="sr-only">Vorige</span>
            <svg class="w-5 h-5" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z" clip-rule="evenodd" /></svg>
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
            <svg class="w-5 h-5" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd" /></svg>
          </a>
        </li>
      </ul>
    </nav>

  </div>

</x-dashboard-layout>
