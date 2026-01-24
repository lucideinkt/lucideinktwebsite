<?php

namespace App\Http\Controllers;

use App\Jobs\SendNewsletterJob;
use App\Models\Newsletter;
use App\Models\NewsletterSubscriber;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Mail;

class NewsletterCampaignController extends Controller
{
    public function index()
    {
        $newsletters = Newsletter::with('creator')
            ->latest()
            ->paginate(20);

        return view('newsletter.campaigns.index', compact('newsletters'));
    }

    public function create()
    {
        return view('newsletter.campaigns.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'subject' => 'required|string|max:255',
            'content' => 'required|string',
        ]);

        $newsletter = Newsletter::create([
            'subject' => $validated['subject'],
            'content' => $validated['content'],
            'created_by' => auth()->id(),
            'status' => 'draft',
        ]);

        return redirect()
            ->route('newsletter.campaigns.show', $newsletter)
            ->with('success', 'Nieuwsbrief concept opgeslagen!');
    }

    public function show(Newsletter $newsletter)
    {
        $newsletter->load('creator');
        $subscribersCount = NewsletterSubscriber::subscribed()->count();

        return view('newsletter.campaigns.show', compact('newsletter', 'subscribersCount'));
    }

    public function edit(Newsletter $newsletter)
    {
        if (!$newsletter->isDraft()) {
            return back()->with('error', 'Alleen concept nieuwsbrieven kunnen worden bewerkt.');
        }

        return view('newsletter.campaigns.edit', compact('newsletter'));
    }

    public function update(Request $request, Newsletter $newsletter)
    {
        if (!$newsletter->isDraft()) {
            return back()->with('error', 'Alleen concept nieuwsbrieven kunnen worden bewerkt.');
        }

        $validated = $request->validate([
            'subject' => 'required|string|max:255',
            'content' => 'required|string',
        ]);

        $newsletter->update($validated);

        return redirect()
            ->route('newsletter.campaigns.show', $newsletter)
            ->with('success', 'Nieuwsbrief bijgewerkt!');
    }

    public function destroy(Newsletter $newsletter)
    {
        // Allow deleting drafts always, and sent/failed campaigns optionally
        if ($newsletter->isDraft() || in_array($newsletter->status, ['sent', 'failed'])) {
            $newsletter->delete();
            return redirect()
                ->route('newsletter.campaigns.index')
                ->with('success', 'Nieuwsbrief verwijderd.');
        }

        return back()->with('error', 'Deze nieuwsbrief kan niet worden verwijderd.');
    }

    public function duplicate(Newsletter $newsletter)
    {
        $newNewsletter = Newsletter::create([
            'subject' => $newsletter->subject . ' (kopie)',
            'content' => $newsletter->content,
            'created_by' => auth()->id(),
            'status' => 'draft',
        ]);

        return redirect()
            ->route('newsletter.campaigns.edit', $newNewsletter)
            ->with('success', 'Nieuwsbrief gedupliceerd! Je kunt deze nu bewerken.');
    }

    public function resend(Newsletter $newsletter)
    {
        if ($newsletter->status !== 'failed') {
            return back()->with('error', 'Alleen mislukte nieuwsbrieven kunnen opnieuw worden verzonden.');
        }

        // Reset to draft status
        $newsletter->update([
            'status' => 'draft',
            'sent_count' => 0,
            'failed_count' => 0,
            'sent_at' => null,
        ]);

        return redirect()
            ->route('newsletter.campaigns.show', $newsletter)
            ->with('success', 'Nieuwsbrief gereset naar concept. Je kunt deze nu opnieuw versturen.');
    }

    public function send(Newsletter $newsletter)
    {
        if (!$newsletter->isDraft()) {
            return back()->with('error', 'Deze nieuwsbrief is al verstuurd of wordt momenteel verstuurd.');
        }

        $subscribers = \App\Models\NewsletterSubscriber::subscribed()->get();

        if ($subscribers->isEmpty()) {
            return back()->with('error', 'Er zijn geen actieve abonnees om naar te verzenden.');
        }

        $newsletter->update([
            'recipients_count' => $subscribers->count(),
            'sent_count' => 0,
            'failed_count' => 0,
        ]);

        $newsletter->markAsSending();

        $sent = 0;
        $failed = 0;

        foreach ($subscribers as $subscriber) {
            try {
                Mail::to($subscriber->email)->queue(new \App\Mail\NewsletterMail($newsletter, $subscriber));
                $sent++;
            } catch (\Exception $e) {
                $failed++;
                // \Log::error($e);
            }
        }

        $newsletter->update([
            'sent_count' => $sent,
            'failed_count' => $failed,
        ]);
        $newsletter->markAsSent();

        return back()->with('success', "Nieuwsbrief is in de queue gezet voor {$sent} abonnees. Mislukt bij {$failed}.");
    }
}
