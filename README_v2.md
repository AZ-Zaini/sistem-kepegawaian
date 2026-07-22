# 🏢 Sistem Informasi Kepegawaian (SIMPEG) v2

Sistem Informasi Kepegawaian (SIMPEG) adalah aplikasi berbasis web yang dirancang untuk mengelola data pegawai, jabatan, serta hak akses pengguna (user) secara efisien dan terstruktur. Aplikasi ini dibangun menggunakan kombinasi **PHP Native** dan database **MySQL** dengan antarmuka modern menggunakan **Bootstrap 5**.

---

## 🌟 Fitur Utama

Aplikasi ini dilengkapi dengan beberapa fitur utama, antara lain:

1. **Dashboard Statistik**  
   Menampilkan ringkasan data berupa jumlah total pegawai, jumlah jabatan, dan jumlah akun pengguna dalam sistem secara real-time.
2. **Manajemen Data Pegawai (CRUD)**  
   - Pencatatan informasi lengkap pegawai: NIP, Nama Lengkap, Jenis Kelamin, Jabatan, Nomor WhatsApp, dan Alamat.
   - Pembuatan avatar profil otomatis secara dinamis berdasarkan nama pegawai melalui integrasi *UI Avatars*.
   - Kontak langsung ke WhatsApp pegawai.
3. **Manajemen Data Jabatan (CRUD)**  
   Pengelolaan daftar jabatan dalam instansi untuk dikaitkan dengan data pegawai.
4. **Manajemen User / Pengguna (CRUD)**  
   - Pengelolaan akun pengguna yang dapat masuk ke sistem.
   - Enkripsi password menggunakan  `hash` untuk keamanan.
   - Pembagian hak akses (*Role-based Access Control*) secara dinamis.
5. **Autentikasi & Keamanan**  
   - Pembatasan akses halaman berdasarkan status login.
   - Pembatasan akses menu tertentu berdasarkan tingkat otorisasi (Role `admin` vs `user`).

---

## 🛠️ Teknologi & Libs

- **Backend:** PHP (Native)
- **Database:** MySQL
- **Frontend Framework:** Bootstrap v5.3.3
- **Icons:** Bootstrap Icons v1.11.3
- **Avatar Generator:** UI Avatars API

---

## 🚀 Panduan Instalasi & Konfigurasi

Ikuti langkah-langkah berikut untuk menjalankan aplikasi di lingkungan lokal Anda:

### 1. Prasyarat (Prerequisites)
Pastikan Anda telah menginstal salah satu paket web server berikut:
- **XAMPP** (disarankan PHP versi 7.4 ke atas atau PHP 8.x)
- **Laragon**
- Atau web server mandiri (Apache/Nginx & MySQL)

### 2. Salin Proyek (Clone / Download)
Letakkan folder proyek ini ke dalam direktori root web server Anda:
- Jika menggunakan **XAMPP**: Pindahkan ke `C:\xampp\htdocs\sistem-kepegawaian`
- Jika menggunakan **Laragon**: Pindahkan ke `C:\laragon\www\sistem-kepegawaian`

### 3. Impor Database
1. Buka browser dan akses **phpMyAdmin** (`http://localhost/phpmyadmin/`).
2. Buat database baru dengan nama **`db_pegawai`**.
3. Pilih database `db_pegawai` yang baru dibuat, lalu pilih tab **Import**.
4. Pilih file database yang terletak di dalam folder proyek:
   ```filepath
   [Direktori Proyek]/database/db_pegawai.sql
   ```
5. Klik **Go** atau **Import** untuk mengeksekusi pembuatan tabel dan data awal.

### 4. Konfigurasi Koneksi Database
Buka berkas `koneksi.php` pada folder root proyek Anda dan sesuaikan konfigurasi database Anda jika diperlukan:
```php
<?php
$host     = "localhost";
$username = "root";      // Sesuaikan dengan username database Anda (default: root)
$password = "root";      // Sesuaikan dengan password database Anda (default: kosong atau root)
$dbname   = "db_pegawai";

$koneksi  = mysqli_connect($host, $username, $password, $dbname);

if (mysqli_connect_errno()) {
    echo "Koneksi database gagal : " . mysqli_connect_error();
}
?>
```

