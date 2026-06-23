<x-app-layout>
    {{-- Page Title --}}
    <x-page-title>Kategori Anggota</x-page-title>

    {{-- Section: Add & Search --}}
    <div class="bg-white rounded-4 shadow-sm p-4 mb-4">
        <div class="row align-items-center justify-content-between g-3">
            {{-- Add Button --}}
            <div class="col-md-6 col-lg-5">
                <a href="{{ route('categories.create') }}" class="btn btn-primary d-flex align-items-center justify-content-center justify-content-md-start w-100 w-md-auto">
                    <i class="ti ti-plus me-2"></i> Tambah Kategori
                </a>
            </div>
            {{-- Search Form --}}
            <div class="col-md-6 col-lg-7">
                <form action="{{ route('categories.index') }}" method="GET" class="d-flex">
                    <input type="text" name="search" class="form-control rounded-start"
                        value="{{ request('search') }}" placeholder="Cari kategori..." autocomplete="off">
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
                        <th class="py-3" width="100">Gambar</th>
                        <th class="py-3">Nama Kategori</th>
                        <th class="text-center py-3" width="220">Aksi</th>
                    </tr>
                </thead>
                <tbody class="border-top-0">
                    @forelse ($categories as $key => $category)
                        <tr>
                            <td class="text-center text-muted">
                                {{ ($categories->currentPage() - 1) * $categories->perPage() + $key + 1 }}
                            </td>
                            <td>
                                @if ($category->image)
                                    <img src="{{ asset('category_images/' . $category->image) }}" class="rounded-3 border shadow-sm" width="60" height="40" style="object-fit: cover;" alt="Kategori">
                                @else
                                    <div class="rounded-3 border bg-light d-flex align-items-center justify-content-center" style="width: 60px; height: 40px;">
                                        <i class="ti ti-category text-muted fs-5"></i>
                                    </div>
                                @endif
                            </td>
                            <td>
                                <span class="fw-bold text-dark fs-6">{{ $category->name }}</span>
                            </td>
                            <td>
                                <div class="d-flex justify-content-center gap-2">
                                    {{-- Detail --}}
                                    <a href="{{ route('categories.show', $category->id) }}"
                                        class="btn btn-light btn-sm rounded-3 border shadow-sm p-2" title="Detail">
                                        <i class="ti ti-eye text-info fs-5"></i>
                                    </a>

                                    {{-- Edit --}}
                                    <a href="{{ route('categories.edit', $category->id) }}"
                                        class="btn btn-light btn-sm rounded-3 border shadow-sm p-2" title="Edit">
                                        <i class="ti ti-edit text-warning fs-5"></i>
                                    </a>

                                    {{-- Delete (modal trigger) --}}
                                    <button type="button" class="btn btn-light btn-sm rounded-3 border shadow-sm p-2"
                                        data-bs-toggle="modal" data-bs-target="#deleteModal{{ $category->id }}" title="Hapus">
                                        <i class="ti ti-trash text-danger fs-5"></i>
                                    </button>
                                </div>

                                {{-- Modal Delete --}}
                                <div class="modal fade" id="deleteModal{{ $category->id }}" tabindex="-1" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered">
                                        <div class="modal-content rounded-4 border-0 shadow">
                                            <div class="modal-header border-0 pb-0">
                                                <h5 class="modal-title fw-bold">Konfirmasi Hapus</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body py-4 text-center">
                                                <i class="ti ti-alert-triangle text-danger fs-1 mb-3"></i>
                                                <p class="mb-0">Yakin ingin menghapus kategori
                                                    <br><strong>{{ $category->name }}</strong>?
                                                </p>
                                            </div>
                                            <div class="modal-footer border-0 pt-0 justify-content-center pb-4">
                                                <button type="button" class="btn btn-light px-4"
                                                    data-bs-dismiss="modal">Batal</button>
                                                <form action="{{ route('categories.destroy', $category->id) }}" method="POST">
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
                            <td colspan="4" class="text-center py-5 text-muted">
                                <i class="ti ti-category-2 fs-1 d-block mb-2"></i>
                                Belum ada data kategori.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    {{-- Pagination --}}
    <div class="d-flex justify-content-center mt-4">
        {{ $categories->appends(['search' => request('search')])->links('pagination::bootstrap-5') }}
    </div>
</x-app-layout>