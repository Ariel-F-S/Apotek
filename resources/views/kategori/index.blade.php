@extends('layouts.master')

@section('title', 'Kategori Obat - PharmaCare Express')

@section('content')
<div class="row g-4">
    {{-- Form Tambah Kategori --}}
    <div class="col-md-4">
        <div class="card border-apotek-mint shadow-sm rounded-4">
            <div class="card-header bg-apotek-dark text-apotek-cream fw-bold rounded-top-4">
                <i class="fas fa-tags me-2"></i> Tambah Kategori Obat
            </div>
            <div class="card-body bg-white rounded-bottom-4">
                <form action="{{ route('kategori.store') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label class="form-label fw-semibold text-apotek-dark">Nama Kategori</label>
                        <input type="text" name="nama_kategori" class="form-control border-apotek-sage" placeholder="Misal: Obat Bebas / Vitamin" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-semibold text-apotek-dark">Keterangan</label>
                        <textarea name="keterangan" class="form-control border-apotek-sage" rows="3" placeholder="Deskripsi singkat kategori..."></textarea>
                    </div>
                    <button type="submit" class="btn btn-apotek-primary w-100 rounded-pill fw-bold">
                        <i class="fas fa-plus-circle me-1"></i> Simpan Kategori
                    </button>
                </form>
            </div>
        </div>
    </div>

    {{-- Tabel Daftar Kategori --}}
    <div class="col-md-8">
        <div class="card border-apotek-mint shadow-sm rounded-4">
            <div class="card-header bg-white border-bottom d-flex justify-content-between align-items-center py-3 rounded-top-4">
                <h5 class="mb-0 fw-bold text-apotek-dark"><i class="fas fa-list me-2"></i> Daftar Kategori Obat</h5>
                <span class="badge bg-apotek-cream text-apotek-dark border-apotek-sage">Akses: Apoteker</span>
            </div>
            <div class="card-body bg-white rounded-bottom-4">
                <div class="table-responsive">
                    <table class="table table-hover align-middle">
                        <thead class="table-light">
                            <tr>
                                <th>No</th>
                                <th>Nama Kategori</th>
                                <th>Keterangan</th>
                                <th class="text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($kategoris as $index => $item)
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td class="fw-bold text-apotek-dark">{{ $item->nama_kategori }}</td>
                                    <td>{{ $item->keterangan ?? '-' }}</td>
                                    <td class="text-center">
                                        <form action="{{ route('kategori.destroy', $item->id) }}" method="POST" onsubmit="return confirm('Hapus kategori ini?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-outline-danger rounded-pill px-3">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="text-center text-muted py-4">Belum ada data kategori obat.</td>
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