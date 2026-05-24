<x-layout :seo-data="null">
    <div class="page-normal-background">
    <main class="container page auth-page">

        <div class="auth-hero">
            <div class="container">
                <x-breadcrumbs :items="[
                  ['label' => 'Home', 'url' => route('home')],
                  ['label' => 'Inloggen', 'url' => route('login')],
                  ['label' => 'Verificatie', 'url' => '#'],
                ]" />
            </div>
            <h1 class="auth-hero__title">Tweestapsverificatie</h1>
        </div>

        <div class="gradient-border auth-hero-border"></div>

        <div class="auth-content-section">
            <div class="auth-card">
                <form action="{{ route('2fa.verify.store') }}" method="POST" class="auth-form">
                    @csrf

                    @if (session('error'))
                        <div class="alert alert-error">
                            <span class="alert-icon"><i class="fa-solid fa-circle-exclamation"></i></span>
                            <span class="alert-text">{{ session('error') }}</span>
                            <button type="button" class="alert-close" onclick="this.parentElement.style.display='none';">×</button>
                        </div>
                    @endif

                    <h2 class="auth-title">Voer je code in</h2>
                    <p style="margin-bottom: 1.5rem; color: var(--color-text-muted, #6b7280);">Open je authenticator-app en voer de 6-cijferige code in.</p>

                    <div class="form-input">
                        <label for="one_time_password">Verificatiecode <span class="required">*</span></label>
                        <input type="text" name="one_time_password" id="one_time_password"
                               inputmode="numeric" autocomplete="one-time-code"
                               maxlength="6" placeholder="000000"
                               class="form-control" autofocus>
                        @error('one_time_password')
                            <div class="error">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-input">
                        <button type="submit" class="btn-auth"><span class="loader"></span>Verifiëren</button>
                    </div>

                    <div class="form-input forgot-password">
                        <span>Niet jij? <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Uitloggen</a></span>
                    </div>
                </form>

                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display:none;">
                    @csrf
                </form>
            </div>
        </div>

    </main>

    <div class="gradient-border"></div>
    <x-footer></x-footer>
    </div>
</x-layout>
