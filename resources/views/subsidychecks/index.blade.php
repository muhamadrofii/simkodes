<x-app-layout>
    {{-- Page Title --}}
    <x-page-title>Checker Subsidi</x-page-title>

    {{-- Top Action: Go to Subsidy Management --}}
    <div class="bg-white rounded-4 shadow-sm p-4 mb-4">
        <div class="d-flex align-items-center justify-content-between flex-wrap gap-3">
            <div>
                <h5 class="fw-bold text-dark mb-1">Pengecekan Kuota & Penerimaan Subsidi</h5>
                <p class="text-muted mb-0 small">Sistem validasi penerima bantuan berdasarkan NIK atau Nomor KK (Cukup isi salah satu saja).</p>
            </div>
            <a href="{{ route('subsidies.index') }}" class="btn btn-primary d-flex align-items-center gap-2">
                <i class="ti ti-settings fs-5"></i> Kelola Program Subsidi
            </a>
        </div>
    </div>

    @if ($programs->isEmpty())
        <div class="alert alert-warning rounded-4 shadow-sm p-4 mb-4 d-flex align-items-center gap-3">
            <i class="ti ti-alert-triangle fs-1 text-warning"></i>
            <div>
                <h6 class="fw-bold mb-1">Belum Ada Program Subsidi Aktif</h6>
                <p class="mb-0 small">Silakan tambahkan program subsidi baru di <a href="{{ route('subsidies.index') }}" class="fw-bold">Halaman Manajemen Subsidi</a> terlebih dahulu agar dapat melakukan pengecekan.</p>
            </div>
        </div>
    @else
        {{-- Card Cek NIK & KK --}}
        <div class="bg-white rounded-4 shadow-sm p-4 mb-4">
            <h6 class="fw-bold mb-3"><i class="ti ti-search me-2 text-primary"></i>Cek Kelayakan Penerima</h6>
            <form action="{{ route('subsidychecks.check') }}" method="POST">
                @csrf
                <div class="row align-items-end g-3">
                    <div class="col-md-4">
                        <label for="subsidy_id" class="form-label fw-medium text-dark">Program Subsidi</label>
                        <select name="subsidy_id" id="subsidy_id" class="form-select @error('subsidy_id') is-invalid @enderror" required>
                            <option value="">-- Pilih Program --</option>
                            @foreach ($programs as $prog)
                                <option value="{{ $prog->id }}" {{ old('subsidy_id', $subsidy_id) == $prog->id ? 'selected' : '' }}>
                                    {{ $prog->nama }} ({{ $prog->tahun }} - {{ $prog->periode }})
                                </option>
                            @endforeach
                        </select>
                        @error('subsidy_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-4">
                        <label for="nik" class="form-label fw-medium text-dark">NIK Penerima (16 digit) <span class="text-muted small fw-normal">(Isi salah satu)</span></label>
                        <input type="text" name="nik" id="nik" class="form-control @error('nik') is-invalid @enderror"
                            placeholder="Masukkan NIK atau kosongkan jika isi KK" value="{{ old('nik', $nik ?? '') }}"
                            maxlength="16" inputmode="numeric" autocomplete="off">
                        @error('nik')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-4">
                        <label for="no_kk" class="form-label fw-medium text-dark">Nomor KK (16 digit) <span class="text-muted small fw-normal">(Isi salah satu)</span></label>
                        <input type="text" name="no_kk" id="no_kk" class="form-control @error('no_kk') is-invalid @enderror"
                            placeholder="Masukkan KK atau kosongkan jika isi NIK" value="{{ old('no_kk', $no_kk ?? '') }}"
                            maxlength="16" inputmode="numeric" autocomplete="off">
                        @error('no_kk')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-12 d-grid mt-3">
                        <button type="submit" class="btn btn-primary btn-action">
                            <i class="ti ti-search me-2"></i> Periksa Kelayakan Penerima
                        </button>
                    </div>
                </div>
            </form>

            {{-- Hasil Pengecekan --}}
            @if (($nik || $no_kk) && $subsidy_id && $selectedProgram)
                <div class="mt-4 border-top pt-4">
                    @if ($checkStatus === 'claimed_nik')
                        <div class="alert alert-danger rounded-4 d-flex align-items-start mb-0 p-3" role="alert">
                            <i class="ti ti-circle-x fs-3 me-3 mt-1 text-danger"></i>
                            <div>
                                <h6 class="fw-bold mb-1">NIK Terdaftar (Sudah Menerima)</h6>
                                <p class="mb-0 small">NIK <strong>{{ $nik }}</strong> atas nama <strong>{{ $result->nama }}</strong> sudah terdaftar sebagai penerima program <strong>{{ $selectedProgram->nama }}</strong> pada {{ $result->created_at->format('d/m/Y H:i') }}.</p>
                                <span class="badge bg-danger mt-2">Tidak Berhak Menerima Lagi</span>
                                <span class="badge bg-success mt-2 ms-1 d-inline-flex align-items-center gap-1"><i class="ti ti-circle-check fs-6"></i> Sudah Diklaim</span>
                            </div>
                        </div>
                    @elseif ($checkStatus === 'claimed_kk')
                        <div class="alert alert-danger rounded-4 d-flex align-items-start mb-0 p-3" role="alert">
                            <i class="ti ti-alert-triangle fs-3 me-3 mt-1 text-danger"></i>
                            <div>
                                <h6 class="fw-bold mb-1">Kuota Keluarga Terpakai (Batas 1 KK 1 Penerima)</h6>
                                <p class="mb-0 small">Nomor KK <strong>{{ $no_kk }}</strong> sudah digunakan oleh anggota keluarga lain bernama <strong>{{ $result->nama }}</strong> (NIK: {{ $result->nik }}) untuk menerima program <strong>{{ $selectedProgram->nama }}</strong>.</p>
                                <span class="badge bg-danger mt-2">Kuota Keluarga Habis</span>
                                <span class="badge bg-success mt-2 ms-1 d-inline-flex align-items-center gap-1"><i class="ti ti-circle-check fs-6"></i> Sudah Diklaim</span>
                            </div>
                        </div>
                    @elseif ($checkStatus === 'ready')
                        <div class="alert alert-success rounded-4 d-flex align-items-start p-3 mb-4" role="alert">
                            <i class="ti ti-circle-check fs-3 me-3 mt-1 text-success"></i>
                            <div>
                                <h6 class="fw-bold mb-1">Kuota Tersedia (Berhak Menerima)</h6>
                                <p class="mb-0 small">
                                    @if ($nik && $no_kk)
                                        NIK <strong>{{ $nik }}</strong> dan Nomor KK <strong>{{ $no_kk }}</strong> belum pernah terdaftar di program <strong>{{ $selectedProgram->nama }}</strong>. Kuota keluarga masih tersedia.
                                    @elseif ($nik)
                                        NIK <strong>{{ $nik }}</strong> belum pernah terdaftar di program <strong>{{ $selectedProgram->nama }}</strong>. Kuota masih tersedia.
                                    @else
                                        Nomor KK <strong>{{ $no_kk }}</strong> belum pernah terdaftar di program <strong>{{ $selectedProgram->nama }}</strong>. Kuota keluarga masih tersedia.
                                    @endif
                                </p>
                                <span class="badge bg-success mt-2">Berhak Menerima</span>
                            </div>
                        </div>

                        {{-- Form Klaim Subsidi --}}
                        <div class="bg-light rounded-4 border p-4">
                            <h6 class="fw-bold text-dark mb-3"><i class="ti ti-user-plus me-2 text-success"></i>Daftarkan Penerima Baru</h6>
                            <form action="{{ route('subsidychecks.store') }}" method="POST">
                                @csrf
                                <input type="hidden" name="subsidy_id" value="{{ $subsidy_id }}">

                                <div class="row g-3">
                                    <div class="col-md-6">
                                        <label for="claim_nama" class="form-label fw-medium text-dark">Nama Lengkap Penerima</label>
                                        <input type="text" name="nama" id="claim_nama" class="form-control @error('nama') is-invalid @enderror"
                                            placeholder="Masukkan nama lengkap penerima" value="{{ old('nama') }}" required autocomplete="off">
                                        @error('nama')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    @if ($nik)
                                        <input type="hidden" name="nik" value="{{ $nik }}">
                                    @else
                                        <div class="col-md-6">
                                            <label for="claim_nik" class="form-label fw-medium text-dark">NIK Penerima (16 digit)</label>
                                            <input type="text" name="nik" id="claim_nik" class="form-control @error('nik') is-invalid @enderror"
                                                placeholder="Masukkan NIK 16 digit" value="{{ old('nik') }}" maxlength="16" inputmode="numeric" autocomplete="off">
                                            @error('nik')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    @endif

                                    @if ($no_kk)
                                        <input type="hidden" name="no_kk" value="{{ $no_kk }}">
                                    @else
                                        <div class="col-md-6">
                                            <label for="claim_no_kk" class="form-label fw-medium text-dark">Nomor KK (16 digit)</label>
                                            <input type="text" name="no_kk" id="claim_no_kk" class="form-control @error('no_kk') is-invalid @enderror"
                                                placeholder="Masukkan KK 16 digit" value="{{ old('no_kk') }}" maxlength="16" inputmode="numeric" autocomplete="off">
                                            @error('no_kk')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    @endif

                                    <div class="col-md-6">
                                        <label for="claim_keterangan" class="form-label fw-medium text-dark">Keterangan Tambahan (opsional)</label>
                                        <input type="text" name="keterangan" id="claim_keterangan" class="form-control"
                                            placeholder="Catatan tambahan..." value="{{ old('keterangan') }}" autocomplete="off">
                                    </div>
                                </div>
                                <div class="mt-3">
                                    <button type="submit" class="btn btn-success">
                                        <i class="ti ti-circle-check me-2"></i> Klaim & Simpan Penerima
                                    </button>
                                </div>
                            </form>
                        </div>
                    @endif
                </div>
            @endif
        </div>
    @endif
</x-app-layout>
