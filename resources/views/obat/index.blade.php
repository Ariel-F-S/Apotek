@extends('layouts.master')

@section('title', 'Data Obat - PharmaCare Express')

@section('content')
<div class="card border-apotek-mint shadow-sm rounded-4 mb-4">
    <div class="card-header bg-apotek-dark text-apotek-cream fw-bold py-3 rounded-top-4">
        <i class="fas fa-pills me-2"></i> Tambah Stok Obat Baru
    </div>
    <div class="card-body bg-white rounded-bottom-4">
        <form action="{{ route('obat.store') }}" method="POST" class="row g-3">
            @csrf
            <div class="col-md-3">
                <label class="form-label fw-semibold text-apotek-dark">Kode Obat</label>
                <input type="text" name="kode_obat" class="form-control border-apotek-sage" placeholder="OBT-001" required>
            </div>
            <div class="col-md-5">
                <label class="form-label fw-semibold text-apotek-dark">Nama Obat</label>
                <input type="text" name="nama_obat" class="form-control border-apotek-sage" placeholder="Paracetamol 500mg" required>
            </div>
            <div class="col-md-4">
                <label class="form-label fw-semibold text-apotek-dark">Kategori</label>
                <select name="kategori_id" class="form-select border-apotek-sage" required>
                    <option value="" disabled selected>-- Pilih Kategori --</option>
                    @foreach($kategoris as $kat)
                        <option value="{{ $kat->id }}">{{ $kat->nama_kategori }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-3">
                <label class="form-label fw-semibold text-apotek-dark">Satuan</label>
                <select name="satuan" class="form-select border-apotek-sage" required>
                    <option value="Strip">Strip</option>
                    <option value="Botol">Botol</option>
                    <option value="Box">Box</option>
                    <option value="Tube">Tube</option>
                </select>
            </div>
            <div class="col-md-3">
                <label class="form-label fw-semibold text-apotek-dark">Stok</label>
                <input type="number" name="stok" class="form-control border-apotek-sage" min="0" value="10" required>
            </div>
            <div class="col-md-3">
                <label class="form-label fw-semibold text-apotek-dark">Harga (Rp)</label>
                <input type="number" name="harga" class="form-control border-apotek-sage" min="0" placeholder="15000" required>
            </div>
            <div class="col-md-3">
                <label class="form-label fw-semibold text-apotek-dark">Tgl Kadaluarsa</label>
                <input type="date" name="tanggal_kadaluarsa" class="form-control border-apotek-sage">
            </div>
            <div class="col-12 text-end">
                <button type="submit" class="btn btn-apotek-primary px-4 rounded-pill fw-bold">
                    <i class="fas fa-save me-1"></i> Simpan Data Obat
                </button>
            </div>
        </form>
    </div>
</div>

<div class="card border-apotek-mint shadow-sm rounded-4">
    <div class="card-header bg-white border-bottom d-flex justify-content-between align-items-center py-3 rounded-top-4">
        <h5 class="mb-0 fw-bold text-apotek-dark"><i class="fas fa-capsules me-2"></i> Inventaris Obat Apotek</h5>
        <span class="badge bg-apotek-cream text-apotek-dark border-apotek-sage">Akses: Apoteker</span>
    </div>
    <div class="card-body bg-white rounded-bottom-4">
        <div class="table-responsive">
            <table class="table table-hover align-middle">
                <thead class="table-light">
                    <tr>
                        <th>Kode</th>
                        <th>Nama Obat</th>
                        <th>Kategori</th>
                        <th>Stok</th>
                        <th>Harga</th>
                        <th>Kadaluarsa</th>
                        <th class="text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($obats as $obat)
                        <tr>
                            <td><span class="badge bg-apotek-mint text-dark">{{ $obat->kode_obat }}</span></td>
                            <td class="fw-bold text-apotek-dark">{{ $obat->nama_obat }}</td>
                            <td>{{ $obat->kategori->nama_kategori ?? '-' }}</td>
                            <td>{{ $obat->stok }} {{ $obat->satuan }}</td>
                            <td>Rp {{ number_format($obat->harga, 0, ',', '.') }}</td>
                            <td>{{ $obat->tanggal_kadaluarsa ?? '-' }}</td>
                            <td class="text-center">
                                <form action="{{ route('obat.destroy', $obat->id) }}" method="POST" onsubmit="return confirm('Hapus obat ini?')">
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
                            <td colspan="7" class="text-center text-muted py-4">Belum ada data obat. Tambahkan kategori obat terlebih dahulu.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection