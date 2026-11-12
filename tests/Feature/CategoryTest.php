<?php

namespace Tests\Feature;

use App\Models\Category;
use Illuminate\Http\UploadedFile;

class CategoryTest extends SimkodesTestCase
{
    public function test_index_displays_categories(): void
    {
        $this->authGet('/categories')->assertStatus(200);
    }

    public function test_create_page_renders_properly(): void
    {
        $this->authGet('/categories/create')->assertStatus(200);
    }

    public function test_store_creates_category(): void
    {
        $file = UploadedFile::fake()->image('cat_thumb.png', 100, 100);
        $name = 'Kategori ' . uniqid();

        $response = $this->authPost('/categories', [
            'name' => $name,
            'description' => 'Deskripsi Kategori Test',
            'image' => $file,
        ]);

        $response->assertRedirect(route('categories.index'));
        $this->assertDatabaseHas('categories', ['name' => $name]);
    }

    public function test_show_and_edit_category(): void
    {
        $category = Category::first() ?? Category::create([
            'name' => 'Cat ' . uniqid(),
            'description' => 'Desc',
            'image' => 'dummy.png'
        ]);

        $this->authGet("/categories/{$category->id}")->assertStatus(200);
        $this->authGet("/categories/{$category->id}/edit")->assertStatus(200);
    }

    public function test_update_modifies_category(): void
    {
        $category = Category::create([
            'name' => 'Cat To Update ' . uniqid(),
            'description' => 'Original Desc',
            'image' => 'dummy.png'
        ]);

        $updatedName = 'Cat Updated ' . uniqid();

        $response = $this->authPut("/categories/{$category->id}", [
            'name' => $updatedName,
            'description' => 'Updated Desc',
        ]);

        $response->assertRedirect(route('categories.show', $category->id));
        $this->assertDatabaseHas('categories', ['id' => $category->id, 'name' => $updatedName]);
    }

    public function test_destroy_deletes_category(): void
    {
        $category = Category::create([
            'name' => 'Cat To Delete ' . uniqid(),
            'description' => 'Delete Me',
            'image' => 'dummy.png'
        ]);

        $response = $this->authDelete("/categories/{$category->id}");
        $response->assertRedirect(route('categories.index'));
        $this->assertDatabaseMissing('categories', ['id' => $category->id]);
    }
}

