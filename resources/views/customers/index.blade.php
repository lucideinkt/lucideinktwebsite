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

{{-- Search bar --}}
<div class="mb-4">
  <form id="search-form" method="GET" action="{{ route('customerIndex') }}" class="flex items-center gap-2">
    <input type="hidden" name="tab" value="{{ $tab }}">
    <div class="relative w-full max-w-sm">
      <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
        <svg aria-hidden="true" class="w-4 h-4 text-gray-500 dark:text-gray-400" fill="currentColor" viewBox="0 0 20 20">
          <path fill-rule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z" clip-rule="evenodd"/>
        </svg>
      </div>
      <input type="text" name="search" id="search-input" value="{{ request('search') }}"
        class="bg-white border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full pl-9 p-2 dark:bg-gray-800 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white"
        placeholder="Zoek op naam of e-mail...">
    </div>
    <button type="submit" class="text-white bg-primary-700 hover:bg-primary-800 focus:ring-4 focus:ring-primary-300 font-medium rounded-lg text-sm px-4 py-2 dark:bg-primary-600 dark:hover:bg-primary-700">
      Zoeken
    </button>
    @if(request('search'))
      <a href="{{ route('customerIndex', ['tab' => $tab]) }}" class="text-sm text-gray-500 hover:text-gray-700 dark:text-gray-400 dark:hover:text-white">
        Wissen
      </a>
    @endif
  </form>
</div>

{{-- Tabs --}}
<div class="mb-4 border-b border-gray-200 dark:border-gray-700">
  <ul class="flex flex-wrap -mb-px text-sm font-medium text-center" role="tablist">
    <li class="me-2" role="presentation">
      <a href="{{ route('customerIndex', array_merge(request()->except('tab'), ['tab' => 'customers'])) }}"
        class="inline-block p-4 border-b-2 rounded-t-lg {{ $tab === 'customers' ? 'border-primary-600 text-primary-600 dark:border-primary-500 dark:text-primary-500' : 'border-transparent hover:text-gray-600 hover:border-gray-300 dark:hover:text-gray-300 text-gray-500 dark:text-gray-400' }}"
        role="tab">
        <span class="flex items-center gap-2">
          <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20"><path d="M2.003 5.884 10 9.882l7.997-3.998A2 2 0 0 0 16 4H4a2 2 0 0 0-1.997 1.884Z"/><path d="m18 8.118-8 4-8-4V14a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8.118Z"/></svg>
          Klanten (checkout)
          <span class="inline-flex items-center justify-center w-5 h-5 ms-1 text-xs font-semibold rounded-full {{ $tab === 'customers' ? 'bg-primary-100 text-primary-800 dark:bg-primary-900 dark:text-primary-300' : 'bg-gray-100 text-gray-800 dark:bg-gray-700 dark:text-gray-300' }}">
            {{ $customers->total() }}
          </span>
        </span>
      </a>
    </li>
    <li class="me-2" role="presentation">
      <a href="{{ route('customerIndex', array_merge(request()->except('tab'), ['tab' => 'users'])) }}"
        class="inline-block p-4 border-b-2 rounded-t-lg {{ $tab === 'users' ? 'border-primary-600 text-primary-600 dark:border-primary-500 dark:text-primary-500' : 'border-transparent hover:text-gray-600 hover:border-gray-300 dark:hover:text-gray-300 text-gray-500 dark:text-gray-400' }}"
        role="tab">
        <span class="flex items-center gap-2">
          <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20"><path d="M10 9a3 3 0 1 0 0-6 3 3 0 0 0 0 6Zm-7 9a7 7 0 1 1 14 0H3Z"/></svg>
          Geregistreerde gebruikers
          <span class="inline-flex items-center justify-center w-5 h-5 ms-1 text-xs font-semibold rounded-full {{ $tab === 'users' ? 'bg-primary-100 text-primary-800 dark:bg-primary-900 dark:text-primary-300' : 'bg-gray-100 text-gray-800 dark:bg-gray-700 dark:text-gray-300' }}">
            {{ $users->total() }}
          </span>
        </span>
      </a>
    </li>
  </ul>
</div>

