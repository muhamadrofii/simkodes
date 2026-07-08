<?php

namespace Database\Seeders;

use App\Models\Inventory;
use Illuminate\Database\Seeder;

class InventorySeeder extends Seeder
{
    public function run(): void
    {
        $inventories = [
            [
                'nama_barang' => 'Kursi Plastik Lion Star',
                'tanggal' => '2023-02-15',
                'jumlah' => 100,
                'harga_satuan' => 75000,
                'jumlah_rupiah' => 7500000,
                'umur_teknis' => '5 Tahun',
                'umur_ekonomis' => '5 Tahun',
                'keterangan' => 'Kondisi baik, digunakan untuk rapat anggota',
            ],
            [
                'nama_barang' => 'Meja Rapat Kayu Jati',
                'tanggal' => '2023-02-15',
                'jumlah' => 4,
                'harga_satuan' => 1250000,
                'jumlah_rupiah' => 5000000,
                'umur_teknis' => '10 Tahun',
                'umur_ekonomis' => '10 Tahun',
                'keterangan' => 'Kondisi baik, ruang rapat',
            ],
            [
                'nama_barang' => 'Laptop ASUS Core i5',
                'tanggal' => '2023-06-20',
                'jumlah' => 2,
                'harga_satuan' => 8500000,
                'jumlah_rupiah' => 17000000,
                'umur_teknis' => '4 Tahun',
                'umur_ekonomis' => '4 Tahun',
                'keterangan' => 'Operasional admin dan keuangan',
            ],
            [
                'nama_barang' => 'Printer Epson L3210',
                'tanggal' => '2023-06-22',
                'jumlah' => 2,
                'harga_satuan' => 2500000,
                'jumlah_rupiah' => 5000000,
                'umur_teknis' => '3 Tahun',
                'umur_ekonomis' => '3 Tahun',
                'keterangan' => 'Untuk cetak surat dan KTA',
            ],
        ];

        foreach ($inventories as $inv) {
            Inventory::create($inv);
        }
    }
}
