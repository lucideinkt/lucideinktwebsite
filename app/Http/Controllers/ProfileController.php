<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    public function editPage()
    {
        $user = auth()->user();

        return view('profile.edit', ['user' => $user]);
    }

    public function updateProfile(Request $request)
    {
        if (!empty($request->password) || !empty($request->password_confirmation)) {
            $validated = $request->validate([
                'first_name' => 'required|string|max:255',
                'last_name' => 'required|string|max:255',
                'email' => 'required|email|unique:users,email,'.auth()->id(),
                'current_password' => ['required', 'string', function ($attribute, $value, $fail) {
                    if (!Hash::check($value, auth()->user()->password)) {
                        $fail('Het huidige wachtwoord is onjuist.');
                    }
                }],
                'password' => 'required|string|min:8|confirmed',
            ], [
                'first_name.required' => 'Voornaam is verplicht.',
                'last_name.required' => 'Achternaam is verplicht.',
                'email.required' => 'E-mailadres is verplicht.',
                'email.email' => 'Voer een geldig e-mailadres in.',
                'email.unique' => 'Dit e-mailadres is al in gebruik.',
                'current_password.required' => 'Het huidige wachtwoord is verplicht.',
                'password.required' => 'Nieuw wachtwoord is verplicht.',
                'password.min' => 'Wachtwoord moet minimaal 8 tekens bevatten.',
                'password.confirmed' => 'Wachtwoorden komen niet overeen.',
            ]);

            $user = auth()->user();
            $user->update([
                'first_name' => $validated['first_name'],
                'last_name' => $validated['last_name'],
                'email' => $validated['email'],
                'password' => Hash::make($validated['password']),
            ]);
        } else {
            $validated = $request->validate([
                'first_name' => 'required|string|max:255',
                'last_name' => 'required|string|max:255',
                'email' => 'required|email|unique:users,email,'.auth()->id()
            ], [
                'first_name.required' => 'Voornaam is verplicht.',
                'last_name.required' => 'Achternaam is verplicht.',
                'email.required' => 'E-mailadres is verplicht.',
                'email.email' => 'Voer een geldig e-mailadres in.',
            ]);

            $user = auth()->user();
            $user->update([
                'first_name' => $validated['first_name'],
                'last_name' => $validated['last_name'],
                'email' => $validated['email']
            ]);
        }


        return back()->with('success', __('Profiel is succesvol bijgewerkt!'));

    }
}
