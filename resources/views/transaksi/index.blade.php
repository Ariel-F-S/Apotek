@extends('layouts.master')

@section('title', 'Transaksi Penjualan - PharmaCare Express')

@section('content')
<div class="row g-4">
    {{-- Kiri: Form Tambah Item ke Keranjang & Pembayaran --}}
    <div class="col-lg-5">
        <div class="card border-apotek-mint shadow-sm rounded-4">
            <div class="card-header bg-apotek-dark text-apotek-cream fw-bold py-3 rounded-top-4">
                <i class="fas fa-cash-register me-2"></i> Kasir Penjualan
            </div>
            <div class="card-body bg-white rounded-bottom-4 p-4">
                {{-- Pilih Obat untuk dimasukkan ke keranjang --}}
                <div class="row g-2 mb-3">
                    <div class="col-8">
                        <label class="form-label fw-semibold text-apotek-dark small">Pilih Obat</label>
                        <select id="pilihObat" class="form-select border-apotek-sage">
                            <option value="" data-nama="" data-harga="0" data-stok="0" disabled selected>-- Pilih Obat --</option>
                            @foreach($obats as $obat)
                                <option value="{{ $obat->id }}"
                                        data-nama="{{ $obat->nama_obat }}"
                                        data-harga="{{ $obat->harga }}"
                                        data-stok="{{ $obat->stok }}">
                                    {{ $obat->nama_obat }} (Stok: {{ $obat->stok }} | Rp {{ number_format($obat->harga, 0, ',', '.') }})
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-4">
                        <label class="form-label fw-semibold text-apotek-dark small">Qty</label>
                        <input type="number" id="pilihQty" class="form-control border-apotek-sage" min="1" value="1">
                    </div>
                </div>

                <button type="button" id="btnTambahKeranjang" class="btn btn-apotek-accent w-100 rounded-pill mb-3">
                    <i class="fas fa-cart-plus me-1"></i> Tambah ke Keranjang
                </button>

                <hr>

                {{-- Form Utama Keranjang Belanja --}}
                <form action="{{ route('transaksi.store') }}" method="POST" id="formKasir">
                    @csrf
                    <div class="table-responsive mb-3">
                        <table class="table table-sm table-bordered align-middle mb-0" id="tabelKeranjang">
                            <thead class="bg-apotek-cream text-apotek-dark small">
                                <tr>
                                    <th>Obat</th>
                                    <th class="text-center">Qty</th>
                                    <th class="text-end">Subtotal</th>
                                    <th class="text-center">#</th>
                                </tr>
                            </thead>
                            <tbody id="isiKeranjang">
                                <tr id="barisKosong">
                                    <td colspan="4" class="text-center text-muted small py-3">Belum ada obat di keranjang</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                    {{-- Total Keseluruhan --}}
                    <div class="p-3 rounded-3 mb-3 bg-apotek-cream border-apotek-sage">
                        <div class="d-flex justify-content-between align-items-center">
                            <span class="fw-semibold text-apotek-dark">Total Belanja:</span>
                            <span class="fs-4 fw-bold text-apotek-dark" id="tampilTotal">Rp 0</span>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-semibold text-apotek-dark">Uang Diterima (Rp)</label>
                        <input type="number" name="uang_bayar" id="uang_bayar" class="form-control form-control-lg border-apotek-sage fw-bold" min="0" placeholder="Masukkan nominal uang..." required>
                    </div>

                    <div class="p-3 rounded-3 mb-4 bg-light border">
                        <div class="d-flex justify-content-between align-items-center">
                            <span class="fw-semibold text-secondary">Kembalian:</span>
                            <span class="fs-5 fw-bold text-success" id="tampilKembalian">Rp 0</span>
                        </div>
                        <small class="text-danger d-none mt-1" id="pesanKurang">
                            <i class="fas fa-exclamation-circle me-1"></i> Uang pembayaran masih kurang!
                        </small>
                    </div>

                    <button type="submit" id="btnProses" class="btn btn-apotek-primary w-100 rounded-pill py-2 fw-bold shadow-sm" disabled>
                        <i class="fas fa-check-circle me-1"></i> Proses & Simpan Transaksi
                    </button>
                </form>
            </div>
        </div>
    </div>

    {{-- Kanan: Riwayat Transaksi Multi-Item --}}
    <div class="col-lg-7">
        <div class="card border-apotek-mint shadow-sm rounded-4">
            <div class="card-header bg-white border-bottom d-flex justify-content-between align-items-center py-3 rounded-top-4">
                <h5 class="mb-0 fw-bold text-apotek-dark"><i class="fas fa-receipt me-2"></i> Riwayat Transaksi Kasir</h5>
                <span class="badge bg-apotek-cream text-apotek-dark border-apotek-sage px-3 py-2 rounded-pill">
                    Kasir: {{ Auth::user()->name }}
                </span>
            </div>
            <div class="card-body bg-white rounded-bottom-4">
                <div class="table-responsive">
                    <table class="table table-hover align-middle">
                        <thead class="table-light">
                            <tr>
                                <th>Kode TRX</th>
                                <th>Daftar Obat Dibeli</th>
                                <th>Total</th>
                                <th>Kembali</th>
                                <th class="text-center">Nota</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($transaksis as $trx)
                                <tr>
                                    <td>
                                        <span class="badge bg-apotek-dark text-apotek-cream">{{ $trx->kode_transaksi }}</span>
                                        <small class="d-block text-muted" style="font-size: 0.72rem;">{{ $trx->tanggal_transaksi }}</small>
                                    </td>
                                    <td>
                                        <ul class="mb-0 ps-3 small">
                                            @foreach($trx->details as $det)
                                                <li>
                                                    <strong class="text-apotek-dark">{{ $det->obat->nama_obat ?? 'Obat' }}</strong>
                                                    ({{ $det->jumlah }}x)
                                                </li>
                                            @endforeach
                                        </ul>
                                    </td>
                                    <td class="fw-bold">Rp {{ number_format($trx->total_harga, 0, ',', '.') }}</td>
                                    <td class="fw-bold text-success">Rp {{ number_format($trx->kembalian, 0, ',', '.') }}</td>
                                    <td class="text-center">
                                        <a href="{{ route('transaksi.nota', $trx->id) }}" target="_blank"
                                           class="btn btn-sm btn-apotek-accent rounded-pill px-3">
                                            <i class="fas fa-print me-1"></i> Nota
                                        </a>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="text-center text-muted py-4">Belum ada transaksi penjualan hari ini.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        let keranjang = [];

        const pilihObat = document.getElementById('pilihObat');
        const pilihQty = document.getElementById('pilihQty');
        const btnTambah = document.getElementById('btnTambahKeranjang');
        const isiKeranjang = document.getElementById('isiKeranjang');
        const tampilTotal = document.getElementById('tampilTotal');
        const inputBayar = document.getElementById('uang_bayar');
        const tampilKembalian = document.getElementById('tampilKembalian');
        const pesanKurang = document.getElementById('pesanKurang');
        const btnProses = document.getElementById('btnProses');

        function formatRupiah(angka) {
            return 'Rp ' + angka.toLocaleString('id-ID');
        }

        function renderKeranjang() {
            isiKeranjang.innerHTML = '';
            let totalSemua = 0;

            if (keranjang.length === 0) {
                isiKeranjang.innerHTML = `<tr id="barisKosong"><td colspan="4" class="text-center text-muted small py-3">Belum ada obat di keranjang</td></tr>`;
            } else {
                keranjang.forEach((item, index) => {
                    const subtotal = item.harga * item.jumlah;
                    totalSemua += subtotal;

                    isiKeranjang.innerHTML += `
                        <tr>
                            <td class="small fw-semibold">
                                ${item.nama}
                                <input type="hidden" name="items[${index}][obat_id]" value="${item.id}">
                                <input type="hidden" name="items[${index}][jumlah]" value="${item.jumlah}">
                            </td>
                            <td class="text-center small">${item.jumlah}</td>
                            <td class="text-end small fw-bold">${formatRupiah(subtotal)}</td>
                            <td class="text-center">
                                <button type="button" class="btn btn-sm btn-outline-danger py-0 px-2" onclick="hapusItem(${index})">&times;</button>
                            </td>
                        </tr>
                    `;
                });
            }

            tampilTotal.textContent = formatRupiah(totalSemua);
            hitungKembalian(totalSemua);
        }

        window.hapusItem = function (index) {
            keranjang.splice(index, 1);
            renderKeranjang();
        };

        btnTambah.addEventListener('click', function () {
            const opt = pilihObat.options[pilihObat.selectedIndex];
            const id = opt.value;
            if (!id) {
                alert('Pilih obat terlebih dahulu!');
                return;
            }

            const nama = opt.getAttribute('data-nama');
            const harga = parseInt(opt.getAttribute('data-harga'));
            const stok = parseInt(opt.getAttribute('data-stok'));
            const qty = parseInt(pilihQty.value) || 1;

            const existing = keranjang.find(i => i.id === id);
            const totalQty = (existing ? existing.jumlah : 0) + qty;

            if (totalQty > stok) {
                alert(`Stok ${nama} tidak mencukupi! Maksimal stok tersedia: ${stok}`);
                return;
            }

            if (existing) {
                existing.jumlah += qty;
            } else {
                keranjang.push({ id, nama, harga, jumlah: qty });
            }

            pilihQty.value = 1;
            renderKeranjang();
        });

        function hitungKembalian(totalSemua) {
            const bayar = parseInt(inputBayar.value) || 0;
            if (totalSemua > 0 && inputBayar.value !== '') {
                if (bayar >= totalSemua) {
                    tampilKembalian.textContent = formatRupiah(bayar - totalSemua);
                    tampilKembalian.className = 'fs-5 fw-bold text-success';
                    pesanKurang.classList.add('d-none');
                    btnProses.disabled = false;
                } else {
                    tampilKembalian.textContent = 'Rp 0';
                    tampilKembalian.className = 'fs-5 fw-bold text-danger';
                    pesanKurang.classList.remove('d-none');
                    btnProses.disabled = true;
                }
            } else {
                tampilKembalian.textContent = 'Rp 0';
                pesanKurang.classList.add('d-none');
                btnProses.disabled = true;
            }
        }

        inputBayar.addEventListener('input', function () {
            const totalSemua = keranjang.reduce((sum, item) => sum + (item.harga * item.jumlah), 0);
            hitungKembalian(totalSemua);
        });
    });
</script>
@endsection