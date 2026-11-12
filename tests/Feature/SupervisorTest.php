<?php

namespace Tests\Feature;

use App\Models\Supervisor;
use Illuminate\Http\UploadedFile;

class SupervisorTest extends SimkodesTestCase
{
    public function test_index_displays_supervisors(): void
    {
        $this->authGet('/supervisors')->assertStatus(200);
    }

    public function test_create_page_renders_properly(): void
    {
        $this->authGet('/supervisors/create')->assertStatus(200);
    }

    public function test_store_creates_supervisor(): void
    {
        $image = UploadedFile::fake()->image('supervisor_profile.png', 100, 100);
        $nama = 'Pengawas ' . uniqid();

        $response = $this->authPost('/supervisors', [
            'nama' => $nama,
            'jabatan' => 'Ketua Pengawas',
            'jenis_kelamin' => 'L',
            'mata_pencaharian' => 'PNS',
            'tempat_tinggal' => 'Desa Sranak',
            'tanggal_dipilih' => '2026-01-01',
            'image' => $image,
        ]);

        $response->assertRedirect(route('supervisors.index'));
        $this->assertDatabaseHas('supervisors', ['nama' => $nama]);
    }

    public function test_show_and_edit_supervisor(): void
    {
        $supervisor = Supervisor::first();
        if ($supervisor) {
            $this->authGet("/supervisors/{$supervisor->id}")->assertStatus(200);
            $this->authGet("/supervisors/{$supervisor->id}/edit")->assertStatus(200);
        }
    }

    public function test_print_kta_pdf(): void
    {
        $supervisor = Supervisor::first();
        if ($supervisor) {
            $response = $this->authGet("/supervisors/{$supervisor->id}/kta");
            $response->assertStatus(200);
        }
    }

    public function test_update_modifies_supervisor(): void
    {
        $supervisor = Supervisor::latest()->first();
        if ($supervisor) {
            $updatedNama = 'Pengawas Updated ' . uniqid();

            $response = $this->authPut("/supervisors/{$supervisor->id}", [
                'nama' => $updatedNama,
                'jabatan' => 'Wakil Pengawas',
                'jenis_kelamin' => 'L',
            ]);

            $response->assertRedirect(route('supervisors.show', $supervisor->id));
            $this->assertDatabaseHas('supervisors', ['id' => $supervisor->id, 'nama' => $updatedNama]);
        }
    }

    public function test_destroy_deletes_supervisor(): void
    {
        $supervisor = Supervisor::create([
            'nama' => 'To Delete ' . uniqid(),
            'jabatan' => 'Anggota Pengawas',
            'jenis_kelamin' => 'L',
            'image' => 'dummy_supervisor.png',
        ]);

        $response = $this->authDelete("/supervisors/{$supervisor->id}");
        $response->assertRedirect(route('supervisors.index'));
        $this->assertDatabaseMissing('supervisors', ['id' => $supervisor->id]);
    }
}

