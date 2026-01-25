<x-layout>
    <main class="container page auth-page">
        <x-breadcrumbs :items="[
          ['label' => 'Home', 'url' => route('home')],
          ['label' => 'Inloggen', 'url' => route('login')],
        ]" />

        <div class="auth-card">
            <form action="{{ route('loginUser') }}" method="POST" class="auth-form">
                @csrf
                @if (session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                        <button type="button" class="alert-close"
                            onclick="this.parentElement.style.display='none';">&times;</button>
                    </div>
                @endif
                @if (session('status'))
                    <div class="alert alert-success">
                        {{ session('status') }}
                        <button type="button" class="alert-close"
                            onclick="this.parentElement.style.display='none';">&times;</button>
                    </div>
                @endif
                @if (session('error'))
                    <div class="alert alert-error">
                        {{ session('error') }}
                        <button type="button" class="alert-close"
                            onclick="this.parentElement.style.display='none';">&times;</button>
                    </div>
                @endif

                @if (session('no_right_link'))
                    <div class="alert alert-error">
                        {{ session('no_right_link') }}
                        <button type="button" class="alert-close"
                            onclick="this.parentElement.style.display='none';">&times;</button>
                    </div>
                @endif

                <h2 class="auth-title">Welkom Terug</h2>

                <div class="form-input">
                    <label for="email">E-mail</label>
                    <input type="email" name="email" id="email" value="{{ old('email') }}" class="form-control">
                    @error('email')
                        <div class="error">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-input">
                    <label for="password">Wachtwoord</label>
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
    </main>

    <div class="gradient-border"></div>
    <x-footer></x-footer>
</x-layout>
