<x-dashboard-layout>

@if(session('success'))
<div id="alert-success" class="flex items-center p-4 mb-4 text-green-800 rounded-lg bg-green-50 dark:bg-gray-800 dark:text-green-400">
  <svg class="shrink-0 w-4 h-4" fill="currentColor" viewBox="0 0 20 20"><path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z"/></svg>
  <span class="ms-2 text-sm font-medium">{{ session('success') }}</span>
  <button type="button" onclick="document.getElementById('alert-success').remove()" class="ms-auto -mx-1.5 -my-1.5 bg-green-50 text-green-500 rounded-lg p-1.5 hover:bg-green-200 dark:bg-gray-800 dark:text-green-400 dark:hover:bg-gray-700">
    <svg class="w-3 h-3" fill="none" viewBox="0 0 14 14"><path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/></svg>
  </button>
</div>
@endif

<section class="bg-gray-50 dark:bg-gray-900">
  <div>
    <div class="bg-white dark:bg-gray-800 relative shadow-md sm:rounded-lg overflow-hidden">

      <div class="flex flex-col md:flex-row items-center justify-between space-y-3 md:space-y-0 md:space-x-4 p-4">
        <div class="w-full md:w-1/2">
          <form id="search-form" method="GET" action="{{ route('productCategoryIndex') }}" class="flex items-center">
            <label for="simple-search" class="sr-only">Zoeken</label>
            <div class="relative w-full">
              <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                <svg aria-hidden="true" class="w-5 h-5 text-gray-500 dark:text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                  <path fill-rule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z" clip-rule="evenodd"/>
                </svg>
              </div>
              <input type="text" name="search" id="simple-search" value="{{ request('search') }}"
                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full pl-10 p-2 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                placeholder="Zoek op naam..." >
            </div>
          </form>
        </div>
        <div class="w-full md:w-auto flex flex-col md:flex-row space-y-2 md:space-y-0 items-stretch md:items-center justify-end md:space-x-3 flex-shrink-0">
          <a href="{{ route('productCategoryCreatePage') }}"
            class="flex items-center justify-center text-white bg-primary-700 hover:bg-primary-800 focus:ring-4 focus:ring-primary-300 font-medium rounded-lg text-sm px-4 py-2 dark:bg-primary-600 dark:hover:bg-primary-700 focus:outline-none dark:focus:ring-primary-800">
            <svg class="h-3.5 w-3.5 mr-2" fill="currentColor" viewBox="0 0 20 20" aria-hidden="true">
              <path clip-rule="evenodd" fill-rule="evenodd" d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z"/>
            </svg>
            Nieuwe categorie
          </a>
        </div>
      </div>

      <div class="overflow-x-auto">
        <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
          <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
            <tr>
              <th scope="col" class="px-4 py-2">Naam</th>
              <th scope="col" class="px-4 py-2">Slug</th>
              <th scope="col" class="px-4 py-2">Status</th>
              <th scope="col" class="px-4 py-2">Aangemaakt</th>
              <th scope="col" class="px-4 py-2"><span class="sr-only">Acties</span></th>
            </tr>
          </thead>
          <tbody>
            @forelse ($productCategories as $productCategory)
            <tr class="border-b border-gray-200 dark:border-gray-700">
              <th scope="row" class="px-4 py-2 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                {{ $productCategory->name }}
              </th>
              <td class="px-4 py-2 font-mono text-xs text-gray-500 dark:text-gray-400">{{ $productCategory->slug }}</td>
              <td class="px-4 py-2">
                @if($productCategory->is_published)
                  <span class="bg-green-100 text-green-800 text-xs font-medium px-2.5 py-0.5 rounded dark:bg-green-900 dark:text-green-300">Gepubliceerd</span>
                @else
                  <span class="bg-gray-100 text-gray-600 text-xs font-medium px-2.5 py-0.5 rounded dark:bg-gray-700 dark:text-gray-400">Concept</span>
                @endif
              </td>
              <td class="px-4 py-2">{{ $productCategory->created_at->format('d-m-Y') }}</td>
              <td class="px-4 py-2 whitespace-nowrap">
                <div class="flex items-center gap-2">
                  <a href="{{ route('productCategoryEditPage', $productCategory->id) }}"
                    class="text-xs font-medium text-primary-700 hover:underline dark:text-primary-400">Bewerken</a>
                  <form action="{{ route('productCategoryDelete', $productCategory->id) }}" method="POST"
                    onsubmit="return confirm('Weet je zeker dat je {{ addslashes($productCategory->name) }} wilt verwijderen?')">
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
              <td colspan="5" class="px-4 py-8 text-center text-gray-500 dark:text-gray-400">Geen categorieën gevonden.</td>
            </tr>
            @endforelse
          </tbody>
        </table>
      </div>

      <nav class="flex flex-col md:flex-row justify-between items-start md:items-center space-y-3 md:space-y-0 p-4" aria-label="Table navigation">
        <span class="text-sm font-normal text-gray-500 dark:text-gray-400">
          @if($productCategories->total() > 0)
            Toont <span class="font-semibold text-gray-900 dark:text-white">{{ $productCategories->firstItem() }}-{{ $productCategories->lastItem() }}</span>
            van <span class="font-semibold text-gray-900 dark:text-white">{{ $productCategories->total() }}</span>
          @else
            <span class="font-semibold text-gray-900 dark:text-white">0</span> resultaten
          @endif
        </span>
        @if($productCategories->hasPages())
        <ul class="inline-flex items-stretch -space-x-px">
          <li>
            @if($productCategories->onFirstPage())
              <span class="flex items-center justify-center h-full py-1.5 px-3 ml-0 text-gray-400 bg-white rounded-l-lg border border-gray-300 cursor-not-allowed dark:bg-gray-800 dark:border-gray-700 dark:text-gray-600">
                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z" clip-rule="evenodd"/></svg>
              </span>
            @else
              <a href="{{ $productCategories->previousPageUrl() }}" class="flex items-center justify-center h-full py-1.5 px-3 ml-0 text-gray-500 bg-white rounded-l-lg border border-gray-300 hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white">
                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z" clip-rule="evenodd"/></svg>
              </a>
            @endif
          </li>
          @foreach($productCategories->getUrlRange(1, $productCategories->lastPage()) as $page => $url)
            <li>
              @if($page == $productCategories->currentPage())
                <span class="flex items-center justify-center text-sm z-10 py-2 px-3 leading-tight text-primary-600 bg-primary-50 border border-primary-300 hover:bg-primary-100 hover:text-primary-700 dark:border-gray-700 dark:bg-gray-700 dark:text-white">{{ $page }}</span>
              @else
                <a href="{{ $url }}" class="flex items-center justify-center text-sm py-2 px-3 leading-tight text-gray-500 bg-white border border-gray-300 hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white">{{ $page }}</a>
              @endif
            </li>
          @endforeach
          <li>
            @if($productCategories->hasMorePages())
              <a href="{{ $productCategories->nextPageUrl() }}" class="flex items-center justify-center h-full py-1.5 px-3 leading-tight text-gray-500 bg-white rounded-r-lg border border-gray-300 hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white">
                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"/></svg>
              </a>
            @else
              <span class="flex items-center justify-center h-full py-1.5 px-3 leading-tight text-gray-400 bg-white rounded-r-lg border border-gray-300 cursor-not-allowed dark:bg-gray-800 dark:border-gray-700 dark:text-gray-600">
                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"/></svg>
              </span>
            @endif
          </li>
        </ul>
        @endif
      </nav>

    </div>
  </div>
</section>

<script>
document.getElementById('simple-search').addEventListener('keydown', function(e) {
    if (e.key === 'Enter') { e.preventDefault(); document.getElementById('search-form').submit(); }
});
</script>

</x-dashboard-layout>
