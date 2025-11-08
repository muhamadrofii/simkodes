<x-app-layout>
    {{-- Page Title --}}
    <x-page-title>Edit Surat Keluar</x-page-title>

    {{-- Form Section --}}
    <div class="bg-white rounded-4 shadow-sm p-4 mb-5">
        <form action="{{ route('outgoingletters.update', $letter->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="row g-4">
                {{-- Title --}}
                <div class="col-md-6">
                    <label class="form-label fw-semibold">Judul Surat</label>
                    <input type="text" name="title" class="form-control" value="{{ old('title', $letter->title) }}" required>
                    @error('title')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                {{-- Reference Number --}}
                <div class="col-md-6">
                    <label class="form-label fw-semibold">No. Surat</label>
                    <input type="text" name="ref_number" class="form-control" value="{{ old('ref_number', $letter->ref_number) }}">
                </div>

                {{-- Category --}}
                <div class="col-md-6">
                    <label class="form-label fw-semibold">Kategori</label>
                    <input type="text" name="category" class="form-control" value="{{ old('category', $letter->category) }}">
                </div>

                {{-- Existing File Preview --}}
                @if ($letter->file)
                    <div class="col-md-6">
                        <label class="form-label fw-semibold">Current File</label>
                        <div class="border rounded p-2 bg-light d-flex align-items-center justify-content-between">
                            <a href="{{ asset($letter->file) }}" target="_blank" class="text-decoration-none">
                                {{ basename($letter->file) }}
                            </a>
                            <i class="ti ti-file fs-5 text-primary"></i>
                        </div>
                    </div>
                @endif

                {{-- Upload New File --}}
                <div class="col-md-6">
                    <label class="form-label fw-semibold">Upload New File (optional)</label>
                    <input type="file" name="file" class="form-control" accept=".pdf,.doc,.docx,.jpg,.png">
                </div>
            </div>

            {{-- Submit Buttons --}}
            <div class="d-flex justify-content-end mt-4">
                <a href="{{ route('outgoingletters.index') }}" class="btn btn-light me-2">Cancel</a>
                <button type="submit" class="btn btn-primary">
                    <i class="ti ti-device-floppy me-1"></i> Simpan Surat
                </button>
            </div>
        </form>
    </div>
</x-app-layout>
