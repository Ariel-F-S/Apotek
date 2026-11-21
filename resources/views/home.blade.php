@extends('layouts.master')

@section('title', 'Beranda - PharmaCare Express')

@section('content')

<div class="card shadow-sm mb-4 rounded-4 bg-white" style="border: 1px solid #B9D4AA;">
    <div class="card-body d-flex flex-column flex-md-row justify-content-between align-items-md-center p-4">
        <div>
            <span class="badge px-3 py-2 rounded-pill mb-2" style="background-color: #FAFFCA; color: #5A827E; border: 1px solid #84AE92;">
                <i class="fas fa-user-shield me-1"></i> Status Login: <strong>{{ strtoupper(Auth::user()->usertype) }}</strong>
            </span>
            <h3 class="fw-bold mb-1" style="color: #5A827E;">
                Selamat Datang, {{ Auth::user()->name }}!
            </h3>
            <p class="text-muted mb-0">
                Anda login sebagai <strong style="color: #5A827E;">{{ ucfirst(Auth::user()->usertype) }}</strong> di sistem manajemen <strong>PharmaCare Express</strong>.
            </p>
        </div>

        <div class="mt-3 mt-md-0">
            @if(Auth::user()->usertype == 'pimpinan')
                <a href="{{ route('laporan.index') }}" class="btn btn-apotek-primary btn-lg rounded-pill px-4 shadow-sm">
                    <i class="fas fa-chart-line me-2"></i> Buka Laporan Apotek
                </a>
            @elseif(Auth::user()->usertype == 'apoteker')
                <a href="{{ route('obat.index') }}" class="btn btn-apotek-primary btn-lg rounded-pill px-4 shadow-sm">
                    <i class="fas fa-pills me-2"></i> Kelola Data Obat
                </a>
            @elseif(Auth::user()->usertype == 'kasir')
                <a href="{{ route('transaksi.index') }}" class="btn btn-apotek-accent btn-lg rounded-pill px-4 shadow-sm">
                    <i class="fas fa-cash-register me-2"></i> Mulai Transaksi
                </a>
            @endif
        </div>
    </div>
</div>

<div id="heroApotekCarousel" class="carousel slide position-relative" data-bs-ride="carousel">
    <div class="carousel-inner p-1">

        {{-- Slide 1 --}}
        <div class="carousel-item active">
            <div class="hero-card">
                <div class="row g-0 align-items-center">
                   
                <div class="col-lg-5 hero-left">
                        <div class="hero-brand mb-2">
                            <span style="color: #5A827E;">PHARMA</span><span style="color: #84AE92;">CARE</span>
                        </div>
                        <h1 class="hero-title mb-3">
                            OBAT & ALAT KESEHATAN TERLENGKAP!
                        </h1>
                        <p class="text-secondary mb-4">
                            Dapatkan obat resep, vitamin, suplemen, dan perlengkapan medis terpercaya untuk keluarga Anda.
                        </p>

                        <div class="d-flex align-items-center gap-3 flex-wrap">
                            @if(Auth::user()->usertype == 'apoteker')
                                <a href="{{ route('obat.index') }}" class="btn btn-apotek-accent px-4 py-2 rounded-pill shadow-sm">
                                    KELOLA STOK OBAT <i class="fas fa-arrow-right ms-2"></i>
                                </a>
                            @elseif(Auth::user()->usertype == 'kasir')
                                <a href="{{ route('transaksi.index') }}" class="btn btn-apotek-accent px-4 py-2 rounded-pill shadow-sm">
                                    LAYANI PEMBELI <i class="fas fa-arrow-right ms-2"></i>
                                </a>
                            @else
                                <a href="{{ route('laporan.index') }}" class="btn btn-apotek-accent px-4 py-2 rounded-pill shadow-sm">
                                    CEK LAPORAN <i class="fas fa-arrow-right ms-2"></i>
                                </a>
                            @endif

                            <span class="badge p-2 rounded-3 shadow-sm" style="background-color: #B9D4AA; color: #243b39;">
                                <small class="d-block" style="font-size: 0.65rem;">LAYANAN</small>
                                <strong class="fs-6">24 JAM</strong>
                            </span>
                        </div>
                    </div>

                    <div class="col-lg-7">
                        <div class="hero-right-wrapper">
                            <div class="hero-right">
                                <img src="{{ asset('images/banner/apotek-hero-1.jpg') }}"
                                     onerror="this.src='https://images.unsplash.com/photo-1587854692152-cbe660dbde88?auto=format&fit=crop&w=1000&q=80'"
                                     alt="Layanan Apotek" class="main-photo">

                                <div class="mini-gallery">
                                    <div class="mini-item" title="Obat Tablet & Kapsul">
                                        <img src="https://cdn-icons-png.flaticon.com/512/883/883407.png" alt="Kapsul">
                                    </div>
                                    <div class="mini-item" title="Sirup & Obat Cair">
                                        <img src="https://cdn-icons-png.flaticon.com/512/3004/3004458.png" alt="Sirup">
                                    </div>
                                    <div class="mini-item" title="Vitamin & Suplemen">
                                        <img src="https://cdn-icons-png.flaticon.com/512/2966/2966327.png" alt="Vitamin">
                                    </div>
                                    <div class="mini-item" title="Kotak P3K & Alkes">
                                        <img src="https://cdn-icons-png.flaticon.com/512/2382/2382461.png" alt="P3K">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="carousel-item">
            <div class="hero-card">
                <div class="row g-0 align-items-center">
                    <div class="col-lg-5 hero-left">
                        <div class="hero-brand mb-2">
                            <span style="color: #5A827E;">PHARMA</span><span style="color: #84AE92;">EXPRESS</span>
                        </div>
                        <h1 class="hero-title mb-3">
                            PELAYANAN CEPAT & TERINTEGRASI!
                        </h1>
                        <p class="text-secondary mb-4">
                            Pantau stok obat kadaluarsa, transaksi kasir harian, dan laporan keuangan apotek secara real-time.
                        </p>
                        <span class="badge px-3 py-2 rounded-pill" style="background-color: #5A827E; color: #FAFFCA;">
                            <i class="fas fa-check-circle me-1"></i> Terverifikasi BPOM & Apoteker Resmi
                        </span>
                    </div>

                    <div class="col-lg-7">
                        <div class="hero-right-wrapper">
                            <div class="hero-right">
                                <img src="{{ asset('images/banner/apotek-hero-2.jpg') }}"
                                     onerror="this.src='https://images.unsplash.com/photo-1576602976047-174e57a47881?auto=format&fit=crop&w=1000&q=80'"
                                     alt="Rak Obat Apotek" class="main-photo">

                                <div class="mini-gallery">
                                    <div class="mini-item">
                                        <img src="https://cdn-icons-png.flaticon.com/512/4320/4320371.png" alt="Stetoskop">
                                    </div>
                                    <div class="mini-item">
                                        <img src="https://cdn-icons-png.flaticon.com/512/2966/2966486.png" alt="Termometer">
                                    </div>
                                    <div class="mini-item">
                                        <img src="https://cdn-icons-png.flaticon.com/512/2864/2864350.png" alt="Masker Medis">
                                    </div>
                                    <div class="mini-item">
                                        <img src="https://cdn-icons-png.flaticon.com/512/3209/3209074.png" alt="Resep Dokter">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <button class="carousel-control-prev" type="button" data-bs-target="#heroApotekCarousel" data-bs-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Previous</span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#heroApotekCarousel" data-bs-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Next</span>
    </button>
</div>
@endsection