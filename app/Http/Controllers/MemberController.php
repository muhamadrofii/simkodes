<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Member;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;
use Barryvdh\DomPDF\Facade\Pdf;

class MemberController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        $maxData = 8;

        if (request('search')) {
            $members = Member::select('id', 'category_id', 'nama', 'ttd')
                ->with('category:id,name')
                ->where('nama', 'LIKE', '%' . request('search') . '%')
                ->paginate($maxData)
                ->withQueryString();
        } else {
            $members = Member::select('id', 'category_id', 'nama', 'ttd')
                ->with('category:id,name')
                ->latest()
                ->paginate($maxData);
        }

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
            'category_id'       => 'nullable|exists:categories,id',
            'nama'              => 'required|string|max:255',
            'umur'              => 'nullable|integer|min:0',
            'jenis_kelamin'     => 'required|in:L,P',
            'mata_pencaharian'  => 'nullable|string|max:255',
            'tempat_tinggal'    => 'nullable|string|max:255',
            'tanggal_masuk'     => 'nullable|date',
            'cap_ibu_jari'      => 'nullable|image|mimes:jpeg,jpg,png|max:1024',
            'ttd'               => 'nullable|image|mimes:jpeg,jpg,png|max:1024',
            'image'   => 'nullable|image|mimes:jpeg,jpg,png|max:2048',
            'tanggal_keluar'    => 'nullable|date',
            'sebab_berhenti'    => 'nullable|string|max:255',
            'keterangan'        => 'nullable|string',
        ]);
        $cap_ibu_jari = null;
        if ($request->hasFile('cap_ibu_jari')) {
            $path = $request->file('cap_ibu_jari')->storeAs('public/members', $request->file('cap_ibu_jari')->hashName(), 'public');
            $cap_ibu_jari = basename($path);
        }

        $ttd = null;
        if ($request->hasFile('ttd')) {
            $path = $request->file('ttd')->storeAs('public/members', $request->file('ttd')->hashName(), 'public');
            $ttd = basename($path);
        }

        $image = null;
        if ($request->hasFile('image')) { // ✅ disesuaikan ke image
            $path = $request->file('image')->storeAs('public/members', $request->file('image')->hashName(), 'public');
            $image = basename($path);
        }

        Member::create([
            'category_id'      => $request->category_id,
            'nama'             => $request->nama,
            'umur'             => $request->umur,
            'jenis_kelamin'    => $request->jenis_kelamin,
            'mata_pencaharian' => $request->mata_pencaharian,
            'tempat_tinggal'   => $request->tempat_tinggal,
            'tanggal_masuk'    => $request->tanggal_masuk,
            'cap_ibu_jari'     => $cap_ibu_jari,
            'ttd'              => $ttd,
            'image'            => $image, 
            'tanggal_keluar'   => $request->tanggal_keluar,
            'sebab_berhenti'   => $request->sebab_berhenti,
            'keterangan'       => $request->keterangan,
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
        $kop = base64_encode(file_get_contents(public_path('images/kopmerah.png')));

        // urutan prioritas foto: image > ttd > cap_ibu_jari
        $photoFile = $member->image ?? $member->ttd ?? $member->cap_ibu_jari;
        $photoPath = $photoFile ? public_path('/storage/public/members/' . $photoFile) : null;

        if ($photoPath && file_exists($photoPath)) {
            $photoData = base64_encode(file_get_contents($photoPath));
            $photoType = pathinfo($photoPath, PATHINFO_EXTENSION);
            $photoBase64 = 'data:image/' . $photoType . ';base64,' . $photoData;
        } else {
            $photoBase64 = null;
        }

        $pdf = Pdf::loadView('members.kta', compact('member', 'kop', 'photoBase64'))
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
            'category'        => 'nullable|exists:categories,id',
            'full_name'       => 'required|string|max:255',
            'nik'             => 'nullable|string|max:50',
            'birth_date'      => 'nullable|date',
            'gender'          => 'required|in:Male,Female',
            'address'         => 'nullable|string|max:255',
            'email'           => 'nullable|email|max:255',
            'phone_number'    => 'nullable|string|max:20',
            'join_date'       => 'nullable|date',
            'profile_picture' => 'nullable|image|mimes:jpeg,jpg,png|max:2048',
        ]);

        $member = Member::findOrFail($id);

        // handle foto profil
        if ($request->hasFile('profile_picture')) {
            if ($member->profile_picture && Storage::disk('public')->exists('members/'.$member->profile_picture)) {
                Storage::disk('public')->delete('members/'.$member->profile_picture);
            }

            $filename = $request->file('profile_picture')->hashName();
            $request->file('profile_picture')->storeAs('members', $filename, 'public');
            $member->profile_picture = $filename;
        }

        // update field lain
        $member->update([
            'category_id'   => $request->category,
            'nama'          => $request->full_name,
            'nik'           => $request->nik,
            'tanggal_masuk' => $request->join_date,
            'jenis_kelamin' => $request->gender == 'Male' ? 'L' : 'P',
            'alamat'        => $request->address,
            'email'         => $request->email,
            'no_hp'         => $request->phone_number,
            'tanggal_lahir' => $request->birth_date,
            'image'         => $member->profile_picture,
        ]);

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
            Storage::delete('public/members/' . $member->cap_ibu_jari);
        }

        if ($member->ttd) {
            Storage::delete('public/members/' . $member->ttd);
        }

        if ($member->image) {
            Storage::delete('public/members/' . $member->image);
        }

        // Hapus data anggota
        $member->delete();

        return redirect()->route('members.index')
            ->with(['success' => 'Data anggota berhasil dihapus.']);
    }

}
