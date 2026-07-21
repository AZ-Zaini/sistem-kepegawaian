<?php
session_start();
require_once 'koneksi.php';

if (isset($_SESSION['user_id'])) {
    header("Location: index.php");
    exit;
}

$error = '';

if (isset($_POST['login'])) {
    $username = mysqli_real_escape_string($koneksi, $_POST['username']);
    $password = $_POST['password'];

    $query = "SELECT user.*, role.role AS nama_role 
              FROM user 
              LEFT JOIN role ON user.role_id = role.id 
              WHERE user.username = '$username'";
    $result = mysqli_query($koneksi, $query);

    if ($row = mysqli_fetch_assoc($result)) {
        if (password_verify($password, $row['password'])) {
            $_SESSION['user_id']   = $row['id'];
            $_SESSION['username']  = $row['username'];
            $_SESSION['role_id']   = $row['role_id'];
            $_SESSION['role_name'] = $row['nama_role'];

            header("Location: index.php");
            exit;
        } else {
            $error = "Password yang Anda masukkan salah!";
        }
    } else {
        $error = "Username atau Password salah!";
    }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="assets/css/login.css">
</head>
<body>

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6 col-lg-4">
                <div class="card login-card p-4">
                    <div class="text-center mb-4">
                        <div class="text-primary fs-1 mb-2">
                            <i class="bi bi-hexagon-fill"></i>
                        </div>
                        <h4 class="fw-bold" style="color: #374151;">Login</h4>
                        <p class="text-muted small">Silakan masuk untuk mengakses sistem</p>
                    </div>

                    <?php if (!empty($error)): ?>
                        <div class="alert alert-danger alert-dismissible fade show py-2 small" role="alert">
                            <i class="bi bi-exclamation-triangle-fill me-1"></i> <?= $error; ?>
                            <button type="button" class="btn-close py-2" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    <?php endif; ?>

                    <form action="" method="POST">
                        <div class="mb-3">
                            <label class="form-label fw-medium text-dark small">Username</label>
                            <div class="input-group">
                                <span class="input-group-text bg-light border-end-0 text-muted" style="border-radius: 8px 0 0 8px;"><i class="bi bi-person"></i></span>
                                <input type="text" name="username" class="form-control form-control-custom border-start-0" placeholder="Masukkan username" required autocomplete="off">
                            </div>
                        </div>
                        
                        <div class="mb-4">
                            <label class="form-label fw-medium text-dark small">Password</label>
                            <div class="input-group">
                                <span class="input-group-text bg-light border-end-0 text-muted" style="border-radius: 8px 0 0 8px;"><i class="bi bi-lock"></i></span>
                                <input type="password" name="password" class="form-control form-control-custom border-start-0" placeholder="Masukkan password" required>
                            </div>
                        </div>

                        <button type="submit" name="login" class="btn btn-primary w-100 rounded-pill py-2 fw-semibold" style="background-color: #5d87ff; border: none;">
                            Login
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>