<div class="contact-form-wrapper">
    @if (session()->has('contact-success'))
        <div class="alert alert-success" style="position: relative; margin-bottom: 24px;">
            {{ session('contact-success') }}
            <button type="button" class="alert-close" onclick="this.parentElement.style.display='none';">&times;</button>
        </div>
    @endif

    @if (session()->has('contact-error'))
        <div class="alert alert-error" style="position: relative; margin-bottom: 24px;">
            {{ session('contact-error') }}
            <button type="button" class="alert-close" onclick="this.parentElement.style.display='none';">&times;</button>
        </div>
    @endif

    <div class="contact-form-box">
        <form wire:submit.prevent="submit" class="contact-form">
            <div class="form-input">
                <label for="name">Naam <span class="required">*</span></label>
                <input type="text" id="name" wire:model.blur="name" autocomplete="name" placeholder="Voer uw naam in">
                @error('name')
                    <div class="error">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-input">
                <label for="email">E-mailadres <span class="required">*</span></label>
                <input type="email" id="email" wire:model.blur="email" autocomplete="email" placeholder="uw@email.nl">
                @error('email')
                    <div class="error">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-input">
                <label for="country">Land <span class="required">*</span></label>
                <select id="country" wire:model.blur="country">
                    <option value="">Selecteer een land</option>
                    <option value="Nederland">Nederland</option>
                    <option value="België">België</option>
                    <option value="Anders">Anders</option>
                </select>
                @error('country')
                    <div class="error">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-input">
                <label for="subject">Onderwerp <span class="required">*</span></label>
                <input type="text" id="subject" wire:model.blur="subject" placeholder="Voer het onderwerp in">
                @error('subject')
                    <div class="error">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-input">
                <label for="message">Bericht <span class="required">*</span></label>
                <textarea id="message" wire:model.blur="message" rows="6"
                    placeholder="Schrijf hier uw bericht..."></textarea>
                @error('message')
                    <div class="error">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-actions">
                <button type="submit" class="contact-submit-btn" wire:loading.attr="disabled" wire:target="submit">
                    <span wire:loading.remove wire:target="submit">
                        Verzenden
                    </span>
                    <span wire:loading wire:target="submit">
                        <i class="fa-solid fa-spinner fa-spin"></i> Verzenden...
                    </span>
                </button>
            </div>
        </form>
    </div>
</div>