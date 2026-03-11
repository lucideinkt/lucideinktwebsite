<x-layout>
  <main class="container page auth-page">
    <x-breadcrumbs :items="[
      ['label' => 'Home', 'url' => route('home')],
      ['label' => 'Wachtwoord vergeten', 'url' => route('password.request')],
    ]" />

    <div class="auth-card">
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
        @if(session('error'))
          <div class="alert alert-error">
            <span class="alert-icon"><i class="fa-solid fa-circle-exclamation"></i></span>
            <span class="alert-text">{{ session('error') }}</span>
            <button type="button" class="alert-close" onclick="this.parentElement.style.display='none';">×</button>
          </div>
        @endif

        <h2 class="auth-title">Wachtwoord vergeten</h2>

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
  </main>

  <div class="gradient-border"></div>
  <x-footer></x-footer>
</x-layout>
