<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Keranjang extends Model
{
    protected $table = 'keranjang';
    protected $primaryKey = 'id_keranjang';
    protected $fillable = ['produk_id', 'pembeli_id', 'pembeli_type', 'jumlah', 'harga_jual'];

    public function produk()
    {
        return $this->belongsTo(Produk::class, 'produk_id', 'id_produk');
    }

    public function pembeli()
    {
        return $this->morphTo();
    }

    // public function konsumen()
    // {
    //     return $this->belongsTo(Konsumen::class, 'konsumen_id', 'id_konsumen');
    // }

    // public function pelapak()
    // {
    //     return $this->belongsTo(Pelapak::class, 'konsumen_id', 'id_pelapak');
    // }
}
