<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class MemberResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'nama' => $this->nama,
            'umur' => $this->umur,
            'jenis_kelamin' => $this->jenis_kelamin,
            'mata_pencaharian' => $this->mata_pencaharian,
            'tempat_tinggal' => $this->tempat_tinggal,
            'tanggal_masuk' => $this->tanggal_masuk,
            'image' => $this->image ? asset('member_files/' . $this->image) : null,
            'category' => new CategoryResource($this->whenLoaded('category')),
            'created_at' => $this->created_at?->toIso8601String(),
            'updated_at' => $this->updated_at?->toIso8601String(),
        ];
    }
}
