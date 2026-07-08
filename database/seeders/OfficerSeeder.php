<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Officer;
use Illuminate\Database\Seeder;

class OfficerSeeder extends Seeder
{
    public function run(): void
    {
        $categories = Category::all();
        if ($categories->isEmpty()) {
            return;
        }

        $officers = [
            [
                'nama' => 'Haji Mansur',
                'image' => 'dummy_photo.png',
                'umur' => 55,
                'jenis_kelamin' => 'L',
                'jabatan' => 'Ketua Pengurus',
                'tempat_tinggal' => 'Desa Sranak RT 01 RW 01',
                'no_anggota_koperasi' => 'OFF-00001',
                'tanggal_diangkat' => '2023-05-10',
                'keterangan' => 'Aktif',
            ],
            [
                'nama' => 'Rina Kartika',
                'image' => 'dummy_photo.png',
                'umur' => 32,
                'jenis_kelamin' => 'P',
                'jabatan' => 'Sekretaris',
                'tempat_tinggal' => 'Desa Sranak RT 04 RW 02',
                'no_anggota_koperasi' => 'OFF-00002',
                'tanggal_diangkat' => '2023-05-10',
                'keterangan' => 'Aktif',
            ],
            [
                'nama' => 'Lilik Mulyani',
                'image' => 'dummy_photo.png',
                'umur' => 41,
                'jenis_kelamin' => 'P',
                'jabatan' => 'Bendahara',
                'tempat_tinggal' => 'Desa Sranak RT 02 RW 01',
                'no_anggota_koperasi' => 'OFF-00003',
                'tanggal_diangkat' => '2023-05-10',
                'keterangan' => 'Aktif',
            ],
        ];

        foreach ($officers as $index => $o) {
            $o['category_id'] = $categories[$index % $categories->count()]->id;
            Officer::create($o);
        }
    }
}
