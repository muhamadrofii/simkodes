<?php

namespace Tests\Feature;

use App\Models\Inventory;

class InventoryTest extends SimkodesTestCase
{
    public function test_index_displays_inventories(): void
    {
        $this->authGet('/inventories')->assertStatus(200);
    }

    public function test_create_page_renders_properly(): void
    {
        $this->authGet('/inventories/create')->assertStatus(200);
    }

    public function test_store_creates_inventory(): void
    {
        $namaBarang = 'Laptop Lenovo ' . uniqid();

        $response = $this->authPost('/inventories', [
            'nama_barang' => $namaBarang,
            'jumlah_value' => 10,
            'satuan' => 'Unit',
            'harga_satuan' => 5000000,
            'tanggal' => '2026-01-01',
            'keterangan' => 'Inventaris Baru',
        ]);

        $response->assertRedirect(route('inventories.index'));
        $this->assertDatabaseHas('inventories', ['nama_barang' => $namaBarang]);
    }

    public function test_show_and_edit_inventory(): void
    {
        $item = Inventory::first() ?? Inventory::create([
            'nama_barang' => 'Meja Rapat',
            'jumlah' => '2 Unit',
            'harga_satuan' => 1500000,
            'jumlah_rupiah' => 3000000,
            'tanggal' => '2026-01-01',
        ]);

        $this->authGet("/inventories/{$item->id}")->assertStatus(200);
        $this->authGet("/inventories/{$item->id}/edit")->assertStatus(200);
    }

    public function test_export_pdf_and_excel(): void
    {
        $pdfRes = $this->authGet('/inventories/export/pdf');
        $pdfRes->assertStatus(200);

        $excelRes = $this->authGet('/inventories/export/excel');
        $excelRes->assertStatus(200);
    }

    public function test_update_modifies_inventory(): void
    {
        $item = Inventory::create([
            'nama_barang' => 'Kursi Kayu ' . uniqid(),
            'jumlah' => '4 Pcs',
            'harga_satuan' => 200000,
            'jumlah_rupiah' => 800000,
            'tanggal' => '2026-01-01',
        ]);

        $updatedNama = 'Kursi Jati ' . uniqid();

        $response = $this->authPut("/inventories/{$item->id}", [
            'nama_barang' => $updatedNama,
            'jumlah_value' => 8,
            'satuan' => 'Pcs',
            'harga_satuan' => 250000,
            'tanggal' => '2026-01-01',
        ]);

        $response->assertRedirect(route('inventories.index'));
        $this->assertDatabaseHas('inventories', ['id' => $item->id, 'nama_barang' => $updatedNama]);
    }

    public function test_destroy_deletes_inventory(): void
    {
        $item = Inventory::create([
            'nama_barang' => 'Papan Tulis Rusak ' . uniqid(),
            'jumlah' => '1 Unit',
            'harga_satuan' => 50000,
            'jumlah_rupiah' => 50000,
            'tanggal' => '2026-01-01',
        ]);

        $response = $this->authDelete("/inventories/{$item->id}");
        $response->assertRedirect(route('inventories.index'));
        $this->assertDatabaseMissing('inventories', ['id' => $item->id]);
    }
}
