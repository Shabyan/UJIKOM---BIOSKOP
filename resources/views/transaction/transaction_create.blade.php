@extends('adminlte')
@section('content')
<section class="content-header">
    <div class="container-fluid">
        <!-- Page Heading -->
        <h2 class="h3 mb-4 text-gray-800">transaction Page</h2>
    </div>
    <style>
        .seat-container {
            display: grid;
            grid-template-columns: repeat(6, 1fr); /* 6 kursi per baris */
            gap: 10px; /* Jarak antar kursi */
            justify-content: center;
            align-items: center;
            margin-top: 10px;
        }
    
        .seat {
            width: 40px;
            height: 40px;
            margin: 2.5px;
            display: flex;
            justify-content: center;
            align-items: center;
            background-color: #eee;
            cursor: pointer;
        }
    
        .seat:hover {
            background-color: rgb(191, 191, 191); /* Warna hijau saat kursor mengenai kursi */
        }
    
        .seat[data-status="booked"] {
         background-color: #f00; /* Warna untuk kursi yang sudah dipesan */
         cursor: not-allowed;
        }
    
        .seat + .seat {
            margin-left: 5px;
        }
    
        .selected {
            background-color: rgb(32, 255, 3); /* Warna biru untuk kursi yang dipilih */
            color: #fff; /* Warna teks putih untuk kontras */
        }
        
        /* .seat-container > .seat:nth-child(6n + 6) {
            margin-bottom: 10px; /* Sesuaikan jarak antara baris 
        } */
        
    </style>

    <section class="content">

    <div class="card">
        <div class="card-header">
            <h5 class="card-title">Tambah Data transaction</h5>
        </div>
        <div class="card-body">
            <a href="{{ route('transaction.index') }}" class="btn btn-secondary">Kembali</a>
            <br><br>

            <form action="{{ route('transaction.store') }}" method="POST">
            @csrf
            <div class="form-group">
                <label>Nomor Unik</label>
                <input name="nomor_unik" type="text" class="form-control" placeholder="Ex. asep" readonly value="{{ random_int(1000000000,9999999999) }}">
                @error('nomor_unik')
                    <p>{{ $message }}</p>
                @enderror
            </div>
            <div class="form-group">
                <label>Nama Pelanggan</label>
                <input name="nama_pelanggan" type="text" class="form-control" placeholder="Ex. asep">
                @error('nama_pelanggan')
                    <p>{{ $message }}</p>
                @enderror
            </div>
            <div class="form-group">
                <label>FilM</label>
                <select name="id_produk"  class="form-control" required>
                    <option>Pilih Film</option>
                    @foreach ($produk as $item)
                    <option value="{{ $item->id }}">
                        {{ $item->nama_produk }} - {{ $item->harga_produk }} - {{ $item->jam_tayang }} 
                    </option>
                    @endforeach
                </select>
                @error('id_produk')
                    <p>{{ $message }}</p>
                @enderror
            </div>
            <div class="form-group">
                <label>Studio</label>
                <select name="id_studio"  class="form-control" required>
                    <option >Pilih studio</option>
                    @foreach ($studio as $item)
                    <option value="{{ $item->id }}">
                        {{ $item->studio }}
                    @endforeach
                </select>
                @error('id_studio')
                    <p>{{ $message }}</p>
                @enderror
            </div>

            <label>Kursi</label> - 
            <input type="hidden" name="id_kursi" id="selected-id" readonly>
            <input type="text" name="kode_kursi" id="selected-seat" readonly>
                <div class="seat-container">
                    <!-- Sort kursi berdasarkan kode_kursi -->
                    @foreach ($kursi->sortBy('kode_kursi') as $item)
                        <div 
                            class="seat {{ $item->status == 'booked' ? 'booked' : '' }} {{ $item->status == 'selected' ? 'selected' : '' }}" 
                            data-status="{{ $item->status }}" 
                            data-seat-id="{{ $item->id }}"  {{-- Tambahkan data-seat-id --}}
                            data-seat="{{ $item->kode_kursi }}"
                            onclick="selectSeat('{{ $item->id }}', '{{ $item->kode_kursi }}')">                            
                        {{ $item->kode_kursi }}
                        </div>
                    @endforeach
                </div>

            <div class="form-group">
                <label>uang bayar</label>
                <input name="uang_bayar" type="text" class="form-control" placeholder="Ex. 90000">
                @error('uang_bayar')
                    <p>{{ $message }}</p>
                @enderror
            </div>
            <input type="submit" name="submit" class="btn btn-success" value="Tambah">
            </form>
        </div>
    </div>
<script>
        function selectSeat(id_kursi, kode_kursi) {
            // Menetapkan nilai id_kursi dan kode_kursi ke input tersembunyi
            document.getElementById('selected-id').value = id_kursi;
            document.getElementById('selected-seat').value = kode_kursi;
    
            // Menghapus kelas 'selected' dari semua kursi dan menambahkannya ke kursi yang dipilih
            var seats = document.querySelectorAll('.seat');
            seats.forEach(function(seat) {
                seat.classList.remove('selected');
            });
    
            // Menambahkan kelas 'selected' ke kursi yang dipilih
            var selectedSeat = document.querySelector('.seat[data-seat-id="' + id_kursi + '"]');
            selectedSeat.classList.add('selected');
        }
    </script>
</section> 
@endsection
