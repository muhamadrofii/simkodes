<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Member;
use Illuminate\Database\Seeder;

class MemberSeeder extends Seeder
{
    public function run(): void
    {
        $categories = Category::all();
        if ($categories->isEmpty()) {
            return;
        }

        $members = [
            [
                'nama' => 'Supriyadi',
                'image' => 'dummy_photo.png',
                'umur' => 45,
                'jenis_kelamin' => 'L',
                'mata_pencaharian' => 'Petani Padi',
                'tempat_tinggal' => 'Desa Sranak RT 02 RW 01',
                'tanggal_masuk' => '2020-01-15',
                'keterangan' => 'Aktif',
            ],
            [
                'nama' => 'Sri Wahyuni',
                'image' => 'dummy_photo.png',
                'umur' => 38,
                'jenis_kelamin' => 'P',
                'mata_pencaharian' => 'Ibu Rumah Tangga / Petani',
                'tempat_tinggal' => 'Desa Sranak RT 03 RW 01',
                'tanggal_masuk' => '2020-02-10',
                'keterangan' => 'Aktif',
            ],
            [
                'nama' => 'Bambang Utomo',
                'image' => 'dummy_photo.png',
                'umur' => 50,
                'jenis_kelamin' => 'L',
                'mata_pencaharian' => 'Peternak Sapi',
                'tempat_tinggal' => 'Desa Sranak RT 05 RW 02',
                'tanggal_masuk' => '2021-03-22',
                'keterangan' => 'Aktif',
            ],
            [
                'nama' => 'Siti Aminah',
                'image' => 'dummy_photo.png',
                'umur' => 42,
                'jenis_kelamin' => 'P',
                'mata_pencaharian' => 'Pedagang Sembako',
                'tempat_tinggal' => 'Desa Sranak RT 01 RW 01',
                'tanggal_masuk' => '2022-05-18',
                'keterangan' => 'Aktif',
            ],
            [
                'nama' => 'Joko Susilo',
                'image' => 'dummy_photo.png',
                'umur' => 35,
                'jenis_kelamin' => 'L',
                'mata_pencaharian' => 'Wiraswasta Bengkel',
                'tempat_tinggal' => 'Desa Sranak RT 04 RW 02',
                'tanggal_masuk' => '2023-08-12',
                'keterangan' => 'Aktif',
            ],
            [
                'nama' => 'Fatimah Zahra',
                'image' => 'dummy_photo.png',
                'umur' => 29,
                'jenis_kelamin' => 'P',
                'mata_pencaharian' => 'Guru Madrasah',
                'tempat_tinggal' => 'Desa Sranak RT 02 RW 02',
                'tanggal_masuk' => '2023-11-01',
                'keterangan' => 'Aktif',
            ],
        ];

        foreach ($members as $index => $m) {
            $m['category_id'] = $categories[$index % $categories->count()]->id;
            Member::create($m);
        }
    }
}
