# 📋 PRD 01: Product Overview & Business Scope

## 1. Latar Belakang & Visi Produk
**SIMKODES (Sistem Informasi Manajemen Koperasi Desa Sranak)** adalah platform web terpadu yang dirancang untuk mendigitalkan seluruh administrasi operasional Koperasi Merah Putih di Desa Sranak. 

Tujuan utama sistem:
- Menghilangkan pencatatan manual berbasis kertas yang rentan hilang dan rusak.
- Meningkatkan transparansi data keanggotaan, inventaris barang, persuratan dinas, dan penyaluran subsidi desa.
- Menyediakan pelaporan otomatis (ekspor PDF & Excel) dan penerbitan Kartu Tanda Anggota (KTA) digital.

---

## 2. Aktor & Hak Akses Pengguna (Roles)

| Aktor / Peran | Tanggung Jawab & Ruang Lingkup Akses |
| :--- | :--- |
| **Administrator Koperasi** | Akses penuh (*Full Control*): Pengelolaan akun pengguna, seluruh master data anggota, struktur kepengurusan, persuratan, inventaris, verifikasi klaim subsidi, dan ekspor laporan. |
| **Pengurus Koperasi** | Mengelola kegiatan operasional harian: Input data anggota baru, pencatatan surat masuk/keluar, penerbitan KTA, dan pencatatan buku inventaris. |
| **Dewan Pengawas** | Akses pengawasan & pelaporan: Melihat rekapitulasi data anggota, monitoring inventaris, audit penerima bantuan subsidi, dan download laporan keuangan/inventaris. |
| **Publik / Tamu (Guest)** | Akses terbatas: Landing page profil koperasi Desa Sranak (`/`) tanpa izin membuka dashboard administrasi. |

---

## 3. Ruang Lingkup Modul Fungsional (Feature Modules)

### A. Modul Autentikasi & Sesi
- Login multi-user dengan validasi kredensial aman (`bcrypt`).
- Middleware `CheckSessionTimeout` untuk mengunci sesi otomatis jika pengguna tidak aktif melebihi 7200 detik (2 jam).
- Proteksi route dashboard terhadap akses ilegal tanpa autentikasi.

### B. Modul Master Data Anggota (Members)
- Pencatatan biodata lengkap anggota (Nama, NIK, Jenis Kelamin, Usia, Pekerjaan, Alamat, Tanggal Masuk/Keluar).
- Penyimpanan foto profil anggota, tanda tangan digital (TTD), dan cap ibu jari.
- Generator dokumen **Kartu Tanda Anggota (KTA) PDF** siap cetak menggunakan DomPDF dengan logo resmi dan kop surat desa.

### C. Modul Kepengurusan & Dewan Pengawas
- Pencatatan susunan Pengurus (`officers`) dan Dewan Pengawas (`supervisors`).
- Riwayat tanggal pengangkatan, masa jabatan, foto resmi, dan TTD digital.
- Fitur cetak KTA Pengurus dan KTA Pengawas.

### D. Modul Persuratan Dinas (Letters Management)
- **Surat Masuk (`IncomingLetter`)**: Pencatatan perihal/judul, nomor surat, instansi pengirim, kategori surat, dan arsip berkas digital (PDF/Docx).
- **Surat Keluar (`OutgoingLetter`)**: Pencatatan nomor surat keluar resmi, tujuan/instansi penerima, kategori, dan upload salinan berkas fisik.

### E. Modul Buku Inventaris Barang (Inventory)
- Pencatatan aset koperasi: Kode/nama barang, tanggal pengadaan, jumlah unit, satuan, harga per unit, kalkulasi otomatis total nilai aset (`jumlah_rupiah`), umur teknis, dan kondisi barang.
- **Ekspor Dokumen**:
  - Ekspor seluruh buku inventaris ke file **PDF** siap cetak.
  - Ekspor data tabel inventaris ke spreadsheet **Excel (.xlsx)** via Maatwebsite Excel.

### F. Modul Penyaluran & Verifikasi Subsidi
- Pendataan program bantuan/subsidi desa per tahun dan periode anggaran.
- Pencatatan klaim penerima subsidi berbasis NIK kepala keluarga.
- Laporan rekapitulasi realisasi penyaluran dana subsidi.

### G. Modul Laporan Rekapitulasi Umum (Reports)
- Filter data transaksi dan keanggotaan berdasarkan rentang tanggal fleksibel (`start_date` s/d `end_date`).
- Halaman cetak laporan rekapitulasi komprehensif.

