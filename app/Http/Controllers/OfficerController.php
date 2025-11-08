<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Officer;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;
use Barryvdh\DomPDF\Facade\Pdf;

class OfficerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        $maxData = 8;

        $query = Officer::select('id', 'category_id', 'nama', 'ttd')
            ->with('category:id,name');

        if (request('search')) {
            $query->where('nama', 'LIKE', '%' . request('search') . '%');
        }

        $officers = $query->latest()->paginate($maxData)->withQueryString();

        return view('officers.index', compact('officers'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        $categories = Category::get(['id', 'name']);
        return view('officers.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'category_id'       => 'nullable|exists:categories,id',
            'nama'              => 'required|string|max:255',
            'umur'              => 'nullable|integer|min:0',
            'jenis_kelamin'     => 'required|in:L,P',
            'jabatan'           => 'nullable|string|max:255',
            'tempat_tinggal'    => 'nullable|string|max:255',
            'no_anggota_koperasi' => 'nullable|string|max:255',
            'tanggal_diangkat'  => 'nullable|date',
            'tanggal_berhenti'  => 'nullable|date',
            'ttd'               => 'nullable|image|mimes:jpeg,jpg,png|max:1024',
            'image'             => 'nullable|image|mimes:jpeg,jpg,png|max:2048',
            'keterangan'        => 'nullable|string',
        ]);

        $ttd = null;
        if ($request->hasFile('ttd')) {
            $path = $request->file('ttd')->storeAs('public/officers', $request->file('ttd')->hashName(), 'public');
            $ttd = basename($path);
        }

        $image = null;
        if ($request->hasFile('image')) {
            $path = $request->file('image')->storeAs('public/officers', $request->file('image')->hashName(), 'public');
            $image = basename($path);
        }

        Officer::create([
            'category_id'         => $request->category_id,
            'nama'                => $request->nama,
            'umur'                => $request->umur,
            'jenis_kelamin'       => $request->jenis_kelamin,
            'jabatan'             => $request->jabatan,
            'tempat_tinggal'      => $request->tempat_tinggal,
            'no_anggota_koperasi' => $request->no_anggota_koperasi,
            'tanggal_diangkat'    => $request->tanggal_diangkat,
            'tanggal_berhenti'    => $request->tanggal_berhenti,
            'ttd'                 => $ttd,
            'image'               => $image,
            'keterangan'          => $request->keterangan,
        ]);

        return redirect()->route('officers.index')->with(['success' => 'Data pengurus berhasil disimpan.']);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id): View
    {
        $officer = Officer::findOrFail($id);
        return view('officers.show', compact('officer'));
    }

    /**
     * Cetak KTA pengurus ke PDF.
     */
    public function printKTA($id)
    {
        $officer = Officer::findOrFail($id);
        $kop = base64_encode(file_get_contents(public_path('images/kopmerah.png')));

        $photoFile = $officer->image ?? $officer->ttd;
        $photoPath = $photoFile ? public_path('/storage/public/officers/' . $photoFile) : null;

        if ($photoPath && file_exists($photoPath)) {
            $photoData = base64_encode(file_get_contents($photoPath));
            $photoType = pathinfo($photoPath, PATHINFO_EXTENSION);
            $photoBase64 = 'data:image/' . $photoType . ';base64,' . $photoData;
        } else {
            $photoBase64 = null;
        }

        $pdf = Pdf::loadView('officers.kta', compact('officer', 'kop', 'photoBase64'))
            ->setPaper('a5', 'landscape')
            ->setOptions(['isRemoteEnabled' => true, 'isHtml5ParserEnabled' => true]);

        return $pdf->stream('KTA-' . $officer->nama . '.pdf');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id): View
    {
        $officer = Officer::findOrFail($id);
        $categories = Category::get(['id', 'name']);
        return view('officers.edit', compact('officer', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id): RedirectResponse
    {
        $request->validate([
            'category_id'        => 'nullable|exists:categories,id',
            'nama'               => 'required|string|max:255',
            'umur'               => 'nullable|integer|min:0',
            'jenis_kelamin'      => 'required|in:L,P',
            'jabatan'            => 'nullable|string|max:255',
            'tempat_tinggal'     => 'nullable|string|max:255',
            'no_anggota_koperasi'=> 'nullable|string|max:255',
            'tanggal_diangkat'   => 'nullable|date',
            'tanggal_berhenti'   => 'nullable|date',
            'ttd'                => 'nullable|image|mimes:jpeg,jpg,png|max:1024',
            'image'              => 'nullable|image|mimes:jpeg,jpg,png|max:2048',
            'keterangan'         => 'nullable|string',
        ]);

        $officer = Officer::findOrFail($id);

        if ($request->hasFile('image')) {
            if ($officer->image) {
                Storage::delete('public/officers/' . $officer->image);
            }
            $path = $request->file('image')->storeAs('public/officers', $request->file('image')->hashName(), 'public');
            $officer->image = basename($path);
        }

        if ($request->hasFile('ttd')) {
            if ($officer->ttd) {
                Storage::delete('public/officers/' . $officer->ttd);
            }
            $path = $request->file('ttd')->storeAs('public/officers', $request->file('ttd')->hashName(), 'public');
            $officer->ttd = basename($path);
        }

        $officer->update($request->except(['image', 'ttd']));

        return redirect()->route('officers.show', $officer->id)
            ->with(['success' => 'Data pengurus berhasil diperbarui.']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id): RedirectResponse
    {
        $officer = Officer::findOrFail($id);

        if ($officer->image) {
            Storage::delete('public/officers/' . $officer->image);
        }

        if ($officer->ttd) {
            Storage::delete('public/officers/' . $officer->ttd);
        }

        $officer->delete();

        return redirect()->route('officers.index')
            ->with(['success' => 'Data pengurus berhasil dihapus.']);
    }
}
