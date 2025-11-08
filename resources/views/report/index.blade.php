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
                    <input type="text" name="start_date" class="form-control datepicker @error('start_date') is-invalid @enderror" value="{{ old('start_date', request('start_date')) }}" autocomplete="off">
                        
                    {{-- pesan error untuk start date --}}
                    @error('start_date')
                        <div class="alert alert-danger mt-2">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="col-lg-4 col-xl-3">
                    <label class="form-label">Tanggal Akhir <span class="text-danger">*</span></label>
                    <input type="text" name="end_date" class="form-control datepicker @error('end_date') is-invalid @enderror" value="{{ old('end_date', request('end_date')) }}" autocomplete="off">
                        
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
                        Data Aggota Per {{ date('F j, Y', strtotime(request('start_date'))) }} - {{ date('F j, Y', strtotime(request('end_date'))) }}.
                    </h6>
                </div>
                <div class="d-grid gap-3 d-sm-flex mt-3 mt-lg-0">
                    {{-- button cetak laporan (export PDF) --}}
                    <a href="{{ route('report.print', [request('start_date'), request('end_date')]) }}" target="_blank" class="btn btn-warning btn-action-icon">
                        <i class="ti ti-printer me-2"></i> Cetak
                    </a>
                </div>
            </div>

            <hr class="text-body-tertiary mb-4">

            {{-- tabel tampil data --}}
            <div class="table-responsive">
                <table class="table table-bordered table-striped table-hover lh-lg" style="width:100%">
                    <thead>
                        <th class="text-center fw-medium">No.</th>
                        <th class="text-center fw-medium">Kategori</th>
                        <th class="text-center fw-medium">Tanggal Bergabung</th>
                        <th class="text-center fw-medium">Nama Lengkap</th>
                        <th class="text-center fw-medium">Jenis Kelamin</th>
                        <th class="text-center fw-medium">Alamat</th>
                        <th class="text-center fw-medium">Email</th>
                        <th class="text-center fw-medium">Nomor Telepon</th>
                    </thead>
                    <tbody class="fs-7">
                    @php
                        $no = 1;
                    @endphp
                    @forelse ($members as $member)
                        {{-- jika data ada, tampilkan data --}}
                        <tr>
                            <td width="30" class="text-center">{{ $no++ }}</td>
                            <td width="100" class="text-center">{{ $member->category->name }}</td>
                            <td width="150" class="text-center">{{ date('F j, Y', strtotime($member->join_date)) }}</td>
                            <td width="200">{{ $member->full_name }}</td>
                            <td width="60" class="text-center">{{ $member->gender }}</td>
                            <td width="250">{{ $member->address }}</td>
                            <td width="60">{{ $member->email }}</td>
                            <td width="60" class="text-center">{{ $member->phone_number }}</td>
                        </tr>
                    @empty
                        {{-- jika data tidak ada, tampilkan pesan data tidak tersedia --}}
                        <tr>
                            <td colspan="8">
                                <div class="d-flex justify-content-center align-items-center">
                                    <i class="ti ti-info-circle fs-5 me-2"></i>
                                    <div>Tidak ada data.</div>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    @endif
</x-app-layout>