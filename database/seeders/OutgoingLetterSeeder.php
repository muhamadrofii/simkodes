<?php

namespace Database\Seeders;

use App\Models\OutgoingLetter;
use Illuminate\Database\Seeder;

class OutgoingLetterSeeder extends Seeder
{
    public function run(): void
    {
        $letters = [
            [
                'title' => 'Surat Permohonan Rekomendasi Penyaluran Pupuk',
                'reference_number' => '015/KMP-SRN/V/2026',
                'category' => 'Permohonan',
                'file' => 'dummy_surat.png',
            ],
            [
                'title' => 'Surat Pemberitahuan Rapat Anggota Tahunan (RAT)',
                'reference_number' => '018/KMP-SRN/VI/2026',
                'category' => 'Pemberitahuan',
                'file' => 'dummy_surat.png',
            ],
        ];

        foreach ($letters as $let) {
            OutgoingLetter::create($let);
        }
    }
}
