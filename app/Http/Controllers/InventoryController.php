<?php

namespace App\Http\Controllers;

use App\Models\Inventory;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use Barryvdh\DomPDF\Facade\Pdf;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\InventoryExport;

class InventoryController extends Controller
{
    public function index(Request $request): View
    {
        $query = Inventory::latest();

        if ($request->has('search') && !empty($request->search)) {
            $search = $request->search;
            $query->where('nama_barang', 'like', "%{$search}%")
                ->orWhere('keterangan', 'like', "%{$search}%");
        }

        $inventories = $query->paginate(10)->withQueryString();

        return view('inventories.index', compact('inventories'));
    }

    public function create(): View
    {
        return view('inventories.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'nama_barang' => 'required|string|max:255',
            'tanggal' => 'nullable|date',
            'jumlah_value' => 'nullable|numeric|min:0',
            'satuan' => 'nullable|string',
            'harga_satuan' => 'nullable|numeric|min:0',
            'jumlah_rupiah' => 'nullable|numeric|min:0',
            'umur_teknis' => 'nullable|string|max:100',
            'umur_ekonomis' => 'nullable|string|max:100',
            'keterangan' => 'nullable|string',
        ]);

        $data = $request->all();

        // Gabungkan angka dan satuan untuk disimpan di kolom 'jumlah' (string)
        if ($request->filled('jumlah_value')) {
            $data['jumlah'] = $request->jumlah_value . ($request->filled('satuan') ? ' ' . $request->satuan : '');
        }

        // Hitung total harga (jumlah_rupiah)
        if ($request->filled('jumlah_value') && $request->filled('harga_satuan')) {
            $data['jumlah_rupiah'] = floatval($request->jumlah_value) * floatval($request->harga_satuan);
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
            'nama_barang' => 'required|string|max:255',
            'tanggal' => 'nullable|date',
            'jumlah_value' => 'nullable|numeric|min:0',
            'satuan' => 'nullable|string',
            'harga_satuan' => 'nullable|numeric|min:0',
            'jumlah_rupiah' => 'nullable|numeric|min:0',
            'umur_teknis' => 'nullable|string|max:100',
            'umur_ekonomis' => 'nullable|string|max:100',
            'keterangan' => 'nullable|string',
        ]);

        $data = $request->all();

        // Gabungkan angka dan satuan untuk disimpan di kolom 'jumlah' (string)
        if ($request->filled('jumlah_value')) {
            $data['jumlah'] = $request->jumlah_value . ($request->filled('satuan') ? ' ' . $request->satuan : '');
        }

        // Hitung total harga (jumlah_rupiah)
        if ($request->filled('jumlah_value') && $request->filled('harga_satuan')) {
            $data['jumlah_rupiah'] = floatval($request->jumlah_value) * floatval($request->harga_satuan);
        }

        $inventory->update($data);

        return redirect()->route('inventories.index')->with('success', 'Data inventories berhasil diperbarui!');
    }

    public function destroy(Inventory $inventory): RedirectResponse
    {
        $inventory->delete();

        return redirect()->route('inventories.index')->with('success', 'Data inventories berhasil dihapus!');
    }

    public function exportPdf()
    {
        $inventories = Inventory::all();
        $pdf = Pdf::loadView('inventories.pdf', compact('inventories'));

        return $pdf->download('buku-inventaris-' . date('Y-m-d') . '.pdf');
    }

    public function exportExcel()
    {
        return Excel::download(new InventoryExport, 'buku-inventaris-' . date('Y-m-d') . '.xlsx');
    }
}
