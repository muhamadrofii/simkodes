<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            [
                'name' => 'Pertanian',
                'description' => 'Kategori untuk anggota yang bekerja di sektor pertanian.',
                'image' => '1krhsqRs6PMxCZLHson6KCBE64PaHDqLVFsVxfYe.png',
            ],
            [
                'name' => 'Peternakan',
                'description' => 'Kategori untuk anggota yang bekerja di sektor peternakan.',
                'image' => '3zGjuPlu4reYYob2r8BmAY3qcB6CqStRxItueY7d.png',
            ],
            [
                'name' => 'Perdagangan',
                'description' => 'Kategori untuk anggota yang bekerja di sektor perdagangan/UMKM.',
                'image' => 'L0eleZQ20S6Eg84LgMCR8Vb6LqGsh2gEdLL0lTGG.png',
            ],
            [
                'name' => 'Jasa',
                'description' => 'Kategori untuk anggota yang bekerja di sektor penyediaan jasa.',
                'image' => 'MrrHGAQ37FPtfqwxth4A8py0qJupWFllz5ZnhnwY.png',
            ],
        ];

        foreach ($categories as $cat) {
            Category::updateOrCreate(['name' => $cat['name']], $cat);
        }
    }
}
