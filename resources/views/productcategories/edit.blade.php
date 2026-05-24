<x-dashboard-layout>

{{-- Breadcrumb --}}
<nav class="flex mb-4" aria-label="Breadcrumb">
  <ol class="inline-flex items-center space-x-1 md:space-x-2 rtl:space-x-reverse">
    <li class="inline-flex items-center">
      <a href="{{ route('productCategoryIndex') }}" class="inline-flex items-center text-sm font-medium text-gray-700 hover:text-primary-600 dark:text-gray-400 dark:hover:text-white">
        <svg class="w-3 h-3 me-2.5" fill="currentColor" viewBox="0 0 20 20"><path d="m19.707 9.293-2-2-7-7a1 1 0 0 0-1.414 0l-7 7-2 2a1 1 0 0 0 1.414 1.414L2 10.414V18a2 2 0 0 0 2 2h3a1 1 0 0 0 1-1v-4a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1v4a1 1 0 0 0 1 1h3a2 2 0 0 0 2-2v-7.586l.293.293a1 1 0 0 0 1.414-1.414Z"/></svg>
        Productcategorieën
      </a>
    </li>
    <li aria-current="page">
      <div class="flex items-center">
        <svg class="rtl:rotate-180 w-3 h-3 text-gray-400 mx-1" fill="none" viewBox="0 0 6 10"><path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 9 4-4-4-4"/></svg>
        <span class="ms-1 text-sm font-medium text-gray-500 md:ms-2 dark:text-gray-400">{{ $category->name }}</span>
      </div>
    </li>
  </ol>
</nav>

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
  <div class="lg:col-span-2">
    <div class="bg-white dark:bg-gray-800 rounded-lg shadow-sm border border-gray-200 dark:border-gray-700">
      <div class="p-4 border-b border-gray-200 dark:border-gray-700">
        <h2 class="text-lg font-semibold text-gray-900 dark:text-white">Categorie bewerken</h2>
      </div>
      <form action="{{ route('productCategoryUpdate', $category->id) }}" method="POST" class="p-4 space-y-4">
        @method('PUT')
        @csrf

        <div>
          <label for="name" class="block mb-2 text-sm font-medium text-gray-700 dark:text-gray-300">Naam</label>
          <input type="text" name="name" id="name" value="{{ old('name', $category->name) }}"
            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:text-white @error('name') border-red-500 dark:border-red-500 @enderror"
            placeholder="bijv. Boeken">
          @error('name')
            <p class="mt-1 text-xs text-red-600 dark:text-red-400">{{ $message }}</p>
          @enderror
        </div>

        <div>
          <label for="is_published" class="block mb-2 text-sm font-medium text-gray-700 dark:text-gray-300">Status</label>
          <select name="is_published" id="is_published"
            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:text-white">
            <option value="0" {{ old('is_published', $category->is_published) == 0 ? 'selected' : '' }}>Concept (niet zichtbaar)</option>
            <option value="1" {{ old('is_published', $category->is_published) == 1 ? 'selected' : '' }}>Gepubliceerd</option>
          </select>
          @error('is_published')
            <p class="mt-1 text-xs text-red-600 dark:text-red-400">{{ $message }}</p>
          @enderror
        </div>

        <div>
          <label class="block mb-2 text-sm font-medium text-gray-500 dark:text-gray-400">Slug</label>
          <p class="text-sm font-mono text-gray-600 dark:text-gray-400 bg-gray-50 dark:bg-gray-700 border border-gray-200 dark:border-gray-600 rounded-lg px-3 py-2">{{ $category->slug }}</p>
        </div>

        <div class="flex items-center gap-3 pt-2">
          <button type="submit"
            class="text-white bg-primary-700 hover:bg-primary-800 focus:ring-4 focus:ring-primary-300 font-medium rounded-lg text-sm px-5 py-2.5 dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800">
            Opslaan
          </button>
          <a href="{{ route('productCategoryIndex') }}"
            class="text-sm font-medium text-gray-500 hover:text-gray-700 dark:text-gray-400 dark:hover:text-white">
            Annuleren
          </a>
        </div>
      </form>
    </div>
  </div>

  {{-- Right: meta info --}}
  <div>
    <div class="bg-white dark:bg-gray-800 rounded-lg shadow-sm border border-gray-200 dark:border-gray-700 p-4">
      <h3 class="text-sm font-semibold text-gray-900 dark:text-white mb-3">Info</h3>
      <dl class="space-y-2 text-sm">
        <div class="flex justify-between">
          <dt class="text-gray-500 dark:text-gray-400">ID</dt>
          <dd class="font-medium text-gray-900 dark:text-white">{{ $category->id }}</dd>
        </div>
        <div class="flex justify-between">
          <dt class="text-gray-500 dark:text-gray-400">Aangemaakt</dt>
          <dd class="font-medium text-gray-900 dark:text-white">{{ $category->created_at->format('d-m-Y') }}</dd>
        </div>
        <div class="flex justify-between">
          <dt class="text-gray-500 dark:text-gray-400">Bijgewerkt</dt>
          <dd class="font-medium text-gray-900 dark:text-white">{{ $category->updated_at->format('d-m-Y') }}</dd>
        </div>
      </dl>
    </div>
  </div>
</div>

</x-dashboard-layout>
