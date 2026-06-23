<x-app-layout>
    {{-- Page Title --}}
    <x-page-title>Data Pengurus</x-page-title>

    {{-- Section: Add & Search --}}
    <div class="bg-white rounded-4 shadow-sm p-4 mb-4">
        <div class="row align-items-center justify-content-between g-3">
            {{-- Add Button --}}
            <div class="col-md-6 col-lg-5">
                <a href="{{ route('officers.create') }}" class="btn btn-primary d-flex align-items-center justify-content-center justify-content-md-start w-100 w-md-auto">
                    <i class="ti ti-plus me-2"></i> Tambah Data Pengurus
                </a>
            </div>
            {{-- Search Form --}}
            <div class="col-md-6 col-lg-7">
                <form action="{{ route('officers.index') }}" method="GET" class="d-flex">
                    <input type="text" name="search" class="form-control rounded-start"
                        value="{{ request('search') }}" placeholder="Cari nama pengurus..." autocomplete="off">
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
                        <th class="py-3">Nama Pengurus</th>
                        <th class="py-3">Kategori</th>
                        <th class="py-3">Jabatan</th>
                        <th class="py-3">L/P</th>
                        <th class="py-3">No. Anggota</th>
                        <th class="text-center py-3" width="220">Aksi</th>
                    </tr>
                </thead>
                <tbody class="border-top-0">
                    @forelse ($officers as $key => $officer)
                        <tr>
                            <td class="text-center text-muted">
                                {{ ($officers->currentPage() - 1) * $officers->perPage() + $key + 1 }}
                            </td>
                            <td>
                                <div class="d-flex align-items-center">
                                    @if ($officer->image)
                                        <img src="{{ asset('officer_files/' . $officer->image) }}" class="rounded-circle border shadow-sm" width="40" height="40" style="object-fit: cover;" alt="Foto">
                                    @else
                                        <div class="rounded-circle border bg-light d-flex align-items-center justify-content-center" style="width: 40px; height: 40px;">
                                            <i class="ti ti-user text-muted fs-5"></i>
                                        </div>
                                    @endif
                                </div>
                            </td>
                            <td>
                                <span class="fw-bold text-dark">{{ $officer->nama }}</span>
                            </td>
                            <td>
                                <span class="badge bg-primary-subtle text-primary border border-primary-subtle px-3 py-2 rounded-3">
                                    {{ $officer->category->name ?? 'Tidak Ada' }}
                                </span>
                            </td>
                            <td>
                                <span class="text-dark fw-medium">{{ $officer->jabatan ?? '-' }}</span>
                            </td>
                            <td>
                                <span class="text-muted">{{ $officer->jenis_kelamin == 'L' ? 'Laki-laki' : 'Perempuan' }}</span>
                            </td>
                            <td>
                                <span class="text-muted small">{{ $officer->no_anggota_koperasi ?? '-' }}</span>
                            </td>
                            <td>
                                <div class="d-flex justify-content-center gap-2">
                                    {{-- Detail --}}
                                    <a href="{{ route('officers.show', $officer->id) }}"
                                        class="btn btn-light btn-sm rounded-3 border shadow-sm p-2" title="Detail">
                                        <i class="ti ti-eye text-info fs-5"></i>
                                    </a>

                                    {{-- Edit --}}
                                    <a href="{{ route('officers.edit', $officer->id) }}"
                                        class="btn btn-light btn-sm rounded-3 border shadow-sm p-2" title="Edit">
                                        <i class="ti ti-edit text-warning fs-5"></i>
                                    </a>

                                    {{-- Cetak KTA --}}
                                    <a href="{{ route('officers.kta', $officer->id) }}"
                                        class="btn btn-light btn-sm rounded-3 border shadow-sm p-2" target="_blank" title="Cetak KTA">
                                        <i class="ti ti-printer text-success fs-5"></i>
                                    </a>

                                    {{-- Delete (modal trigger) --}}
                                    <button type="button" class="btn btn-light btn-sm rounded-3 border shadow-sm p-2"
                                        data-bs-toggle="modal" data-bs-target="#deleteModal{{ $officer->id }}" title="Hapus">
                                        <i class="ti ti-trash text-danger fs-5"></i>
                                    </button>
                                </div>

                                {{-- Modal Delete --}}
                                <div class="modal fade" id="deleteModal{{ $officer->id }}" tabindex="-1" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered">
                                        <div class="modal-content rounded-4 border-0 shadow">
                                            <div class="modal-header border-0 pb-0">
                                                <h5 class="modal-title fw-bold">Konfirmasi Hapus</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body py-4 text-center">
                                                <i class="ti ti-alert-triangle text-danger fs-1 mb-3"></i>
                                                <p class="mb-0">Yakin ingin menghapus data pengurus
                                                    <br><strong>{{ $officer->nama }}</strong>?
                                                </p>
                                            </div>
                                            <div class="modal-footer border-0 pt-0 justify-content-center pb-4">
                                                <button type="button" class="btn btn-light px-4"
                                                    data-bs-dismiss="modal">Batal</button>
                                                <form action="{{ route('officers.destroy', $officer->id) }}" method="POST">
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
                                Belum ada data pengurus.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    {{-- Pagination --}}
    <div class="d-flex justify-content-center mt-4">
        {{ $officers->appends(['search' => request('search')])->links('pagination::bootstrap-5') }}
    </div>
</x-app-layout>