{{-- Customers tab --}}
@if($tab === 'customers')
<div class="bg-white dark:bg-gray-800 relative shadow-md sm:rounded-lg overflow-hidden">
  <div class="overflow-x-auto">
    <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
      <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
        <tr>
          <th scope="col" class="px-4 py-2">Naam</th>
          <th scope="col" class="px-4 py-2">E-mail</th>
          <th scope="col" class="px-4 py-2">Telefoon</th>
          <th scope="col" class="px-4 py-2">Bestellingen</th>
          <th scope="col" class="px-4 py-2">Uitgegeven</th>
          <th scope="col" class="px-4 py-2">Geregistreerd</th>
          <th scope="col" class="px-4 py-2"><span class="sr-only">Acties</span></th>
        </tr>
      </thead>
      <tbody>
        @forelse ($customers as $customer)
        <tr class="border-b border-gray-200 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-700 cursor-pointer" onclick="window.location='{{ route('customerShow', $customer->id) }}'">
          <th scope="row" class="px-4 py-2 font-medium text-gray-900 whitespace-nowrap dark:text-white">
            <div class="flex items-center gap-2">
              <div class="w-7 h-7 rounded-full bg-indigo-100 dark:bg-indigo-900 flex items-center justify-center flex-shrink-0">
                <span class="text-xs font-bold text-indigo-700 dark:text-indigo-300">{{ strtoupper(substr($customer->billing_first_name, 0, 1)) }}</span>
              </div>
              {{ $customer->billing_first_name }} {{ $customer->billing_last_name }}
            </div>
          </th>
          <td class="px-4 py-2">{{ $customer->billing_email }}</td>
          <td class="px-4 py-2">{{ $customer->billing_phone ?? '–' }}</td>
          <td class="px-4 py-2">
            <span class="bg-blue-100 text-blue-800 text-xs font-medium px-2 py-0.5 rounded dark:bg-blue-900 dark:text-blue-300">
              {{ $customer->orders_count }}
            </span>
          </td>
          <td class="px-4 py-2 font-medium text-gray-900 dark:text-white">
            € {{ number_format($customer->orders->sum('total'), 2, ',', '.') }}
          </td>
          <td class="px-4 py-2 text-xs">{{ $customer->created_at->format('d-m-Y') }}</td>
          <td class="px-4 py-2 whitespace-nowrap">
            <a href="{{ route('customerShow', $customer->id) }}"
              class="text-xs font-medium text-primary-700 hover:underline dark:text-primary-400" onclick="event.stopPropagation()">
              Bekijken
            </a>
          </td>
        </tr>
        @empty
        <tr>
          <td colspan="7" class="px-4 py-8 text-center text-gray-500 dark:text-gray-400">Geen klanten gevonden.</td>
        </tr>
        @endforelse
      </tbody>
    </table>
  </div>

  <nav class="flex flex-col md:flex-row justify-between items-start md:items-center space-y-3 md:space-y-0 p-4">
    <span class="text-sm font-normal text-gray-500 dark:text-gray-400">
      @if($customers->total() > 0)
        Toont <span class="font-semibold text-gray-900 dark:text-white">{{ $customers->firstItem() }}-{{ $customers->lastItem() }}</span>
        van <span class="font-semibold text-gray-900 dark:text-white">{{ $customers->total() }}</span>
      @else
        <span class="font-semibold text-gray-900 dark:text-white">0</span> resultaten
      @endif
    </span>
    @if($customers->hasPages())
    <ul class="inline-flex items-stretch -space-x-px">
      <li>
        @if($customers->onFirstPage())
          <span class="flex items-center justify-center h-full py-1.5 px-3 text-gray-400 bg-white rounded-l-lg border border-gray-300 cursor-not-allowed dark:bg-gray-800 dark:border-gray-700 dark:text-gray-600">
            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z" clip-rule="evenodd"/></svg>
          </span>
        @else
          <a href="{{ $customers->previousPageUrl() }}" class="flex items-center justify-center h-full py-1.5 px-3 text-gray-500 bg-white rounded-l-lg border border-gray-300 hover:bg-gray-100 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white">
            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z" clip-rule="evenodd"/></svg>
          </a>
        @endif
      </li>
      @foreach($customers->getUrlRange(1, $customers->lastPage()) as $page => $url)
        <li>
          @if($page == $customers->currentPage())
            <span class="flex items-center justify-center text-sm z-10 py-2 px-3 text-primary-600 bg-primary-50 border border-primary-300 dark:border-gray-700 dark:bg-gray-700 dark:text-white">{{ $page }}</span>
          @else
            <a href="{{ $url }}" class="flex items-center justify-center text-sm py-2 px-3 text-gray-500 bg-white border border-gray-300 hover:bg-gray-100 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white">{{ $page }}</a>
          @endif
        </li>
      @endforeach
      <li>
        @if($customers->hasMorePages())
          <a href="{{ $customers->nextPageUrl() }}" class="flex items-center justify-center h-full py-1.5 px-3 text-gray-500 bg-white rounded-r-lg border border-gray-300 hover:bg-gray-100 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white">
            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"/></svg>
          </a>
        @else
          <span class="flex items-center justify-center h-full py-1.5 px-3 text-gray-400 bg-white rounded-r-lg border border-gray-300 cursor-not-allowed dark:bg-gray-800 dark:border-gray-700 dark:text-gray-600">
            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"/></svg>
          </span>
        @endif
      </li>
    </ul>
    @endif
  </nav>
