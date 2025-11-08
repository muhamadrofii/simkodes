<x-app-layout>
    <x-page-title>🗑️ Hapus Barang Inventaris</x-page-title>

    <div class="bg-white rounded-4 shadow-sm p-4">
        <div class="alert alert-warning">
            <strong>Perhatian!</strong> Data berikut akan dihapus secara permanen.
        </div>

        <table class="table table-bordered align-middle">
            <tr><th>Nama Barang</th><td>{{ $inventory->nama_barang }}</td></tr>
            <tr><th>Tanggal</th><td>{{ $inventory->tanggal }}</td></tr>
            <tr><th>Jumlah</th><td>{{ $inventory->jumlah }}</td></tr>
            <tr><th>Harga Satuan</th><td>Rp {{ number_format($inventory->harga_satuan, 0, ',', '.') }}</td></tr>
            <tr><th>Total Harga</th><td>Rp {{ number_format($inventory->total_harga, 0, ',', '.') }}</td></tr>
            <tr><th>Umur Teknis</th><td>{{ $inventory->umur_teknis }}</td></tr>
            <tr><th>Umur Ekonomis</th><td>{{ $inventory->umur_ekonomis }}</td></tr>
            <tr><th>Keterangan</th><td>{{ $inventory->keterangan }}</td></tr>
        </table>

        <form action="{{ route('inventories.destroy', $inventory->id) }}" method="POST" class="mt-3">
            @csrf
            @method('DELETE')
            <div class="d-flex justify-content-between">
                <a href="{{ route('inventories.index') }}" class="btn btn-secondary">Batal</a>
                <button type="submit" class="btn btn-danger">Ya, Hapus</button>
            </div>
        </form>
    </div>
</x-app-layout>
