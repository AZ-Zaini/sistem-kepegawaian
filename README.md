# Sistem Informasi Kepegawaian (HRDash)

Sistem Informasi Kepegawaian berbasis web yang dibangun menggunakan PHP Native dan MySQL. Aplikasi ini dirancang untuk memudahkan pengelolaan data pegawai, data jabatan, serta hak akses user.

---

## 🔐 Akun Login

Gunakan kredensial berikut untuk masuk ke dalam sistem:

### 1. Admin
* **Username:** `admin`
* **Password:** `admin`

### 2. User
* **Username:** `user`
* **Password:** `user`

---

## ✨ Fitur Utama

- **Otentikasi & Keamanan:** Fitur Login dan Logout dengan manajemen sesi pengguna (`session_start` & password hashing).
- **Dashboard Statistik:** Menampilkan ringkasan total data pegawai, total jabatan, dan total akun user secara dinamis.
- **Manajemen Data Pegawai:** 
  - Tambah, Edit, Hapus, dan Lihat Data Pegawai (NIP, Nama, Jabatan, Jenis Kelamin, No WhatsApp, Alamat).
  - Avatar otomatis berdasarkan nama dan jenis kelamin.
- **Manajemen Data Jabatan:** 
  - Tambah, Edit, Hapus, dan Lihat Data Jabatan.
- **Manajemen Users:** 
  - Tambah, Edit, Hapus, dan Pengaturan Role Pengguna.
- **Konfirmasi Modal Hapus:** Modal interaktif untuk mencegah ketidaksengajaan penghapusan data.
- **Antarmuka Responsif:** Menggunakan Bootstrap 5 & Bootstrap Icons dengan tampilan modern dan bersih.

---

## 🛠️ Teknologi yang Digunakan

- **PHP** (Native)
- **MySQL** (Database)
- **Bootstrap 5** (Framework CSS & JS)
- **Bootstrap Icons**
- **HTML5 & CSS3**

---

## 🚀 Cara Instalasi & Penggunaan

1. **Clone / Download Project:**
   Pastikan folder proyek diletakkan di direktori web server (contoh: `htdocs` untuk XAMPP atau `www` untuk Laragon).

2. **Impor Database:**
   - Buka `phpMyAdmin`.
   - Buat database baru dengan nama `db_pegawai`.
   - Impor file skema database (jika ada) atau sesuaikan tabel `pegawai`, `jabatan`, `user`, dan `role`.

3. **Konfigurasi Database:**
   - Buka file `koneksi.php`.
   - Sesuaikan konfigurasi host, username, password, dan nama database:
     ```php
     $host     = "localhost";
     $username = "root";
     $password = "root"; // sesuaikan dengan password MySQL Anda
     $dbname   = "db_pegawai";
     ```

4. **Jalankan Aplikasi:**
   - Buka peramban (browser) dan akses:
     ```
     http://localhost/uas-pegawai/
     ```
