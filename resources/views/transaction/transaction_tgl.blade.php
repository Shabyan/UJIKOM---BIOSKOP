<h1>Transactions List Date</h1>
<table width="100%" border="1" cellpadding="5" cellspacing="0">
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
        @foreach ($transaction as $data)
        <tr>
            <td style="text-align: center; vertical-align: middle;">{{ $data->nomor_unik }}</td>
            <td style="text-align: center; vertical-align: middle;">{{ $data->nama_pelanggan }}</td>
            <td style="text-align: center; vertical-align: middle;">{{ $data->nama_produk }}</td>
            <td style="text-align: center; vertical-align: middle;">Rp.{{number_format ($data->harga_produk) }}</td>
            <td style="text-align: center; vertical-align: middle;">{{ $data->studio }}</td>
            <td style="text-align: center; vertical-align: middle;">{{ $data->kode_kursi }}</td>
            <td style="text-align: center; vertical-align: middle;">Rp.{{number_format ($data->uang_bayar) }}</td>
            <td style="text-align: center; vertical-align: middle;">Rp.{{number_format ($data->uang_kembali) }}</td>
            <td style="text-align: center; vertical-align: middle;">{{ $data->tanggal }}</td>
        </tr>
        @endforeach
</table>
<br>
<h4 style="margin-bottom: 5px;"><u>Shabyan</u></h4>
<p style="margin-top: 5px;">TiketCine</p>
<br>
