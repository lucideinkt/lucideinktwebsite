<?php

namespace App\Mail\Traits;

/**
 * Kept for backwards compatibility — forwarding is no longer used.
 * Mail driver is determined purely by APP_ENV (production = own SMTP, other = Mailtrap).
 */
trait HasMailtrapForwarding
{
    protected function addMailtrapForwarding($mail)
    {
        // No forwarding — kept as no-op so all Mailable build() methods still compile
        return $mail;
    }
}
