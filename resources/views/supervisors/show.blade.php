<x-app-layout>
    {{-- Page Title --}}
    <x-page-title>Detail Supervisor</x-page-title>

    <div class="bg-white rounded-4 shadow-sm p-4 mb-5">
        <div class="d-grid gap-3 d-sm-flex flex-sm-row-reverse">
            <div class="d-grid gap-3 d-sm-flex">
                <a href="{{ route('supervisors.edit', $supervisor->id) }}" class="btn btn-primary btn-action-icon">
                    <i class="ti ti-edit me-2"></i> Edit
                </a>
                <button type="button" class="btn btn-danger btn-action-icon" data-bs-toggle="modal"
                    data-bs-target="#modalDelete{{ $supervisor->id }}">
                    <i class="ti ti-trash me-2"></i> Hapus
                </button>
            </div>
            <a href="{{ route('supervisors.index') }}" class="btn btn-secondary btn-action-icon me-sm-auto">
                <i class="ti ti-chevron-left me-2"></i> Kembali
            </a>
        </div>
    </div>

    <div class="bg-white rounded-4 shadow-sm p-4 mb-4">
        <div class="d-flex flex-column flex-xl-row align-items-start">
            {{-- Foto Profil --}}
            <div class="col-md-4 text-center mb-4 mb-xl-0">
                @if ($supervisor->image)
                    <img src="{{ asset('supervisor_files/' . $supervisor->image) }}"
                        class="img-thumbnail rounded-5 shadow-sm" width="150" alt="{{ $supervisor->nama }}">
                @else
                    <img src="{{ asset('images/default.png') }}" class="img-thumbnail rounded-5 shadow-sm" width="150"
                        alt="Default">
                @endif

                {{-- Tanda Tangan --}}
                @if ($supervisor->ttd_ketua)
                    <div class="mt-3">
                        <img src="{{ asset('supervisor_files/' . $supervisor->ttd_ketua) }}"
                            class="img-thumbnail rounded-4 shadow-sm" width="120" alt="TTD Ketua">
                        <p class="text-muted small mt-1 mb-0">Tanda Tangan Ketua</p>
                    </div>
                @endif
            </div>

            {{-- Detail Info --}}
            <div class="flex-grow-1 ms-xl-5 w-100">
                <div class="table-responsive">
                    <table class="table table-striped lh-lg">
                        <tr>
                            <td width="220">Kategori</td>
                            <td width="10">:</td>
                            <td>{{ $supervisor->category->name ?? '-' }}</td>
                        </tr>
                        <tr>
                            <td>Nama Lengkap</td>
                            <td>:</td>
                            <td>{{ $supervisor->nama }}</td>
                        </tr>
                        <tr>
                            <td>Jenis Kelamin</td>
                            <td>:</td>
                            <td>{{ $supervisor->jenis_kelamin == 'L' ? 'Laki-laki' : 'Perempuan' }}</td>
                        </tr>
                        <tr>
                            <td>Umur</td>
                            <td>:</td>
                            <td>{{ $supervisor->umur ?? '-' }}</td>
                        </tr>
                        <tr>
                            <td>Mata Pencaharian</td>
                            <td>:</td>
                            <td>{{ $supervisor->mata_pencaharian ?? '-' }}</td>
                        </tr>
                        <tr>
                            <td>Tempat Tinggal</td>
                            <td>:</td>
                            <td>{{ $supervisor->tempat_tinggal ?? '-' }}</td>
                        </tr>
                        <tr>
                            <td>No. Anggota Koperasi</td>
                            <td>:</td>
                            <td>{{ $supervisor->no_anggota_koperasi ?? '-' }}</td>
                        </tr>
                        <tr>
                            <td>Jabatan</td>
                            <td>:</td>
                            <td>{{ $supervisor->jabatan ?? '-' }}</td>
                        </tr>
                        <tr>
                            <td>Tanggal Dipilih</td>
                            <td>:</td>
                            <td>{{ $supervisor->tanggal_dipilih ? date('d-m-Y', strtotime($supervisor->tanggal_dipilih)) : '-' }}
                            </td>
                        </tr>
                        <tr>
                            <td>Tanggal Berhenti</td>
                            <td>:</td>
                            <td>{{ $supervisor->tanggal_berhenti ? date('d-m-Y', strtotime($supervisor->tanggal_berhenti)) : '-' }}
                            </td>
                        </tr>
                        <tr>
                            <td>Keterangan</td>
                            <td>:</td>
                            <td>{{ $supervisor->keterangan ?? '-' }}</td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>

    {{-- Modal Konfirmasi Hapus --}}
    <div class="modal fade" id="modalDelete{{ $supervisor->id }}" data-bs-backdrop="static" data-bs-keyboard="false"
        tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5"><i class="ti ti-trash me-2"></i> Hapus Data</h1>
                </div>
                <div class="modal-body">
                    <p>Apakah Anda yakin ingin menghapus data <strong>{{ $supervisor->nama }}</strong>?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary btn-action-icon"
                        data-bs-dismiss="modal">Batal</button>
                    <form action="{{ route('supervisors.destroy', $supervisor->id) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-action-icon">Ya, hapus!</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    {{-- Tombol Cetak KTA Supervisor --}}
    <a href="{{ route('supervisors.kta', $supervisor->id) }}" class="btn btn-success btn-action-icon mt-3"
        target="_blank">
        <i class="ti ti-printer me-2"></i> Cetak KTA
    </a>
</x-app-layout>