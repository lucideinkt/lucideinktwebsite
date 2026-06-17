<div>
    <form wire:submit.prevent="submit" class="newsletter-form">
        <div class="newsletter-input-group">
            <input
                type="email"
                wire:model="email"
                placeholder="Jouw e-mailadres"
                class="newsletter-input @error('email') error @enderror"
            >
            <button type="submit" class="newsletter-btn" wire:loading.attr="disabled">
                <span wire:loading.remove wire:target="submit">Aanmelden</span>
                <span wire:loading wire:target="submit">
                    <i class="fa-solid fa-spinner fa-spin"></i> Verzenden...
                </span>
                <i class="fa-solid fa-paper-plane" wire:loading.remove wire:target="submit"></i>
            </button>
        </div>

        <label class="newsletter-consent">
            <input type="checkbox" wire:model="consent" class="newsletter-consent__checkbox">
            <span class="newsletter-consent__label">Ja, ik wil de nieuwsbrief ontvangen met updates en aanbiedingen.</span>
        </label>
        @error('consent')
            <p class="newsletter-error newsletter-error--consent">
                <i class="fa-solid fa-triangle-exclamation"></i> {{ $message }}
            </p>
        @enderror

        @error('email')
            <p class="newsletter-error newsletter-error--email">
                <i class="fa-solid fa-triangle-exclamation"></i> {{ $message }}
            </p>
        @enderror

        @if($statusMessage)
            <p class="newsletter-status-message newsletter-status-message--{{ $statusType }}">
                @if($statusType === 'success')
                    <i class="fa-solid fa-circle-check"></i>
                @elseif($statusType === 'info')
                    <i class="fa-solid fa-circle-info"></i>
                @else
                    <i class="fa-solid fa-circle-exclamation"></i>
                @endif
                {{ $statusMessage }}
            </p>
        @endif

        <p class="newsletter-privacy">
            We respecteren je privacy. Je kunt je op elk moment afmelden.
        </p>
    </form>
</div>
