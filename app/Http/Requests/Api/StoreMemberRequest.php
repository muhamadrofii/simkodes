<?php

namespace App\Http\Requests\Api;

class StoreMemberRequest extends BaseApiRequest
{
    public function rules(): array
    {
        return [
            'category_id' => 'nullable|exists:categories,id',
            'nama' => 'required|string|max:255',
            'umur' => 'nullable|integer|min:0|max:120',
            'jenis_kelamin' => 'required|in:L,P',
            'mata_pencaharian' => 'nullable|string|max:255',
            'tempat_tinggal' => 'nullable|string|max:255',
            'tanggal_masuk' => 'nullable|date',
        ];
    }

    public function messages(): array
    {
        return [
            'nama.required' => 'Nama anggota wajib diisi.',
            'jenis_kelamin.required' => 'Jenis kelamin (L/P) wajib dipilih.',
            'jenis_kelamin.in' => 'Pilihan jenis kelamin hanya L atau P.',
            'category_id.exists' => 'Kategori yang dipilih tidak valid di database.',
        ];
    }
}

