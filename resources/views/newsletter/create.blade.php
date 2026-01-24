<x-dashboard-layout>
    <main class="container page dashboard">
        <div class="page-header">
            <div>
                <a href="{{ route('admin.newsletter.index') }}" class="btn btn-secondary mb-2">
                    <i class="fa-solid fa-arrow-left"></i> Terug naar overzicht
                </a>
                <h2>Nieuwe Abonnee Toevoegen</h2>
            </div>
        </div>

        <div class="form-card">
            <form action="{{ route('admin.newsletter.store') }}" method="POST">
                @csrf

                <div class="form-group">
                    <label for="email">E-mailadres <span class="required">*</span></label>
                    <input type="email"
                           id="email"
                           name="email"
                           value="{{ old('email') }}"
                           class="form-control @error('email') is-invalid @enderror"
                           placeholder="naam@voorbeeld.nl"
                           required>
                    @error('email')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-actions">
                    <button type="submit" class="btn btn-primary">
                        <i class="fa-solid fa-save"></i> Abonnee Toevoegen
                    </button>
                    <a href="{{ route('admin.newsletter.index') }}" class="btn btn-secondary">
                        <i class="fa-solid fa-times"></i> Annuleren
                    </a>
                </div>
            </form>
        </div>
    </main>
</x-dashboard-layout>
