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

Untuk menginstall Filament, jalankan perintah berikut:

```bash
composer require filament/filament -W
php artisan filament:install
```

### 8. Buat Akun Admin Pertama

Setelah melakukan migrasi dan instalasi Filament, buat akun admin pertama dengan menjalankan perintah berikut:

```bash
php artisan make:filament-user
```

Ikuti instruksi untuk mengisi nama, email (misalnya `superadmin@gmail.com`), password.

### 9. Jalankan Server Lokal

```bash
php artisan serve
```

Akses aplikasi di browser melalui `http://127.0.0.1:8000`

## Akses Filament Admin Panel

Untuk mengakses dashboard administrasi Filament, buka:

```plaintext
http://127.0.0.1:8000/admin/login
```

**Contoh akun default yang bisa dibuat dengan `php artisan make:filament-user`:**

- **Email**: superadmin@gmail.com
- **Password**: [password yang di set saat membuat user]

## Petunjuk Instalasi Berdasarkan Sistem Operasi

### Windows

1. Install **XAMPP** atau **Laragon** (pastikan PHP >= 8.1)
2. Install PostgreSQL
3. Install Composer dan Node.js
4. Ikuti langkah instalasi di atas melalui Git Bash, CMD, atau Terminal VS Code.

### macOS

1. Install **Homebrew**
2. Install PHP, Composer, Node.js, PostgreSQL melalui Homebrew:

```bash
brew install php composer node postgresql
```

3. Jalankan PostgreSQL:

```bash
brew services start postgresql
```

4. Ikuti langkah instalasi di atas.

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

3. Ikuti langkah instalasi di atas.

## Catatan Tambahan

- Pastikan database sudah dibuat di PostgreSQL sebelum menjalankan migrasi.
- Gunakan perintah berikut untuk reset database:

```bash
php artisan migrate:fresh --seed
```

- Untuk membangun ulang asset Filament (TailwindCSS dan JS):

```bash
npm run build
```

- Sistem ini menggunakan **Role Based Access Control (RBAC)** berbasis **Spatie Permission**, dikelola melalui **Filament Admin Panel**.
- Manajemen User, Role, dan Permission hanya dapat diakses oleh **Super Admin/Admin** melalui panel admin.
- TailwindCSS digunakan melalui integrasi otomatis Filament untuk styling dashboard.

---
Jika ada error atau masalah, cek log Laravel di `storage/logs/laravel.log` atau gunakan perintah `php artisan` untuk troubleshooting.