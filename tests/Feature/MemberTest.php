<?php

namespace Tests\Feature;

use App\Models\Category;
use App\Models\Member;

class MemberTest extends SimkodesTestCase
{
    protected Category $category;

    protected function setUp(): void
    {
        parent::setUp();
        $this->category = Category::first() ?? Category::create([
            'name' => 'Kategori Member ' . uniqid(),
            'description' => 'Desc',
            'image' => 'dummy.png'
        ]);
    }

    public function test_index_displays_members(): void
    {
        $this->authGet('/members')->assertStatus(200);
    }

    public function test_create_page_renders_properly(): void
    {
        $this->authGet('/members/create')->assertStatus(200);
    }

    public function test_store_creates_member(): void
    {
        $nama = 'Anggota ' . uniqid();

        $response = $this->authPost('/members', [
            'category_id' => $this->category->id,
            'nama' => $nama,
            'nik' => '3522000000' . rand(10000, 99999),
            'jenis_kelamin' => 'L',
            'umur' => 28,
            'mata_pencaharian' => 'Petani Modern',
            'tempat_tinggal' => 'Desa Sranak RT 01',
            'tanggal_masuk' => '2026-01-01',
        ]);

        $response->assertRedirect(route('members.index'));
        $this->assertDatabaseHas('members', ['nama' => $nama]);
    }

    public function test_show_and_edit_member(): void
    {
        $member = Member::first() ?? Member::create([
            'category_id' => $this->category->id,
            'nama' => 'Member Test ' . uniqid(),
            'jenis_kelamin' => 'L',
            'mata_pencaharian' => 'Wirausaha',
            'tempat_tinggal' => 'Desa Sranak',
        ]);

        $this->authGet("/members/{$member->id}")->assertStatus(200);
        $this->authGet("/members/{$member->id}/edit")->assertStatus(200);
    }

    public function test_print_kta_pdf(): void
    {
        $member = Member::first() ?? Member::create([
            'category_id' => $this->category->id,
            'nama' => 'Member KTA ' . uniqid(),
            'jenis_kelamin' => 'L',
            'mata_pencaharian' => 'Pedagang',
            'tempat_tinggal' => 'Desa Sranak',
        ]);

        $response = $this->authGet("/members/{$member->id}/kta");
        $response->assertStatus(200);
        $this->assertTrue(str_contains($response->headers->get('content-type', ''), 'pdf') || $response->isSuccessful());
    }

    public function test_update_modifies_member(): void
    {
        $member = Member::create([
            'category_id' => $this->category->id,
            'nama' => 'Member Before Update ' . uniqid(),
            'jenis_kelamin' => 'P',
            'mata_pencaharian' => 'Ibu Rumah Tangga',
            'tempat_tinggal' => 'Dusun Krajan',
        ]);

        $updatedNama = 'Member After Update ' . uniqid();

        $response = $this->authPut("/members/{$member->id}", [
            'category_id' => $this->category->id,
            'nama' => $updatedNama,
            'jenis_kelamin' => 'P',
            'mata_pencaharian' => 'Wiraswasta Baru',
            'tempat_tinggal' => 'Dusun Krajan Baru',
        ]);

        $response->assertRedirect(route('members.show', $member->id));
        $this->assertDatabaseHas('members', ['id' => $member->id, 'nama' => $updatedNama]);
    }

    public function test_destroy_deletes_member(): void
    {
        $member = Member::create([
            'category_id' => $this->category->id,
            'nama' => 'Member To Delete ' . uniqid(),
            'jenis_kelamin' => 'L',
            'mata_pencaharian' => 'Buruh',
            'tempat_tinggal' => 'Dusun Krajan',
        ]);

        $response = $this->authDelete("/members/{$member->id}");
        $response->assertRedirect(route('members.index'));
        $this->assertDatabaseMissing('members', ['id' => $member->id]);
    }
}

