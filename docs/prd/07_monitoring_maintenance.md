# 🛡️ PRD 07: Monitoring, Maintenance & Cutover Plan

## 1. Pemantauan Error Otomatis (Sentry Cloud Integration)

Sistem SIMKODES terintegrasi penuh dengan **Sentry Cloud** untuk menangkap crash, unhandled exceptions, dan degradasi performa secara *real-time*.

### A. Konfigurasi
- **Package**: `sentry/sentry-laravel` (`^4.29`).
- **Registrasi**: Didaftarkan pada [bootstrap/app.php](file:///c:/code/sranak/simkodes/bootstrap/app.php):
  ```php
  ->withExceptions(function (Exceptions $exceptions) {
      Integration::handles($exceptions);
  })
  ```
- **Koneksi DSN**: Menggunakan environment variable `SENTRY_LARAVEL_DSN`.
- **Status Integrasi**: Terverifikasi melalui perintah `php artisan sentry:test` dan sukses mencatat issue [SIMKODES-1](https://self-6os.sentry.io/issues/7844312852/) pada dashboard Sentry.

---

## 2. Pemantauan Uptime Otomatis ([monitoring.yml](file:///c:/code/sranak/simkodes/.github/workflows/monitoring.yml))

- **Jadwal Eksekusi**: Berjalan secara terjadwal setiap 6 jam (`cron: '0 */6 * * *'`) atau trigger manual via GitHub Actions.
- **Endpoint yang Dipantau**:
  - **Staging**: `https://simkodes-staging.sranak.com` (terautentikasi otomatis via secrets Basic Auth).
  - **Production**: `https://simkodes.sranak.com`.
- **Threshold**: Memvalidasi status code HTTP 200–399. Status di luar range tersebut memunculkan warning dan laporan status di GitHub Step Summary.

---

## 3. Prosedur Maintenance Mode Terstandarisasi ([maintenance.yml](file:///c:/code/sranak/simkodes/.github/workflows/maintenance.yml))

SIMKODES menyediakan kontrol mode pemeliharaan otomatis melalui GitHub Actions `workflow_dispatch` tanpa perlu login manual ke terminal SSH server:

### A. Opsi Workflow Maintenance
- **Target**: Pilihan antara `staging` atau `production`.
- **Aksi**:
  - `down`: Mengaktifkan mode pemeliharaan dengan `php artisan down --render="errors.503" --secret="SECRET" --retry=3600`.
  - `up`: Menonaktifkan mode pemeliharaan dan membawa aplikasi kembali online dengan `php artisan up`.
- **Branded Template 503**: Menyajikan tampilan khusus bertema SIMKODES Navy ([503.blade.php](file:///c:/code/sranak/simkodes/resources/views/errors/503.blade.php)) dengan stylesheet eksternal [public/css/errors.css](file:///c:/code/sranak/simkodes/public/css/errors.css), animasi roda berputar, dan penghitung waktu mundur auto-refresh 30 detik.
- **Bypass Token**: Memungkinkan developer/pengurus koperasi membuka aplikasi saat maintenance melalui query parameter khusus:
  `https://simkodes.sranak.com/?secret=simkodes-secret-bypass`

---

## 4. Pencadangan Database Terjadwal ([backup.yml](file:///c:/code/sranak/simkodes/.github/workflows/backup.yml))

- **Jadwal Eksekusi**: Otomatis setiap Minggu pukul 02:00 UTC (09:00 WIB) atau dipicu manual.
- **Mekanisme**:
  1. SSH ke server Hostinger dan membaca kredensial database langsung dari `.env` aktif.
  2. Menjalankan `mysqldump --single-transaction --quick | gzip`.
  3. Mengunduh file `.sql.gz` ke GitHub Actions runner.
  4. Menyimpan dump ke GitHub Actions Artifacts via step output resmi (`steps.dump.outputs.filename`) dengan masa retensi **30 hari**.

---

## 5. Status Cutover ke Server Production (Go-Live Status)

> [!NOTE]
> **Status Deployment Production: SELESAI & LIVE (COMPLETED).**
> Server live production (`https://simkodes.sranak.com`) telah berhasil dimigrasikan dari format folder lama `core/` ke struktur modern `/public_html/simkodes/` dengan jaminan **Zero Data Loss** (Database `u849825724_kdmp` dan berkas pengguna tetap utuh 100%).

### Riwayat Eksekusi Rilis Produksi:
1. **Pre-Deployment Safety Snapshot**: Berhasil mengekstrak arsip database `u849825724_kdmp` terkompresi sebelum sinkronisasi kode.
2. **Migrasi Struktur Web Root**: Direktori kerja server aktif di `/home/u849825724/domains/sranak.com/public_html/simkodes/` dengan Document Root hPanel Hostinger yang telah diarahkan secara presisi.
3. **Penyempurnaan Notifikasi & UI**: Menghapus tombol akun bypass staging dan mengganti seluruh popup SweetAlert2 dengan Modal Native Bootstrap 5 terintegrasi.
4. **Verifikasi Operasional**: Endpoint `https://simkodes.sranak.com/login` mengembalikan status **HTTP 200 OK** dengan SSL terverifikasi dan sesi aman.
