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

## 2. Prosedur Maintenance Mode Terstandarisasi (Graceful 503)

Ketika pengurus atau developer perlu melakukan pembaruan besar pada server Production tanpa memunculkan halaman error 500 kepada publik:

### A. Mengaktifkan Mode Pemeliharaan dengan Secret Bypass
```bash
php artisan down --secret="simkodes-secret-bypass" --render="errors::503"
```
- **Pengunjung Umum**: Melihat halaman ramah *"Sistem Sedang Dalam Pemeliharaan Berkala"*.
- **Developer / Tim Administrator**: Tetap dapat mengakses dan menguji aplikasi web secara normal melalui URL bypass khusus:  
  `https://sranak.com/simkodes-secret-bypass`

### B. Menonaktifkan Mode Pemeliharaan (Live Kembali)
```bash
php artisan up
```

---

## 3. Pemeliharaan Rutin Terjadwal (Automated Maintenance)

Untuk menjaga performa database dan filesystem tidak membengkak seiring waktu:

| Perintah Pemeliharaan | Fungsi & Tujuan | Jadwal Rutin |
| :--- | :--- | :--- |
| `php artisan sanctum:prune-expired` | Menghapus token API Sanctum yang sudah kadaluarsa. | Harian (00:00) |
| `php artisan auth:clear-resets` | Membersihkan token reset password yang kedaluwarsa. | Harian (01:00) |
| `php artisan log:clear` / Rotasi Harian | Mencegah file `laravel.log` berukuran gigabyte. | Rotasi `daily` (14 hari) |

---

## 4. Rencana Cutover ke Server Production (Go-Live Roadmap)

Sebelum menimpa versi lama di direktori live `public_html/simkodes/`, lakukan langkah cutover berurutan berikut:

1. **Full Backup Database Lama**:
   - Buka cPanel Hostinger $\rightarrow$ phpMyAdmin $\rightarrow$ Export database lama ke file `.sql` lokal.
2. **Setup Staging Verification**:
   - Pastikan seluruh pengujian manual di `https://simkodes-staging.sranak.com` telah dinyatakan siap oleh tim koperasi.
3. **Penyusunan Workflow `deploy-production.yml`**:
   - Menggunakan konfigurasi yang serupa dengan staging, diarahkan ke folder live `public_html/simkodes/` tanpa Basic Auth.
4. **Eksekusi Caching Produksi**:
   ```bash
   php artisan optimize
   ```
5. **Verifikasi Pasif Pasca-Rilis**:
   - Pantau dashboard Sentry Cloud selama 30 menit pertama untuk memastikan tidak ada lonjakan unhandled exception.
