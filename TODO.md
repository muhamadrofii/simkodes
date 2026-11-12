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
  - Setup rsync SSH ke server Hostinger dengan bypass PHP `symlink()` via shell `ln -sfn`.
- [x] **[Security] Proteksi Akses Web Staging (HTTP Basic Auth)**
  - Menambahkan step pembuatan `.htpasswd` otomatis di GitHub Actions via Secret `STAGING_AUTH_USER` & `STAGING_AUTH_PASS`.
  - Mengunci `https://simkodes-staging.sranak.com` agar hanya bisa diakses tim berwenang.
- [x] **[Monitoring] Integrasi Sentry Error Monitoring**
  - Install `sentry/sentry-laravel` dan verifikasi event `SIMKODES-1` di dashboard Sentry Cloud.
- [x] **[Testing Automation] Cakupan Pengujian Browser E2E & Backend (Dusk, Playwright & PHPUnit)**
  - Menyiapkan Page Object Model (POM) bersih di Playwright dan Laravel Dusk.
  - Memisahkan spec E2E Playwright secara modular (`01_auth.spec.ts` s/d `07_reports.spec.ts`, 12 tests PASS).
  - Memisahkan 10 file Feature Tests PHPUnit per modul (`AuthTest`, `CategoryTest`, `MemberTest`, `OfficerTest`, `SupervisorTest`, `IncomingLetterTest`, `OutgoingLetterTest`, `InventoryTest`, `SubsidyTest`, `ReportTest`, 60 tests PASS).
  - Menyiapkan workflow otomatisasi GitHub Actions (`.github/workflows/e2e.yml`).
- [x] **[API & Database] Standarisasi RESTful API & Optimasi Query SQL**
  - Implementasi Laravel Sanctum Bearer Token Auth (`login`, `logout`, `me`).
  - Standarisasi JSend Response Envelope via `ApiResponseTrait` (200, 201, 401, 404, 422).
  - Standarisasi validasi request via Form Requests (`BaseApiRequest`, `LoginRequest`, `StoreMemberRequest`, `UpdateMemberRequest`).
  - Migrasi penambahan database indexing (`nama`, `tanggal_masuk`, `nama_barang`, `reference_number`).
  - Eliminasi masalah N+1 query via Eager Loading terproyeksi (`QueryEfficiencyTest`).
- [x] **[Bugfix & Kompatibilitas]**
  - Mengganti `withQueryString()` dengan method kontrak resmi `appends($request->query())` di 9 controller (fix warning Intelephense).
  - Memperbaiki query agregasi tanggal di `DashboardController` agar database-agnostic (fix error 500 SQLite di GitHub Actions CI).

---

## 2. 🧪 Testing & QA (Staging Environment)
*URL Staging: [https://simkodes-staging.sranak.com](https://simkodes-staging.sranak.com)*

- [ ] **[QA] Pengujian Modul Autentikasi & Akun**
  - [ ] Login / Logout pengguna.
  - [ ] Hak akses user (Admin, Pengurus, Pengawas).
- [ ] **[QA] Pengujian Master Data Anggota & Pengurus**
  - [ ] Tambah, edit, detail, dan hapus data Anggota.
  - [ ] Cetak KTA Anggota (PDF).
  - [ ] Manajemen data Pengurus & Pengawas + Cetak KTA.
- [ ] **[QA] Pengujian Modul Persuratan & Inventaris**
  - [ ] Upload & download file Surat Masuk.
  - [ ] Upload & download file Surat Keluar.
  - [ ] Input data inventaris & ekspor laporan PDF/Excel.
- [ ] **[QA] Pengujian Modul Subsidi & Bantuan**
  - [ ] Pendaftaran penerima subsidi.
  - [ ] Verifikasi klaim subsidi.
  - [ ] Cetak laporan rekapitulasi subsidi.

---

## 3. 📋 Backlog / To Do (Persiapan Rilis Production & Keamanan yang Dibahas Tadi)
- [ ] **[Security Scanning] Audit Keamanan Dependencies**
  - Menjalankan `composer audit` dan `npm audit` untuk mendeteksi kerentanan CVE pada paket dependensi.
- [ ] **[Monitoring] Pasang UptimeRobot**
  - Daftarkan URL Staging dan Production ke UptimeRobot (notifikasi otomatis ke Telegram / Email jika down tanpa login).
- [ ] **[CI/CD] Buat Workflow Rilis Production (`deploy-production.yml`)**
  - Menyiapkan alur rilis otomatis ke direktori `public_html/simkodes/` saat merge ke `master`.
  - Menjalankan caching produksi (`php artisan optimize`).
- [ ] **[Database] Backup & Migrasi Production**
  - Backup database lama yang masih aktif di cPanel Hostinger.
  - Sinkronisasi struktur tabel bersih dari staging ke production.
- [ ] **[Cutover] Rilis Resmi Versi Bersih ke Production**
  - Menimpa versi production lama yang masih acak-acakan dengan versi baru hasil pengujian staging.

---

## 4. 🚀 Ready for Production (Siap Rilis)
*(Pindahkan item dari Staging ke sini jika sudah diverifikasi 100% bebas bug oleh tim).*
- [ ] *Menunggu hasil QA manual di Staging dan eksekusi backlog persiapan production.*
