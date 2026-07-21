<?php
session_start();
require_once 'koneksi.php';
require_once 'auth.php';
isLogin();
cek_role(['admin']);

if (isset($_GET['id'])) {
    $id = (int) $_GET['id'];

    $query = "DELETE FROM user WHERE id = $id";
    if (mysqli_query($koneksi, $query)) {
        $_SESSION['alert'] = [
            'tipe' => 'danger',
            'pesan' => 'Data user berhasil dihapus!'
        ];
        header("Location: users.php");
        exit;
    } else {
        echo "<script>alert('Gagal menghapus data: " . mysqli_error($koneksi) . "'); window.location='users.php';</script>";
    }
} else {
    header("Location: users.php");
    exit;
}
?>