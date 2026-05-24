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

@if(session('error'))
<div id="alert-error" class="flex items-center p-4 mb-4 text-red-800 rounded-lg bg-red-50 dark:bg-gray-800 dark:text-red-400">
  <svg class="shrink-0 w-4 h-4" fill="currentColor" viewBox="0 0 20 20"><path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z"/></svg>
  <span class="ms-2 text-sm font-medium">{{ session('error') }}</span>
  <button type="button" onclick="document.getElementById('alert-error').remove()" class="ms-auto -mx-1.5 -my-1.5 bg-red-50 text-red-500 rounded-lg p-1.5 hover:bg-red-200 dark:bg-gray-800 dark:text-red-400 dark:hover:bg-gray-700">
    <svg class="w-3 h-3" fill="none" viewBox="0 0 14 14"><path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/></svg>
  </button>
</div>
@endif

<div class="grid grid-cols-1 sm:grid-cols-3 gap-4 mb-6">
  <div class="bg-white dark:bg-gray-800 rounded-lg shadow-sm border border-gray-200 dark:border-gray-700 p-4 flex items-center gap-4">
    <div class="w-10 h-10 rounded-lg bg-blue-100 dark:bg-blue-900 flex items-center justify-center shrink-0">
      <svg class="w-5 h-5 text-blue-600 dark:text-blue-400" fill="currentColor" viewBox="0 0 20 20"><path d="M2.003 5.884L10 9.882l7.997-3.998A2 2 0 0016 4H4a2 2 0 00-1.997 1.884z"/><path d="M18 8.118l-8 4-8-4V14a2 2 0 002 2h12a2 2 0 002-2V8.118z"/></svg>
    </div>
    <div>
      <p class="text-2xl font-bold text-gray-900 dark:text-white">{{ $stats['total'] }}</p>
      <p class="text-sm text-gray-500 dark:text-gray-400">Totaal campagnes</p>
    </div>
  </div>
  <div class="bg-white dark:bg-gray-800 rounded-lg shadow-sm border border-gray-200 dark:border-gray-700 p-4 flex items-center gap-4">
    <div class="w-10 h-10 rounded-lg bg-yellow-100 dark:bg-yellow-900 flex items-center justify-center shrink-0">
      <svg class="w-5 h-5 text-yellow-600 dark:text-yellow-400" fill="currentColor" viewBox="0 0 20 20"><path d="M17.414 2.586a2 2 0 00-2.828 0L7 10.172V13h2.828l7.586-7.586a2 2 0 000-2.828z"/><path fill-rule="evenodd" d="M2 6a2 2 0 012-2h4a1 1 0 010 2H4v10h10v-4a1 1 0 112 0v4a2 2 0 01-2 2H4a2 2 0 01-2-2V6z" clip-rule="evenodd"/></svg>
    </div>
    <div>
      <p class="text-2xl font-bold text-gray-900 dark:text-white">{{ $stats['drafts'] }}</p>
      <p class="text-sm text-gray-500 dark:text-gray-400">Concepten</p>
    </div>
  </div>
  <div class="bg-white dark:bg-gray-800 rounded-lg shadow-sm border border-gray-200 dark:border-gray-700 p-4 flex items-center gap-4">
    <div class="w-10 h-10 rounded-lg bg-green-100 dark:bg-green-900 flex items-center justify-center shrink-0">
      <svg class="w-5 h-5 text-green-600 dark:text-green-400" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/></svg>
    </div>
    <div>
      <p class="text-2xl font-bold text-gray-900 dark:text-white">{{ $stats['sent'] }}</p>
      <p class="text-sm text-gray-500 dark:text-gray-400">Verzonden</p>
    </div>
  </div>
</div>

