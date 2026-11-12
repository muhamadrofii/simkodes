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
  - `down`: Mengaktifkan mode pemeliharaan dengan `php artisan down --secret="SECRET" --retry=3600`.
  - `up`: Menonaktifkan mode pemeliharaan dan membawa aplikasi kembali online dengan `php artisan up`.
- **Bypass Token**: Memungkinkan developer/pengurus koperasi membuka aplikasi saat maintenance melalui query parameter khusus:
  `https://simkodes-staging.sranak.com/?secret=simkodes-secret-bypass`

---

## 4. Pencadangan Database Terjadwal ([backup.yml](file:///c:/code/sranak/simkodes/.github/workflows/backup.yml))

- **Jadwal Eksekusi**: Otomatis setiap Minggu pukul 02:00 UTC (09:00 WIB) atau dipicu manual.
- **Mekanisme**:
  1. SSH ke server Hostinger dan membaca kredensial database langsung dari `.env` aktif.
  2. Menjalankan `mysqldump --single-transaction --quick | gzip`.
  3. Mengunduh file `.sql.gz` ke GitHub Actions runner.
  4. Menyimpan dump ke GitHub Actions Artifacts dengan masa retensi **30 hari**.

---

## 5. Rencana Cutover ke Server Production (Go-Live Roadmap)

Sebelum menimpa versi lama di direktori live `public_html/simkodes/`, ikuti tahapan cutover berurutan berikut:

1. **Jalankan Workflow Backup Database Lama**:
   - Picu workflow [backup.yml](file:///c:/code/sranak/simkodes/.github/workflows/backup.yml) untuk mengarsipkan database saat ini.
2. **Verifikasi Final Staging**:
   - Pastikan seluruh pengujian manual di `https://simkodes-staging.sranak.com` telah disetujui tim koperasi.
3. **Audit Keamanan Terakhir**:
   - Pastikan workflow [security.yml](file:///c:/code/sranak/simkodes/.github/workflows/security.yml) lulus tanpa kerentanan high/critical.
4. **Trigger Deployment Production Terproteksi**:
   - Buka GitHub Actions $\rightarrow$ Workflow **Continuous Deployment - Production**.
   - Masukkan input konfirmasi: `"DEPLOY"`.
   - Workflow akan mengeksekusi rsync ke direktori live `public_html/simkodes/`, migrasi DB live, dan `php artisan optimize`.
5. **Verifikasi Pasif Pasca-Rilis**:
   - Pantau dashboard Sentry Cloud selama 30 menit pertama untuk memastikan zero unhandled exception.
