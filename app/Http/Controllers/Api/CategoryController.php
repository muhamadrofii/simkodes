<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\CategoryResource;
use App\Models\Category;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class CategoryController extends Controller
{
    /**
     * Tampilkan daftar kategori dengan kolom terproyeksi
     */
    public function index(): AnonymousResourceCollection
    {
        $categories = Category::select(['id', 'name', 'description', 'image', 'created_at', 'updated_at'])
            ->latest('id')
            ->paginate(15);

        return CategoryResource::collection($categories);
    }

    /**
     * Detail kategori
     */
    public function show(int $id): CategoryResource
    {
        $category = Category::select(['id', 'name', 'description', 'image', 'created_at', 'updated_at'])
            ->findOrFail($id);

        return new CategoryResource($category);
    }
}
