<x-app-layout>
    {{-- Page Title --}}
    <x-page-title>Surat Masuk</x-page-title>

    {{-- Section: Add & Search --}}
    <div class="bg-white rounded-4 shadow-sm p-4 mb-4">
        <div class="row align-items-center justify-content-between g-3">
            {{-- Add Button --}}
            <div class="col-md-6 col-lg-5">
                <a href="{{ route('incomingletters.create') }}" class="btn btn-primary d-flex align-items-center justify-content-center justify-content-md-start w-100 w-md-auto">
                    <i class="ti ti-plus me-2"></i> Tambah Surat Masuk
                </a>
            </div>
            {{-- Search Form --}}
            <div class="col-md-6 col-lg-7">
                <form action="{{ route('incomingletters.index') }}" method="GET" class="d-flex">
                    <input type="text" name="search" class="form-control rounded-start"
                        value="{{ request('search') }}" placeholder="Cari surat masuk..." autocomplete="off">
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
                        <th class="py-3">No. Surat</th>
                        <th class="py-3">Judul Surat</th>
                        <th class="py-3">Kategori</th>
                        <th class="py-3 text-center">Berkas</th>
                        <th class="text-center py-3" width="220">Aksi</th>
                    </tr>
                </thead>
                <tbody class="border-top-0">
                    @forelse ($incomingletters as $key => $letter)
                        <tr>
                            <td class="text-center text-muted">
                                {{ ($incomingletters->currentPage() - 1) * $incomingletters->perPage() + $key + 1 }}
                            </td>
                            <td>
                                <span class="text-dark fw-medium small">{{ $letter->reference_number ?? '-' }}</span>
                            </td>
                            <td>
                                <span class="fw-bold text-dark">{{ $letter->title }}</span>
                            </td>
                            <td>
                                <span class="badge bg-success-subtle text-success border border-success-subtle px-3 py-2 rounded-3">
                                    {{ $letter->category ?? 'Umum' }}
                                </span>
                            </td>
                            <td class="text-center">
                                @if($letter->file)
                                    <a href="{{ asset('incoming_letters/' . $letter->file) }}" target="_blank" class="btn btn-light btn-sm rounded-3 border p-2" title="Unduh Berkas Asli">
                                        <i class="ti ti-download text-primary fs-5"></i>
                                    </a>
                                @else
                                    <span class="text-muted small">-</span>
                                @endif
                            </td>
                            <td>
                                <div class="d-flex justify-content-center gap-2">
                                    {{-- Quick Preview --}}
                                    <button type="button" class="btn btn-light btn-sm rounded-3 border shadow-sm p-2"
                                        data-bs-toggle="modal" data-bs-target="#previewModal{{ $letter->id }}" title="Pratinjau Cepat">
                                        <i class="ti ti-zoom-in text-info fs-5"></i>
                                    </button>

                                    {{-- Full Details --}}
                                    <a href="{{ route('incomingletters.show', $letter->id) }}"
                                        class="btn btn-light btn-sm rounded-3 border shadow-sm p-2" title="Detail Lengkap">
                                        <i class="ti ti-file-text text-primary fs-5"></i>
                                    </a>

                                    {{-- Edit --}}
                                    <a href="{{ route('incomingletters.edit', $letter->id) }}"
                                        class="btn btn-light btn-sm rounded-3 border shadow-sm p-2" title="Edit">
                                        <i class="ti ti-edit text-warning fs-5"></i>
                                    </a>

                                    {{-- Delete (modal trigger) --}}
                                    <button type="button" class="btn btn-light btn-sm rounded-3 border shadow-sm p-2"
                                        data-bs-toggle="modal" data-bs-target="#deleteModal{{ $letter->id }}" title="Hapus">
                                        <i class="ti ti-trash text-danger fs-5"></i>
                                    </button>
                                </div>

                                {{-- Quick Preview Modal --}}
                                <div class="modal fade" id="previewModal{{ $letter->id }}" tabindex="-1" aria-hidden="true">
                                    <div class="modal-dialog modal-lg modal-dialog-centered">
                                        <div class="modal-content rounded-4 border-0 shadow">
                                            <div class="modal-header border-0 pb-0">
                                                <h5 class="modal-title fw-bold">Pratinjau Surat Masuk</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body p-4">
                                                <div class="row g-3 mb-4">
                                                    <div class="col-md-6">
                                                        <label class="small text-muted mb-1">Judul Surat</label>
                                                        <p class="fw-semibold mb-0">{{ $letter->title }}</p>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <label class="small text-muted mb-1">No. Surat</label>
                                                        <p class="fw-semibold mb-0">{{ $letter->reference_number ?? '-' }}</p>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <label class="small text-muted mb-1">Kategori</label>
                                                        <p class="fw-semibold mb-0">
                                                            <span class="badge bg-light text-primary">{{ $letter->category ?? 'Umum' }}</span>
                                                        </p>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <label class="small text-muted mb-1">File</label>
                                                        <p class="mb-0">
                                                            @if($letter->file)
                                                                <a href="{{ asset('incoming_letters/' . $letter->file) }}" target="_blank" class="text-decoration-none small">
                                                                    <i class="ti ti-download me-1"></i> Download Berkas
                                                                </a>
                                                            @else
                                                                <span class="text-muted small">Tidak ada lampiran</span>
                                                            @endif
                                                        </p>
                                                    </div>
                                                </div>

                                                @if($letter->file)
                                                    <div class="rounded-3 border overflow-hidden bg-light" style="height: 400px;">
                                                        @php
                                                            $extension = pathinfo($letter->file, PATHINFO_EXTENSION);
                                                            $filePath = asset('incoming_letters/' . $letter->file);
                                                        @endphp

                                                        @if (in_array(strtolower($extension), ['jpg', 'jpeg', 'png', 'gif', 'webp']))
                                                            <div class="h-100 d-flex align-items-center justify-content-center p-3">
                                                                <img src="{{ $filePath }}" class="img-fluid rounded shadow-sm" style="max-height: 100%;">
                                                            </div>
                                                        @elseif (strtolower($extension) === 'pdf')
                                                            <iframe src="{{ $filePath }}#toolbar=0" width="100%" height="100%" style="border: none;"></iframe>
                                                        @else
                                                            <div class="h-100 d-flex flex-column align-items-center justify-content-center text-muted">
                                                                <i class="ti ti-file-description fs-1 mb-2"></i>
                                                                <p>Berkas {{ strtoupper($extension) }} tidak dapat dipratinjau langsung.</p>
                                                            </div>
                                                        @endif
                                                    </div>
                                                @endif
                                            </div>
                                            <div class="modal-footer border-0 pt-0">
                                                <button type="button" class="btn btn-light" data-bs-dismiss="modal">Tutup</button>
                                                <a href="{{ route('incomingletters.show', $letter->id) }}" class="btn btn-primary">Informasi Lengkap</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                {{-- Modal Delete --}}
                                <div class="modal fade" id="deleteModal{{ $letter->id }}" tabindex="-1" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered">
                                        <div class="modal-content rounded-4 border-0 shadow">
                                            <div class="modal-header border-0 pb-0">
                                                <h5 class="modal-title fw-bold">Konfirmasi Hapus</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body py-4 text-center">
                                                <i class="ti ti-alert-triangle text-danger fs-1 mb-3"></i>
                                                <p class="mb-0">Yakin ingin menghapus surat masuk
                                                    <br><strong>{{ $letter->title }}</strong>?
                                                </p>
                                            </div>
                                            <div class="modal-footer border-0 pt-0 justify-content-center pb-4">
                                                <button type="button" class="btn btn-light px-4"
                                                    data-bs-dismiss="modal">Batal</button>
                                                <form action="{{ route('incomingletters.destroy', $letter->id) }}" method="POST">
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
                            <td colspan="6" class="text-center py-5 text-muted">
                                <i class="ti ti-mail-opened fs-1 d-block mb-2"></i>
                                Belum ada data surat masuk.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    {{-- Pagination --}}
    <div class="d-flex justify-content-center mt-4">
        {{ $incomingletters->appends(['search' => request('search')])->links('pagination::bootstrap-5') }}
    </div>
</x-app-layout>
