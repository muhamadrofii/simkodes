<x-app-layout>
    {{-- Page Title --}}
    <x-page-title>Kategori</x-page-title>

    <div class="bg-white rounded-4 shadow-sm p-4 mb-5">
        <div class="row">
            <div class="d-grid d-lg-block col-lg-5 col-xl-6 mb-4 mb-lg-0">
                {{-- button form add data --}}
                <a href="{{ route('categories.create') }}" class="btn btn-primary btn-action-icon">
                    <i class="ti ti-plus me-2"></i> Tambah Kategori
                </a>
            </div>
            <div class="col-lg-7 col-xl-6">
                {{-- form pencarian --}}
                <form action="{{ route('categories.index') }}" method="GET">
                    <div class="input-group">
                        <input type="text" name="search" class="form-control form-search"
                            value="{{ request('search') }}" placeholder="Search category ..." autocomplete="off">
                        <button class="btn btn-primary btn-search" type="submit">Cari</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="row mb-4">
        @forelse ($categories as $category)
            {{-- jika data ada, tampilkan data --}}
            <div class="col-lg-6 col-xl-3">
                <div class="bg-white rounded-4 shadow-sm text-center p-4 p-lg-4-2 mb-4">
                    <div class="mb-2">
                        <img src="{{ asset('category_images/' . $category->image) }}" class="img-thumbnail rounded-5"
                            width="80" alt="Images">
                    </div>
                    <p class="text-muted mb-2"><small>Kategori</small></p>
                    <h6 class="mb-4">{{ $category->name }}</h6>
                    {{-- button form detail data --}}
                    <a href="{{ route('categories.show', $category->id) }}" class="btn btn-primary btn-action-icon">
                        Detail <i class="ti ti-chevron-right ms-2"></i>
                    </a>
                </div>
            </div>
        @empty
            {{-- jika data tidak ada, tampilkan pesan data tidak tersedia --}}
            <div class="col">
                <div class="alert alert-primary rounded-4 d-flex align-items-center" role="alert">
                    <i class="ti ti-info-circle fs-5 me-2"></i>
                    <div>Tidak Ada Data.</div>
                </div>
            </div>
        @endforelse
    </div>

    {{-- pagination --}}
    <div class="pagination-links mb-4">{{ $categories->links() }}</div>
</x-app-layout>