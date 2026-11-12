<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\StoreMemberRequest;
use App\Http\Requests\Api\UpdateMemberRequest;
use App\Http\Resources\MemberResource;
use App\Models\Member;
use App\Traits\ApiResponseTrait;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class MemberController extends Controller
{
    use ApiResponseTrait;

    /**
     * Tampilkan daftar anggota secara efisien (Eager Loading & Column Projection).
     */
    public function index(Request $request): JsonResponse
    {
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

        return $this->sendPaginated(MemberResource::collection($members), 'Daftar anggota berhasil dimuat.');
    }

    /**
     * Simpan data anggota baru
     */
    public function store(StoreMemberRequest $request): JsonResponse
    {
        $member = Member::create($request->validated());
        $member->load('category:id,name');

        return $this->sendResponse(
            new MemberResource($member),
            'Data anggota berhasil ditambahkan.',
            201
        );
    }

    /**
     * Detail anggota
     */
    public function show($id): JsonResponse
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
        ])->with(['category:id,name'])->find($resolvedId);

        if (! $member) {
            return $this->sendError('Data anggota tidak ditemukan.', null, 404);
        }

        return $this->sendResponse(new MemberResource($member), 'Detail anggota berhasil dimuat.');
    }

    /**
     * Perbarui data anggota
     */
    public function update(UpdateMemberRequest $request, $id): JsonResponse
    {
        $resolvedId = $id instanceof Member ? $id->id : $id;
        $member = Member::find($resolvedId);

        if (! $member) {
            return $this->sendError('Data anggota tidak ditemukan.', null, 404);
        }

        $member->update($request->validated());
        $member->load('category:id,name');

        return $this->sendResponse(new MemberResource($member), 'Data anggota berhasil diperbarui.');
    }

    /**
     * Hapus data anggota
     */
    public function destroy($id): JsonResponse
    {
        $resolvedId = $id instanceof Member ? $id->id : $id;
        $member = Member::find($resolvedId);

        if (! $member) {
            return $this->sendError('Data anggota tidak ditemukan.', null, 404);
        }

        $member->delete();

        return $this->sendResponse(null, 'Data anggota berhasil dihapus.');
    }
}
