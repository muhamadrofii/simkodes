<x-app-layout>
    {{-- Page Title --}}
    <x-page-title>Data Anggota</x-page-title>

    <div class="bg-white rounded-4 shadow-sm p-4 mb-5">
        <div class="row">
            <div class="d-grid d-lg-block col-lg-5 col-xl-6 mb-4 mb-lg-0">
                {{-- button form add data --}}
                <a href="{{ route('members.create') }}" class="btn btn-primary btn-action-icon">
                    <i class="ti ti-plus me-2"></i> Tambah Data Anggota
                </a>
            </div>
            <div class="col-lg-7 col-xl-6">
                {{-- form pencarian --}}
                <form action="{{ route('members.index') }}" method="GET">
                    <div class="input-group">
                        <input type="text" name="search" class="form-control form-search" 
                               value="{{ request('search') }}" placeholder="Cari nama anggota ..." autocomplete="off">
                        <button class="btn btn-primary btn-search" type="submit">Cari</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="row mb-4">
        @forelse ($members as $member)
            {{-- jika data ada, tampilkan data --}}
            <div class="col-lg-6 col-xl-3">
                <div class="bg-white rounded-4 shadow-sm text-center p-4 mb-4">
                    {{-- <div class="mb-4">
                        @if ($member->ttd)
                            <img src="{{ asset('storage/members/' . $member->ttd) }}" 
                                 class="img-thumbnail rounded-5" width="110" alt="Tanda Tangan">
                        @elseif ($member->cap_ibu_jari)
                            <img src="{{ asset('storage/members/' . $member->cap_ibu_jari) }}" 
                                 class="img-thumbnail rounded-5" width="110" alt="Cap Ibu Jari">
                        @else
                            <img src="{{ asset('storage/public/members/') }}" 
                                 class="img-thumbnail rounded-5" width="110" alt="Default">
                        @endif
                    </div> --}}

                    <h6>{{ $member->nama }}</h6>
                    <p class="text-muted mb-4">
                        Jenis: {{ $member->category->name ?? 'Tidak Ada Kategori' }}
                    </p>

                    {{-- button detail --}}
                    <a href="{{ route('members.show', $member->id) }}" 
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
                    <div>Tidak Ada Data Anggota.</div>
                </div>
            </div>
        @endforelse
    </div>

    {{-- pagination --}}
    <div class="pagination-links mb-4">
        {{ $members->links() }}
    </div>
</x-app-layout>
