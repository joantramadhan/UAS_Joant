# Colection Book by Joant - Sistem Manajemen Buku Perpustakaan

Project ini adalah aplikasi web sederhana untuk manajemen data buku (Library Management System) yang dibangun untuk memenuhi tugas **UAS Pemrograman Web**. Aplikasi ini dikembangkan menggunakan PHP Native dengan konsep **OOP (Object Oriented Programming)**, pola arsitektur **MVC (Model-View-Controller)**, dan **Bootstrap 5** untuk antarmuka pengguna.

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
