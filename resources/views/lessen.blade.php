<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lessen - Sportcentrum De Linde</title>

    <style>
        .les {
            border: 1px solid #ddd;
            padding: 20px;
            margin-bottom: 15px;
            border-radius: 10px;
        }

        .aanmeld-btn {
            background-color: #2563eb;
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: 6px;
            cursor: pointer;
        }

        .aanmeld-btn.aangemeld {
            background-color: #16a34a;
        }
    </style>
</head>

<body>

    <h1>Lessen</h1>

    <div class="les">
        <h2>Fitness</h2>
        <p>Maandag 18:00 - 19:00</p>

        <button class="aanmeld-btn" onclick="aanmelden(this)">
            Aanmelden
        </button>
    </div>

    <div class="les">
        <h2>Yoga</h2>
        <p>Dinsdag 19:00 - 20:00</p>

        <button class="aanmeld-btn" onclick="aanmelden(this)">
            Aanmelden
        </button>
    </div>

    <div class="les">
        <h2>Spinning</h2>
        <p>Woensdag 20:00 - 21:00</p>

        <button class="aanmeld-btn" onclick="aanmelden(this)">
            Aanmelden
        </button>
    </div>

    <script>
        function aanmelden(button) {
            if (button.innerText === 'Aanmelden') {
                button.innerText = 'Aangemeld ✓';
                button.classList.add('aangemeld');
            } else {
                button.innerText = 'Aanmelden';
                button.classList.remove('aangemeld');
            }
        }
    </script>

</body>
</html>