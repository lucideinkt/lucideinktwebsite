@if(auth()->user()->role === 'user')
  <x-layout>
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
                {{ session('success') }}
                <button type="button" class="alert-close"
                    onclick="this.parentElement.style.display='none';">&times;</button>
            </div>
        @endif

        @if(session('error'))
            <div class="alert alert-error">
                {{ session('error') }}
                <button type="button" class="alert-close"
                    onclick="this.parentElement.style.display='none';">&times;</button>
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
        </x-user-dashboard-layout>
    </main>
    <div class="gradient-border"></div>
    <x-footer></x-footer>
  </x-layout>
@else
  <x-dashboard-layout>
    <main class="container page dashboard">
      <h2>Profiel bijwerken</h2>
      @if(session('success'))
        <div class="alert alert-success" style="position: relative;">
          {{ session('success') }}
          <button type="button" class="alert-close" onclick="this.parentElement.style.display='none';">&times;</button>
        </div>
      @endif

      <form action="{{ route('updateProfile') }}" method="POST" class="form profile">
        @csrf
        <div class="form-input">
          <label for="first_name">Voornaam</label>
          <input type="text" name="first_name" value="{{ $user->first_name }}">
          @error('first_name')
            <div class="error">{{ $message }}</div>
          @enderror
        </div>
        <div class="form-input">
          <label for="last_name">Achternaam</label>
          <input type="text" name="last_name" value="{{ $user->last_name }}">
          @error('last_name')
            <div class="error">{{ $message }}</div>
          @enderror
        </div>
        <div class="form-input">
          <label for="email">E-mail</label>
          <input type="email" name="email" value="{{ $user->email }}">
          @error('email')
            <div class="error">{{ $message }}</div>
          @enderror
        </div>

        <div class="form-input">
          <label for="password">Nieuw Wachtwoord</label>
          <input type="password" name="password">
          @error('password')
            <div class="error">{{ $message }}</div>
          @enderror
        </div>
        <div class="form-input">
          <label for="password_confirmation">Bevestig wachtwoord</label>
          <input type="password" name="password_confirmation">
        </div>

        <div class="form-input">
          <button type="submit" class="btn"><span class="loader"></span>Opslaan</button>
        </div>
      </form>

    </main>
  </x-dashboard-layout>
@endif
