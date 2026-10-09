
<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Beschikbare lessen - Sportcentrum De Linde</title>

    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            background: #f5f8fc;
            color: #1e293b;
        }

        /* Header */
        header {
            background: #ffffff;
            padding: 20px;
            display: flex;
            align-items: center;
            gap: 20px;
            border-bottom: 3px solid #0d47a1;
            box-shadow: 0 2px 8px rgba(15, 45, 85, 0.10);
        }

        .logo {
            width: 110px;
            height: 80px;
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

        header h2 {
            flex: 1;
            text-align: center;
            margin: 0;
            padding-right: 130px;
            font-size: 26px;
            font-weight: bold;
            color: #123b70;
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
            transition: background-color 0.2s ease;
        }

        nav a:hover,
        nav a.actief {
            background: #2676d9;
            color: #ffffff;
        }

        /* Hoofdinhoud */
        main {
            padding: 25px;
            max-width: 1200px;
            margin: 0 auto;
        }

        /* Introductie */
        .intro {
            text-align: center;
            border-bottom: 2px solid #d5e2f1;
            padding: 15px 10px 25px;
        }

        .intro h1 {
            color: #123b70;
            font-size: 28px;
            font-weight: bold;
            margin-bottom: 12px;
        }

        .intro p {
            font-size: 16px;
            line-height: 1.6;
            color: #475569;
        }

        /* Lessenoverzicht */
        .lessen-container {
            background: #ffffff;
            margin-top: 30px;
            padding: 25px;
            border: 1px solid #dbe5f1;
            border-top: 4px solid #2676d9;
            border-radius: 10px;
            box-shadow: 0 4px 12px rgba(15, 45, 85, 0.08);
        }

        .lessen-titel {
            text-align: center;
            margin: 0 0 25px;
            color: #123b70;
            font-size: 25px;
            font-weight: bold;
        }

        /* Tabel */
        .tabel-container {
            width: 100%;
            overflow-x: auto;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            background: #ffffff;
        }

        th,
        td {
            padding: 15px;
            border-bottom: 1px solid #dbe5f1;
            text-align: left;
        }

        th {
            background: #123b70;
            color: #ffffff;
            font-size: 15px;
        }

        td {
            color: #475569;
            font-size: 15px;
        }

        tbody tr:nth-child(even) {
            background: #f1f6fc;
        }

        tbody tr:hover {
            background: #e4efff;
        }

        /* Geen lessen */
        .geen-lessen {
            text-align: center;
            padding: 25px;
            color: #475569;
        }

        /* Footer */
        footer {
            background: #123b70;
            color: #ffffff;
            text-align: center;
            padding: 20px;
            margin-top: 40px;
            font-weight: bold;
        }

        /* Mobiele weergave */
        @media (max-width: 600px) {
            header {
                padding: 15px;
                gap: 12px;
            }

            .logo {
                width: 75px;
                height: 60px;
            }

            header h2 {
                padding-right: 0;
                font-size: 19px;
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

            .intro h1 {
                font-size: 23px;
            }

            .lessen-container {
                padding: 15px;
            }

            .lessen-titel {
                font-size: 22px;
            }

            th,
            td {
                padding: 10px;
                font-size: 13px;
                white-space: nowrap;
            }
        }
    </style>
</head>

<body>

    <header>
        <div class="logo">
            <img src="{{ asset('img/beeldmerk.png') }}"
                 alt="Logo Sportcentrum De Linde">
        </div>

        <h2>Sportcentrum De Linde</h2>
    </header>

    <nav>
        <a href="/">Home</a>
        <a href="/lessen" class="actief">Lessen</a>
        <a href="/reserveringen">Mijn reserveringen</a>
        <a href="/inloggen">Inloggen</a>
    </nav>

    <main>

        <section class="intro">
            <h1>Beschikbare lessen</h1>

            <p>
                Welkom bij Sportcentrum De Linde!
                Bekijk ons lesaanbod en ontdek welke activiteiten
                bij jou passen. Bekijk de datum, tijd en trainer
                van iedere les.
            </p>
        </section>

        <section class="lessen-container">

            <h2 class="lessen-titel">
                Overzicht van onze lessen
            </h2>

            <div class="tabel-container">

                <table>
                    <thead>
                        <tr>
                            <th>Datum</th>
                            <th>Tijd</th>
                            <th>Activiteit</th>
                            <th>Trainer</th>
                        </tr>
                    </thead>

                    <tbody>
                        @forelse ($lessen as $les)
                            <tr>
                                <td>{{ $les->datum }}</td>

                                <td>{{ $les->tijd }}</td>

                                <td>{{ $les->activiteit }}</td>

                                <td>
                                    {{ $les->trainer->naam ?? 'Nog niet toegewezen' }}
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="geen-lessen">
                                    Er zijn momenteel geen lessen beschikbaar.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>

            </div>
        </section>

    </main>

    <footer>
        Sportcentrum De Linde
    </footer>

</body>
</html>

