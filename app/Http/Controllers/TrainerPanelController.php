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
    private function getTrainerOrAbort(): Trainer //De methode getTrainerOrAbort() controleert of de ingelogde gebruiker daadwerkelijk een trainer is
    {
        $user = Auth::user();

        abort_unless($user instanceof User, 403); //Met abort_unless() controleer ik of deze relatie bestaat en of het resultaat een Trainer-model is.

        $trainer = $user->trainer;

        abort_unless($trainer instanceof Trainer, 403, 'Niet juiste naam'); //Als de gebruiker geen trainer is, krijgt hij een 403 Forbidden-fout.

        return $trainer; //Als alle controles slagen, retourneer ik het Trainer-object
    }

    /**
     * @return Collection<int, Les>
     */
    private function getUpcomingLessons(Trainer $trainer): Collection //De methode getUpcomingLessons() haalt alle toekomstige lessen van een specifieke trainer op
    {
        return $trainer->lessen()
            ->whereDate('datum', '>=', today())
            ->withCount('aanmeldingen')
            ->orderBy('datum')
            ->withCount('aanmeldingen') //Met de relatie $trainer->lessen() krijg ik alleen de lessen die bij deze trainer horen.
            ->orderBy('datum') //Met whereDate('datum', '>=', today()) filter ik de lessen. Hierdoor worden lessen uit het verleden niet getoond
            ->orderBy('tijd')
            ->get(); //Met get() voer ik de databasequery uit en ontvang ik de resultaten als een Collection
    }

    public function index(): View //De index-methode bouwt het trainerdashboard op
    { 
        $trainer = $this->getTrainerOrAbort(); 
        $lessen = $this->getUpcomingLessons($trainer);
        $selectedLes = $lessen->first(); //Met $lessen->first() selecteer ik automatisch de eerste les uit het rooster

        if ($selectedLes !== null) {
            $selectedLes->load('aanmeldingen');
        }

        $lessenPerDag = $lessen->groupBy(
            fn (Les $les): string => $les->datum->toDateString()
        );

        return view('trainer.index', compact('trainer', 'lessenPerDag', 'lessen', 'selectedLes'));
    }

    public function showMembers(Les $les): View //De methode showMembers() toont de deelnemers van een geselecteerde les
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
