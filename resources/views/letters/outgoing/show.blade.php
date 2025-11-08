<x-app-layout>
    {{-- Page Title --}}
    <x-page-title>Detail Surat Keluar</x-page-title>

    {{-- Letter Info Card --}}
    <div class="bg-white rounded-4 shadow-sm p-4 mb-5">
        <div class="row g-4">
            {{-- Title --}}
            <div class="col-md-6">
                <label class="form-label fw-semibold">Judul</label>
                <div class="form-control bg-light">{{ $letter->title }}</div>
            </div>

            {{-- Reference Number --}}
            <div class="col-md-6">
                <label class="form-label fw-semibold">No. Surat</label>
                <div class="form-control bg-light">{{ $letter->ref_number ?? '-' }}</div>
            </div>

            {{-- Category --}}
            <div class="col-md-6">
                <label class="form-label fw-semibold">Kategori</label>
                <div class="form-control bg-light">{{ $letter->category ?? '-' }}</div>
            </div>

            {{-- File --}}
            <div class="col-md-6">
                <label class="form-label fw-semibold">Attached File</label>
                @if ($letter->file)
                    <div class="border rounded p-3 bg-light d-flex align-items-center justify-content-between">
                        <a href="{{ asset($letter->file) }}" target="_blank" class="text-decoration-none">
                            {{ basename($letter->file) }}
                        </a>
                        <i class="ti ti-file-text fs-5 text-primary"></i>
                    </div>
                @else
                    <div class="form-control bg-light">No file uploaded.</div>
                @endif
            </div>
        </div>

        {{-- Footer Buttons --}}
        <div class="pt-4 border-top mt-4 d-flex justify-content-between">
            <a href="{{ route('outgoingletters.index') }}" class="btn btn-secondary">
                ← Back
            </a>
            <div class="d-flex gap-2">
                <a href="{{ route('outgoingletters.edit', $letter->id) }}" class="btn btn-warning">
                    <i class="ti ti-edit me-1"></i> Edit
                </a>

                {{-- Delete Modal Trigger --}}
                <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#deleteModal">
                    <i class="ti ti-trash me-1"></i> Hapus
                </button>
            </div>
        </div>
    </div>

    {{-- Delete Confirmation Modal --}}
    <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content rounded-4">
                <div class="modal-header border-0">
                    <h5 class="modal-title fw-semibold" id="deleteModalLabel">Confirm Delete</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body text-center py-4">
                    <i class="ti ti-alert-triangle text-danger fs-1 mb-3"></i>
                    <p class="mb-0">Yakin Ingin Hapus File ini? <strong>{{ $letter->title }}</strong>?</p>
                </div>
                <div class="modal-footer border-0 justify-content-center pb-4">
                    <form action="{{ route('outgoingletters.destroy', $letter->id) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="button" class="btn btn-light me-2" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-danger">
                            <i class="ti ti-trash me-1"></i> Hapus
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
