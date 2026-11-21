<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Obat extends Model
{
    protected $fillable = [
        'kategori_id', 'kode_obat', 'nama_obat', 'satuan', 'stok', 'harga', 'tanggal_kadaluarsa'
    ];

    public function kategori()
    {
        return $this->belongsTo(Kategori::class);
    }
}