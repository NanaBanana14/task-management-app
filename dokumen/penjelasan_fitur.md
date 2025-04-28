# Penjelasan Fitur Sistem Manajemen Proyek dan Tugas

_Dibangun menggunakan Laravel 10, Filament, Spatie Permission._

---

## 1. Hak Akses Berdasarkan Role

| Role | Akses |
|:----|:-----|
| Super Admin / Admin / Manager | CRUD User, Project, Project Member, Task, Sub Task, Comment |
| Staff | - Melihat daftar Project & Project Member berdasarkan login <br> - Mengedit Status Project <br> - Melihat, mengubah Status Task, menambah SubTask <br> - Melihat daftar Comment berdasarkan Task <br> - Melihat dan Membalas Comment miliknya di halaman My Comment |

---

## 2. Fitur untuk Super Admin, Admin, dan Manager

### 2.1. Manajemen User
- **CRUD User** (Create, Read, Update, Delete).
- Memberikan dan mengelola Role untuk User.

**Screenshot:**
![User Management](dokumen/image/user_management.png)

### 2.2. Manajemen Role
- Role yang tersedia:
  - Super Admin
  - Admin
  - Manager
  - Staff
- Menggunakan **Spatie Permission**.

### 2.3. Manajemen Proyek
- Membuat, Mengedit, Menghapus Project.
- Input meliputi nama, deskripsi, tanggal mulai, dan tanggal selesai.

**Screenshot:**
![CRUD Project](dokumen/image/crud_project.png)

### 2.4. Manajemen Anggota Proyek (Project Member)
- Menambahkan dan menghapus anggota dalam sebuah Project.

**Screenshot:**
![Project Member](dokumen/image/project_member.png)

### 2.5. Manajemen Tugas
- Membuat, Mengedit, Menghapus Task dalam sebuah Project.
- Task dapat berisi:
  - Judul
  - Deskripsi
  - Status
  - Prioritas
  - Tanggal penyelesaian
- Assign Task ke user.

**Screenshot:**
![Task Management](dokumen/image/task_management.png)

### 2.6. Manajemen Sub Task
- Membuat SubTask dalam sebuah Task.
- Setiap Task bisa memiliki banyak SubTask.

### 2.7. Komentar pada Task
- Menambahkan komentar dalam Task untuk berkomunikasi tim.

**Screenshot:**
![Comment on Task](dokumen/image/comment_task.png)

---

## 3. Fitur untuk Staff

### 3.1. Halaman Project
- **Melihat daftar Project** di mana dirinya menjadi anggota.
- **Mengubah status Project** (contoh: On Progress, Done).

**Screenshot:**
![CRUD Project](dokumen/image/crud_project.png)

### 3.2. Halaman Task
- **Melihat daftar Task dan Sub Task** terkait dirinya.
- **Mengubah status Task** (misal: Not Started → In Progress → Completed).
- **Menambahkan Sub Task** baru pada Task utama.

**Screenshot:**
![Task Management](dokumen/image/task_management.png)

### 3.3. Komentar pada Task
- **Melihat daftar komentar** pada Task yang diklik.
- **Menambah komentar** di Task.

**Screenshot:**
![Comment on Task](dokumen/image/comment_task.png)

### 3.4. Halaman My Comment
- **Melihat semua komentar** yang pernah dibuat sendiri.
- **Membalas komentar** yang sudah ada.

**Screenshot:**
![My Comment](dokumen/image/my_comment.png)

---

## 4. Ringkasan Relasi Database

| Tabel | Relasi | Keterangan |
|:------|:-------|:-----------|
| projects → tasks | 1 to Many | 1 Project memiliki banyak Tasks |
| tasks → sub_tasks | 1 to Many | 1 Task memiliki banyak SubTasks |
| tasks → comments | 1 to Many | 1 Task memiliki banyak Comments |
| users → tasks | 1 to Many | 1 User membuat banyak Tasks |
| projects → project_members | 1 to Many | 1 Project memiliki banyak Member |
| users ⇌ roles | Many to Many (Polymorphic) | 1 User memiliki banyak Roles, 1 Role dimiliki banyak Users |

---
