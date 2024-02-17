<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class productM extends Model
{
    use HasFactory;
    protected $table = "product";
    protected $fillable = ["nama_produk", "harga_produk", "jam_tayang"];

    public function studio()
    {
        return $this->belongsTo(studioM::class, 'id_studio');
    }

    public function kursi()
    {
        return $this->belongsTo(kursiM::class, 'id_kursi');
    }
}
 