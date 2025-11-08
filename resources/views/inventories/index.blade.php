<x-app-layout>
    {{-- Page Title --}}
    <x-page-title>📘 Buku Inventaris</x-page-title>

    <div class="bg-white rounded-4 shadow-sm p-4 mb-4">
        {{-- Header --}}
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h5 class="fw-semibold text-secondary mb-0">Daftar Barang Inventaris</h5>
            <a href="{{ route('inventories.create') }}" class="btn btn-primary">
                <i class="bi bi-plus-circle me-1"></i> Tambah Barang
            </a>
        </div>

        {{-- Table --}}
        <div class="table-responsive">
            <table class="table table-hover align-middle text-center">
                <thead class="table-light border-bottom border-2">
                    <tr class="text-secondary">
                        <th>No</th>
                        <th>Nama Barang</th>
                        <th>Tanggal</th>
                        <th>Jumlah</th>
                        <th>Harga Satuan (Rp)</th>
                        <th>Total Harga (Rp)</th>
                        <th>Umur Teknis</th>
                        <th>Umur Ekonomis</th>
                        <th>Keterangan</th>
                        <th width="150">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($inventories as $key => $item)
                        <tr>
                            <td>{{ $key + 1 }}</td>
                            <td class="fw-semibold">{{ $item->nama_barang }}</td>
                            <td>{{ $item->tanggal }}</td>
                            <td>{{ $item->jumlah }}</td>
                            <td>{{ number_format($item->harga_satuan, 0, ',', '.') }}</td>
                            <td>{{ number_format($item->total_harga, 0, ',', '.') }}</td>
                            <td>{{ $item->umur_teknis }}</td>
                            <td>{{ $item->umur_ekonomis }}</td>
                            <td class="text-wrap">{{ $item->keterangan }}</td>
                            <td>
                                <div class="d-flex justify-content-center gap-2">
                                    {{-- Detail --}}
                                    <a href="{{ route('inventories.show', $item->id) }}" 
                                    class="btn btn-info btn-sm text-white d-flex align-items-center gap-1" title="Detail">
                                        <i class="bi bi-eye"></i>
                                        <span>Detail</span>
                                    </a>

                                    {{-- Edit --}}
                                    <a href="{{ route('inventories.edit', $item->id) }}" 
                                    class="btn btn-warning btn-sm d-flex align-items-center gap-1" title="Edit">
                                        <i class="bi bi-pencil-square"></i>
                                        <span>Edit</span>
                                    </a>

                                    {{-- Delete (modal trigger) --}}
                                    <button type="button" class="btn btn-danger btn-sm d-flex align-items-center gap-1" 
                                            data-bs-toggle="modal" 
                                            data-bs-target="#deleteModal{{ $item->id }}">
                                        <i class="bi bi-trash"></i>
                                        <span>Hapus</span>
                                    </button>
                                </div>


                                {{-- Modal Delete --}}
                                <div class="modal fade" id="deleteModal{{ $item->id }}" tabindex="-1" aria-labelledby="deleteModalLabel{{ $item->id }}" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered">
                                        <div class="modal-content">
                                            <div class="modal-header border-0">
                                                <h5 class="modal-title fw-semibold text-danger" id="deleteModalLabel{{ $item->id }}">
                                                    Hapus Data
                                                </h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <p>Yakin mau hapus <strong>{{ $item->nama_barang }}</strong> dari daftar inventaris?</p>
                                            </div>
                                            <div class="modal-footer border-0">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                                <form action="{{ route('inventories.destroy', $item->id) }}" method="POST" class="d-inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger">Hapus</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="10" class="text-muted py-4">Belum ada data inventaris.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</x-app-layout>
