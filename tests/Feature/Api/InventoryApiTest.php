<?php

namespace Tests\Feature\Api;

use App\Models\Inventory;

class InventoryApiTest extends ApiTestCase
{
    public function test_get_inventories_list(): void
    {
        Inventory::firstOrCreate(
            ['nama_barang' => 'Kursi Kerja API'],
            ['jumlah' => '5 Unit', 'harga_satuan' => 300000, 'jumlah_rupiah' => 1500000]
        );

        $response = $this->apiAs()->apiGet('/api/inventories');

        $response->assertStatus(200)
                 ->assertJsonStructure([
                     'data' => [
                         '*' => ['id', 'nama_barang', 'jumlah', 'harga_satuan', 'jumlah_rupiah', 'created_at'],
                     ],
                 ]);
    }

    public function test_get_inventory_detail(): void
    {
        $inv = Inventory::firstOrCreate(
            ['nama_barang' => 'Proyektor API ' . uniqid()],
            ['jumlah' => '1 Unit', 'harga_satuan' => 4500000, 'jumlah_rupiah' => 4500000]
        );

        $response = $this->apiAs()->apiGet("/api/inventories/{$inv->id}");

        $response->assertStatus(200)
                 ->assertJsonPath('data.id', $inv->id)
                 ->assertJsonPath('data.nama_barang', $inv->nama_barang);
    }
}
