# 📚 SIMKODES - Product Requirement Document (PRD) & Technical Specification

Selamat datang di dokumentasi resmi spesifikasi teknis dan kebutuhan sistem **SIMKODES (Sistem Informasi Manajemen Koperasi Desa Sranak)**.

Seluruh dokumentasi disusun secara terpisah (*modular*) dan terstruktur untuk mempermudah pemahaman arsitektur sistem, alur DevOps, standar kode, dan strategi pengujian.

---

## 🗂️ Indeks Dokumen Spesifikasi

| No | Modul Dokumentasi | Deskripsi Singkat |
| :---: | :--- | :--- |
| **01** | [**01_product_overview.md**](file:///c:/code/sranak/simkodes/docs/prd/01_product_overview.md) | Visi produk, tujuan sistem, profil aktor pengguna, dan ruang lingkup modul bisnis koperasi. |
| **02** | [**02_code_architecture.md**](file:///c:/code/sranak/simkodes/docs/prd/02_code_architecture.md) | Pola arsitektur kode, standar Clean Code, RESTful API (Sanctum), JSend Response Envelope, dan Form Requests. |
| **03** | [**03_testing_strategy.md**](file:///c:/code/sranak/simkodes/docs/prd/03_testing_strategy.md) | Strategi pengujian berlapis (PHPUnit, Playwright E2E, POM) serta **Evaluasi 7 Pilar Standar QA Industri**. |
| **04** | [**04_cicd_pipeline.md**](file:///c:/code/sranak/simkodes/docs/prd/04_cicd_pipeline.md) | Arsitektur **7 Workflow Modular GitHub Actions**, multi-secret SSH fallback, dan manajemen security scanning. |
| **05** | [**05_devops_infrastructure.md**](file:///c:/code/sranak/simkodes/docs/prd/05_devops_infrastructure.md) | Arsitektur Hostinger Shared Hosting, pemisahan Staging vs Production, bypass symlink shell, port SSH kustom `65002`. |
| **06** | [**06_database_optimization.md**](file:///c:/code/sranak/simkodes/docs/prd/06_database_optimization.md) | Spesifikasi database: Database indexing performa, pencegahan N+1 query, proyeksi kolom selektif, dan kompatibilitas MySQL/SQLite. |
| **07** | [**07_monitoring_maintenance.md**](file:///c:/code/sranak/simkodes/docs/prd/07_monitoring_maintenance.md) | Integrasi Sentry Error Monitoring, SOP Graceful Maintenance 503, Scheduled Pruning, Backup mingguan, dan Cutover plan. |

---

## 🚀 Ringkasan Metrik Kualitas & Kesiapan Perangkat Lunak

- **Framework**: Laravel 11 (PHP 8.2+) & Node.js 20 (Vite)
- **Database**: MySQL 8.0 (Hosting Staging/Prod) & SQLite (Testing / GitHub Actions CI)
- **Pengujian Otomatis**: **91 Pengujian Lulus (100% PASS)**
  - 79 PHPUnit Feature, Unit, & API Tests (468 Assertions)
  - 12 Playwright E2E Headless Browser Tests (7 spec files)
- **Arsitektur CI/CD**: 7 Workflow Modular di `.github/workflows/` (`ci`, `staging`, `production`, `maintenance`, `backup`, `security`, `monitoring`).
- **DevOps Safeguard**:
  - Live Production **ON HOLD** dengan gerbang konfirmasi input manual `"DEPLOY"`.
  - Staging terproteksi HTTP Basic Auth `.htpasswd` dinamis via OpenSSL.
  - Multi-secret fallback otomatis untuk port SSH `65002`.
- **Monitoring & Observability**: Sentry Cloud error tracking + HTTP status ping berkala tiap 6 jam.
