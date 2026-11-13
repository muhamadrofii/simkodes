# ⚙️ PRD 05: DevOps & Hosting Infrastructure

## 1. Arsitektur Lingkungan Server (Hostinger Shared Hosting)
Aplikasi SIMKODES di-host pada layanan **Hostinger Business Shared Hosting** berbasis web server **LiteSpeed Enterprise**.

### Karakteristik & Batasan Shared Hosting:
- **Tanpa Izin Root / Sudo**: Tidak dapat menjalankan daemon container seperti Docker Engine atau server Jenkins secara langsung di host.
- **PHP `disable_functions`**: Hostinger menonaktifkan sejumlah fungsi PHP berisiko tinggi di `php.ini`, termasuk fungsi `symlink()`.
- **LiteSpeed Web Server**: Membaca aturan rewrite dan otentikasi melalui berkas `.htaccess`.

---

## 2. Pemisahan Lingkungan (Environment Separation)

| Komponen | Lingkungan Staging | Lingkungan Live Production |
| :--- | :--- | :--- |
| **Domain / URL** | `https://simkodes-staging.sranak.com` | `https://sranak.com/simkodes` (atau `https://simkodes.sranak.com`) |
| **Direktori Server** | `/home/u849825724/domains/sranak.com/public_html/simkodes-staging/` | `/home/u849825724/domains/sranak.com/public_html/simkodes/` |
| **Database** | `u849825724_simkodes_staging` | `u849825724_simkodes_prod` |
| **Proteksi Akses** | **Terkunci** (HTTP Basic Auth `.htpasswd`) | **Terbuka** untuk umum & pengurus |
| **Alur Rilis** | Otomatis via push branch `master` | Manual Approval via `workflow_dispatch` ("DEPLOY") |

---

## 3. Solusi Rekayasa Khusus (Workarounds & Engineering Fixes)

### A. Solusi Masalah `Call to undefined function Illuminate\Filesystem\symlink()`
- **Masalah**: Perintah `php artisan storage:link` gagal dengan error fatal karena fungsi PHP `symlink()` diblokir Hostinger.
- **Solusi**: Menggunakan perintah shell symlink Linux secara langsung pada level sistem operasi:
  ```bash
  cd public && ln -sfn ../storage/app/public storage || true
  ```
  Perintah ini membuat symbolic link direktori `public/storage` mengarah ke `storage/app/public` tanpa melewati interpreter PHP.

### B. Konfigurasi Routing Root `.htaccess` (LiteSpeed)
Untuk memastikan seluruh trafik diarahkan secara bersih ke folder `public/`:
```apache
<IfModule mod_rewrite.c>
    RewriteEngine On
    RewriteRule ^$ public/ [L]
    RewriteRule (.*) public/$1 [L]
</IfModule>
```

### C. Keamanan File Sensitif di `.htaccess`
Memblokir akses publik langsung terhadap berkas konfigurasi rahasia:
```apache
<FilesMatch "^\.env|composer\.(json|lock)|package(-lock)?\.json|\.git">
    Order allow,deny
    Deny from all
</FilesMatch>
```

### D. Struktur Permission & Direktori Framework
Agar Laravel tidak mengalami crash `View path not found` atau `Permission denied`, struktur direktori berikut dibuat dan diberi hak akses `775`:
- `storage/framework/views` (menyimpan template Blade yang dikompilasi)
- `storage/framework/cache`
- `storage/framework/sessions`
- `storage/logs`
- `bootstrap/cache`

---

## 4. Mekanisme Otomatisasi SSH & Port Custom Hostinger

Server shared hosting Hostinger tidak menggunakan port SSH default (`22`), melainkan port kustom **`65002`**.

### Standarisasi Akses Remote:
1. **Port SSH**: `65002`.
2. **Server IP**: `195.35.48.228`.
3. **Akun SSH**: `u849825724`.
4. **Multi-Secret Fallback**: Workflow CI/CD secara otomatis membaca kunci `HOSTINGER_SSH_*` maupun `SSH_*`. Jika secret port tidak didefinisikan, otomatis jatuh ke default port `65002` sehingga mencegah kegagalan pipeline dengan pesan `Bad port '-H'`.
5. **Known Hosts Scan**: `ssh-keyscan -p "${{ env.SSH_PORT }}" -H "${{ env.SSH_HOST }}" >> ~/.ssh/known_hosts` dilakukan sebelum eksekusi rsync atau remote shell.
