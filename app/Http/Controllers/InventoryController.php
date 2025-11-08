<?php

namespace App\Http\Controllers;

use App\Models\Inventory;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class InventoryController extends Controller
{
    public function index(): View
    {
        $inventories = Inventory::latest()->get();
        return view('inventories.index', compact('inventories'));
    }

    public function create(): View
    {
        return view('inventories.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'nama_barang'    => 'required|string|max:255',
            'tanggal'        => 'nullable|date',
            'jumlah'         => 'nullable|numeric|min:0',
            'harga_satuan'   => 'nullable|numeric|min:0',
            'jumlah_rupiah'  => 'nullable|numeric|min:0',
            'umur_teknis'    => 'nullable|string|max:100',
            'umur_ekonomis'  => 'nullable|string|max:100',
            'keterangan'     => 'nullable|string',
        ]);

        // logic buat auto hitung jumlah_rupiah
        $data = $request->all();
        if (isset($data['jumlah']) && isset($data['harga_satuan'])) {
            $data['jumlah_rupiah'] = floatval($data['jumlah']) * floatval($data['harga_satuan']);
        }

        Inventory::create($data);

        return redirect()->route('inventories.index')->with('success', 'Data inventories berhasil ditambahkan!');
    }

    public function show(Inventory $inventory): View
    {
        return view('inventories.show', compact('inventory'));
    }

    public function edit($id)
    {
        $inventory = Inventory::findOrFail($id);
        return view('inventories.edit', compact('inventory'));
    }


    public function update(Request $request, Inventory $inventory): RedirectResponse
    {
        $request->validate([
            'nama_barang'    => 'required|string|max:255',
            'tanggal'        => 'nullable|date',
            'jumlah'         => 'nullable|numeric|min:0',
            'harga_satuan'   => 'nullable|numeric|min:0',
            'jumlah_rupiah'  => 'nullable|numeric|min:0',
            'umur_teknis'    => 'nullable|string|max:100',
            'umur_ekonomis'  => 'nullable|string|max:100',
            'keterangan'     => 'nullable|string',
        ]);

        $data = $request->all();
        if (isset($data['jumlah']) && isset($data['harga_satuan'])) {
            $data['jumlah_rupiah'] = floatval($data['jumlah']) * floatval($data['harga_satuan']);
        }

        $inventory->update($data);

        return redirect()->route('inventories.index')->with('success', 'Data inventories berhasil diperbarui!');
    }

    public function destroy(Inventory $inventory): RedirectResponse
    {
        $inventory->delete();

        return redirect()->route('inventories.index')->with('success', 'Data inventories berhasil dihapus!');
    }
}
