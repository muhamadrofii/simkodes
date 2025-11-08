<x-app-layout>
    {{-- Page Title --}}
    <x-page-title>Data Pengurus</x-page-title>

    <div class="bg-white rounded-4 shadow-sm p-4 mb-5">
        <div class="row">
            <div class="d-grid d-lg-block col-lg-5 col-xl-6 mb-4 mb-lg-0">
                {{-- button form add data --}}
                <a href="{{ route('officers.create') }}" class="btn btn-primary btn-action-icon">
                    <i class="ti ti-plus me-2"></i> Tambah Data Pengurus
                </a>
            </div>
            <div class="col-lg-7 col-xl-6">
                {{-- form pencarian --}}
                <form action="{{ route('officers.index') }}" method="GET">
                    <div class="input-group">
                        <input type="text" name="search" class="form-control form-search" 
                               value="{{ request('search') }}" placeholder="Cari nama pengurus ..." autocomplete="off">
                        <button class="btn btn-primary btn-search" type="submit">Cari</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="row mb-4">
        @forelse ($officers as $officer)
            {{-- jika data ada, tampilkan data --}}
            <div class="col-lg-6 col-xl-3">
                <div class="bg-white rounded-4 shadow-sm text-center p-4 mb-4">
                    {{-- <div class="mb-4">
                        @if ($officer->image)
                            <img src="{{ asset('storage/officers/' . $officer->image) }}" 
                                 class="img-thumbnail rounded-5" width="110" alt="Foto Pengurus">
                        @elseif ($officer->ttd)
                            <img src="{{ asset('storage/officers/' . $officer->ttd) }}" 
                                 class="img-thumbnail rounded-5" width="110" alt="Tanda Tangan">
                        @else
                            <img src="{{ asset('images/default.png') }}" 
                                 class="img-thumbnail rounded-5" width="110" alt="Default">
                        @endif
                    </div> --}}

                    <h6>{{ $officer->nama }}</h6>
                    {{-- <p class="text-muted mb-2">
                        Jabatan: {{ $officer->jabatan ?? '-' }}
                    </p> --}}
                    <p class="text-muted mb-4">
                        Kategori: {{ $officer->category->name ?? 'Tidak Ada Kategori' }}
                    </p>

                    {{-- button detail --}}
                    <a href="{{ route('officers.show', $officer->id) }}" 
                       class="btn btn-primary btn-action-icon">
                        Detail <i class="ti ti-chevron-right ms-2"></i>
                    </a>
                </div>
            </div>
        @empty
            {{-- jika data tidak ada --}}
            <div class="col">
                <div class="alert alert-primary rounded-4 d-flex align-items-center" role="alert">
                    <i class="ti ti-info-circle fs-5 me-2"></i>
                    <div>Tidak Ada Data Pengurus.</div>
                </div>
            </div>
        @endforelse
    </div>

    {{-- pagination --}}
    <div class="pagination-links mb-4">
        {{ $officers->links() }}
    </div>
</x-app-layout>
