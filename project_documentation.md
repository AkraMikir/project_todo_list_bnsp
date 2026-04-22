# UpTodo - Dokumentasi Proyek

1. Gambaran Umum (Overview)

Nama Proyek: UpTodo

Deskripsi Singkat:
UpTodo adalah aplikasi manajemen tugas (todo list) berbasis web dengan desain yang dioptimalkan untuk perangkat seluler (mobile-first). Aplikasi ini membantu pengguna untuk mencatat, mengelola tingkat prioritas tugas, mengkategorikan pekerjaan, memisahkan tugas utama menjadi sub-tugas kecil, serta melihat jadwal harian melalui fitur kalender yang interaktif.

Tech Stack:
- Backend Framework: Laravel 13
- Bahasa Pemrograman: PHP 8.3+
- Frontend / View: Laravel Blade Template, TailwindCSS v4
- Interaktivitas: Alpine.js (untuk state sisi klien, modal, dropdown)
- Asset Bundler: Vite
- Database: SQLite (Default) atau MySQL 8.x


2. Persyaratan Sistem (Prerequisites)

Sebelum dapat menginstal dan menjalankan aplikasi ini, pastikan sistem Anda telah memiliki perangkat lunak berikut:
- PHP (minimal versi 8.3 atau lebih baru)
- Composer (untuk mengelola dependensi PHP Laravel)
- Node.js & NPM (untuk kompiler aset CSS/JS menggunakan Vite)
- Database (SQLite bawaan, atau MySQL/PostgreSQL jika ingin menggunakan DB manager lain)
- Git (untuk kloning repositori)


 3. Panduan Instalasi (Local Setup)

Berikut adalah langkah demi langkah untuk mulai menjalankan aplikasi di mesin lokal (localhost):

Langkah 1: Clone repositori proyek
git clone https://github.com/AkraMikir/project_todo_list_bnsp.git

Langkah 2: Masuk ke folder proyek
cd project_todo_list_bnsp

Langkah 3: Instal dependensi PHP (Laravel) composer install

Langkah 4: Instal dependensi Node (Tailwind & Vite) npm install

Langkah 5: Salin file environment cp .env.example .env

Langkah 6: Buat Application Key Laravel php artisan key:generate

Langkah 7: Konfigurasi Database SQLiteJika pada file .env bagian database  menggunakan DB_CONNECTION=sqlite, Laravel akan otomatis membuat file database.sqlite jika belum ada.

Langkah 8: Jalankan Migrasi dan Seeder(Perintah ini akan membuat struktur tabel database dan mengisi data awal seperti kategori default)
php artisan migrate --seed

Langkah 9: Jalankan Server Lokal
Anda perlu menjalankan dua perintah terminal ini secara bersamaan.
Terminal 1 (Menjalankan PHP Server): php artisan serve
Terminal 2 (Menjalankan Hot-Reload Vite & Tailwind): npm run dev

Aplikasi dapat diakses di http://localhost:8000.


4. Konfigurasi Khusus (Environment Configuration)

Bagian-bagian file .env yang memerlukan perhatian lebih:
- DB_CONNECTION=sqlite: Konfigurasi default proyek adalah menggunakan SQLite. Jika Anda ingin menggunakan MySQL, ubah menjadi mysql dan setel variabel DB_DATABASE, DB_USERNAME, DB_PASSWORD dengan kredensial dari phpMyAdmin/MySQL Workbench Anda.
- APP_URL=http://localhost:8000: Sesuaikan ini jika Anda menggunakan virtual host agar asset URL mereload dengan benar.
- Layanan Eksternal: Tidak ada API eksternal pihak ketiga (seperti Payment Gateway atau S3) yang dikonfigurasikan di proyek saat ini.


5. Struktur Arsitektur & Direktori

Proyek ini mengandalkan struktur MVC bawaan Laravel dengan beberapa penyesuaian:
- Logika Bisnis (Controllers): Tersimpan di app/Http/Controllers/ (TaskController, SubTaskController, CategoryController, AuthController).
- Tampilan dan Komponen (Views): Berada di resources/views/. Komponen terpisah seperti UI Navbar, Bottom Navigation, atau icon disatukan ke dalam folder resources/views/components/ dan partials/ untuk konsep reusable view.
- Logika Frontend: Mengingat proyek ini mobile-first, fungsionalitas UI (modal, tab) dibangun langsung pada file blade masing-masing menggunakan sintaks Alpine.js (x-data, x-show).


6. Dokumentasi Database & Relasi

Aplikasi menggunakan skema relasional dengan hubungan entitas sebagai berikut:
- Users (1) memiliki banyak (N) Categories.
- Users (1) memiliki banyak (N) Tasks.
- Categories (1) menaungi banyak (N) Tasks.
- Tasks (1) memiliki banyak (N) SubTasks.

Rincian Tabel Utama:
1. users: Tabel pengguna inti (name, email, password).
2. categories: Kategori pekerjaan (name, color, icon, user_id).
3. tasks: Tugas yang dikelola (title, description, task_date, task_time, deadline, priority, is_completed, user_id, category_id).
4. sub_tasks: Tugas turunan (title, is_completed, task_id).

Daftar Seeder (DatabaseSeeder.php):
Secara otomatis akan mendatangkan CategorySeeder. Ini berfungsi memasukkan data kategori default (misal: "Work", "Personal") sehingga pengguna melihat opsi kategori meskipun belum membuat kategori baru secara custom.


7. Dokumentasi API

Karena aplikasi UpTodo dirancang menggunakan arsitektur Monolith (server-side rendering via Blade Template dan web route sessions), tidak ada REST API endpoint publik khusus berbasis JSON yang dikonfigurasi. Segala arus pertukaran data dilayani melalui rute web (routes/web.php) menggunakan Session Middleware.


8. Panduan Pengujian (Testing)

Proyek ini dapat diuji menggunakan framework unit test bawaan Laravel (PHPUnit/Pest). Beberapa skenario mungkin telah diikutsertakan di folder tests.

Untuk mengeksekusi semua tes perintahnya adalah:
php artisan test


9. Panduan Deployment

Saat tiba waktu untuk merilis proyek ini ke production server, lakukan langkah-langkah berikut:

- Jalankan asset bundler (Untuk mengompilasi CSS agar berukuran kecil):
npm run build

- Setup file env production (Ubah di server produksi):
APP_ENV=production
APP_DEBUG=false

- Migrasi Database:
php artisan migrate --force

- Optimasi Laravel (Cache config & routes):
php artisan optimize
php artisan view:cache
php artisan event:cache
