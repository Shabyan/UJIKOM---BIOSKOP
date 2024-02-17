<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class transactionM extends Model
{
    use HasFactory;
    protected $table = "transaction";
    protected $fillable = ["nomor_unik", "nama_pelanggan", "id_produk", "id_studio", "id_kursi", "uang_bayar", "uang_kembali"];
}
