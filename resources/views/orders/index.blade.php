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
          <form class="flex items-center">
            <label for="simple-search" class="sr-only">Zoeken</label>
            <div class="relative w-full">
              <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                <svg aria-hidden="true" class="w-5 h-5 text-gray-500 dark:text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                  <path fill-rule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z" clip-rule="evenodd"/>
                </svg>
              </div>
              <input type="text" id="simple-search" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full pl-10 p-2 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="Zoek op naam of bestelnummer">
            </div>
          </form>
        </div>
        <div class="w-full md:w-auto flex flex-col md:flex-row space-y-2 md:space-y-0 items-stretch md:items-center justify-end md:space-x-3 flex-shrink-0">
          <a href="{{ route('orderCreatePage') }}" class="flex items-center justify-center text-white bg-primary-700 hover:bg-primary-800 focus:ring-4 focus:ring-primary-300 font-medium rounded-lg text-sm px-4 py-2 dark:bg-primary-600 dark:hover:bg-primary-700 focus:outline-none dark:focus:ring-primary-800">
            <svg class="h-3.5 w-3.5 mr-2" fill="currentColor" viewBox="0 0 20 20" aria-hidden="true">
              <path clip-rule="evenodd" fill-rule="evenodd" d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z"/>
            </svg>
            Toevoegen
          </a>
          <a href="{{ route('exportOrders') }}" class="flex items-center justify-center py-2 px-4 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-primary-700 focus:z-10 focus:ring-4 focus:ring-gray-200 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700">
            <svg class="h-4 w-4 mr-2 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"/>
            </svg>
            Exporteer
          </a>
          <div class="flex items-center space-x-3 w-full md:w-auto">
            <button id="filterDropdownButton" data-dropdown-toggle="filterDropdown"
              class="w-full md:w-auto flex items-center justify-center py-2 px-4 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-primary-700 focus:z-10 focus:ring-4 focus:ring-gray-200 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700" type="button">
              <svg xmlns="http://www.w3.org/2000/svg" aria-hidden="true" class="h-4 w-4 mr-2 text-gray-400" viewBox="0 0 20 20" fill="currentColor">
                <path fill-rule="evenodd" d="M3 3a1 1 0 011-1h12a1 1 0 011 1v3a1 1 0 01-.293.707L12 11.414V15a1 1 0 01-.293.707l-2 2A1 1 0 018 17v-5.586L3.293 6.707A1 1 0 013 6V3z" clip-rule="evenodd"/>
              </svg>
              Filter
              <svg class="-mr-1 ml-1.5 w-5 h-5" fill="currentColor" viewBox="0 0 20 20" aria-hidden="true">
                <path clip-rule="evenodd" fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"/>
              </svg>
            </button>
            <div id="filterDropdown" class="z-10 hidden w-48 p-3 bg-white rounded-lg shadow dark:bg-gray-700">
              <h6 class="mb-3 text-sm font-medium text-gray-900 dark:text-white">Status</h6>
              <ul class="space-y-2 text-sm">
                <li class="flex items-center">
                  <input id="filter-all" type="radio" name="status-filter" value="all" checked class="w-4 h-4 bg-gray-100 border-gray-300 text-primary-600 focus:ring-primary-500 dark:focus:ring-primary-600 dark:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500">
                  <label for="filter-all" class="ml-2 text-sm font-medium text-gray-900 dark:text-gray-100">Alle</label>
                </li>
                <li class="flex items-center">
                  <input id="filter-pending" type="radio" name="status-filter" value="pending" class="w-4 h-4 bg-gray-100 border-gray-300 text-primary-600 focus:ring-primary-500 dark:focus:ring-primary-600 dark:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500">
                  <label for="filter-pending" class="ml-2 text-sm font-medium text-gray-900 dark:text-gray-100">In afwachting</label>
                </li>
                <li class="flex items-center">
                  <input id="filter-shipped" type="radio" name="status-filter" value="shipped" class="w-4 h-4 bg-gray-100 border-gray-300 text-primary-600 focus:ring-primary-500 dark:focus:ring-primary-600 dark:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500">
                  <label for="filter-shipped" class="ml-2 text-sm font-medium text-gray-900 dark:text-gray-100">Verzonden</label>
                </li>
                <li class="flex items-center">
                  <input id="filter-completed" type="radio" name="status-filter" value="completed" class="w-4 h-4 bg-gray-100 border-gray-300 text-primary-600 focus:ring-primary-500 dark:focus:ring-primary-600 dark:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500">
                  <label for="filter-completed" class="ml-2 text-sm font-medium text-gray-900 dark:text-gray-100">Afgerond</label>
                </li>
                <li class="flex items-center">
                  <input id="filter-cancelled" type="radio" name="status-filter" value="cancelled" class="w-4 h-4 bg-gray-100 border-gray-300 text-primary-600 focus:ring-primary-500 dark:focus:ring-primary-600 dark:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500">
                  <label for="filter-cancelled" class="ml-2 text-sm font-medium text-gray-900 dark:text-gray-100">Geannuleerd</label>
                </li>
              </ul>
            </div>
          </div>
        </div>
      </div>

      <div class="overflow-x-auto">
        <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
          <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
            <tr>
              <th scope="col" class="px-4 py-2">Bestelling</th>
              <th scope="col" class="px-4 py-2">Naam</th>
              <th scope="col" class="px-4 py-2">Datum</th>
              <th scope="col" class="px-4 py-2">Totaal</th>
              <th scope="col" class="px-4 py-2">Status</th>
              <th scope="col" class="px-4 py-2">Betaling</th>
              <th scope="col" class="px-4 py-2"><span class="sr-only">Acties</span></th>
            </tr>
          </thead>
          <tbody>
            @forelse ($orders as $order)
            <tr class="border-b border-gray-200 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-700 cursor-pointer order-row" data-href="{{ route('orderShow', $order->id) }}" data-status="{{ $order->status }}">
              <th scope="row" class="px-4 py-2 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                #{{ $order->id }}
              </th>
              <td class="px-4 py-2">{{ $order->customer->billing_first_name }} {{ $order->customer->billing_last_name }}</td>
              <td class="px-4 py-2 whitespace-nowrap">{{ $order->created_at->format('d-m-Y H:i') }}</td>
              <td class="px-4 py-2 whitespace-nowrap">€ {{ number_format($order->total, 2) }}</td>
              <td class="px-4 py-2">
                @php
                  $statusClasses = match($order->status) {
                    'completed' => 'bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-300',
                    'shipped'   => 'bg-blue-100 text-blue-800 dark:bg-blue-900 dark:text-blue-300',
                    'cancelled' => 'bg-red-100 text-red-800 dark:bg-red-900 dark:text-red-300',
                    default     => 'bg-yellow-100 text-yellow-800 dark:bg-yellow-900 dark:text-yellow-300',
                  };
                @endphp
                <span class="text-xs font-medium px-2.5 py-0.5 rounded {{ $statusClasses }}">
                  {{ $order->status_label }}
                </span>
              </td>
              <td class="px-4 py-2">
                @php
                  $payClasses = match($order->payment_status) {
                    'paid'      => 'bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-300',
                    'failed'    => 'bg-red-100 text-red-800 dark:bg-red-900 dark:text-red-300',
                    'refunded'  => 'bg-purple-100 text-purple-800 dark:bg-purple-900 dark:text-purple-300',
                    default     => 'bg-yellow-100 text-yellow-800 dark:bg-yellow-900 dark:text-yellow-300',
                  };
                @endphp
                <span class="text-xs font-medium px-2.5 py-0.5 rounded {{ $payClasses }}">
                  {{ $order->payment_status_label }}
                </span>
              </td>
              <td class="px-4 py-2 whitespace-nowrap">
                <a href="{{ route('orderShow', $order->id) }}" onclick="event.stopPropagation()"
                  class="text-xs font-medium text-primary-700 hover:underline dark:text-primary-400">Bekijken</a>
              </td>
            </tr>
            @empty
            <tr>
              <td colspan="7" class="px-4 py-8 text-center text-gray-500 dark:text-gray-400">Geen bestellingen gevonden.</td>
            </tr>
            @endforelse
          </tbody>
        </table>
      </div>

      <nav class="flex flex-col md:flex-row justify-between items-start md:items-center space-y-3 md:space-y-0 p-4" aria-label="Table navigation">
        <span class="text-sm font-normal text-gray-500 dark:text-gray-400">
          Toont <span class="font-semibold text-gray-900 dark:text-white">{{ $orders->firstItem() }}-{{ $orders->lastItem() }}</span>
          van <span class="font-semibold text-gray-900 dark:text-white">{{ $orders->total() }}</span>
        </span>
        <ul class="inline-flex items-stretch -space-x-px">
          <li>
            @if($orders->onFirstPage())
              <span class="flex items-center justify-center h-full py-1.5 px-3 ml-0 text-gray-400 bg-white rounded-l-lg border border-gray-300 cursor-not-allowed dark:bg-gray-800 dark:border-gray-700 dark:text-gray-600">
                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z" clip-rule="evenodd"/></svg>
              </span>
            @else
              <a href="{{ $orders->previousPageUrl() }}" class="flex items-center justify-center h-full py-1.5 px-3 ml-0 text-gray-500 bg-white rounded-l-lg border border-gray-300 hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white">
                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z" clip-rule="evenodd"/></svg>
              </a>
            @endif
          </li>
          @foreach($orders->getUrlRange(1, $orders->lastPage()) as $page => $url)
            <li>
              @if($page == $orders->currentPage())
                <span class="flex items-center justify-center text-sm z-10 py-2 px-3 leading-tight text-primary-600 bg-primary-50 border border-primary-300 hover:bg-primary-100 hover:text-primary-700 dark:border-gray-700 dark:bg-gray-700 dark:text-white">{{ $page }}</span>
              @else
                <a href="{{ $url }}" class="flex items-center justify-center text-sm py-2 px-3 leading-tight text-gray-500 bg-white border border-gray-300 hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white">{{ $page }}</a>
              @endif
            </li>
          @endforeach
          <li>
            @if($orders->hasMorePages())
              <a href="{{ $orders->nextPageUrl() }}" class="flex items-center justify-center h-full py-1.5 px-3 leading-tight text-gray-500 bg-white rounded-r-lg border border-gray-300 hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white">
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

    </div>
  </div>
</section>

<script>
document.addEventListener('DOMContentLoaded', function () {
  const searchInput = document.getElementById('simple-search');
  const rows = document.querySelectorAll('.order-row');
  const filterRadios = document.querySelectorAll('input[name="status-filter"]');

  function applyFilters() {
    const search = searchInput.value.toLowerCase();
    const selectedStatus = document.querySelector('input[name="status-filter"]:checked').value;

    rows.forEach(row => {
      const text = row.textContent.toLowerCase();
      const status = row.dataset.status;
      const matchesSearch = text.includes(search);
      const matchesStatus = selectedStatus === 'all' || status === selectedStatus;
      row.style.display = matchesSearch && matchesStatus ? '' : 'none';
    });
  }

  searchInput.addEventListener('input', applyFilters);
  filterRadios.forEach(r => r.addEventListener('change', applyFilters));

  rows.forEach(row => {
    row.addEventListener('click', function (e) {
      if (!e.target.closest('a')) {
        window.location = row.dataset.href;
      }
    });
  });
});
</script>

</x-dashboard-layout>
