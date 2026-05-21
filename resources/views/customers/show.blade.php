<x-dashboard-layout>

<nav class="flex mb-4" aria-label="Breadcrumb">
  <ol class="inline-flex items-center space-x-1 md:space-x-2 rtl:space-x-reverse">
    <li class="inline-flex items-center">
      <a href="{{ route('customerIndex') }}" class="inline-flex items-center text-sm font-medium text-gray-700 hover:text-primary-600 dark:text-gray-400 dark:hover:text-white">
        <svg class="w-3 h-3 me-2.5" fill="currentColor" viewBox="0 0 20 20"><path d="m19.707 9.293-2-2-7-7a1 1 0 0 0-1.414 0l-7 7-2 2a1 1 0 0 0 1.414 1.414L2 10.414V18a2 2 0 0 0 2 2h3a1 1 0 0 0 1-1v-4a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1v4a1 1 0 0 0 1 1h3a2 2 0 0 0 2-2v-7.586l.293.293a1 1 0 0 0 1.414-1.414Z"/></svg>
        Klanten
      </a>
    </li>
    <li aria-current="page">
      <div class="flex items-center">
        <svg class="rtl:rotate-180 w-3 h-3 text-gray-400 mx-1" fill="none" viewBox="0 0 6 10"><path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 9 4-4-4-4"/></svg>
        <span class="ms-1 text-sm font-medium text-gray-500 md:ms-2 dark:text-gray-400">{{ $customer->billing_first_name }} {{ $customer->billing_last_name }}</span>
      </div>
    </li>
  </ol>
</nav>

<div class="grid grid-cols-1 lg:grid-cols-3 gap-4 mb-4">

  {{-- Avatar + summary --}}
  <div class="bg-white dark:bg-gray-800 rounded-lg shadow-sm border border-gray-200 dark:border-gray-700 p-5 flex flex-col items-center text-center">
    <div class="w-16 h-16 rounded-full bg-indigo-100 dark:bg-indigo-900 flex items-center justify-center mb-3">
      <span class="text-2xl font-bold text-indigo-700 dark:text-indigo-300">{{ strtoupper(substr($customer->billing_first_name, 0, 1)) }}</span>
    </div>
    <h2 class="text-base font-semibold text-gray-900 dark:text-white">{{ $customer->billing_first_name }} {{ $customer->billing_last_name }}</h2>
    <p class="text-sm text-gray-500 dark:text-gray-400 mb-1">{{ $customer->billing_email }}</p>
    @if($customer->billing_phone)
      <p class="text-sm text-gray-500 dark:text-gray-400 mb-3">{{ $customer->billing_phone }}</p>
    @endif
    <div class="flex gap-3 w-full justify-center mt-2">
      <div class="text-center">
        <p class="text-lg font-bold text-gray-900 dark:text-white">{{ $customer->orders->count() }}</p>
        <p class="text-xs text-gray-500 dark:text-gray-400">Bestellingen</p>
      </div>
      <div class="w-px bg-gray-200 dark:bg-gray-700"></div>
      <div class="text-center">
        <p class="text-lg font-bold text-gray-900 dark:text-white">€ {{ number_format($customer->orders->sum('total'), 2, ',', '.') }}</p>
        <p class="text-xs text-gray-500 dark:text-gray-400">Uitgegeven</p>
      </div>
    </div>
  </div>

  {{-- Persoonlijke gegevens --}}
  <div class="bg-white dark:bg-gray-800 rounded-lg shadow-sm border border-gray-200 dark:border-gray-700 p-4">
    <h3 class="text-sm font-semibold text-gray-900 dark:text-white mb-3 flex items-center gap-2">
      <svg class="w-4 h-4 text-gray-400" fill="currentColor" viewBox="0 0 20 20"><path d="M10 9a3 3 0 1 0 0-6 3 3 0 0 0 0 6Zm-7 9a7 7 0 1 1 14 0H3Z"/></svg>
      Persoonlijke gegevens
    </h3>
    <dl class="space-y-2 text-sm">
      <div class="flex justify-between gap-2">
        <dt class="text-gray-500 dark:text-gray-400 shrink-0">Naam</dt>
        <dd class="font-medium text-gray-900 dark:text-white text-right">{{ $customer->billing_first_name }} {{ $customer->billing_last_name }}</dd>
      </div>
      <div class="flex justify-between gap-2">
        <dt class="text-gray-500 dark:text-gray-400 shrink-0">E-mail</dt>
        <dd class="font-medium text-gray-900 dark:text-white text-right">{{ $customer->billing_email }}</dd>
      </div>
      <div class="flex justify-between gap-2">
        <dt class="text-gray-500 dark:text-gray-400 shrink-0">Telefoon</dt>
        <dd class="font-medium text-gray-900 dark:text-white text-right">{{ $customer->billing_phone ?? '–' }}</dd>
      </div>
      <div class="flex justify-between gap-2">
        <dt class="text-gray-500 dark:text-gray-400 shrink-0">Geregistreerd</dt>
        <dd class="font-medium text-gray-900 dark:text-white text-right">{{ $customer->created_at->format('d-m-Y H:i') }}</dd>
      </div>
    </dl>
  </div>

  {{-- Factuuradres --}}
  <div class="bg-white dark:bg-gray-800 rounded-lg shadow-sm border border-gray-200 dark:border-gray-700 p-4">
    <h3 class="text-sm font-semibold text-gray-900 dark:text-white mb-3 flex items-center gap-2">
      <svg class="w-4 h-4 text-gray-400" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M5.05 4.05a7 7 0 1 1 9.9 9.9L10 18.9l-4.95-4.95a7 7 0 0 1 0-9.9ZM10 11a2 2 0 1 0 0-4 2 2 0 0 0 0 4Z" clip-rule="evenodd"/></svg>
      Factuuradres
    </h3>
    <dl class="space-y-2 text-sm">
      <div class="flex justify-between gap-2">
        <dt class="text-gray-500 dark:text-gray-400 shrink-0">Straat</dt>
        <dd class="font-medium text-gray-900 dark:text-white text-right">{{ $customer->billing_street }} {{ $customer->billing_house_number }}{{ $customer->billing_house_number_addition ? ' '.$customer->billing_house_number_addition : '' }}</dd>
      </div>
      <div class="flex justify-between gap-2">
        <dt class="text-gray-500 dark:text-gray-400 shrink-0">Postcode</dt>
        <dd class="font-medium text-gray-900 dark:text-white text-right">{{ $customer->billing_postal_code }}</dd>
      </div>
      <div class="flex justify-between gap-2">
        <dt class="text-gray-500 dark:text-gray-400 shrink-0">Plaats</dt>
        <dd class="font-medium text-gray-900 dark:text-white text-right">{{ $customer->billing_city }}</dd>
      </div>
      <div class="flex justify-between gap-2">
        <dt class="text-gray-500 dark:text-gray-400 shrink-0">Land</dt>
        <dd class="font-medium text-gray-900 dark:text-white text-right">{{ $customer->billing_country }}</dd>
      </div>
    </dl>
  </div>

