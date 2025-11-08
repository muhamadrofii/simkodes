<x-app-layout>
    {{-- Page Title --}}
    <x-page-title>Detail Kategori</x-page-title>

    <div class="bg-white rounded-4 shadow-sm p-4 mb-5">
        <div class="d-grid gap-3 d-sm-flex flex-sm-row-reverse">
            <div class="d-grid gap-3 d-sm-flex">
                {{-- button form edit data --}}
                <a href="{{ route('categories.edit', $category->id) }}" class="btn btn-primary btn-action-icon">
                    <i class="ti ti-edit me-2"></i> Edit
                </a>
                {{-- button modal hapus data --}}
                <button type="button" class="btn btn-danger btn-action-icon" data-bs-toggle="modal" data-bs-target="#modalDelete{{ $category->id }}"> 
                    <i class="ti ti-trash me-2"></i> Hapus
                </button>
            </div>
            {{-- button kembali ke halaman index --}}
            <a href="{{ route('categories.index') }}" class="btn btn-secondary btn-action-icon me-sm-auto">
                <i class="ti ti-chevron-left me-2"></i> Tutup
            </a>
        </div>
    </div>

    <div class="bg-white rounded-4 shadow-sm p-4 mb-4">
        {{-- tampilkan detail data --}}
        <div class="d-flex flex-column flex-xl-row">
            <div class="flex-shrink-0 mb-4 mb-xl-0">
                <img src="{{ asset('/storage/public/categories/'.$category->image) }}" class="img-thumbnail rounded-5 shadow-sm" width="100" alt="Image">
            </div>
            <div class="flex-grow-1 pt-2 ms-xl-4">
                <h6 class="text-muted fw-light mb-2">Nama</h6>
                <p class="mb-4">{{ $category->name }}</p>
            
                <h6 class="text-muted fw-light mb-2">Deskripsi</h6>
                <p style="text-align: justify" class="mb-4 fw-light">{{ $category->description }}</p>
            </div>
        </div>
    </div>

    {{-- Modal hapus data --}}
    <div class="modal fade" id="modalDelete{{ $category->id }}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="modalDeleteLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">
                        <i class="ti ti-trash me-2"></i> Hapus Kategori
                    </h1>
                </div>
                <div class="modal-body">
                    {{-- informasi data yang akan dihapus --}}
                    <p class="mb-2">
                        Anda Akan Menghapus Kategori : <span class="fw-medium mb-2">{{ $category->name }}</span>?
                    </p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary btn-action-icon" data-bs-dismiss="modal">Batal</button>
                    {{-- button hapus data --}}
                    <form action="{{ route('categories.destroy', $category->id) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-action-icon"> Ya, Hapus ini ! </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>