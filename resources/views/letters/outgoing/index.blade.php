<x-app-layout>
    {{-- Page Title --}}
    <x-page-title>Surat Keluar</x-page-title>

    {{-- Section: Add & Search --}}
    <div class="bg-white rounded-4 shadow-sm p-4 mb-5">
        <div class="row align-items-center justify-content-between g-3">
            {{-- Add New Letter Button --}}
            <div class="col-md-6 col-lg-5">
                <a href="{{ route('outgoingletters.create') }}"
                    class="btn btn-primary d-flex align-items-center justify-content-center justify-content-md-start w-100 w-md-auto">
                    <i class="ti ti-plus me-2"></i> Tambah Surat Keluar
                </a>
            </div>

            {{-- Search Form --}}
            <div class="col-md-6 col-lg-7">
                <form action="{{ route('outgoingletters.index') }}" method="GET" class="d-flex">
                    <input type="text" name="search" class="form-control rounded-start"
                        placeholder="Search incoming letter..." value="{{ request('search') }}" autocomplete="off">
                    <button class="btn btn-primary rounded-end ms-0" type="submit">
                        Cari
                    </button>
                </form>
            </div>
        </div>
    </div>

    {{-- Section: Letters Grid --}}
    <div class="row g-4">
        @forelse ($outgoingletters as $letter)
            <div class="col-12 col-sm-6 col-lg-4 col-xl-3">
                <div class="bg-white rounded-4 shadow-sm p-4 text-center h-100 d-flex flex-column">
                    <div class="mb-3">
                        @php
                            $extension = $letter->file ? pathinfo($letter->file, PATHINFO_EXTENSION) : null;
                            $isImage = $extension && in_array(strtolower($extension), ['jpg', 'jpeg', 'png', 'gif', 'webp']);
                        @endphp

                        @if ($isImage)
                            <i class="ti ti-photo text-success fs-1"></i>
                        @elseif ($extension && strtolower($extension) === 'pdf')
                            <i class="ti ti-file-type-pdf text-danger fs-1"></i>
                        @else
                            <i class="ti ti-mail-forward text-primary fs-1"></i>
                        @endif
                    </div>
                    <h6 class="fw-semibold mb-1 text-truncate" title="{{ $letter->title }}">{{ $letter->title }}</h6>
                    <p class="text-muted small mb-1">No. Surat: {{ $letter->reference_number }}</p>
                    <p class="text-muted small mb-3">Kategori: {{ $letter->category }}</p>

                    <div class="mt-auto d-grid gap-2">
                        <button type="button" class="btn btn-outline-primary btn-sm" data-bs-toggle="modal"
                            data-bs-target="#previewModal{{ $letter->id }}">
                            <i class="ti ti-eye me-1"></i> Quick Preview
                        </button>
                        <a href="{{ route('outgoingletters.show', $letter->id) }}" class="btn btn-primary btn-sm">
                            Full Details <i class="ti ti-chevron-right ms-1"></i>
                        </a>
                    </div>
                </div>
            </div>

            {{-- Quick Preview Modal --}}
            <div class="modal fade" id="previewModal{{ $letter->id }}" tabindex="-1" aria-hidden="true">
                <div class="modal-dialog modal-lg modal-dialog-centered">
                    <div class="modal-content rounded-4 border-0 shadow">
                        <div class="modal-header border-0 pb-0">
                            <h5 class="modal-title fw-bold">Preview Surat Keluar</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body p-4">
                            <div class="row g-3 mb-4">
                                <div class="col-md-6">
                                    <label class="small text-muted mb-1">Judul Surat</label>
                                    <p class="fw-semibold mb-0">{{ $letter->title }}</p>
                                </div>
                                <div class="col-md-6">
                                    <label class="small text-muted mb-1">No. Surat</label>
                                    <p class="fw-semibold mb-0">{{ $letter->reference_number ?? '-' }}</p>
                                </div>
                                <div class="col-md-6">
                                    <label class="small text-muted mb-1">Kategori</label>
                                    <p class="fw-semibold mb-0"><span
                                            class="badge bg-light text-primary">{{ $letter->category ?? 'General' }}</span>
                                    </p>
                                </div>
                                <div class="col-md-6">
                                    <label class="small text-muted mb-1">File</label>
                                    <p class="mb-0">
                                        @if($letter->file)
                                            <a href="{{ asset('outgoing_letters/' . $letter->file) }}" target="_blank"
                                                class="text-decoration-none small">
                                                <i class="ti ti-download me-1"></i> Download Original
                                            </a>
                                        @else
                                            <span class="text-muted small">No file attached</span>
                                        @endif
                                    </p>
                                </div>
                            </div>

                            @if($letter->file)
                                <div class="rounded-3 border overflow-hidden bg-light" style="height: 500px;">
                                    @php
                                        $extension = pathinfo($letter->file, PATHINFO_EXTENSION);
                                        $filePath = asset('outgoing_letters/' . $letter->file);
                                    @endphp

                                    @if (in_array(strtolower($extension), ['jpg', 'jpeg', 'png', 'gif', 'webp']))
                                        <div class="h-100 d-flex align-items-center justify-content-center p-3">
                                            <img src="{{ $filePath }}" class="img-fluid rounded shadow-sm"
                                                style="max-height: 100%;">
                                        </div>
                                    @elseif (strtolower($extension) === 'pdf')
                                        <iframe src="{{ $filePath }}#toolbar=0" width="100%" height="100%"
                                            style="border: none;"></iframe>
                                    @else
                                        <div class="h-100 d-flex flex-column align-items-center justify-content-center text-muted">
                                            <i class="ti ti-file-description fs-1 mb-2"></i>
                                            <p>{{ strtoupper($extension) }} file cannot be previewed directly.</p>
                                        </div>
                                    @endif
                                </div>
                            @endif
                        </div>
                        <div class="modal-footer border-0 pt-0">
                            <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                            <a href="{{ route('outgoingletters.show', $letter->id) }}" class="btn btn-primary">View More
                                Info</a>
                        </div>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-12">
                <div class="alert alert-info d-flex align-items-center rounded-4 shadow-sm" role="alert">
                    <i class="ti ti-info-circle fs-5 me-2"></i>
                    <div>No data available.</div>
                </div>
            </div>
        @endforelse
    </div>

    {{-- Pagination --}}
    <div class="d-flex justify-content-center mt-5">
        {{-- Tambahin appends biar search tetap keikut waktu pindah halaman --}}
        {{ $outgoingletters->appends(['search' => request('search')])->links('pagination::bootstrap-5') }}
    </div>
</x-app-layout>
