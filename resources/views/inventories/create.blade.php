<x-app-layout>
    {{-- Page Title --}}
    <x-page-title>Tambah Barang Inventaris</x-page-title>

    <div class="bg-white rounded-4 shadow-sm p-4 mb-4">
        <form action="{{ route('inventories.store') }}" method="POST">
            @csrf

            <div class="row">
                {{-- Nama Barang --}}
                <div class="col-xl-6">
                    <div class="mb-3 pe-xl-3">
                        <label class="form-label">Nama Barang <span class="text-danger">*</span></label>
                        <input type="text" name="nama_barang"
                            class="form-control @error('nama_barang') is-invalid @enderror"
                            value="{{ old('nama_barang') }}">
                        @error('nama_barang')
                            <div class="alert alert-danger mt-2">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                {{-- Tanggal Pembelian --}}
                <div class="col-xl-6">
                    <div class="mb-3 ps-xl-3">
                        <label class="form-label">Tanggal Pembelian</label>
                        <input type="date" name="tanggal" class="form-control @error('tanggal') is-invalid @enderror"
                            value="{{ old('tanggal') }}">
                        @error('tanggal')
                            <div class="alert alert-danger mt-2">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>

            <hr class="text-body-tertiary mb-4-2">

            <div class="row">
                {{-- Jumlah --}}
                <div class="col-xl-6">
                    <div class="mb-3 pe-xl-3">
                        <label class="form-label">Jumlah <span class="text-danger">*</span></label>
                        <div class="input-group">
                            <input type="number" id="jumlah" name="jumlah_value"
                                class="form-control @error('jumlah_value') is-invalid @enderror"
                                value="{{ old('jumlah_value') }}" placeholder="0" min="0" step="any">
                            <select name="satuan" class="form-select @error('satuan') is-invalid @enderror"
                                style="max-width: 120px;">
                                <option value="m" {{ old('satuan') == 'm' ? 'selected' : '' }}>m</option>
                                <option value="kg" {{ old('satuan') == 'kg' ? 'selected' : '' }}>kg</option>
                                <option value="kw" {{ old('satuan') == 'kw' ? 'selected' : '' }}>kw</option>
                                <option value="buah" {{ old('satuan') == 'buah' ? 'selected' : '' }}>buah</option>
                                <option value="unit" {{ old('satuan') == 'unit' ? 'selected' : '' }}>unit</option>
                                <option value="set" {{ old('satuan') == 'set' ? 'selected' : '' }}>set</option>
                            </select>
                        </div>
                        @error('jumlah_value')
                            <div class="alert alert-danger mt-2">{{ $message }}</div>
                        @enderror
                        @error('satuan')
                            <div class="alert alert-danger mt-2">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Harga Satuan --}}
                    <div class="mb-3 pe-xl-3">
                        <label class="form-label">Harga Satuan (Rp)</label>
                        <input type="number" id="harga_satuan" step="0.01" name="harga_satuan"
                            class="form-control @error('harga_satuan') is-invalid @enderror"
                            value="{{ old('harga_satuan') }}">
                        @error('harga_satuan')
                            <div class="alert alert-danger mt-2">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Total Harga --}}
                    <div class="mb-3 pe-xl-3">
                        <label class="form-label">Total Harga (Rp)</label>
                        <input type="number" id="jumlah_rupiah" step="0.01" name="jumlah_rupiah"
                            class="form-control @error('jumlah_rupiah') is-invalid @enderror"
                            value="{{ old('jumlah_rupiah') }}" readonly>
                        @error('total_harga')
                            <div class="alert alert-danger mt-2">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                {{-- Umur Teknis & Ekonomis --}}
                <div class="col-xl-6">
                    <div class="mb-3 ps-xl-3">
                        <label class="form-label">Umur Teknis</label>
                        <input type="text" name="umur_teknis"
                            class="form-control @error('umur_teknis') is-invalid @enderror"
                            value="{{ old('umur_teknis') }}">
                        @error('umur_teknis')
                            <div class="alert alert-danger mt-2">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3 ps-xl-3">
                        <label class="form-label">Umur Ekonomis</label>
                        <input type="text" name="umur_ekonomis"
                            class="form-control @error('umur_ekonomis') is-invalid @enderror"
                            value="{{ old('umur_ekonomis') }}">
                        @error('umur_ekonomis')
                            <div class="alert alert-danger mt-2">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3 ps-xl-3">
                        <label class="form-label">Keterangan</label>
                        <textarea name="keterangan" rows="3"
                            class="form-control @error('keterangan') is-invalid @enderror">{{ old('keterangan') }}</textarea>
                        @error('keterangan')
                            <div class="alert alert-danger mt-2">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>

            <div class="pt-4 pb-2 mt-5 border-top">
                <div class="d-grid gap-3 d-sm-flex justify-content-md-start pt-1">
                    <button type="submit" class="btn btn-primary btn-action">Simpan</button>
                    <a href="{{ route('inventories.index') }}" class="btn btn-secondary btn-action">Batal</a>
                </div>
            </div>
        </form>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const jumlahInput = document.getElementById('jumlah');
            const hargaInput = document.getElementById('harga_satuan');
            const totalInput = document.getElementById('jumlah_rupiah');

            function calculateTotal() {
                const jumlah = parseFloat(jumlahInput.value) || 0;
                const harga = parseFloat(hargaInput.value) || 0;
                totalInput.value = (jumlah * harga).toFixed(2);
            }

            jumlahInput.addEventListener('input', calculateTotal);
            hargaInput.addEventListener('input', calculateTotal);
        });
    </script>
</x-app-layout>