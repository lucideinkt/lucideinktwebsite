<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use PragmaRX\Google2FAQRCode\Google2FA;

class TwoFactorController extends Controller
{
    private Google2FA $google2fa;

    public function __construct()
    {
        $this->google2fa = new Google2FA();
    }

    public function setup()
    {
        $user = auth()->user();

        if ($user->google2fa_secret) {
            return redirect()->route('2fa.verify');
        }

        $secret = session('2fa_setup_secret') ?: $this->google2fa->generateSecretKey();
        session(['2fa_setup_secret' => $secret]);

        $qrCode = $this->google2fa->getQRCodeInline(
            config('app.name'),
            $user->email,
            $secret
        );

        return view('auth.2fa-setup', compact('secret', 'qrCode'));
    }

    public function setupStore(Request $request)
    {
        $request->validate([
            'one_time_password' => 'required|digits:6',
        ], [
            'one_time_password.required' => 'Code is verplicht.',
            'one_time_password.digits'   => 'Code moet 6 cijfers bevatten.',
        ]);

        $secret = $request->session()->get('2fa_setup_secret');

        if (!$secret) {
            return redirect()->route('2fa.setup')->with('error', 'Setup sessie verlopen. Probeer opnieuw.');
        }

        $valid = $this->google2fa->verifyKey($secret, $request->one_time_password);

        if (!$valid) {
            return back()->with('error', 'Ongeldige code. Probeer opnieuw.');
        }

        auth()->user()->forceFill(['google2fa_secret' => $secret])->save();
        $request->session()->forget('2fa_setup_secret');
        $request->session()->put('2fa_verified', true);

        return redirect()->route('editProfile')->with('success', 'Tweestapsverificatie is ingeschakeld.');
    }

    public function verify(Request $request)
    {
        $user = auth()->user();

        if (!$user->google2fa_secret) {
            return redirect()->route('2fa.setup');
        }

        if ($request->session()->get('2fa_verified')) {
            return redirect()->route('dashboard');
        }

        return view('auth.2fa-verify');
    }

    public function verifyStore(Request $request)
    {
        $request->validate([
            'one_time_password' => 'required|digits:6',
        ], [
            'one_time_password.required' => 'Code is verplicht.',
            'one_time_password.digits'   => 'Code moet 6 cijfers bevatten.',
        ]);

        $user = auth()->user();
        $valid = $this->google2fa->verifyKey($user->google2fa_secret, $request->one_time_password);

        if (!$valid) {
            return back()->with('error', 'Ongeldige code. Probeer opnieuw.');
        }

        $request->session()->put('2fa_verified', true);

        $intended = session()->pull('url.intended');
        $appHost  = parse_url(config('app.url'), PHP_URL_HOST);
        $safe     = $intended && parse_url($intended, PHP_URL_HOST) === $appHost;

        return redirect($safe ? $intended : route('dashboard'));
    }

    public function disable(Request $request)
    {
        $request->validate([
            'one_time_password' => 'required|digits:6',
        ], [
            'one_time_password.required' => 'Code is verplicht.',
            'one_time_password.digits'   => 'Code moet 6 cijfers bevatten.',
        ]);

        $user = auth()->user();
        $valid = $this->google2fa->verifyKey($user->google2fa_secret, $request->one_time_password);

        if (!$valid) {
            return redirect()->route('editProfile')->with('error', 'Ongeldige code. 2FA niet uitgeschakeld.');
        }

        $user->forceFill(['google2fa_secret' => null])->save();
        $request->session()->forget('2fa_verified');

        return redirect()->route('editProfile')->with('success', 'Tweestapsverificatie is uitgeschakeld.');
    }
}
