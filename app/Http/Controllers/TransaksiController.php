<?php

namespace App\Http\Controllers;

use App\Models\Obat;
use App\Models\Transaksi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class TransaksiController extends Controller
{
    public function index()
    {
        $obats = Obat::where('stok', '>', 0)->get();
        $transaksis = Transaksi::with(['obat', 'user'])->latest()->get();
        return view('transaksi.index', compact('obats', 'transaksis'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'obat_id' => 'required|exists:obats,id',
            'jumlah' => 'required|integer|min:1',
        ]);

        $obat = Obat::findOrFail($request->obat_id);

        if ($obat->stok < $request->jumlah) {
            return back()->with('error', 'Stok obat tidak mencukupi! Sisa stok: ' . $obat->stok);
        }

        Transaksi::create([
            'kode_transaksi' => 'TRX-' . strtoupper(Str::random(6)),
            'user_id' => Auth::id(),
            'obat_id' => $obat->id,
            'jumlah' => $request->jumlah,
            'total_harga' => $obat->harga * $request->jumlah,
            'tanggal_transaksi' => now()->toDateString(),
        ]);

        // Kurangi stok obat
        $obat->decrement('stok', $request->jumlah);

        return redirect()->route('transaksi.index')->with('success', 'Transaksi penjualan berhasil dicatat!');
    }
}