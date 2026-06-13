# Gudang Online — Sistem Inventaris Gudang

Aplikasi web **manajemen inventaris gudang** berbasis Laravel 13 + Breeze (Blade).
Dibuat untuk mengelola data barang, kategori, supplier, serta mencatat riwayat stok masuk dan keluar secara otomatis.

---

## Legenda: Asal Fitur/Tabel

| Label | Arti |
|---|---|
| **🟢 Laravel** | Bawaan framework Laravel |
| **🔵 Breeze** | Bawaan package Breeze (auth scaffolding) |
| **🟠 Custom** | Dibuat oleh developer (saya) untuk kebutuhan aplikasi |

---

## Fitur Utama

| Fitur | Origin | Keterangan |
|---|---|---|
| **Auth (Login/Register)** | 🔵 Breeze | Login, Register, Logout — scaffolding bawaan Breeze |
| **Dashboard** | 🟠 Custom | Ringkasan total barang, stok menipis, aktivitas terbaru |
| **Manajemen Kategori** | 🟠 Custom | CRUD kategori barang |
| **Manajemen Supplier** | 🟠 Custom | CRUD supplier/pemasok |
| **Manajemen Barang** | 🟠 Custom | CRUD barang dengan SKU, harga, stok |
| **Riwayat Stok Masuk** | 🟠 Custom | Riwayat otomatis ketika barang ditambah/diperbarui stoknya |
| **Riwayat Stok Keluar** | 🟠 Custom | Riwayat otomatis ketika stok barang dikurangi |
| **Profile (Edit)** | 🔵 Breeze | Edit profil, ganti nama & email — template Breeze |
| **Lupa Password** | 🔵 Breeze | Fitur reset password via email — bawaan Breeze |

---

## Cara Install & Jalankan

```bash
# 1. Clone / masuk ke folder project
cd Gudang_Online

# 2. Install dependensi PHP
composer install

# 3. Copy .env (jika belum ada)
cp .env.example .env

# 4. Generate key
php artisan key:generate

# 5. Buat database MySQL (via phpMyAdmin atau terminal):
CREATE DATABASE gudang_online CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;

# 6. Jalankan migrasi & seeder (membuat tabel + data awal)
php artisan migrate --seed

# 7. Jalankan server
php artisan serve
```

Buka browser: `http://127.0.0.1:8000`

---

## Akun Demo (Seeder)

| Email | Password | Role |
|---|---|---|
| admin@demo.com | password | admin |
| staff@demo.com | password | staff |

---

## Struktur Database & Penjelasan Tiap Kolom

### 💠 Tabel Bawaan (Laravel + Breeze)

Tabel-tabel berikut dibuat **otomatis** oleh Laravel dan Breeze, bukan oleh developer:

| Tabel | Asal | Fungsi |
|---|---|---|
| `migrations` | 🟢 Laravel | Mencatat migrasi mana saja yang sudah dijalankan |
| `password_reset_tokens` | 🟢 Laravel + 🔵 Breeze | Menyimpan token untuk fitur lupa password |
| `sessions` | 🟢 Laravel | Menyimpan data session login user |
| `cache` / `cache_locks` | 🟢 Laravel | Menyimpan cache (karena CACHE_STORE=database di .env) |
| `jobs` / `job_batches` / `failed_jobs` | 🟢 Laravel | Menyimpan antrian job/queue |

### 🟠 Tabel Custom (Dibuat Developer)

Tabel-tabel berikut dibuat khusus untuk aplikasi inventaris ini:

### 1. 🟠 Tabel `roles` — Data role/pangkat user

| Kolom | Tipe | Penjelasan Detail |
|---|---|---|
| `id` | bigint (PK) | Primary key, auto increment, nomor unik tiap role |
| `name` | string (unique) | Nama role, harus unik. Contoh: `admin`, `staff` |
| `description` | string (nullable) | Penjelasan singkat tentang role ini |
| `created_at` | timestamp | Otomatis diisi Laravel saat data dibuat |
| `updated_at` | timestamp | Otomatis diisi Laravel saat data diedit |

### 2. 🔵🟠 Tabel `users` — Data pengguna sistem (Breeze + Custom)

