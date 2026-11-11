# SIMKODES

SIMKODES adalah aplikasi web untuk pengelolaan data koperasi. Fokus utamanya meliputi data anggota, pengurus, pengawas, inventaris, surat masuk/keluar, serta laporan.

## Fitur Utama
- Autentikasi pengguna (login/register) dan dashboard.
- Manajemen anggota, pengurus, dan pengawas.
- Kategori data.
- Inventaris (termasuk ekspor PDF dan Excel).
- Surat masuk dan surat keluar.
- Laporan dan cetak laporan per periode.

## Teknologi
- Laravel 11
- PHP 8.2+
- MySQL/MariaDB (atau database lain yang didukung Laravel)

## Prasyarat
- PHP 8.2+
- Composer
- Database server

## Instalasi & Menjalankan dengan Docker (Rekomendasi)

1. **Salin environment Docker:**
   ```bash
   cp .env.docker.example .env
   # Pada Windows PowerShell:
   # copy .env.docker.example .env
   ```

2. **Build dan jalankan container:**
   ```bash
   docker compose up -d --build
   ```

3. **Install dependency dan inisialisasi Laravel:**
   ```bash
   docker compose exec app composer install
   docker compose exec app php artisan key:generate
   docker compose exec app php artisan migrate --seed
   docker compose exec app php artisan storage:link
   ```

4. **Akses Aplikasi:**
   - **Aplikasi Web SIMKODES**: [http://localhost:8000](http://localhost:8000)
   - **Database phpMyAdmin**: [http://localhost:8080](http://localhost:8080) (Server: `db`, User: `simkodes_user`, Password: `simkodes_password`)

---

## Instalasi Lokal (Tanpa Docker)
1. Install dependency PHP
   ```bash
   composer install
   ```
2. Salin file environment dan sesuaikan konfigurasi
   ```bash
   copy .env.example .env
   ```
   Atur DB_* di `.env`.
3. Generate app key
   ```bash
   php artisan key:generate
   ```
4. Jalankan migrasi
   ```bash
   php artisan migrate
   ```
5. Jalankan aplikasi
   ```bash
   php artisan serve
   ```

## Perintah Berguna
- Jalankan test (di dalam Docker)
  ```bash
  docker compose exec app php artisan test
  ```
- Jalankan artisan di dalam container
  ```bash
  docker compose exec app php artisan <command>
  ```

## Catatan Deploy (cPanel)
- Set document root ke folder `public`.
- Pastikan permission `storage` dan `bootstrap/cache` writable.
- Set `.env` sesuai server, lalu jalankan:
  ```bash
  php artisan config:cache
  php artisan route:cache
  php artisan view:cache
  ```

## Lisensi
Gunakan sesuai kebutuhan internal proyek.
