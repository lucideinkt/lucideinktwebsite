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

<div class="grid grid-cols-1 lg:grid-cols-3 gap-4">

  {{-- Left: Edit form --}}
  <div class="lg:col-span-2">
    <div class="bg-white dark:bg-gray-800 rounded-lg shadow-sm border border-gray-200 dark:border-gray-700">
      <div class="p-4 border-b border-gray-200 dark:border-gray-700">
        <h2 class="text-lg font-semibold text-gray-900 dark:text-white">Gebruiker #{{ $user->id }}</h2>
        <p class="text-sm text-gray-500 dark:text-gray-400">Geregistreerd op {{ $user->created_at->format('d-m-Y H:i') }}</p>
      </div>
      <form action="{{ route('userEdit', $user->id) }}" method="POST" class="p-4">
        @csrf
        @method('PUT')
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 mb-4">
          <div>
            <label class="block mb-2 text-sm font-medium text-gray-700 dark:text-gray-300">Voornaam</label>
            <input type="text" value="{{ $user->first_name }}" disabled
              class="bg-gray-50 border border-gray-300 text-gray-500 text-sm rounded-lg block w-full p-2.5 cursor-not-allowed dark:bg-gray-700 dark:border-gray-600 dark:text-gray-400" />
          </div>
          <div>
            <label class="block mb-2 text-sm font-medium text-gray-700 dark:text-gray-300">Achternaam</label>
            <input type="text" value="{{ $user->last_name }}" disabled
              class="bg-gray-50 border border-gray-300 text-gray-500 text-sm rounded-lg block w-full p-2.5 cursor-not-allowed dark:bg-gray-700 dark:border-gray-600 dark:text-gray-400" />
          </div>
          <div>
            <label class="block mb-2 text-sm font-medium text-gray-700 dark:text-gray-300">E-mailadres</label>
            <input type="email" value="{{ $user->email }}" disabled
              class="bg-gray-50 border border-gray-300 text-gray-500 text-sm rounded-lg block w-full p-2.5 cursor-not-allowed dark:bg-gray-700 dark:border-gray-600 dark:text-gray-400" />
          </div>
          <div>
            <label for="user_role" class="block mb-2 text-sm font-medium text-gray-700 dark:text-gray-300">Rol</label>
            <select name="user_role" id="user_role"
              class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
              <option value="admin" @selected($user->role === 'admin')>Admin</option>
              <option value="user" @selected($user->role === 'user')>Gebruiker</option>
            </select>
          </div>
        </div>
        <div class="flex items-center gap-3">
          <button type="submit"
            class="text-white bg-primary-700 hover:bg-primary-800 focus:ring-4 focus:ring-primary-300 font-medium rounded-lg text-sm px-5 py-2.5 dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800">
            Opslaan
          </button>
          <a href="{{ route('userIndex') }}"
            class="text-sm font-medium text-gray-500 hover:text-gray-700 dark:text-gray-400 dark:hover:text-gray-300">
            Annuleren
          </a>
        </div>
      </form>
    </div>

    {{-- Order history --}}
    @if(!empty($customer) && $customer->orders->count() > 0)
    <div class="mt-4 bg-white dark:bg-gray-800 rounded-lg shadow-sm border border-gray-200 dark:border-gray-700">
      <div class="p-4 border-b border-gray-200 dark:border-gray-700">
        <h3 class="text-base font-semibold text-gray-900 dark:text-white">Ordergeschiedenis</h3>
      </div>
      <div class="overflow-x-auto">
        <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
          <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
            <tr>
              <th class="px-4 py-3">Bestelling</th>
              <th class="px-4 py-3">Datum</th>
              <th class="px-4 py-3">Status</th>
              <th class="px-4 py-3">Totaal</th>
              <th class="px-4 py-3"><span class="sr-only">Actie</span></th>
            </tr>
          </thead>
          <tbody>
            @foreach($customer->orders as $order)
            <tr class="border-b border-gray-200 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-700">
              <td class="px-4 py-2 font-medium text-gray-900 dark:text-white">#{{ $order->id }}</td>
              <td class="px-4 py-2">{{ $order->created_at->format('d-m-Y') }}</td>
              <td class="px-4 py-2">{{ $order->status_label }}</td>
              <td class="px-4 py-2">€ {{ number_format($order->total, 2) }}</td>
              <td class="px-4 py-2 text-right">
                <a href="{{ route('orderShow', $order->id) }}"
                  class="inline-flex items-center px-2 py-0.5 text-xs font-medium text-blue-700 bg-blue-50 border border-blue-200 rounded hover:bg-blue-100 dark:bg-blue-900/20 dark:text-blue-400 dark:border-blue-800">
                  Bekijken
                </a>
              </td>
            </tr>
            @endforeach
          </tbody>
        </table>
      </div>
    </div>
    @endif
  </div>

  {{-- Right: Summary card --}}
  <div class="space-y-4">
    <div class="bg-white dark:bg-gray-800 rounded-lg shadow-sm border border-gray-200 dark:border-gray-700 p-4">
      <div class="flex items-center gap-3 mb-4">
        <div class="w-12 h-12 rounded-full bg-primary-600 flex items-center justify-center text-white text-lg font-semibold">
          {{ strtoupper(substr($user->first_name, 0, 1)) }}
        </div>
        <div>
          <p class="text-sm font-semibold text-gray-900 dark:text-white">{{ $user->first_name }} {{ $user->last_name }}</p>
          <p class="text-xs text-gray-500 dark:text-gray-400">{{ $user->email }}</p>
        </div>
      </div>
      <dl class="space-y-2 text-sm">
        <div class="flex justify-between">
          <dt class="text-gray-500 dark:text-gray-400">Rol</dt>
          <dd>
            @if($user->role === 'admin')
              <span class="bg-purple-100 text-purple-800 text-xs font-medium px-2 py-0.5 rounded dark:bg-purple-900 dark:text-purple-300">Admin</span>
            @else
              <span class="bg-blue-100 text-blue-800 text-xs font-medium px-2 py-0.5 rounded dark:bg-blue-900 dark:text-blue-300">Gebruiker</span>
            @endif
          </dd>
        </div>
        <div class="flex justify-between">
          <dt class="text-gray-500 dark:text-gray-400">Bestellingen</dt>
          <dd class="font-medium text-gray-900 dark:text-white">{{ $customer?->orders->count() ?? 0 }}</dd>
        </div>
        @if($customer?->orders->count() > 0)
        <div class="flex justify-between">
          <dt class="text-gray-500 dark:text-gray-400">Totaal uitgegeven</dt>
          <dd class="font-medium text-gray-900 dark:text-white">€ {{ number_format($customer->orders->sum('total'), 2) }}</dd>
        </div>
        @endif
      </dl>
    </div>

    @if(!empty($customer->billing_street))
    <div class="bg-white dark:bg-gray-800 rounded-lg shadow-sm border border-gray-200 dark:border-gray-700 p-4">
      <h3 class="text-sm font-semibold text-gray-900 dark:text-white mb-3">Factuuradres</h3>
      <dl class="space-y-1.5 text-sm">
        <div class="flex justify-between">
          <dt class="text-gray-500 dark:text-gray-400">Straat</dt>
          <dd class="text-gray-900 dark:text-white">{{ $customer->billing_street }} {{ $customer->billing_house_number }}{{ $customer->billing_house_number_addition }}</dd>
        </div>
        <div class="flex justify-between">
          <dt class="text-gray-500 dark:text-gray-400">Postcode</dt>
          <dd class="text-gray-900 dark:text-white">{{ $customer->billing_postal_code }}</dd>
        </div>
        <div class="flex justify-between">
          <dt class="text-gray-500 dark:text-gray-400">Plaats</dt>
          <dd class="text-gray-900 dark:text-white">{{ $customer->billing_city }}</dd>
        </div>
        <div class="flex justify-between">
          <dt class="text-gray-500 dark:text-gray-400">Land</dt>
          <dd class="text-gray-900 dark:text-white">{{ $customer->billing_country }}</dd>
        </div>
      </dl>
    </div>
    @endif
  </div>

</div>

</x-dashboard-layout>
