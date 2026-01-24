<?php

namespace App\Console\Commands;

use App\Models\Newsletter;
use Illuminate\Console\Command;

class UpdateNewsletterStatus extends Command
{
    protected $signature = 'newsletter:update-status';
    protected $description = 'Update newsletter status after queue jobs complete';

    public function handle()
    {
        $newsletters = Newsletter::where('status', 'sending')->get();

        foreach ($newsletters as $newsletter) {
            $totalSent = $newsletter->sent_count + $newsletter->failed_count;

            if ($totalSent >= $newsletter->recipients_count) {
                // All jobs completed
                if ($newsletter->failed_count === 0) {
                    $newsletter->markAsSent();
                    $this->info("Newsletter #{$newsletter->id} marked as sent");
                } else {
                    $newsletter->markAsFailed();
                    $this->warn("Newsletter #{$newsletter->id} marked as failed ({$newsletter->failed_count} failures)");
                }
            }
        }

        return 0;
    }
}
