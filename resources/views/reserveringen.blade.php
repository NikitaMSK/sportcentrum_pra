
<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mijn Reserveringen - Sportcentrum De Linde</title>
    <link rel="stylesheet" href="{{ asset('css/mobile-navigation.css') }}">

    <style>
        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            font-family: Arial, sans-serif;
            background: #ffffff;
            color: #1e293b;
        }

        /* Header */
        header {
            position: relative;
            background: #ffffff;
            min-height: 123px;
            padding: 10px 40px;
            display: flex;
            align-items: center;
            border-bottom: 3px solid #0d47a1;
            box-shadow: 0 2px 8px rgba(15, 45, 85, 0.10);
        }

        .header-boven {
            display: flex;
            align-items: center;
            width: 100%;
            min-height: 100px;
        }

        .logo {
            width: 100px;
            height: 85px;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
        }

        .logo img {
            width: 100%;
            height: 100%;
            object-fit: contain;
        }

        .sitenaam {
            position: absolute;
            left: 50%;
            transform: translateX(-50%);
            margin: 0;
            color: #123b70;
            font-size: 26px;
            font-weight: bold;
            white-space: nowrap;
        }

        /* Navigatie */
        nav {
            display: flex;
            justify-content: space-around;
            align-items: center;
            gap: 20px;
            flex-wrap: wrap;
            padding: 16px 20px;
            background: #123b70;
            border-bottom: 3px solid #2676d9;
        }

        nav a {
            color: #ffffff;
            text-decoration: none;
            font-weight: bold;
            font-size: 16px;
            padding: 10px 16px;
            border-radius: 6px;
            transition: background-color 0.2s ease, color 0.2s ease;
        }

        nav a:hover {
            background: #2676d9;
            color: #ffffff;
        }

        /* Hoofdinhoud */
        main {
            width: 100%;
            max-width: 1200px;
            margin: 0 auto;
            padding: 25px;
        }

        h1 {
            text-align: center;
            color: #123b70;
            font-size: 28px;
            font-weight: bold;
            margin: 20px 0 30px;
            padding-bottom: 20px;
            border-bottom: 2px solid #d5e2f1;
        }

        /* Reserveringen */
        #reserveringenLijst {
            display: flex;
            justify-content: center;
            align-items: stretch;
            flex-wrap: wrap;
            gap: 25px;
        }

        .reservering {
            width: 300px;
            padding: 18px;
            background: #ffffff;
            border: 1px solid #dbe5f1;
            border-top: 4px solid #2676d9;
            border-radius: 10px;
            box-shadow: 0 4px 12px rgba(15, 45, 85, 0.08);
            transition: transform 0.2s ease, box-shadow 0.2s ease;
        }

        .reservering:hover {
            transform: translateY(-4px);
            box-shadow: 0 8px 20px rgba(15, 45, 85, 0.14);
        }

        .reservering h2 {
            color: #123b70;
            font-size: 20px;
            font-weight: bold;
            margin: 5px 0 14px;
        }

        .reservering p {
            color: #475569;
            font-size: 14px;
            line-height: 1.5;
            margin: 8px 0;
        }

        /* Annuleerknop */
        .annuleer-knop {
            display: block;
            width: 100%;
            margin-top: 18px;
            padding: 11px;
            background: #1764bd;
            color: #ffffff;
            border: none;
            border-radius: 6px;
            font-size: 13px;
            font-weight: bold;
            cursor: pointer;
            transition: background-color 0.2s ease;
        }

        .annuleer-knop:hover {
            background: #123b70;
        }

        .geen-reserveringen {
            text-align: center;
            color: #475569;
            font-size: 16px;
            padding: 20px;
        }

        /* Popup voor annuleren */
        .annuleer-popup-overlay {
            display: none;
            position: fixed;
            inset: 0;
            z-index: 1000;
            background: rgba(15, 35, 60, 0.55);
            justify-content: center;
            align-items: center;
            padding: 20px;
        }

        .annuleer-popup {
            width: 100%;
            max-width: 360px;
            padding: 24px;
            background: #ffffff;
            border-radius: 12px;
            border-top: 5px solid #2676d9;
            box-shadow: 0 8px 30px rgba(0, 0, 0, 0.2);
        }

        .annuleer-popup h3,
        .annuleer-popup h4 {
            color: #123b70;
        }

        .annuleer-popup h3 {
            margin-top: 0;
            font-size: 20px;
        }

        .annuleer-popup h4 {
            margin-bottom: 10px;
            font-size: 18px;
        }

        .annuleer-popup p {
            color: #475569;
            line-height: 1.5;
        }

        .popup-knoppen {
            display: flex;
            gap: 10px;
            margin-top: 20px;
        }

        .popup-knoppen form {
            flex: 1;
        }

        .popup-knoppen button {
            width: 100%;
            padding: 11px 8px;
            border: none;
            border-radius: 6px;
            font-weight: bold;
            cursor: pointer;
        }

        .popup-annuleren {
            background: #1764bd;
            color: #ffffff;
        }

        .popup-annuleren:hover {
            background: #123b70;
        }

        .popup-behouden {
            background: #e2e8f0;
            color: #123b70;
        }

        .popup-behouden:hover {
            background: #cbd5e1;
        }

        /* Mobiele weergave */
        @media (max-width: 600px) {
            header {
                min-height: 100px;
                padding: 8px 15px;
            }

            .header-boven {
                min-height: 90px;
            }

            .logo {
                width: 75px;
                height: 65px;
            }

            .sitenaam {
                font-size: 18px;
            }

            nav {
                justify-content: center;
                gap: 8px;
                padding: 12px;
            }

            nav a {
                font-size: 14px;
                padding: 9px 10px;
            }

            main {
                padding: 15px;
            }

            h1 {
                font-size: 23px;
            }

            #reserveringenLijst {
                flex-direction: column;
                align-items: center;
            }

            .reservering {
                width: 100%;
                max-width: 350px;
            }
        }
    </style>
