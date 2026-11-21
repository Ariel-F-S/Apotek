<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nota Pembayaran - {{ $transaksi->kode_transaksi }}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f4f6f4;
            font-family: 'Courier New', Courier, monospace;
        }
        .struk-box {
            max-width: 380px;
            margin: 30px auto;
            background: #ffffff;
            padding: 25px 20px;
            border: 1px dashed #5A827E;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.08);
        }
        .garis-putus {
            border-top: 1px dashed #333;
            margin: 12px 0;
        }
        @media print {
            body {
                background: #ffffff;
            }
            .struk-box {
                box-shadow: none;
                border: none;
                margin: 0;
                max-width: 100%;
            }
            .no-print {
                display: none !important;
            }
        }
    </style>
</head>
<body>

    <div class="struk-box">
        {{-- Header Apotek --}}
        <div class="text-center">
            <h5 class="fw-bold mb-0">PHARMACARE EXPRESS</h5>
            <small class="d-block">Apotek & Pelayanan Kesehatan</small>
            <small class="text-muted">Jl. Kesehatan No. 24, Kota Kediri</small>
        </div>

        <div class="garis-putus"></div>

        {{-- Info Transaksi --}}
        <div class="small">
            <div class="d-flex justify-content-between">
                <span>No. Nota</span>
                <span class="fw-bold">{{ $transaksi->kode_transaksi }}</span>
            </div>
            <div class="d-flex justify-content-between">
                <span>Tanggal</span>
                <span>{{ $transaksi->created_at->format('d/m/Y H:i') }}</span>
            </div>
            <div class="d-flex justify-content-between">
                <span>Kasir</span>
                <span>{{ $transaksi->user->name ?? 'Kasir' }}</span>
            </div>
        </div>

        <div class="garis-putus"></div>

        {{-- Rincian Daftar Obat (Multi-Item) --}}
        <div class="small">
            @foreach($transaksi->details as $det)
                <div class="mb-2">
                    <div class="fw-bold">{{ $det->obat->nama_obat ?? 'Obat' }}</div>
                    <div class="d-flex justify-content-between">
                        <span>{{ $det->jumlah }} x Rp {{ number_format($det->harga_satuan, 0, ',', '.') }}</span>
                        <span class="fw-bold">Rp {{ number_format($det->subtotal, 0, ',', '.') }}</span>
                    </div>
                </div>
            @endforeach
        </div>

        <div class="garis-putus"></div>

        {{-- Ringkasan Pembayaran --}}
        <div class="small">
            <div class="d-flex justify-content-between fw-bold fs-6">
                <span>TOTAL</span>
                <span>Rp {{ number_format($transaksi->total_harga, 0, ',', '.') }}</span>
            </div>
            <div class="d-flex justify-content-between mt-1">
                <span>TUNAI</span>
                <span>Rp {{ number_format($transaksi->uang_bayar, 0, ',', '.') }}</span>
            </div>
            <div class="d-flex justify-content-between fw-bold mt-1">
                <span>KEMBALI</span>
                <span>Rp {{ number_format($transaksi->kembalian, 0, ',', '.') }}</span>
            </div>
        </div>

        <div class="garis-putus"></div>

        {{-- Footer Struk --}}
        <div class="text-center small mt-3">
            <p class="mb-1">Terima kasih atas kunjungan Anda.</p>
            <p class="mb-0 fw-bold">Semoga Lekas Sembuh!</p>
        </div>

        {{-- Tombol Cetak & Kembali (Hilang saat diprint) --}}
        <div class="text-center mt-4 no-print d-flex gap-2 justify-content-center">
            <button onclick="window.print()" class="btn btn-dark btn-sm px-3">
                Cetak Struk
            </button>
            <a href="{{ route('transaksi.index') }}" class="btn btn-outline-secondary btn-sm px-3">
                Kembali
            </a>
        </div>
    </div>

</body>
</html>