@if(auth()->user()->role === 'user')
<x-layout :seo-data="null">
    <div class="page-normal-background">
    <main class="container page auth-page">

        <div class="auth-hero">
            <div class="container">
                <x-breadcrumbs :items="[
                  ['label' => 'Home', 'url' => route('home')],
                  ['label' => '2FA instellen', 'url' => '#'],
                ]" />
            </div>
            <h1 class="auth-hero__title">Tweestapsverificatie instellen</h1>
        </div>

        <div class="gradient-border auth-hero-border"></div>

        <div class="auth-content-section">
            <div class="auth-card" style="max-width: 480px;">
                <form action="{{ route('2fa.setup.store') }}" method="POST" class="auth-form">
                    @csrf

                    @if (session('error'))
                        <div class="alert alert-error">
                            <span class="alert-icon"><i class="fa-solid fa-circle-exclamation"></i></span>
                            <span class="alert-text">{{ session('error') }}</span>
                            <button type="button" class="alert-close" onclick="this.parentElement.style.display='none';">×</button>
                        </div>
                    @endif

                    <h2 class="auth-title">Stel 2FA in</h2>

                    <p style="margin-bottom: 1rem; color: var(--color-text-muted, #6b7280);">
                        Scan de QR-code met een authenticator-app (zoals Google Authenticator of Authy).
                    </p>

                    <div style="text-align: center; margin-bottom: 1.5rem;">
                        <img src="{{ $qrCode }}" alt="QR Code" style="width: 200px; height: 200px;">
                    </div>

                    <p style="margin-bottom: 1.5rem; font-size: 0.875rem; color: var(--color-text-muted, #6b7280);">
                        Kan je de QR-code niet scannen? Voer deze sleutel handmatig in:<br>
                        <strong style="letter-spacing: 0.1em; font-family: monospace;">{{ $secret }}</strong>
                    </p>

                    <div class="form-input">
                        <label for="one_time_password">Bevestig met code uit app <span class="required">*</span></label>
                        <input type="text" name="one_time_password" id="one_time_password"
                               inputmode="numeric" autocomplete="one-time-code"
                               maxlength="6" placeholder="000000"
                               class="form-control" autofocus>
                        @error('one_time_password')
                            <div class="error">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-input">
                        <button type="submit" class="btn-auth"><span class="loader"></span>Activeren</button>
                    </div>
                </form>
            </div>
        </div>

    </main>

    <div class="gradient-border"></div>
    <x-footer></x-footer>
    </div>
</x-layout>
@else
<x-dashboard-layout>

    @if (session('error'))
        <div class="flex items-center p-4 mb-4 text-sm text-red-800 rounded-lg bg-red-50 dark:bg-gray-800 dark:text-red-400" role="alert">
            <svg class="shrink-0 inline w-4 h-4 me-3" fill="currentColor" viewBox="0 0 20 20"><path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z"/></svg>
            {{ session('error') }}
        </div>
    @endif

    <div class="max-w-md mx-auto">
        <div class="bg-white dark:bg-gray-800 rounded-lg shadow-sm border border-gray-200 dark:border-gray-700">
            <div class="p-4 border-b border-gray-200 dark:border-gray-700">
                <h2 class="text-lg font-semibold text-gray-900 dark:text-white">Tweestapsverificatie instellen</h2>
                <p class="text-xs text-gray-500 dark:text-gray-400 mt-0.5">Scan de QR-code met een authenticator-app (zoals Google Authenticator of Authy).</p>
            </div>

            <form action="{{ route('2fa.setup.store') }}" method="POST" class="p-4">
                @csrf

                <div class="flex justify-center mb-4">
                    <img src="{{ $qrCode }}" alt="QR Code" class="w-48 h-48 rounded border border-gray-200 dark:border-gray-600">
                </div>

                <p class="text-sm text-gray-600 dark:text-gray-400 mb-4">
                    Kan je de QR-code niet scannen? Voer deze sleutel handmatig in:<br>
                    <code class="mt-1 inline-block text-xs font-mono tracking-widest bg-gray-100 dark:bg-gray-700 text-gray-900 dark:text-white px-2 py-1 rounded">{{ $secret }}</code>
                </p>

                <div class="mb-4">
                    <label for="one_time_password" class="block mb-2 text-sm font-medium text-gray-700 dark:text-gray-300">
                        Bevestig met code uit app <span class="text-red-500">*</span>
                    </label>
                    <input type="text" name="one_time_password" id="one_time_password"
                        inputmode="numeric" autocomplete="one-time-code"
                        maxlength="6" placeholder="000000" autofocus
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:text-white @error('one_time_password') border-red-500 dark:border-red-500 @enderror" />
                    @error('one_time_password')
                        <p class="mt-1 text-xs text-red-600 dark:text-red-400">{{ $message }}</p>
                    @enderror
                </div>

                <div class="flex items-center gap-3">
                    <button type="submit"
                        class="text-white bg-primary-700 hover:bg-primary-800 focus:ring-4 focus:ring-primary-300 font-medium rounded-lg text-sm px-5 py-2.5 dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800">
                        Activeren
                    </button>
                    <a href="{{ route('editProfile') }}" class="text-sm text-gray-500 hover:text-gray-700 dark:text-gray-400 dark:hover:text-gray-200">
                        Annuleren
                    </a>
                </div>
            </form>
        </div>
    </div>

</x-dashboard-layout>
@endif
