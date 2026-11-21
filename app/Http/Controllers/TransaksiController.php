<?php

namespace App\Http\Controllers;

use App\Models\DetailTransaksi;
use App\Models\Obat;
use App\Models\Transaksi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class TransaksiController extends Controller
{
    public function index()
    {
        $obats = Obat::where('stok', '>', 0)->get();
        $transaksis = Transaksi::with(['details.obat', 'user'])->latest()->get();
        return view('transaksi.index', compact('obats', 'transaksis'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'items' => 'required|array|min:1',
            'items.*.obat_id' => 'required|exists:obats,id',
            'items.*.jumlah' => 'required|integer|min:1',
            'uang_bayar' => 'required|integer|min:0',
        ]);

        try {
            $trx = DB::transaction(function () use ($request) {
                $totalHarga = 0;
                $detailData = [];

                foreach ($request->items as $item) {
                    $obat = Obat::lockForUpdate()->findOrFail($item['obat_id']);

                    if ($obat->stok < $item['jumlah']) {
                        throw new \Exception("Stok {$obat->nama_obat} tidak mencukupi! Sisa: {$obat->stok}");
                    }

                    $subtotal = $obat->harga * $item['jumlah'];
                    $totalHarga += $subtotal;

                    $detailData[] = [
                        'obat' => $obat,
                        'jumlah' => $item['jumlah'],
                        'harga_satuan' => $obat->harga,
                        'subtotal' => $subtotal,
                    ];
                }

                if ($request->uang_bayar < $totalHarga) {
                    throw new \Exception('Uang bayar kurang! Total belanja: Rp ' . number_format($totalHarga, 0, ',', '.'));
                }

                $transaksi = Transaksi::create([
                    'kode_transaksi' => 'TRX-' . strtoupper(Str::random(6)),
                    'user_id' => Auth::id(),
                    'total_harga' => $totalHarga,
                    'uang_bayar' => $request->uang_bayar,
                    'kembalian' => $request->uang_bayar - $totalHarga,
                    'tanggal_transaksi' => now()->toDateString(),
                ]);

                foreach ($detailData as $d) {
                    DetailTransaksi::create([
                        'transaksi_id' => $transaksi->id,
                        'obat_id' => $d['obat']->id,
                        'jumlah' => $d['jumlah'],
                        'harga_satuan' => $d['harga_satuan'],
                        'subtotal' => $d['subtotal'],
                    ]);

                    $d['obat']->decrement('stok', $d['jumlah']);
                }

                return $transaksi;
            });

            return redirect()->route('transaksi.index')
                ->with('success', 'Transaksi ' . $trx->kode_transaksi . ' berhasil! Kembalian: Rp ' . number_format($trx->kembalian, 0, ',', '.'));
        } catch (\Exception $e) {
            return back()->with('error', $e->getMessage());
        }
    }

    public function nota(string $id)
    {
        $transaksi = Transaksi::with(['details.obat', 'user'])->findOrFail($id);
        return view('transaksi.nota', compact('transaksi'));
    }
}