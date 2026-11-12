<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\InventoryResource;
use App\Models\Inventory;
use App\Traits\ApiResponseTrait;
use Illuminate\Http\JsonResponse;

class InventoryController extends Controller
{
    use ApiResponseTrait;

    /**
     * Tampilkan data inventaris dengan indexing nama_barang
     */
    public function index(): JsonResponse
    {
        $inventories = Inventory::select([
            'id',
            'nama_barang',
            'tanggal',
            'jumlah',
            'harga_satuan',
            'jumlah_rupiah',
            'umur_teknis',
            'umur_ekonomis',
            'keterangan',
            'created_at',
            'updated_at',
        ])->latest('id')->paginate(15);

        return $this->sendPaginated(InventoryResource::collection($inventories), 'Daftar inventaris berhasil dimuat.');
    }

    /**
     * Detail item inventaris
     */
    public function show(int $id): JsonResponse
    {
        $inventory = Inventory::select([
            'id',
            'nama_barang',
            'tanggal',
            'jumlah',
            'harga_satuan',
            'jumlah_rupiah',
            'umur_teknis',
            'umur_ekonomis',
            'keterangan',
            'created_at',
            'updated_at',
        ])->find($id);

        if (! $inventory) {
            return $this->sendError('Data inventaris tidak ditemukan.', null, 404);
        }

        return $this->sendResponse(new InventoryResource($inventory), 'Detail inventaris berhasil dimuat.');
    }
}