</div>
@endif

{{-- Users tab --}}
@if($tab === 'users')
<div class="bg-white dark:bg-gray-800 relative shadow-md sm:rounded-lg overflow-hidden">
  <div class="overflow-x-auto">
    <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
      <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
        <tr>
          <th scope="col" class="px-4 py-2">Naam</th>
          <th scope="col" class="px-4 py-2">E-mail</th>
          <th scope="col" class="px-4 py-2">Geregistreerd</th>
        </tr>
      </thead>
      <tbody>
        @forelse ($users as $user)
        <tr class="border-b border-gray-200 dark:border-gray-700">
          <th scope="row" class="px-4 py-2 font-medium text-gray-900 whitespace-nowrap dark:text-white">
            <div class="flex items-center gap-2">
              <div class="w-7 h-7 rounded-full bg-blue-100 dark:bg-blue-900 flex items-center justify-center flex-shrink-0">
                <span class="text-xs font-bold text-blue-700 dark:text-blue-300">{{ strtoupper(substr($user->first_name, 0, 1)) }}</span>
              </div>
              {{ $user->first_name }} {{ $user->last_name }}
            </div>
          </th>
          <td class="px-4 py-2">{{ $user->email }}</td>
          <td class="px-4 py-2 text-xs">{{ $user->created_at->format('d-m-Y') }}</td>
        </tr>
        @empty
        <tr>
          <td colspan="3" class="px-4 py-8 text-center text-gray-500 dark:text-gray-400">Geen gebruikers gevonden.</td>
        </tr>
        @endforelse
      </tbody>
    </table>
  </div>

  <nav class="flex flex-col md:flex-row justify-between items-start md:items-center space-y-3 md:space-y-0 p-4">
    <span class="text-sm font-normal text-gray-500 dark:text-gray-400">
      @if($users->total() > 0)
        Toont <span class="font-semibold text-gray-900 dark:text-white">{{ $users->firstItem() }}-{{ $users->lastItem() }}</span>
        van <span class="font-semibold text-gray-900 dark:text-white">{{ $users->total() }}</span>
      @else
        <span class="font-semibold text-gray-900 dark:text-white">0</span> resultaten
      @endif
    </span>
    @if($users->hasPages())
    <ul class="inline-flex items-stretch -space-x-px">
      <li>
        @if($users->onFirstPage())
          <span class="flex items-center justify-center h-full py-1.5 px-3 text-gray-400 bg-white rounded-l-lg border border-gray-300 cursor-not-allowed dark:bg-gray-800 dark:border-gray-700 dark:text-gray-600">
            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z" clip-rule="evenodd"/></svg>
          </span>
        @else
          <a href="{{ $users->previousPageUrl() }}" class="flex items-center justify-center h-full py-1.5 px-3 text-gray-500 bg-white rounded-l-lg border border-gray-300 hover:bg-gray-100 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white">
            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z" clip-rule="evenodd"/></svg>
          </a>
        @endif
      </li>
      @foreach($users->getUrlRange(1, $users->lastPage()) as $page => $url)
        <li>
          @if($page == $users->currentPage())
            <span class="flex items-center justify-center text-sm z-10 py-2 px-3 text-primary-600 bg-primary-50 border border-primary-300 dark:border-gray-700 dark:bg-gray-700 dark:text-white">{{ $page }}</span>
          @else
            <a href="{{ $url }}" class="flex items-center justify-center text-sm py-2 px-3 text-gray-500 bg-white border border-gray-300 hover:bg-gray-100 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white">{{ $page }}</a>
          @endif
        </li>
      @endforeach
      <li>
        @if($users->hasMorePages())
          <a href="{{ $users->nextPageUrl() }}" class="flex items-center justify-center h-full py-1.5 px-3 text-gray-500 bg-white rounded-r-lg border border-gray-300 hover:bg-gray-100 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white">
            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"/></svg>
          </a>
        @else
          <span class="flex items-center justify-center h-full py-1.5 px-3 text-gray-400 bg-white rounded-r-lg border border-gray-300 cursor-not-allowed dark:bg-gray-800 dark:border-gray-700 dark:text-gray-600">
            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"/></svg>
          </span>
        @endif
      </li>
    </ul>
    @endif
  </nav>
</div>
@endif

</x-dashboard-layout>
