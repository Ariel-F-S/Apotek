<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use App\Models\Obat;
use Illuminate\Http\Request;

class ObatController extends Controller
{
    public function index()
    {
        $obats = Obat::with('kategori')->latest()->get();
        $kategoris = Kategori::all();
        return view('obat.index', compact('obats', 'kategoris'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'kategori_id' => 'required|exists:kategoris,id',
            'kode_obat' => 'required|unique:obats,kode_obat',
            'nama_obat' => 'required|string|max:255',
            'satuan' => 'required|string',
            'stok' => 'required|integer|min:0',
            'harga' => 'required|integer|min:0',
            'tanggal_kadaluarsa' => 'nullable|date',
        ]);

        Obat::create($request->all());
        return redirect()->route('obat.index')->with('success', 'Data obat berhasil ditambahkan!');
    }

    public function destroy(string $id)
{
    Obat::findOrFail($id)->delete();
    return redirect()->route('obat.index')->with('success', 'Data obat berhasil dihapus!');
}
}