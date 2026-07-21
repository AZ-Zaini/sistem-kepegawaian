<?php
session_start();
require_once 'koneksi.php';
require_once 'auth.php';
cek_login();

if (isset($_GET['id'])) {
    $id = (int) $_GET['id'];

    $query = "DELETE FROM jabatan WHERE id = $id";
    if (mysqli_query($koneksi, $query)) {
        $_SESSION['alert'] = [
            'tipe' => 'danger',
            'pesan' => 'Data jabatan berhasil dihapus!'
        ];
        header("Location: jabatan.php");
        exit;
    } else {
        echo "<script>alert('Gagal menghapus data: " . mysqli_error($koneksi) . "'); window.location='jabatan.php';</script>";
    }
} else {
    header("Location: jabatan.php");
    exit;
}
?>