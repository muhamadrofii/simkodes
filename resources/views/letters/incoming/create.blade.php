<x-app-layout>
    {{-- Page Title --}}
    <x-page-title>Add Incoming Letter</x-page-title>

    {{-- Form Card --}}
    <div class="bg-white rounded-4 shadow-sm p-4 mb-5">
        <form action="{{ route('incomingletters.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            {{-- Title --}}
            <div class="mb-4">
                <label for="title" class="form-label fw-semibold">Judul <span class="text-danger">*</span></label>
                <input type="text" 
                       name="title" 
                       id="title" 
                       class="form-control @error('title') is-invalid @enderror"
                       value="{{ old('title') }}" 
                       placeholder="Enter letter title" 
                       required>
                @error('title')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            {{-- Reference Number --}}
            <div class="mb-4">
                <label for="reference_number" class="form-label fw-semibold">Nomor Surat</label>
                <input type="text" 
                       name="reference_number" 
                       id="reference_number" 
                       class="form-control @error('reference_number') is-invalid @enderror"
                       value="{{ old('reference_number') }}" 
                       placeholder="Enter reference number">
                @error('reference_number')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            {{-- Category --}}
            <div class="mb-4">
                <label for="category" class="form-label fw-semibold">Kategori</label>
                <input type="text" 
                       name="category" 
                       id="category" 
                       class="form-control @error('category') is-invalid @enderror"
                       value="{{ old('category') }}" 
                       placeholder="Enter category (optional)">
                @error('category')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            {{-- File Upload --}}
            <div class="mb-4">
                <label for="file" class="form-label fw-semibold">Upload File</label>
                <input type="file" 
                       name="file" 
                       id="file" 
                       class="form-control @error('file') is-invalid @enderror"
                       accept=".pdf,.doc,.docx,.jpg,.png">
                <small class="text-muted">Allowed formats: PDF, DOC, DOCX, JPG, PNG (max 2MB)</small>
                @error('file')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            {{-- Action Buttons --}}
            <div class="d-flex justify-content-between align-items-center mt-5">
                <a href="{{ route('incomingletters.index') }}" class="btn btn-outline-secondary">
                    <i class="ti ti-arrow-left me-1"></i> Kembali
                </a>
                <button type="submit" class="btn btn-primary">
                    <i class="ti ti-device-floppy me-1"></i> Simpan Surat
                </button>
            </div>
        </form>
    </div>
</x-app-layout>
