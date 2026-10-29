<?php

use App\Models\Les;
use App\Models\LesAanmelding;
use App\Models\Trainer;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;

uses(RefreshDatabase::class);

it('redirects guests to login when they open the trainer dashboard', function () {
    $this->get(route('trainer.index'))
        ->assertRedirect(route('login'));
});

it('shows a trainer their upcoming lessons and the selected participants', function () {
    $trainerUser = User::factory()->create(['name' => 'Robin Trainer']);
    $trainer = Trainer::create(['naam' => $trainerUser->name]);
    $lesson = Les::create([
        'datum' => today()->addDay(),
        'tijd' => '18:00:00',
        'activiteit' => 'Spinning',
        'trainer_id' => $trainer->id,
    ]);
    $participant = User::factory()->create(['name' => 'Sam Deelnemer']);
    $lesson->aanmeldingen()->attach($participant);

    $this->actingAs($trainerUser)
        ->get(route('trainer.index'))
        ->assertOk()
        ->assertSee('Spinning')
        ->assertSee('Sam Deelnemer')
        ->assertSee('Deelnemers: 1');
});

it('shows the selected lesson participants from its dedicated route', function () {
    $trainerUser = User::factory()->create(['name' => 'Robin Trainer']);
    $trainer = Trainer::create(['naam' => $trainerUser->name]);
    $lesson = Les::create([
        'datum' => today()->addDay(),
        'tijd' => '18:00:00',
        'activiteit' => 'Yoga',
        'trainer_id' => $trainer->id,
    ]);
    $participant = User::factory()->create(['name' => '<script>alert("xss")</script>']);
    $lesson->aanmeldingen()->attach($participant);

    $this->actingAs($trainerUser)
        ->get(route('trainer.members', $lesson))
        ->assertOk()
        ->assertSee('Yoga')
        ->assertSee('&lt;script&gt;', false)
        ->assertDontSee('<script>', false);
});

it('shows an empty state when the trainer has no upcoming lessons', function () {
    $trainerUser = User::factory()->create(['name' => 'Robin Trainer']);
    Trainer::create(['naam' => $trainerUser->name]);

    $this->actingAs($trainerUser)
        ->get(route('trainer.index'))
        ->assertOk()
        ->assertSee('Er staan geen komende lessen op je rooster.');
});

it('forbids a signed-in user who is not a trainer from opening the trainer dashboard', function () {
    $user = User::factory()->create(['name' => 'Geen Trainer']);

    $this->actingAs($user)
        ->get(route('trainer.index'))
        ->assertForbidden();
});

it('does not show another trainers lesson or participants', function () {
    $trainerUser = User::factory()->create(['name' => 'Robin Trainer']);
    Trainer::create(['naam' => $trainerUser->name]);
    $otherTrainer = Trainer::create(['naam' => 'Andere Trainer']);
    $lesson = Les::create([
        'datum' => today()->addDay(),
        'tijd' => '18:00:00',
        'activiteit' => 'Private Yoga',
        'trainer_id' => $otherTrainer->id,
    ]);

    $this->actingAs($trainerUser)
        ->get(route('trainer.members', $lesson))
        ->assertNotFound()
        ->assertDontSee('Private Yoga');
});

it('redirects a trainer to their dashboard after login', function () {
    $trainerUser = User::factory()->create([
        'name' => 'Robin Trainer',
        'password' => Hash::make('secret-password'),
    ]);
    Trainer::create(['naam' => $trainerUser->name]);

    $this->from(route('home'))
        ->post(route('login.store'), [
            'email' => $trainerUser->email,
            'password' => 'secret-password',
        ])
        ->assertRedirect(route('trainer.index'));

    $this->assertAuthenticatedAs($trainerUser);
});

it('redirects trainers from member pages to their dashboard', function () {
    $trainerUser = User::factory()->create(['name' => 'Robin Trainer']);
    Trainer::create(['naam' => $trainerUser->name]);

    $this->actingAs($trainerUser);

    foreach ([route('home'), route('lessen'), route('reserveringen')] as $memberPage) {
        $this->get($memberPage)
            ->assertRedirect(route('trainer.index'));
    }
});

it('prevents trainers from registering for lessons', function () {
    $trainerUser = User::factory()->create(['name' => 'Robin Trainer']);
    $trainer = Trainer::create(['naam' => $trainerUser->name]);
    $lesson = Les::create([
        'datum' => today()->addDay(),
        'tijd' => '18:00:00',
        'activiteit' => 'Spinning',
        'trainer_id' => $trainer->id,
    ]);

    $this->actingAs($trainerUser)
        ->post(route('lessen.aanmelden', $lesson))
        ->assertRedirect(route('trainer.index'));

    $this->assertDatabaseMissing('les_aanmeldingen', [
        'user_id' => $trainerUser->id,
        'les_id' => $lesson->id,
    ]);
});

it('allows regular users to register for lessons', function () {
    $user = User::factory()->create(['name' => 'Sam Deelnemer']);
    $trainer = Trainer::create(['naam' => 'Robin Trainer']);
    $lesson = Les::create([
        'datum' => today()->addDay(),
        'tijd' => '18:00:00',
        'activiteit' => 'Spinning',
        'trainer_id' => $trainer->id,
    ]);

    $this->actingAs($user)
        ->post(route('lessen.aanmelden', $lesson))
        ->assertRedirect(route('home'));

    $this->assertDatabaseHas('les_aanmeldingen', [
        'user_id' => $user->id,
        'les_id' => $lesson->id,
    ]);
});

it('prevents trainers from cancelling lesson registrations', function () {
    $trainerUser = User::factory()->create(['name' => 'Robin Trainer']);
    $trainer = Trainer::create(['naam' => $trainerUser->name]);
    $lesson = Les::create([
        'datum' => today()->addDay(),
        'tijd' => '18:00:00',
        'activiteit' => 'Spinning',
        'trainer_id' => $trainer->id,
    ]);
    $registration = LesAanmelding::create([
        'user_id' => $trainerUser->id,
        'les_id' => $lesson->id,
    ]);

    $this->actingAs($trainerUser)
        ->delete(route('reserveringen.annuleren', $registration))
        ->assertRedirect(route('trainer.index'));

    $this->assertModelExists($registration);
});
