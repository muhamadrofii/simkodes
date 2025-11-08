<x-app-layout>
    {{-- Page Title --}}
    <x-page-title>Edit Category</x-page-title>

    <div class="bg-white rounded-4 shadow-sm p-4 mb-4">
        {{-- form edit data --}}
        <form action="{{ route('categories.update', $category->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="row">
                <div class="col-xl-8">
                    <div class="mb-3 pe-xl-3">
                        <label class="form-label">Nama Kategori <span class="text-danger">*</span></label>
                        <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name', $category->name) }}" autocomplete="off">
                        
                        {{-- pesan error untuk name --}}
                        @error('name')
                            <div class="alert alert-danger mt-2">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
        
                    <div class="mb-3 pe-xl-3">
                        <label class="form-label">Deskripsi <span class="text-danger">*</span></label>
                        <textarea name="description" rows="10" class="form-control @error('description') is-invalid @enderror" autocomplete="off">{{ old('description', $category->description) }}</textarea>
                        
                        {{-- pesan error untuk description --}}
                        @error('description')
                            <div class="alert alert-danger mt-2">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                </div>

                <div class="col-xl-4">
                    <div class="mb-3 ps-xl-3">
                        <label class="form-label">Gambar</label>
                        <input type="file" accept=".jpg, .jpeg, .png" name="image" id="image" class="form-control @error('image') is-invalid @enderror" autocomplete="off">
            
                        {{-- pesan error untuk image --}}
                        @error('image')
                            <div class="alert alert-danger mt-2">
                                {{ $message }}
                            </div>
                        @enderror

                        {{-- view image --}}
                        <div class="mt-4 mt-xl-5">
                            <img id="imagePreview" src="{{ asset('/storage/public/categories/'.$category->image) }}" class="img-thumbnail rounded-5 shadow-sm" width="50%" alt="Image">
                        </div>
                    </div>
                </div>
            </div>
    
            <div class="pt-4 pb-2 mt-5 border-top">
                <div class="d-grid gap-3 d-sm-flex justify-content-md-start pt-1">
                    {{-- button update data --}}
                    <button type="submit" class="btn btn-primary btn-action">Edit</button>
                    {{-- button kembali ke halaman detail --}}
                    <a href="{{ route('categories.show', $category->id) }}" class="btn btn-secondary btn-action">Batal</a>
                </div>
            </div>
        </form>
    </div>
</x-app-layout>