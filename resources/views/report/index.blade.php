<x-app-layout>
    {{-- Page Title --}}
    <x-page-title>Filter</x-page-title>

    <div class="bg-white rounded-4 shadow-sm p-4 mb-4">
        {{-- info form --}}
        <div class="alert alert-secondary rounded-4 mb-5" role="alert">
            <i class="ti ti-calendar-search fs-5 me-2"></i> Filter Berdasarkan Tanggal Bergabung.
        </div>
        {{-- form filter data --}}
        <form action="{{ route('report.filter') }}" method="GET" class="needs-validation" novalidate>
            <div class="row">
                <div class="col-lg-4 col-xl-3 mb-4 mb-lg-0">
                    <label class="form-label">Tanggal Mulai <span class="text-danger">*</span></label>
                    <input type="text" name="start_date"
                        class="form-control datepicker @error('start_date') is-invalid @enderror"
                        value="{{ old('start_date', request('start_date')) }}" autocomplete="off">

                    {{-- pesan error untuk start date --}}
                    @error('start_date')
                        <div class="alert alert-danger mt-2">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="col-lg-4 col-xl-3">
                    <label class="form-label">Tanggal Akhir <span class="text-danger">*</span></label>
                    <input type="text" name="end_date"
                        class="form-control datepicker @error('end_date') is-invalid @enderror"
                        value="{{ old('end_date', request('end_date')) }}" autocomplete="off">

                    {{-- pesan error untuk end date --}}
                    @error('end_date')
                        <div class="alert alert-danger mt-2">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
            </div>

            <div class="pt-4 pb-2 mt-5 border-top">
                <div class="d-grid gap-3 d-sm-flex justify-content-md-start pt-1">
                    {{-- button tampil data laporan --}}
                    <button type="submit" class="btn btn-primary btn-action">
                        Tampilkan <i class="ti ti-chevron-right ms-2"></i>
                    </button>
                </div>
            </div>
        </form>
    </div>

    @if (request(['start_date', 'end_date']))
        <div class="bg-white rounded-4 shadow-sm p-4 mb-4">
            <div class="d-flex flex-column flex-lg-row mb-4">
                <div class="flex-grow-1 d-flex align-items-center">
                    {{-- judul laporan --}}
                    <h6 class="mb-0">
                        <i class="ti ti-file-text fs-5 align-text-top me-1"></i>
                        Data Aggota Per {{ date('F j, Y', strtotime(request('start_date'))) }} -
                        {{ date('F j, Y', strtotime(request('end_date'))) }}.
                    </h6>
                </div>
                <div class="d-grid gap-3 d-sm-flex mt-3 mt-lg-0">
                    {{-- button cetak laporan (export PDF) --}}
                    <a href="{{ route('report.print', [request('start_date'), request('end_date')]) }}" target="_blank"
                        class="btn btn-warning btn-action-icon">
                        <i class="ti ti-printer me-2"></i> Cetak
                    </a>
                </div>
            </div>

            <hr class="text-body-tertiary mb-4">

            {{-- tabel tampil data --}}
            <div class="table-responsive">
                <table class="table table-hover align-middle">
                    <thead class="bg-light">
                        <tr>
                            <th class="text-center py-3" width="50">No</th>
                            <th class="text-center py-3">Kategori</th>
                            <th class="text-center py-3">Tgl Bergabung</th>
                            <th class="py-3">Nama Lengkap</th>
                            <th class="text-center py-3">Gender</th>
                            <th class="py-3">Alamat</th>
                            <th class="py-3">Pekerjaan</th>
                            <th class="text-center py-3">Umur</th>
                        </tr>
                    </thead>
                    <tbody class="border-top-0">
                        @forelse ($members as $key => $member)
                            <tr>
                                <td class="text-center text-muted">
                                    {{ ($members->currentPage() - 1) * $members->perPage() + $key + 1 }}
                                </td>
                                <td class="text-center">
                                    <span
                                        class="badge bg-light text-primary border px-2 py-1">{{ $member->category->name ?? '-' }}</span>
                                </td>
                                <td class="text-center small">
                                    {{ $member->tanggal_masuk ? \Carbon\Carbon::parse($member->tanggal_masuk)->format('d/m/Y') : '-' }}
                                </td>
                                <td>
                                    <span class="fw-bold text-dark">{{ $member->nama }}</span>
                                </td>
                                <td class="text-center">
                                    <span
                                        class="badge {{ $member->jenis_kelamin == 'L' ? 'bg-info' : 'bg-danger' }} bg-opacity-10 text-{{ $member->jenis_kelamin == 'L' ? 'info' : 'danger' }} px-2 py-1">
                                        {{ $member->jenis_kelamin }}
                                    </span>
                                </td>
                                <td>
                                    <div class="text-wrap small" style="max-width: 200px;">{{ $member->tempat_tinggal ?? '-' }}</div>
                                </td>
                                <td class="small">{{ $member->mata_pencaharian ?: 'Tidak Ada' }}</td>
                                <td class="text-center small">{{ $member->umur ?: '-' }} th</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="8" class="text-center py-5 text-muted">
                                    <i class="ti ti-search-off fs-1 d-block mb-2"></i>
                                    Tidak ada data yang ditemukan untuk periode ini.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            {{-- Pagination --}}
            <div class="d-flex justify-content-center mt-4">
                {{ $members->links('pagination::bootstrap-5') }}
            </div>
        </div>
    @endif
</x-app-layout>