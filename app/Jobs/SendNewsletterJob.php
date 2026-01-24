<?php

namespace App\Jobs;

use App\Mail\NewsletterMail;
use App\Models\Newsletter;
use App\Models\NewsletterSubscriber;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;

class SendNewsletterJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $newsletter;
    public $subscriber;

    public function __construct(Newsletter $newsletter, NewsletterSubscriber $subscriber)
    {
        $this->newsletter = $newsletter;
        $this->subscriber = $subscriber;
    }

    public function handle(): void
    {
        try {
            Mail::to($this->subscriber->email)->send(
                new NewsletterMail($this->newsletter, $this->subscriber)
            );

            // Increment sent count
            $this->newsletter->increment('sent_count');

            // Check if all jobs completed
            $this->checkNewsletterCompletion();
        } catch (\Exception $e) {
            // Increment failed count
            $this->newsletter->increment('failed_count');

            Log::error('Newsletter send failed', [
                'newsletter_id' => $this->newsletter->id,
                'subscriber_id' => $this->subscriber->id,
                'error' => $e->getMessage(),
            ]);

            // Check completion even on failure
            $this->checkNewsletterCompletion();

            // Re-throw to mark job as failed
            throw $e;
        }
    }

    protected function checkNewsletterCompletion(): void
    {
        // Refresh to get latest counts
        $this->newsletter->refresh();

        $totalProcessed = $this->newsletter->sent_count + $this->newsletter->failed_count;

        if ($totalProcessed >= $this->newsletter->recipients_count) {
            // All jobs completed
            if ($this->newsletter->failed_count === 0) {
                $this->newsletter->markAsSent();
            } else {
                $this->newsletter->markAsFailed();
            }

            // Clear cache when all done
            \Illuminate\Support\Facades\Artisan::call('cache:clear');
            \Illuminate\Support\Facades\Artisan::call('view:clear');

            Log::info('Newsletter campaign completed and cache cleared', [
                'newsletter_id' => $this->newsletter->id,
                'sent' => $this->newsletter->sent_count,
                'failed' => $this->newsletter->failed_count,
            ]);
        }
    }

    public function failed(\Throwable $exception): void
    {
        Log::error('Newsletter job failed completely', [
            'newsletter_id' => $this->newsletter->id,
            'subscriber_id' => $this->subscriber->id,
            'error' => $exception->getMessage(),
        ]);
    }
}
