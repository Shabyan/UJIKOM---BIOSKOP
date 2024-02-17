@extends('adminlte')
@section('content')
<!-- Content Header (Page header) -->
    <section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Film</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="{{ url('dashboard') }}">Dashboard</a></li>
                <li class="breadcrumb-item active">Film</li>
                </ol>
            </div>
        </div>
    </div><!-- /.container-fluid -->
    </section>
    <!-- Main content -->
    <section class="content">
    <!-- Default box -->
    <div class="card elevation-2">
        <div class="card-header">
        <h3 class="card-title">product</h3>
        </div>
        <div class="card-body">
            @if($message = Session::get('success'))
            <div class="alert alert-success">{{ $message }}</div>
            @endif

            @if (Auth::user()->role == 'admin')
            <a href="{{ route('product.create') }}"  class="btn btn-outline-success btn-lg">
                <i class="fas fa-plus-circle mr-2"></i> Tambah Data
            </a>
            @endif

            <a href="{{ url('product/pdf') }}"  class="btn btn-outline-warning btn-lg" target="_blank">
                <i class="fas fa-file-pdf mr-2"></i> Unduh PDF
            </a>
            <br>
            <br>
                    <table class="table table-striped table-bordered" id="users">
                        <thead class="thead-light" style="background-color: #f8f9fa;">
                    <tr>
                        <th style="text-align: center; vertical-align: middle;">ID</th>
                        <th style="text-align: center; vertical-align: middle;">Judul Film</th>
                        <th style="text-align: center; vertical-align: middle;">Harga</th>
                        <th style="text-align: center; vertical-align: middle;">Jam tayang</th>
                        @if (Auth::user()->role == 'admin')
                        <th style="text-align: center; vertical-align: middle;">Aksi</th>
                        @endif
                    </tr>
                </thead>
                <tbody>
                @foreach ($product as $data)
                <tr>
                    <td style="text-align: center; vertical-align: middle;">{{ $data->id }}</td>
                    <td style="text-align: center; vertical-align: middle;">{{ $data->nama_produk }}</td>
                    <td style="text-align: center; vertical-align: middle;">{{ $data->harga_produk }}</td>
                    <td style="text-align: center; vertical-align: middle;">{{ $data->jam_tayang }}</td>
                    @if (Auth::user()->role == 'admin')
                    <td>
                         <div class="row">
                <div class="col-sm-6 mb-2">
                  <!-- Tombol Edit -->
                  <a href="{{ route('product.edit', $data->id) }}" class="btn btn-block btn-outline-warning btn-sm">
                    <i class="fas fa-edit mr-1"></i> Edit
                  </a>
                </div>
                
                <div class="col-sm-6 mb-2 text-right">
                  <!-- Tombol Hapus -->
                  <form action="{{ route('product.destroy', $data->id) }}" method="post" class="d-inline">
                    @csrf
                    @method('delete')
                    <button type="submit" class="btn btn-block btn-outline-danger btn-sm" onclick="return confirm('Konfirmasi Hapus Data?')">
                      <i class="fas fa-trash-alt mr-1"></i> Hapus
                    </button>
                  </form>
                </div>
              </div>          
                    </td>
                    @endif
                </tr>
                @endforeach
            </tbody>
            </table>
            <br>
        </div>
    </div>
    <!-- /.card -->
    </section>
<!-- /.content -->
@endsection