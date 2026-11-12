<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\CategoryResource;
use App\Models\Category;
use App\Traits\ApiResponseTrait;
use Illuminate\Http\JsonResponse;

class CategoryController extends Controller
{
    use ApiResponseTrait;

    /**
     * Tampilkan daftar kategori dengan kolom terproyeksi
     */
    public function index(): JsonResponse
    {
        $categories = Category::select(['id', 'name', 'description', 'image', 'created_at', 'updated_at'])
            ->latest('id')
            ->paginate(15);

        return $this->sendPaginated(CategoryResource::collection($categories), 'Daftar kategori berhasil dimuat.');
    }

    /**
     * Detail kategori
     */
    public function show(int $id): JsonResponse
    {
        $category = Category::select(['id', 'name', 'description', 'image', 'created_at', 'updated_at'])
            ->find($id);

        if (! $category) {
            return $this->sendError('Data kategori tidak ditemukan.', null, 404);
        }

        return $this->sendResponse(new CategoryResource($category), 'Detail kategori berhasil dimuat.');
    }
}
