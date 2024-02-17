@extends('adminlte')
@section('content')
<section class="content-header">
    <div class="container-fluid">
        <!-- Page Heading -->
        <h2 class="h3 mb-4 text-gray-800">product Page</h2>
    </div>

    <section class="content">

    <div class="card">
        <div class="card-header">
            <h5 class="card-title">Tambah Data product</h5>
        </div>
        <div class="card-body">
            <a href="{{ route('product.index') }}" class="btn btn-secondary">Kembali</a>
            <br><br>

            <form action="{{ route('product.store') }}" method="POST">
            @csrf
            <div class="form-group">
                <label>Judul Film</label>
                <input name="nama_produk" type="text" class="form-control" placeholder="...">
                @error('nama_produk')
                    <p>{{ $message }}</p>
                @enderror
            </div>
            <div class="form-group">
                <label>harga</label>
                <input name="harga_produk" type="text" class="form-control" placeholder="Ex. 75000">
                @error('harga_produk')
                    <p>{{ $message }}</p>
                @enderror
            </div>
            <div class="form-group">
                <label>jam tayang</label>
                <input name="jam_tayang" type="text" class="form-control" placeholder="Ex. 09.00 - 10.00">
                @error('jam_tayang')
                    <p>{{ $message }}</p>
                @enderror
            </div>
            <input type="submit" name="submit" class="btn btn-success" value="Tambah">
            </form>
        </div>
    </div>

</section> 
@endsection
