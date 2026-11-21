<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use Illuminate\Http\Request;

class KategoriController extends Controller
{
    public function index()
    {
        $kategoris = Kategori::latest()->get();
        return view('kategori.index', compact('kategoris'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_kategori' => 'required|string|max:255',
            'keterangan' => 'nullable|string',
        ]);

        Kategori::create($request->all());
        return redirect()->route('kategori.index')->with('success', 'Kategori obat berhasil ditambahkan!');
    }

    public function destroy(string $id)
{
    Kategori::findOrFail($id)->delete();
    return redirect()->route('kategori.index')->with('success', 'Kategori obat berhasil dihapus!');
}
}