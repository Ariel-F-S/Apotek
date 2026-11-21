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
@endsection