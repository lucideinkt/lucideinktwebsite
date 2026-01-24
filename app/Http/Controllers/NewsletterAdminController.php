<?php

namespace App\Http\Controllers;

use App\Models\NewsletterSubscriber;
use Illuminate\Http\Request;

class NewsletterAdminController extends Controller
{
    public function index(Request $request)
    {
        $query = NewsletterSubscriber::query();

        // Filter by status
        if ($request->has('status') && in_array($request->status, ['subscribed', 'unsubscribed'])) {
            $query->where('status', $request->status);
        }

        // Search by email
        if ($request->has('search') && $request->search) {
            $query->where('email', 'like', '%' . $request->search . '%');
        }

        $subscribers = $query->latest()->paginate(20);

        $stats = [
            'total' => NewsletterSubscriber::count(),
            'subscribed' => NewsletterSubscriber::subscribed()->count(),
            'unsubscribed' => NewsletterSubscriber::unsubscribed()->count(),
        ];

        return view('newsletter.admin', compact('subscribers', 'stats'));
    }

    public function create()
    {
        return view('newsletter.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'email' => 'required|email|unique:newsletter_subscribers,email',
        ], [
            'email.required' => 'E-mailadres is verplicht.',
            'email.email' => 'Voer een geldig e-mailadres in.',
            'email.unique' => 'Dit e-mailadres is al ingeschreven.',
        ]);

        NewsletterSubscriber::create([
            'email' => $validated['email'],
            'status' => 'subscribed',
            'subscribed_at' => now(),
            'ip_address' => $request->ip(),
        ]);

        return redirect()
            ->route('admin.newsletter.index')
            ->with('success', 'Abonnee succesvol toegevoegd.');
    }

    public function edit($id)
    {
        $subscriber = NewsletterSubscriber::findOrFail($id);
        return view('newsletter.edit', compact('subscriber'));
    }

    public function update(Request $request, $id)
    {
        $subscriber = NewsletterSubscriber::findOrFail($id);

        $validated = $request->validate([
            'email' => 'required|email|unique:newsletter_subscribers,email,' . $id,
            'status' => 'required|in:subscribed,unsubscribed',
        ], [
            'email.required' => 'E-mailadres is verplicht.',
            'email.email' => 'Voer een geldig e-mailadres in.',
            'email.unique' => 'Dit e-mailadres is al in gebruik.',
        ]);

        $subscriber->update([
            'email' => $validated['email'],
            'status' => $validated['status'],
        ]);

        return redirect()
            ->route('admin.newsletter.index')
            ->with('success', 'Abonnee succesvol bijgewerkt.');
    }

    public function toggleStatus($id)
    {
        $subscriber = NewsletterSubscriber::findOrFail($id);

        if ($subscriber->isSubscribed()) {
            $subscriber->unsubscribe();
            $message = 'Abonnee uitgeschreven.';
        } else {
            $subscriber->subscribe();
            $message = 'Abonnee opnieuw ingeschreven.';
        }

        return back()->with('success', $message);
    }

    public function destroy($id)
    {
        $subscriber = NewsletterSubscriber::findOrFail($id);
        $subscriber->delete();

        return back()->with('success', 'Abonnee succesvol verwijderd.');
    }

    public function bulkDelete(Request $request)
    {
        $validated = $request->validate([
            'ids' => 'required|array',
            'ids.*' => 'exists:newsletter_subscribers,id',
        ]);

        NewsletterSubscriber::whereIn('id', $validated['ids'])->delete();

        return back()->with('success', count($validated['ids']) . ' abonnee(s) succesvol verwijderd.');
    }

    public function export()
    {
        $subscribers = NewsletterSubscriber::subscribed()
            ->select('email', 'subscribed_at')
            ->get();

        $filename = 'newsletter_subscribers_' . date('Y-m-d') . '.csv';

        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => 'attachment; filename="' . $filename . '"',
        ];

        $callback = function() use ($subscribers) {
            $file = fopen('php://output', 'w');

            // Add BOM for UTF-8
            fprintf($file, chr(0xEF).chr(0xBB).chr(0xBF));

            // Add headers
            fputcsv($file, ['Email', 'Ingeschreven op']);

            // Add data
            foreach ($subscribers as $subscriber) {
                fputcsv($file, [
                    $subscriber->email,
                    $subscriber->subscribed_at->format('d-m-Y H:i'),
                ]);
            }

            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }
}
