# Employee Management System

Aplikasi manajemen data pegawai berbasis web yang dibangun dengan **Laravel 12**, **Bootstrap 5**, **jQuery**, dan **DataTables**.

---

## 🛠️ Kebutuhan Sistem

Pastikan perangkat Anda sudah terinstal:

| Kebutuhan | Versi Minimum |
|---|---|
| PHP | 8.2 |
| Composer | 2.x |
| MySQL | 5.7 / MariaDB 10.3 |
| Node.js & NPM | 18.x |

---

## 🚀 Langkah-langkah Setup

### 1. Clone Repositori

```bash
git clone <URL_REPOSITORI>
cd EmployeeManagement
```

### 2. Install Dependensi PHP

```bash
composer install
```

### 3. Salin File Environment

```bash
cp .env.example .env
```

### 4. Generate Application Key

```bash
php artisan key:generate
```

### 5. Konfigurasi Database

Buka file `.env` dan sesuaikan pengaturan database Anda:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=employee_management
DB_USERNAME=root
DB_PASSWORD=
```

> **Catatan:** Pastikan database `employee_management` sudah dibuat terlebih dahulu di MySQL/phpMyAdmin sebelum menjalankan migrasi.

Untuk membuat database baru lewat MySQL:
```sql
CREATE DATABASE employee_management;
```

### 6. Jalankan Migrasi Database

```bash
php artisan migrate
```

### 7. Buat Symbolic Link Storage

Agar foto pegawai yang diupload dapat diakses publik:

```bash
php artisan storage:link
```

### 8. Jalankan Seeder Data Dummy

Isi database dengan data pegawai contoh (10 data tetap + 20 data acak):

```bash
php artisan db:seed --class=PegawaiSeeder
```

Atau jalankan semua seeder sekaligus:

```bash
php artisan db:seed
```

> **Aman dijalankan berkali-kali** — menggunakan `firstOrCreate` sehingga tidak akan membuat data duplikat.

### 9. Install Dependensi Node.js (Opsional)

Hanya diperlukan jika Anda ingin mengembangkan aset front-end:

```bash
npm install
```

### 9. Jalankan Aplikasi

```bash
php artisan serve
```

Aplikasi akan berjalan di: **http://localhost:8000**

Akses halaman manajemen pegawai di: **http://localhost:8000/pegawai**

---

## 📁 Struktur Fitur

| Fitur | Deskripsi |
|---|---|
| Daftar Pegawai | Tampil data pegawai dengan DataTables (server-side) |
| Tambah Pegawai | Form modal untuk menambah pegawai baru |
| Pencarian | Cari berdasarkan nama atau email |
| Filter Jabatan | Filter data berdasarkan jabatan (Manager, HR, IT) |
| Upload Foto | Upload foto profil pegawai (JPG/PNG, maks. 2MB) |

---

## 📦 Teknologi yang Digunakan

- **Laravel 12** — Backend framework PHP
- **Yajra DataTables** — Server-side DataTables untuk Laravel
- **Bootstrap 5.3** — CSS framework untuk tampilan UI
- **jQuery 3.6** — Library JavaScript
- **Select2** — Dropdown interaktif
- **Bootstrap FileInput** — Komponen upload file
- **Daterangepicker** — Komponen pemilih tanggal

---

## 🗃️ Struktur Tabel `pegawais`

| Kolom | Tipe | Keterangan |
|---|---|---|
| `id` | `bigint` | Primary key, auto increment |
| `nama` | `varchar(255)` | Nama lengkap pegawai |
| `email` | `varchar(255)` | Email pegawai (unik) |
| `jabatan` | `varchar(255)` | Jabatan (Manager / HR / IT) |
| `tanggal_lahir` | `date` | Tanggal lahir pegawai |
| `foto` | `varchar(255)` | Path foto profil (nullable) |
| `created_at` | `timestamp` | Waktu dibuat |
| `updated_at` | `timestamp` | Waktu diperbarui |

---

## ❗ Troubleshooting

### Error: `Table 'employee_management.migrations' doesn't exist in engine` (1932 / 1813)

Ini terjadi karena file InnoDB orphan di direktori data MySQL. Solusi:

1. Hapus folder `employee_management` dari direktori data MySQL (biasanya `D:\xampp\mysql\data\employee_management`)
2. Buat ulang database:
   ```sql
   CREATE DATABASE employee_management;
   ```
3. Jalankan migrasi kembali:
   ```bash
   php artisan migrate
   ```

### Error: `Class 'Yajra\DataTables\...' not found`

Jalankan:
```bash
composer require yajra/laravel-datatables-oracle
php artisan vendor:publish --tag=datatables
```

---

## 📄 Lisensi

Proyek ini dibuat untuk keperluan **Fullstack Laravel Challenge**.
