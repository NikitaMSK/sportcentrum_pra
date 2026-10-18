<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mijn lessen | Sportcentrum De Linde</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="min-h-screen bg-slate-50 font-sans text-slate-900 antialiased">
    <header class="border-b border-blue-100 bg-white">
        <div class="mx-auto flex max-w-7xl items-center justify-between gap-4 px-4 py-4 sm:px-6 lg:px-8">
            <a href="{{ route('home') }}" class="flex min-w-0 items-center gap-3">
                <img
                    class="h-11 w-11 shrink-0 object-contain"
                    src="{{ asset('img/beeldmerk.png') }}"
                    alt="Logo Sportcentrum De Linde"
                >
                <span class="truncate text-base font-bold text-blue-950 sm:text-lg">
                    Sportcentrum De Linde
                </span>
            </a>

            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button
                    type="submit"
                    class="rounded-lg border border-blue-200 px-3 py-2 text-sm font-semibold text-blue-900 transition hover:bg-blue-50 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-blue-700 sm:px-4">
                    Uitloggen
                </button>
            </form>
        </div>
    </header>

    <main class="mx-auto max-w-7xl px-4 py-8 sm:px-6 sm:py-10 lg:px-8">
        <div class="mb-8 flex flex-col gap-5 sm:flex-row sm:items-end sm:justify-between">
            <div>
                <p class="mb-2 text-sm font-bold uppercase tracking-[0.16em] text-blue-700">Overzicht</p>
                <h1 class="text-3xl font-bold tracking-tight text-blue-950 sm:text-4xl">Mijn lessen</h1>
                <p class="mt-2 text-slate-600">
                    Welkom, {{ $trainer->naam }}. Hier vind je je lessen en deelnemers.
                </p>
            </div>

            <div class="w-fit rounded-xl border border-blue-100 bg-white px-5 py-3 shadow-sm">
                <p class="text-sm font-medium text-slate-500">Komende lessen</p>
                <p class="mt-1 text-2xl font-bold text-blue-900">{{ $lessen->count() }}</p>
            </div>
        </div>

        <div class="grid gap-6 lg:grid-cols-[minmax(0,0.9fr)_minmax(0,1.1fr)] lg:items-start">
            <section aria-labelledby="lesson-list-title" class="rounded-2xl border border-blue-100 bg-white p-5 shadow-sm sm:p-6">
                <div class="mb-5 flex items-center justify-between gap-3">
                    <div>
                        <h2 id="lesson-list-title" class="text-xl font-bold text-blue-950">Mijn rooster</h2>
                        <p class="mt-1 text-sm text-slate-500">Selecteer een les om deelnemers te bekijken.</p>
                    </div>
                    <span class="rounded-full bg-blue-50 px-3 py-1 text-sm font-semibold text-blue-800">
                        {{ $lessen->count() }} {{ $lessen->count() === 1 ? 'les' : 'lessen' }}
                    </span>
                </div>

                @forelse ($lessenPerDag as $datum => $dagLessen)
                    @php($lesDatum = $dagLessen->first()->datum)
                    <div class="mb-5 last:mb-0">
                        <h3 class="mb-3 text-sm font-bold uppercase tracking-wide text-slate-500">
                            {{ $lesDatum->isToday() ? 'Vandaag' : $lesDatum->format('d-m-Y') }}
                        </h3>

                        <div class="space-y-3">
                            @foreach ($dagLessen as $les)
                                <a
                                    href="{{ route('trainer.members', $les) }}"
                                    @if ($selectedLes?->is($les)) aria-current="page" @endif
                                    class="block rounded-xl border p-4 transition focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-blue-700
                                        {{ $selectedLes?->is($les) ? 'border-blue-600 bg-blue-50 shadow-sm' : 'border-slate-200 bg-white hover:border-blue-300 hover:bg-blue-50/50' }}">
                                    <div class="flex items-start justify-between gap-3">
                                        <h4 class="font-bold text-blue-950">{{ $les->activiteit }}</h4>
                                        <span class="shrink-0 rounded-full bg-white px-2.5 py-1 text-xs font-semibold text-slate-600">
                                            {{ substr($les->tijd, 0, 5) }}
                                        </span>
                                    </div>
                                    <p class="mt-2 text-sm text-slate-600">
                                        {{ $les->aanmeldingen_count }} {{ $les->aanmeldingen_count === 1 ? 'deelnemer' : 'deelnemers' }}
                                    </p>
                                    <span class="mt-3 inline-flex text-sm font-bold text-blue-700">
                                        Bekijk deelnemers <span aria-hidden="true" class="ml-1">→</span>
                                    </span>
                                </a>
                            @endforeach
                        </div>
                    </div>
                @empty
                    <div class="rounded-xl border border-dashed border-blue-200 bg-blue-50/60 px-5 py-8 text-center">
                        <p class="font-semibold text-blue-950">Er staan geen komende lessen op je rooster.</p>
                        <p class="mt-1 text-sm text-slate-600">Nieuwe lessen verschijnen hier zodra ze zijn ingepland.</p>
                    </div>
                @endforelse
            </section>

            <section aria-labelledby="participants-title" class="rounded-2xl border border-blue-100 bg-white p-5 shadow-sm sm:p-6">
                @if ($selectedLes)
                    <div class="border-b border-slate-200 pb-5">
                        <a
                            href="{{ route('trainer.index') }}"
                            class="mb-5 inline-flex items-center gap-2 text-sm font-semibold text-blue-700 transition hover:text-blue-950 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-blue-700">
                            <span aria-hidden="true">←</span> Mijn lessen
                        </a>
                        <p class="text-sm font-semibold text-blue-700">
                            {{ $selectedLes->datum->isToday() ? 'Vandaag' : $selectedLes->datum->format('d-m-Y') }}
                            · {{ substr($selectedLes->tijd, 0, 5) }}
                        </p>
                        <h2 id="participants-title" class="mt-1 text-2xl font-bold text-blue-950">
                            {{ $selectedLes->activiteit }}
                        </h2>
                        <p class="mt-2 text-slate-600">
                            Deelnemers: {{ $selectedLes->aanmeldingen_count }}
                        </p>
                    </div>

                    <div class="pt-5">
                        <h3 class="mb-3 text-sm font-bold uppercase tracking-wide text-slate-500">Deelnemerslijst</h3>
                        @forelse ($selectedLes->aanmeldingen as $deelnemer)
                            <div class="flex items-center gap-3 border-b border-slate-100 py-3 last:border-b-0">
                                <span class="flex h-9 w-9 shrink-0 items-center justify-center rounded-full bg-blue-100 text-sm font-bold text-blue-800">
                                    {{ mb_strtoupper(mb_substr($deelnemer->name, 0, 1)) }}
                                </span>
                                <span class="font-medium text-slate-800">{{ $deelnemer->name }}</span>
                            </div>
                        @empty
                            <p class="rounded-lg bg-slate-50 px-4 py-5 text-sm text-slate-600">
                                Er hebben zich nog geen deelnemers aangemeld voor deze les.
                            </p>
                        @endforelse
                    </div>
                @else
                    <div class="flex min-h-64 flex-col items-center justify-center text-center">
                        <h2 id="participants-title" class="text-xl font-bold text-blue-950">Deelnemers</h2>
                        <p class="mt-2 max-w-sm text-slate-600">
                            Kies een les uit je rooster om de deelnemerslijst te bekijken.
                        </p>
                    </div>
                @endif
            </section>
        </div>
    </main>
</body>
</html>
