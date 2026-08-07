<?php

namespace Database\Seeders;

use App\Models\SubsidyCheck;
use App\Models\Member;
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

        // 1. Seed 5 program utama
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
            ],
            [
                'nama' => 'Bantuan Bibit Tanaman & Benih',
                'tahun' => '2026',
                'periode' => 'Tahap 1',
                'keterangan' => 'Penyaluran bibit padi unggul dan jagung hibrida untuk kelompok tani.',
            ],
            [
                'nama' => 'Subsidi Listrik & Energi Desa',
                'tahun' => '2026',
                'periode' => 'Tahun Anggaran 2026',
                'keterangan' => 'Program subsidi tagihan listrik untuk fasilitas sosial, tempat ibadah, dan warga kurang mampu.',
            ]
        ];

        $createdPrograms = [];
        foreach ($programs as $prog) {
            $createdPrograms[] = SubsidyCheck::create($prog);
        }

        // Get members to link as recipients
        $members = Member::all();

        // Fallback dummy members if database has no members
        if ($members->isEmpty()) {
            $dummyNames = ['Ahmad Subekti', 'Siti Aminah', 'Budi Santoso', 'Dewi Lestari', 'Eko Prasetyo', 'Fatimah Zahra', 'Joko Susilo', 'Lilik Mulyani', 'Rina Kartika', 'Haji Mansur'];
        } else {
            $dummyNames = $members->pluck('nama')->toArray();
        }

        // 2. Seed penerima / klaim di bawah program
        $nikBase = 3515012345670001;
        $kkBase  = 3515019876540001;

        foreach ($createdPrograms as $index => $program) {
            // Each program gets 4-6 recipients
            $numRecipients = rand(4, 6);
            
            // Shuffle names to distribute randomly
            $programNames = $dummyNames;
            shuffle($programNames);
            
            // Limit to list size
            $selectedNames = array_slice($programNames, 0, min($numRecipients, count($programNames)));

            foreach ($selectedNames as $k => $name) {
                $nik = (string)($nikBase + ($index * 10) + $k);
                $kk = (string)($kkBase + ($index * 10) + $k);
                
                $keteranganDetail = "";
                switch ($index) {
                    case 0:
                        $keteranganDetail = "Lolos verifikasi kelompok tani - Penyaluran pupuk Urea/NPK disetujui.";
                        break;
                    case 1:
                        $keteranganDetail = "Penerima manfaat beras 10kg - Tersalurkan.";
                        break;
                    case 2:
                        $keteranganDetail = "Pemberian kuota 3 tabung gas melon bersubsidi per bulan.";
                        break;
                    case 3:
                        $keteranganDetail = "Bantuan bibit padi unggul sebanyak 10 kg untuk musim tanam.";
                        break;
                    case 4:
                        $keteranganDetail = "Penerima subsidi pemotongan biaya tagihan listrik bulanan.";
                        break;
                }

                SubsidyCheck::create([
                    'parent_id' => $program->id,
                    'nik' => $nik,
                    'no_kk' => $kk,
                    'nama' => $name,
                    'tahun' => $program->tahun,
                    'periode' => now()->toDateTimeString(),
                    'keterangan' => $keteranganDetail,
                ]);
            }
        }
    }
}
