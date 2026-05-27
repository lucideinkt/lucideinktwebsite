<?php

namespace App\Mail\Traits;

/**
 * Kept for backwards-compatibility only.
 * All mail routing is now controlled purely by MAIL_* env vars.
 * Both methods are intentional no-ops.
 */
trait HasMailtrapForwarding
{
    protected function addMailtrapForwarding($mail)
    {
        return $mail;
    }

    protected function getForwardingEmail(): ?string
    {
        return null;
    }
}
