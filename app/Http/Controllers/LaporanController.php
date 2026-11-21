<?php

namespace App\Http\Controllers;

use App\Models\Obat;
use App\Models\Transaksi;

class LaporanController extends Controller
{
    public function index()
    {
        $totalPendapatan = Transaksi::sum('total_harga');
        $totalTransaksi = Transaksi::count();
        $totalJenisObat = Obat::count();
        $stokMenipis = Obat::where('stok', '<=', 5)->get();
        $transaksis = Transaksi::with(['details.obat', 'user'])->latest()->get();

        return view('laporan.index', compact(
            'totalPendapatan',
            'totalTransaksi',
            'totalJenisObat',
            'stokMenipis',
            'transaksis'
        ));
    }
}