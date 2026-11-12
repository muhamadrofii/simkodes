<?php

namespace App\Http\Requests\Api;

class UpdateMemberRequest extends BaseApiRequest
{
    public function rules(): array
    {
        return [
            'category_id' => 'nullable|exists:categories,id',
            'nama' => 'sometimes|required|string|max:255',
            'umur' => 'nullable|integer|min:0|max:120',
            'jenis_kelamin' => 'sometimes|required|in:L,P',
            'mata_pencaharian' => 'nullable|string|max:255',
            'tempat_tinggal' => 'nullable|string|max:255',
            'tanggal_masuk' => 'nullable|date',
        ];
    }
}
