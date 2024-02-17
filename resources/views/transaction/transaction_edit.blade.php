@extends('adminlte')
@section('content')
<section class="content-header">
    <div class="container-fluid">
        <!-- Page Heading -->
        <h2 class="h3 mb-4 text-gray-800">Transaksi Page</h2>
    </div>

    <section class="content">

    <div class="card">
        <div class="card-header">
            <h5 class="card-title">Edit Transaksi Products</h5>
        </div>
        <div class="card-body">
            <a href="{{ route('transaction.index') }}" class="btn btn-secondary">Kembali</a>
            <br><br>
            <form action="{{ route('transaction.update', $transaction->id) }}" method="POST">
            @csrf
            @method('put')
            <div class="form-group">
                <label>Nomor Unik</label>
                <input name="nomor_unik" type="text" class="form-control" placeholder="Ex. Ultra Milk" value="{{ $transaction->nomor_unik }}" readonly>
                @error('nomor_unik')
                    <p>{{ $message }}</p>
                @enderror
            </div>
            <div class="form-group">
                <label>Nama Pelanggan</label>
                <input name="nama_pelanggan" type="text" class="form-control" placeholder="Ex. 5000" value="{{ $transaction->nama_pelanggan }}">
                @error('nama_pelanggan')
                    <p>{{ $message }}</p>
                @enderror
            </div>
            <div class="form-group">
                <label>Judul Film + Harga + Jam Tayang</label>
                <select name="id_produk" class="form-control" required>
                    <option>Pilih Film</option>
                    @foreach ($product as $data)
                    <?php
                    if ($data->id == $transaction->id_produk):
                        $selected = "selected";
                    else:
                        $selected = "";
                    endif;
                    ?>
                    <option {{ $selected }} value="{{ $data->id }}">
                        {{ $data->nama_produk }} - {{ $data->harga_produk }} - {{ $data->jam_tayang}}
                    </option>
                    @endforeach
                </select>
                @error('id_produk')
                    <p>{{ $message }}</p>
                @enderror
            </div>
            <div class="form-group">
                <label>Studio</label>
                <select name="id_studio" class="form-control" required>
                    <option>Pilih Studio</option>
                    @foreach ($studio as $data)
                    <?php
                    if ($data->id == $transaction->id_studio):
                        $selected = "selected";
                    else:
                        $selected = "";
                    endif;
                    ?>
                    <option {{ $selected }} value="{{ $data->id }}">
                        {{ $data->studio }}
                    </option>
                    @endforeach
                </select>
                @error('id_studio')
                    <p>{{ $message }}</p>
                @enderror
            </div>
            <div class="form-group">
                <label>Kursi</label>
                <select name="id_kursi" class="form-control" required>
                    <option>Pilih kursi</option>
                    @foreach ($kursi as $data)
                    <?php
                    if ($data->id == $transaction->id_kursi):
                        $selected = "selected";
                    else:
                        $selected = "";
                    endif;
                    ?>
                    <option {{ $selected }} value="{{ $data->id }}">
                        {{ $data->kode_kursi }}
                    </option>
                    @endforeach
                </select>
                @error('id_kursi')
                    <p>{{ $message }}</p>
                @enderror
            </div>
            <div class="form-group">
                <label>Uang Bayar</label>
                <input name="uang_bayar" type="text" class="form-control" placeholder="Ex. 5000" value="{{ $transaction->uang_bayar }}">
                @error('uang_bayar')
                    <p>{{ $message }}</p>
                @enderror
            </div>
            <input type="submit" name="submit" class="btn btn-success" value="edit">
            </form>
        </div>
    </div>

</section> 
@endsection

