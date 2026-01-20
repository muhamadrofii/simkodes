<x-app-layout>
    {{-- Page Title --}}
    <x-page-title>Tambah Anggota</x-page-title>

    <div class="bg-white rounded-4 shadow-sm p-4 mb-4">
        {{-- form add data --}}
        <form action="{{ route('members.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="row">
                {{-- Kategori --}}
                <div class="col-xl-6">
                    <div class="mb-3 pe-xl-3">
                        <label class="form-label">Kategori <span class="text-danger">*</span></label>
                        <select name="category_id" class="form-select @error('category_id') is-invalid @enderror" autocomplete="off">
                            <option selected disabled value="">- Pilih Kategori -</option>
                            @foreach ($categories as $category)
                                <option {{ old('category_id') == $category->id ? 'selected' : '' }} value="{{ $category->id }}">
                                    {{ $category->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('category_id')
                            <div class="alert alert-danger mt-2">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                {{-- Tanggal Masuk --}}
                <div class="col-xl-6">
                    <div class="mb-3 ps-xl-3">
                        <label class="form-label">Tanggal Masuk</label>
                        <input type="date" name="tanggal_masuk" class="form-control @error('tanggal_masuk') is-invalid @enderror" value="{{ old('tanggal_masuk') }}">
                        @error('tanggal_masuk')
                            <div class="alert alert-danger mt-2">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>

            <hr class="text-body-tertiary mb-4-2">

            <div class="row">
                <div class="col-xl-6">
                    {{-- Nama --}}
                    <div class="mb-3 pe-xl-3">
                        <label class="form-label">Nama Lengkap <span class="text-danger">*</span></label>
                        <input type="text" name="nama" class="form-control @error('nama') is-invalid @enderror" value="{{ old('nama') }}">
                        @error('nama')
                            <div class="alert alert-danger mt-2">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Umur --}}
                    <div class="mb-3 pe-xl-3">
                        <label class="form-label">Umur</label>
                        <input type="number" name="umur" class="form-control @error('umur') is-invalid @enderror" value="{{ old('umur') }}">
                        @error('umur')
                            <div class="alert alert-danger mt-2">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Jenis Kelamin --}}
                    <div class="mb-3 pe-xl-3">
                        <label class="form-label">Jenis Kelamin</label><br>
                        <div class="form-check form-check-inline">
                            <input type="radio" name="jenis_kelamin" class="form-check-input" value="L" {{ old('jenis_kelamin') == 'L' ? 'checked' : '' }}>
                            <label class="form-check-label">Laki - Laki</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input type="radio" name="jenis_kelamin" class="form-check-input" value="P" {{ old('jenis_kelamin') == 'P' ? 'checked' : '' }}>
                            <label class="form-check-label">Perempuan</label>
                        </div>
                        @error('jenis_kelamin')
                            <div class="alert alert-danger mt-2">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Tempat Tinggal --}}
                    <div class="mb-3 pe-xl-3">
                        <label class="form-label">Tempat Tinggal</label>
                        <textarea name="tempat_tinggal" rows="3" class="form-control @error('tempat_tinggal') is-invalid @enderror">{{ old('tempat_tinggal') }}</textarea>
                        @error('tempat_tinggal')
                            <div class="alert alert-danger mt-2">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Mata Pencaharian --}}
                    <div class="mb-3 pe-xl-3">
                        <label class="form-label">Mata Pencaharian</label>
                        <input type="text" name="mata_pencaharian" class="form-control @error('mata_pencaharian') is-invalid @enderror" value="{{ old('mata_pencaharian') }}">
                        @error('mata_pencaharian')
                            <div class="alert alert-danger mt-2">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                {{-- Foto Profil --}}
                    <div class="col-xl-6">
                    <div class="mb-3 ps-xl-3">
                        <label class="form-label">Foto Profil</label>
                        <input 
                        type="file" 
                        accept=".jpg, .jpeg, .png" 
                        name="image" 
                        id="image" 
                        class="form-control @error('image') is-invalid @enderror"
                        >
                        @error('image')
                        <div class="alert alert-danger mt-2">{{ $message }}</div>
                        @enderror

                        <div class="mt-4">
                        <img 
                            id="imagePreview" 
                            src="{{ asset('images/no-image.svg') }}" 
                            class="img-thumbnail rounded-5 shadow-sm" 
                            width="50%" 
                            alt="Image"
                        >
                        </div>
                    </div>
                    </div>

                </div>
            </div>

            {{-- Kolom tambahan --}}
            <div class="row">
                <div class="col-xl-6">
                    <div class="mb-3 pe-xl-3">
                        <label class="form-label">Tanggal Keluar</label>
                        <input type="date" name="tanggal_keluar" class="form-control @error('tanggal_keluar') is-invalid @enderror" value="{{ old('tanggal_keluar') }}">
                        @error('tanggal_keluar')
                            <div class="alert alert-danger mt-2">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3 pe-xl-3">
                        <label class="form-label">Sebab Berhenti</label>
                        <input type="text" name="sebab_berhenti" class="form-control @error('sebab_berhenti') is-invalid @enderror" value="{{ old('sebab_berhenti') }}">
                        @error('sebab_berhenti')
                            <div class="alert alert-danger mt-2">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3 pe-xl-3">
                        <label class="form-label">Keterangan</label>
                        <textarea name="keterangan" rows="3" class="form-control @error('keterangan') is-invalid @enderror">{{ old('keterangan') }}</textarea>
                        @error('keterangan')
                            <div class="alert alert-danger mt-2">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>

            <div class="pt-4 pb-2 mt-5 border-top">
                <div class="d-grid gap-3 d-sm-flex justify-content-md-start pt-1">
                    <button type="submit" class="btn btn-primary btn-action">Simpan</button>
                    <a href="{{ route('members.index') }}" class="btn btn-secondary btn-action">Batal</a>
                </div>
            </div>
        </form>
    </div>
</x-app-layout>

