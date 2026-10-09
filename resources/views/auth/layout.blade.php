<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title') | Sportcentrum De Linde</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="min-h-screen bg-blue-50 font-sans text-blue-950 antialiased">
    <main class="flex min-h-screen items-center justify-center px-4 py-10 sm:px-6">
        <div class="w-full max-w-md">
            <p class="mb-6 text-center text-sm font-semibold uppercase tracking-[0.2em] text-blue-700">
                @yield('eyebrow')
            </p>

            <section class="overflow-hidden rounded-2xl border border-blue-200 bg-white shadow-xl shadow-blue-900/10">
                <header class="flex items-center gap-4 border-b-2 border-blue-700 bg-white px-6 py-5 sm:px-8">
                    <img
                        class="h-12 w-12 shrink-0 object-contain"
                        src="{{ asset('img/beeldmerk.png') }}"
                        alt="Logo Sportcentrum De Linde"
                    >
                    <h1 class="text-lg font-bold text-blue-900 sm:text-xl">Sportcentrum De Linde</h1>
                </header>

                <div class="px-6 py-8 sm:px-9 sm:py-10">
                    @yield('content')
                </div>
            </section>

            <a class="mt-6 block text-center text-sm font-semibold text-blue-700 underline decoration-blue-300 underline-offset-4 transition hover:text-blue-950 focus-visible:outline-2 focus-visible:outline-offset-4 focus-visible:outline-blue-700"
               href="{{ route('home') }}">
                Terug naar home
            </a>
        </div>
    </main>
</body>
</html>
