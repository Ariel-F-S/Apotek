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

<br>
<div id="carouselExample" class="carousel carousel-dark slide" data-bs-ride="true" data-bs-interval="3000">
    <div class="carousel-inner">
        <div class="carousel-item active">
            <img src="{{ asset('medicine.jpg') }}" class="d-block w-100 carousel-img" alt="medicine">
        </div>
        <div class="carousel-item">
            <img src="{{ asset('healthy.jpg') }}" class="d-block w-100 carousel-img" alt="healthy">
        </div>
        <div class="carousel-item">
            <img src="{{ asset('sick.jpg') }}" class="d-block w-100 carousel-img" alt="sick">
        </div>
    </div>

    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExample" data-bs-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Previous</span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#carouselExample" data-bs-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Next</span>
    </button>
</div>

<div class="mt-5 mb-4">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h3 class="fw-bold text-apotek-dark mb-0">
            <i class="fas fa-prescription-bottle-alt me-2 text-apotek-sage"></i>Obat & Vitamin Pilihan
        </h3>
        <span class="badge bg-apotek-cream text-apotek-dark border-apotek-sage px-3 py-2 rounded-pill">
            Tersedia di Apotek
        </span>
    </div>

    <div class="row g-4">
        @forelse ($obatPilihan as $item)
            <div class="col-md-4">
                <div class="card shadow-sm h-100 bg-white obat-card">
                    <img src="{{ $item->gambar ?? 'https://images.unsplash.com/photo-1584308666744-24d5c474f2ae?auto=format&fit=crop&w=600&q=80' }}"
                         alt="{{ $item->nama_obat }}">
                    <div class="card-body d-flex flex-column p-4">
                        <div class="d-flex justify-content-between align-items-center mb-2">
                            <span class="badge bg-apotek-mint text-dark rounded-pill px-3">
                                {{ $item->kategori->nama_kategori ?? 'Umum' }}
                            </span>
                            <small class="text-muted fw-semibold">Stok: {{ $item->stok }} {{ $item->satuan }}</small>
                        </div>

                        <h5 class="fw-bold text-apotek-dark mb-1">{{ $item->nama_obat }}</h5>
                        <p class="fw-bold fs-5 text-success mb-3">
                            Rp{{ number_format($item->harga, 0, ',', '.') }}
                        </p>

                        <button type="button"
                                class="btn btn-apotek-primary rounded-pill mt-auto w-100 fw-semibold"
                                data-bs-toggle="modal"
                                data-bs-target="#detailObatModal{{ $item->id }}">
                            <i class="fas fa-info-circle me-1"></i> Lihat Detail
                        </button>
                    </div>
                </div>
            </div>
            <div class="modal fade" id="detailObatModal{{ $item->id }}" tabindex="-1" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content rounded-4 border-0 shadow">
                        <div class="modal-header bg-apotek-dark text-apotek-cream border-0 rounded-top-4">
                            <h5 class="modal-title fw-bold">{{ $item->nama_obat }}</h5>
                            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body p-4">
                            <img src="{{ $item->gambar ?? 'https://images.unsplash.com/photo-1584308666744-24d5c474f2ae?auto=format&fit=crop&w=600&q=80' }}"
                                 alt="{{ $item->nama_obat }}" class="img-fluid rounded-3 mb-3 w-100" style="height: 200px; object-fit: cover;">
                            <div class="d-flex justify-content-between align-items-center mb-2">
                                <span class="badge bg-apotek-cream text-apotek-dark border-apotek-sage">
                                    {{ $item->kategori->nama_kategori ?? 'Umum' }}
                                </span>
                                <span class="badge bg-apotek-mint text-dark">
                                    Stok: {{ $item->stok }} {{ $item->satuan }}
                                </span>
                            </div>
                            <h4 class="fw-bold text-success mb-2">Rp{{ number_format($item->harga, 0, ',', '.') }}</h4>
                            <p class="text-secondary mb-0">{{ $item->deskripsi ?? 'Obat resmi terdaftar dan diawasi oleh Apoteker PharmaCare Express.' }}</p>
                        </div>
                        <div class="modal-footer border-0">
                            <button type="button" class="btn btn-apotek-accent rounded-pill px-4" data-bs-dismiss="modal">Tutup</button>
                        </div>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-12">
                <div class="alert bg-white border-apotek-mint text-center text-muted py-4 rounded-4">
                    Belum ada data obat di database. Silakan login sebagai <strong>Apoteker</strong> untuk menambahkan data obat.
                </div>
            </div>
        @endforelse
    </div>
</div>
@endsection