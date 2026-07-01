<x-dashboard-layout>

@section('title', 'Nieuwe Quote')

<div class="max-w-2xl">
  <div class="mb-4">
    <a href="{{ route('admin.homepage-quotes.index') }}" class="text-sm text-primary-600 hover:underline dark:text-primary-400">
      ← Terug naar overzicht
    </a>
  </div>

  <div class="bg-white dark:bg-gray-800 shadow-md sm:rounded-lg p-6">
    <h2 class="text-lg font-semibold text-gray-900 dark:text-white mb-6">Nieuwe Homepage Quote</h2>

    @if($errors->any())
    <div class="mb-4 p-4 text-sm text-red-800 rounded-lg bg-red-50 dark:bg-gray-800 dark:text-red-400">
      <ul class="list-disc list-inside space-y-1">
        @foreach($errors->all() as $error)
          <li>{{ $error }}</li>
        @endforeach
      </ul>
    </div>
    @endif

    <form action="{{ route('admin.homepage-quotes.store') }}" method="POST" class="space-y-5">
      @csrf

      <div>
        <label for="text" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Quote tekst <span class="text-red-500">*</span></label>
        <textarea id="text" name="text" rows="5"
          class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white"
          placeholder='"Voer de quote tekst in..."' required>{{ old('text') }}</textarea>
      </div>

      <div>
        <label for="source" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Bron <span class="text-red-500">*</span></label>
        <input type="text" id="source" name="source" value="{{ old('source', 'Risale-i Nur') }}"
          class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white"
          placeholder="Risale-i Nur" required>
      </div>

      <div>
        <label for="sort_order" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Volgorde</label>
        <input type="number" id="sort_order" name="sort_order" value="{{ old('sort_order', 0) }}" min="0"
          class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-32 p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white">
        <p class="mt-1 text-xs text-gray-500 dark:text-gray-400">Lager getal = eerder weergegeven.</p>
      </div>

      <div class="flex items-center">
        <input type="checkbox" id="is_active" name="is_active" value="1" {{ old('is_active', true) ? 'checked' : '' }}
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
  </div>
</div>

</x-dashboard-layout>

