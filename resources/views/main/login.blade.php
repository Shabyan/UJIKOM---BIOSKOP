<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>TiketCine | {{ $subtittle }}</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{ url('plugins/fontawesome-free/css/all.min.css') }}">
  <!-- Bootstrap 4 -->
  <link rel="stylesheet" href="{{ url('plugins/bootstrap/css/bootstrap.min.css') }}">
  <!-- AdminLTE App -->
  <link rel="stylesheet" href="{{ url('dist/css/adminlte.min.css') }}">

  <style>
    /* Custom styles for login page */
    body {
      background-image: url('path/to/your/background/image.jpg');
      background-size: cover;
      background-position: center;
    }
    .login-box {
  position: absolute;
  top: 50%;
  left: 50%;
  transform: translate(-50%, -50%);
}

    .card-outline.card-primary {
      border: 2px solid #a7a7a7;
      box-shadow: 0 0 20px rgba(0, 0, 0, 0.2);
    }
    .card-header {
      background-color: #909090;
      color: #fff;
      border-bottom: none;
    }
    .login-box-msg {
      font-weight: bold;
      color: #333;
    }
    .input-group-text {
      background-color: #f8f9fa;
    }
    .btn-primary {
      background-color: #aeaeae;
      border-color: #bbbbbb;
    }
    .btn-primary:hover {
      background-color: #9f9f9f;
      border-color: #c4c4c4;
    }
    .center-image {
      display: flex;
      justify-content: center;
      align-items: center;
      margin-bottom: 20px; /* Tambahkan margin bawah agar tidak terlalu rapat dengan teks */
    }
    .center-image img {
      max-width: 180px; /* Ubah lebar maksimum gambar */
      height: auto;
    }
  </style>
</head>
<body class="hold-transition login-page">
  <div class="login-box">
    <div class="card card-outline card-primary">
      <div class="card-header text-center">
        <a href="dashboard" class="h1"><b>Tiket</b>Cine</a>
      </div>
      <br>
      <div class="center-image">
        <img src="dist/img/Logo_tiketcine.png" alt="Logo" class="brand-image img-30 img-circle elevation-3" style="opacity: .8">
      </div>
      <div class="card-body">
        <p class="login-box-msg">Login Sebelum Masuk Ke Aplikasi</p>

        @if($errors->any())
        @foreach($errors->all() as $err)
        <p class="alert alert-danger">{{ $err }}</p>
        @endforeach
        @endif
        
        <form action="{{ route('login.action') }}" method="POST">
          @csrf
          <div class="input-group mb-3">
            <input name="username" type="text" value="{{ old('username') }}" class="form-control" placeholder="username">
            <div class="input-group-append">
              <div class="input-group-text">
                <span class="fas fa-envelope"></span>
              </div>
            </div>
          </div>
          <div class="input-group mb-3">
            <input name="password" type="password" class="form-control" placeholder="Password">
            <div class="input-group-append">
              <div class="input-group-text">
                <span class="fas fa-lock"></span>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-12">
              <button type="submit" class="btn btn-primary btn-block">Sign In</button>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>

  <!-- jQuery -->
  <script src="{{ url('plugins/jquery/jquery.min.js') }}"></script>
  <!-- Bootstrap 4 -->
  <script src="{{ url('plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
  <!-- AdminLTE App -->
  <script src="{{ url('dist/js/adminlte.min.js') }}"></script>
</body>
</html>