| Kolom | Tipe | Asal | Penjelasan Detail |
|---|---|---|---|
| `id` | bigint (PK) | 🟢 Laravel | Primary key, auto increment, nomor unik tiap user |
| `role_id` | bigint (FK) | **🟠 Custom** | **Foreign Key** ke tabel `roles`. Menentukan role user ini (admin/staff) |
| `name` | string | 🔵 Breeze | Nama lengkap user |
| `email` | string (unique) | 🔵 Breeze | Email untuk login, harus unik |
| `password` | string | 🔵 Breeze | Password yang sudah di-hash (bcrypt) |
| `email_verified_at` | timestamp (nullable) | 🔵 Breeze | Tanggal verifikasi email. Null = belum diverifikasi |
| `remember_token` | string (nullable) | 🔵 Breeze | Token untuk fitur "Remember Me" saat login |
| `created_at` | timestamp | 🟢 Laravel | Otomatis diisi Laravel saat data dibuat |
| `updated_at` | timestamp | 🟢 Laravel | Otomatis diisi Laravel saat data diedit |

### 3. 🟠 Tabel `categories` — Kategori/kelompok barang

| Kolom | Tipe | Penjelasan Detail |
|---|---|---|
| `id` | bigint (PK) | Primary key, auto increment |
| `name` | string | Nama kategori. Contoh: Elektronik, ATK, Makanan |
| `description` | text (nullable) | Deskripsi kategori (bisa panjang) |
| `created_at` | timestamp | Otomatis diisi Laravel saat data dibuat |
| `updated_at` | timestamp | Otomatis diisi Laravel saat data diedit |

### 4. 🟠 Tabel `suppliers` — Data pemasok barang

| Kolom | Tipe | Penjelasan Detail |
|---|---|---|
| `id` | bigint (PK) | Primary key, auto increment |
| `name` | string | Nama perusahaan supplier |
| `contact_person` | string (nullable) | Nama orang yang bisa dihubungi |
| `email` | string (nullable) | Email supplier |
| `phone` | string (nullable) | Nomor telepon supplier |
| `address` | text (nullable) | Alamat lengkap supplier |
| `created_at` | timestamp | Otomatis diisi Laravel saat data dibuat |
| `updated_at` | timestamp | Otomatis diisi Laravel saat data diedit |

### 5. 🟠 Tabel `items` — Data barang inventaris (tabel utama)

| Kolom | Tipe | Penjelasan Detail |
|---|---|---|
| `id` | bigint (PK) | Primary key, auto increment |
| `name` | string | Nama barang |
| `description` | text (nullable) | Deskripsi detail barang |
| `sku` | string (unique) | **Stock Keeping Unit** — kode unik barang untuk identifikasi |
| `category_id` | bigint (FK) | **Foreign Key** ke tabel `categories`. Menentukan kategori barang ini |
| `supplier_id` | bigint (FK) (nullable) | **Foreign Key** ke tabel `suppliers`. Menentukan pemasok barang ini |
| `purchase_price` | decimal(12,2) | Harga beli barang dari supplier |
| `selling_price` | decimal(12,2) | Harga jual barang |
| `stock_quantity` | integer | Jumlah stok barang saat ini (berubah otomatis) |
| `min_stock` | integer | Batas minimal stok. Jika stok ≤ angka ini, dianggap "Stok Menipis" |
| `created_at` | timestamp | Otomatis diisi Laravel saat data dibuat |
| `updated_at` | timestamp | Otomatis diisi Laravel saat data diedit |

### 6. 🟠 Tabel `stock_ins` — Riwayat stok masuk (OTOMATIS)

| Kolom | Tipe | Penjelasan Detail |
|---|---|---|
| `id` | bigint (PK) | Primary key, auto increment |
| `item_id` | bigint (FK) | **Foreign Key** ke tabel `items`. Barang yang masuk |
| `quantity` | integer | Jumlah barang yang masuk |
| `purchase_price` | decimal(12,2) | Harga beli satuan saat barang ini masuk |
| `total_price` | decimal(12,2) | Total harga = `quantity × purchase_price` |
| `supplier_id` | bigint (FK) (nullable) | **Foreign Key** ke tabel `suppliers`. Supplier yang menyuplai |
| `user_id` | bigint (FK) | **Foreign Key** ke tabel `users`. Petugas yang mencatat/menambah stok |
| `notes` | text (nullable) | Catatan tambahan (contoh: "Stok awal", "Penyesuaian stok") |
| `created_at` | timestamp | Otomatis diisi Laravel saat data dibuat |
| `updated_at` | timestamp | Otomatis diisi Laravel saat data diedit |

