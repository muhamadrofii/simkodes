<x-app-layout>
    {{-- Page Title --}}
    <x-page-title>Edit Pengurus</x-page-title>

    <div class="bg-white rounded-4 shadow-sm p-4 mb-4">
        {{-- form edit data --}}
        <form action="{{ route('officers.update', $officer->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="row">
                {{-- Kategori --}}
                <div class="col-xl-6">
                    <div class="mb-3 pe-xl-3">
                        <label class="form-label">Kategori <span class="text-danger">*</span></label>
                        <select name="category_id" class="form-select @error('category_id') is-invalid @enderror">
                            <option disabled value="">- Pilih Kategori -</option>
                            @foreach ($categories as $category)
                                <option {{ old('category_id', $officer->category_id) == $category->id ? 'selected' : '' }} 
                                        value="{{ $category->id }}">{{ $category->name }}</option>
                            @endforeach
                        </select>
                        @error('category_id')
                            <div class="alert alert-danger mt-2">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                {{-- Tanggal Diangkat --}}
                <div class="col-xl-6">
                    <div class="mb-3 ps-xl-3">
                        <label class="form-label">Tanggal Diangkat</label>
                        <input type="date" name="tanggal_diangkat" 
                               class="form-control @error('tanggal_diangkat') is-invalid @enderror"
                               value="{{ old('tanggal_diangkat', $officer->tanggal_diangkat) }}">
                        @error('tanggal_diangkat')
                            <div class="alert alert-danger mt-2">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>

            <hr class="text-body-tertiary mb-4">

            <div class="row">
                <div class="col-xl-6">
                    {{-- Nama --}}
                    <div class="mb-3 pe-xl-3">
                        <label class="form-label">Nama Lengkap <span class="text-danger">*</span></label>
                        <input type="text" name="nama" 
                               class="form-control @error('nama') is-invalid @enderror"
                               value="{{ old('nama', $officer->nama) }}">
                        @error('nama')
                            <div class="alert alert-danger mt-2">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Jenis Kelamin --}}
                    <div class="mb-3 pe-xl-3">
                        <label class="form-label">Jenis Kelamin</label><br>
                        <div class="form-check form-check-inline">
                            <input type="radio" name="jenis_kelamin" class="form-check-input" value="L" 
                                {{ old('jenis_kelamin', $officer->jenis_kelamin) == 'L' ? 'checked' : '' }}>
                            <label class="form-check-label">Laki-laki</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input type="radio" name="jenis_kelamin" class="form-check-input" value="P" 
                                {{ old('jenis_kelamin', $officer->jenis_kelamin) == 'P' ? 'checked' : '' }}>
                            <label class="form-check-label">Perempuan</label>
                        </div>
                        @error('jenis_kelamin')
                            <div class="alert alert-danger mt-2">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Umur --}}
                    <div class="mb-3 pe-xl-3">
                        <label class="form-label">Umur</label>
                        <input type="number" name="umur" 
                               class="form-control @error('umur') is-invalid @enderror"
                               value="{{ old('umur', $officer->umur) }}">
                        @error('umur')
                            <div class="alert alert-danger mt-2">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Jabatan --}}
                    <div class="mb-3 pe-xl-3">
                        <label class="form-label">Jabatan</label>
                        <input type="text" name="jabatan" 
                               class="form-control @error('jabatan') is-invalid @enderror"
                               value="{{ old('jabatan', $officer->jabatan) }}">
                        @error('jabatan')
                            <div class="alert alert-danger mt-2">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Tempat Tinggal --}}
                    <div class="mb-3 pe-xl-3">
                        <label class="form-label">Tempat Tinggal</label>
                        <textarea name="tempat_tinggal" rows="3" 
                                  class="form-control @error('tempat_tinggal') is-invalid @enderror">{{ old('tempat_tinggal', $officer->tempat_tinggal) }}</textarea>
                        @error('tempat_tinggal')
                            <div class="alert alert-danger mt-2">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- No Anggota Koperasi --}}
                    <div class="mb-3 pe-xl-3">
                        <label class="form-label">No. Anggota Koperasi</label>
                        <input type="text" name="no_anggota_koperasi" 
                               class="form-control @error('no_anggota_koperasi') is-invalid @enderror"
                               value="{{ old('no_anggota_koperasi', $officer->no_anggota_koperasi) }}">
                        @error('no_anggota_koperasi')
                            <div class="alert alert-danger mt-2">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                {{-- Foto dan file lain --}}
                <div class="col-xl-6">
                    {{-- Foto Profil --}}
                    <div class="mb-3 ps-xl-3">
                        <label class="form-label">Foto Profil</label>
                        <input type="file" accept=".jpg,.jpeg,.png" name="image" id="image" 
                            class="form-control @error('image') is-invalid @enderror">
                        @error('image')
                            <div class="alert alert-danger mt-2">{{ $message }}</div>
                        @enderror

                        <div class="mt-4">
                            @if ($officer->image)
                                <img id="imagePreview" 
                                     src="{{ asset('officer_files/' . $officer->image) }}" 
                                     class="img-thumbnail rounded-5 shadow-sm" width="50%" alt="Image">
                            @else
                                <p class="text-muted">Belum ada foto profil</p>
                            @endif
                        </div>
                    </div>

                    {{-- Tanda Tangan --}}
                    <div class="mb-3 ps-xl-3">
                        <label class="form-label">Tanda Tangan</label>
                        <input type="file" accept=".jpg,.jpeg,.png" name="ttd" id="ttd" 
                            class="form-control @error('ttd') is-invalid @enderror">
                        @error('ttd')
                            <div class="alert alert-danger mt-2">{{ $message }}</div>
                        @enderror
                        @if ($officer->ttd)
                            <div class="mt-3">
                                <img src="{{ asset('officer_files/' . $officer->ttd) }}" 
                                     class="img-thumbnail rounded-5 shadow-sm" width="40%" alt="TTD">
                            </div>
                        @endif
                    </div>

                    {{-- Tanggal Berhenti --}}
                    <div class="mb-3 ps-xl-3">
                        <label class="form-label">Tanggal Berhenti</label>
                        <input type="date" name="tanggal_berhenti" 
                               class="form-control @error('tanggal_berhenti') is-invalid @enderror"
                               value="{{ old('tanggal_berhenti', $officer->tanggal_berhenti) }}">
                        @error('tanggal_berhenti')
                            <div class="alert alert-danger mt-2">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Keterangan --}}
                    <div class="mb-3 ps-xl-3">
                        <label class="form-label">Keterangan</label>
                        <textarea name="keterangan" rows="3" 
                                  class="form-control @error('keterangan') is-invalid @enderror">{{ old('keterangan', $officer->keterangan) }}</textarea>
                        @error('keterangan')
                            <div class="alert alert-danger mt-2">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>

            <div class="pt-4 pb-2 mt-5 border-top">
                <div class="d-grid gap-3 d-sm-flex justify-content-md-start pt-1">
                    <button type="submit" class="btn btn-primary btn-action">Update</button>
                    <a href="{{ route('officers.show', $officer->id) }}" class="btn btn-secondary btn-action">Batal</a>
                </div>
            </div>
        </form>
    </div>
</x-app-layout>
