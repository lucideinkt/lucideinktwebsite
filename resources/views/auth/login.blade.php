<x-layout :seo-data="$SEOData">
    <div class="page-normal-background">
    <main class="container page auth-page">

        <div class="auth-hero">
            <div class="container">
                <x-breadcrumbs :items="[
                  ['label' => 'Home', 'url' => route('home')],
                  ['label' => 'Inloggen', 'url' => route('login')],
                ]" />
            </div>
        </div>

        <div class="gradient-border auth-hero-border"></div>

        <div class="auth-content-section">
            <div class="auth-card">
                <h1 class="auth-hero__title">Inloggen</h1>
                <form action="{{ route('loginUser') }}" method="POST" class="auth-form">
                    @csrf
                    @if (session('success'))
                        <div class="alert alert-success">
                            <span class="alert-icon"><i class="fa-solid fa-circle-check"></i></span>
                            <span class="alert-text">{{ session('success') }}</span>
                            <button type="button" class="alert-close"
                                onclick="this.parentElement.style.display='none';">×</button>
                        </div>
                    @endif
                    @if (session('status'))
                        <div class="alert alert-success">
                            <span class="alert-icon"><i class="fa-solid fa-circle-check"></i></span>
                            <span class="alert-text">{{ session('status') }}</span>
                            <button type="button" class="alert-close"
                                onclick="this.parentElement.style.display='none';">×</button>
                        </div>
                    @endif
                    @if (session('error'))
                        <div class="alert alert-error">
                            <span class="alert-icon"><i class="fa-solid fa-circle-exclamation"></i></span>
                            <span class="alert-text">{{ session('error') }}</span>
                            <button type="button" class="alert-close"
                                onclick="this.parentElement.style.display='none';">×</button>
                        </div>
                    @endif
                    @if (session('no_right_link'))
                        <div class="alert alert-error">
                            {{ session('no_right_link') }}
                            <button type="button" class="alert-close"
                                onclick="this.parentElement.style.display='none';">&times;</button>
                        </div>
                    @endif

                    <div class="form-input">
                        <label for="email">E-mail <span class="required">*</span></label>
                        <input type="email" name="email" id="email" value="{{ old('email') }}" class="form-control">
                        @error('email')
                            <div class="error">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-input">
                        <label for="password">Wachtwoord <span class="required">*</span></label>
                        <input type="password" name="password" id="password" class="form-control"
                            autocomplete="current-password">
                        @error('password')
                            <div class="error">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="remember-me-box">
                        <input type="checkbox" class="remember-me" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                        <label for="remember">Onthoud mij</label>
                    </div>

                    <div class="form-input">
                        <button type="submit" class="btn-auth"><span class="loader"></span>Inloggen</button>
                    </div>

                    <div class="form-input forgot-password">
                        <span>Wachtwoord vergeten? <a href="{{ route('password.request') }}">Klik hier</a></span>
                    </div>
                </form>
            </div>
        </div>

    </main>

    <div class="gradient-border"></div>
    <x-footer></x-footer>
    </div>
</x-layout>