### 7. 🟠 Tabel `stock_outs` — Riwayat stok keluar (OTOMATIS)

| Kolom | Tipe | Penjelasan Detail |
|---|---|---|
| `id` | bigint (PK) | Primary key, auto increment |
| `item_id` | bigint (FK) | **Foreign Key** ke tabel `items`. Barang yang keluar |
| `quantity` | integer | Jumlah barang yang keluar |
| `selling_price` | decimal(12,2) | Harga jual satuan saat barang ini keluar |
| `total_price` | decimal(12,2) | Total harga = `quantity × selling_price` |
| `user_id` | bigint (FK) | **Foreign Key** ke tabel `users`. Petugas yang mencatat/mengurangi stok |
| `notes` | text (nullable) | Catatan tambahan (contoh: "Penyesuaian stok (kurang)") |
| `created_at` | timestamp | Otomatis diisi Laravel saat data dibuat |
| `updated_at` | timestamp | Otomatis diisi Laravel saat data diedit |

---

## File & Proses yang Mengakses Tiap Tabel

### 🟠 Tabel Custom

| Tabel | Dibuat/Dihapus di | Dibaca di | Diproses/Ditulis di |
|---|---|---|---|
| **roles** | `RoleSeeder.php` | `User.php` (relasi) | Hanya via seeder — tidak ada form CRUD |
| **users** | 🔵 Breeze `RegisterController` + `UserSeeder.php` | `ProfileController@edit`, `DashboardController`, `StockInController`, `StockOutController`, `layouts/navigation.blade.php` | 🔵 `ProfileController@update` (nama, email), 🔵 `RegisterController` (register), `UserSeeder` (seed) |
| **categories** | `CategoryController@store`, `CategorySeeder.php` | `CategoryController@index`, `ItemController@create` (dropdown), `ItemController@edit` (dropdown) | `CategoryController@update`, `CategoryController@destroy` |
| **suppliers** | `SupplierController@store`, `SupplierSeeder.php` | `SupplierController@index`, `ItemController@create` (dropdown), `ItemController@edit` (dropdown), `StockInController@index` | `SupplierController@update`, `SupplierController@destroy` |
| **items** | `ItemController@store`, `SupplierSeeder.php` | `ItemController@index`, `ItemController@edit`, `DashboardController`, `StockInController`, `StockOutController` | `ItemController@update`, `ItemController@destroy` |
| **stock_ins** | **Otomatis** via `ItemController@store` & `ItemController@update` | `StockInController@index`, `DashboardController` | Tidak bisa dihapus/diedit manual — hanya auto-insert |
| **stock_outs** | **Otomatis** via `ItemController@update` (saat stok dikurangi) | `StockOutController@index`, `DashboardController` | Tidak bisa dihapus/diedit manual — hanya auto-insert |

### 🟢🔵 Tabel Bawaan (Laravel + Breeze)

| Tabel | Origin | Diproses oleh | Keterangan |
|---|---|---|---|
| **migrations** | 🟢 Laravel | `php artisan migrate` | Mencatat migrasi yang sudah jalan |
| **password_reset_tokens** | 🔵 Breeze | `ForgotPasswordController`, `ResetPasswordController` | Token reset password |
| **sessions** | 🟢 Laravel | Laravel Auth system (+ Breeze login/logout) | Menyimpan session login — isinya user_id, ip, user_agent |
| **cache / cache_locks** | 🟢 Laravel | Laravel Cache system (konfigurasi .env) | Menyimpan cache aplikasi |
| **jobs / job_batches / failed_jobs** | 🟢 Laravel | Laravel Queue system | Antrian job (contoh: kirim email verifikasi) |

---

## Relasi Antar Tabel (Lengkap dengan Model)

### 🗺️ Diagram Relasi

```
🟠 roles ──1:N──> 🔵🟠 users ──1:N──> 🟠 stock_ins
                    │                  🟠 stock_outs
                    └──1:N──────────>  🟠 stock_ins
                                       🟠 stock_outs

🟠 categories ──1:N──> 🟠 items ──1:N──> 🟠 stock_ins
                    │                  🟠 stock_outs
                    │
🟠 suppliers  ──1:N──> 🟠 items
                    └──1:N──> 🟠 stock_ins
```

