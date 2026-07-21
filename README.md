# Sistem Informasi Kepegawaian

Sistem Informasi Kepegawaian berbasis web yang dibangun menggunakan PHP Native dan MySQL. Aplikasi ini dirancang untuk memudahkan pengelolaan data pegawai, data jabatan, serta hak akses user.

---

## 🔐 Akun Login

Gunakan akun berikut untuk masuk ke dalam sistem:

### 1. Admin

- **Username:** `admin`
- **Password:** `admin`

### 2. User

- **Username:** `user`
- **Password:** `user`

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
    - Buka browser dan akses:
        ```
        http://localhost/sistem-kepegawaian/
        ```
