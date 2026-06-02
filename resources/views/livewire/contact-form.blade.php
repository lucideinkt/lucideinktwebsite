<div class="contact-form-wrapper">

    <div class="contact-form-box">
        <h1 class="contact-hero__title">Neem Contact Op</h1>
        <p class="contact-form-subtitle">Neem contact op via het formulier hieronder en we reageren zo snel mogelijk.</p>


        <form wire:submit.prevent="submit" class="contact-form">
            <div class="form-row">
                <div class="form-input">
                    <label for="name">Naam <span class="required">*</span></label>
                    <div class="input-wrapper">
{{--                        <i class="fa-solid fa-user input-icon"></i>--}}
                        <input type="text" id="name" wire:model.blur="name" autocomplete="name">
                    </div>
                    @error('name')
                        <div class="error">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-input">
                    <label for="email">E-mailadres <span class="required">*</span></label>
                    <div class="input-wrapper">
{{--                        <i class="fa-solid fa-envelope input-icon"></i>--}}
                        <input type="email" id="email" wire:model.blur="email" autocomplete="email">
                    </div>
                    @error('email')
                        <div class="error">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="form-input">
                <label for="subject">Onderwerp <span class="required">*</span></label>
                <div class="input-wrapper">
{{--                    <i class="fa-solid fa-tag input-icon"></i>--}}
                    <input type="text" id="subject" wire:model.blur="subject">
                </div>
                @error('subject')
                    <div class="error">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-input">
                <label for="message">Bericht <span class="required">*</span></label>
                <div class="input-wrapper">
{{--                    <i class="fa-solid fa-message input-icon textarea-icon"></i>--}}
                    <textarea id="message" wire:model.blur="message" rows="6"></textarea>
                </div>
                @error('message')
                    <div class="error">{{ $message }}</div>
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
