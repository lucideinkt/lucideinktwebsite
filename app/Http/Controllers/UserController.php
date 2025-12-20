<?php

namespace App\Http\Controllers;

use App\Mail\NewUserMail;
use App\Models\User;
use App\Models\Customer;
use Illuminate\Http\Request;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use Illuminate\Support\Facades\Hash;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Mail;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'role:admin']);
    }

    public function index()
    {
        $this->authorize('viewAny', User::class);
        $users = User::paginate(10);
        return view('users.index', ['users' => $users]);
    }

    public function show(string $id)
    {
        $user = User::findOrFail($id);
        $this->authorize('view', $user);
        $customer = Customer::where('billing_email', $user->email)->with('orders')->first();
        return view('users.show', [
            'user' => $user,
            'customer' => $customer
        ]);
    }

    public function create()
    {
        $this->authorize('create', User::class);
        return view('users.create');
    }

    public function store(StoreUserRequest $request)
    {
        $validated = $request->validated();

        $user = User::create([
            'first_name' => $validated['first_name'],
            'last_name' => $validated['last_name'],
            'role' => $validated['user_role'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
        ]);

        // Fire the Registered event
        event(new Registered($user));

        // Send registration email
        Mail::to($user->email)->send(new NewUserMail($user));

        // Optionally log the user in
        // auth()->login($user);

        // Redirect to login page
        return redirect()->route('userIndex')->with('success', 'Nieuwe gebruiker is toegevoegd!');
    }

    public function update(UpdateUserRequest $request, string $id)
    {
        $user = User::findOrFail($id);
        $validated = $request->validated();

        $user->update(['role' => $validated['user_role']]);

        if ($user->role == 'user') {
            return redirect()->route('dashboard')->with('success',
                'Gebruiker '.$user->first_name.' '.$user->last_name.' is bijgewerkt.');
        } else {
            return back()->with('success', 'Gebruiker is bijgewerkt.');
        }
    }
}
