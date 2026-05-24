<x-layout :seo-data="$SEOData">
    <div class="page-normal-background">
    <main class="container page auth-page">

        <div class="auth-hero">
            <div class="container">
                <x-breadcrumbs :items="[
                  ['label' => 'Home', 'url' => route('home')],
                  ['label' => 'Wachtwoord vergeten', 'url' => route('password.request')],
                ]" />
            </div>
        </div>

        <div class="gradient-border auth-hero-border"></div>

        <div class="auth-content-section">
            <div class="auth-card">
                <h1 class="auth-hero__title">Wachtwoord vergeten?</h1>
                <form action="{{ route('password.email') }}" method="POST" class="auth-form">
                    @csrf
                    @if (session('success'))
                        <div class="alert alert-success">
                            <span class="alert-icon"><i class="fa-solid fa-circle-check"></i></span>
                            <span class="alert-text">{{ session('success') }}</span>
                            <button type="button" class="alert-close"
                                onclick="this.parentElement.style.display='none';">×</button>
                        </div>
                    @endif
                    @if (session('error'))
                        <div class="alert alert-error">
                            <span class="alert-icon"><i class="fa-solid fa-circle-exclamation"></i></span>
                            <span class="alert-text">{{ session('error') }}</span>
                            <button type="button" class="alert-close" onclick="this.parentElement.style.display='none';">×</button>
                        </div>
                    @endif

                    <p style="text-align: center; max-width: 350px;margin: 0 auto;margin-bottom: 20px">Vul je e-mailadres in om een wachtwoord-resetlink te ontvangen</p>

                    <div class="form-input">
                        <label for="email">E-mail <span class="required">*</span></label>
                        <input type="email" name="email" id="email" value="{{ old('email') }}" class="form-control">
                        @error('email')
                            <div class="error">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-input">
                        <button type="submit" class="btn-auth"><span class="loader"></span>Verzenden</button>
                    </div>

                    <div class="form-input back-link">
                        <span><a href="{{ route('login') }}">Terug naar inloggen</a></span>
                    </div>
                </form>
            </div>
        </div>

    </main>

    <div class="gradient-border"></div>
    <x-footer></x-footer>
    </div>
</x-layout>
