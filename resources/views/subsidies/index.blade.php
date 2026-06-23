<x-app-layout>
    {{-- Page Title --}}
    <x-page-title>Manajemen Program Subsidi</x-page-title>

    {{-- Import Errors Alert --}}
    @if (session('import_errors'))
        <div class="alert alert-warning alert-dismissible fade show border-0 rounded-4 shadow-sm p-4 mb-4" role="alert">
            <div class="d-flex align-items-center mb-3">
                <i class="ti ti-alert-triangle text-warning fs-2 me-2"></i>
                <h6 class="fw-bold mb-0 text-dark">Beberapa baris data dilewati saat import:</h6>
            </div>
            <div style="max-height: 200px; overflow-y: auto;">
                <ul class="mb-0 text-muted small ps-3">
                    @foreach (session('import_errors') as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    {{-- Top Navigation / Back to Checker --}}
    <div class="bg-white rounded-4 shadow-sm p-4 mb-4">
        <div class="d-flex align-items-center justify-content-between flex-wrap gap-3">
            <div>
                <h5 class="fw-bold text-dark mb-1">Daftar Program Subsidi Aktif</h5>
                <p class="text-muted mb-0 small">Tambahkan dan kelola program-program subsidi sebelum melakukan pemeriksaan penerimaan.</p>
            </div>
            <a href="{{ route('subsidychecks.index') }}" class="btn btn-primary d-flex align-items-center gap-2">
                <i class="ti ti-search fs-5"></i> Buka Checker Subsidi
            </a>
        </div>
    </div>

    {{-- Form Tambah Program Subsidi --}}
    <div class="bg-white rounded-4 shadow-sm p-4 mb-4">
        <h6 class="fw-bold mb-3 text-dark"><i class="ti ti-plus me-2 text-primary"></i>Tambah Program Subsidi Baru</h6>
        <form action="{{ route('subsidies.store') }}" method="POST">
            @csrf
            <div class="row g-3">
                <div class="col-md-4">
                    <label for="nama" class="form-label fw-medium text-dark">Nama Program Subsidi</label>
                    <input type="text" name="nama" id="nama" class="form-control @error('nama') is-invalid @enderror"
                        placeholder="Contoh: BLT Kemiskinan Ekstrem" value="{{ old('nama') }}" required autocomplete="off">
                    @error('nama')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-md-2">
                    <label for="tahun" class="form-label fw-medium text-dark">Tahun</label>
                    <input type="text" name="tahun" id="tahun" class="form-control @error('tahun') is-invalid @enderror"
                        placeholder="Contoh: 2026" value="{{ old('tahun', date('Y')) }}" maxlength="4" inputmode="numeric" required autocomplete="off">
                    @error('tahun')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-md-3">
                    <label for="periode" class="form-label fw-medium text-dark">Periode / Keterangan Waktu</label>
                    <input type="text" name="periode" id="periode" class="form-control @error('periode') is-invalid @enderror"
                        placeholder="Contoh: Tahap 1 (Jan-Mar)" value="{{ old('periode') }}" required autocomplete="off">
                    @error('periode')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-md-3">
                    <label for="keterangan" class="form-label fw-medium text-dark">Deskripsi Keterangan (opsional)</label>
                    <input type="text" name="keterangan" id="keterangan" class="form-control"
                        placeholder="Keterangan tambahan..." value="{{ old('keterangan') }}" autocomplete="off">
                </div>
            </div>
            <div class="mt-3">
                <button type="submit" class="btn btn-success">
                    <i class="ti ti-plus me-2"></i> Tambahkan Program Subsidi
                </button>
            </div>
        </form>
    </div>

    {{-- Tabel Program Subsidi --}}
    <div class="bg-white rounded-4 shadow-sm p-4 mb-5">
        <div class="row align-items-center justify-content-between g-3 mb-4">
            <div class="col-md-6">
                <h6 class="fw-bold text-dark mb-0"><i class="ti ti-list me-2"></i>Daftar Program Subsidi</h6>
            </div>
            <div class="col-md-6">
                <form action="{{ route('subsidies.index') }}" method="GET">
                    <div class="input-group">
                        <input type="text" name="search" class="form-control form-search"
                            value="{{ request('search') }}" placeholder="Cari nama, tahun, atau periode..." autocomplete="off">
                        <button class="btn btn-primary btn-search" type="submit">Cari</button>
                    </div>
                </form>
            </div>
        </div>

        <div class="table-responsive">
            <table class="table table-hover align-middle">
                <thead class="bg-light">
                    <tr>
                        <th class="text-center py-3" width="50">No</th>
                        <th class="py-3">Nama Program Subsidi</th>
                        <th class="text-center py-3">Tahun</th>
                        <th class="py-3">Periode</th>
                        <th class="py-3">Keterangan</th>
                        <th class="text-center py-3">Total Penerima (Klaim)</th>
                        <th class="text-center py-3" width="180">Aksi</th>
                    </tr>
                </thead>
                <tbody class="border-top-0">
                    @forelse ($subsidies as $index => $subsidy)
                        <tr>
                            <td class="text-center text-muted">
                                {{ ($subsidies->currentPage() - 1) * $subsidies->perPage() + $index + 1 }}
                            </td>
                            <td>
                                <span class="fw-bold text-dark fs-6">{{ $subsidy->nama }}</span>
                            </td>
                            <td class="text-center">
                                <span class="badge bg-light text-dark border px-2 py-1">{{ $subsidy->tahun }}</span>
                            </td>
                            <td>
                                <span class="text-muted fw-medium">{{ $subsidy->periode }}</span>
                            </td>
                            <td>
                                <span class="text-muted small">{{ $subsidy->keterangan ?? '-' }}</span>
                            </td>
                            <td class="text-center">
                                <span class="badge bg-primary-subtle text-primary border px-3 py-2 rounded-3">
                                    {{ $subsidy->claims->count() }} Penerima
                                </span>
                            </td>
                            <td>
                                <div class="d-flex justify-content-center gap-2">
                                    {{-- Import Trigger --}}
                                    <button type="button" class="btn btn-light btn-sm rounded-3 border shadow-sm p-2"
                                        data-bs-toggle="modal" data-bs-target="#importModal{{ $subsidy->id }}" title="Import Penerima">
                                        <i class="ti ti-file-excel text-success fs-5"></i>
                                    </button>

                                    {{-- Edit Trigger --}}
                                    <button type="button" class="btn btn-light btn-sm rounded-3 border shadow-sm p-2"
                                        data-bs-toggle="modal" data-bs-target="#editModal{{ $subsidy->id }}" title="Edit Program">
                                        <i class="ti ti-edit text-warning fs-5"></i>
                                    </button>

                                    {{-- Delete Trigger --}}
                                    <button type="button" class="btn btn-light btn-sm rounded-3 border shadow-sm p-2"
                                        data-bs-toggle="modal" data-bs-target="#deleteModal{{ $subsidy->id }}" title="Hapus Program">
                                        <i class="ti ti-trash text-danger fs-5"></i>
                                    </button>
                                </div>

                                {{-- Modal Import Penerima Subsidi --}}
                                <div class="modal fade" id="importModal{{ $subsidy->id }}" tabindex="-1" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered">
                                        <div class="modal-content rounded-4 border-0 shadow">
                                            <div class="modal-header border-0 pb-0">
                                                <h5 class="modal-title fw-bold">Import Penerima - {{ $subsidy->nama }}</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <form action="{{ route('subsidies.import', $subsidy->id) }}" method="POST" enctype="multipart/form-data">
                                                @csrf
                                                <div class="modal-body py-4">
                                                    <div class="mb-3">
                                                        <label for="import_file{{ $subsidy->id }}" class="form-label fw-medium text-dark">Pilih File Excel / CSV</label>
                                                        <input type="file" name="file" id="import_file{{ $subsidy->id }}" class="form-control"
                                                            accept=".xlsx, .xls, .csv" required>
                                                        <div class="form-text text-muted small mt-2">
                                                            Hanya mendukung format file <code>.xlsx</code>, <code>.xls</code>, atau <code>.csv</code>.
                                                        </div>
                                                    </div>

                                                    <div class="border rounded-3 p-3 bg-light">
                                                        <span class="fw-bold text-dark d-block mb-2 small"><i class="ti ti-info-circle text-primary me-1"></i>Format Struktur Kolom Excel:</span>
                                                        <div class="table-responsive">
                                                            <table class="table table-bordered table-sm text-center mb-0" style="font-size: 11px;">
                                                                <thead>
                                                                    <tr class="table-secondary">
                                                                        <th>A</th>
                                                                        <th>B</th>
                                                                        <th>C</th>
                                                                        <th>D</th>
                                                                        <th>E</th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody>
                                                                    <tr>
                                                                        <td class="text-muted">No (Abaikan)</td>
                                                                        <td class="fw-bold">NIK (16 Digit)</td>
                                                                        <td class="fw-bold">No KK (16 Digit)</td>
                                                                        <td class="fw-bold">Nama Lengkap</td>
                                                                        <td class="text-muted">Keterangan</td>
                                                                    </tr>
                                                                    <tr class="text-muted text-start" style="font-style: italic;">
                                                                        <td>1</td>
                                                                        <td>3201020304050607</td>
                                                                        <td>3201020304050608</td>
                                                                        <td>Budi Santoso</td>
                                                                        <td>Penerima Manfaat</td>
                                                                    </tr>
                                                                </tbody>
                                                            </table>
                                                        </div>
                                                        <p class="text-danger small mt-2 mb-0" style="font-size: 11px;">
                                                            <i class="ti ti-alert-circle me-1"></i>Catatan: Kolom NIK, No KK, dan Nama Lengkap wajib diisi. Baris dengan NIK/KK yang sudah terdaftar dalam program ini otomatis dilewati.
                                                        </p>
                                                    </div>
                                                </div>
                                                <div class="modal-footer border-0 pt-0">
                                                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Batal</button>
                                                    <button type="submit" class="btn btn-success">
                                                        <i class="ti ti-upload me-1"></i> Mulai Import
                                                    </button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>

                                {{-- Modal Edit Program --}}
                                <div class="modal fade" id="editModal{{ $subsidy->id }}" tabindex="-1" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered">
                                        <div class="modal-content rounded-4 border-0 shadow">
                                            <div class="modal-header border-0 pb-0">
                                                <h5 class="modal-title fw-bold">Edit Program Subsidi</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <form action="{{ route('subsidies.update', $subsidy->id) }}" method="POST">
                                                @csrf
                                                @method('PUT')
                                                <div class="modal-body py-4">
                                                    <div class="mb-3">
                                                        <label for="edit_nama{{ $subsidy->id }}" class="form-label fw-medium text-dark">Nama Program Subsidi</label>
                                                        <input type="text" name="nama" id="edit_nama{{ $subsidy->id }}" class="form-control"
                                                            value="{{ $subsidy->nama }}" required autocomplete="off">
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-6 mb-3">
                                                            <label for="edit_tahun{{ $subsidy->id }}" class="form-label fw-medium text-dark">Tahun</label>
                                                            <input type="text" name="tahun" id="edit_tahun{{ $subsidy->id }}" class="form-control"
                                                                value="{{ $subsidy->tahun }}" maxlength="4" inputmode="numeric" required autocomplete="off">
                                                        </div>
                                                        <div class="col-6 mb-3">
                                                            <label for="edit_periode{{ $subsidy->id }}" class="form-label fw-medium text-dark">Periode</label>
                                                            <input type="text" name="periode" id="edit_periode{{ $subsidy->id }}" class="form-control"
                                                                value="{{ $subsidy->periode }}" required autocomplete="off">
                                                        </div>
                                                    </div>
                                                    <div class="mb-0">
                                                        <label for="edit_keterangan{{ $subsidy->id }}" class="form-label fw-medium text-dark">Keterangan (opsional)</label>
                                                        <input type="text" name="keterangan" id="edit_keterangan{{ $subsidy->id }}" class="form-control"
                                                            value="{{ $subsidy->keterangan }}" autocomplete="off">
                                                    </div>
                                                </div>
                                                <div class="modal-footer border-0 pt-0">
                                                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Batal</button>
                                                    <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>

                                {{-- Modal Hapus Program --}}
                                <div class="modal fade" id="deleteModal{{ $subsidy->id }}" tabindex="-1" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered">
                                        <div class="modal-content rounded-4 border-0 shadow">
                                            <div class="modal-header border-0 pb-0">
                                                <h5 class="modal-title fw-bold">Konfirmasi Hapus Program</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body py-4 text-center">
                                                <i class="ti ti-alert-triangle text-danger fs-1 mb-3"></i>
                                                <p class="mb-2">Yakin ingin menghapus program subsidi
                                                    <br><strong>{{ $subsidy->nama }}</strong>?
                                                </p>
                                                <p class="text-danger small mb-0"><i class="ti ti-info-circle me-1"></i>Menghapus program ini akan <strong>menghapus seluruh data klaim penerima ({{ $subsidy->claims->count() }} orang)</strong> yang terdaftar pada program ini secara permanen!</p>
                                            </div>
                                            <div class="modal-footer border-0 pt-0 justify-content-center pb-4">
                                                <button type="button" class="btn btn-light px-4" data-bs-dismiss="modal">Batal</button>
                                                <form action="{{ route('subsidies.destroy', $subsidy->id) }}" method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger px-4">Hapus Program & Klaim</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="text-center py-5 text-muted">
                                <i class="ti ti-settings fs-1 d-block mb-2"></i>
                                Belum ada data program subsidi.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        {{-- Pagination --}}
        <div class="d-flex justify-content-center mt-4">
            {{ $subsidies->links() }}
        </div>
    </div>
</x-app-layout>
