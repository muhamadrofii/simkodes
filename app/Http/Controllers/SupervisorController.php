<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Supervisor;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\File;

class SupervisorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        $maxData = 8;
        $search = $request->query('search');

        $query = Supervisor::select('id', 'category_id', 'nama', 'image', 'ttd_ketua')
            ->with('category:id,name');

        if ($search) {
            $query->where('nama', 'LIKE', '%' . $search . '%');
        }

        $supervisors = $query->latest()->paginate($maxData)->withQueryString();

        return view('supervisors.index', compact('supervisors'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        $categories = Category::get(['id', 'name']);
        return view('supervisors.create', compact('categories'));
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
            'mata_pencaharian' => 'nullable|string|max:255',
            'jabatan' => 'nullable|string|max:255',
            'tempat_tinggal' => 'nullable|string|max:255',
            'no_anggota_koperasi' => 'nullable|string|max:255',
            'tanggal_dipilih' => 'nullable|date',
            'tanggal_berhenti' => 'nullable|date',
            'ttd_ketua' => 'nullable|image|mimes:jpeg,jpg,png|max:1024',
            'image' => 'nullable|image|mimes:jpeg,jpg,png|max:2048',
            'keterangan' => 'nullable|string',
        ]);

        $ttd_ketua = null;
        if ($request->hasFile('ttd_ketua')) {
            $nama = $request->file('ttd_ketua')->hashName();
            $request->file('ttd_ketua')->move(public_path('supervisor_files'), $nama);
            $ttd_ketua = $nama;
        }

        $image = null;
        if ($request->hasFile('image')) {
            $nama = $request->file('image')->hashName();
            $request->file('image')->move(public_path('supervisor_files'), $nama);
            $image = $nama;
        }

        Supervisor::create([
            'category_id' => $request->category_id,
            'nama' => $request->nama,
            'umur' => $request->umur,
            'jenis_kelamin' => $request->jenis_kelamin,
            'mata_pencaharian' => $request->mata_pencaharian,
            'jabatan' => $request->jabatan,
            'tempat_tinggal' => $request->tempat_tinggal,
            'no_anggota_koperasi' => $request->no_anggota_koperasi,
            'tanggal_dipilih' => $request->tanggal_dipilih,
            'tanggal_berhenti' => $request->tanggal_berhenti,
            'ttd_ketua' => $ttd_ketua,
            'image' => $image,
            'keterangan' => $request->keterangan,
        ]);

        return redirect()->route('supervisors.index')->with(['success' => 'Data pengawas berhasil disimpan.']);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id): View
    {
        $supervisor = Supervisor::findOrFail($id);
        return view('supervisors.show', compact('supervisor'));
    }

    /**
     * Cetak KTA pengawas ke PDF.
     */
    public function printKTA($id)
    {
        $supervisor = Supervisor::findOrFail($id);

        // Encode Logos
        $logoMerahData = base64_encode(file_get_contents(public_path('images/kopmerah.png')));
        $logoMerah = 'data:image/png;base64,' . $logoMerahData;

        $logoSimData = base64_encode(file_get_contents(public_path('images/kopnew.png')));
        $logoSim = 'data:image/png;base64,' . $logoSimData;

        $photoFile = $supervisor->image ?? $supervisor->ttd_ketua;
        $photoPath = $photoFile ? public_path('supervisor_files/' . $photoFile) : null;

        if ($photoPath && file_exists($photoPath)) {
            $photoData = base64_encode(file_get_contents($photoPath));
            $photoType = pathinfo($photoPath, PATHINFO_EXTENSION);
            $photoBase64 = 'data:image/' . $photoType . ';base64,' . $photoData;
        } else {
            $photoBase64 = null;
        }

        $pdf = Pdf::loadView('supervisors.kta', compact('supervisor', 'logoMerah', 'logoSim', 'photoBase64'))
            ->setPaper('a5', 'landscape')
            ->setOptions(['isRemoteEnabled' => true, 'isHtml5ParserEnabled' => true]);

        return $pdf->stream('KTA-' . $supervisor->nama . '.pdf');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id): View
    {
        $supervisor = Supervisor::findOrFail($id);
        $categories = Category::get(['id', 'name']);
        return view('supervisors.edit', compact('supervisor', 'categories'));
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
            'mata_pencaharian' => 'nullable|string|max:255',
            'jabatan' => 'nullable|string|max:255',
            'tempat_tinggal' => 'nullable|string|max:255',
            'no_anggota_koperasi' => 'nullable|string|max:255',
            'tanggal_dipilih' => 'nullable|date',
            'tanggal_berhenti' => 'nullable|date',
            'ttd_ketua' => 'nullable|image|mimes:jpeg,jpg,png|max:1024',
            'image' => 'nullable|image|mimes:jpeg,jpg,png|max:2048',
            'keterangan' => 'nullable|string',
        ]);

        $supervisor = Supervisor::findOrFail($id);

        if ($request->hasFile('image')) {
            if ($supervisor->image) {
                $filePath = public_path('supervisor_files/' . $supervisor->image);

                if (File::exists($filePath)) {
                    File::delete($filePath);
                }
            }
            $filename = $request->file('image')->hashName();
            $request->file('image')->move(public_path('supervisor_files'), $filename);
            $supervisor->image = $filename;
        }

        if ($request->hasFile('ttd_ketua')) {
            if ($supervisor->ttd_ketua) {
                $filePath = public_path('supervisor_files/' . $supervisor->ttd_ketua);

                if (File::exists($filePath)) {
                    File::delete($filePath);
                }
            }
            $filename = $request->file('ttd_ketua')->hashName();
            $request->file('ttd_ketua')->move(public_path('supervisor_files'), $filename);
            $supervisor->ttd_ketua = $filename;
        }

        $supervisor->update($request->except(['image', 'ttd_ketua']));

        return redirect()->route('supervisors.show', $supervisor->id)
            ->with(['success' => 'Data pengawas berhasil diperbarui.']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id): RedirectResponse
    {
        $supervisor = Supervisor::findOrFail($id);

        if ($supervisor->image) {
            $filePath = public_path('supervisor_files/' . $supervisor->image);

            if (File::exists($filePath)) {
                File::delete($filePath);
            }
        }

        if ($supervisor->ttd_ketua) {
            $filePath = public_path('supervisor_files/' . $supervisor->ttd_ketua);

            if (File::exists($filePath)) {
                File::delete($filePath);
            }
        }

        $supervisor->delete();

        return redirect()->route('supervisors.index')
            ->with(['success' => 'Data pengawas berhasil dihapus.']);
    }
}