<x-app-layout>
    {{-- Page Title --}}
    <x-page-title>Edit Anggota</x-page-title>

    <div class="bg-white rounded-4 shadow-sm p-4 mb-4">
        {{-- form edit data --}}
        <form action="{{ route('members.update', $member->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="row">
                <div class="col-xl-6">
                    <div class="mb-3 pe-xl-3">
                        <label class="form-label">Category <span class="text-danger">*</span></label>
                        <select name="category_id" class="form-select @error('category_id') is-invalid @enderror" autocomplete="off">
                            <option disabled value="">- Select category -</option>
                            @foreach ($categories as $category)
                                <option {{ old('category_id', $member->category_id) == $category->id ? 'selected' : '' }} value="{{ $category->id }}">{{ $category->name }}</option>
                            @endforeach
                        </select>

                        @error('category_id')
                            <div class="alert alert-danger mt-2">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="col-xl-6">
                    <div class="mb-3 ps-xl-3">
                        <label class="form-label">Tanggal Masuk</label>
                        <input type="date" name="tanggal_masuk" class="form-control @error('tanggal_masuk') is-invalid @enderror" 
                            value="{{ old('tanggal_masuk', $member->tanggal_masuk) }}" autocomplete="off">

                        @error('tanggal_masuk')
                            <div class="alert alert-danger mt-2">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>

            <hr class="text-body-tertiary mb-4-2">

            <div class="row">
                <div class="col-xl-6">
                    <div class="mb-3 pe-xl-3">
                        <label class="form-label">Nama Lengkap <span class="text-danger">*</span></label>
                        <input type="text" name="nama" class="form-control @error('nama') is-invalid @enderror" 
                            value="{{ old('nama', $member->nama) }}" autocomplete="off">

                        @error('nama')
                            <div class="alert alert-danger mt-2">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3 pe-xl-3">
                        <label class="form-label">Jenis Kelamin</label><br>
                        <div class="form-check form-check-inline">
                            <input type="radio" name="jenis_kelamin" class="form-check-input" value="L" {{ old('jenis_kelamin', $member->jenis_kelamin) == 'L' ? 'checked' : '' }}>
                            <label class="form-check-label">Laki-laki</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input type="radio" name="jenis_kelamin" class="form-check-input" value="P" {{ old('jenis_kelamin', $member->jenis_kelamin) == 'P' ? 'checked' : '' }}>
                            <label class="form-check-label">Perempuan</label>
                        </div>

                        @error('jenis_kelamin')
                            <div class="alert alert-danger mt-2">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3 pe-xl-3">
                        <label class="form-label">Umur</label>
                        <input type="number" name="umur" class="form-control @error('umur') is-invalid @enderror" 
                            value="{{ old('umur', $member->umur) }}" autocomplete="off">

                        @error('umur')
                            <div class="alert alert-danger mt-2">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3 pe-xl-3">
                        <label class="form-label">Mata Pencaharian</label>
                        <input type="text" name="mata_pencaharian" class="form-control @error('mata_pencaharian') is-invalid @enderror" 
                            value="{{ old('mata_pencaharian', $member->mata_pencaharian) }}" autocomplete="off">

                        @error('mata_pencaharian')
                            <div class="alert alert-danger mt-2">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3 pe-xl-3">
                        <label class="form-label">Tempat Tinggal</label>
                        <textarea name="tempat_tinggal" rows="3" class="form-control @error('tempat_tinggal') is-invalid @enderror" autocomplete="off">{{ old('tempat_tinggal', $member->tempat_tinggal) }}</textarea>

                        @error('tempat_tinggal')
                            <div class="alert alert-danger mt-2">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="col-xl-6">
                    <div class="mb-3 ps-xl-3">
                        <label class="form-label">Foto Profil</label>
                        <input type="file" accept=".jpg,.jpeg,.png" name="image" id="image" 
                            class="form-control @error('image') is-invalid @enderror" autocomplete="off">

                        @error('image')
                            <div class="alert alert-danger mt-2">{{ $message }}</div>
                        @enderror

                        {{-- preview foto --}}
                        <div class="mt-4">
                            @if ($member->image)
                                <img id="imagePreview" 
                                     src="{{ asset('storage/public/members/' . $member->image) }}" 
                                     class="img-thumbnail rounded-5 shadow-sm" width="50%" alt="Image">
                            @else
                                <p class="text-muted">Belum ada foto profil</p>
                            @endif
                        </div>
                    </div>

                    <div class="mb-3 ps-xl-3">
                        <label class="form-label">Tanggal Keluar</label>
                        <input type="date" name="tanggal_keluar" class="form-control @error('tanggal_keluar') is-invalid @enderror" 
                            value="{{ old('tanggal_keluar', $member->tanggal_keluar) }}" autocomplete="off">

                        @error('tanggal_keluar')
                            <div class="alert alert-danger mt-2">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3 ps-xl-3">
                        <label class="form-label">Sebab Berhenti</label>
                        <input type="text" name="sebab_berhenti" class="form-control @error('sebab_berhenti') is-invalid @enderror" 
                            value="{{ old('sebab_berhenti', $member->sebab_berhenti) }}" autocomplete="off">

                        @error('sebab_berhenti')
                            <div class="alert alert-danger mt-2">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3 ps-xl-3">
                        <label class="form-label">Keterangan</label>
                        <textarea name="keterangan" rows="3" class="form-control @error('keterangan') is-invalid @enderror">{{ old('keterangan', $member->keterangan) }}</textarea>

                        @error('keterangan')
                            <div class="alert alert-danger mt-2">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>

            <div class="pt-4 pb-2 mt-5 border-top">
                <div class="d-grid gap-3 d-sm-flex justify-content-md-start pt-1">
                    <button type="submit" class="btn btn-primary btn-action">Update</button>
                    <a href="{{ route('members.show', $member->id) }}" class="btn btn-secondary btn-action">Cancel</a>
                </div>
            </div>
        </form>
    </div>
</x-app-layout>
