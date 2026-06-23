<?php

namespace Database\Seeders;

use App\Models\SubsidyCheck;
use Illuminate\Database\Seeder;

class SubsidyCheckSeeder extends Seeder
{
    /**
     * Seed data penerima subsidi.
     */
    public function run(): void
    {
        $data = [
            ['nik' => '3515012345670001', 'nama' => 'Ahmad Subekti',    'keterangan' => 'Subsidi pupuk'],
            ['nik' => '3515012345670002', 'nama' => 'Siti Aminah',      'keterangan' => 'Subsidi pupuk'],
            ['nik' => '3515012345670003', 'nama' => 'Budi Santoso',     'keterangan' => 'Subsidi beras'],
            ['nik' => '3515012345670004', 'nama' => 'Dewi Lestari',     'keterangan' => 'Subsidi pupuk'],
            ['nik' => '3515012345670005', 'nama' => 'Eko Prasetyo',     'keterangan' => 'Subsidi beras'],
            ['nik' => '3515012345670006', 'nama' => 'Fatimah Zahra',    'keterangan' => 'Subsidi gas LPG'],
            ['nik' => '3515012345670007', 'nama' => 'Gunawan Wibowo',   'keterangan' => 'Subsidi pupuk'],
            ['nik' => '3515012345670008', 'nama' => 'Hana Pertiwi',     'keterangan' => 'Subsidi beras'],
            ['nik' => '3515012345670009', 'nama' => 'Irfan Hakim',      'keterangan' => 'Subsidi gas LPG'],
            ['nik' => '3515012345670010', 'nama' => 'Joko Widodo',      'keterangan' => 'Subsidi pupuk'],
        ];

        foreach ($data as $item) {
            SubsidyCheck::create($item);
        }
    }
}
