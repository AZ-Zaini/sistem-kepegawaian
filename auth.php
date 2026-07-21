<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

function isLogin() {
    if (!isset($_SESSION['user_id'])) {
        header("Location: login.php");
        exit;
    }
}

function cek_role($allowed_roles = []) {
    isLogin(); 
    
    if (!in_array($_SESSION['role_name'], $allowed_roles)) {
        echo "<script>alert('Akses ditolak! Anda tidak memiliki hak untuk membuka halaman ini.'); window.location='index.php';</script>";
        exit;
    }
}
?>