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
    
    $current_role = strtolower($_SESSION['role_name']);
    $allowed_roles = array_map('strtolower', $allowed_roles);

    if (!in_array($current_role, $allowed_roles)) {
        echo "<script>alert('Akses Ditolak! Anda tidak memiliki wewenang untuk membuka halaman ini.'); window.location='index.php';</script>";
        exit;
    }
}
?>