@extends('adminlte')
@section('content')
<!-- Content Header (Page header) -->
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>History  page</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="{{url('dashboard')}}">Dashboard</a></li>
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
        <h3 class="card-title">daftar aktifitas</h3>
        </div>
        <div class="card-body">
            <table class="table table-striped table-bordered" id="users">
                <thead class="thead-light" style="background-color: #f8f9fa;">
                    <tr>
                        <th>Nama User</th>
                        <th>aktifitas</th>
                        <th>Tanggal</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($data as $log)
                    <tr>
                        <td>{{ $log->nama }}</td>
                        <td>{{ $log->activity }}</td>
                        <td>{{ $log->created_at->toDayDateTimeString() }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    <!-- /.card -->
</section>
<!-- /.content -->
@endsection