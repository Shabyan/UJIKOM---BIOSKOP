<h1>Daftar Film</h1>
<h3>berikut merupakan daftar studio yang ada di TiketCine</h3>
<table width="100%" border="1" cellpadding="5" cellspacing="0">
<tr>
    <th>Judul Film</th>
    <th>Harga</th>
    <th>Jam Tayang</th>
    <th>Tanggal</th>
</tr>
@foreach ($product as $data)
<tr>
    <td style="text-align: center; vertical-align: middle;">{{ $data->nama_produk }}</td>
    <td style="text-align: center; vertical-align: middle;">{{ $data->harga_produk }}</td>
    <td style="text-align: center; vertical-align: middle;">{{ $data->jam_tayang }}</td>
    <td style="text-align: center; vertical-align: middle;">{{ $data->created_at }}</td>
</tr>
@endforeach
</table>