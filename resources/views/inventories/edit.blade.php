<x-app-layout>
    <x-page-title>✏️ Edit Barang Inventaris</x-page-title>

    <div class="bg-white rounded-4 shadow-sm p-4">
        <form action="{{ route('inventories.update', $inventory->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label class="form-label">Nama Barang</label>
                <input type="text" name="nama_barang" class="form-control" value="{{ old('nama_barang', $inventory->nama_barang) }}" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Tanggal</label>
                <input type="date" name="tanggal" class="form-control" value="{{ old('tanggal', $inventory->tanggal) }}">
            </div>

            <div class="row">
                <div class="col-md-6 mb-3">
                    <label class="form-label">Jumlah</label>
                    <input type="number" name="jumlah" class="form-control" value="{{ old('jumlah', $inventory->jumlah) }}">
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label">Harga Satuan (Rp)</label>
                    <input type="number" name="harga_satuan" class="form-control" value="{{ old('harga_satuan', $inventory->harga_satuan) }}">
                </div>
            </div>

            <div class="row">
                <div class="col-md-6 mb-3">
                    <label class="form-label">Umur Teknis</label>
                    <input type="text" name="umur_teknis" class="form-control" value="{{ old('umur_teknis', $inventory->umur_teknis) }}">
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label">Umur Ekonomis</label>
                    <input type="text" name="umur_ekonomis" class="form-control" value="{{ old('umur_ekonomis', $inventory->umur_ekonomis) }}">
                </div>
            </div>

            <div class="mb-3">
                <label class="form-label">Keterangan</label>
                <textarea name="keterangan" class="form-control" rows="3">{{ old('keterangan', $inventory->keterangan) }}</textarea>
            </div>

            <div class="d-flex justify-content-between">
                <a href="{{ route('inventories.index') }}" class="btn btn-secondary">Kembali</a>
                <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
            </div>
        </form>
    </div>
</x-app-layout>
