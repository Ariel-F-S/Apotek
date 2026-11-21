<?php

namespace Database\Seeders;

use App\Models\Kategori;
use App\Models\Obat;
use Illuminate\Database\Seeder;

class ObatSeeder extends Seeder
{
    public function run(): void
    {
        $katBebas = Kategori::firstOrCreate(
            ['nama_kategori' => 'Obat Bebas'],
            ['keterangan' => 'Obat yang dapat dibeli tanpa resep dokter']
        );

        $katSuplemen = Kategori::firstOrCreate(
            ['nama_kategori' => 'Vitamin & Suplemen'],
            ['keterangan' => 'Suplemen penunjang daya tahan tubuh']
        );

        $katSirup = Kategori::firstOrCreate(
            ['nama_kategori' => 'Obat Batuk & Flu'],
            ['keterangan' => 'Obat cair dan sirup pereda batuk flu']
        );

        $obats = [
            [
                'kategori_id' => $katBebas->id,
                'kode_obat' => 'OBT-001',
                'nama_obat' => 'Paracetamol 500mg',
                'satuan' => 'Strip',
                'stok' => 50,
                'harga' => 12000,
                'gambar' => 'https://images.unsplash.com/photo-1584308666744-24d5c474f2ae?auto=format&fit=crop&w=600&q=80',
                'deskripsi' => 'Meredakan demam, sakit kepala, dan nyeri ringan hingga sedang. Diminum 3x1 tablet sesudah makan.',
                'tanggal_kadaluarsa' => '2028-05-10',
            ],
            [
                'kategori_id' => $katSuplemen->id,
                'kode_obat' => 'OBT-002',
                'nama_obat' => 'Vitamin C 1000mg + Zinc',
                'satuan' => 'Botol',
                'stok' => 35,
                'harga' => 45000,
                'gambar' => 'https://images.unsplash.com/photo-1550572017-edd951b55104?auto=format&fit=crop&w=600&q=80',
                'deskripsi' => 'Membantu memelihara daya tahan tubuh harian dan mempercepat pemulihan stamina.',
                'tanggal_kadaluarsa' => '2027-11-20',
            ],
            [
                'kategori_id' => $katSirup->id,
                'kode_obat' => 'OBT-003',
                'nama_obat' => 'OBH Combi Batuk Berdahak',
                'satuan' => 'Botol',
                'stok' => 25,
                'harga' => 22500,
                'gambar' => 'https://images.unsplash.com/photo-1631549916768-4119b2e5f926?auto=format&fit=crop&w=600&q=80',
                'deskripsi' => 'Meredakan batuk berdahak yang disertai gejala flu seperti demam, sakit kepala, dan bersin.',
                'tanggal_kadaluarsa' => '2027-08-15',
            ],
        ];

        foreach ($obats as $obat) {
            Obat::firstOrCreate(['kode_obat' => $obat['kode_obat']], $obat);
        }
    }
}