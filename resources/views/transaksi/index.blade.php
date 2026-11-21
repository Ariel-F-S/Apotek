@extends('layouts.master')

@section('title', 'Transaksi Penjualan - PharmaCare Express')

@section('content')
<div class="row g-4">
    {{-- Form Input Kasir --}}
    <div class="col-md-4">
        <div class="card border-apotek-mint shadow-sm rounded-4">
            <div class="card-header bg-apotek-dark text-apotek-cream fw-bold rounded-top-4">
                <i class="fas fa-cash-register me-2"></i> Kasir Penjualan
            </div>
            <div class="card-body bg-white rounded-bottom-4">
                <form action="{{ route('transaksi.store') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label class="form-label fw-semibold text-apotek-dark">Pilih Obat</label>
                        <select name="obat_id" class="form-select border-apotek-sage" required>
                            <option value="" disabled selected>-- Pilih Obat Tersedia --</option>
                            @foreach($obats as $obat)
                                <option value="{{ $obat->id }}">
                                    {{ $obat->nama_obat }} (Stok: {{ $obat->stok }} | Rp {{ number_format($obat->harga, 0, ',', '.') }})
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-semibold text-apotek-dark">Jumlah Beli</label>
                        <input type="number" name="jumlah" class="form-control border-apotek-sage" min="1" value="1" required>
                    </div>
                    <button type="submit" class="btn btn-apotek-accent w-100 rounded-pill py-2 shadow-sm">
                        <i class="fas fa-check-circle me-1"></i> Proses Transaksi
                    </button>
                </form>
            </div>
        </div>
    </div>

    {{-- Riwayat Transaksi --}}
    <div class="col-md-8">
        <div class="card border-apotek-mint shadow-sm rounded-4">
            <div class="card-header bg-white border-bottom d-flex justify-content-between align-items-center py-3 rounded-top-4">
                <h5 class="mb-0 fw-bold text-apotek-dark"><i class="fas fa-receipt me-2"></i> Riwayat Transaksi Kasir</h5>
                <span class="badge bg-apotek-cream text-apotek-dark border-apotek-sage">Kasir: {{ Auth::user()->name }}</span>
            </div>
            <div class="card-body bg-white rounded-bottom-4">
                <div class="table-responsive">
                    <table class="table table-hover align-middle">
                        <thead class="table-light">
                            <tr>
                                <th>Kode TRX</th>
                                <th>Tanggal</th>
                                <th>Nama Obat</th>
                                <th>Qty</th>
                                <th>Total Harga</th>
                                <th>Kasir</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($transaksis as $trx)
                                <tr>
                                    <td><span class="badge bg-apotek-dark text-apotek-cream">{{ $trx->kode_transaksi }}</span></td>
                                    <td>{{ $trx->tanggal_transaksi }}</td>
                                    <td class="fw-bold text-apotek-dark">{{ $trx->obat->nama_obat ?? '-' }}</td>
                                    <td>{{ $trx->jumlah }}</td>
                                    <td class="fw-bold text-success">Rp {{ number_format($trx->total_harga, 0, ',', '.') }}</td>
                                    <td>{{ $trx->user->name ?? '-' }}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="text-center text-muted py-4">Belum ada transaksi penjualan hari ini.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection