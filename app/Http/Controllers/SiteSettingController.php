<?php

namespace App\Http\Controllers;

use App\Services\SiteSettingService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class SiteSettingController extends Controller
{
    public function index()
    {
        $settings = SiteSettingService::all();

        return view('admin.site-settings', compact('settings'));
    }

    public function update(Request $request)
    {
        $validated = $request->validate([
            'maintenance_mode' => 'nullable|in:0,1',
            'mollie_mode'      => 'required|in:test,live',
            'mail_driver'      => 'required|in:smtp,mailtrap',
            'debug_info'       => 'nullable|in:0,1',
            'allow_indexing'   => 'nullable|in:0,1',
        ]);

        // Checkboxes default to 0 when unchecked
        $booleans = ['maintenance_mode', 'debug_info', 'allow_indexing'];
        foreach ($booleans as $key) {
            $validated[$key] = $request->has($key) ? '1' : '0';
        }

        foreach ($validated as $key => $value) {
            SiteSettingService::set($key, $value);
        }

        return back()->with('success', 'Instellingen opgeslagen.');
    }

    public function testMail(Request $request)
    {
        $to      = auth()->user()->email;
        $driver  = SiteSettingService::isMailtrap() ? 'Mailtrap' : 'Eigen SMTP';
        $host    = config('mail.mailers.smtp.host');
        $port    = config('mail.mailers.smtp.port');

        try {
            Mail::raw(
                "✅ Test e-mail succesvol verstuurd!\n\n"
                . "Driver: {$driver}\n"
                . "Host:   {$host}\n"
                . "Port:   {$port}\n"
                . "Naar:   {$to}\n"
                . "Tijd:   " . now()->format('d-m-Y H:i:s'),
                function ($message) use ($to, $driver) {
                    $message->to($to)
                            ->subject("✅ Mail test geslaagd — {$driver}");
                }
            );

            return back()->with('mail_test_success',
                "Test e-mail verstuurd via {$driver} naar {$to} (host: {$host}:{$port})."
            );

        } catch (\Throwable $e) {
            return back()->with('mail_test_error',
                "Verzenden mislukt via {$driver} ({$host}:{$port}): " . $e->getMessage()
            );
        }
    }
}

