<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;

class AuthenticatedSessionController extends Controller
{
    public function create(): View //De create-methode 
    {
        return view('auth.login');
    }
    
    public function store(Request $request): RedirectResponse  //in store-methode verwerk ik het loginformulier
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required', 'string'],
        ], [
            'email.required' => 'Vul je e-mailadres in.',
            'email.email' => 'Vul een geldig e-mailadres in.',
            'password.required' => 'Vul je wachtwoord in.',
        ]);

        if (! Auth::attempt($credentials, $request->boolean('remember'))) { //probeer om te inlogen
            throw ValidationException::withMessages([
                'email' => 'De combinatie van e-mailadres en wachtwoord is onjuist.',
            ]);
        } 
        //loginformulier verwerken en gebruiker authentiiceren.

        $request->session()->regenerate();

        $user = Auth::user();
        $user = Auth::user();  //Met Auth::attempt() controleer ik of de combinatie van het e-mailadres en wachtwoord correct is

        // Beheerder controleren
        $isBeheerder = DB::table('beheerders')
            ->where('user_id', $user->id)
            ->exists();

        if ($isBeheerder) {
            $request->session()->forget('url.intended');

            return redirect()->route('beheerder.index');
        }

        // Trainer controleren
        if ($user instanceof User && $user->isTrainer()) {
            $request->session()->forget('url.intended');

            return redirect()->route('trainer.index');
        }

        return redirect()->intended(route('home'));
    } 

    public function destroy(Request $request): RedirectResponse
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login');
    }
}
