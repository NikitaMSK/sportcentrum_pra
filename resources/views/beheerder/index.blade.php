
<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Beheerder | Sportcentrum De Linde</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="min-h-screen bg-slate-50 font-sans text-slate-900 antialiased">
    <header class="border-b border-blue-100 bg-white">
        <div class="mx-auto flex max-w-7xl items-center justify-between gap-4 px-4 py-4 sm:px-6 lg:px-8">
            <a href="{{ route('home') }}" class="flex items-center gap-3">
                <img
                    class="h-11 w-11 object-contain"
                    src="{{ asset('img/beeldmerk.png') }}"
                    alt="Logo Sportcentrum De Linde"
                >
                <span class="text-base font-bold text-blue-950 sm:text-lg">
                    Sportcentrum De Linde
                </span>
            </a>

            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit"
                    class="rounded-lg border border-blue-200 px-4 py-2 text-sm font-semibold text-blue-900 hover:bg-blue-50">
                    Uitloggen
                </button>
            </form>
        </div>
    </header>

    <main class="mx-auto max-w-7xl px-4 py-8 sm:px-6 lg:px-8">
        <div class="mb-8">
            <p class="mb-2 text-sm font-bold uppercase tracking-widest text-blue-700">
                Beheer
            </p>
            <h1 class="text-3xl font-bold tracking-tight text-blue-950 sm:text-4xl">
                Beheerdersdashboard
            </h1>
            <p class="mt-2 text-slate-600">
                Welkom, {{ $beheerder->name }}. Hier vind je het overzicht van de lessen.
            </p>
        </div>

        <div class="mb-8 grid gap-4 sm:grid-cols-2">
            <section class="rounded-2xl border border-blue-100 bg-white p-6 shadow-sm">
                <p class="text-sm font-medium text-slate-500">Komende lessen</p>
                <p class="mt-2 text-3xl font-bold text-blue-950">
                    {{ $aantalLessen }}
                </p>
            </section>

            <section class="rounded-2xl border border-blue-100 bg-white p-6 shadow-sm">
                <p class="text-sm font-medium text-slate-500">Lessen vandaag</p>
                <p class="mt-2 text-3xl font-bold text-blue-950">
                    {{ $lessenVandaag }}
                </p>
            </section>
        </div>

        <section class="rounded-2xl border border-blue-100 bg-white p-5 shadow-sm sm:p-6">
            <div class="mb-5">
                <h2 class="text-xl font-bold text-blue-950">Alle komende lessen</h2>
                <p class="mt-1 text-sm text-slate-500">
                    Overzicht van de geplande lessen en deelnemers.
                </p>
            </div>

            @forelse ($lessenPerDag as $datum => $dagLessen)
                @php($lesDatum = $dagLessen->first()->datum)

                <div class="mb-7 last:mb-0">
                    <h3 class="mb-3 text-sm font-bold uppercase tracking-wide text-slate-500">
                        {{ $lesDatum->isToday() ? 'Vandaag' : $lesDatum->format('d-m-Y') }}
                    </h3>

                    <div class="space-y-3">
                        @foreach ($dagLessen as $les)
                            <article class="rounded-xl border border-slate-200 p-4">
                                <div class="flex flex-col justify-between gap-3 sm:flex-row sm:items-center">
                                    <div>
                                        <h4 class="font-bold text-blue-950">
                                            {{ $les->activiteit }}
                                        </h4>
                                        <p class="mt-1 text-sm text-slate-600">
                                            Trainer:
                                            {{ $les->trainer->naam ?? 'Niet toegewezen' }}
                                        </p>
                                    </div>

                                    <div class="flex flex-wrap items-center gap-3">
                                        <span class="rounded-full bg-blue-50 px-3 py-1 text-sm font-semibold text-blue-800">
                                            {{ substr($les->tijd, 0, 5) }}
                                        </span>
                                        <span class="rounded-full bg-slate-100 px-3 py-1 text-sm font-semibold text-slate-700">
                                            {{ $les->aanmeldingen_count }}
                                            {{ $les->aanmeldingen_count === 1 ? 'deelnemer' : 'deelnemers' }}
                                        </span>
                                    </div>
                                </div>
                            </article>
                        @endforeach
                    </div>
                </div>
            @empty
                <div class="rounded-xl border border-dashed border-blue-200 bg-blue-50/60 px-5 py-8 text-center">
                    <p class="font-semibold text-blue-950">Geen komende lessen gevonden.</p>
                    <p class="mt-1 text-sm text-slate-600">
                        Geplande lessen verschijnen hier automatisch.
                    </p>
                </div>
            @endforelse
        </section>
    </main>
</body>
</html>
