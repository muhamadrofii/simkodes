<?php

namespace App\Http\Requests\Api;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

/**
 * Class BaseApiRequest
 * Base request class yang memastikan seluruh error validasi API dikembalikan dalam format standar JSON.
 */
abstract class BaseApiRequest extends FormRequest
{
    /**
     * Tentukan otorisasi request (default true)
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Override penanganan error validasi agar konsisten dengan Response Envelope API
     */
    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(
            response()->json([
                'success' => false,
                'code' => 422,
                'message' => 'Validasi parameter request gagal.',
                'errors' => $validator->errors(),
            ], 422)
        );
    }
}
