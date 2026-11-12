<?php

namespace Tests\Feature;

use App\Models\OutgoingLetter;
use Illuminate\Http\UploadedFile;

class OutgoingLetterTest extends SimkodesTestCase
{
    public function test_index_displays_outgoing_letters(): void
    {
        $this->authGet('/outgoingletters')->assertStatus(200);
    }

    public function test_create_page_renders_properly(): void
    {
        $this->authGet('/outgoingletters/create')->assertStatus(200);
    }

    public function test_store_creates_outgoing_letter(): void
    {
        $file = UploadedFile::fake()->create('surat_keluar.pdf', 100, 'application/pdf');
        $title = 'Surat Keluar Pemberitahuan ' . uniqid();

        $response = $this->authPost('/outgoingletters', [
            'title' => $title,
            'reference_number' => 'SK-' . rand(100, 999),
            'category' => 'Pemberitahuan',
            'file' => $file,
        ]);

        $response->assertRedirect(route('outgoingletters.index'));
        $this->assertDatabaseHas('outgoing_letters', ['title' => $title]);
    }

    public function test_show_and_edit_outgoing_letter(): void
    {
        $letter = OutgoingLetter::first() ?? OutgoingLetter::create([
            'title' => 'Surat Keluar Test ' . uniqid(),
            'reference_number' => 'SK-001',
            'category' => 'Pemberitahuan',
        ]);

        $this->authGet("/outgoingletters/{$letter->id}")->assertStatus(200);
        $this->authGet("/outgoingletters/{$letter->id}/edit")->assertStatus(200);
    }

    public function test_update_modifies_outgoing_letter(): void
    {
        $letter = OutgoingLetter::create([
            'title' => 'Outgoing To Update ' . uniqid(),
            'reference_number' => 'SK-OLD',
            'category' => 'Instruksi',
        ]);

        $updatedTitle = 'Outgoing Updated ' . uniqid();

        $response = $this->authPut("/outgoingletters/{$letter->id}", [
            'title' => $updatedTitle,
            'reference_number' => 'SK-NEW',
            'category' => 'Instruksi Resmi',
        ]);

        $response->assertRedirect(route('outgoingletters.index'));
        $this->assertDatabaseHas('outgoing_letters', ['id' => $letter->id, 'title' => $updatedTitle]);
    }

    public function test_destroy_deletes_outgoing_letter(): void
    {
        $letter = OutgoingLetter::create([
            'title' => 'Outgoing To Delete ' . uniqid(),
            'reference_number' => 'SK-DEL',
            'category' => 'Arsip',
        ]);

        $response = $this->authDelete("/outgoingletters/{$letter->id}");
        $response->assertRedirect(route('outgoingletters.index'));
        $this->assertDatabaseMissing('outgoing_letters', ['id' => $letter->id]);
    }
}

