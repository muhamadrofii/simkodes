# 💾 PRD 06: Database Architecture & Query Optimization

## 1. Arsitektur Skema Database
Sistem SIMKODES menggunakan database relasional **MySQL 8.0** pada server hosting dan **SQLite** pada runner pengujian otomatis (CI).

### Relasi Utama:
- `categories` (1) $\longleftrightarrow$ ($N$) `members`
- `categories` (1) $\longleftrightarrow$ ($N$) `officers`
- `categories` (1) $\longleftrightarrow$ ($N$) `supervisors`
- `subsidy_checks` (Parent Program) $\longleftrightarrow$ ($N$) `subsidy_checks` (Child Klaim/Penerima)

---

## 2. Optimasi Database Indexing ([2026_11_12_101500_add_performance_indexes_to_tables.php](file:///c:/code/sranak/simkodes/database/migrations/2026_11_12_101500_add_performance_indexes_to_tables.php))

Untuk memastikan proses pencarian dan filter data pada ribuan data anggota tetap cepat (*sub-millisecond*), ditambahkan indeks khusus:

| Tabel | Nama Indeks | Kolom yang Diindeks | Tujuan Optimasi |
| :--- | :--- | :--- | :--- |
| `members` | `idx_members_nama` | `nama` | Mempercepat pencarian data anggota berdasarkan nama. |
| `members` | `idx_members_tanggal_masuk` | `tanggal_masuk` | Mempercepat filter laporan rentang tanggal. |
| `inventories` | `idx_inventories_nama_barang`| `nama_barang` | Mempercepat pencarian inventaris aset. |
| `incoming_letters` | `idx_incoming_ref_number` | `reference_number` | Mempercepat lookup nomor surat masuk. |
| `outgoing_letters` | `idx_outgoing_ref_number` | `reference_number` | Mempercepat lookup nomor surat keluar. |

---

## 3. Eliminasi Masalah $N+1$ Query Problem

### Masalah Klasik $N+1$:
Ketika mengambil 50 data anggota dan mengakses relasi kategorinya di Blade/API (`$member->category->name`), Laravel mengeksekusi 1 query untuk mengambil 50 anggota, diikuti **50 query terpisah** untuk setiap kategori. Total = 51 query SQL.

### Solusi Eager Loading Terproyeksi ([MemberController.php](file:///c:/code/sranak/simkodes/app/Http/Controllers/Api/MemberController.php)):
```php
$members = Member::select([
    'id', 'category_id', 'nama', 'umur', 'jenis_kelamin',
    'mata_pencaharian', 'tempat_tinggal', 'tanggal_masuk', 'image'
])->with(['category:id,name'])->latest('id')->paginate(15);
```
Dengan eager loading terproyeksi:
1. **Query 1**: Mengambil data anggota dengan kolom yang spesifik.
2. **Query 2**: Mengambil relasi kategori sekaligus menggunakan klausa `WHERE IN (...)`.
3. Total query yang dieksekusi **tetap 2 query**, berapa pun jumlah anggota yang dimuat.

---

## 4. Proyeksi Kolom Selektif (Menghindari `SELECT *`)
Penggunaan `SELECT *` ditiadakan pada query utama karena kolom seperti berkas biner, tanda tangan digital (TTD), dan teks keterangan berukuran besar tidak selalu dibutuhkan pada tampilan daftar tabel. Proyeksi kolom menghemat alokasi memori RAM PHP dan menurunkan latensi jaringan antara server web dan database server.

---

## 5. Kompatibilitas Multi-Database (MySQL vs SQLite)

### Masalah Fungsi Spesifik Vendor di [DashboardController.php](file:///c:/code/sranak/simkodes/app/Http/Controllers/DashboardController.php):
Query grafik bulanan surat masuk/keluar sebelumnya menggunakan fungsi bawaan MySQL `DATE_FORMAT()`. Saat pengujian dijalankan di SQLite (GitHub Actions CI), server melempar error fatal:  
`no such function: DATE_FORMAT` $\rightarrow$ HTTP 500.

### Solusi Driver-Agnostic Query:
```php
$driver = DB::connection()->getDriverName();
$dateFormatSql = match ($driver) {
    'sqlite' => "strftime('%Y-%m', created_at)",
    'pgsql'  => "to_char(created_at, 'YYYY-MM')",
    default  => "DATE_FORMAT(created_at, '%Y-%m')",
};

$incomingByMonth = IncomingLetter::selectRaw("{$dateFormatSql} as ym, COUNT(*) as total")
    ->whereNotNull('created_at')
    ->where('created_at', '>=', $startMonth->toDateString())
    ->groupBy('ym')
    ->pluck('total', 'ym');
```
Dengan logika di atas, kode berfungsi transparan dan lulus di lingkungan SQLite (CI) maupun MySQL (Server Production).

