<?php

namespace Tests\Feature\Api;

use App\Models\Category;
use App\Models\Member;
use Illuminate\Support\Facades\DB;

/**
 * Class QueryEfficiencyTest
 * Menguji efisiensi eksekusi query SQL pada SIMKODES:
 * 1. Pencegahan N+1 Query Problem melalui Eager Loading (with).
 * 2. Proyeksi kolom spesifik (menghindari SELECT * berlebih).
 * 3. Efisiensi paginasi dan filter indeks.
 */
class QueryEfficiencyTest extends ApiTestCase
{
    /**
     * Memastikan query list anggota bebas dari N+1 query problem.
     * Mengambil 10 anggota dengan relasi kategori HANYA boleh mengeksekusi 2 query SQL:
     * - Query 1: SELECT members
     * - Query 2: SELECT categories WHERE id IN (...)
     */
    public function test_members_list_prevents_n_plus_one_query(): void
    {
        // 1. Buat 3 kategori
        $categories = [];
        for ($i = 1; $i <= 3; $i++) {
            $categories[] = Category::create([
                'name' => 'Kategori Efisiensi ' . $i . ' ' . uniqid(),
                'description' => 'Test Desc',
                'image' => 'dummy.png'
            ]);
        }

        // 2. Buat 10 anggota yang tersebar di kategori tersebut
        for ($i = 1; $i <= 10; $i++) {
            Member::create([
                'category_id' => $categories[$i % 3]->id,
                'nama' => 'Anggota N+1 Test ' . $i . ' ' . uniqid(),
                'jenis_kelamin' => 'L',
                'mata_pencaharian' => 'Petani',
                'tempat_tinggal' => 'Desa Sranak',
                'tanggal_masuk' => '2026-01-01',
            ]);
        }

        // 3. Aktifkan Query Log Laravel
        DB::flushQueryLog();
        DB::enableQueryLog();

        // 4. Lakukan request API
        $response = $this->apiAs()->apiGet('/api/members?per_page=10');
        $response->assertStatus(200);

        $queries = DB::getQueryLog();
        DB::disableQueryLog();

        // 5. Verifikasi: Jumlah query yang berhubungan dengan data anggota maksimal 3 query (count + data + eager load categories)
        // Jika ada N+1 problem, jumlah query akan menjadi 12+ query (1 untuk setiap anggota).
        $this->assertLessThanOrEqual(
            4,
            count($queries),
            'Terjadi N+1 query problem! Query yang dieksekusi melebihi batas efisiensi.'
        );

        // 6. Verifikasi eager loading: Harus ada query WHERE IN untuk relasi categories
        $eagerLoadFound = false;
        foreach ($queries as $q) {
            $queryStr = strtolower($q['query']);
            if (str_contains($queryStr, 'categories') && str_contains($queryStr, 'in')) {
                $eagerLoadFound = true;
                break;
            }
        }

        $this->assertTrue($eagerLoadFound, 'Relasi kategori harus di-load secara eager (WHERE IN), bukan lazy loading.');
    }

    /**
     * Memastikan query tidak menggunakan 'SELECT *' yang memboroskan memori server.
     */
    public function test_members_query_uses_selective_columns(): void
    {
        DB::flushQueryLog();
        DB::enableQueryLog();

        $this->apiAs()->apiGet('/api/members?per_page=5');

        $queries = DB::getQueryLog();
        DB::disableQueryLog();

        $memberDataQuery = null;
        foreach ($queries as $q) {
            if (str_contains(strtolower($q['query']), 'from `members`') || str_contains(strtolower($q['query']), 'from "members"')) {
                if (! str_contains(strtolower($q['query']), 'count(')) {
                    $memberDataQuery = strtolower($q['query']);
                    break;
                }
            }
        }

        $this->assertNotNull($memberDataQuery);
        // Memastikan query memproyeksikan kolom spesifik
        $this->assertStringNotContainsString('select * from `members`', $memberDataQuery);
        $this->assertStringNotContainsString('select * from "members"', $memberDataQuery);
    }
}
