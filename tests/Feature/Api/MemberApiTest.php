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
     * Memastikan GET /api/members menghasilkan response JSON standar dengan pagination
     */
    public function test_get_members_list_returns_paginated_json(): void
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
                 ->assertJsonStructure([
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
                     'links',
                     'meta' => [
                         'current_page',
                         'per_page',
                         'total',
                     ],
                 ]);
    }

    /**
     * Memastikan validasi input gagal mengembalikan status HTTP 422 Unprocessable Content
     */
    public function test_store_member_fails_validation_returns_422(): void
    {
        $response = $this->apiAs()->apiPost('/api/members', [
            // Kosong tanpa nama & jenis_kelamin
        ]);

        $response->assertStatus(422)
                 ->assertJsonValidationErrors(['nama', 'jenis_kelamin']);
    }

    /**
     * Memastikan POST /api/members sukses mengembalikan status HTTP 201 Created
     */
    public function test_store_member_success_returns_201(): void
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
                 ->assertJsonPath('data.id', $member->id)
                 ->assertJsonPath('data.nama', $member->nama);
    }

    /**
     * Memastikan PUT /api/members/{id} memperbarui data dan mengembalikan status 200
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
                     'status' => 'success',
                     'message' => 'Data anggota berhasil dihapus.',
                 ]);

        $this->assertDatabaseMissing('members', ['id' => $member->id]);
    }
}
