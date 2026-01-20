<x-app-layout>
    <x-page-title>Edit Barang Inventaris</x-page-title>

    <div class="bg-white rounded-4 shadow-sm p-4">
        <form action="{{ route('inventories.update', $inventory->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label class="form-label">Nama Barang</label>
                <input type="text" name="nama_barang" class="form-control"
                    value="{{ old('nama_barang', $inventory->nama_barang) }}" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Tanggal</label>
                <input type="date" name="tanggal" class="form-control"
                    value="{{ old('tanggal', $inventory->tanggal) }}">
            </div>

            @php
                // Pisahkan nilai angka dan satuan dari field jumlah yang bertipe string
                $rawJumlah = $inventory->jumlah;
                preg_match('/^([\d\.]+)\s*(.*)$/', $rawJumlah, $matches);
                $jumlahValue = isset($matches[1]) ? $matches[1] : $rawJumlah;
                $satuanValue = isset($matches[2]) ? trim($matches[2]) : '';

                // Jika satuan kosong, default ke 'buah' atau biarkan m/kg/kw/buah/unit/set
                $allowedSatuan = ['m', 'kg', 'kw', 'buah', 'unit', 'set'];
                if (!in_array($satuanValue, $allowedSatuan) && !empty($satuanValue)) {
                    // Jika ada satuan tapi tidak di list, kita tampilkan saja nanti sebagai teks atau abaikan sementara
                }
            @endphp

            <div class="row">
                <div class="col-md-6 mb-3">
                    <label class="form-label">Jumlah <span class="text-danger">*</span></label>
                    <div class="input-group">
                        <input type="number" id="jumlah" name="jumlah_value" class="form-control"
                            value="{{ old('jumlah_value', $jumlahValue) }}" step="any" required>
                        <select name="satuan" class="form-select" style="max-width: 120px;">
                            <option value="m" {{ old('satuan', $satuanValue) == 'm' ? 'selected' : '' }}>m</option>
                            <option value="kg" {{ old('satuan', $satuanValue) == 'kg' ? 'selected' : '' }}>kg</option>
                            <option value="kw" {{ old('satuan', $satuanValue) == 'kw' ? 'selected' : '' }}>kw</option>
                            <option value="buah" {{ old('satuan', $satuanValue) == 'buah' ? 'selected' : '' }}>buah
                            </option>
                            <option value="unit" {{ old('satuan', $satuanValue) == 'unit' ? 'selected' : '' }}>unit
                            </option>
                            <option value="set" {{ old('satuan', $satuanValue) == 'set' ? 'selected' : '' }}>set</option>
                        </select>
                    </div>
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label">Harga Satuan (Rp)</label>
                    <input type="number" id="harga_satuan" name="harga_satuan" class="form-control"
                        value="{{ old('harga_satuan', $inventory->harga_satuan) }}">
                </div>
            </div>

            <div class="mb-3">
                <label class="form-label">Total Harga (Rp)</label>
                <input type="number" id="jumlah_rupiah" name="jumlah_rupiah" class="form-control"
                    value="{{ old('jumlah_rupiah', $inventory->jumlah_rupiah) }}" readonly>
            </div>

            <div class="row">
                <div class="col-md-6 mb-3">
                    <label class="form-label">Umur Teknis</label>
                    <input type="text" name="umur_teknis" class="form-control"
                        value="{{ old('umur_teknis', $inventory->umur_teknis) }}">
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label">Umur Ekonomis</label>
                    <input type="text" name="umur_ekonomis" class="form-control"
                        value="{{ old('umur_ekonomis', $inventory->umur_ekonomis) }}">
                </div>
            </div>

            <div class="mb-3">
                <label class="form-label">Keterangan</label>
                <textarea name="keterangan" class="form-control"
                    rows="3">{{ old('keterangan', $inventory->keterangan) }}</textarea>
            </div>

            <div class="d-flex justify-content-between">
                <a href="{{ route('inventories.index') }}" class="btn btn-secondary">Kembali</a>
                <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
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