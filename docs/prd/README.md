# 📚 SIMKODES - Product Requirement Document (PRD) & Technical Specification

Selamat datang di dokumentasi resmi spesifikasi teknis dan kebutuhan sistem **SIMKODES (Sistem Informasi Manajemen Koperasi Desa Sranak)**.

Seluruh dokumentasi ini disusun secara terpisah (*modular*) dan terstruktur untuk mempermudah pemahaman arsitektur sistem, alur DevOps, standar kode, dan strategi pengujian.

---

## 🗂️ Indeks Dokumen Spesifikasi

| No | Modul Dokumentasi | Deskripsi Singkat |
| :---: | :--- | :--- |
| **01** | [**01_product_overview.md**](file:///c:/code/sranak/simkodes/docs/prd/01_product_overview.md) | Visi produk, tujuan sistem, profil aktor pengguna, dan ruang lingkup modul bisnis koperasi. |
| **02** | [**02_code_architecture.md**](file:///c:/code/sranak/simkodes/docs/prd/02_code_architecture.md) | Pola arsitektur kode, standar Clean Code, RESTful API (Sanctum), JSend Response Envelope, dan Form Requests. |
| **03** | [**03_testing_strategy.md**](file:///c:/code/sranak/simkodes/docs/prd/03_testing_strategy.md) | Strategi pengujian berlapis: PHPUnit Modular Feature Test, Playwright E2E, Laravel Dusk, dan Page Object Model (POM). |
| **04** | [**04_cicd_pipeline.md**](file:///c:/code/sranak/simkodes/docs/prd/04_cicd_pipeline.md) | Otomatisasi GitHub Actions CI/CD: Pipeline pengujian E2E, pipeline rsync staging, dan manajemen secret deployment. |
| **05** | [**05_devops_infrastructure.md**](file:///c:/code/sranak/simkodes/docs/prd/05_devops_infrastructure.md) | Arsitektur DevOps Shared Hosting Hostinger, pemisahan Staging vs Production, bypass symlink shell, dan proteksi Basic Auth. |
| **06** | [**06_database_optimization.md**](file:///c:/code/sranak/simkodes/docs/prd/06_database_optimization.md) | Spesifikasi database: Database indexing performa, pencegahan N+1 query, proyeksi kolom selektif, dan kompatibilitas MySQL/SQLite. |
| **07** | [**07_monitoring_maintenance.md**](file:///c:/code/sranak/simkodes/docs/prd/07_monitoring_maintenance.md) | Integrasi Sentry Error Monitoring, SOP Graceful Maintenance 503, Scheduled Pruning, dan rencana cutover production. |

---

## 🚀 Ringkasan Metrik Kualitas Perangkat Lunak

- **Framework**: Laravel 11 (PHP 8.2+) & Node.js 20 (Vite)
- **Database**: MySQL 8.0 (Hosting Staging/Prod) & SQLite (Testing / GitHub Actions CI)
- **Pengujian Otomatis**: **91 Pengujian Lulus (100% PASS)**
  - 79 PHPUnit Feature, Unit, & API Tests (468 Assertions)
  - 12 Playwright E2E Headless Browser Tests
- **Monitoring**: Sentry Laravel SDK terintegrasi di cloud
- **Keamanan Staging**: HTTP Basic Auth dinamis via GitHub Actions
