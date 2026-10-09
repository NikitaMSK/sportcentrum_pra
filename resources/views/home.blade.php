
<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sportcentrum De Linde</title>

    <style>
    


body {
    font-family: Arial, sans-serif;
    margin: 0;
    background: #ffffff;
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
    
.les-knoppen {
    display: flex;
    gap: 10px;
    margin-top: 15px;
}

.les-knoppen button {
    flex: 1;
    width: auto;
    margin-top: 0;
    padding: 10px 8px;
    border: none;
    border-radius: 8px;
    font-weight: bold;
    cursor: pointer;
}

.bekijk-knop {
    background-color: #2563eb;
    color: white;
}

.aanmeld-knop {
    background-color: #16a34a;
    color: white;
}

.aanmeld-knop.aangemeld {
    background-color: #64748b;
}

/* Achtergrond van de popup */

/* Achtergrond achter de popup */
.popup-overlay {
    display: none;
    position: fixed;
    inset: 0;
    background: rgba(30, 64, 120, 0.25);
    justify-content: center;
    align-items: center;
    z-index: 9999;
    padding: 20px;
    box-sizing: border-box;
}

/* Witte kaart */
.popup {
    position: relative;
    width: 100%;
    max-width: 360px;
    padding: 28px 22px;
    box-sizing: border-box;
    background: #ffffff;
    color: #1e3a8a;
    border-radius: 12px;
    border: 1px solid #dbeafe;
    box-shadow: 0 8px 20px rgba(30, 64, 175, 0.12);
    animation: popupOpen 0.25s ease;
}

/* Logo bovenaan: voeg zelf je afbeelding toe */
.popup-logo {
    display: flex;
    justify-content: center;
    align-items: center;
    min-height: 35px;
    margin-bottom: 22px;
    padding-bottom: 14px;
    border-bottom: 1px solid #074fa6;
}

.popup-logo img {
    display: block;
    width: 160px;
    max-width: 100%;
    height: auto;
    object-fit: contain;
}

/* Titel */
.popup h2 {
    color: #1e40af;
    font-size: 22px;
    text-align: center;
    margin: 0 0 12px;
    font-weight: 700;
}

/* Gekozen les */
.gekozen-les {
    color: #64748b;
    text-align: center;
    font-size: 13px;
    margin-bottom: 22px;
}

/* Labels */
.popup label {
    display: block;
    margin: 14px 0 6px;
    color: #1e3a8a;
    font-size: 13px;
    font-weight: 600;
}

/* Invoervelden */
.popup input {
    display: block;
    width: 100%;
    box-sizing: border-box;
    padding: 11px 12px;
    border: 1px solid #bfdbfe;
    border-radius: 6px;
    background: #ffffff;
    color: #1e293b;
    font-size: 14px;
    outline: none;
}

.popup input::placeholder {
    color: #93b4e8;
}

.popup input:focus {
    border-color: #3b82f6;
    box-shadow: 0 0 0 2px rgba(59, 130, 246, 0.12);
}

/* Sluitknop */
.popup-sluiten {
    position: absolute;
    top: 10px;
    right: 12px;
    background: transparent;
    color: #64748b;
    border: none;
    font-size: 25px;
    cursor: pointer;
}

/* Bevestigingsknop */
.bevestig-knop {
    width: 100%;
    margin-top: 22px;
    padding: 12px;
    background: #1e40af;
    color: #ffffff;
    border: none;
    border-radius: 6px;
    font-size: 14px;
    font-weight: 700;
    cursor: pointer;
    transition: background-color 0.2s ease;
}

.bevestig-knop:hover {
    background: #1d4ed8;
}

/* Animatie */
@keyframes popupOpen {
    from {
        opacity: 0;
        transform: translateY(8px);
    }

    to {
        opacity: 1;
        transform: translateY(0);
    }
}


/* Mobiele weergave */
@media (max-width: 480px) {
    .popup {
        padding: 26px 22px;
    }

    .popup h2 {
        font-size: 21px;
    }
}





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

                                                
                            <div class="les-knoppen">
                                <button type="button"
                                        class="bekijk-knop"
                                        onclick="window.location.href='/lessen'">
                                    Bekijk
                                </button>

                               
                                <button type="button"
                                        class="aanmeld-knop"
                                        onclick="openAanmeldPopup(this)">
                                    Aanmelden
                                </button>
                            </div>    



                   

                </article>
            @endforeach

                        
            
<div id="aanmeldPopup" class="popup-overlay">
    <div class="popup">

        <button type="button"
                class="popup-sluiten"
                onclick="sluitAanmeldPopup()">
            &times;
        </button>

         <div class="popup-logo">
                    <img src="{{ asset('img/logoo.png') }}"
                        alt="Sportcentrum De Linde logo">
                </div>

                <h2>Aanmelden voor een les</h2>
                <p id="gekozenLes" class="gekozen-les"></p>

                <form id="aanmeldForm">
                    <label for="naam">Volledige naam</label>
                    <input type="text" id="naam" name="naam"
                        placeholder="Vul je volledige naam in" required>

                    <label for="email">E-mailadres</label>
                    <input type="email" id="email" name="email"
                        placeholder="naam@voorbeeld.nl" required>

                    <label for="telefoon">Telefoonnummer</label>
                    <input type="tel" id="telefoon" name="telefoon"
                        placeholder="06 12345678" required>

                    <button type="submit" class="bevestig-knop">
                        Aanmelding bevestigen
                    </button>
                </form>
            </div>
        </div>


        </section>
    </main>

    <footer>
         &copy; 2026 Sportcentrum De Linde. Alle rechten voorbehouden.
    </footer>
    
        <script>
            
            function openAanmeldPopup(button) {
                const popup = document.getElementById('aanmeldPopup');
                const gekozenLes = button.closest('.les').querySelector('h3').textContent;
                document.getElementById('gekozenLes').textContent = `Je meldt je aan voor: ${gekozenLes}`;
                popup.style.display = 'flex';
            }

            function sluitAanmeldPopup() {
                const popup = document.getElementById('aanmeldPopup');
                popup.style.display = 'none';
            }

            document.getElementById('aanmeldForm').addEventListener('submit', function(event) {
                event.preventDefault();
                alert('Je bent succesvol aangemeld voor de les!');
                sluitAanmeldPopup();
            });
          
        </script>


</body>
</html>

