
<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sportcentrum De Linde</title>

    <style>
    

```css
body {
    font-family: Arial, sans-serif;
    margin: 0;
    background: #a55e07;
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
    transition: background-color 0.2s ease, color 0.2s ease;
}

nav a:hover {
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

.intro h2 {
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

/* Titel lessen */
.lessen-titel {
    text-align: center;
    margin: 30px 0 25px;
    color: #123b70;
    font-size: 25px;
    font-weight: bold;
}

/* Overzicht leskaarten */
.lessen {
    display: flex;
    gap: 25px;
    justify-content: center;
    align-items: stretch;
    flex-wrap: wrap;
}

/* Leskaart */
.les {
    box-sizing: border-box;
    background: #ffffff;
    padding: 18px;
    width: 230px;
    border: 1px solid #dbe5f1;
    border-top: 4px solid #2676d9;
    border-radius: 10px;
    box-shadow: 0 4px 12px rgba(15, 45, 85, 0.08);
    transition: transform 0.2s ease, box-shadow 0.2s ease;
}

.les:hover {
    transform: translateY(-4px);
    box-shadow: 0 8px 20px rgba(15, 45, 85, 0.14);
}

/* Afbeeldingen */
.les img {
    width: 100%;
    height: 135px;
    object-fit: cover;
    display: block;
    border-radius: 7px;
    margin-bottom: 14px;
}

.les h3 {
    margin: 10px 0 14px;
    color: #123b70;
    font-size: 20px;
    font-weight: bold;
}

.les p {
    font-size: 14px;
    line-height: 1.5;
    margin: 8px 0;
    color: #475569;
}

/* Knoppen */
.les button {
    width: 100%;
    margin-top: 12px;
    padding: 11px;
    background: #1764bd;
    color: #ffffff;
    font-size: 15px;
    font-weight: bold;
    border: none;
    border-radius: 6px;
    cursor: pointer;
    transition: background-color 0.2s ease, transform 0.2s ease;
}

.les button:hover {
    background: #123b70;
    transform: translateY(-1px);
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

    .intro h2 {
        font-size: 23px;
    }

    .lessen {
        flex-direction: column;
        align-items: center;
    }

    .les {
        width: 100%;
        max-width: 350px;
    }

    .les img {
        height: 170px;
    }
}
```


    </style>
</head>


<body>

    <header>
        <div class="logo">
            <img src="{{ asset('img/beeldmerk.png') }}" alt="Logo">
        </div>

        <h2>Sportcentrum De Linde</h2>
    </header>

    <nav>
        <a href="/">Home</a>
        <a href="/lessen">Lessen</a>
        <a href="/reserveringen">Mijn reserveringen</a>
        <a href="/inloggen">Inloggen</a>
    </nav>

    <main>
        <section class="intro">
            <h2>Sportcentrum De Linde</h2>
            <p>Welkom bij Sportcentrum De Linde! Bij ons kun je werken aan je conditie, kracht en gezondheid in een sportieve en gezellige omgeving. Ontdek ons aanbod aan lessen, zoals spinning, yoga en aqua, en kies de activiteit die bij jou past.

Kom in beweging en werk aan een gezondere levensstijl!</p>
        </section>

       <h2 class="lessen-titel">Onze lessen</h2>

        <section class="lessen">
            @foreach ($lessen as $les)
                <article class="les">

                    @if (strtolower($les->activiteit) === 'spinning')
                        <img src="{{ asset('img/spinning.jpeg') }}"
                             alt="Spinning">
                    @elseif (strtolower($les->activiteit) === 'yoga')
                        <img src="{{ asset('img/yogahoi.jpg') }}"
                             alt="Yoga">
                    @elseif (strtolower($les->activiteit) === 'aqua')
                        <img src="{{ asset('img/Aquaa.jpeg') }}"
                             alt="Aqua">
                    @endif

                    <h3>{{ $les->activiteit }}</h3>

                    <p>{{ $les->tijd }}</p>
                    <p>{{ $les->datum }}</p>

                    <p>
                        Trainer:
                        {{ $les->trainer->naam ?? 'Nog niet toegewezen' }}
                    </p>

                    <button type="button"
                        onclick="window.location.href='/lessen'">
                        Bekijk
                    </button>

                </article>
            @endforeach
        </section>
    </main>

    <footer>
        Footer
    </footer>

</body>
</html>

