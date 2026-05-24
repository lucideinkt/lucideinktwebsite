@if(auth()->user()->role === 'user')
  <x-layout>
      @push('head')<meta name="robots" content="noindex, nofollow">@endpush
      <div class="page-normal-background">
    <main class="container page user-dashboard">
        <x-breadcrumbs :items="[
            ['label' => 'Home', 'url' => route('home')],
            ['label' => 'Dashboard', 'url' => route('dashboard')],
            ['label' => 'Profiel bijwerken', 'url' => route('editProfile')]
        ]" />

        <div class="dashboard-header">
            <h1 class="dashboard-title font-herina">Profiel bijwerken</h1>
            <p class="dashboard-subtitle">Wijzig je persoonlijke gegevens en wachtwoord</p>
        </div>

        @if(session('success'))
            <div class="alert alert-success">
                <span class="alert-icon"><i class="fa-solid fa-circle-check"></i></span>
                <span class="alert-text">{{ session('success') }}</span>
                <button type="button" class="alert-close"
                    onclick="this.parentElement.style.display='none';">×</button>
            </div>
        @endif

        @if(session('error'))
            <div class="alert alert-error">
                <span class="alert-icon"><i class="fa-solid fa-circle-exclamation"></i></span>
                <span class="alert-text">{{ session('error') }}</span>
                <button type="button" class="alert-close"
                    onclick="this.parentElement.style.display='none';">×</button>
            </div>
        @endif

        <x-user-dashboard-layout>

            <div class="profile-card">
                <form action="{{ route('updateProfile') }}" method="POST" class="profile-form">
                    @csrf

                    <div class="form-section">
                        <h3 class="form-section-title">Persoonlijke gegevens</h3>

                        <div class="form-row">
                            <div class="form-input">
                                <label for="first_name">Voornaam</label>
                                <input type="text" name="first_name" id="first_name" value="{{ $user->first_name }}"
                                    placeholder="Voornaam">
                                @error('first_name')
                                    <div class="error">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-input">
                                <label for="last_name">Achternaam</label>
                                <input type="text" name="last_name" id="last_name" value="{{ $user->last_name }}"
                                    placeholder="Achternaam">
                                @error('last_name')
                                    <div class="error">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="form-input">
                            <label for="email">E-mailadres</label>
                            <input type="email" name="email" id="email" value="{{ $user->email }}" placeholder="email@voorbeeld.nl">
                            @error('email')
                                <div class="error">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="form-section">
                        <h3 class="form-section-title">Wachtwoord wijzigen</h3>
                        <p class="form-section-hint">Laat leeg om je huidige wachtwoord te behouden</p>

                        <div class="form-input">
                            <label for="password">Nieuw wachtwoord</label>
                            <input type="password" name="password" id="password" placeholder="Minimaal 8 tekens">
                            @error('password')
                                <div class="error">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-input">
                            <label for="password_confirmation">Bevestig wachtwoord</label>
                            <input type="password" name="password_confirmation" id="password_confirmation"
                                placeholder="Herhaal je wachtwoord">
                        </div>
                    </div>

                    <div class="form-actions">
                        <button type="submit" class="btn btn-primary">
                            <span class="loader"></span>
                            Wijzigingen opslaan
                        </button>
                    </div>
                </form>
            </div>

            <div class="profile-card" style="margin-top: 1.5rem;">
                <div class="form-section">
                    <h3 class="form-section-title">Tweestapsverificatie</h3>
                    @if($user->google2fa_secret)
                        <p class="form-section-hint">2FA is actief. Je authenticator-app is gekoppeld.</p>
                        <button type="button" onclick="document.getElementById('disable2faModal').classList.remove('hidden')" class="btn btn-danger" style="margin-top: 1rem;">
                            Uitschakelen
                        </button>

                        {{-- 2FA disable modal --}}
                        <div id="disable2faModal" class="hidden fixed inset-0 z-50 flex items-center justify-center bg-black/50">
                            <div class="bg-white rounded-xl shadow-lg p-6 w-full max-w-sm mx-4">
                                <h3 style="font-size:1.1rem;font-weight:600;margin-bottom:0.5rem;">2FA uitschakelen</h3>
                                <p style="font-size:0.875rem;color:#6b7280;margin-bottom:1rem;">Voer de code uit je authenticator-app in om te bevestigen.</p>
                                <form action="{{ route('2fa.disable') }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <div class="form-input" style="margin-bottom:0.75rem;">
                                        <label for="otp_disable">Code uit authenticator-app</label>
                                        <input type="text" name="one_time_password" id="otp_disable"
                                            inputmode="numeric" maxlength="6" placeholder="000000"
                                            autocomplete="one-time-code" class="form-control" autofocus>
                                        @error('one_time_password')
                                            <div class="error">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div style="display:flex;gap:0.5rem;justify-content:flex-end;">
                                        <button type="button" onclick="document.getElementById('disable2faModal').classList.add('hidden')" class="btn btn-secondary">
                                            Annuleren
                                        </button>
                                        <button type="submit" class="btn btn-danger">
                                            Bevestigen
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                        @if($errors->has('one_time_password'))
                            <script>document.getElementById('disable2faModal').classList.remove('hidden');</script>
                        @endif
                    @else
                        <p class="form-section-hint">Beveilig je account met een authenticator-app.</p>
                        <a href="{{ route('2fa.setup') }}" class="btn btn-primary" style="margin-top: 1rem; display: inline-block;">
                            Inschakelen
                        </a>
                    @endif
                </div>
            </div>
        </x-user-dashboard-layout>
    </main>
    <div class="gradient-border"></div>
    <x-footer></x-footer>
      <div class="page-normal-background">
  </x-layout>
