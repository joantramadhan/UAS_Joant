# Colection Book by Joant - Sistem Manajemen Buku Perpustakaan
 Nama: Joant Ramadhan Fernando<br>
 Nim: 312410594<br>
<br>Project ini adalah aplikasi web sederhana untuk manajemen data buku (Library Management System) yang dibangun untuk memenuhi tugas **UAS Pemrograman Web**. Aplikasi ini dikembangkan menggunakan PHP Native dengan konsep **OOP (Object Oriented Programming)**, pola arsitektur **MVC (Model-View-Controller)**, dan **Bootstrap 5** untuk antarmuka pengguna.

##  Fitur Utama

1.  **Arsitektur MVC & OOP**: Struktur kode modular dan rapi.
2.  **Routing System**: Menggunakan `.htaccess` untuk URL yang bersih (Prettified URL).
3.  **Multi-Level Login**:
    * **Admin**: Full akses (CRUD Buku, Upload Cover, Edit, Hapus).
    * **User**: Read-only (Melihat daftar, Detail buku, Pencarian).
4.  **Manajemen Buku (CRUD)**:
    * Create: Tambah buku baru dengan upload gambar cover.
    * Read: Menampilkan daftar buku dengan Pagination & Search.
    * Update: Edit data buku dan ganti cover gambar.
    * Delete: Hapus buku beserta file gambarnya dari server.
5.  **Fitur Tambahan**:
    * **Pencarian (Search)**: Cari buku berdasarkan Judul atau Penulis.
    * **Pagination**: Navigasi halaman otomatis.
    * **Modal Detail**: Popup untuk melihat detail buku tanpa refresh halaman.
    * **Responsive Design**: Tampilan mobile-first dengan Bootstrap 5.

##  Teknologi yang Digunakan

* **Backend**: PHP 8 (PDO, OOP Concept).
* **Database**: MySQL.
* **Frontend**: HTML5, CSS3, Bootstrap 5.3 (CDN), FontAwesome (Icon).
* **Server**: Apache (XAMPP).

##  Screenshot Proses Web Flow
![Cuplikan layar_5-1-2026_17743_localhost](https://github.com/user-attachments/assets/a874bdfe-b650-4564-b28c-1eb25e873b55)
1.Validasi username/password untuk membedakan akses Admin (Full) dan User (Read-only).
![Cuplikan layar_5-1-2026_173414_localhost](https://github.com/user-attachments/assets/15f0e0b9-b592-49ff-825e-4886c6fc3ab1)
2.Menampilkan status login pengguna dan informasi teknis server (PHP/Database).
![Cuplikan layar_5-1-2026_173428_localhost](https://github.com/user-attachments/assets/1775f390-ec68-4864-97d6-f358d227981b)
3.Menampilkan tabel data buku dengan fitur Pagination agar tampilan rapi.
![Cuplikan layar_5-1-2026_171750_localhost](https://github.com/user-attachments/assets/3c59e78f-b7dd-4391-911a-94a411cc9a6b)
4.Menggunakan Modal Popup untuk melihat cover besar tanpa refresh halaman.
![Cuplikan layar_5-1-2026_173332_localhost](https://github.com/user-attachments/assets/a1c1d511-9a9b-4c12-9d90-33ac65a2125d)
5.Form input khusus Admin dengan fitur Upload Gambar (validasi format JPG/PNG).

## ⚙️ Cara Instalasi & Menjalankan

1.  **Clone Repository** atau Download ZIP project ini.
2.  Simpan folder di dalam `htdocs` (misal: `C:\xampp\htdocs\pemrograman_web`).
3.  **Setup Database**:
    * Buka phpMyAdmin.
    * Buat database baru bernama `uas_web`.
    * Import file `database.sql` yang ada di root folder project.
    * *Opsional:* Jika ingin fitur gambar berjalan lancar, pastikan folder `assets/img/` sudah dibuat.
4.  **Konfigurasi**:
    * Cek `config/database.php` pastikan user/password database sesuai (Default XAMPP: root/kosong).
5.  **Jalankan**:
    * Buka browser dan akses: `http://localhost/pemrograman_web/`

## 🔐 Akun Login (Default)

| Role | Username | Password | Hak Akses |
| :--- | :--- | :--- | :--- |
| **Admin** | `admin` | `admin` | Create, Read, Update, Delete |
| **User** | `user` | `user` | Read Only, Search, Pagination |

## 📂 Struktur Folder

```text
/pemrograman_web
├── assets/
│   ├── css/ (Custom Style)
│   └── img/ (Tempat penyimpanan cover buku)
├── config/ (Koneksi Database)
├── controllers/ (Logika Bisnis & Routing)
├── models/ (Interaksi Database)
├── views/ (Antarmuka Pengguna)
├── index.php (Entry Point & Routing)
└── .htaccess (URL Rewrite Rules)