</head>

<body>

    <header>
        <div class="header-boven">
            <div class="logo">
                <img src="{{ asset('img/beeldmerk.png') }}"
                     alt="Sportcentrum De Linde">
            </div>

            <h2 class="sitenaam">Sportcentrum De Linde</h2>
        </div>
    </header>

    <button type="button"
            class="nav-toggle"
            data-mobile-nav-toggle
            aria-controls="main-navigation"
            aria-expanded="false"
            aria-label="Menu openen">
        <span class="nav-toggle-icon" aria-hidden="true"></span>
        <span>Menu</span>
    </button>

    <nav id="main-navigation">
        <a href="/">Home</a>
        <a href="/lessen">Lessen</a>
        <a href="/reserveringen">Mijn reserveringen</a>

        @guest
            <a href="/inloggen">Inloggen</a>
            <a href="/account-aanmaken">Account aanmaken</a>
        @else
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="annuleer-knop" style="margin: 0; width: auto;">
                    Uitloggen ({{ auth()->user()->name }})
                </button>
            </form>
        @endguest
    </nav>

    <main>
        <h1>Mijn Reserveringen</h1>

        <div id="reserveringenLijst">
            @forelse ($aanmeldingen as $aanmelding)
                <article class="reservering"
                         data-aanmelding-id="{{ $aanmelding->id }}">

                    <h2>{{ $aanmelding->les->activiteit }}</h2>

                    <p>
                        <strong>Datum:</strong>
                        {{ \Carbon\Carbon::parse($aanmelding->les->datum)->translatedFormat('l d F') }}
                    </p>

                    <p>
                        <strong>Tijd:</strong>
                        {{ substr($aanmelding->les->tijd, 0, 5) }}
                    </p>

                    <p>
                        <strong>Trainer:</strong>
                        {{ $aanmelding->les->trainer->naam ?? 'Nog niet toegewezen' }}
                    </p>

                    <button type="button"
                            class="annuleer-knop"
                            onclick="openAnnuleerPopup(
                                {{ $aanmelding->id }},
                                @js($aanmelding->les->activiteit),
                                @js(\Carbon\Carbon::parse($aanmelding->les->datum)->translatedFormat('l d F')),
                                @js(substr($aanmelding->les->tijd, 0, 5)),
                                @js($aanmelding->les->trainer->naam ?? 'Nog niet toegewezen')
                            )">
                        Reservering annuleren
                    </button>
                </article>
            @empty
                <p class="geen-reserveringen">
                    Je hebt momenteel geen reserveringen.
                </p>
            @endforelse
        </div>

        <!-- Popup -->
        <div id="annuleerPopup" class="annuleer-popup-overlay">
            <div class="annuleer-popup">
                <h3>Reservering annuleren?</h3>

                <h4 id="popupActiviteit"></h4>
                <p id="popupDatum"></p>
                <p id="popupTijd"></p>
                <p id="popupTrainer"></p>

                <p>Weet je zeker dat je deze reservering wilt annuleren?</p>

                <div class="popup-knoppen">
                    <form id="annuleerForm" method="POST" action="">
                        @csrf
                        @method('DELETE')

                        <button type="submit" class="popup-annuleren">
                            Annuleren
                        </button>
                    </form>

                    <button type="button"
                            class="popup-behouden"
                            onclick="sluitAnnuleerPopup()">
                        Behouden
                    </button>
                </div>
            </div>
        </div>
    </main>

    <script>
        function openAnnuleerPopup(id, activiteit, datum, tijd, trainer) {
            document.getElementById('popupActiviteit').textContent = activiteit;
            document.getElementById('popupDatum').textContent = datum;
            document.getElementById('popupTijd').textContent = tijd;
            document.getElementById('popupTrainer').textContent =
                'Trainer: ' + trainer;

            document.getElementById('annuleerForm').action =
                '/reserveringen/' + id;

            document.getElementById('annuleerPopup').style.display = 'flex';
        }

        function sluitAnnuleerPopup() {
            document.getElementById('annuleerPopup').style.display = 'none';
        }

        document.getElementById('annuleerPopup').addEventListener('click', function(event) {
            if (event.target === this) {
                sluitAnnuleerPopup();
            }
        });
    </script>
    <script src="{{ asset('js/mobile-navigation.js') }}"></script>

</body>
</html>
