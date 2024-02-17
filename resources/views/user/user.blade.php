@extends('adminlte')
@section('content')
<!-- Content Header (Page header) -->
    <section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>user page</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="{{url('dashboard')}}">Dashboard</a></li>
                <li class="breadcrumb-item active">user</li>
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
        <h3 class="card-title">user</h3>
        </div>
        <div class="card-body">
            @if($message = Session::get('success'))
            <div class="alert alert-success">{{ $message }}</div>
            @endif

            <a href="{{ route('user.create') }}" class="btn btn-outline-success btn-lg">
                <i class="fas fa-plus-circle mr-2"></i>Tambah Data
            </a>

            <a href="{{ url('user/pdf') }}" class="btn btn-outline-warning btn-lg" target="_blank">
                <i class="fas fa-file-pdf mr-2"></i> Unduh PDF
            </a>
            <br>
            <br>

            <table class="table table-striped table-bordered" id="users">
                <thead class="thead-light" style="background-color: #f8f9fa;">
                    <tr>
                        <th style="text-align: center; vertical-align: middle;">username</th>
                        <th style="text-align: center; vertical-align: middle;">Nama Lengkap</th>
                        <th style="text-align: center; vertical-align: middle;">role</th>
                        <th style="text-align: center; vertical-align: middle;">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                @foreach ($user as $user)
                <tr>
                    <td style="text-align: center; vertical-align: middle;">{{ $user->username }}</td>
                    <td style="text-align: center; vertical-align: middle;">{{ $user->nama }}</td>
                    <td style="text-align: center; vertical-align: middle;">{{ $user->role }}</td>
                    <td>
                        <div class="row">
                            <div class="col-sm-4 mb-2">
                        <a href="{{ route('user.changepassword', $user->id) }}"  class="btn btn-block btn-outline-info btn-sm">
                            <i class="fas fa-edit mr-1"></i> Edit Password
                        </a>
                        </div>

                            <div class="col-sm-4 mb-2">
                        <a href="{{ route('user.edit', $user->id) }}" class="btn btn-block btn-outline-warning btn-sm">
                            <i class="fas fa-edit mr-1"></i> Edit
                        </a>
                        </div>

                            <div class="col-sm-4 mb-2">
                        <form action="{{ route('user.destroy', $user->id)}}" method="POST">
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