> **Catatan:** Tabel bawaan Laravel/Breeze (`migrations`, `password_reset_tokens`, `sessions`, `cache`, `jobs`, dll) tidak memiliki relasi dengan tabel custom di atas. Mereka berdiri sendiri untuk keperluan internal framework.

### Penjelasan Relasi per Origin:

| Relasi | Jenis | Asal | Penjelasan |
|---|---|---|---|
| `roles` → `users` | One to Many | 🟠 **Custom** | Satu role bisa dimiliki **banyak** user. Admin & staff pakai relasi ini |
| `users` → `stock_ins` | One to Many | 🟠 **Custom** | Satu user bisa mencatat **banyak** stok masuk |
| `users` → `stock_outs` | One to Many | 🟠 **Custom** | Satu user bisa mencatat **banyak** stok keluar |
| `categories` → `items` | One to Many | 🟠 **Custom** | Satu kategori bisa dipakai oleh **banyak** barang |
| `suppliers` → `items` | One to Many | 🟠 **Custom** | Satu supplier bisa menyuplai **banyak** barang |
| `suppliers` → `stock_ins` | One to Many | 🟠 **Custom** | Satu supplier bisa tercatat di **banyak** stok masuk |
| `items` → `stock_ins` | One to Many | 🟠 **Custom** | Satu barang bisa memiliki **banyak** riwayat stok masuk |
| `items` → `stock_outs` | One to Many | 🟠 **Custom** | Satu barang bisa memiliki **banyak** riwayat stok keluar |

### Relasi yang Tidak Ada di Tabel Custom:

Tabel internal Laravel/Breeze (`sessions`, `cache`, `jobs`, `password_reset_tokens`) tidak memiliki foreign key ke tabel custom, dan sebaliknya. Mereka berfungsi mandiri:

| Tabel | Hubungan dengan Custom | Alasan |
|---|---|---|
| `sessions.user_id` | ✅ Ada relasi **tidak langsung** | Kolom `user_id` menyimpan id user yang login, tapi tidak ada foreign key constraint |
| `password_reset_tokens.email` | ✅ Ada relasi **tidak langsung** | Email di sini cocok dengan email user, tapi tidak ada foreign key |
| `cache`, `jobs`, dll | ❌ Tidak ada relasi | Murni untuk internal Laravel |

---

## Workflow / Alur Aplikasi

### 1. Alur Login & Autentikasi

```
User buka /login
  → Isi email & password
  → Sistem cocokkan dengan data di tabel users
  → Jika cocok → redirect ke /dashboard
  → Jika tidak → tampilkan error
```

### 2. Alur Kelola Master Data (Kategori, Supplier, Barang)

```
── KATEGORI ──
Tambah:  Isi form (nama, deskripsi) → Simpan → Tersimpan di tabel categories
Edit:    Ubah data → Simpan → Terupdate
Hapus:   Klik hapus → Data terhapus

── SUPPLIER ──
Tambah:  Isi form (nama, kontak, email, telepon, alamat) → Simpan
Edit:    Ubah data → Simpan
Hapus:   Klik hapus → Data terhapus

── BARANG ──
Tambah:  Pilih kategori & supplier, isi SKU, nama, harga, stok awal, min stok
         → Simpan → Data masuk ke tabel items
         → OTOMATIS: Jika stok_quantity > 0, buat record di stock_ins (catatan: "Stok awal")

Edit:    Ubah data barang, termasuk stok
         → Simpan → Data terupdate di items
         → OTOMATIS: Jika stok ditambah → buat record di stock_ins
         → OTOMATIS: Jika stok dikurangi → buat record di stock_outs

Hapus:   Klik hapus → Data barang terhapus
```

### 3. Alur Stok (Otomatis — Kunci Penting Ujian)

```
── SAAT TAMBAH BARANG BARU ──
User isi form barang (termasuk stock_quantity: 50)
  → Simpan ke tabel items (stock_quantity = 50)
  → OTOMATIS: stock_ins terisi:
       item_id = id barang baru
       quantity = 50
       notes = "Stok awal"

── SAAT EDIT STOK BARANG ──
Sebelum: stock_quantity = 50
User ubah menjadi: stock_quantity = 70
  → Selisih = +20 (ditambah)
  → OTOMATIS: stock_ins terisi:
       quantity = 20
       notes = "Penyesuaian stok (tambah)"

Sebelum: stock_quantity = 50
User ubah menjadi: stock_quantity = 30
  → Selisih = -20 (dikurangi)
  → OTOMATIS: stock_outs terisi:
       quantity = 20
       notes = "Penyesuaian stok (kurang)"
```