### 5. Akses Aplikasi
Buka browser favorit Anda dan akses URL berikut:
```text
http://localhost/sistem-kepegawaian/
```

---

## 🔐 Kredensial Akun Login Bawaan

Sistem ini mendukung tingkatan akses (role) yang berbeda. Anda dapat menggunakan akun bawaan berikut untuk menguji sistem:

| No. | Username | Password | Role | Deskripsi Hak Akses |
| :--- | :--- | :--- | :--- | :--- |
| 1 | **`admin`** | `admin` | **Admin** | Akses penuh ke seluruh fitur termasuk manajemen User. |
| 2 | **`user`** | `user` | **User** | Akses ke Dashboard, Data Pegawai, dan Jabatan (Tanpa menu User). |

---

## 📸 Panduan Antarmuka & Penggunaan Fitur

*Berikut adalah visualisasi antarmuka aplikasi beserta penjelasan detail penggunaannya. Anda dapat memperbarui URL gambar di bawah ini dengan screenshot aplikasi Anda.*

### 🔑 1. Halaman Login
Halaman utama autentikasi bagi pengguna untuk masuk ke dalam Sistem Informasi Kepegawaian menggunakan username dan password terdaftar.
- **Tampilan Antarmuka:**
  
  ![Halaman Login](URL_GAMBAR_LOGIN)
  
- **Cara Penggunaan:**
  Masukkan username (contoh: `admin`) dan password (`admin`), lalu klik tombol **Sign In**. Jika data sesuai, Anda akan diarahkan ke Dashboard.

---

### 📊 2. Dashboard Statistik
Halaman awal setelah berhasil masuk yang menampilkan indikator statistik jumlah data pegawai, jabatan, dan pengguna sistem.
- **Tampilan Antarmuka:**
  
  ![Dashboard Utama](URL_GAMBAR_DASHBOARD)
  
- **Cara Penggunaan:**
  Di halaman ini, Anda dapat melihat jumlah pegawai, jabatan, dan user yang terdaftar. Gunakan menu sidebar sebelah kiri untuk navigasi ke halaman lainnya.

---

### 👥 3. Halaman Data Pegawai
Halaman untuk mengelola data pegawai yang aktif di dalam sistem.
- **Tampilan Antarmuka:**
  
  ![Data Pegawai](URL_GAMBAR_PEGAWAI)
  
- **Cara Penggunaan:**
  - **Tambah Pegawai:** Klik tombol **Tambah** di kanan atas untuk mengisi form pegawai baru (NIP, Nama, Jenis Kelamin, Jabatan, Nomor WA, Alamat).
  - **Edit Data:** Klik ikon **Pencil** di kolom aksi untuk memperbarui data pegawai yang bersangkutan.
  - **Hapus Data:** Klik ikon **Trash** untuk menghapus data pegawai dengan konfirmasi aman.
  - **Hubungi WhatsApp:** Klik nomor WhatsApp berlogo hijau untuk mengirim pesan langsung ke pegawai via WhatsApp Web/App.

---

### 💼 4. Halaman Data Jabatan
Halaman untuk mengelola daftar posisi atau jabatan pekerjaan.
- **Tampilan Antarmuka:**
  
  ![Data Jabatan](URL_GAMBAR_JABATAN)
  
- **Cara Penggunaan:**
  - Daftarkan nama jabatan baru melalui tombol **Tambah**.
  - Hubungkan jabatan ini saat mengisi/mengedit profil pegawai.
  - Perubahan nama jabatan akan otomatis tersinkronisasi di profil pegawai yang memegangnya.

---

### 👤 5. Halaman Manajemen User (Khusus Admin)
Halaman khusus bagi Administrator untuk membuat dan mengelola akun pengguna yang memiliki akses login ke sistem.
- **Tampilan Antarmuka:**
  
  ![Manajemen User](URL_GAMBAR_USER)
  
- **Cara Penggunaan:**
  - Administrator dapat mendaftarkan akun baru dengan memilih hak akses (Admin/User).
  - Password yang dimasukkan akan dienkripsi secara aman sebelum disimpan ke database.
  - Membantu pembagian tugas operasional dalam pengelolaan sistem kepegawaian.
