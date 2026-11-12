<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\InventoryResource;
use App\Models\Inventory;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class InventoryController extends Controller
{
    /**
     * Tampilkan data inventaris dengan indexing nama_barang
     */
    public function index(): AnonymousResourceCollection
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

        return InventoryResource::collection($inventories);
    }

    /**
     * Detail item inventaris
     */
    public function show(int $id): InventoryResource
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
        ])->findOrFail($id);

        return new InventoryResource($inventory);
    }
}
