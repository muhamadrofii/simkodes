<?php

namespace Tests\Feature\Api;

use App\Models\Category;

class CategoryApiTest extends ApiTestCase
{
    public function test_get_categories_list(): void
    {
        Category::firstOrCreate(
            ['name' => 'Kategori API Test'],
            ['description' => 'Desc', 'image' => 'dummy.png']
        );

        $response = $this->apiAs()->apiGet('/api/categories');

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
                         '*' => ['id', 'name', 'description', 'created_at'],
                     ],
                     'meta',
                     'links',
                 ]);
    }

    public function test_get_category_detail(): void
    {
        $cat = Category::firstOrCreate(
            ['name' => 'Kategori Detail ' . uniqid()],
            ['description' => 'Desc', 'image' => 'dummy.png']
        );

        $response = $this->apiAs()->apiGet("/api/categories/{$cat->id}");

        $response->assertStatus(200)
                 ->assertJson([
                     'success' => true,
                     'code' => 200,
                 ])
                 ->assertJsonPath('data.id', $cat->id)
                 ->assertJsonPath('data.name', $cat->name);
    }
}
