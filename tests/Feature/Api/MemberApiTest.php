<?php

namespace Tests\Feature\Api;

use App\Models\Category;
use App\Models\Member;

class MemberApiTest extends ApiTestCase
{
    protected Category $category;

    protected function setUp(): void
    {
        parent::setUp();
        $this->category = Category::first() ?? Category::create([
            'name' => 'Kategori API ' . uniqid(),
            'description' => 'Desc API',
            'image' => 'dummy.png'
        ]);
    }

    /**
     * Memastikan GET /api/members menghasilkan response JSON standar envelope dengan pagination
     */
    public function test_get_members_list_returns_standard_envelope(): void
    {
        Member::create([
            'category_id' => $this->category->id,
            'nama' => 'Anggota API Test',
            'jenis_kelamin' => 'L',
            'mata_pencaharian' => 'Pedagang',
            'tempat_tinggal' => 'Desa Sranak',
        ]);

        $response = $this->apiAs()->apiGet('/api/members');

        $response->assertStatus(200)
                 ->assertJson([
                     'success' => true,
                     'code' => 200,
                 ])
                 ->assertJsonStructure([
                     'success',
                     'code',
                     'message',
                     'data' => [
                         '*' => [
                             'id',
                             'nama',
                             'jenis_kelamin',
                             'mata_pencaharian',
                             'tempat_tinggal',
                             'category',
                             'created_at',
                         ],
                     ],
                     'meta' => [
                         'current_page',
                         'per_page',
                         'total',
                         'last_page',
                     ],
                     'links' => [
                         'first',
                         'last',
                     ],
                 ]);
    }

    /**
     * Memastikan FormRequest validasi gagal mengembalikan envelope standar 422
     */
    public function test_store_member_fails_validation_returns_standard_422(): void
    {
        $response = $this->apiAs()->apiPost('/api/members', [
            // Kosong tanpa nama & jenis_kelamin
        ]);

        $response->assertStatus(422)
                 ->assertJson([
                     'success' => false,
                     'code' => 422,
                     'message' => 'Validasi parameter request gagal.',
                 ])
                 ->assertJsonStructure([
                     'errors' => ['nama', 'jenis_kelamin'],
                 ]);
    }

    /**
     * Memastikan POST /api/members sukses mengembalikan envelope standar 201 Created
     */
    public function test_store_member_success_returns_standard_201(): void
    {
        $nama = 'Anggota Baru ' . uniqid();

        $response = $this->apiAs()->apiPost('/api/members', [
            'category_id' => $this->category->id,
            'nama' => $nama,
            'jenis_kelamin' => 'P',
            'umur' => 26,
            'mata_pencaharian' => 'Guru',
            'tempat_tinggal' => 'Desa Sranak RT 03',
            'tanggal_masuk' => '2026-01-01',
        ]);

        $response->assertStatus(201)
                 ->assertJson([
                     'success' => true,
                     'code' => 201,
                     'message' => 'Data anggota berhasil ditambahkan.',
                 ])
                 ->assertJsonPath('data.nama', $nama)
                 ->assertJsonPath('data.jenis_kelamin', 'P');

        $this->assertDatabaseHas('members', ['nama' => $nama]);
    }

    /**
     * Memastikan GET /api/members/{id} mengembalikan detail record
     */
    public function test_show_member_returns_correct_resource(): void
    {
        $member = Member::create([
            'category_id' => $this->category->id,
            'nama' => 'Detail Member ' . uniqid(),
            'jenis_kelamin' => 'L',
            'mata_pencaharian' => 'Dokter',
            'tempat_tinggal' => 'Desa Sranak',
        ]);

        $response = $this->apiAs()->apiGet("/api/members/{$member->id}");

        $response->assertStatus(200)
                 ->assertJson([
                     'success' => true,
                     'code' => 200,
                 ])
                 ->assertJsonPath('data.id', $member->id)
                 ->assertJsonPath('data.nama', $member->nama);
    }

    /**
     * Memastikan GET /api/members/{id} jika tidak ditemukan mengembalikan 404 envelope standar
     */
    public function test_show_member_not_found_returns_404(): void
    {
        $response = $this->apiAs()->apiGet('/api/members/999999');

        $response->assertStatus(404)
                 ->assertJson([
                     'success' => false,
                     'code' => 404,
                     'message' => 'Data anggota tidak ditemukan.',
                 ]);
    }

    /**
     * Memastikan PUT /api/members/{id} memperbarui data dan mengembalikan envelope 200
     */
    public function test_update_member_success(): void
    {
        $member = Member::create([
            'category_id' => $this->category->id,
            'nama' => 'Member Before ' . uniqid(),
            'jenis_kelamin' => 'L',
            'mata_pencaharian' => 'Buruh',
            'tempat_tinggal' => 'Desa Sranak',
        ]);

        $updatedNama = 'Member After ' . uniqid();

        $response = $this->apiAs()->apiPut("/api/members/{$member->id}", [
            'category_id' => $this->category->id,
            'nama' => $updatedNama,
            'jenis_kelamin' => 'L',
            'mata_pencaharian' => 'Wirausaha Mandiri',
            'tempat_tinggal' => 'Desa Sranak Baru',
        ]);

        $response->assertStatus(200)
                 ->assertJson([
                     'success' => true,
                     'code' => 200,
                 ])
                 ->assertJsonPath('data.nama', $updatedNama);

        $this->assertDatabaseHas('members', ['id' => $member->id, 'nama' => $updatedNama]);
    }

    /**
     * Memastikan DELETE /api/members/{id} menghapus record dari database
     */
    public function test_delete_member_success(): void
    {
        $member = Member::create([
            'category_id' => $this->category->id,
            'nama' => 'Member To Delete ' . uniqid(),
            'jenis_kelamin' => 'L',
        ]);

        $response = $this->apiAs()->apiDelete("/api/members/{$member->id}");

        $response->assertStatus(200)
                 ->assertJson([
                     'success' => true,
                     'code' => 200,
                     'message' => 'Data anggota berhasil dihapus.',
                 ]);

        $this->assertDatabaseMissing('members', ['id' => $member->id]);
    }
}
