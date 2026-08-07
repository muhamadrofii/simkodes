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
                'image' => 'dummy_category.png',
            ],
            [
                'name' => 'Peternakan',
                'description' => 'Kategori untuk anggota yang bekerja di sektor peternakan.',
                'image' => 'dummy_category.png',
            ],
            [
                'name' => 'Perdagangan',
                'description' => 'Kategori untuk anggota yang bekerja di sektor perdagangan/UMKM.',
                'image' => 'dummy_category.png',
            ],
            [
                'name' => 'Jasa',
                'description' => 'Kategori untuk anggota yang bekerja di sektor penyediaan jasa.',
                'image' => 'dummy_category.png',
            ],
        ];

        foreach ($categories as $cat) {
            Category::updateOrCreate(['name' => $cat['name']], $cat);
        }
    }
}
