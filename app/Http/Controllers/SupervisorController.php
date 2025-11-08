<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Supervisor;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;
use Barryvdh\DomPDF\Facade\Pdf;

class SupervisorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        $maxData = 8;

        $query = Supervisor::select('id', 'category_id', 'nama', 'ttd_ketua')
            ->with('category:id,name');

        if (request('search')) {
            $query->where('nama', 'LIKE', '%' . request('search') . '%');
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
            'category_id'         => 'nullable|exists:categories,id',
            'nama'                => 'required|string|max:255',
            'umur'                => 'nullable|integer|min:0',
            'jenis_kelamin'       => 'required|in:L,P',
            'mata_pencaharian'    => 'nullable|string|max:255',
            'jabatan'             => 'nullable|string|max:255',
            'tempat_tinggal'      => 'nullable|string|max:255',
            'no_anggota_koperasi' => 'nullable|string|max:255',
            'tanggal_dipilih'     => 'nullable|date',
            'tanggal_berhenti'    => 'nullable|date',
            'ttd_ketua'           => 'nullable|image|mimes:jpeg,jpg,png|max:1024',
            'image'               => 'nullable|image|mimes:jpeg,jpg,png|max:2048',
            'keterangan'          => 'nullable|string',
        ]);

        $ttd_ketua = null;
        if ($request->hasFile('ttd_ketua')) {
            $path = $request->file('ttd_ketua')->storeAs('public/supervisors', $request->file('ttd_ketua')->hashName());
            $ttd_ketua = basename($path);
        }

        $image = null;
        if ($request->hasFile('image')) {
            $path = $request->file('image')->storeAs('public/supervisors', $request->file('image')->hashName());
            $image = basename($path);
        }

        Supervisor::create([
            'category_id'         => $request->category_id,
            'nama'                => $request->nama,
            'umur'                => $request->umur,
            'jenis_kelamin'       => $request->jenis_kelamin,
            'mata_pencaharian'    => $request->mata_pencaharian,
            'jabatan'             => $request->jabatan,
            'tempat_tinggal'      => $request->tempat_tinggal,
            'no_anggota_koperasi' => $request->no_anggota_koperasi,
            'tanggal_dipilih'     => $request->tanggal_dipilih,
            'tanggal_berhenti'    => $request->tanggal_berhenti,
            'ttd_ketua'           => $ttd_ketua,
            'image'               => $image,
            'keterangan'          => $request->keterangan,
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
        $kop = base64_encode(file_get_contents(public_path('images/kopmerah.png')));

        $photoFile = $supervisor->image ?? $supervisor->ttd_ketua;
        $photoPath = $photoFile ? public_path('storage/public/supervisors/' . $photoFile) : null;

        if ($photoPath && file_exists($photoPath)) {
            $photoData = base64_encode(file_get_contents($photoPath));
            $photoType = pathinfo($photoPath, PATHINFO_EXTENSION);
            $photoBase64 = 'data:image/' . $photoType . ';base64,' . $photoData;
        } else {
            $photoBase64 = null;
        }

        $pdf = Pdf::loadView('supervisors.kta', compact('supervisor', 'kop', 'photoBase64'))
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
            'category_id'         => 'nullable|exists:categories,id',
            'nama'                => 'required|string|max:255',
            'umur'                => 'nullable|integer|min:0',
            'jenis_kelamin'       => 'required|in:L,P',
            'mata_pencaharian'    => 'nullable|string|max:255',
            'jabatan'             => 'nullable|string|max:255',
            'tempat_tinggal'      => 'nullable|string|max:255',
            'no_anggota_koperasi' => 'nullable|string|max:255',
            'tanggal_dipilih'     => 'nullable|date',
            'tanggal_berhenti'    => 'nullable|date',
            'ttd_ketua'           => 'nullable|image|mimes:jpeg,jpg,png|max:1024',
            'image'               => 'nullable|image|mimes:jpeg,jpg,png|max:2048',
            'keterangan'          => 'nullable|string',
        ]);

        $supervisor = Supervisor::findOrFail($id);

        if ($request->hasFile('image')) {
            if ($supervisor->image) {
                Storage::delete('public/supervisors/' . $supervisor->image);
            }
            $path = $request->file('image')->storeAs('public/supervisors', $request->file('image')->hashName());
            $supervisor->image = basename($path);
        }

        if ($request->hasFile('ttd_ketua')) {
            if ($supervisor->ttd_ketua) {
                Storage::delete('public/supervisors/' . $supervisor->ttd_ketua);
            }
            $path = $request->file('ttd_ketua')->storeAs('public/supervisors', $request->file('ttd_ketua')->hashName());
            $supervisor->ttd_ketua = basename($path);
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
            Storage::delete('public/supervisors/' . $supervisor->image);
        }

        if ($supervisor->ttd_ketua) {
            Storage::delete('public/supervisors/' . $supervisor->ttd_ketua);
        }

        $supervisor->delete();

        return redirect()->route('supervisors.index')
            ->with(['success' => 'Data pengawas berhasil dihapus.']);
    }
}