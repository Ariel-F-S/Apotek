<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DetailTransaksi extends Model
{
    protected $fillable = [
        'transaksi_id', 'obat_id', 'jumlah', 'harga_satuan', 'subtotal'
    ];

    public function obat()
    {
        return $this->belongsTo(Obat::class);
    }
}