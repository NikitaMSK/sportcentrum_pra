<?php

namespace App\Http\Controllers;

use App\Models\Les;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class BeheerderPanelController extends Controller
{
    private function controleerBeheerder(): User
    {
        $user = Auth::user();

        abort_unless($user instanceof User, 403);

        $isBeheerder = DB::table('beheerders')
            ->where('user_id', $user->id)
            ->exists();

        abort_unless($isBeheerder, 403, 'Geen toegang tot het beheerderpaneel.');

        return $user;
    }

    public function index(): View
    {
        $beheerder = $this->controleerBeheerder();

        $lessen = Les::with('trainer')
            ->withCount('aanmeldingen')
            ->whereDate('datum', '>=', today())
            ->orderBy('datum')
            ->orderBy('tijd')
            ->get();

        $lessenPerDag = $lessen->groupBy(
            fn (Les $les): string => $les->datum->toDateString()
        );

        $aantalLessen = $lessen->count();

        $lessenVandaag = $lessen->filter(
            fn (Les $les): bool => $les->datum->isToday()
        )->count();

        return view('beheerder.index', compact(
            'beheerder',
            'lessen',
            'lessenPerDag',
            'aantalLessen',
            'lessenVandaag'
        ));
    }
}
