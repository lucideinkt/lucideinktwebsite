<?php

namespace App\Http\Controllers;

use App\Models\Newsletter;
use App\Models\NewsletterSubscriber;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class NewsletterCampaignController extends Controller
{
    public function index()
    {
        $newsletters = Newsletter::with('creator')
            ->latest()
            ->paginate(20)
            ->withQueryString();

        $stats = [
            'total'  => Newsletter::count(),
            'drafts' => Newsletter::where('status', 'draft')->count(),
            'sent'   => Newsletter::where('status', 'sent')->count(),
        ];

        return view('newsletter.campaigns.index', compact('newsletters', 'stats'));
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
            'subject'    => $validated['subject'],
            'content'    => $validated['content'],
            'created_by' => auth()->id(),
            'status'     => 'draft',
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
            'subject'    => $newsletter->subject . ' (kopie)',
            'content'    => $newsletter->content,
            'created_by' => auth()->id(),
            'status'     => 'draft',
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

        $newsletter->update([
            'status'       => 'draft',
            'sent_count'   => 0,
            'failed_count' => 0,
            'sent_at'      => null,
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
            'sent_count'       => 0,
            'failed_count'     => 0,
        ]);

        $newsletter->markAsSending();

        // Allow as much time as needed — the list may be large
        set_time_limit(0);
        ignore_user_abort(true);

        $sent   = 0;
        $failed = 0;

        foreach ($subscribers as $subscriber) {
            try {
                Mail::to($subscriber->email)->send(new \App\Mail\NewsletterMail($newsletter, $subscriber));
                $sent++;
            } catch (\Exception $e) {
                $failed++;
                \Illuminate\Support\Facades\Log::error('NewsletterMail failed for ' . $subscriber->email, [
                    'newsletter_id' => $newsletter->id,
                    'error'         => $e->getMessage(),
                ]);
            }
        }

        $newsletter->update([
            'sent_count'   => $sent,
            'failed_count' => $failed,
        ]);
        $newsletter->markAsSent();

        $message = "Nieuwsbrief verstuurd naar {$sent} abonnee(s).";
        if ($failed > 0) {
            $message .= " Mislukt bij {$failed} abonnee(s) — controleer de logs.";
        }

        return back()->with('success', $message);
    }
}
