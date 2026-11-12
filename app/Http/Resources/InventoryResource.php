<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class InventoryResource extends JsonResource
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
            'nama_barang' => $this->nama_barang,
            'tanggal' => $this->tanggal,
            'jumlah' => $this->jumlah,
            'harga_satuan' => (float) $this->harga_satuan,
            'jumlah_rupiah' => (float) $this->jumlah_rupiah,
            'umur_teknis' => $this->umur_teknis,
            'umur_ekonomis' => $this->umur_ekonomis,
            'keterangan' => $this->keterangan,
            'created_at' => $this->created_at?->toIso8601String(),
            'updated_at' => $this->updated_at?->toIso8601String(),
        ];
    }
}
