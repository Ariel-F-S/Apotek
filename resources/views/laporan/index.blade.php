@extends('layouts.master')

@section('title', 'Laporan Apotek - PharmaCare Express')

@section('content')
{{-- Ringkasan Statistik untuk Pimpinan --}}
<div class="row g-3 mb-4">
    <div class="col-md-4">
        <div class="card border-0 shadow-sm rounded-4 bg-apotek-dark text-white h-100">
            <div class="card-body p-4">
                <small class="text-apotek-cream text-uppercase fw-bold">Total Pendapatan</small>
                <h2 class="fw-bold mt-2 mb-0">Rp {{ number_format($totalPendapatan, 0, ',', '.') }}</h2>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card border-0 shadow-sm rounded-4 bg-apotek-sage text-white h-100">
            <div class="card-body p-4">
                <small class="text-apotek-cream text-uppercase fw-bold">Total Transaksi</small>
                <h2 class="fw-bold mt-2 mb-0">{{ $totalTransaksi }} Transaksi</h2>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card border-apotek-mint shadow-sm rounded-4 bg-white h-100">
            <div class="card-body p-4">
                <small class="text-apotek-dark text-uppercase fw-bold">Jenis Obat Terdaftar</small>
                <h2 class="fw-bold mt-2 mb-0 text-apotek-dark">{{ $totalJenisObat }} Item</h2>
            </div>
        </div>
    </div>
</div>

{{-- Tabel Rekap Laporan Penjualan --}}
<div class="card border-apotek-mint shadow-sm rounded-4">
    <div class="card-header bg-white border-bottom d-flex justify-content-between align-items-center py-3 rounded-top-4">
        <h5 class="mb-0 fw-bold text-apotek-dark"><i class="fas fa-file-invoice-dollar me-2"></i> Laporan Rekapitulasi Penjualan</h5>
        <button onclick="window.print()" class="btn btn-sm btn-apotek-primary rounded-pill px-3">
            <i class="fas fa-print me-1"></i> Cetak Laporan
        </button>
    </div>
    <div class="card-body bg-white rounded-bottom-4">
        <div class="table-responsive">
            <table class="table table-bordered align-middle">
                <thead class="bg-apotek-cream text-apotek-dark">
                    <tr>
                        <th>No</th>
                        <th>Kode Transaksi</th>
                        <th>Tanggal</th>
                        <th>Daftar Obat & Qty</th>
                        <th>Total</th>
                        <th>Kasir Bertugas</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($transaksis as $i => $trx)
                        <tr>
                            <td>{{ $i + 1 }}</td>
                            <td class="fw-bold">{{ $trx->kode_transaksi }}</td>
                            <td>{{ $trx->tanggal_transaksi }}</td>
                            <td>
                                <ul class="mb-0 ps-3 small">
                                    @foreach($trx->details as $det)
                                        <li>{{ $det->obat->nama_obat ?? 'Obat' }} ({{ $det->jumlah }}x)</li>
                                    @endforeach
                                </ul>
                            </td>
                            <td class="fw-bold text-apotek-dark">Rp {{ number_format($trx->total_harga, 0, ',', '.') }}</td>
                            <td>{{ $trx->user->name ?? '-' }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center text-muted py-4">Belum ada data penjualan yang terekam.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection