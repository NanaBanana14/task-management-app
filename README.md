# Sistem Manajemen Proyek dan Tugas

Sistem ini dikembangkan menggunakan Laravel 10, Filament Admin, PostgreSQL, TailwindCSS, dan Spatie Laravel Permission.

## Spesifikasi Software

- PHP >= 8.1
- Composer
- Node.js >= 16.x + npm
- PostgreSQL >= 13
- Laravel 10
- Filament Admin Panel (berbasis TailwindCSS)
- Spatie Laravel Permission
- TailwindCSS (digunakan melalui Filament)

---

## Instalasi dan Menjalankan Secara Lokal

### 1. Clone Repository

```bash
git clone [url-repository].git
cd [nama-folder-project]
```

### 2. Install Dependency PHP

```bash
composer install
```

### 3. Install Dependency Frontend (Filament dan TailwindCSS)

```bash
npm install
npm run build
```

### 4. Konfigurasi Environment

Salin file `.env.example` menjadi `.env`

```bash
cp .env.example .env
```

Edit `.env` untuk menyesuaikan koneksi database PostgreSQL Anda:

```env
DB_CONNECTION=pgsql
DB_HOST=127.0.0.1
DB_PORT=5432
DB_DATABASE=nama_database
DB_USERNAME=username_database_anda
DB_PASSWORD=password_database_anda
```

### 5. Generate Key Laravel

```bash
php artisan key:generate
```

### 6. Jalankan Migrasi Database

```bash
php artisan migrate
```

### 7. Instalasi Filament Admin Panel

```bash
composer require filament/filament -W
php artisan filament:install
```

### 8. Buat Akun Admin Pertama

```bash
php artisan make:filament-user
```

Isi nama, email (misal `superadmin@gmail.com`), dan password saat diminta.

### 9. Jalankan Server Lokal

```bash
php artisan serve
```

Akses aplikasi melalui `http://127.0.0.1:8000`

---

## Akses Filament Admin Panel

Untuk mengakses dashboard administrasi Filament:

```
http://127.0.0.1:8000/admin/login
```

**Contoh akun default:**

- **Email**: superadmin@gmail.com
- **Password**: [password yang Anda set]

---

## Sistem Manajemen Role dan Permission

Sistem ini menggunakan konsep **Role-Based Access Control (RBAC)** dengan **Spatie Laravel Permission**.

### 1. Membuat Role Baru (Agar daftar role masuk ke sistem database)

Gunakan perintah berikut untuk membuat role:

```bash
php artisan permission:create-role Admin
php artisan permission:create-role Super Admin
php artisan permission:create-role Manager
php artisan permission:create-role Staff
```

### 2. Memberikan Role ke User

Gunakan Filament Admin Panel atau artisan tinker:

```bash
php artisan tinker
```

```php
$user = App\Models\User::find(1); // Ganti ID user sesuai kebutuhan
$user->assignRole('Manager');
```

### 3. Akses Resource Berdasarkan Role

Hanya user dengan role berikut yang dapat mengakses **Project**, **Task**, dan **Comment** di admin panel:

- Super Admin
- Admin
- Manager

Akses ini diatur menggunakan **Filament Shield**.

---

## Petunjuk Instalasi Berdasarkan Sistem Operasi

### Windows

1. Install **XAMPP** atau **Laragon** (pastikan PHP >= 8.1)
2. Install PostgreSQL
3. Install Composer dan Node.js
4. Ikuti langkah instalasi di atas melalui Git Bash, CMD, atau Terminal VS Code.

### macOS

1. Install **Homebrew**
2. Install PHP, Composer, Node.js, PostgreSQL:

```bash
brew install php composer node postgresql
```

3. Jalankan PostgreSQL:

```bash
brew services start postgresql
```

4. Ikuti langkah instalasi.

### Linux (Ubuntu/Debian)

1. Update package list dan install dependency:

```bash
sudo apt update
sudo apt install php php-cli php-pgsql composer nodejs npm postgresql
```

2. Jalankan PostgreSQL:

```bash
sudo service postgresql start
```

3. Ikuti langkah instalasi.

---

## Catatan Tambahan

- Pastikan database sudah dibuat di PostgreSQL sebelum migrasi.
- Reset database jika diperlukan:

```bash
php artisan migrate:fresh --seed
```

- Untuk rebuild asset Filament (TailwindCSS dan JS):

```bash
npm run build
```

- TailwindCSS sudah otomatis terintegrasi melalui Filament.
- Jika ada error, cek log Laravel di:

```
storage/logs/laravel.log
```

atau gunakan:

```bash
php artisan
```
untuk troubleshooting.

---

# 📌 Catatan Penting

- Role dan Permission **wajib** dikonfigurasi setelah instalasi.
