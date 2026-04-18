# UpTodo - Dokumentasi Proyek

UpTodo adalah aplikasi manajemen tugas (*todo list*) berbasis web yang dirancang untuk layar *mobile-first*. Aplikasi ini memungkinkan pengguna untuk membuat, mengelola, dan melacak tugas harian mereka dengan antarmuka yang modern dan mudah digunakan.

---

## 🔥 Fitur Utama
1. **Autentikasi Pengguna**: Login, registrasi, dan perlindungan halaman khusus pengguna yang sudah *login* (*Session/Middleware*).
2. **Manajemen Tugas (Task Management)**:
   - Membuat tugas baru dengan batas waktu waktu (*due date* dan *time*).
   - Menandai tugas sebagai selesai atau belum selesai (*toggle complete*).
   - Mengedit dan menghapus tugas.
3. **Sub-Tugas (Sub-Tasks)**:
   - Memecah tugas utama menjadi beberapa sub-tugas yang lebih kecil.
   - Menandai setiap sub-tugas secara individual.
4. **Kategori Tugas**:
   - Kategorisasi tugas (misalnya: *Work*, *Personal*, *Study*) yang dikelola untuk masing-masing pengguna.
   - Warna kategori agar mudah dibedakan secara visual.
5. **Kalender (Calendar View)**:
   - Menampilkan tugas-tugas dalam format jadwal/kalender untuk melacak apa yang harus dilakukan pada hari tertentu.
6. **Profil Pengguna**:
   - Menampilkan statistik tugas pengguna dan pengaturan (opsional).
7. **Antarmuka Mobile-First**: 
   - UI yang dirancang seolah-olah menggunakan aplikasi *native app* di *smartphone* (Responsive dan interaktif).

---

## 🛠️ Sistem dan Teknologi Pendukung
Proyek ini dikembangkan menggunakan tumpukan teknologi modern:
- **Backend Framework**: Laravel (PHP)
- **Frontend / View Engine**: Laravel Blade Templating
- **Styling**: Tailwind CSS (Utility-first CSS framework untuk mendesain secara cepat dan responsif)
- **Interaktivitas (Javascript)**: Alpine.js (Digunakan untuk interaktivitas komponen seperti *modal*, *dropdown*, *tabs*, dan peralihan *state* di sisi klien)
- **Database**: MySQL / SQLite (Sesuai dengan konfigurasi `.env`)

---

## 🗄️ Database Schema & Models

Sistem menggunakan Relational Database dengan struktur model sebagai berikut:

### 1. `User` Model (`users` table)
Menyimpan data pengguna terdaftar.
- `id` (Primary Key)
- `name`
- `email` (Unique)
- `password`
- `remember_token` & *Timestamps*

### 2. `Category` Model (`categories` table)
Menyimpan daftar kategori yang bisa dipilih saat membuat tugas.
- `id` (Primary Key)
- `user_id` (Foreign Key - Relasi `belongsTo` User)
- `name` (Nama Kategori, misal: Pekerjaan, Rumah)
- `color` (Warna label untuk kategori)
- `icon` (Ikon/gambar representasi kategori)
- *Timestamps*

### 3. `Task` Model (`tasks` table)
Tabel utama untuk menyimpan *todo-list* atau tugas harian.
- `id` (Primary Key)
- `user_id` (Foreign Key - Relasi `belongsTo` User)
- `category_id` (Foreign Key - Relasi `belongsTo` Category, Nullable)
- `title` (Judul Tugas)
- `description` (Deskripsi opsional)
- `task_date` (Tanggal tugas)
- `task_time` (Waktu tugas)
- `priority` (Tingkat urgensi, misal 1 - 10)
- `is_completed` (Boolean - Selesai/Belum)
- *Timestamps*

### 4. `SubTask` Model (`sub_tasks` table)
Tabel untuk tugas-tugas kecil bagian dari `Task` utama.
- `id` (Primary Key)
- `task_id` (Foreign Key - Relasi `belongsTo` Task)
- `title` (Nama sub-tugas)
- `is_completed` (Boolean)
- *Timestamps*

*Seluruh skema dibuat via fitur **Laravel Migrations**.*

---

## 💻 Tampilan (Views)
File tampilan menggunakan ekstensi `.blade.php` dan terorganisir di dalam folder `resources/views/`:

1. **`welcome.blade.php`**: Beranda aplikasi (*landing page*) / *Splash Screen & Onboarding step* (Perkenalan fitur aplikasi ke user baru).
2. **`auth/`**: Tampilan halaman pendaftaran (`register.blade.php`) dan login (`login.blade.php`).
3. **`tasks/`**: Menampung komponen layar utama (Beranda Tugas), pembuatan, dan detail tugas.
4. **`calendar/`**: Tampilan layar penjadwalan / *Calendar view*.
5. **`categories/`**: Tampilan manajemen kategori.
6. **`profile/`**: Tampilan profil pengguna.
7. **`components/`** & **`partials/`**: Tampilan komponen *reusable* (seperti Navbar bawahan (*Bottom Navigation*), struktur layout dasar aplikasi/app layout).

---

## ⚙️ Core Functions (Controllers)
Logika *backend* aplikasi direpresentasikan dalam bentuk kontroler yang menangani alur *Request - Response*, dipetakan dari `routes/web.php`.

### 1. `AuthController`
Menangani otentikasi.
- `showLogin()` / `showRegister()`: Menampilkan *form*.
- `login()`: Memvalidasi kredensial pengguna dan mengamankan *session*.
- `register()`: Mendaftarkan akun baru ke database.
- `logout()`: Mengakhiri *session* pengguna.

### 2. `TaskController`
Resource Controller untuk *Task Utama*.
- `index()`: Memuat seluruh daftar tugas (bisa difilter berdasarkan yang belum/selesai) untuk halaman *Home*.
- `store()`: Fungsi untuk menyimpan data *Task* baru (termasuk *date, time, category, priority*).
- `show()`, `edit()`, `update()`, `destroy()`: Operasi standar (CRUD) atas *Task*.
- `toggleComplete()`: Fungsi untuk mengubah status *Task* (*checklist*).
- `calendar()`: Menampilkan *view* dengan grup tugas diurutkan berdasarkan hari/tanggal.

### 3. `SubTaskController`
- `store()`: Menambahkan sub-tugas baru ke sebuah *Task* (*task_id*).
- `toggleComplete()`: *Checklist* terpisah untuk anak-tugas.
- `destroy()`: Hapus sub-tugas.

### 4. `CategoryController`
- Menangani operasi simpan, ubah, dan hapus *Kategori* yang disesuaikan atau dibuat oleh akun pengguna.

---
*Dokumentasi ini menjelaskan kerangka dasar aplikasi UpTodo berbasis Laravel, dengan pendekatan pengembangan sistem responsif untuk pengalaman pengguna mobile yang efisien.*
