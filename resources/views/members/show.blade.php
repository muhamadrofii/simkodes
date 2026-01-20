<x-app-layout>
    {{-- Page Title --}}
    <x-page-title>Detail Anggota</x-page-title>

    <div class="bg-white rounded-4 shadow-sm p-4 mb-5">
        <div class="d-grid gap-3 d-sm-flex flex-sm-row-reverse">
            <div class="d-grid gap-3 d-sm-flex">
                <a href="{{ route('members.edit', $member->id) }}" class="btn btn-primary btn-action-icon">
                    <i class="ti ti-edit me-2"></i> Edit
                </a>
                <button type="button" class="btn btn-danger btn-action-icon" data-bs-toggle="modal"
                    data-bs-target="#modalDelete{{ $member->id }}">
                    <i class="ti ti-trash me-2"></i> Hapus
                </button>
            </div>
            <a href="{{ route('members.index') }}" class="btn btn-secondary btn-action-icon me-sm-auto">
                <i class="ti ti-chevron-left me-2"></i> Kembali
            </a>
        </div>
    </div>

    <div class="bg-white rounded-4 shadow-sm p-4 mb-4">
        <div class="d-flex flex-column flex-xl-row">
            {{-- Foto Profil / TTD / Cap --}}
            {{-- <h3>{{ $member->nama }}</h3> --}}

            <div class="col-md-4 text-center">
                {{-- ✅ Debug: tampilkan URL publik --}}
                {{-- <p class="text-muted small mb-2">
                    <strong>Debug URL:</strong> {{ asset('member_files/' . $member->image) }}


                    @if ($member->image)
                    <img src="{{ asset('member_files/' . $member->image) }}" class="img-thumbnail rounded-5 shadow-sm"
                        width="150" alt="{{ $member->nama }}">
                    @else
                <p class="text-danger">⚠️ Gambar tidak tersedia</p>
                @endif
                </p> --}}

                <img src="{{ asset('member_files/' . $member->image) }}" class="img-thumbnail rounded-5 shadow-sm"
                    width="100" alt="Image">





                {{-- ✅ Cek apakah image kosong atau nggak --}}
                {{-- @if($member->image)
                <img src="{{ asset('member_files/' . $member->image) }}" class="img-thumbnail rounded-5 shadow-sm"
                    width="150" alt="{{ $member->nama }}">
                @else
                <p class="text-danger">⚠️ Gambar tidak ada di database (null)</p>
                @endif

                {{-- ✅ Cek apakah file bener-bener ada di disk --}}
                {{-- @php
                $filePath = public_path('storage/member_files/' . $member->image);
                $exists = file_exists($filePath);
                @endphp

                <p class="text-muted small mt-2">
                    File di public:
                    <strong>{{ $exists ? '✅ ditemukan' : '❌ tidak ditemukan' }}</strong><br>
                    <code>{{ $filePath }}</code> --}}
                    {{--
                </p> --}}
            </div>








            {{-- Detail Info --}}
            <div class="flex-grow-1 ms-xl-5">
                <div class="table-responsive">
                    <table class="table table-striped lh-lg">
                        <tr>
                            <td width="200">Kategori</td>
                            <td width="10">:</td>
                            <td>{{ $member->category->name ?? '-' }}</td>
                        </tr>
                        <tr>
                            <td>Nama</td>
                            <td>:</td>
                            <td>{{ $member->nama }}</td>
                        </tr>
                        <tr>
                            <td>Umur</td>
                            <td>:</td>
                            <td>{{ $member->umur ?? '-' }}</td>
                        </tr>
                        <tr>
                            <td>Jenis Kelamin</td>
                            <td>:</td>
                            <td>{{ $member->jenis_kelamin == 'L' ? 'Laki-laki' : 'Perempuan' }}</td>
                        </tr>
                        <tr>
                            <td>Mata Pencaharian</td>
                            <td>:</td>
                            <td>{{ $member->mata_pencaharian ?? '-' }}</td>
                        </tr>
                        <tr>
                            <td>Tempat Tinggal</td>
                            <td>:</td>
                            <td>{{ $member->tempat_tinggal ?? '-' }}</td>
                        </tr>
                        <tr>
                            <td>Tanggal Masuk</td>
                            <td>:</td>
                            <td>{{ $member->tanggal_masuk ? date('d-m-Y', strtotime($member->tanggal_masuk)) : '-' }}
                            </td>
                        </tr>
                        <tr>
                            <td>Tanggal Keluar</td>
                            <td>:</td>
                            <td>{{ $member->tanggal_keluar ? date('d-m-Y', strtotime($member->tanggal_keluar)) : '-' }}
                            </td>
                        </tr>
                        <tr>
                            <td>Sebab Berhenti</td>
                            <td>:</td>
                            <td>{{ $member->sebab_berhenti ?? '-' }}</td>
                        </tr>
                        <tr>
                            <td>Keterangan</td>
                            <td>:</td>
                            <td>{{ $member->keterangan ?? '-' }}</td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>

    {{-- Modal Hapus --}}
    <div class="modal fade" id="modalDelete{{ $member->id }}" data-bs-backdrop="static" data-bs-keyboard="false"
        tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5"><i class="ti ti-trash me-2"></i> Hapus Data</h1>
                </div>
                <div class="modal-body">
                    <p>Yakin ingin menghapus data <strong>{{ $member->nama }}</strong>?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary btn-action-icon"
                        data-bs-dismiss="modal">Batal</button>
                    <form action="{{ route('members.destroy', $member->id) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-action-icon">Ya, hapus!</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <a href="{{ route('members.kta', $member->id) }}" class="btn btn-success btn-action-icon mt-3" target="_blank">
        <i class="ti ti-printer me-2"></i> Cetak KTA
    </a>
</x-app-layout>