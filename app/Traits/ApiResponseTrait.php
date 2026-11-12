<?php

namespace App\Traits;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\ResourceCollection;

/**
 * Trait ApiResponseTrait
 * Standard response envelope untuk seluruh endpoint RESTful API SIMKODES.
 * Format response seragam (Consistent Response Envelope):
 * - success: boolean
 * - code: integer HTTP status code
 * - message: string deskripsi status
 * - data: array/object payload
 * - meta: optional metadata (pagination, etc.)
 */
trait ApiResponseTrait
{
    /**
     * Response sukses terstandarisasi (200, 201)
     */
    protected function sendResponse(mixed $data = null, string $message = 'Operasi berhasil', int $code = 200, array $meta = []): JsonResponse
    {
        $response = [
            'success' => true,
            'code' => $code,
            'message' => $message,
            'data' => $data,
        ];

        if (! empty($meta)) {
            $response['meta'] = $meta;
        }

        return response()->json($response, $code);
    }

    /**
     * Response sukses dengan pagination data (ResourceCollection)
     */
    protected function sendPaginated(ResourceCollection $collection, string $message = 'Data berhasil diambil', int $code = 200): JsonResponse
    {
        $paginated = $collection->resource->toArray();

        return response()->json([
            'success' => true,
            'code' => $code,
            'message' => $message,
            'data' => $collection->resolve(),
            'meta' => [
                'current_page' => $paginated['current_page'] ?? null,
                'per_page' => $paginated['per_page'] ?? null,
                'total' => $paginated['total'] ?? null,
                'last_page' => $paginated['last_page'] ?? null,
            ],
            'links' => [
                'first' => $paginated['first_page_url'] ?? null,
                'last' => $paginated['last_page_url'] ?? null,
                'prev' => $paginated['prev_page_url'] ?? null,
                'next' => $paginated['next_page_url'] ?? null,
            ],
        ], $code);
    }

    /**
     * Response gagal / error terstandarisasi (400, 401, 403, 404, 422, 500)
     */
    protected function sendError(string $message = 'Terjadi kesalahan', mixed $errors = null, int $code = 400): JsonResponse
    {
        $response = [
            'success' => false,
            'code' => $code,
            'message' => $message,
        ];

        if (! empty($errors)) {
            $response['errors'] = $errors;
        }

        return response()->json($response, $code);
    }
}

