<?php

namespace App\Http\Controllers;

use App\Jobs\SendNewsletterJob;
use App\Models\Newsletter;
use App\Models\NewsletterSubscriber;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;

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

        $subscribers = NewsletterSubscriber::subscribed()->get();

        if ($subscribers->isEmpty()) {
            return back()->with('error', 'Er zijn geen actieve abonnees om naar te verzenden.');
        }

        $newsletter->update([
            'recipients_count' => $subscribers->count(),
            'sent_count' => 0,
            'failed_count' => 0,
        ]);

        $newsletter->markAsSending();

        // Dispatch jobs to queue
        foreach ($subscribers as $subscriber) {
            SendNewsletterJob::dispatch($newsletter, $subscriber);
        }

        // Start queue worker in background (Windows compatible)
        if (strtoupper(substr(PHP_OS, 0, 3)) === 'WIN') {
            // Windows
            shell_exec('start /B php ' . base_path('artisan') . ' queue:work --stop-when-empty --tries=3 --timeout=60 > NUL 2>&1');
        } else {
            // Linux/Mac
            shell_exec('php ' . base_path('artisan') . ' queue:work --stop-when-empty --tries=3 --timeout=60 > /dev/null 2>&1 &');
        }

        return back()->with('success', "Nieuwsbrief wordt verstuurd naar {$subscribers->count()} abonnees! De verzending verloopt automatisch op de achtergrond.");
    }
}
