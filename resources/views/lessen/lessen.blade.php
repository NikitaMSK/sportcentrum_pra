<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Beschikbare lessen</title>

    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 40px;
            background-color: #f5f5f5;
        }

        h1 {
            margin-bottom: 25px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            background-color: white;
        }

        th, td {
            padding: 15px;
            border: 1px solid #ddd;
            text-align: left;
        }

        th {
            background-color: #222;
            color: white;
        }
    </style>
</head>

<body>

    <h1>Beschikbare lessen</h1>

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
            @foreach ($lessen as $les)
                <tr>
                    <td>{{ $les->datum }}</td>
                    <td>{{ $les->tijd }}</td>
                    <td>{{ $les->activiteit }}</td>
                    <td>{{ $les->trainer->naam ?? 'Onbekend' }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

</body>
</html>