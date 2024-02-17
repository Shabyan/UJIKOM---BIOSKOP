<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Transaksi</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }

        th, td {
            border: 1px solid #dddddd;
            text-align: left;
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
    <h1>Laporan Transaksi</h1>
    <h3>Berikut merupakan daftar transaksi yang ada di TiketCine</h3>
    <table>
        <thead>
            <tr>
                <th>Nomor Unik</th>
                <th>Nama Pelanggan</th>
                <th>Judul Film</th>
                <th>Harga Produk</th>
                <th>Studio</th>
                <th>Kursi</th>
                <th>Uang Bayar</th>
                <th>Uang Kembali</th>
                <th>Tanggal</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($transaction as $data)
            <tr>
                <td>{{ $data->nomor_unik }}</td>
                <td>{{ $data->nama_pelanggan }}</td>
                <td>{{ $data->nama_produk }}</td>
                <td>{{ $data->harga_produk }}</td>
                <td>{{ $data->studio }}</td>
                <td>{{ $data->kode_kursi }}</td>
                <td>{{ $data->uang_bayar }}</td>
                <td>{{ $data->uang_kembali }}</td>
                <td>{{ $data->created_at }}</td> 
            </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
