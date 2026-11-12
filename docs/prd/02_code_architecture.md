# 💻 PRD 02: Code Architecture & API Standards

## 1. Prinsip Arsitektur Perangkat Lunak
Pengembangan kode SIMKODES berpedoman pada prinsip **Clean Code**, **SOLID**, dan **Object-Oriented Programming (OOP)** untuk menjamin keterbacaan (*readability*), modularitas, dan kemudahan pemeliharaan (*maintainability*).

---

## 2. Struktur Arsitektur Backend (Laravel 11)

```text
app/
├── Http/
│   ├── Controllers/
│   │   ├── Api/                    # RESTful API Controllers
│   │   │   ├── AuthController.php
│   │   │   ├── CategoryController.php
│   │   │   ├── InventoryController.php
│   │   │   └── MemberController.php
│   │   └── Web Controllers         # Blade View Controllers (CRUD Web)
│   ├── Requests/
│   │   └── Api/                    # Form Request Validation Classes
│   │       ├── BaseApiRequest.php  # Base validator (override 422 JSON)
│   │       ├── LoginRequest.php
│   │       ├── StoreMemberRequest.php
│   │       └── UpdateMemberRequest.php
│   ├── Resources/                  # Transformation Layer (API Resources)
│   │   ├── CategoryResource.php
│   │   ├── InventoryResource.php
│   │   └── MemberResource.php
│   └── Middleware/
│       └── CheckSessionTimeout.php # Inactivity timeout guard (7200s)
├── Models/                         # Eloquent ORM Models & Relations
└── Traits/
    └── ApiResponseTrait.php        # JSend Consistent Response Envelope
```

---

## 3. Standarisasi RESTful API

### A. Autentikasi API (Laravel Sanctum)
- Endpoint publik: `POST /api/login` (Menerbitkan Bearer Token).
- Endpoint aman: Dilindungi middleware `auth:sanctum`.
- Pengelolaan token: *Single active token* (token usang dihapus otomatis saat login ulang untuk mencegah duplikasi sesi aktif).
- Pencabutan token: `POST /api/logout` menghapus token aktif saat ini (*revocation*).

### B. Lapisan Validasi Permintaan (Request Standards)
- **Single Responsibility Principle (SRP)**: Seluruh aturan validasi diisolasi di dalam kelas Form Request di `app/Http/Requests/Api/`.
- **Penanganan Gagal Validasi**: [BaseApiRequest.php](file:///c:/code/sranak/simkodes/app/Http/Requests/Api/BaseApiRequest.php) meng-override method `failedValidation()` untuk mengembalikan format JSON standar HTTP 422 tanpa terjadi redirect ke halaman web:
```json
{
  "success": false,
  "code": 422,
  "message": "Validasi parameter request gagal.",
  "errors": {
    "nama": ["Nama anggota wajib diisi."],
    "jenis_kelamin": ["Jenis kelamin (L/P) wajib dipilih."]
  }
}
```

### C. Lapisan Transformasi Data (API Resource Pattern)
Model Eloquent mentah tidak pernah diekspos langsung ke JSON klien. Setiap entitas ditransformasikan oleh API Resource:
- [MemberResource.php](file:///c:/code/sranak/simkodes/app/Http/Resources/MemberResource.php): Proyeksi tanggal ISO-8601, resolusi URL foto profil publik yang valid, dan relasi kondisional `category` via `$this->whenLoaded()`.
- [CategoryResource.php](file:///c:/code/sranak/simkodes/app/Http/Resources/CategoryResource.php)
- [InventoryResource.php](file:///c:/code/sranak/simkodes/app/Http/Resources/InventoryResource.php)

### D. Konsistensi Response Envelope ([ApiResponseTrait.php](file:///c:/code/sranak/simkodes/app/Traits/ApiResponseTrait.php))
Seluruh respon API mengikuti standar format seragam (*JSend / Google REST API standard*):

1. **Respon Data Tunggal / Aksi Berhasil (HTTP 200 / 201)**:
```json
{
  "success": true,
  "code": 200,
  "message": "Detail anggota berhasil dimuat.",
  "data": { "id": 1, "nama": "Ahmad Fauzi", ... }
}
```

2. **Respon Koleksi Berpaginasi (HTTP 200)**:
```json
{
  "success": true,
  "code": 200,
  "message": "Daftar anggota berhasil dimuat.",
  "data": [ ... ],
  "meta": {
    "current_page": 1,
    "per_page": 15,
    "total": 120,
    "last_page": 8
  },
  "links": {
    "first": "http://domain/api/members?page=1",
    "last": "http://domain/api/members?page=8",
    "prev": null,
    "next": "http://domain/api/members?page=2"
  }
}
```

3. **Respon Error / Data Tidak Ditemukan (HTTP 401 / 404)**:
```json
{
  "success": false,
  "code": 404,
  "message": "Data anggota tidak ditemukan."
}
```

---

## 4. Penanganan Exception Global Terpusat ([bootstrap/app.php](file:///c:/code/sranak/simkodes/bootstrap/app.php))
Pada Laravel 11, penanganan exception rute API didaftarkan secara deklaratif:
- `AuthenticationException` pada rute `api/*` $\rightarrow$ Merender HTTP 401 JSON envelope, bukan redirect login web.
- `NotFoundHttpException` / `ModelNotFoundException` pada rute `api/*` $\rightarrow$ Merender HTTP 404 JSON envelope standar.

---

## 5. Kepatuhan Kontrak Interface Paginator
Untuk mencegah peringatan static analysis (Intelephense / PHPStan) `Call to unknown method LengthAwarePaginator::withQueryString()`, seluruh controller menggunakan method:
```php
$data = $query->paginate($limit)->appends($request->query());
```
Method `appends()` terdaftar resmi di interface contract `Illuminate\Contracts\Pagination\Paginator`, menjamin kepatuhan tipe 100% dan menghilangkan error IDE.
