<x-app-layout>
    {{-- Page Title --}}
    <x-page-title>Detail Pengurus</x-page-title>

    <div class="bg-white rounded-4 shadow-sm p-4 mb-5">
        <div class="d-grid gap-3 d-sm-flex flex-sm-row-reverse">
            <div class="d-grid gap-3 d-sm-flex">
                <a href="{{ route('officers.edit', $officer->id) }}" class="btn btn-primary btn-action-icon">
                    <i class="ti ti-edit me-2"></i> Edit
                </a>
                <button type="button" class="btn btn-danger btn-action-icon" data-bs-toggle="modal" data-bs-target="#modalDelete{{ $officer->id }}">
                    <i class="ti ti-trash me-2"></i> Hapus
                </button>
            </div>
            <a href="{{ route('officers.index') }}" class="btn btn-secondary btn-action-icon me-sm-auto">
                <i class="ti ti-chevron-left me-2"></i> Kembali
            </a>
        </div>
    </div>

    <div class="bg-white rounded-4 shadow-sm p-4 mb-4">
        <div class="d-flex flex-column flex-xl-row align-items-start">
            {{-- Foto Profil --}}
            <div class="col-md-4 text-center mb-4 mb-xl-0">
                @if ($officer->image)
                    <img src="{{ asset('storage/public/officers/' . $officer->image) }}"
                         class="img-thumbnail rounded-5 shadow-sm"
                         width="150"
                         alt="{{ $officer->nama }}">
                @else
                    <img src="{{ asset('images/default-profile.png') }}"
                         class="img-thumbnail rounded-5 shadow-sm"
                         width="150"
                         alt="Default">
                @endif

                {{-- Tanda Tangan --}}
                @if ($officer->ttd)
                    <div class="mt-3">
                        <img src="{{ asset('storage/officers/' . $officer->ttd) }}"
                             class="img-thumbnail rounded-4 shadow-sm"
                             width="120"
                             alt="TTD">
                        <p class="text-muted small mt-1 mb-0">Tanda Tangan</p>
                    </div>
                @endif
            </div>

            {{-- Detail Info --}}
            <div class="flex-grow-1 ms-xl-5 w-100">
                <div class="table-responsive">
                    <table class="table table-striped lh-lg">
                        <tr><td width="220">Kategori</td><td width="10">:</td><td>{{ $officer->category->name ?? '-' }}</td></tr>
                        <tr><td>Nama Lengkap</td><td>:</td><td>{{ $officer->nama }}</td></tr>
                        <tr><td>Jenis Kelamin</td><td>:</td><td>{{ $officer->jenis_kelamin == 'L' ? 'Laki-laki' : 'Perempuan' }}</td></tr>
                        <tr><td>Umur</td><td>:</td><td>{{ $officer->umur ?? '-' }}</td></tr>
                        <tr><td>Jabatan</td><td>:</td><td>{{ $officer->jabatan ?? '-' }}</td></tr>
                        <tr><td>No. Anggota Koperasi</td><td>:</td><td>{{ $officer->no_anggota_koperasi ?? '-' }}</td></tr>
                        <tr><td>Tempat Tinggal</td><td>:</td><td>{{ $officer->tempat_tinggal ?? '-' }}</td></tr>
                        <tr><td>Tanggal Diangkat</td><td>:</td><td>{{ $officer->tanggal_diangkat ? date('d-m-Y', strtotime($officer->tanggal_diangkat)) : '-' }}</td></tr>
                        <tr><td>Tanggal Berhenti</td><td>:</td><td>{{ $officer->tanggal_berhenti ? date('d-m-Y', strtotime($officer->tanggal_berhenti)) : '-' }}</td></tr>
                        <tr><td>Keterangan</td><td>:</td><td>{{ $officer->keterangan ?? '-' }}</td></tr>
                    </table>
                </div>
            </div>
        </div>
    </div>

    {{-- Modal Konfirmasi Hapus --}}
    <div class="modal fade" id="modalDelete{{ $officer->id }}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5"><i class="ti ti-trash me-2"></i> Hapus Data</h1>
                </div>
                <div class="modal-body">
                    <p>Apakah Anda yakin ingin menghapus data <strong>{{ $officer->nama }}</strong>?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary btn-action-icon" data-bs-dismiss="modal">Batal</button>
                    <form action="{{ route('officers.destroy', $officer->id) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-action-icon">Ya, hapus!</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    {{-- Tombol Cetak KTA --}}
    <a href="{{ route('officers.kta', $officer->id) }}" class="btn btn-success btn-action-icon mt-3">
        <i class="ti ti-printer me-2"></i> Cetak KTA
    </a>
</x-app-layout>
