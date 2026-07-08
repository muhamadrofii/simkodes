<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Supervisor;
use Illuminate\Database\Seeder;

class SupervisorSeeder extends Seeder
{
    public function run(): void
    {
        $categories = Category::all();
        if ($categories->isEmpty()) {
            return;
        }

        $supervisors = [
            [
                'nama' => 'Muri',
                'image' => 'dummy_photo.png',
                'umur' => 52,
                'jenis_kelamin' => 'L',
                'mata_pencaharian' => 'Pansiunan PNS',
                'tempat_tinggal' => 'Desa Sranak RT 03 RW 01',
                'no_anggota_koperasi' => 'SUP-00001',
                'jabatan' => 'Ketua Pengawas',
                'tanggal_dipilih' => '2024-01-02',
                'keterangan' => 'Aktif',
            ],
            [
                'nama' => 'Budiono',
                'image' => 'dummy_photo.png',
                'umur' => 48,
                'jenis_kelamin' => 'L',
                'mata_pencaharian' => 'Wiraswasta',
                'tempat_tinggal' => 'Desa Sranak RT 02 RW 01',
                'no_anggota_koperasi' => 'SUP-00002',
                'jabatan' => 'Anggota Pengawas',
                'tanggal_dipilih' => '2024-01-02',
                'keterangan' => 'Aktif',
            ],
        ];

        foreach ($supervisors as $index => $s) {
            $s['category_id'] = $categories[$index % $categories->count()]->id;
            Supervisor::create($s);
        }
    }
}
