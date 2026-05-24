<x-dashboard-layout>

<div class="grid grid-cols-1 lg:grid-cols-3 gap-4">

  <div class="lg:col-span-2">
    <div class="bg-white dark:bg-gray-800 rounded-lg shadow-sm border border-gray-200 dark:border-gray-700">
      <div class="p-4 border-b border-gray-200 dark:border-gray-700">
        <h2 class="text-lg font-semibold text-gray-900 dark:text-white">Gebruiker toevoegen</h2>
      </div>
      <form action="{{ route('userStore') }}" method="POST" class="p-4">
        @csrf
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 mb-4">
          <div>
            <label for="first_name" class="block mb-2 text-sm font-medium text-gray-700 dark:text-gray-300">Voornaam</label>
            <input type="text" name="first_name" id="first_name" value="{{ old('first_name') }}"
              class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500 @error('first_name') border-red-500 dark:border-red-500 @enderror" />
            @error('first_name')
              <p class="mt-1 text-xs text-red-600 dark:text-red-400">{{ $message }}</p>
            @enderror
          </div>
          <div>
            <label for="last_name" class="block mb-2 text-sm font-medium text-gray-700 dark:text-gray-300">Achternaam</label>
            <input type="text" name="last_name" id="last_name" value="{{ old('last_name') }}"
              class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500 @error('last_name') border-red-500 dark:border-red-500 @enderror" />
            @error('last_name')
              <p class="mt-1 text-xs text-red-600 dark:text-red-400">{{ $message }}</p>
            @enderror
          </div>
          <div class="sm:col-span-2">
            <label for="email" class="block mb-2 text-sm font-medium text-gray-700 dark:text-gray-300">E-mailadres</label>
            <input type="email" name="email" id="email" value="{{ old('email') }}"
              class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500 @error('email') border-red-500 dark:border-red-500 @enderror" />
            @error('email')
              <p class="mt-1 text-xs text-red-600 dark:text-red-400">{{ $message }}</p>
            @enderror
            <p class="mt-1 text-xs text-gray-500 dark:text-gray-400">De gebruiker ontvangt een e-mail om zijn wachtwoord in te stellen.</p>
          </div>
          <div>
            <label for="user_role" class="block mb-2 text-sm font-medium text-gray-700 dark:text-gray-300">Rol</label>
            <select name="user_role" id="user_role"
              class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
              <option value="user" {{ old('user_role') === 'user' ? 'selected' : '' }}>Gebruiker</option>
              <option value="admin" {{ old('user_role') === 'admin' ? 'selected' : '' }}>Admin</option>
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
  </div>

  {{-- Right: Info card --}}
  <div>
    <div class="bg-white dark:bg-gray-800 rounded-lg shadow-sm border border-gray-200 dark:border-gray-700 p-4">
      <h3 class="text-sm font-semibold text-gray-900 dark:text-white mb-3">Let op</h3>
      <ul class="space-y-2 text-sm text-gray-500 dark:text-gray-400">
        <li class="flex items-start gap-2">
          <svg class="w-4 h-4 text-primary-600 mt-0.5 shrink-0" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/></svg>
          De gebruiker ontvangt een welkomstmail na aanmaken.
        </li>
        <li class="flex items-start gap-2">
          <svg class="w-4 h-4 text-primary-600 mt-0.5 shrink-0" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/></svg>
          Admin heeft toegang tot het volledige dashboard.
        </li>
        <li class="flex items-start gap-2">
          <svg class="w-4 h-4 text-primary-600 mt-0.5 shrink-0" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/></svg>
          Gebruiker heeft alleen toegang tot eigen profiel en bestellingen.
        </li>
      </ul>
    </div>
  </div>

</div>

</x-dashboard-layout>
