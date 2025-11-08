<x-app-layout>
    {{-- Page Title --}}
    <x-page-title>Incoming Letters</x-page-title>

    {{-- Section: Add & Search --}}
    <div class="bg-white rounded-4 shadow-sm p-4 mb-5">
        <div class="row align-items-center justify-content-between g-3">
            {{-- Add New Letter Button --}}
            <div class="col-md-6 col-lg-5">
                <a href="{{ route('incomingletters.create') }}" class="btn btn-primary d-flex align-items-center justify-content-center justify-content-md-start w-100 w-md-auto">
                    <i class="ti ti-plus me-2"></i> Tambah Surat Masuk
                </a>
            </div>

            {{-- Search Form --}}
            <div class="col-md-6 col-lg-7">
                <form action="{{ route('incomingletters.index') }}" method="GET" class="d-flex">
                    <input 
                        type="text"
                        name="search"
                        class="form-control rounded-start"
                        placeholder="Search incoming letter..."
                        value="{{ request('search') }}"
                        autocomplete="off">
                    <button class="btn btn-primary rounded-end ms-0" type="submit">
                        Cari
                    </button>
                </form>
            </div>
        </div>
    </div>

    {{-- Section: Letters Grid --}}
    <div class="row g-4">
        @forelse ($incomingletters as $letter)
            <div class="col-12 col-sm-6 col-lg-4 col-xl-3">
                <div class="bg-white rounded-4 shadow-sm p-4 text-center h-100">
                    <div class="mb-3">
                        <i class="ti ti-mail text-primary fs-1"></i>
                    </div>
                    <h6 class="fw-semibold mb-1">{{ $letter->title }}</h6>
                    <p class="text-muted small mb-1">No. Surat {{ $letter->reference_number }}</p>
                    <p class="text-muted small mb-3">Katergoti : {{ $letter->category }}</p>
                    <a href="{{ route('incomingletters.show', $letter->id) }}" class="btn btn-primary btn-sm">
                        Details <i class="ti ti-chevron-right ms-2"></i>
                    </a>
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
        {{ $incomingletters->appends(['search' => request('search')])->links('pagination::bootstrap-5') }}
    </div>
</x-app-layout>
