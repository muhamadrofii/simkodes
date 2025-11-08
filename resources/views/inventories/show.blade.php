<x-app-layout>
    <x-page-title>Detail Barang Inventaris</x-page-title>

    <div class="bg-white rounded-4 shadow-sm p-4 mb-4">
        <h5 class="fw-semibold text-secondary mb-4">Informasi Barang</h5>

        <div class="row">
            <div class="col-md-6 mb-3">
                <label class="form-label fw-semibold">Nama Barang</label>
                <div class="form-control bg-light">{{ $inventory->nama_barang }}</div>
            </div>

            <div class="col-md-6 mb-3">
                <label class="form-label fw-semibold">Tanggal Pembelian</label>
                <div class="form-control bg-light">{{ $inventory->tanggal }}</div>
            </div>

            <div class="col-md-6 mb-3">
                <label class="form-label fw-semibold">Jumlah</label>
                <div class="form-control bg-light">{{ $inventory->jumlah }}</div>
            </div>

            <div class="col-md-6 mb-3">
                <label class="form-label fw-semibold">Harga Satuan (Rp)</label>
                <div class="form-control bg-light">{{ number_format($inventory->harga_satuan, 0, ',', '.') }}</div>
            </div>

            <div class="col-md-6 mb-3">
                <label class="form-label fw-semibold">Total Harga (Rp)</label>
                <div class="form-control bg-light">{{ number_format($inventory->total_harga, 0, ',', '.') }}</div>
            </div>

            <div class="col-md-6 mb-3">
                <label class="form-label fw-semibold">Umur Teknis</label>
                <div class="form-control bg-light">{{ $inventory->umur_teknis }}</div>
            </div>

            <div class="col-md-6 mb-3">
                <label class="form-label fw-semibold">Umur Ekonomis</label>
                <div class="form-control bg-light">{{ $inventory->umur_ekonomis }}</div>
            </div>

            <div class="col-12 mb-3">
                <label class="form-label fw-semibold">Keterangan</label>
                <div class="form-control bg-light">{{ $inventory->keterangan }}</div>
            </div>
        </div>

        <div class="pt-3 border-top">
            <a href="{{ route('inventories.index') }}" class="btn btn-secondary">← Kembali</a>
        </div>
    </div>
</x-app-layout>
