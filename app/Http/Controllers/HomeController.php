<?php

namespace App\Http\Controllers;

use App\Models\Obat;

class HomeController extends Controller
{
    public function index()
    {
        $obatPilihan = Obat::with('kategori')->latest()->take(6)->get();

        return view('home', compact('obatPilihan'));
    }
}