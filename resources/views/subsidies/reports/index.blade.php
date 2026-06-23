<x-app-layout>
    {{-- Page Title --}}
    <x-page-title>Laporan Penerima Subsidi</x-page-title>

    {{-- Top Stats / Overview --}}
    <div class="bg-white rounded-4 shadow-sm p-4 mb-4">
        <div class="d-flex align-items-center justify-content-between flex-wrap gap-3">
            <div>
                <h5 class="fw-bold text-dark mb-1">Laporan Realisasi Program Subsidi</h5>
                <p class="text-muted mb-0 small">Saring data klaim penerima subsidi dan ekspor ke dalam format PDF cetak atau spreadsheet Excel.</p>
            </div>
        </div>
    </div>

    {{-- Filter Form --}}
    <div class="bg-white rounded-4 shadow-sm p-4 mb-4">
        <form action="{{ route('subsidies.reports.index') }}" method="GET" class="row g-3 align-items-end">
            <div class="col-md-4">
                <label for="subsidy_id" class="form-label fw-medium text-dark">Program Subsidi</label>
                <select name="subsidy_id" id="subsidy_id" class="form-select">
                    <option value="">-- Semua Program --</option>
                    @foreach ($programs as $prog)
                        <option value="{{ $prog->id }}" {{ request('subsidy_id') == $prog->id ? 'selected' : '' }}>
                            {{ $prog->nama }} ({{ $prog->tahun }})
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-2">
                <label for="tahun" class="form-label fw-medium text-dark">Tahun</label>
                <input type="text" name="tahun" id="tahun" class="form-control" placeholder="Contoh: 2026"
                    value="{{ request('tahun') }}" maxlength="4" inputmode="numeric">
            </div>
            <div class="col-md-3">
                <label for="search" class="form-label fw-medium text-dark">Cari NIK / KK / Nama</label>
                <input type="text" name="search" id="search" class="form-control" placeholder="Masukkan NIK, KK, atau nama..."
                    value="{{ request('search') }}" autocomplete="off">
            </div>
            <div class="col-md-3 d-flex gap-2">
                <button type="submit" class="btn btn-primary flex-grow-1">
                    <i class="ti ti-filter me-1"></i> Filter
                </button>
                @if (request()->filled('subsidy_id') || request()->filled('tahun') || request()->filled('search'))
                    <a href="{{ route('subsidies.reports.index') }}" class="btn btn-light border">
                        Reset
                    </a>
                @endif
            </div>
        </form>
    </div>

    {{-- Data Table & Export Buttons --}}
    <div class="bg-white rounded-4 shadow-sm p-4 mb-5">
        <div class="d-flex align-items-center justify-content-between flex-wrap gap-3 mb-4">
            <h6 class="fw-bold text-dark mb-0"><i class="ti ti-list me-2 text-indigo"></i>Daftar Penerima Terfilter</h6>
            
            <div class="d-flex gap-2">
                <a href="{{ route('subsidies.reports.pdf', request()->query()) }}" target="_blank" class="btn btn-danger d-flex align-items-center gap-2">
                    <i class="ti ti-file-type-pdf fs-5"></i> Ekspor PDF
                </a>
                <a href="{{ route('subsidies.reports.excel', request()->query()) }}" class="btn btn-success d-flex align-items-center gap-2">
                    <i class="ti ti-file-spreadsheet fs-5"></i> Ekspor Excel
                </a>
            </div>
        </div>

        <div class="table-responsive">
            <table class="table table-hover align-middle">
                <thead class="bg-light">
                    <tr>
                        <th class="text-center py-3" width="50">No</th>
                        <th class="py-3">NIK Penerima</th>
                        <th class="py-3">No. KK</th>
                        <th class="py-3">Nama Lengkap</th>
                        <th class="py-3">Program Subsidi</th>
                        <th class="text-center py-3">Tahun/Periode</th>
                        <th class="py-3">Keterangan</th>
                        <th class="text-center py-3">Tanggal Klaim</th>
                        <th class="text-center py-3">Status</th>
                        <th class="text-center py-3" width="80">Aksi</th>
                    </tr>
                </thead>
                <tbody class="border-top-0">
                    @forelse ($claims as $index => $claim)
                        <tr>
                            <td class="text-center text-muted">
                                {{ ($claims->currentPage() - 1) * $claims->perPage() + $index + 1 }}
                            </td>
                            <td>
                                <span class="font-monospace fw-bold text-dark">{{ $claim->nik }}</span>
                            </td>
                            <td>
                                <span class="font-monospace text-muted">{{ $claim->no_kk }}</span>
                            </td>
                            <td>
                                <span class="fw-bold text-dark">{{ $claim->nama }}</span>
                            </td>
                            <td>
                                <span class="text-indigo fw-medium">{{ $claim->program->nama ?? '-' }}</span>
                            </td>
                            <td class="text-center">
                                <span class="badge bg-light text-dark border px-2 py-1">{{ $claim->program->tahun ?? '-' }}</span>
                                <small class="text-muted d-block mt-1">{{ $claim->program->periode ?? '-' }}</small>
                            </td>
                            <td>
                                <span class="text-muted small">{{ $claim->keterangan ?? '-' }}</span>
                            </td>
                            <td class="text-center">
                                <span class="text-muted small">{{ $claim->created_at ? $claim->created_at->format('d/m/Y H:i') : '-' }}</span>
                            </td>
                            <td class="text-center">
                                <span class="badge bg-success-subtle text-success border px-2 py-1 rounded-3 small d-inline-flex align-items-center gap-1">
                                    <i class="ti ti-circle-check fs-6"></i> Sudah Diklaim
                                </span>
                            </td>
                            <td class="text-center">
                                {{-- Trigger Delete --}}
                                <button type="button" class="btn btn-light btn-sm rounded-3 border shadow-sm p-2"
                                    data-bs-toggle="modal" data-bs-target="#deleteClaimModal{{ $claim->id }}" title="Hapus Klaim">
                                    <i class="ti ti-trash text-danger fs-5"></i>
                                </button>

                                {{-- Modal Hapus Klaim --}}
                                <div class="modal fade" id="deleteClaimModal{{ $claim->id }}" tabindex="-1" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered text-start">
                                        <div class="modal-content rounded-4 border-0 shadow">
                                            <div class="modal-header border-0 pb-0">
                                                <h5 class="modal-title fw-bold">Batalkan Klaim</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body py-4 text-center">
                                                <i class="ti ti-alert-triangle text-danger fs-1 mb-3"></i>
                                                <p class="mb-0">Apakah Anda yakin ingin membatalkan/menghapus klaim subsidi untuk
                                                    <br><strong>{{ $claim->nama }}</strong>?
                                                </p>
                                            </div>
                                            <div class="modal-footer border-0 pt-0 justify-content-center pb-4">
                                                <button type="button" class="btn btn-light px-4" data-bs-dismiss="modal">Batal</button>
                                                <form action="{{ route('subsidychecks.destroy', $claim->id) }}" method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger px-4">Batalkan Klaim</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="10" class="text-center py-5 text-muted">
                                <i class="ti ti-file-off fs-1 d-block mb-2"></i>
                                Tidak ditemukan data penerima subsidi yang cocok.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        {{-- Pagination --}}
        <div class="d-flex justify-content-center mt-4">
            {{ $claims->links() }}
        </div>
    </div>
</x-app-layout>
