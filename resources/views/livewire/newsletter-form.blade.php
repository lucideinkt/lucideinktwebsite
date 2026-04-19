<div>
    <form wire:submit.prevent="submit" class="newsletter-form">
        <div class="newsletter-input-group">
            <input style="border: 1px solid rgba(236, 229, 194, 0.3)!important;outline: none!important;box-shadow: none!important;"
                type="email"
                wire:model="email"
                placeholder="Uw e-mailadres"
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
        @error('email')
            <p class="newsletter-error" style="color: #dc3545; margin-top: 0.5rem; font-size: 0.875rem;">{{ $message }}</p>
        @enderror
        <p class="newsletter-privacy">
            We respecteren je privacy. Je kunt je op elk moment afmelden.
        </p>
    </form>
</div>
