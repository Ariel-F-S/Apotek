@extends('layouts.master')

@section('title', 'Data Obat - PharmaCare Express')

@section('content')
{{-- Form Tambah Stok Obat Baru --}}
<div class="card border-apotek-mint shadow-sm rounded-4 mb-4">
    <div class="card-header bg-apotek-dark text-apotek-cream fw-bold py-3 rounded-top-4">
        <i class="fas fa-pills me-2"></i> Tambah Stok Obat Baru
    </div>
    <div class="card-body bg-white rounded-bottom-4">
        <form action="{{ route('obat.store') }}" method="POST" class="row g-3">
            @csrf
            <div class="col-md-3">
                <label class="form-label fw-semibold text-apotek-dark">Kode Obat</label>
                <input type="text" name="kode_obat" class="form-control border-apotek-sage" placeholder="OBT-004" required>
            </div>
            <div class="col-md-5">
                <label class="form-label fw-semibold text-apotek-dark">Nama Obat</label>
                <input type="text" name="nama_obat" class="form-control border-apotek-sage" placeholder="Amoxicillin 500mg" required>
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
            <div class="col-md-6">
                <label class="form-label fw-semibold text-apotek-dark">URL Gambar Produk (Opsional)</label>
                <input type="url" name="gambar" class="form-control border-apotek-sage" placeholder="https://...">
            </div>
            <div class="col-md-6">
                <label class="form-label fw-semibold text-apotek-dark">Keterangan / Dosis (Opsional)</label>
                <input type="text" name="deskripsi" class="form-control border-apotek-sage" placeholder="Diminum 3x1 sehari sesudah makan">
            </div>
            <div class="col-12 text-end">
                <button type="submit" class="btn btn-apotek-primary px-4 rounded-pill fw-bold">
                    <i class="fas fa-save me-1"></i> Simpan Data Obat
                </button>
            </div>
        </form>
    </div>
</div>

{{-- Tabel Inventaris Obat --}}
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
                                <div class="d-flex justify-content-center gap-1">
                                    {{-- Tombol Edit (Buka Modal) --}}
                                    <button type="button"
                                            class="btn btn-sm btn-outline-warning text-dark rounded-pill px-3"
                                            data-bs-toggle="modal"
                                            data-bs-target="#editObatModal{{ $obat->id }}"
                                            title="Ubah Data Obat">
                                        <i class="fas fa-edit"></i> Edit
                                    </button>

                                    {{-- Tombol Hapus --}}
                                    <form action="{{ route('obat.destroy', $obat->id) }}" method="POST" onsubmit="return confirm('Hapus obat {{ $obat->nama_obat }}?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-outline-danger rounded-pill px-3" title="Hapus Obat">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>

                        {{-- Modal Pop-Up Ubah Obat --}}
                        <div class="modal fade" id="editObatModal{{ $obat->id }}" tabindex="-1" aria-hidden="true">
                            <div class="modal-dialog modal-lg modal-dialog-centered">
                                <div class="modal-content rounded-4 border-0 shadow">
                                    <div class="modal-header bg-apotek-dark text-apotek-cream border-0 rounded-top-4">
                                        <h5 class="modal-title fw-bold">
                                            <i class="fas fa-edit me-2"></i> Ubah Data Obat: {{ $obat->nama_obat }}
                                        </h5>
                                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <form action="{{ route('obat.update', $obat->id) }}" method="POST">
                                        @csrf
                                        @method('PUT')
                                        <div class="modal-body p-4 bg-white">
                                            <div class="row g-3">
                                                <div class="col-md-4">
                                                    <label class="form-label fw-semibold text-apotek-dark">Kode Obat</label>
                                                    <input type="text" name="kode_obat" class="form-control border-apotek-sage" value="{{ $obat->kode_obat }}" required>
                                                </div>
                                                <div class="col-md-8">
                                                    <label class="form-label fw-semibold text-apotek-dark">Nama Obat</label>
                                                    <input type="text" name="nama_obat" class="form-control border-apotek-sage" value="{{ $obat->nama_obat }}" required>
                                                </div>
                                                <div class="col-md-6">
                                                    <label class="form-label fw-semibold text-apotek-dark">Kategori</label>
                                                    <select name="kategori_id" class="form-select border-apotek-sage" required>
                                                        @foreach($kategoris as $kat)
                                                            <option value="{{ $kat->id }}" {{ $obat->kategori_id == $kat->id ? 'selected' : '' }}>
                                                                {{ $kat->nama_kategori }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="col-md-6">
                                                    <label class="form-label fw-semibold text-apotek-dark">Satuan</label>
                                                    <select name="satuan" class="form-select border-apotek-sage" required>
                                                        <option value="Strip" {{ $obat->satuan == 'Strip' ? 'selected' : '' }}>Strip</option>
                                                        <option value="Botol" {{ $obat->satuan == 'Botol' ? 'selected' : '' }}>Botol</option>
                                                        <option value="Box" {{ $obat->satuan == 'Box' ? 'selected' : '' }}>Box</option>
                                                        <option value="Tube" {{ $obat->satuan == 'Tube' ? 'selected' : '' }}>Tube</option>
                                                    </select>
                                                </div>
                                                <div class="col-md-4">
                                                    <label class="form-label fw-semibold text-apotek-dark">Stok</label>
                                                    <input type="number" name="stok" class="form-control border-apotek-sage" min="0" value="{{ $obat->stok }}" required>
                                                </div>
                                                <div class="col-md-4">
                                                    <label class="form-label fw-semibold text-apotek-dark">Harga (Rp)</label>
                                                    <input type="number" name="harga" class="form-control border-apotek-sage" min="0" value="{{ $obat->harga }}" required>
                                                </div>
                                                <div class="col-md-4">
                                                    <label class="form-label fw-semibold text-apotek-dark">Tgl Kadaluarsa</label>
                                                    <input type="date" name="tanggal_kadaluarsa" class="form-control border-apotek-sage" value="{{ $obat->tanggal_kadaluarsa }}">
                                                </div>
                                                <div class="col-12">
                                                    <label class="form-label fw-semibold text-apotek-dark">URL Gambar Produk</label>
                                                    <input type="url" name="gambar" class="form-control border-apotek-sage" value="{{ $obat->gambar }}">
                                                </div>
                                                <div class="col-12">
                                                    <label class="form-label fw-semibold text-apotek-dark">Keterangan / Dosis</label>
                                                    <textarea name="deskripsi" class="form-control border-apotek-sage" rows="2">{{ $obat->deskripsi }}</textarea>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal-footer border-0 bg-light rounded-bottom-4">
                                            <button type="button" class="btn btn-outline-secondary rounded-pill px-4" data-bs-dismiss="modal">Batal</button>
                                            <button type="submit" class="btn btn-apotek-primary rounded-pill px-4 fw-bold">
                                                <i class="fas fa-save me-1"></i> Simpan Perubahan
                                            </button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
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