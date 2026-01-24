<?php

namespace App\Http\Controllers;

use App\Models\NewsletterSubscriber;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class NewsletterController extends Controller
{
    public function subscribe(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email|max:255',
        ]);

        if ($validator->fails()) {
            return back()->with('error', 'Voer alstublieft een geldig e-mailadres in.');
        }

        $email = $request->email;

        // Check if already subscribed
        $existing = NewsletterSubscriber::where('email', $email)->first();

        if ($existing) {
            if ($existing->isSubscribed()) {
                return back()->with('info', 'Dit e-mailadres is al ingeschreven voor onze nieuwsbrief.');
            } else {
                // Resubscribe
                $existing->subscribe();
                return back()->with('success', 'Welkom terug! U bent opnieuw ingeschreven voor onze nieuwsbrief.');
            }
        }

        // Create new subscriber
        NewsletterSubscriber::create([
            'email' => $email,
            'status' => 'subscribed',
            'subscribed_at' => now(),
            'ip_address' => $request->ip(),
            'user_agent' => $request->userAgent(),
        ]);

        return back()->with('success', 'Bedankt voor uw inschrijving! U ontvangt binnenkort updates van ons.');
    }

    public function unsubscribe($token)
    {
        $subscriber = NewsletterSubscriber::where('token', $token)->firstOrFail();

        if ($subscriber->isSubscribed()) {
            $subscriber->unsubscribe();
            $message = 'U bent succesvol uitgeschreven van onze nieuwsbrief.';
        } else {
            $message = 'U was al uitgeschreven van onze nieuwsbrief.';
        }

        return view('newsletter.unsubscribe', compact('message'));
    }
}
