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
                    @if ($checkStatus === 'claimed')
                        <div class="alert alert-danger rounded-4 d-flex align-items-start mb-0 p-3" role="alert">
                            <i class="ti ti-circle-x fs-3 me-3 mt-1 text-danger"></i>
                            <div>
                                <h6 class="fw-bold mb-1">Sudah Menerima (Bantuan Telah Diambil)</h6>
                                <p class="mb-0 small">
                                    Penerima atas nama <strong>{{ $result->nama }}</strong> 
                                    (NIK: <strong>{{ $result->nik ?? '-' }}</strong> / KK: <strong>{{ $result->no_kk ?? '-' }}</strong>) 
                                    sudah mengklaim bantuan untuk program <strong>{{ $selectedProgram->nama }}</strong> 
                                    pada {{ \Carbon\Carbon::parse($result->periode)->format('d/m/Y H:i') }}.
                                </p>
                                <span class="badge bg-danger mt-2">Tidak Berhak Menerima Lagi</span>
                                <span class="badge bg-success mt-2 ms-1 d-inline-flex align-items-center gap-1"><i class="ti ti-circle-check fs-6"></i> Sudah Diserahkan</span>
                            </div>
                        </div>
                    @elseif ($checkStatus === 'ready')
                        <div class="alert alert-success rounded-4 d-flex align-items-start p-3 mb-4" role="alert">
                            <i class="ti ti-circle-check fs-3 me-3 mt-1 text-success"></i>
                            <div>
                                <h6 class="fw-bold mb-1">Kuota Tersedia (Berhak Menerima)</h6>
                                <p class="mb-0 small">
                                    Penerima atas nama <strong>{{ $result->nama }}</strong> 
                                    (NIK: <strong>{{ $result->nik ?? '-' }}</strong> / KK: <strong>{{ $result->no_kk ?? '-' }}</strong>) 
                                    <strong>terdaftar</strong> sebagai penerima program <strong>{{ $selectedProgram->nama }}</strong> dan belum mengambil bantuan.
                                </p>
                                <span class="badge bg-success mt-2">Berhak Menerima</span>
                            </div>
                        </div>

                        {{-- Form Klaim Subsidi --}}
                        <div class="bg-light rounded-4 border p-4">
                            <h6 class="fw-bold text-dark mb-3"><i class="ti ti-circle-check me-2 text-success"></i>Konfirmasi Penyerahan Bantuan</h6>
                            <p class="text-muted small mb-3">Klik tombol di bawah ini untuk mengonfirmasi bahwa bantuan program <strong>{{ $selectedProgram->nama }}</strong> telah diserahkan kepada <strong>{{ $result->nama }}</strong>.</p>
                            <form action="{{ route('subsidychecks.store') }}" method="POST">
                                @csrf
                                <input type="hidden" name="id" value="{{ $result->id }}">
                                <button type="submit" class="btn btn-success">
                                    <i class="ti ti-circle-check me-2"></i> Konfirmasi & Serahkan Bantuan
                                </button>
                            </form>
                        </div>
                    @elseif ($checkStatus === 'not_found')
                        <div class="alert alert-danger rounded-4 d-flex align-items-start mb-0 p-3" role="alert">
                            <i class="ti ti-circle-x fs-3 me-3 mt-1 text-danger"></i>
                            <div>
                                <h6 class="fw-bold mb-1">Tidak Berhak Menerima (Tidak Terdaftar)</h6>
                                <p class="mb-0 small">
                                    Data NIK/KK <strong>{{ $nik ?: $no_kk }}</strong> 
                                    <strong>tidak terdaftar</strong> sebagai penerima manfaat untuk program <strong>{{ $selectedProgram->nama }}</strong>.
                                </p>
                                <span class="badge bg-danger mt-2">Tidak Berhak Menerima</span>
                            </div>
                        </div>
                    @endif
                </div>
            @endif
        </div>
    @endif
</x-app-layout>