<div class="bg-white dark:bg-gray-800 relative shadow-md sm:rounded-lg overflow-hidden">

  <div class="flex items-center justify-between p-4">
    <p class="text-sm text-gray-500 dark:text-gray-400">
      <span class="font-semibold text-gray-900 dark:text-white">{{ $newsletters->total() }}</span> campagnes totaal
    </p>
    <a href="{{ route('newsletter.campaigns.create') }}"
      class="flex items-center justify-center text-white bg-primary-700 hover:bg-primary-800 focus:ring-4 focus:ring-primary-300 font-medium rounded-lg text-sm px-4 py-2 dark:bg-primary-600 dark:hover:bg-primary-700 focus:outline-none dark:focus:ring-primary-800">
      <svg class="h-3.5 w-3.5 mr-2" fill="currentColor" viewBox="0 0 20 20" aria-hidden="true">
        <path clip-rule="evenodd" fill-rule="evenodd" d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z"/>
      </svg>
      Nieuwe nieuwsbrief
    </a>
  </div>

  <div class="overflow-x-auto">
    <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
      <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
        <tr>
          <th scope="col" class="px-4 py-2">Onderwerp</th>
          <th scope="col" class="px-4 py-2">Status</th>
          <th scope="col" class="px-4 py-2">Verzonden</th>
          <th scope="col" class="px-4 py-2">Gemaakt door</th>
          <th scope="col" class="px-4 py-2">Datum</th>
          <th scope="col" class="px-4 py-2"><span class="sr-only">Acties</span></th>
        </tr>
      </thead>
      <tbody>
        @forelse($newsletters as $newsletter)
        <tr class="border-b border-gray-200 dark:border-gray-700">
          <th scope="row" class="px-4 py-2 font-medium text-gray-900 dark:text-white max-w-xs">
            <a href="{{ route('newsletter.campaigns.show', $newsletter) }}"
              class="hover:text-primary-700 dark:hover:text-primary-400 hover:underline">
              {{ $newsletter->subject }}
            </a>
          </th>
          <td class="px-4 py-2 whitespace-nowrap">
            @if($newsletter->status === 'draft')
              <span class="bg-yellow-100 text-yellow-800 text-xs font-medium px-2.5 py-0.5 rounded dark:bg-yellow-900 dark:text-yellow-300">Concept</span>
            @elseif($newsletter->status === 'sending')
              <span class="bg-blue-100 text-blue-800 text-xs font-medium px-2.5 py-0.5 rounded dark:bg-blue-900 dark:text-blue-300">Verzenden...</span>
            @elseif($newsletter->status === 'sent')
              <span class="bg-green-100 text-green-800 text-xs font-medium px-2.5 py-0.5 rounded dark:bg-green-900 dark:text-green-300">Verzonden</span>
            @else
              <span class="bg-red-100 text-red-800 text-xs font-medium px-2.5 py-0.5 rounded dark:bg-red-900 dark:text-red-300">Mislukt</span>
            @endif
          </td>
          <td class="px-4 py-2 whitespace-nowrap">
            @if($newsletter->sent_count > 0 || $newsletter->failed_count > 0)
              <span class="text-green-700 dark:text-green-400 font-medium">{{ $newsletter->sent_count }}</span>
              <span class="text-gray-400">/{{ $newsletter->recipients_count }}</span>
              @if($newsletter->failed_count > 0)
                <span class="ml-1 text-red-600 dark:text-red-400 text-xs">({{ $newsletter->failed_count }} mislukt)</span>
              @endif
            @else
              <span class="text-gray-400 dark:text-gray-500">-</span>
            @endif
          </td>
          <td class="px-4 py-2 whitespace-nowrap">
            {{ $newsletter->creator ? $newsletter->creator->first_name . ' ' . $newsletter->creator->last_name : 'Onbekend' }}
          </td>
          <td class="px-4 py-2 whitespace-nowrap">
            {{ $newsletter->created_at->format('d-m-Y H:i') }}
          </td>
          <td class="px-4 py-2 whitespace-nowrap">
            <div class="flex items-center gap-3">
              <a href="{{ route('newsletter.campaigns.show', $newsletter) }}"
                class="text-xs font-medium text-primary-700 hover:underline dark:text-primary-400">Bekijken</a>

              @if($newsletter->isDraft())
                <a href="{{ route('newsletter.campaigns.edit', $newsletter) }}"
                  class="text-xs font-medium text-primary-700 hover:underline dark:text-primary-400">Bewerken</a>
              @endif

              <form action="{{ route('newsletter.campaigns.duplicate', $newsletter) }}" method="POST" class="inline">
                @csrf
                <button type="submit" class="text-xs font-medium text-gray-600 hover:underline dark:text-gray-400">Dupliceren</button>
              </form>

              @if($newsletter->isDraft() || in_array($newsletter->status, ['sent', 'failed']))
                <form action="{{ route('newsletter.campaigns.destroy', $newsletter) }}" method="POST" class="inline"
                  onsubmit="return confirm('Weet je zeker dat je deze nieuwsbrief wilt verwijderen?')">
                  @csrf
                  @method('DELETE')
                  <button type="submit" class="text-xs font-medium text-red-600 hover:underline dark:text-red-500">Verwijderen</button>
                </form>
              @endif
            </div>
          </td>
        </tr>
        @empty
        <tr>
          <td colspan="6" class="px-4 py-8 text-center text-gray-500 dark:text-gray-400">Nog geen nieuwsbrief campagnes.</td>
        </tr>
        @endforelse
      </tbody>
    </table>
  </div>

  @if($newsletters->total() > 0)
  <nav class="flex flex-col md:flex-row justify-between items-start md:items-center space-y-3 md:space-y-0 p-4" aria-label="Table navigation">
    <span class="text-sm font-normal text-gray-500 dark:text-gray-400">
      Toont <span class="font-semibold text-gray-900 dark:text-white">{{ $newsletters->firstItem() }}-{{ $newsletters->lastItem() }}</span>
      van <span class="font-semibold text-gray-900 dark:text-white">{{ $newsletters->total() }}</span>
    </span>
    <ul class="inline-flex items-stretch -space-x-px">
      <li>
        @if($newsletters->onFirstPage())
          <span class="flex items-center justify-center h-full py-1.5 px-3 ml-0 text-gray-400 bg-white rounded-l-lg border border-gray-300 cursor-not-allowed dark:bg-gray-800 dark:border-gray-700 dark:text-gray-600">
            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z" clip-rule="evenodd"/></svg>
          </span>
        @else
          <a href="{{ $newsletters->previousPageUrl() }}" class="flex items-center justify-center h-full py-1.5 px-3 ml-0 text-gray-500 bg-white rounded-l-lg border border-gray-300 hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white">
            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z" clip-rule="evenodd"/></svg>
          </a>
        @endif
      </li>
      @foreach($newsletters->getUrlRange(1, $newsletters->lastPage()) as $page => $url)
        <li>
          @if($page == $newsletters->currentPage())
            <span class="flex items-center justify-center text-sm z-10 py-2 px-3 leading-tight text-primary-600 bg-primary-50 border border-primary-300 hover:bg-primary-100 hover:text-primary-700 dark:border-gray-700 dark:bg-gray-700 dark:text-white">{{ $page }}</span>
          @else
            <a href="{{ $url }}" class="flex items-center justify-center text-sm py-2 px-3 leading-tight text-gray-500 bg-white border border-gray-300 hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white">{{ $page }}</a>
          @endif
        </li>
      @endforeach
      <li>
        @if($newsletters->hasMorePages())
          <a href="{{ $newsletters->nextPageUrl() }}" class="flex items-center justify-center h-full py-1.5 px-3 leading-tight text-gray-500 bg-white rounded-r-lg border border-gray-300 hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white">
            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"/></svg>
          </a>
        @else
          <span class="flex items-center justify-center h-full py-1.5 px-3 leading-tight text-gray-400 bg-white rounded-r-lg border border-gray-300 cursor-not-allowed dark:bg-gray-800 dark:border-gray-700 dark:text-gray-600">
            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"/></svg>
          </span>
        @endif
      </li>
    </ul>
  </nav>
  @endif

</div>

</x-dashboard-layout>
