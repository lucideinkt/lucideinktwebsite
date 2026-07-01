<x-dashboard-layout>

@section('title', 'Homepage Quotes')

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
        <div class="w-full md:w-auto">
          <h2 class="text-lg font-semibold text-gray-900 dark:text-white">Homepage Quotes</h2>
          <p class="text-sm text-gray-500 dark:text-gray-400">Beheer de quotes die worden getoond op de homepage.</p>
        </div>
        <div class="w-full md:w-auto flex flex-col md:flex-row space-y-2 md:space-y-0 items-stretch md:items-center justify-end md:space-x-3 flex-shrink-0">
          <a href="{{ route('admin.homepage-quotes.create') }}"
            class="flex items-center justify-center text-white bg-primary-700 hover:bg-primary-800 focus:ring-4 focus:ring-primary-300 font-medium rounded-lg text-sm px-4 py-2 dark:bg-primary-600 dark:hover:bg-primary-700 focus:outline-none dark:focus:ring-primary-800">
            <svg class="h-3.5 w-3.5 mr-2" fill="currentColor" viewBox="0 0 20 20" aria-hidden="true">
              <path clip-rule="evenodd" fill-rule="evenodd" d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z"/>
            </svg>
            Nieuwe quote
          </a>
        </div>
      </div>

      <div class="overflow-x-auto">
        <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
          <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
            <tr>
              <th scope="col" class="px-4 py-2">#</th>
              <th scope="col" class="px-4 py-2">Quote</th>
              <th scope="col" class="px-4 py-2">Bron</th>
              <th scope="col" class="px-4 py-2">Volgorde</th>
              <th scope="col" class="px-4 py-2">Status</th>
              <th scope="col" class="px-4 py-2"><span class="sr-only">Acties</span></th>
            </tr>
          </thead>
          <tbody>
            @forelse ($quotes as $quote)
            <tr class="border-b border-gray-200 dark:border-gray-700">
              <td class="px-4 py-2 text-gray-400">{{ $quote->id }}</td>
              <td class="px-4 py-2 text-gray-900 dark:text-white max-w-md">
                <p class="line-clamp-2">{{ $quote->text }}</p>
              </td>
              <td class="px-4 py-2 whitespace-nowrap text-gray-500 dark:text-gray-400">{{ $quote->source }}</td>
              <td class="px-4 py-2">{{ $quote->sort_order }}</td>
              <td class="px-4 py-2">
                @if($quote->is_active)
                  <span class="bg-green-100 text-green-800 text-xs font-medium px-2.5 py-0.5 rounded dark:bg-green-900 dark:text-green-300">Actief</span>
                @else
                  <span class="bg-gray-100 text-gray-600 text-xs font-medium px-2.5 py-0.5 rounded dark:bg-gray-700 dark:text-gray-400">Inactief</span>
                @endif
              </td>
              <td class="px-4 py-2 whitespace-nowrap">
                <div class="flex items-center gap-2">
                  <a href="{{ route('admin.homepage-quotes.edit', $quote->id) }}"
                    class="text-xs font-medium text-primary-700 hover:underline dark:text-primary-400">Bewerken</a>
                  <form action="{{ route('admin.homepage-quotes.destroy', $quote->id) }}" method="POST"
                    onsubmit="return confirm('Weet je zeker dat je deze quote wilt verwijderen?')">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="text-xs font-medium text-red-600 hover:underline dark:text-red-500">Verwijderen</button>
                  </form>
                </div>
              </td>
            </tr>
            @empty
            <tr>
              <td colspan="6" class="px-4 py-8 text-center text-gray-500 dark:text-gray-400">Geen quotes gevonden. <a href="{{ route('admin.homepage-quotes.create') }}" class="text-primary-600 hover:underline">Voeg er een toe.</a></td>
            </tr>
            @endforelse
          </tbody>
        </table>
      </div>

      @if($quotes->hasPages())
      <nav class="flex flex-col md:flex-row justify-between items-start md:items-center space-y-3 md:space-y-0 p-4">
        <span class="text-sm font-normal text-gray-500 dark:text-gray-400">
          Toont <span class="font-semibold text-gray-900 dark:text-white">{{ $quotes->firstItem() }}-{{ $quotes->lastItem() }}</span>
          van <span class="font-semibold text-gray-900 dark:text-white">{{ $quotes->total() }}</span>
        </span>
        {{ $quotes->links() }}
      </nav>
      @endif

    </div>
  </div>
</section>

</x-dashboard-layout>

