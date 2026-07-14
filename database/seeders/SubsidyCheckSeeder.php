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
        // Remove existing to start fresh
        SubsidyCheck::truncate();

        // 1. Seed program utama
        $programs = [
            [
                'nama' => 'Subsidi Pupuk Pertanian',
                'tahun' => '2026',
                'periode' => 'Tahap 1',
                'keterangan' => 'Program bantuan subsidi pupuk urea dan NPK untuk petani Desa Sranak.',
            ],
            [
                'nama' => 'Bantuan Pangan Beras Desa',
                'tahun' => '2026',
                'periode' => 'Januari - Maret',
                'keterangan' => 'Program bantuan pangan beras bulanan untuk warga pra-sejahtera.',
            ],
            [
                'nama' => 'Subsidi Tabung Gas LPG 3 KG',
                'tahun' => '2026',
                'periode' => 'Kuartal 1',
                'keterangan' => 'Program subsidi dan pemantauan distribusi gas melon tepat sasaran.',
            ]
        ];

        $prog1 = SubsidyCheck::create($programs[0]);
        $prog2 = SubsidyCheck::create($programs[1]);
        $prog3 = SubsidyCheck::create($programs[2]);

        // 2. Seed penerima / klaim di bawah program
        $claims = [
            // Penerima Pupuk
            [
                'parent_id' => $prog1->id,
                'nik' => '3515012345670001',
                'no_kk' => '3515019876540001',
                'nama' => 'Ahmad Subekti',
                'tahun' => '2026',
                'periode' => 'Tahap 1',
                'keterangan' => 'Lolos verifikasi kelompok tani - Telah disalurkan pupuk NPK 50kg.',
            ],
            [
                'parent_id' => $prog1->id,
                'nik' => '3515012345670002',
                'no_kk' => '3515019876540002',
                'nama' => 'Siti Aminah',
                'tahun' => '2026',
                'periode' => 'Tahap 1',
                'keterangan' => 'Lolos verifikasi kelompok tani - Telah disalurkan urea 50kg.',
            ],
            [
                'parent_id' => $prog1->id,
                'nik' => '3515012345670003',
                'no_kk' => '3515019876540003',
                'nama' => 'Budi Santoso',
                'tahun' => '2026',
                'periode' => 'Tahap 1',
                'keterangan' => 'Lolos verifikasi - Pupuk Urea 100kg.',
            ],

            // Penerima Beras
            [
                'parent_id' => $prog2->id,
                'nik' => '3515012345670004',
                'no_kk' => '3515019876540004',
                'nama' => 'Dewi Lestari',
                'tahun' => '2026',
                'periode' => 'Januari - Maret',
                'keterangan' => 'Penerima manfaat beras 10kg.',
            ],
            [
                'parent_id' => $prog2->id,
                'nik' => '3515012345670005',
                'no_kk' => '3515019876540005',
                'nama' => 'Eko Prasetyo',
                'tahun' => '2026',
                'periode' => 'Januari - Maret',
                'keterangan' => 'Penerima manfaat beras 10kg.',
            ],

            // Penerima LPG
            [
                'parent_id' => $prog3->id,
                'nik' => '3515012345670006',
                'no_kk' => '3515019876540006',
                'nama' => 'Fatimah Zahra',
                'tahun' => '2026',
                'periode' => 'Kuartal 1',
                'keterangan' => 'Kuota 3 tabung per bulan.',
            ],
        ];

        foreach ($claims as $claim) {
            $claim['periode'] = now()->toDateTimeString();
            SubsidyCheck::create($claim);
        }
    }
}
