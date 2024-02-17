<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Kursi</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }

        th, td {
            border: 1px solid #dddddd;
            text-align: center;
            padding: 8px;
        }

        th {
            background-color: #f2f2f2;
        }

        tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        tr:hover {
            background-color: #ddd;
        }
    </style>
</head>
<body>
    <h1>Daftar Kursi</h1>
    <table>
        <thead>
            <tr>
                <th>Kursi</th>
                <th>Tanggal</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($kursi as $data)
            <tr>
                <td>{{ $data->kode_kursi }}</td>
                <td>{{ $data->created_at }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