</div>

{{-- Order history --}}
<div class="bg-white dark:bg-gray-800 rounded-lg shadow-sm border border-gray-200 dark:border-gray-700 overflow-hidden">
  <div class="p-4 border-b border-gray-200 dark:border-gray-700">
    <h3 class="text-sm font-semibold text-gray-900 dark:text-white">Ordergeschiedenis</h3>
  </div>
  <div class="overflow-x-auto">
    <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
      <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
        <tr>
          <th scope="col" class="px-4 py-2">Bestelling</th>
          <th scope="col" class="px-4 py-2">Datum</th>
          <th scope="col" class="px-4 py-2">Status</th>
          <th scope="col" class="px-4 py-2">Totaal</th>
          <th scope="col" class="px-4 py-2"><span class="sr-only">Acties</span></th>
        </tr>
      </thead>
      <tbody>
        @forelse($customer->orders as $order)
        <tr class="border-b border-gray-200 dark:border-gray-700">
          <th scope="row" class="px-4 py-2 font-medium text-gray-900 dark:text-white">#{{ $order->id }}</th>
          <td class="px-4 py-2 text-xs">{{ $order->created_at->format('d-m-Y') }}</td>
          <td class="px-4 py-2">
            <span class="text-xs font-medium px-2.5 py-0.5 rounded bg-gray-100 text-gray-700 dark:bg-gray-700 dark:text-gray-300">
              {{ $order->status_label }}
            </span>
          </td>
          <td class="px-4 py-2 font-medium text-gray-900 dark:text-white">€ {{ number_format($order->total, 2, ',', '.') }}</td>
          <td class="px-4 py-2">
            <a href="{{ route('orderShow', $order->id) }}"
              class="text-xs font-medium text-primary-700 hover:underline dark:text-primary-400">Bekijken</a>
          </td>
        </tr>
        @empty
        <tr>
          <td colspan="5" class="px-4 py-8 text-center text-gray-500 dark:text-gray-400">Geen bestellingen gevonden.</td>
        </tr>
        @endforelse
      </tbody>
    </table>
  </div>
</div>

</x-dashboard-layout>
