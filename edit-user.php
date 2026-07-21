<?php
session_start();
require_once 'koneksi.php';
require_once 'auth.php';
isLogin();

if (!isset($_GET['id']) || empty($_GET['id'])) {
    header("Location: users.php");
    exit;
}

$id = (int) $_GET['id'];

$query_get = mysqli_query($koneksi, "SELECT * FROM user WHERE id = $id");
$user = mysqli_fetch_assoc($query_get);

if (!$user) {
    echo "<script>alert('Data user tidak ditemukan!'); window.location='users.php';</script>";
    exit;
}

if (isset($_POST['update'])) {
    $username = mysqli_real_escape_string($koneksi, $_POST['username']);
    $role_id  = (int) $_POST['role_id'];
    $password = $_POST['password'];

    $cek_user = mysqli_query($koneksi, "SELECT * FROM user WHERE username = '$username' AND id != $id");
    if (mysqli_num_rows($cek_user) > 0) {
        $error = "Username sudah digunakan oleh akun lain!";
    } else {
        if (!empty($password)) {
            $password_hash = password_hash($password, PASSWORD_DEFAULT);
            $query_update = "UPDATE user SET username = '$username', password = '$password_hash', role_id = '$role_id' WHERE id = $id";
        } else {
            $query_update = "UPDATE user SET username = '$username', role_id = '$role_id' WHERE id = $id";
        }

       if (mysqli_query($koneksi, $query_update)) {
            $_SESSION['alert'] = [
                'tipe' => 'success',
                'pesan' => 'Data user berhasil diperbarui!'
            ];
            header("Location: users.php");
            exit;
        } else {
            $error = "Gagal memperbarui data: " . mysqli_error($koneksi);
        }
    }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit User - HRDash</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/style.css">
    <style>
        .form-control-custom, .form-select-custom {
            border-radius: 8px;
            padding: 0.75rem 1rem;
            border: 1px solid #e5e7eb;
            font-size: 0.9rem;
        }
        .form-control-custom:focus, .form-select-custom:focus {
            border-color: #5d87ff;
            box-shadow: 0 0 0 0.25rem rgba(93, 135, 255, 0.15);
        }
    </style>
</head>
<body>
    <div id="wrapper">
        <?php include 'layout/sidebar.php'; ?>
        
        <div id="page-content-wrapper" class="d-flex flex-column min-vh-100">
            <?php include 'layout/navbar.php'; ?>
            
            <div class="container-fluid px-4 py-4 flex-grow-1">
                <div class="mb-4">
                    <a href="users.php" class="text-decoration-none text-muted mb-2 d-inline-block">
                        <i class="bi bi-arrow-left me-1"></i> Kembali ke Data User
                    </a>
                    <h4 class="m-0 fw-bold" style="color: #374151;">Edit Data User</h4>
                </div>

                <div class="row">
                    <div class="col-xl-6 col-lg-8">
                        <div class="card card-custom">
                            <div class="card-body p-4">
                                
                                <?php if (isset($error)) { ?>
                                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                        <i class="bi bi-exclamation-triangle-fill me-2"></i> <?= $error; ?>
                                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                    </div>
                                <?php } ?>

                                <form action="" method="POST">
                                    <div class="mb-3">
                                        <label class="form-label fw-medium text-dark">Username</label>
                                        <input type="text" name="username" class="form-control form-control-custom" value="<?= htmlspecialchars($user['username']); ?>" required autocomplete="off">
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label fw-medium text-dark">Password Baru</label>
                                        <input type="password" name="password" class="form-control form-control-custom" placeholder="Kosongkan jika tidak ingin mengubah password">
                                        <div class="form-text text-muted" style="font-size: 0.8rem;">Biarkan kosong apabila sandi tidak perlu diganti.</div>
                                    </div>
                                    <div class="mb-4">
                                        <label class="form-label fw-medium text-dark">Role</label>
                                        <select name="role_id" class="form-select form-select-custom" required>
                                            <option value="" disabled>-- Pilih Role --</option>
                                            <?php
                                            $role_query = mysqli_query($koneksi, "SELECT * FROM role ORDER BY id ASC");
                                            while ($row_role = mysqli_fetch_assoc($role_query)) {
                                                $selected = ($row_role['id'] == $user['role_id']) ? 'selected' : '';
                                                echo "<option value='".$row_role['id']."' $selected>".$row_role['role']."</option>";
                                            }
                                            ?>
                                        </select>
                                    </div>
                                    
                                    <hr class="text-muted opacity-25">
                                    <div class="d-flex justify-content-end mt-4">
                                        <a href="users.php" class="btn btn-light rounded-pill px-4 me-2">Batal</a>
                                        <button type="submit" name="update" class="btn btn-primary rounded-pill px-4" style="background-color: #5d87ff; border: none;">
                                            Simpan
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="assets/js/script.js"></script>
</body>
</html>