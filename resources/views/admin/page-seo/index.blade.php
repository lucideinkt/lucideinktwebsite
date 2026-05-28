<x-dashboard-layout>

  @if(session('success'))
    <div class="flex items-center p-4 mb-4 text-sm text-green-800 rounded-lg bg-green-50 dark:bg-gray-800 dark:text-green-400" role="alert">
      <svg class="shrink-0 inline w-4 h-4 me-3" fill="currentColor" viewBox="0 0 20 20"><path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z"/></svg>
      {{ session('success') }}
    </div>
  @endif

  <div class="mb-6 flex items-center justify-between">
    <div>
      <h2 class="text-2xl font-bold text-gray-900 dark:text-white">Pagina SEO</h2>
      <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">Beheer de SEO-instellingen per pagina. DB-waarden overschrijven de standaardconfiguratie.</p>
    </div>
  </div>

  <div class="bg-white dark:bg-gray-800 rounded-lg shadow-sm border border-gray-200 dark:border-gray-700 overflow-hidden">
    <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
      <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
        <tr>
          <th class="px-6 py-3">Pagina</th>
          <th class="px-6 py-3">Titel (SEO)</th>
          <th class="px-6 py-3">Omschrijving</th>
          <th class="px-6 py-3">Status</th>
          <th class="px-6 py-3 text-right">Acties</th>
        </tr>
      </thead>
      <tbody>
        @foreach($pages as $pageKey => $pageInfo)
          @php $db = $dbSettings[$pageKey] ?? null; @endphp
          <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-700">
            <td class="px-6 py-4 font-medium text-gray-900 dark:text-white whitespace-nowrap">
              <div class="flex items-center gap-2">
                <i class="fa-solid {{ $pageInfo['icon'] }} w-4 text-gray-400 dark:text-gray-500 text-xs"></i>
                {{ $pageInfo['label'] }}
              </div>
              <span class="text-xs text-gray-400 dark:text-gray-500 font-mono">/{{ $pageKey }}</span>
            </td>
            <td class="px-6 py-4">
              @if($db && $db->title)
                <span class="text-gray-900 dark:text-white">{{ Str::limit($db->title, 45) }}</span>
                @php $len = strlen($db->title); @endphp
                <span class="ml-1 text-xs {{ $len >= 50 && $len <= 65 ? 'text-green-600' : ($len >= 30 ? 'text-yellow-500' : 'text-red-500') }}">
                  ({{ $len }})
                </span>
              @else
                <span class="italic text-gray-400 dark:text-gray-500 text-xs">Standaard</span>
              @endif
            </td>
            <td class="px-6 py-4">
              @if($db && $db->description)
                <span class="text-gray-700 dark:text-gray-300">{{ Str::limit($db->description, 50) }}</span>
                @php $len = strlen($db->description); @endphp
                <span class="ml-1 text-xs {{ $len >= 120 && $len <= 165 ? 'text-green-600' : ($len >= 80 ? 'text-yellow-500' : 'text-red-500') }}">
                  ({{ $len }})
                </span>
              @else
                <span class="italic text-gray-400 dark:text-gray-500 text-xs">Standaard</span>
              @endif
            </td>
            <td class="px-6 py-4">
              @if($db && ($db->title || $db->description))
                <span class="inline-flex items-center px-2 py-0.5 rounded text-xs font-medium bg-green-100 text-green-800 dark:bg-green-900/40 dark:text-green-300">
                  Aangepast
                </span>
              @else
                <span class="inline-flex items-center px-2 py-0.5 rounded text-xs font-medium bg-gray-100 text-gray-600 dark:bg-gray-700 dark:text-gray-400">
                  Standaard
                </span>
              @endif
            </td>
            <td class="px-6 py-4 text-right">
              <a href="{{ route('admin.page-seo.edit', $pageKey) }}"
                class="font-medium text-primary-600 dark:text-primary-500 hover:underline text-sm">
                Bewerken
              </a>
            </td>
          </tr>
        @endforeach
      </tbody>
    </table>
  </div>

</x-dashboard-layout>

