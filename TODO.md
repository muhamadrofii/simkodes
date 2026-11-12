# 📋 SIMKODES - Roadmap & Task Board

Dokumen pelacak tugas, pengujian staging, dan persiapan rilis production untuk tim SIMKODES.

---

## 1. ✅ Done (Sudah Selesai)
- [x] **[Infra] Cleanup Direktori Proyek**
  - Merapikan file arsip zip, dokumen HKI, PPTX, dan screenshot ke dalam `_archive/`.
  - Mengupdate `.gitignore` agar file dokumen tidak mengotori repo Git.
- [x] **[CI/CD & DevOps] Arsitektur Modular 7 Workflow GitHub Actions**
  - `ci.yml`: Menjalankan 79 test PHPUnit backend/API & 12 skenario Playwright E2E test.
  - `staging.yml`: Otomatisasi deploy ke Staging Hostinger dengan proteksi dynamic HTTP Basic Auth `.htpasswd`.
  - `production.yml`: Deployment manual terproteksi dengan kewajiban konfirmasi input `"DEPLOY"` (standby, tidak auto-run).
  - `maintenance.yml`: Remote toggle `php artisan down` (dengan bypass secret) dan `php artisan up` via SSH.
  - `backup.yml`: Dump database MySQL Hostinger otomatis mingguan & manual ke GitHub Actions Artifacts (retensi 30 hari).
  - `security.yml`: Pindaian kerentanan CVE berkala via `composer audit` & `npm audit --audit-level=high` (*task-b1*).
  - `monitoring.yml`: Pengecekan HTTP endpoint health check berkala setiap 6 jam untuk staging & production.
- [x] **[Monitoring] Integrasi Sentry Error Monitoring**
  - Install `sentry/sentry-laravel` dan verifikasi event `SIMKODES-1` di dashboard Sentry Cloud.
- [x] **[Testing Automation] Cakupan Pengujian Browser E2E & Backend (Dusk, Playwright & PHPUnit)**
  - Menyiapkan Page Object Model (POM) bersih di Playwright dan Laravel Dusk.
  - Memisahkan spec E2E Playwright secara modular (`01_auth.spec.ts` s/d `07_reports.spec.ts`, 12 tests PASS).
  - Memisahkan 10 file Feature Tests PHPUnit per modul (60 tests Feature + 19 tests Unit/API, total 79 tests PASS).
- [x] **[API & Database] Standarisasi RESTful API & Optimasi Query SQL**
  - Implementasi Laravel Sanctum Bearer Token Auth (`login`, `logout`, `me`).
  - Standarisasi JSend Response Envelope via `ApiResponseTrait` (200, 201, 401, 404, 422).
  - Standarisasi validasi request via Form Requests (`BaseApiRequest`, `LoginRequest`, `StoreMemberRequest`, `UpdateMemberRequest`).
  - Migrasi penambahan database indexing (`nama`, `tanggal_masuk`, `nama_barang`, `reference_number`).
  - Eliminasi masalah N+1 query via Eager Loading terproyeksi (`QueryEfficiencyTest`).
- [x] **[Bugfix & Kompatibilitas]**
  - Mengganti `withQueryString()` dengan method kontrak resmi `appends($request->query())` di 9 controller (fix warning Intelephense).
  - Memperbaiki query agregasi tanggal di `DashboardController` agar database-agnostic (fix error 500 SQLite di GitHub Actions CI).
- [x] **[PRD & Dokumentasi] Rilis Dokumen PRD Lengkap 8 Modul**
  - Tersedia di `docs/prd/` (`01_product_overview` hingga `07_monitoring_maintenance` dan `README.md`).

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

## 3. 📋 Backlog / To Do (Persiapan Rilis Production yang Ditahan Sementara)
- [ ] **[Monitoring] Pasang UptimeRobot Eksternal**
  - Daftarkan URL Staging dan Production ke UptimeRobot (notifikasi real-time via Telegram / Email jika down).
- [ ] **[Production Cutover] Rilis Resmi Versi Bersih ke Live Production (DITAHAN)**
  - *Status: HOLD / Menunggu instruksi pengguna setelah pengujian staging rampung.*
  - Menjalankan workflow manual `production.yml` dengan konfirmasi input `"DEPLOY"`.
  - Menjalankan full database backup via `backup.yml` sebelum cutover.
  - Verifikasi live domain `simkodes.sranak.com`.

---

## 4. 🚀 Ready for Production (Siap Rilis)
*(Pindahkan item dari Staging ke sini jika sudah diverifikasi 100% bebas bug oleh tim).*
- [ ] *Menunggu hasil QA manual di Staging dan aba-aba instruksi cutover dari user.*