### 4. Alur Dashboard

```
User buka /dashboard
  → Sistem hitung:
     - Total barang dari tabel items (COUNT)
     - Jumlah barang dengan stok menipis (stock_quantity <= min_stock)
     - 5 riwayat stok masuk terbaru
     - 5 riwayat stok keluar terbaru
  → Tampilkan di halaman dashboard
```

---

## Routes / URL Lengkap

| Method | URL | Controller | Fungsi |
|---|---|---|---|
| GET | `/dashboard` | DashboardController@index | Halaman utama |
| **KATEGORI** | | | |
| GET | `/categories` | CategoryController@index | Daftar kategori |
| GET | `/categories/create` | CategoryController@create | Form tambah kategori |
| POST | `/categories` | CategoryController@store | Simpan kategori baru |
| GET | `/categories/{id}/edit` | CategoryController@edit | Form edit kategori |
| PUT | `/categories/{id}` | CategoryController@update | Update kategori |
| DELETE | `/categories/{id}` | CategoryController@destroy | Hapus kategori |
| **SUPPLIER** | | | |
| GET | `/suppliers` | SupplierController@index | Daftar supplier |
| GET | `/suppliers/create` | SupplierController@create | Form tambah supplier |
| POST | `/suppliers` | SupplierController@store | Simpan supplier |
| GET | `/suppliers/{id}/edit` | SupplierController@edit | Form edit supplier |
| PUT | `/suppliers/{id}` | SupplierController@update | Update supplier |
| DELETE | `/suppliers/{id}` | SupplierController@destroy | Hapus supplier |
| **BARANG** | | | |
| GET | `/items` | ItemController@index | Daftar barang |
| GET | `/items/create` | ItemController@create | Form tambah barang |
| POST | `/items` | ItemController@store | Simpan barang + auto stock_in |
| GET | `/items/{id}/edit` | ItemController@edit | Form edit barang |
| PUT | `/items/{id}` | ItemController@update | Update barang + auto stock_in/out |
| DELETE | `/items/{id}` | ItemController@destroy | Hapus barang |
| **RIWAYAT** (read-only) | | | |
| GET | `/stock-ins` | StockInController@index | Riwayat stok masuk (otomatis) |
| GET | `/stock-outs` | StockOutController@index | Riwayat stok keluar (otomatis) |
| **AUTH** | | | |
| GET | `/login` | — | Halaman login |
| POST | `/login` | — | Proses login |
| GET | `/register` | — | Halaman register |
| POST | `/register` | — | Proses register |
| POST | `/logout` | — | Logout |
| GET | `/profile` | ProfileController@edit | Edit profil |
| PATCH | `/profile` | ProfileController@update | Update profil |

---

## Contoh Skenario Lengkap (Latihan Ujian)

### Skenario: Toko Elektronik

1. **Login** sebagai admin (admin@demo.com / password)
2. **Buat Kategori**: "Elektronik", "ATK", "Makanan"
3. **Buat Supplier**: "PT Sumber Jaya", "CV Makmur"
4. **Tambah Barang**:
   - Nama: "Mouse Logitech", SKU: "MSE-001", Kategori: Elektronik
   - Harga Beli: 50000, Harga Jual: 75000
   - Stok Awal: 100, Min Stok: 10
   - → Simpan → Lihat **Riwayat Stok Masuk** → ada catatan "Stok awal" qty 100
5. **Edit Barang** (tambah stok):
   - Ubah stok dari 100 menjadi 150
   - → Lihat **Riwayat Stok Masuk** → ada catatan "Penyesuaian stok (tambah)" qty 50
6. **Edit Barang** (kurangi stok):
   - Ubah stok dari 150 menjadi 120
   - → Lihat **Riwayat Stok Keluar** → ada catatan "Penyesuaian stok (kurang)" qty 30

---

## Teknologi

- **Laravel 13** — Framework PHP (MVC)
- **Breeze (Blade)** — Auth scaffolding (login, register)
- **Tailwind CSS** — Utility-first CSS framework
- **MySQL 8.4** — Database relasional
- **Vite** — Frontend asset bundler
