<?php

namespace App\Http\Controllers;

use App\Models\Les;
use App\Models\LesAanmelding;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LesController extends Controller
{
    public function index()
    {
        $lessen = Les::with('trainer')->get();

        return view('home', compact('lessen'));
    }

    public function aanmelden(Request $request, Les $les)
    {
        if (!Auth::check()) {
            return redirect()->route('login')
                ->with('error', 'Log eerst in om je aan te melden.');
        }

        $bestaatAl = LesAanmelding::where('user_id', Auth::id())
            ->where('les_id', $les->id)
            ->exists();

        if ($bestaatAl) {
            return redirect()->route('home')
                ->with('error', 'Je bent al aangemeld voor deze les.');
        }

        LesAanmelding::create([
            'user_id' => Auth::id(),
            'les_id' => $les->id,
        ]);

        return redirect()->route('home')
            ->with('success', 'Je bent aangemeld voor de les!');
    }

    public function reserveringen()
    {
        $aanmeldingen = LesAanmelding::with('les.trainer')
            ->where('user_id', Auth::id())
            ->get();

        return view('reserveringen', compact('aanmeldingen'));
    }

    public function annuleren(LesAanmelding $aanmelding)
    {
        if ($aanmelding->user_id !== Auth::id()) {
            abort(403);
        }

        $aanmelding->delete();

        return redirect()->route('reserveringen')
            ->with('success', 'Je reservering is geannuleerd.');
    }
}
