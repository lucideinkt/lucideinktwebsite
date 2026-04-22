<x-layout :seo-data="$SEOData">
    <div class="page-normal-background">
    <main class="container page auth-page">
        <x-breadcrumbs :items="[
          ['label' => 'Home', 'url' => route('home')],
          ['label' => 'Wachtwoord resetten', 'url' => '#'],
        ]" />

        <div class="auth-card">
            <form action="{{ route('password.update') }}" method="POST" class="auth-form">
                @csrf
                <input type="hidden" name="token" value="{{ $token }}">

                <h2 class="auth-title">Wachtwoord resetten</h2>

                <div class="form-input">
                    <label for="email">E-mail <span class="required">*</span></label>
                    <input type="email" name="email" id="email" value="{{ old('email', request()->email) }}" class="form-control">
                    @error('email')
                        <div class="error">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-input">
                    <label for="password">Nieuw wachtwoord <span class="required">*</span></label>
                    <input type="password" name="password" id="password" class="form-control">
                    @error('password')
                        <div class="error">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-input">
                    <label for="password_confirmation">Bevestig wachtwoord <span class="required">*</span></label>
                    <input type="password" name="password_confirmation" id="password_confirmation" class="form-control">
                </div>

                <div class="form-input">
                    <button type="submit" class="btn-auth"><span class="loader"></span>Verzenden</button>
                </div>
            </form>
        </div>
    </main>

    <div class="gradient-border"></div>
    <x-footer></x-footer>
    </div>
</x-layout>
