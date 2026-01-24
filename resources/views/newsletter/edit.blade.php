<x-dashboard-layout>
    <main class="container page dashboard">
        <div class="page-header">
            <div>
                <a href="{{ route('admin.newsletter.index') }}" class="btn btn-secondary mb-2">
                    <i class="fa-solid fa-arrow-left"></i> Terug naar overzicht
                </a>
                <h2>Abonnee Bewerken</h2>
            </div>
        </div>

        <div class="form-card">
            <form action="{{ route('admin.newsletter.update', $subscriber->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="form-group">
                    <label for="email">E-mailadres <span class="required">*</span></label>
                    <input type="email"
                           id="email"
                           name="email"
                           value="{{ old('email', $subscriber->email) }}"
                           class="form-control @error('email') is-invalid @enderror"
                           required>
                    @error('email')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="status">Status <span class="required">*</span></label>
                    <select id="status"
                            name="status"
                            class="form-control @error('status') is-invalid @enderror"
                            required>
                        <option value="subscribed" {{ old('status', $subscriber->status) === 'subscribed' ? 'selected' : '' }}>
                            Ingeschreven
                        </option>
                        <option value="unsubscribed" {{ old('status', $subscriber->status) === 'unsubscribed' ? 'selected' : '' }}>
                            Uitgeschreven
                        </option>
                    </select>
                    @error('status')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="info-box">
                    <p><strong>Ingeschreven op:</strong> {{ $subscriber->subscribed_at ? $subscriber->subscribed_at->format('d-m-Y H:i') : '-' }}</p>
                    <p><strong>IP Adres:</strong> {{ $subscriber->ip_address ?? '-' }}</p>
                </div>

                <div class="form-actions">
                    <button type="submit" class="btn btn-primary">
                        <i class="fa-solid fa-save"></i> Opslaan
                    </button>
                    <a href="{{ route('admin.newsletter.index') }}" class="btn btn-secondary">
                        <i class="fa-solid fa-times"></i> Annuleren
                    </a>
                </div>
            </form>
        </div>
    </main>
</x-dashboard-layout>
