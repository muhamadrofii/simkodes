<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Officer;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\File;

class OfficerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        $maxData = 8;
        $search = $request->query('search');

        $query = Officer::select('id', 'category_id', 'nama', 'image', 'ttd')
            ->with('category:id,name');

        if ($search) {
            $query->where('nama', 'LIKE', '%' . $search . '%');
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
            'category_id' => 'nullable|exists:categories,id',
            'nama' => 'required|string|max:255',
            'umur' => 'nullable|integer|min:0',
            'jenis_kelamin' => 'required|in:L,P',
            'jabatan' => 'nullable|string|max:255',
            'tempat_tinggal' => 'nullable|string|max:255',
            'no_anggota_koperasi' => 'nullable|string|max:255',
            'tanggal_diangkat' => 'nullable|date',
            'tanggal_berhenti' => 'nullable|date',
            'ttd' => 'nullable|image|mimes:jpeg,jpg,png|max:1024',
            'image' => 'nullable|image|mimes:jpeg,jpg,png|max:2048',
            'keterangan' => 'nullable|string',
        ]);

        $ttd = null;
        if ($request->hasFile('ttd')) {
            $nama = $request->file('ttd')->hashName();
            $request->file('ttd')->move(public_path('officer_files'), $nama);
            $ttd = $nama;
        }

        $image = null;
        if ($request->hasFile('image')) {
            $nama = $request->file('image')->hashName();
            $request->file('image')->move(public_path('officer_files'), $nama);
            $image = $nama;
        }

        Officer::create([
            'category_id' => $request->category_id,
            'nama' => $request->nama,
            'umur' => $request->umur,
            'jenis_kelamin' => $request->jenis_kelamin,
            'jabatan' => $request->jabatan,
            'tempat_tinggal' => $request->tempat_tinggal,
            'no_anggota_koperasi' => $request->no_anggota_koperasi,
            'tanggal_diangkat' => $request->tanggal_diangkat,
            'tanggal_berhenti' => $request->tanggal_berhenti,
            'ttd' => $ttd,
            'image' => $image,
            'keterangan' => $request->keterangan,
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

        // Encode Logos
        $logoMerahData = base64_encode(file_get_contents(public_path('images/kopmerah.png')));
        $logoMerah = 'data:image/png;base64,' . $logoMerahData;

        $logoSimData = base64_encode(file_get_contents(public_path('images/kopnew.png')));
        $logoSim = 'data:image/png;base64,' . $logoSimData;

        $photoFile = $officer->image ?? $officer->ttd;
        $photoPath = $photoFile ? public_path('officer_files/' . $photoFile) : null;

        if ($photoPath && file_exists($photoPath)) {
            $photoData = base64_encode(file_get_contents($photoPath));
            $photoType = pathinfo($photoPath, PATHINFO_EXTENSION);
            $photoBase64 = 'data:image/' . $photoType . ';base64,' . $photoData;
        } else {
            $photoBase64 = null;
        }

        $pdf = Pdf::loadView('officers.kta', compact('officer', 'logoMerah', 'logoSim', 'photoBase64'))
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
            'category_id' => 'nullable|exists:categories,id',
            'nama' => 'required|string|max:255',
            'umur' => 'nullable|integer|min:0',
            'jenis_kelamin' => 'required|in:L,P',
            'jabatan' => 'nullable|string|max:255',
            'tempat_tinggal' => 'nullable|string|max:255',
            'no_anggota_koperasi' => 'nullable|string|max:255',
            'tanggal_diangkat' => 'nullable|date',
            'tanggal_berhenti' => 'nullable|date',
            'ttd' => 'nullable|image|mimes:jpeg,jpg,png|max:1024',
            'image' => 'nullable|image|mimes:jpeg,jpg,png|max:2048',
            'keterangan' => 'nullable|string',
        ]);

        $officer = Officer::findOrFail($id);

        if ($request->hasFile('image')) {
            if ($officer->image) {
                $filePath = public_path('officer_files/' . $officer->image);

                if (File::exists($filePath)) {
                    File::delete($filePath);
                }
            }
            $filename = $request->file('image')->hashName();
            $request->file('image')->move(public_path('officer_files'), $filename);
            $officer->image = $filename;
        }

        if ($request->hasFile('ttd')) {
            if ($officer->ttd) {
                $filePath = public_path('officer_files/' . $officer->ttd);

                if (File::exists($filePath)) {
                    File::delete($filePath);
                }
            }
            $filename = $request->file('ttd')->hashName();
            $request->file('ttd')->move(public_path('officer_files'), $filename);

            $officer->ttd = $filename;
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
            $filePath = public_path('officer_files/' . $officer->image);

            if (File::exists($filePath)) {
                File::delete($filePath);
            }
        }

        if ($officer->ttd) {
            $filePath = public_path('officer_files/' . $officer->ttd);

            if (File::exists($filePath)) {
                File::delete($filePath);
            }
        }

        $officer->delete();

        return redirect()->route('officers.index')
            ->with(['success' => 'Data pengurus berhasil dihapus.']);
    }
}
