@extends('adminlte')
@section('content')
<!-- Content Header (Page header) -->
    <section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>kursi page</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="{{ url('dashboard') }}">Dashboard</a></li>
                <li class="breadcrumb-item active">kursi</li>
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
        <h3 class="card-title">kursi</h3>
        </div>
        <div class="card-body">
            @if($message = Session::get('success'))
            <div class="alert alert-success">{{ $message }}</div>
            @endif

            <a href="{{ route('kursi.create') }}"  class="btn btn-outline-success btn-lg">
                <i class="fas fa-plus-circle mr-2"></i> Tambah Data
            </a>

            <a href="{{ url('kursi/pdf') }}"  class="btn btn-outline-warning btn-lg" target="_blank">
                <i class="fas fa-file-pdf mr-2"></i> Unduh PDF
            </a>
            {{-- <a href="#" class="btn btn-danger">Reset Semua Status</a> --}}

            <br>
            <br>
            <table class="table table-striped table-bordered" id="users">
                <thead class="thead-light" style="background-color: #f8f9fa;">
                    <tr>
                        <th style="text-align: center; vertical-align: middle;">kode kursi</th>
                        <th style="text-align: center; vertical-align: middle;">status</th>
                        <th style="text-align: center; vertical-align: middle;">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                @foreach ($kursi as $data)
                <tr>
                    <td style="text-align: center; vertical-align: middle;">{{ $data->kode_kursi }}</td>
                    <td style="text-align: center; vertical-align: middle;">{{ $data->status }}</td>
                    <td>
                        <div class="row">
                            <div class="col-sm-4 mb-2">
                                <a href="{{ route('kursi.edit', $data->id) }}" class="btn btn-block btn-outline-warning btn-sm">
                                    <i class="fas fa-edit mr-1"></i> Edit
                                </a>
                            </div>
                            <div class="col-sm-4 mb-2 text-right">
                                <a href="{{ route('kursi.reset', $data->id) }}" class="btn btn-block btn-outline-info btn-sm">
                                    <i class="fas fa-edit mr-1"></i> Reset
                                </a>
                            </div>
                            <div class="col-sm-4 mb-2 text-right">
                                <form action="{{ route('kursi.destroy', $data->id)}}" method="POST">
                                    @csrf
                                    @method('delete')
                                    <button type="submit" class="btn btn-block btn-outline-danger btn-sm" onclick="return confirm('Konfirmasi Hapus Data?')">
                                        <i class="fas fa-trash-alt mr-1"></i> Hapus
                                    </button>
                                </form>
                            </div>
                        </div>
                    </td>                    
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