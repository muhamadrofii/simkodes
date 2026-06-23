<x-app-layout>
    {{-- Page Title --}}
    <x-page-title>Data Anggota</x-page-title>

    {{-- Section: Add & Search --}}
    <div class="bg-white rounded-4 shadow-sm p-4 mb-4">
        <div class="row align-items-center justify-content-between g-3">
            {{-- Add Button --}}
            <div class="col-md-6 col-lg-5">
                <a href="{{ route('members.create') }}" class="btn btn-primary d-flex align-items-center justify-content-center justify-content-md-start w-100 w-md-auto">
                    <i class="ti ti-plus me-2"></i> Tambah Data Anggota
                </a>
            </div>
            {{-- Search Form --}}
            <div class="col-md-6 col-lg-7">
                <form action="{{ route('members.index') }}" method="GET" class="d-flex">
                    <input type="text" name="search" class="form-control rounded-start"
                        value="{{ request('search') }}" placeholder="Cari nama anggota..." autocomplete="off">
                    <button class="btn btn-primary rounded-end ms-0" type="submit">Cari</button>
                </form>
            </div>
        </div>
    </div>

    {{-- Section: Table --}}
    <div class="bg-white rounded-4 shadow-sm p-4 mb-4">
        <div class="table-responsive">
            <table class="table table-hover align-middle">
                <thead class="bg-light">
                    <tr>
                        <th class="text-center py-3" width="50">No</th>
                        <th class="py-3" width="60">Foto</th>
                        <th class="py-3">Nama Anggota</th>
                        <th class="py-3">Kategori</th>
                        <th class="py-3">L/P</th>
                        <th class="py-3">Pekerjaan</th>
                        <th class="py-3 text-center">Tanggal Masuk</th>
                        <th class="text-center py-3" width="220">Aksi</th>
                    </tr>
                </thead>
                <tbody class="border-top-0">
                    @forelse ($members as $key => $member)
                        <tr>
                            <td class="text-center text-muted">
                                {{ ($members->currentPage() - 1) * $members->perPage() + $key + 1 }}
                            </td>
                            <td>
                                <div class="d-flex align-items-center">
                                    @if ($member->image)
                                        <img src="{{ asset('member_files/' . $member->image) }}" class="rounded-circle border shadow-sm" width="40" height="40" style="object-fit: cover;" alt="Foto">
                                    @else
                                        <div class="rounded-circle border bg-light d-flex align-items-center justify-content-center" style="width: 40px; height: 40px;">
                                            <i class="ti ti-user text-muted fs-5"></i>
                                        </div>
                                    @endif
                                </div>
                            </td>
                            <td>
                                <span class="fw-bold text-dark">{{ $member->nama }}</span>
                            </td>
                            <td>
                                <span class="badge bg-primary-subtle text-primary border border-primary-subtle px-3 py-2 rounded-3">
                                    {{ $member->category->name ?? 'Tidak Ada' }}
                                </span>
                            </td>
                            <td>
                                <span class="text-muted">{{ $member->jenis_kelamin == 'L' ? 'Laki-laki' : 'Perempuan' }}</span>
                            </td>
                            <td>
                                <span class="text-muted">{{ $member->mata_pencaharian ?? '-' }}</span>
                            </td>
                            <td class="text-center small text-muted">
                                {{ $member->tanggal_masuk ? \Carbon\Carbon::parse($member->tanggal_masuk)->format('d/m/Y') : '-' }}
                            </td>
                            <td>
                                <div class="d-flex justify-content-center gap-2">
                                    {{-- Detail --}}
                                    <a href="{{ route('members.show', $member->id) }}"
                                        class="btn btn-light btn-sm rounded-3 border shadow-sm p-2" title="Detail">
                                        <i class="ti ti-eye text-info fs-5"></i>
                                    </a>

                                    {{-- Edit --}}
                                    <a href="{{ route('members.edit', $member->id) }}"
                                        class="btn btn-light btn-sm rounded-3 border shadow-sm p-2" title="Edit">
                                        <i class="ti ti-edit text-warning fs-5"></i>
                                    </a>

                                    {{-- Cetak KTA --}}
                                    <a href="{{ route('members.kta', $member->id) }}"
                                        class="btn btn-light btn-sm rounded-3 border shadow-sm p-2" target="_blank" title="Cetak KTA">
                                        <i class="ti ti-printer text-success fs-5"></i>
                                    </a>

                                    {{-- Delete (modal trigger) --}}
                                    <button type="button" class="btn btn-light btn-sm rounded-3 border shadow-sm p-2"
                                        data-bs-toggle="modal" data-bs-target="#deleteModal{{ $member->id }}" title="Hapus">
                                        <i class="ti ti-trash text-danger fs-5"></i>
                                    </button>
                                </div>

                                {{-- Modal Delete --}}
                                <div class="modal fade" id="deleteModal{{ $member->id }}" tabindex="-1" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered">
                                        <div class="modal-content rounded-4 border-0 shadow">
                                            <div class="modal-header border-0 pb-0">
                                                <h5 class="modal-title fw-bold">Konfirmasi Hapus</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body py-4 text-center">
                                                <i class="ti ti-alert-triangle text-danger fs-1 mb-3"></i>
                                                <p class="mb-0">Yakin ingin menghapus data anggota
                                                    <br><strong>{{ $member->nama }}</strong>?
                                                </p>
                                            </div>
                                            <div class="modal-footer border-0 pt-0 justify-content-center pb-4">
                                                <button type="button" class="btn btn-light px-4"
                                                    data-bs-dismiss="modal">Batal</button>
                                                <form action="{{ route('members.destroy', $member->id) }}" method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger px-4">Hapus Sekarang</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8" class="text-center py-5 text-muted">
                                <i class="ti ti-users fs-1 d-block mb-2"></i>
                                Belum ada data anggota.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    {{-- Pagination --}}
    <div class="d-flex justify-content-center mt-4">
        {{ $members->appends(['search' => request('search')])->links('pagination::bootstrap-5') }}
    </div>
</x-app-layout>