<x-app-layout>
    <x-page-title>Detail Barang Inventaris</x-page-title>

    <div class="bg-white rounded-4 shadow-sm p-4 mb-4">
        <div class="d-flex align-items-center mb-4 pb-3 border-bottom">
            <i class="ti ti-package fs-2 text-primary me-3"></i>
            <div>
                <h5 class="fw-bold text-dark mb-0">Informasi Barang</h5>
                <p class="text-muted small mb-0">Detail lengkap barang inventaris koperas</p>
            </div>
        </div>

        <div class="row g-4">
            <div class="col-md-6">
                <div class="p-3 rounded-3 bg-light border">
                    <label class="form-label fw-bold text-muted small text-uppercase mb-1">Nama Barang</label>
                    <div class="fs-5 fw-semibold text-dark">{{ $inventory->nama_barang }}</div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="p-3 rounded-3 bg-light border">
                    <label class="form-label fw-bold text-muted small text-uppercase mb-1">Tanggal Pembelian</label>
                    <div class="fs-5 fw-semibold text-dark">
                        {{ \Carbon\Carbon::parse($inventory->tanggal)->format('d F Y') }}
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="p-3 rounded-3 bg-light border">
                    <label class="form-label fw-bold text-muted small text-uppercase mb-1">Jumlah</label>
                    <div class="fs-5 fw-semibold text-dark">{{ $inventory->jumlah }}</div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="p-3 rounded-3 bg-light border">
                    <label class="form-label fw-bold text-muted small text-uppercase mb-1">Harga Satuan</label>
                    <div class="fs-5 fw-semibold text-primary">Rp
                        {{ number_format($inventory->harga_satuan, 0, ',', '.') }}
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="p-3 rounded-3 bg-light border">
                    <label class="form-label fw-bold text-muted small text-uppercase mb-1">Total Harga</label>
                    <div class="fs-5 fw-bold text-success">Rp
                        {{ number_format($inventory->jumlah_rupiah, 0, ',', '.') }}
                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="p-3 rounded-3 bg-light border">
                    <label class="form-label fw-bold text-muted small text-uppercase mb-1">Umur Teknis</label>
                    <div class="fs-5 fw-semibold text-dark">{{ $inventory->umur_teknis }} Tahun</div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="p-3 rounded-3 bg-light border">
                    <label class="form-label fw-bold text-muted small text-uppercase mb-1">Umur Ekonomis</label>
                    <div class="fs-5 fw-semibold text-dark">{{ $inventory->umur_ekonomis }} Tahun</div>
                </div>
            </div>

            <div class="col-12">
                <div class="p-3 rounded-3 bg-light border">
                    <label class="form-label fw-bold text-muted small text-uppercase mb-1">Keterangan</label>
                    <div class="text-dark">{{ $inventory->keterangan ?: 'Tidak ada keterangan.' }}</div>
                </div>
            </div>
        </div>

        <div class="pt-4 mt-4 d-flex justify-content-between border-top">
            <a href="{{ route('inventories.index') }}"
                class="btn btn-light px-4 border rounded-3 text-dark d-flex align-items-center">
                <i class="ti ti-arrow-left me-2"></i> Kembali
            </a>
            <div class="d-flex gap-2">
                <a href="{{ route('inventories.edit', $inventory->id) }}"
                    class="btn btn-warning px-4 rounded-3 d-flex align-items-center text-white">
                    <i class="ti ti-edit me-2"></i> Edit Data
                </a>
            </div>
        </div>
    </div>
</x-app-layout>