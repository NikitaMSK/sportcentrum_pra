<?php

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;

uses(RefreshDatabase::class);

it('shows the login and account creation forms', function () {
    $this->get(route('login'))
        ->assertOk()
        ->assertSee('Inloggen')
        ->assertSee('bg-blue-50');

    $this->get(route('register'))
        ->assertOk()
        ->assertSee('Account aanmaken')
        ->assertSee('bg-blue-50');
});

it('requires the fields for login and account creation', function () {
    $this->post(route('login.store'))
        ->assertSessionHasErrors(['email', 'password']);

    $this->post(route('register.store'))
        ->assertSessionHasErrors(['name', 'email', 'password']);
});

it('creates an account and signs the new user in', function () {
    $response = $this->post(route('register.store'), [
        'name' => 'Nikita Moskalenko',
        'email' => 'nikita@example.com',
        'password' => 'secure-password',
        'password_confirmation' => 'secure-password',
    ]);

    $user = User::where('email', 'nikita@example.com')->firstOrFail();

    $response->assertRedirect(route('home'));
    $this->assertAuthenticatedAs($user);
    $this->assertModelExists($user);
    expect(Hash::check('secure-password', $user->password))->toBeTrue();
});

it('rejects account creation when the password confirmation does not match', function () {
    $this->from(route('register'))
        ->post(route('register.store'), [
            'name' => 'Nikita Moskalenko',
            'email' => 'nikita@example.com',
            'password' => 'secure-password',
            'password_confirmation' => 'different-password',
        ])
        ->assertRedirect(route('register'))
        ->assertSessionHasErrors([
            'password' => 'De wachtwoorden komen niet overeen.',
        ]);

    $this->assertDatabaseMissing('users', ['email' => 'nikita@example.com']);
});

it('rejects duplicate email addresses during account creation', function () {
    User::factory()->create(['email' => 'nikita@example.com']);

    $this->post(route('register.store'), [
        'name' => 'Nikita Moskalenko',
        'email' => 'nikita@example.com',
        'password' => 'secure-password',
        'password_confirmation' => 'secure-password',
    ])
        ->assertSessionHasErrors([
            'email' => 'Dit e-mailadres is al geregistreerd.',
        ]);

    $this->assertDatabaseCount('users', 1);
});

it('signs in an existing user with valid credentials', function () {
    $user = User::factory()->create([
        'email' => 'nikita@example.com',
        'password' => Hash::make('secure-password'),
    ]);

    $this->post(route('login.store'), [
        'email' => 'nikita@example.com',
        'password' => 'secure-password',
    ])
        ->assertRedirect(route('home'));

    $this->assertAuthenticatedAs($user);
});

it('rejects invalid login credentials', function () {
    User::factory()->create([
        'email' => 'nikita@example.com',
        'password' => Hash::make('secure-password'),
    ]);

    $this->from(route('login'))
        ->post(route('login.store'), [
            'email' => 'nikita@example.com',
            'password' => 'wrong-password',
        ])
        ->assertRedirect(route('login'))
        ->assertSessionHasErrors([
            'email' => 'De combinatie van e-mailadres en wachtwoord is onjuist.',
        ]);

    $this->assertGuest();
});

it('limits repeated login attempts', function () {
    $credentials = [
        'email' => 'nikita@example.com',
        'password' => 'wrong-password',
    ];

    foreach (range(1, 5) as $attempt) {
        $this->post(route('login.store'), $credentials);
    }

    $this->post(route('login.store'), $credentials)->assertTooManyRequests();
});

it('signs out the authenticated user', function () {
    $user = User::factory()->create();

    $this->actingAs($user)
        ->post(route('logout'))
        ->assertRedirect(route('login'));

    $this->assertGuest();
});
