<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Mail\WelcomeBoutiqueMail;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'nom_commerce' => ['required', 'string', 'max:255'],
            'type_commerce' => ['required', 'string', 'in:boulangerie,restaurant,supermarche,hotel,autre'],
            'adresse_complete' => ['required', 'string'],
            'commune' => ['required', 'string', 'max:100'],
            'latitude' => ['nullable', 'numeric'],
            'longitude' => ['nullable', 'numeric'],
            'nom_gerant' => ['required', 'string', 'max:150'],
            'telephone' => ['required', 'string', 'regex:/^(70|75|76|77|78)[0-9]{7}$/', 'unique:'.User::class],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        $user = User::create([
            'nom_commerce' => $request->nom_commerce,
            'type_commerce' => $request->type_commerce,
            'adresse_complete' => $request->adresse_complete,
            'commune' => $request->commune,
            'latitude' => $request->latitude,
            'longitude' => $request->longitude,
            'nom_gerant' => $request->nom_gerant,
            'telephone' => $request->telephone,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'status' => 'en_attente',
            'is_verified' => false,
            'confirmation_token' => bin2hex(random_bytes(32)),
        ]);

        event(new Registered($user));

        // Envoi du mail de bienvenue
        Mail::to($user->email)->send(new WelcomeBoutiqueMail($user));

        Auth::login($user);

        return redirect(route('merci'));
    }
}
