<?php

namespace App\Http\Controllers;

use App\Models\Les;
use App\Models\Trainer;
use App\Models\User;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class TrainerPanelController extends Controller
{
    private function getTrainerOrAbort(): Trainer
    {
        $user = Auth::user();

        abort_unless($user instanceof User, 403);

        $trainer = $user->trainer;

        abort_unless($trainer instanceof Trainer, 403, 'Niet juiste naam');

        return $trainer;
    }

    /**
     * @return Collection<int, Les>
     */
    private function getUpcomingLessons(Trainer $trainer): Collection
    {
        return $trainer->lessen()
            ->whereDate('datum', '>=', today())
            ->withCount('aanmeldingen')
            ->orderBy('datum')
            ->orderBy('tijd')
            ->get();
    }

    public function index(): View
    {
        $trainer = $this->getTrainerOrAbort();
        $lessen = $this->getUpcomingLessons($trainer);
        $selectedLes = $lessen->first();

        if ($selectedLes !== null) {
            $selectedLes->load('aanmeldingen');
        }

        $lessenPerDag = $lessen->groupBy(
            fn (Les $les): string => $les->datum->toDateString()
        );

        return view('trainer.index', compact('trainer', 'lessenPerDag', 'lessen', 'selectedLes'));
    }

    public function showMembers(Les $les): View
    {
        $trainer = $this->getTrainerOrAbort();
        $selectedLes = $trainer->lessen()
            ->whereDate('datum', '>=', today())
            ->whereKey($les->getKey())
            ->with('aanmeldingen')
            ->withCount('aanmeldingen')
            ->firstOrFail();
        $lessen = $this->getUpcomingLessons($trainer);
        $lessenPerDag = $lessen->groupBy(
            fn (Les $upcomingLes): string => $upcomingLes->datum->toDateString()
        );

        return view('trainer.index', compact('trainer', 'lessenPerDag', 'lessen', 'selectedLes'));
    }
}
