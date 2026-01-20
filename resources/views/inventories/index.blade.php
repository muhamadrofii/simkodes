<x-app-layout>
    {{-- Page Title --}}
    <x-page-title>Buku Inventaris</x-page-title>

    <div class="bg-white rounded-4 shadow-sm p-4 mb-4">
        {{-- Header Section --}}
        <div class="row align-items-center justify-content-between mb-4 g-3">
            <div class="col-md-6">
                <h5 class="fw-bold text-dark mb-0">
                    <i class="ti ti-list-details me-2 text-primary"></i> Daftar Barang Inventaris
                </h5>
            </div>
            <div class="col-md-auto d-flex gap-2">
                <form action="{{ route('inventories.index') }}" method="GET" class="d-flex">
                    <input type="text" name="search" class="form-control rounded-start" placeholder="Cari barang..."
                        value="{{ request('search') }}" autocomplete="off">
                    <button class="btn btn-primary rounded-end ms-0" type="submit">
                        <i class="ti ti-search"></i>
                    </button>
                </form>
                <a href="{{ route('inventories.export.pdf') }}" class="btn btn-danger d-flex align-items-center"
                    target="_blank">
                    <i class="ti ti-file-type-pdf me-2"></i> PDF
                </a>
                <a href="{{ route('inventories.export.excel') }}" class="btn btn-success d-flex align-items-center">
                    <i class="ti ti-file-spreadsheet me-2"></i> Excel
                </a>
                <a href="{{ route('inventories.create') }}" class="btn btn-primary d-flex align-items-center">
                    <i class="ti ti-plus me-2"></i> Tambah Barang
                </a>
            </div>
        </div>

        {{-- Table Section --}}
        <div class="table-responsive">
            <table class="table table-hover align-middle">
                <thead class="bg-light">
                    <tr>
                        <th class="text-center py-3" width="50">No</th>
                        <th class="py-3">Nama Barang</th>
                        <th class="text-center py-3">Tanggal</th>
                        <th class="text-center py-3">Jumlah</th>
                        <th class="text-end py-3">Harga Satuan</th>
                        <th class="text-end py-3">Total Harga</th>
                        <th class="text-center py-3">Umur (T/E)</th>
                        <th class="py-3">Keterangan</th>
                        <th class="text-center py-3" width="180">Aksi</th>
                    </tr>
                </thead>
                <tbody class="border-top-0">
                    @forelse ($inventories as $key => $item)
                        <tr>
                            <td class="text-center text-muted">
                                {{ ($inventories->currentPage() - 1) * $inventories->perPage() + $key + 1 }}
                            </td>
                            <td>
                                <span class="fw-bold text-dark">{{ $item->nama_barang }}</span>
                            </td>
                            <td class="text-center small text-muted">
                                {{ \Carbon\Carbon::parse($item->tanggal)->format('d/m/Y') }}
                            </td>
                            <td class="text-center">
                                <span class="badge bg-light text-dark px-3 py-2 rounded-3 border">
                                    {{ $item->jumlah }}
                                </span>
                            </td>
                            <td class="text-end">Rp {{ number_format($item->harga_satuan, 0, ',', '.') }}</td>
                            <td class="text-end fw-semibold text-primary">
                                Rp {{ number_format($item->jumlah_rupiah, 0, ',', '.') }}
                            </td>
                            <td class="text-center small">
                                <span title="Umur Teknis">{{ $item->umur_teknis }}th</span> /
                                <span title="Umur Ekonomis" class="text-muted">{{ $item->umur_ekonomis }}th</span>
                            </td>
                            <td>
                                <div class="text-wrap small" style="max-width: 200px;">
                                    {{ Str::limit($item->keterangan, 50) }}
                                </div>
                            </td>
                            <td>
                                <div class="d-flex justify-content-center gap-2">
                                    {{-- Detail --}}
                                    <a href="{{ route('inventories.show', $item->id) }}"
                                        class="btn btn-light btn-sm rounded-3 border shadow-sm p-2" title="Detail">
                                        <i class="ti ti-eye text-info fs-5"></i>
                                    </a>

                                    {{-- Edit --}}
                                    <a href="{{ route('inventories.edit', $item->id) }}"
                                        class="btn btn-light btn-sm rounded-3 border shadow-sm p-2" title="Edit">
                                        <i class="ti ti-edit text-warning fs-5"></i>
                                    </a>

                                    {{-- Delete (modal trigger) --}}
                                    <button type="button" class="btn btn-light btn-sm rounded-3 border shadow-sm p-2"
                                        data-bs-toggle="modal" data-bs-target="#deleteModal{{ $item->id }}" title="Hapus">
                                        <i class="ti ti-trash text-danger fs-5"></i>
                                    </button>
                                </div>

                                {{-- Modal Delete --}}
                                <div class="modal fade" id="deleteModal{{ $item->id }}" tabindex="-1" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered">
                                        <div class="modal-content rounded-4 border-0 shadow">
                                            <div class="modal-header border-0 pb-0">
                                                <h5 class="modal-title fw-bold">Konfirmasi Hapus</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body py-4 text-center">
                                                <i class="ti ti-alert-triangle text-danger fs-1 mb-3"></i>
                                                <p class="mb-0">Yakin ingin menghapus barang
                                                    <br><strong>{{ $item->nama_barang }}</strong>?
                                                </p>
                                            </div>
                                            <div class="modal-footer border-0 pt-0 justify-content-center pb-4">
                                                <button type="button" class="btn btn-light px-4"
                                                    data-bs-dismiss="modal">Batal</button>
                                                <form action="{{ route('inventories.destroy', $item->id) }}" method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger px-4">Hapus
                                                        Sekarang</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="9" class="text-center py-5 text-muted">
                                <i class="ti ti-package-off fs-1 d-block mb-2"></i>
                                Belum ada data inventaris.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    {{-- Pagination --}}
    <div class="d-flex justify-content-center mt-4">
        {{ $inventories->links('pagination::bootstrap-5') }}
    </div>
</x-app-layout>