<?php
session_start();
require_once 'koneksi.php';
require_once 'auth.php';
isLogin();

if (isset($_GET['id'])) {
    $id = (int) $_GET['id'];

    $query = "DELETE FROM pegawai WHERE id = $id";
    if (mysqli_query($koneksi, $query)) {
        $_SESSION['alert'] = [
            'tipe' => 'danger',
            'pesan' => 'Data pegawai berhasil dihapus!'
        ];
        header("Location: pegawai.php");
        exit;
    } else {
        echo "<script>alert('Gagal menghapus data: " . mysqli_error($koneksi) . "'); window.location='pegawai.php';</script>";
    }
} else {
    header("Location: pegawai.php");
    exit;
}
?>