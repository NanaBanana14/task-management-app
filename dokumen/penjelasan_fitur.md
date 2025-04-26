# Penjelasan Fitur Sistem Manajemen Proyek dan Tugas

Dokumen ini menjelaskan fitur-fitur utama dari sistem manajemen proyek dan tugas yang dibangun menggunakan Laravel 10, Filament, dan Spatie Permission.

## 1. Manajemen Proyek

### a. Pembuatan Proyek
- Pengguna dapat membuat proyek baru.
- Data yang diinput meliputi nama proyek, deskripsi, tanggal mulai, dan tanggal selesai.

### b. Project Member
- Admin dapat menambahkan anggota ke dalam proyek.
- Setiap proyek dapat memiliki banyak anggota (Relasi 1 to Many dari `projects` ke `project_members`).

## 2. Manajemen Tugas (Task Management)

### a. Pembuatan Task
- Setiap proyek dapat memiliki banyak task.
- Setiap task mencakup judul, deskripsi, status, prioritas, dan tanggal penyelesaian.
- Relasi: 1 Project to Many Tasks.

### b. SubTask
- Setiap task dapat dipecah menjadi beberapa subtask untuk memudahkan pengerjaan bertahap.
- Relasi: 1 Task to Many SubTasks.

### c. Assignment Task
- Task dapat ditugaskan ke user tertentu.
- Relasi: 1 User to Many Tasks.

## 3. Komentar pada Task
- Pengguna dapat memberikan komentar pada sebuah task untuk berkomunikasi.
- Setiap task bisa memiliki banyak komentar.
- Relasi: 1 Task to Many Comments.

## 4. Log Activity
- Setiap perubahan data penting (seperti membuat, mengubah, atau menghapus proyek atau tugas) dicatat ke tabel `log_activities`.
- Relasi: 1 User to Many LogActivities.

## 5. Manajemen Subtask
- Fitur untuk membuat, memperbarui, dan menyelesaikan subtask.
- Subtask terkait ke task utama.

## 6. Manajemen User dan Role

### a. Role-Based Access Control (RBAC)
- Sistem menggunakan package Spatie Permission untuk mengelola roles dan permissions.

### b. Roles
- Role seperti SuperAdmin, Admin, Manager, Staff dapat dibuat.
- Tabel `roles` menyimpan semua role.

### c. User Role Assignment
- Relasi Many to Many polymorphic: satu user bisa memiliki banyak role.
- Tabel pivot `model_has_roles` menghubungkan users dengan roles.

### d. Manajemen User oleh SuperAdmin/Admin
- SuperAdmin atau Admin dapat membuat, mengedit, dan menghapus user.
- SuperAdmin atau Admin dapat menentukan role untuk setiap user.
- Hak akses user diatur berdasarkan role yang dimiliki.

## 7. Hak Akses
- Fitur tertentu dibatasi berdasarkan role.
- Contoh: hanya Admin yang bisa menghapus proyek.

## Ringkasan Relasi Database
| Tabel | Relasi | Keterangan |
|:------|:-------|:-----------|
| projects → tasks | 1 to Many | 1 Project memiliki banyak Tasks |
| tasks → sub_tasks | 1 to Many | 1 Task memiliki banyak SubTasks |
| tasks → comments | 1 to Many | 1 Task memiliki banyak Comments |
| users → tasks | 1 to Many | 1 User membuat banyak Tasks |
| users → log_activities | 1 to Many | 1 User memiliki banyak LogActivities |
| projects → project_members | 1 to Many | 1 Project memiliki banyak Member |
| users ⇌ roles | Many to Many (Polymorphic) | 1 User memiliki banyak Roles, 1 Role dimiliki banyak Users |

---

