<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\MemberResource;
use App\Models\Member;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class MemberController extends Controller
{
    /**
     * Tampilkan daftar anggota secara efisien (Eager Loading & Column Projection).
     */
    public function index(Request $request): AnonymousResourceCollection
    {
        // Query efisien: Hindari N+1 query dengan eager loading terproyeksi
        $query = Member::select([
            'id',
            'category_id',
            'nama',
            'umur',
            'jenis_kelamin',
            'mata_pencaharian',
            'tempat_tinggal',
            'tanggal_masuk',
            'image',
            'created_at',
            'updated_at',
        ])->with(['category:id,name']);

        // Filter menggunakan kolom yang telah di-index
        if ($request->filled('nama')) {
            $query->where('nama', 'like', '%' . $request->nama . '%');
        }

        if ($request->filled('category_id')) {
            $query->where('category_id', $request->category_id);
        }

        $members = $query->latest('id')->paginate($request->integer('per_page', 15));

        return MemberResource::collection($members);
    }

    /**
     * Simpan data anggota baru
     */
    public function store(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'category_id' => 'nullable|exists:categories,id',
            'nama' => 'required|string|max:255',
            'umur' => 'nullable|integer|min:0',
            'jenis_kelamin' => 'required|in:L,P',
            'mata_pencaharian' => 'nullable|string|max:255',
            'tempat_tinggal' => 'nullable|string|max:255',
            'tanggal_masuk' => 'nullable|date',
        ]);

        $member = Member::create($validated);
        $member->load('category:id,name');

        return (new MemberResource($member))
            ->response()
            ->setStatusCode(201);
    }

    /**
     * Detail anggota
     */
    public function show($id): MemberResource
    {
        $resolvedId = $id instanceof Member ? $id->id : $id;
        $member = Member::select([
            'id',
            'category_id',
            'nama',
            'umur',
            'jenis_kelamin',
            'mata_pencaharian',
            'tempat_tinggal',
            'tanggal_masuk',
            'image',
            'created_at',
            'updated_at',
        ])->with(['category:id,name'])->findOrFail($resolvedId);

        return new MemberResource($member);
    }

    /**
     * Perbarui data anggota
     */
    public function update(Request $request, $id): MemberResource
    {
        $resolvedId = $id instanceof Member ? $id->id : $id;
        $member = Member::findOrFail($resolvedId);

        $validated = $request->validate([
            'category_id' => 'nullable|exists:categories,id',
            'nama' => 'required|string|max:255',
            'umur' => 'nullable|integer|min:0',
            'jenis_kelamin' => 'required|in:L,P',
            'mata_pencaharian' => 'nullable|string|max:255',
            'tempat_tinggal' => 'nullable|string|max:255',
            'tanggal_masuk' => 'nullable|date',
        ]);

        $member->update($validated);
        $member->load('category:id,name');

        return new MemberResource($member);
    }

    /**
     * Hapus data anggota
     */
    public function destroy($id): JsonResponse
    {
        $resolvedId = $id instanceof Member ? $id->id : $id;
        $member = Member::findOrFail($resolvedId);
        $member->delete();

        return response()->json([
            'status' => 'success',
            'message' => 'Data anggota berhasil dihapus.',
        ], 200);
    }
}
