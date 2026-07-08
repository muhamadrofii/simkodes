<?php

namespace Database\Seeders;

use App\Models\IncomingLetter;
use Illuminate\Database\Seeder;

class IncomingLetterSeeder extends Seeder
{
    public function run(): void
    {
        $letters = [
            [
                'title' => 'Surat Permohonan Kerjasama Distribusi Pupuk',
                'reference_number' => '024/DIST-PUPUK/V/2026',
                'category' => 'Kerjasama',
                'file' => 'dummy_surat.png',
            ],
            [
                'title' => 'Undangan Sosialisasi Program UMKM Kabupaten',
                'reference_number' => '400/125/DINKOP/VI/2026',
                'category' => 'Undangan',
                'file' => 'dummy_surat.png',
            ],
        ];

        foreach ($letters as $let) {
            IncomingLetter::create($let);
        }
    }
}
