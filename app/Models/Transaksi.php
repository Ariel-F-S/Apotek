<?php

namespace App\Models;

use App\Models\Obat;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model
{
    protected $fillable = [
        'kode_transaksi', 'user_id', 'obat_id', 'jumlah', 'total_harga', 'tanggal_transaksi'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function obat()
    {
        return $this->belongsTo(Obat::class);
    }
}