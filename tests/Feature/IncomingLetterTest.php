<?php

namespace Tests\Feature;

use App\Models\IncomingLetter;
use Illuminate\Http\UploadedFile;

class IncomingLetterTest extends SimkodesTestCase
{
    public function test_index_displays_incoming_letters(): void
    {
        $this->authGet('/incomingletters')->assertStatus(200);
    }

    public function test_create_page_renders_properly(): void
    {
        $this->authGet('/incomingletters/create')->assertStatus(200);
    }

    public function test_store_creates_incoming_letter(): void
    {
        $file = UploadedFile::fake()->create('surat_masuk.pdf', 100, 'application/pdf');
        $title = 'Surat Masuk Dinas ' . uniqid();

        $response = $this->authPost('/incomingletters', [
            'title' => $title,
            'reference_number' => 'SM-' . rand(100, 999),
            'category' => 'Undangan',
            'file' => $file,
        ]);

        $response->assertRedirect(route('incomingletters.index'));
        $this->assertDatabaseHas('incoming_letters', ['title' => $title]);
    }

    public function test_show_and_edit_incoming_letter(): void
    {
        $letter = IncomingLetter::first() ?? IncomingLetter::create([
            'title' => 'Surat Masuk Test ' . uniqid(),
            'reference_number' => 'SM-001',
            'category' => 'Umum',
        ]);

        $this->authGet("/incomingletters/{$letter->id}")->assertStatus(200);
        $this->authGet("/incomingletters/{$letter->id}/edit")->assertStatus(200);
    }

    public function test_update_modifies_incoming_letter(): void
    {
        $letter = IncomingLetter::create([
            'title' => 'Letter To Update ' . uniqid(),
            'reference_number' => 'SM-OLD',
            'category' => 'Pemberitahuan',
        ]);

        $updatedTitle = 'Letter Updated ' . uniqid();

        $response = $this->authPut("/incomingletters/{$letter->id}", [
            'title' => $updatedTitle,
            'reference_number' => 'SM-NEW',
            'category' => 'Pemberitahuan Resmi',
        ]);

        $response->assertRedirect(route('incomingletters.index'));
        $this->assertDatabaseHas('incoming_letters', ['id' => $letter->id, 'title' => $updatedTitle]);
    }

    public function test_destroy_deletes_incoming_letter(): void
    {
        $letter = IncomingLetter::create([
            'title' => 'Letter To Delete ' . uniqid(),
            'reference_number' => 'SM-DEL',
            'category' => 'Arsip',
        ]);

        $response = $this->authDelete("/incomingletters/{$letter->id}");
        $response->assertRedirect(route('incomingletters.index'));
        $this->assertDatabaseMissing('incoming_letters', ['id' => $letter->id]);
    }
}

