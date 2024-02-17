@extends('adminlte')
@section('content')
<!-- Content Header (Page header) -->
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Transaction page</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="{{ url('dashboard') }}">Dashboard</a></li>
                <li class="breadcrumb-item active">transaction</li>
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
        <h3 class="card-title">Transaction</h3>
        </div>
        <div class="card-body">

            @if($message = Session::get('success'))
            <div class="alert alert-success">{{ $message }}</div>
            @endif

            {{-- <form action="{{ route('transaction.index') }}" method="get" class="form-inline">
                <div class="form-group mx-2">
                    <label for="start_date" class="mr-2">Tanggal Awal :</label>
                    <input type="date" name="start_date" class="form-control" value="{{ request('start_date') }}">
                </div>
                <div class="form-group mx-2">
                    <label for="end_date" class="mr-2">Tanggal Akhir :</label>
                    <input type="date" name="end_date" class="form-control" value="{{ request('end_date') }}">
                </div>
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-search"></i>
                </button>
                <a href="{{ route('transaction.index') }}" class="btn btn-danger">
                    <i class="fas fa-undo"></i>
                </a>
            </form> --}}
            
            @if (Auth::user()->role == 'kasir')
            <a href="{{ route('transaction.create') }}"  class="btn btn-outline-success btn-lg">
                <i class="fas fa-plus-circle mr-2"></i> Tambah Data
            </a>
            @endif
            <br>

            @if (Auth::user()->role == 'admin')
            <a href="{{ url('transaction/pdf') }}" class="btn btn-outline-warning btn-lg" target="_blank">
                <i class="fas fa-file-pdf mr-2"></i> Unduh PDF
            </a>
            @endif

            @if (Auth::user()->role == 'owner')
            <a href="{{ url('transaction/all') }}" class="btn btn-outline-warning shadow"><i class="nav-icon fas fa-file-pdf text-home"></i> Unduh PDF Pertanggal</a>
            @endif
            <br>
            <br>

            <table class="table table-striped table-bordered" id="users">
                <thead class="thead-light" style="background-color: #f8f9fa;">
                <tr>
                    <th style="text-align: center; vertical-align: middle;">Nomor Unik</th>
                    <th style="text-align: center; vertical-align: middle;">Nama Pelanggan</th>
                    <th style="text-align: center; vertical-align: middle;">Judul Film</th>
                    <th style="text-align: center; vertical-align: middle;">Harga Produk</th>
                    <th style="text-align: center; vertical-align: middle;">Studio</th>
                    <th style="text-align: center; vertical-align: middle;">Kursi</th>
                    <th style="text-align: center; vertical-align: middle;">Uang Bayar</th>
                    <th style="text-align: center; vertical-align: middle;">Uang Kembali</th>
                    <th style="text-align: center; vertical-align: middle;">Tanggal</th>
                    @if (Auth::user()->role == 'admin' | Auth::user()->role == 'kasir')
                    <th style="text-align: center; vertical-align: middle;">Aksi</th>
                    @endif
                </tr>
                </thead>
                <tbody>
                @foreach ($TransactionM as $transaction)
                <tr>
                    <td style="text-align: center; vertical-align: middle;">{{ $transaction->nomor_unik }}</td>
                    <td style="text-align: center; vertical-align: middle;">{{ $transaction->nama_pelanggan }}</td>
                    <td style="text-align: center; vertical-align: middle;">{{ $transaction->nama_produk }}</td>
                    <td style="text-align: center; vertical-align: middle;">{{ $transaction->harga_produk }}</td>
                    <td style="text-align: center; vertical-align: middle;">{{ $transaction->studio }}</td>
                    <td style="text-align: center; vertical-align: middle;">{{ $transaction->kode_kursi }}</td>
                    <td style="text-align: center; vertical-align: middle;">{{ $transaction->uang_bayar }}</td>
                    <td style="text-align: center; vertical-align: middle;">{{ $transaction->uang_kembali }}</td>
                    <td style="text-align: center; vertical-align: middle;">{{ $transaction->tgl }}</td> 
                    @if (Auth::user()->role == 'admin' | Auth::user()->role == 'kasir')
                    <td> 
                        <div class="row">
                            @if (Auth::user()->role == 'kasir')
                                <div class="col-sm-12 mb-2">
                                    <a href="{{ url('transaction/pdf2', $transaction->id_trans) }}" class="btn btn-block btn-outline-primary btn-sm mb-2">
                                        <i class="fas fa-file-pdf mr-1"></i> Cetak Struk
                                    </a>
                                </div>
                            @endif
                    
                            @if (Auth::user()->role == 'admin')
                            <div class="col-sm-6 mb-2">
                                <!-- Tombol Edit -->
                                <a href="{{ route('transaction.edit', $transaction->id_trans) }}" class="btn btn-block btn-outline-info btn-sm">
                                    <i class="fas fa-edit mr-1"></i> Edit
                                </a>
                            </div>
                            @endif
                    
                            @if (Auth::user()->role == 'admin')
                                <div class="col-sm-6 mb-2 text-right">
                                    <!-- Tombol Hapus -->
                                    <form action="{{ route('transaction.destroy', $transaction->id_trans) }}" method="post" class="d-inline">
                                        @csrf
                                        @method('delete')
                                        <button type="submit" class="btn btn-block btn-outline-danger btn-sm" onclick="return confirm('Konfirmasi Hapus Data?')">
                                            <i class="fas fa-trash-alt mr-1"></i> Hapus
                                        </button>
                                    </form>
                                </div>
                            @endif
                        </div>
                    </td>
                    @endif
                </tr>
                @endforeach

                </tbody>
            </table>
            <br>
            {{-- {!! $TransactionsM->withQueryString()->links('pagination::bootstrap-5') !!} --}}
        </div>
    </div>
    <!-- /.card -->
  
</section>
<!-- /.content -->
@endsection