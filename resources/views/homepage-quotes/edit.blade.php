<x-dashboard-layout>

@section('title', 'Quote Bewerken')

<div class="max-w-2xl">
  <div class="mb-4">
    <a href="{{ route('admin.homepage-quotes.index') }}" class="text-sm text-primary-600 hover:underline dark:text-primary-400">
      ← Terug naar overzicht
    </a>
  </div>

  <div class="bg-white dark:bg-gray-800 shadow-md sm:rounded-lg p-6">
    <h2 class="text-lg font-semibold text-gray-900 dark:text-white mb-6">Quote Bewerken</h2>

    @if(session('success'))
    <div id="alert-success" class="flex items-center p-4 mb-4 text-green-800 rounded-lg bg-green-50 dark:bg-gray-800 dark:text-green-400">
      <svg class="shrink-0 w-4 h-4" fill="currentColor" viewBox="0 0 20 20"><path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z"/></svg>
      <span class="ms-2 text-sm font-medium">{{ session('success') }}</span>
      <button type="button" onclick="document.getElementById('alert-success').remove()" class="ms-auto -mx-1.5 -my-1.5 bg-green-50 text-green-500 rounded-lg p-1.5 hover:bg-green-200 dark:bg-gray-800 dark:text-green-400 dark:hover:bg-gray-700">
        <svg class="w-3 h-3" fill="none" viewBox="0 0 14 14"><path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/></svg>
      </button>
    </div>
    @endif

    @if($errors->any())
    <div class="mb-4 p-4 text-sm text-red-800 rounded-lg bg-red-50 dark:bg-gray-800 dark:text-red-400">
      <ul class="list-disc list-inside space-y-1">
        @foreach($errors->all() as $error)
          <li>{{ $error }}</li>
        @endforeach
      </ul>
    </div>
    @endif

    <form action="{{ route('admin.homepage-quotes.update', $quote->id) }}" method="POST" class="space-y-5">
      @csrf
      @method('PUT')

      <div>
        <label for="text" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Quote tekst <span class="text-red-500">*</span></label>
        <textarea id="text" name="text" rows="5"
          class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white"
          required>{{ old('text', $quote->text) }}</textarea>
      </div>

      <div>
        <label for="source" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Bron <span class="text-red-500">*</span></label>
        <input type="text" id="source" name="source" value="{{ old('source', $quote->source) }}"
          class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white"
          required>
      </div>

      <div>
        <label for="sort_order" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Volgorde</label>
        <input type="number" id="sort_order" name="sort_order" value="{{ old('sort_order', $quote->sort_order) }}" min="0"
          class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-32 p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white">
        <p class="mt-1 text-xs text-gray-500 dark:text-gray-400">Lager getal = eerder weergegeven.</p>
      </div>

      <div class="flex items-center">
        <input type="checkbox" id="is_active" name="is_active" value="1" {{ old('is_active', $quote->is_active) ? 'checked' : '' }}
          class="w-4 h-4 text-primary-600 bg-gray-100 border-gray-300 rounded focus:ring-primary-500 dark:focus:ring-primary-600 dark:ring-offset-gray-800 dark:bg-gray-700 dark:border-gray-600">
        <label for="is_active" class="ms-2 text-sm font-medium text-gray-900 dark:text-gray-300">Actief (zichtbaar op homepage)</label>
      </div>

      <div class="flex gap-3 pt-2">
        <button type="submit"
          class="text-white bg-primary-700 hover:bg-primary-800 focus:ring-4 focus:outline-none focus:ring-primary-300 font-medium rounded-lg text-sm px-5 py-2.5 dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800">
          Opslaan
        </button>
        <a href="{{ route('admin.homepage-quotes.index') }}"
          class="text-gray-900 bg-white border border-gray-300 hover:bg-gray-100 focus:ring-4 focus:ring-gray-200 font-medium rounded-lg text-sm px-5 py-2.5 dark:bg-gray-800 dark:text-white dark:border-gray-600 dark:hover:bg-gray-700 dark:focus:ring-gray-700">
          Annuleren
        </a>
      </div>
    </form>

    <div class="mt-8 pt-6 border-t border-gray-200 dark:border-gray-700">
      <h3 class="text-sm font-semibold text-gray-900 dark:text-white mb-2">Quote verwijderen</h3>
      <p class="text-sm text-gray-500 dark:text-gray-400 mb-3">Dit kan niet ongedaan worden gemaakt.</p>
      <form action="{{ route('admin.homepage-quotes.destroy', $quote->id) }}" method="POST"
        onsubmit="return confirm('Weet je zeker dat je deze quote wilt verwijderen?')">
        @csrf
        @method('DELETE')
        <button type="submit"
          class="text-white bg-red-600 hover:bg-red-700 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm px-4 py-2 dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-900">
          Verwijderen
        </button>
      </form>
    </div>
  </div>
</div>

</x-dashboard-layout>

