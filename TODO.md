# 📋 SIMKODES - Roadmap & Task Board

Dokumen pelacak tugas, pengujian staging, dan persiapan rilis production untuk tim SIMKODES.

---

## 1. ✅ Done (Sudah Selesai)
- [x] **[Infra] Cleanup Direktori Proyek**
  - Merapikan file arsip zip, dokumen HKI, PPTX, dan screenshot ke dalam `_archive/`.
  - Mengupdate `.gitignore` agar file dokumen tidak mengotori repo Git.
- [x] **[CI/CD] Otomatisasi GitHub Actions ke Staging**
  - Membuat workflow `.github/workflows/deploy-staging.yml`.
  - Mengatur build asset Vite dan Composer di cloud GitHub.
  - Setup rsync SSH ke server Hostinger.
- [x] **[Security] Proteksi Akses Web Staging (HTTP Basic Auth)**
  - Menambahkan step pembuatan `.htpasswd` otomatis di GitHub Actions via Secret `STAGING_AUTH_USER` & `STAGING_AUTH_PASS`.
  - Mengunci `https://simkodes-staging.sranak.com` agar hanya bisa diakses tim berwenang.
- [x] **[Testing Automation] Cakupan Pengujian Seluruh Modul (Dusk, Playwright & PHPUnit)**
  - Menyiapkan Page Object Model (POM) untuk semua halaman SIMKODES.
  - Menulis 11 Feature Tests (`tests/Feature/SimkodesModuleTest.php`) mencakup Auth, Anggota, Pengurus, Pengawas, Kategori, Surat Masuk/Keluar, Inventaris, Subsidi, dan Laporan.
  - Menulis 9 Playwright E2E browser tests (`e2e/tests/full-features.spec.ts`).
  - Menyiapkan workflow otomatisasi GitHub Actions (`.github/workflows/e2e.yml`).
- [x] **[Monitoring] Integrasi Library Sentry Laravel**
  - Install `sentry/sentry-laravel` dan konfigurasi handler di `bootstrap/app.php` & `config/sentry.php`.

---

## 2. 🧪 Testing (Staging Environment)
*URL Staging: [https://simkodes-staging.sranak.com](https://simkodes-staging.sranak.com)*

- [ ] **[QA] Pengujian Modul Autentikasi & Akun**
  - [ ] Login / Logout pengguna.
  - [ ] Hak akses user (Admin, Pengurus, Pengawas).
- [ ] **[QA] Pengujian Master Data Anggota & Pengurus**
  - [ ] Tambah, edit, detail, dan hapus data Anggota.
  - [ ] Cetak KTA Anggota.
  - [ ] Manajemen data Pengurus & Pengawas.
- [ ] **[QA] Pengujian Modul Persuratan & Inventaris**
  - [ ] Upload & download file Surat Masuk.
  - [ ] Upload & download file Surat Keluar.
  - [ ] Input data inventaris & ekspor laporan PDF/Excel.
- [ ] **[QA] Pengujian Modul Subsidi & Bantuan**
  - [ ] Pendaftaran penerima subsidi.
  - [ ] Verifikasi klaim subsidi.
  - [ ] Cetak laporan rekapitulasi subsidi.

---

## 3. 📋 Backlog / To Do (Persiapan Production & Monitoring)
- [ ] **[Monitoring] Pasang UptimeRobot**
  - Daftarkan URL Staging dan Production ke UptimeRobot (notifikasi otomatis ke Telegram / Email jika down).
- [ ] **[Monitoring] Integrasi Sentry Laravel**
  - Install `sentry/sentry-laravel` untuk memantau error 500 secara realtime.
- [ ] **[CI/CD] Buat Workflow Rilis Production (`deploy-production.yml`)**
  - Menyiapkan alur rilis otomatis ke direktori `public_html/simkodes/` saat merge ke `master`.
  - Menjalankan caching produksi (`php artisan optimize`).
- [ ] **[Database] Backup & Migrasi Production**
  - Backup database lama yang masih aktif di Hostinger.
  - Sinkronisasi struktur tabel bersih dari staging ke production.
- [ ] **[Cutover] Rilis Resmi Versi Bersih ke Production**
  - Menimpa versi production lama yang masih berantakan dengan versi baru hasil pengujian staging.

---

## 4. 🚀 Ready for Production (Siap Rilis)
*(Pindahkan item dari Staging ke sini jika sudah diverifikasi 100% bebas bug oleh tim).*
- [ ] *Belum ada (menunggu hasil pengujian modul staging selesai).*

