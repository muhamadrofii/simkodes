# 🧪 PRD 03: Testing Strategy & Quality Assurance

## 1. Filosofi & Pendekatan Pengujian
Sistem pengujian SIMKODES dirancang menggunakan prinsip piramida pengujian perangkat lunak (*Testing Pyramid*):
1. **Unit & Feature Testing (PHPUnit)**: Menguji setiap method controller, query database, upload file, dan response code secara cepat dan mendalam.
2. **API Contract & Efficiency Testing**: Menguji kesesuaian schema JSON RESTful API dan memvalidasi efisiensi eksekusi query SQL (anti N+1).
3. **Browser E2E Automation Testing (Playwright & Laravel Dusk)**: Menguji integrasi tampilan nyata dan alur pengguna (*user journeys*) di browser Chromium.

---

## 2. Struktur Pengujian Backend Modular (PHPUnit)

Seluruh test file dipisahkan secara independen per domain dan mewarisi base class berorientasi objek [SimkodesTestCase.php](file:///c:/code/sranak/simkodes/tests/Feature/SimkodesTestCase.php):

```text
tests/
├── Feature/
│   ├── SimkodesTestCase.php      # Base test case (Auth & Session encapsulation)
│   ├── AuthTest.php              # Login, Session Timeout, Guest Protection
│   ├── CategoryTest.php          # Full CRUD Kategori Data
│   ├── MemberTest.php            # Full CRUD Anggota + Generator KTA PDF
│   ├── OfficerTest.php           # Full CRUD Pengurus + TTD Digital & KTA PDF
│   ├── SupervisorTest.php        # Full CRUD Pengawas + Foto & KTA PDF
│   ├── IncomingLetterTest.php    # Full CRUD Surat Masuk + Lampiran PDF
│   ├── OutgoingLetterTest.php    # Full CRUD Surat Keluar + Lampiran PDF
│   ├── InventoryTest.php         # Full CRUD Inventaris + Ekspor PDF/Excel
│   ├── SubsidyTest.php           # Laporan & Verifikasi NIK Bantuan
│   ├── ReportTest.php            # Filter Rentang Tanggal & Cetak Rekapitulasi
│   └── Api/                      # RESTful API Test Suite
│       ├── ApiTestCase.php       # Base API Test (Sanctum Token & JSON Header)
│       ├── AuthApiTest.php       # Login, Token Revocation, Unauthenticated
│       ├── MemberApiTest.php     # Full REST CRUD JSON & FormRequest 422
│       ├── CategoryApiTest.php   # JSON Category Resources
│       ├── InventoryApiTest.php  # JSON Inventory Resources
│       └── QueryEfficiencyTest.php # Uji Efisiensi SQL (N+1 Prevention)
```

---

## 3. Struktur Pengujian Browser E2E (Playwright)

Menggunakan pola **Page Object Model (POM)** murni untuk memisahkan logika selektor elemen dari skenario uji:

### A. Kelas Page Object Model (`e2e/pages/`)
- [LoginPage.ts](file:///c:/code/sranak/simkodes/e2e/pages/LoginPage.ts) — Enkapsulasi input email/password, submit, dan alert error.
- [DashboardPage.ts](file:///c:/code/sranak/simkodes/e2e/pages/DashboardPage.ts) — Enkapsulasi widget ringkasan dan banner sambutan.
- [CategoryPage.ts](file:///c:/code/sranak/simkodes/e2e/pages/CategoryPage.ts) — Enkapsulasi tabel kategori data.
- [MemberPage.ts](file:///c:/code/sranak/simkodes/e2e/pages/MemberPage.ts) — Enkapsulasi daftar tabel anggota dan modal/form pendaftaran.
- [OfficerPage.ts](file:///c:/code/sranak/simkodes/e2e/pages/OfficerPage.ts) — Enkapsulasi struktur pengurus dan dewan pengawas.
- [LetterPage.ts](file:///c:/code/sranak/simkodes/e2e/pages/LetterPage.ts) — Enkapsulasi arsip surat masuk dan keluar.
- [InventoryPage.ts](file:///c:/code/sranak/simkodes/e2e/pages/InventoryPage.ts) — Enkapsulasi data inventaris dan tombol ekspor.
- [ReportPage.ts](file:///c:/code/sranak/simkodes/e2e/pages/ReportPage.ts) — Enkapsulasi form filter tanggal laporan dan tabel subsidi.

### B. File Test Spec Terpisah (`e2e/tests/`)
- `01_auth.spec.ts` (Login UI & penanganan password salah)
- `02_dashboard.spec.ts` (Verifikasi statistik dashboard)
- `03_master_data.spec.ts` (Daftar kategori & form create anggota)
- `04_officers.spec.ts` (Tabel pengurus & dewan pengawas)
- `05_letters.spec.ts` (Arsip surat masuk & surat keluar)
- `06_inventory.spec.ts` (Buku inventaris & tautan ekspor dokumen)
- `07_reports.spec.ts` (Penyaluran subsidi & filter form rekapitulasi)

### C. Konfigurasi Server Otomatis ([playwright.config.ts](file:///c:/code/sranak/simkodes/playwright.config.ts))
Playwright dikonfigurasi dengan blok `webServer`:
```typescript
webServer: {
  command: 'php artisan serve --port=8000',
  url: 'http://127.0.0.1:8000/login',
  reuseExistingServer: !process.env.CI,
  timeout: 120 * 1000,
}
```
*Developer atau CI runner tidak perlu menyalakan server secara manual; Playwright otomatis mendeteksi dan menghidupkan `artisan serve` saat tes berjalan.*

---

## 4. Pengujian Efisiensi Query Database ([QueryEfficiencyTest.php](file:///c:/code/sranak/simkodes/tests/Feature/Api/QueryEfficiencyTest.php))
Pengujian tidak hanya memvalidasi status HTTP, namun secara aktif mengaudit query SQL yang dieksekusi melalui `DB::enableQueryLog()`:
- **Validasi Eager Loading**: Memastikan pemanggilan relasi kategori pada 10 anggota mengeksekusi maksimal 2 query SQL (`WHERE IN`), bukan 11 query ($N+1$).
- **Validasi Proyeksi Kolom**: Memastikan query tidak mengeksekusi `SELECT *` yang memboroskan alokasi memori server.

---

## 5. Cara Menjalankan Rangkaian Pengujian

```bash
# 1. Jalankan seluruh pengujian PHPUnit (Backend Feature + REST API)
php artisan test

# 2. Jalankan pengujian khusus modul API dan efisiensi SQL
php artisan test --filter=Api

# 3. Jalankan pengujian satu file spesifik (contoh: Anggota)
php artisan test tests/Feature/MemberTest.php

# 4. Jalankan seluruh pengujian Browser E2E (Playwright)
npx playwright test

# 5. Jalankan Playwright dengan UI interaktif (mode debug visual)
npx playwright test --ui
```

