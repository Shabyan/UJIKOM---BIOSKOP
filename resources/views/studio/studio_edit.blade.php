@extends('adminlte')
@section('content')
<section class="content-header">
    <div class="container-fluid">
        <!-- Page Heading -->
        <h2 class="h3 mb-4 text-gray-800">Studio Page</h2>
    </div>

    <section class="content">

    <div class="card">
        <div class="card-header">
            <h5 class="card-title">Edit Data Studio</h5>
        </div>
        <div class="card-body">
            <a href="{{ route('studio.index') }}" class="btn btn-secondary">Kembali</a>
            <br><br>

            <form action="{{ route('studio.update', $studio->id) }}" method="POST">
            @csrf
            @method('put')
            <div class="form-group">
                <label>Studio</label>
                <input name="studio" type="text" class="form-control" placeholder="Ex. asep123" value="{{ $studio->studio }}">
                @error('studio')
                    <p>{{ $message }}</p>
                @enderror
            </div>
            <input type="submit" name="submit" class="btn btn-success" value="Edit">
            </form>
        </div>
    </div>

</section> 
@endsection
