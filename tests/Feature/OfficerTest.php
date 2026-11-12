<?php

namespace Tests\Feature;

use App\Models\Officer;
use Illuminate\Http\UploadedFile;

class OfficerTest extends SimkodesTestCase
{
    public function test_index_displays_officers(): void
    {
        $this->authGet('/officers')->assertStatus(200);
    }

    public function test_create_page_renders_properly(): void
    {
        $this->authGet('/officers/create')->assertStatus(200);
    }

    public function test_store_creates_officer(): void
    {
        $image = UploadedFile::fake()->image('officer_profile.png', 100, 100);
        $nama = 'Pengurus ' . uniqid();

        $response = $this->authPost('/officers', [
            'nama' => $nama,
            'jabatan' => 'Sekretaris',
            'jenis_kelamin' => 'P',
            'umur' => 32,
            'tempat_tinggal' => 'Desa Sranak',
            'tanggal_diangkat' => '2026-01-01',
            'image' => $image,
        ]);

        $response->assertRedirect(route('officers.index'));
        $this->assertDatabaseHas('officers', ['nama' => $nama]);
    }

    public function test_show_and_edit_officer(): void
    {
        $officer = Officer::first();
        if ($officer) {
            $this->authGet("/officers/{$officer->id}")->assertStatus(200);
            $this->authGet("/officers/{$officer->id}/edit")->assertStatus(200);
        }
    }

    public function test_print_kta_pdf(): void
    {
        $officer = Officer::first();
        if ($officer) {
            $response = $this->authGet("/officers/{$officer->id}/kta");
            $response->assertStatus(200);
        }
    }

    public function test_update_modifies_officer(): void
    {
        $officer = Officer::latest()->first();
        if ($officer) {
            $updatedNama = 'Pengurus Updated ' . uniqid();

            $response = $this->authPut("/officers/{$officer->id}", [
                'nama' => $updatedNama,
                'jabatan' => 'Bendahara Utama',
                'jenis_kelamin' => 'P',
            ]);

            $response->assertRedirect(route('officers.show', $officer->id));
            $this->assertDatabaseHas('officers', ['id' => $officer->id, 'nama' => $updatedNama]);
        }
    }

    public function test_destroy_deletes_officer(): void
    {
        $image = UploadedFile::fake()->image('temp_officer.png', 100, 100);
        $officer = Officer::create([
            'nama' => 'To Delete ' . uniqid(),
            'jabatan' => 'Staff',
            'jenis_kelamin' => 'L',
            'image' => 'dummy_officer.png',
        ]);

        $response = $this->authDelete("/officers/{$officer->id}");
        $response->assertRedirect(route('officers.index'));
        $this->assertDatabaseMissing('officers', ['id' => $officer->id]);
    }
}

