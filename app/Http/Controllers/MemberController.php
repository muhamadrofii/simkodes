<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Member;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\File;

class MemberController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        $maxData = 8;
        $search = $request->query('search');

        $query = Member::select('id', 'category_id', 'nama', 'image', 'ttd', 'cap_ibu_jari')
            ->with('category:id,name');

        if ($search) {
            $query->where('nama', 'LIKE', '%' . $search . '%');
        }

        $members = $query->latest()->paginate($maxData)->withQueryString();

        return view('members.index', compact('members'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        $categories = Category::get(['id', 'name']);
        return view('members.create', compact('categories'));
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
            'tempat_tinggal' => 'nullable|string|max:255',
            'tanggal_masuk' => 'nullable|date',
            'cap_ibu_jari' => 'nullable|image|mimes:jpeg,jpg,png|max:1024',
            'ttd' => 'nullable|image|mimes:jpeg,jpg,png|max:1024',
            'image' => 'nullable|image|mimes:jpeg,jpg,png|max:2048',
            'tanggal_keluar' => 'nullable|date',
            'sebab_berhenti' => 'nullable|string|max:255',
            'keterangan' => 'nullable|string',
        ]);
        $cap_ibu_jari = null;
        if ($request->hasFile('cap_ibu_jari')) {
            // $path = $request->file('cap_ibu_jari')->storeAs('public/members', $request->file('cap_ibu_jari')->hashName(), 'public');
            $nama = $request->file('cap_ibu_jari')->hashName();
            $request->file('cap_ibu_jari')->move(public_path('member_files'), $nama);

            $cap_ibu_jari = $nama;
        }

        $ttd = null;
        if ($request->hasFile('ttd')) {
            $nama = $request->file('ttd')->hashName();
            // $path = $request->file('ttd')->storeAs('public/members', $request->file('ttd')->hashName(), 'public');
            $request->file('ttd')->move(public_path('member_files'), $nama);
            $ttd = $nama;
        }

        $image = null;
        if ($request->hasFile('image')) { // ✅ disesuaikan ke image
            $nama = $request->file('image')->hashName();
            $request->file('image')->move(public_path('member_files'), $nama);

            // $path = $request->file('image')->storeAs('public/members', $request->file('image')->hashName(), 'public');
            $image = $nama;
        }

        Member::create([
            'category_id' => $request->category_id,
            'nama' => $request->nama,
            'umur' => $request->umur,
            'jenis_kelamin' => $request->jenis_kelamin,
            'mata_pencaharian' => $request->mata_pencaharian,
            'tempat_tinggal' => $request->tempat_tinggal,
            'tanggal_masuk' => $request->tanggal_masuk,
            'cap_ibu_jari' => $cap_ibu_jari,
            'ttd' => $ttd,
            'image' => $image,
            'tanggal_keluar' => $request->tanggal_keluar,
            'sebab_berhenti' => $request->sebab_berhenti,
            'keterangan' => $request->keterangan,
        ]);

        return redirect()->route('members.index')->with(['success' => 'Data anggota berhasil disimpan.']);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id): View
    {
        // ambil data member berdasarkan id
        $member = Member::findOrFail($id);

        // langsung lempar ke view
        return view('members.show', compact('member'));
    }




    /**
     * Cetak KTA anggota ke PDF.
     */

    public function printKTA($id)
    {
        $member = Member::findOrFail($id);

        // Encode Logos
        $logoMerahData = base64_encode(file_get_contents(public_path('images/kopmerah.png')));
        $logoMerah = 'data:image/png;base64,' . $logoMerahData;

        $logoSimData = base64_encode(file_get_contents(public_path('images/kopnew.png')));
        $logoSim = 'data:image/png;base64,' . $logoSimData;

        // urutan prioritas foto: image > ttd > cap_ibu_jari
        $photoFile = $member->image ?? $member->ttd ?? $member->cap_ibu_jari;
        $photoPath = $photoFile ? public_path('member_files/' . $photoFile) : null;

        if ($photoPath && file_exists($photoPath)) {
            $photoData = base64_encode(file_get_contents($photoPath));
            $photoType = pathinfo($photoPath, PATHINFO_EXTENSION);
            $photoBase64 = 'data:image/' . $photoType . ';base64,' . $photoData;
        } else {
            $photoBase64 = null;
        }

        $pdf = Pdf::loadView('members.kta', compact('member', 'logoMerah', 'logoSim', 'photoBase64'))
            ->setPaper('a5', 'landscape')
            ->setOptions(['isRemoteEnabled' => true, 'isHtml5ParserEnabled' => true]);

        return $pdf->stream('KTA-' . $member->nama . '.pdf');
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id): View
    {
        $member = Member::findOrFail($id);
        $categories = Category::get(['id', 'name']);
        return view('members.edit', compact('member', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */

    public function update(Request $request, $id): RedirectResponse
    {

        $request->validate([
            'category_id' => 'nullable|exists:categories,id',
            'nama' => 'required|string|max:255',
            'nik' => 'nullable|string|max:50',
            'jenis_kelamin' => 'required|in:L,P',
            'mata_pencaharian' => 'nullable|string|max:255',
            'tempat_tinggal' => 'nullable|string|max:255',
            'tanggal_masuk' => 'nullable|date',
            'image' => 'nullable|image|mimes:jpeg,jpg,png|max:2048',
        ]);



        $member = Member::findOrFail($id);

        // handle foto profil
        if ($request->hasFile('image')) {
            $filePath = public_path('member_files/' . $member->image);

            if (File::exists($filePath)) {
                File::delete($filePath);
            }
            $filename = $request->file('image')->hashName();
            $request->file('image')->move(public_path('member_files'), $filename);

            // if ($member->profile_picture && Storage::disk('public')->exists('public/members/'.$member->profile_picture)) {
            //     Storage::disk('public')->delete('members/'.$member->profile_picture);
            // }

            // $request->file('profile_picture')->storeAs('members', $filename, 'public');

            $request->image = $filename;

            $member->update([
                'category_id' => $request->category_id,
                'nama' => $request->nama,
                'nik' => $request->nik,
                'tanggal_masuk' => $request->tanggal_masuk,
                'jenis_kelamin' => $request->jenis_kelamin == 'Male' ? 'L' : 'P',
                'tempat_tinggal' => $request->tempat_tinggal,
                'mata_pencaharian' => $request->mata_pencaharian,
                'image' => $request->image,
            ]);
        } else {
            $member->update([
                'category_id' => $request->category_id,
                'nama' => $request->nama,
                'nik' => $request->nik,
                'tanggal_masuk' => $request->tanggal_masuk,
                'jenis_kelamin' => $request->jenis_kelamin == 'Male' ? 'L' : 'P',
                'tempat_tinggal' => $request->tempat_tinggal,
                'mata_pencaharian' => $request->mata_pencaharian
            ]);
        }



        return redirect()
            ->route('members.show', $member->id)
            ->with(['success' => 'Data anggota berhasil diperbarui.']);
    }



    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id): RedirectResponse
    {
        $member = Member::findOrFail($id);

        // Hapus semua file terkait jika ada
        if ($member->cap_ibu_jari) {
            $filePath = public_path('member_files/' . $member->cap_ibu_jari);

            if (File::exists($filePath)) {
                File::delete($filePath);
            }

            // Storage::delete('public/members/' . $member->cap_ibu_jari);
        }

        if ($member->ttd) {
            // Storage::delete('public/members/' . $member->ttd);
            $filePath = public_path('member_files/' . $member->ttd);

            if (File::exists($filePath)) {
                File::delete($filePath);
            }
        }

        if ($member->image) {
            // Storage::delete('public/members/' . $member->image);
            $filePath = public_path('member_files/' . $member->image);

            if (File::exists($filePath)) {
                File::delete($filePath);
            }
        }

        // Hapus data anggota
        $member->delete();

        return redirect()->route('members.index')
            ->with(['success' => 'Data anggota berhasil dihapus.']);
    }

}
