@extends('adminlte')
@section('content')
 <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Dashboard Page</h1>
                </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item active">Dashboard</li>
                </ol>
            </div>
        </div><!-- /.container-fluid -->
  </section>
    <!-- Main content -->
    <div class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box">
              <span class="info-box-icon bg-info elevation-1"><i class="nav-icon fas fa-film"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Film</span>
                <div class="count">{{ $totalproduct }}</div>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->
          <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box mb-3">
              <span class="info-box-icon bg-danger elevation-1"><i class="nav-icon fas fa-dollar-sign"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Transactions</span>
                <div class="count">{{ $totaltransaction }}</div>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->

          <!-- fix for small devices only -->
          <div class="clearfix hidden-md-up"></div>

          <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box mb-3">
              <span class="info-box-icon bg-success elevation-1"><i class="fas fa-money-bill"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Income</span>
                <div class="count">Rp.{{ number_format($totaluangbayar) }}</div>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->
          <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box mb-3">
              <span class="info-box-icon bg-warning elevation-1"><i class="fas fa-users"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Member</span>
                <div class="count">{{ $totaluser }}</div>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->
        </div>
        <body>
          <header style="background: linear-gradient(to right, rgb(194, 194, 194), rgb(112, 108, 108), rgb(146, 146, 146)); color: #d2d2d2; text-align: center; padding: 20px; border-bottom-left-radius: 20px; border-bottom-right-radius: 20px; position: relative;">
              <h1 style="margin: 0; font-size: 36px; text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.5);">Selamat Datang - TiketCine {{ Auth::user()->name }}</h1>
          </header>
          <br>
          <div class="container">
              <div class="row">
                  <div class="col-md-6 mb-4">
                      <a href="{{ url('/transaction') }}" class="text-decoration-none text-dark">
                          <div id="imageCarousel1" class="carousel slide" data-ride="carousel" style="height: 720px; overflow: hidden;">
                              <div class="carousel-inner">
                                  <div class="carousel-item active">
                                      <img src="dist/img/JujutsuKaisen0.jpg" alt="Hotel 1" class="d-block w-100" style="height: 100%;">
                                      <div class="carousel-caption">
                                          <h5>Jujur Kasian</h5>
                                          <p>.</p>
                                      </div>
                                  </div>
                                  <div class="carousel-item">
                                      <img src="dist/img/kimetsu no yaiba the movie mugen train.jpg" alt="Hotel 2" class="d-block w-100" style="height: 100%;">
                                      <div class="carousel-caption">
                                          <h5>kimetsu no yaiba</h5>
                                          <p>.</p>
                                      </div>
                                  </div>
                                  <div class="carousel-item">
                                      <img src="dist/img/KiminoNawa.png" alt="Hotel 3" class="d-block w-100" style="height: 100%;">
                                      <div class="carousel-caption">
                                          <h5>Kimi no nawa</h5>
                                          <p>.</p>
                                      </div>
                                  </div>
                              </div>
                              <a class="carousel-control-prev" href="#imageCarousel1" role="button" data-slide="prev">
                                  <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                  <span class="sr-only">Previous</span>
                              </a>
                              <a class="carousel-control-next" href="#imageCarousel1" role="button" data-slide="next">
                                  <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                  <span class="sr-only">Next</span>
                              </a>
                          </div>
                      </a>
                  </div>
                  <div class="col-md-6 mb-4">
                      <a href="{{ url('/transaction') }}" class="text-decoration-none text-dark">
                          <div id="imageCarousel2" class="carousel slide" data-ride="carousel" style="height: 720px; overflow: hidden;">
                              <div class="carousel-inner">
                                  <div class="carousel-item active">
                                      <img src="dist/img/suzume.jpg" alt="Your New Image" class="d-block w-100" style="height: 100%;">
                                      <div class="carousel-caption">
                                          <h5></h5>
                                          <p>.</p>
                                      </div>
                                  </div>
                              </div>
                          </div>
                      </a>
                  </div>
              </div>
          </div>
      </body>      
        <!-- /.row -->
      </div>
      <!-- /.container-fluid -->
    </div>
    <!-- /.content -->
  <!-- /.content-wrapper -->
@endsection
