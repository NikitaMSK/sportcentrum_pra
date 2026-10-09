@extends('auth.layout')

@section('title', 'Account aanmaken')
@section('eyebrow', 'Account aanmaken')

@section('content')
    <h2 class="mb-7 text-center text-2xl font-bold text-blue-900">Account aanmaken</h2>

    <form method="POST" action="{{ route('register.store') }}" class="space-y-5">
        @csrf

        <div class="space-y-2">
            <label for="name" class="block text-sm font-semibold text-blue-900">Naam</label>
            <input
                id="name"
                name="name"
                type="text"
                value="{{ old('name') }}"
                required
                autofocus
                autocomplete="name"
                @error('name') aria-invalid="true" aria-describedby="name-error" @enderror
                class="w-full rounded-lg border border-blue-300 bg-white px-4 py-3 text-blue-950 placeholder-blue-400 outline-none transition focus:border-blue-700 focus:ring-2 focus:ring-blue-200"
                placeholder="Je naam">
            @error('name')
                <p id="name-error" class="text-sm font-medium text-blue-800">{{ $message }}</p>
            @enderror
        </div>

        <div class="space-y-2">
            <label for="email" class="block text-sm font-semibold text-blue-900">E-mailadres</label>
            <input
                id="email"
                name="email"
                type="email"
                value="{{ old('email') }}"
                required
                autocomplete="email"
                @error('email') aria-invalid="true" aria-describedby="email-error" @enderror
                class="w-full rounded-lg border border-blue-300 bg-white px-4 py-3 text-blue-950 placeholder-blue-400 outline-none transition focus:border-blue-700 focus:ring-2 focus:ring-blue-200"
                placeholder="jouw@email.nl">
            @error('email')
                <p id="email-error" class="text-sm font-medium text-blue-800">{{ $message }}</p>
            @enderror
        </div>

        <div class="space-y-2">
            <label for="password" class="block text-sm font-semibold text-blue-900">Wachtwoord</label>
            <input
                id="password"
                name="password"
                type="password"
                required
                autocomplete="new-password"
                @error('password') aria-invalid="true" aria-describedby="password-error" @enderror
                class="w-full rounded-lg border border-blue-300 bg-white px-4 py-3 text-blue-950 outline-none transition focus:border-blue-700 focus:ring-2 focus:ring-blue-200">
            @error('password')
                <p id="password-error" class="text-sm font-medium text-blue-800">{{ $message }}</p>
            @enderror
        </div>

        <div class="space-y-2">
            <label for="password_confirmation" class="block text-sm font-semibold text-blue-900">
                Wachtwoord herhalen
            </label>
            <input
                id="password_confirmation"
                name="password_confirmation"
                type="password"
                required
                autocomplete="new-password"
                class="w-full rounded-lg border border-blue-300 bg-white px-4 py-3 text-blue-950 outline-none transition focus:border-blue-700 focus:ring-2 focus:ring-blue-200">
        </div>

        <button
            type="submit"
            class="w-full rounded-lg bg-blue-800 px-5 py-3 font-bold text-white transition hover:bg-blue-950 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-blue-700">
            Account aanmaken
        </button>
    </form>

    <p class="mt-7 text-center text-sm text-blue-800">
        Heb je al een account?
        <a class="font-bold text-blue-700 underline decoration-blue-300 underline-offset-4 hover:text-blue-950"
           href="{{ route('login') }}">
            Inloggen
        </a>
    </p>
@endsection
