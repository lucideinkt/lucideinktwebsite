<div class="contact-form-wrapper">
    <div class="contact-form-box">
        <div class="contact-form-header">
            <h2 class="contact-form-title">Neem Contact Op</h2>
            <p class="contact-form-subtitle">Vul het formulier in en we nemen zo snel mogelijk contact met je op</p>
        </div>

        <form wire:submit.prevent="submit" class="contact-form">
            <div class="form-row">
                <div class="form-input">
                    <label for="name">Naam <span class="required">*</span></label>
                    <div class="input-wrapper">
                        <i class="fa-solid fa-user input-icon"></i>
                        <input type="text" id="name" wire:model.blur="name" autocomplete="name" placeholder="Voer uw naam in">
                    </div>
                    @error('name')
                        <div class="error"><i class="fa-solid fa-circle-exclamation"></i> {{ $message }}</div>
                    @enderror
                </div>

                <div class="form-input">
                    <label for="email">E-mailadres <span class="required">*</span></label>
                    <div class="input-wrapper">
                        <i class="fa-solid fa-envelope input-icon"></i>
                        <input type="email" id="email" wire:model.blur="email" autocomplete="email" placeholder="uw@email.nl">
                    </div>
                    @error('email')
                        <div class="error"><i class="fa-solid fa-circle-exclamation"></i> {{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="form-input">
                <label for="subject">Onderwerp <span class="required">*</span></label>
                <div class="input-wrapper">
                    <i class="fa-solid fa-tag input-icon"></i>
                    <input type="text" id="subject" wire:model.blur="subject" placeholder="Voer het onderwerp in">
                </div>
                @error('subject')
                    <div class="error"><i class="fa-solid fa-circle-exclamation"></i> {{ $message }}</div>
                @enderror
            </div>

            <div class="form-input">
                <label for="message">Bericht <span class="required">*</span></label>
                <div class="input-wrapper">
                    <i class="fa-solid fa-message input-icon textarea-icon"></i>
                    <textarea id="message" wire:model.blur="message" rows="6"
                        placeholder="Schrijf hier uw bericht..."></textarea>
                </div>
                @error('message')
                    <div class="error"><i class="fa-solid fa-circle-exclamation"></i> {{ $message }}</div>
                @enderror
            </div>

            <div class="form-actions">
                <button type="submit" class="contact-submit-btn" wire:loading.attr="disabled" wire:target="submit">
                    <span wire:loading.remove wire:target="submit">
                        <i class="fa-solid fa-paper-plane"></i>
                        Verzenden
                    </span>
                    <span wire:loading wire:target="submit">
                        <i class="fa-solid fa-spinner fa-spin"></i>
                        Verzenden...
                    </span>
                </button>
            </div>
        </form>
    </div>
</div>