@else
  <x-dashboard-layout>

    @if(session('success'))
      <div class="flex items-center p-4 mb-4 text-sm text-green-800 rounded-lg bg-green-50 dark:bg-gray-800 dark:text-green-400" role="alert">
        <svg class="shrink-0 inline w-4 h-4 me-3" fill="currentColor" viewBox="0 0 20 20"><path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z"/></svg>
        {{ session('success') }}
      </div>
    @endif

    @if(session('error'))
      <div class="flex items-center p-4 mb-4 text-sm text-red-800 rounded-lg bg-red-50 dark:bg-gray-800 dark:text-red-400" role="alert">
        <svg class="shrink-0 inline w-4 h-4 me-3" fill="currentColor" viewBox="0 0 20 20"><path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z"/></svg>
        {{ session('error') }}
      </div>
    @endif

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-4">

      <div class="lg:col-span-2 space-y-4">

        {{-- Personal details --}}
        <div class="bg-white dark:bg-gray-800 rounded-lg shadow-sm border border-gray-200 dark:border-gray-700">
          <div class="p-4 border-b border-gray-200 dark:border-gray-700">
            <h2 class="text-lg font-semibold text-gray-900 dark:text-white">Profiel bijwerken</h2>
          </div>
          <form action="{{ route('updateProfile') }}" method="POST" class="p-4">
            @csrf
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 mb-4">
              <div>
                <label for="first_name" class="block mb-2 text-sm font-medium text-gray-700 dark:text-gray-300">Voornaam</label>
                <input type="text" name="first_name" id="first_name" value="{{ old('first_name', $user->first_name) }}"
                  class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:text-white @error('first_name') border-red-500 dark:border-red-500 @enderror" />
                @error('first_name')
                  <p class="mt-1 text-xs text-red-600 dark:text-red-400">{{ $message }}</p>
                @enderror
              </div>
              <div>
                <label for="last_name" class="block mb-2 text-sm font-medium text-gray-700 dark:text-gray-300">Achternaam</label>
                <input type="text" name="last_name" id="last_name" value="{{ old('last_name', $user->last_name) }}"
                  class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:text-white @error('last_name') border-red-500 dark:border-red-500 @enderror" />
                @error('last_name')
                  <p class="mt-1 text-xs text-red-600 dark:text-red-400">{{ $message }}</p>
                @enderror
              </div>
              <div class="sm:col-span-2">
                <label for="email" class="block mb-2 text-sm font-medium text-gray-700 dark:text-gray-300">E-mailadres</label>
                <input type="email" name="email" id="email" value="{{ old('email', $user->email) }}"
                  class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:text-white @error('email') border-red-500 dark:border-red-500 @enderror" />
                @error('email')
                  <p class="mt-1 text-xs text-red-600 dark:text-red-400">{{ $message }}</p>
                @enderror
              </div>
            </div>

            <div class="border-t border-gray-200 dark:border-gray-700 pt-4 mb-4">
              <h3 class="text-sm font-semibold text-gray-900 dark:text-white mb-1">Wachtwoord wijzigen</h3>
              <p class="text-xs text-gray-500 dark:text-gray-400 mb-4">Laat leeg om je huidige wachtwoord te behouden.</p>
              <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div>
                  <label for="password" class="block mb-2 text-sm font-medium text-gray-700 dark:text-gray-300">Nieuw wachtwoord</label>
                  <input type="password" name="password" id="password"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:text-white @error('password') border-red-500 dark:border-red-500 @enderror" />
                  @error('password')
                    <p class="mt-1 text-xs text-red-600 dark:text-red-400">{{ $message }}</p>
                  @enderror
                </div>
                <div>
                  <label for="password_confirmation" class="block mb-2 text-sm font-medium text-gray-700 dark:text-gray-300">Bevestig wachtwoord</label>
                  <input type="password" name="password_confirmation" id="password_confirmation"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:text-white" />
                </div>
              </div>
            </div>

            <div class="flex items-center gap-3">
              <button type="submit"
                class="text-white bg-primary-700 hover:bg-primary-800 focus:ring-4 focus:ring-primary-300 font-medium rounded-lg text-sm px-5 py-2.5 dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800">
                Opslaan
              </button>
            </div>
          </form>
        </div>

        {{-- 2FA card --}}
        @if(auth()->user()->role !== 'user')
        <div class="bg-white dark:bg-gray-800 rounded-lg shadow-sm border border-gray-200 dark:border-gray-700">
          <div class="p-4 border-b border-gray-200 dark:border-gray-700 flex items-center justify-between">
            <div>
              <h2 class="text-lg font-semibold text-gray-900 dark:text-white">Tweestapsverificatie</h2>
              <p class="text-xs text-gray-500 dark:text-gray-400 mt-0.5">Extra beveiliging via authenticator-app</p>
            </div>
            @if(auth()->user()->google2fa_secret)
              <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-xs font-medium bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-300">
                <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/></svg>
                Ingeschakeld
              </span>
            @else
              <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-medium bg-gray-100 text-gray-600 dark:bg-gray-700 dark:text-gray-400">
                Uitgeschakeld
              </span>
            @endif
          </div>
          <div class="p-4">
            @if(auth()->user()->google2fa_secret)
              <p class="text-sm text-gray-600 dark:text-gray-400 mb-4">Tweestapsverificatie is actief. Je authenticator-app is gekoppeld.</p>
              <button type="button" onclick="document.getElementById('disable2faModalAdmin').classList.remove('hidden')"
                class="text-white bg-red-600 hover:bg-red-700 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-sm px-4 py-2 dark:bg-red-700 dark:hover:bg-red-800 dark:focus:ring-red-900">
                Uitschakelen
              </button>

              {{-- 2FA disable modal --}}
              <div id="disable2faModalAdmin" class="hidden fixed inset-0 z-50 flex items-center justify-center bg-black/50">
                <div class="bg-white dark:bg-gray-800 rounded-xl shadow-lg p-6 w-full max-w-sm mx-4">
                  <h3 class="text-base font-semibold text-gray-900 dark:text-white mb-1">2FA uitschakelen</h3>
                  <p class="text-sm text-gray-500 dark:text-gray-400 mb-4">Voer de code uit je authenticator-app in om te bevestigen.</p>
                  <form action="{{ route('2fa.disable') }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <div class="mb-4">
                      <label for="otp_disable_admin" class="block mb-1.5 text-xs font-medium text-gray-700 dark:text-gray-300">Code uit authenticator-app</label>
                      <input type="text" name="one_time_password" id="otp_disable_admin"
                        inputmode="numeric" maxlength="6" placeholder="000000"
                        autocomplete="one-time-code"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:text-white @error('one_time_password') border-red-500 @enderror"
                        autofocus>
                      @error('one_time_password')
                        <p class="mt-1 text-xs text-red-600 dark:text-red-400">{{ $message }}</p>
                      @enderror
                    </div>
                    <div class="flex justify-end gap-2">
                      <button type="button" onclick="document.getElementById('disable2faModalAdmin').classList.add('hidden')"
                        class="px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-lg hover:bg-gray-50 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-600 dark:hover:bg-gray-600">
                        Annuleren
                      </button>
                      <button type="submit"
                        class="px-4 py-2 text-sm font-medium text-white bg-red-600 rounded-lg hover:bg-red-700 focus:ring-4 focus:ring-red-300 dark:bg-red-700 dark:hover:bg-red-800">
                        Bevestigen
                      </button>
                    </div>
                  </form>
                </div>
              </div>
              @if($errors->has('one_time_password'))
                <script>document.getElementById('disable2faModalAdmin').classList.remove('hidden');</script>
              @endif
            @else
              <p class="text-sm text-gray-600 dark:text-gray-400 mb-4">Beveilig je account met een authenticator-app zoals Google Authenticator of Authy.</p>
              <a href="{{ route('2fa.setup') }}"
                class="inline-block text-white bg-primary-700 hover:bg-primary-800 focus:ring-4 focus:ring-primary-300 font-medium rounded-lg text-sm px-4 py-2 dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800">
                Inschakelen
              </a>
            @endif
          </div>
        </div>
        @endif

      </div>

      {{-- Right: profile summary --}}
      <div>
        <div class="bg-white dark:bg-gray-800 rounded-lg shadow-sm border border-gray-200 dark:border-gray-700 p-4 text-center">
          <div class="w-16 h-16 rounded-full bg-blue-600 flex items-center justify-center mx-auto mb-3">
            <span class="text-2xl font-bold text-white">{{ strtoupper(substr($user->first_name, 0, 1)) }}</span>
          </div>
          <p class="text-sm font-semibold text-gray-900 dark:text-white">{{ $user->first_name }} {{ $user->last_name }}</p>
          <p class="text-xs text-gray-500 dark:text-gray-400 mb-3">{{ $user->email }}</p>
          <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium {{ $user->role === 'admin' ? 'bg-purple-100 text-purple-800 dark:bg-purple-900 dark:text-purple-300' : 'bg-blue-100 text-blue-800 dark:bg-blue-900 dark:text-blue-300' }}">
            {{ ucfirst($user->role) }}
          </span>
        </div>
      </div>

    </div>

  </x-dashboard-layout>
@endif
