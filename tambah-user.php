<?php
session_start();
require_once 'koneksi.php';
require_once 'auth.php';
isLogin();

if (isset($_POST['simpan'])) {
    $username = mysqli_real_escape_string($koneksi, $_POST['username']);
    $role_id  = (int) $_POST['role_id'];
    
    $password = $_POST['password'];
    $password_hash  = password_hash($password, PASSWORD_DEFAULT);

    $cek_user = mysqli_query($koneksi, "SELECT * FROM user WHERE username = '$username'");
    if (mysqli_num_rows($cek_user) > 0) {
        $error = "Username sudah terdaftar! Silakan gunakan username lain.";
    } else {
        $query_insert = "INSERT INTO user (username, password, role_id) VALUES ('$username', '$password_hash', '$role_id')";
        if (mysqli_query($koneksi, $query_insert)) {
            $_SESSION['alert'] = [
                'tipe' => 'success',
                'pesan' => 'Data user baru berhasil ditambahkan!'
            ];
            header("Location: users.php");
            exit;
        } else {
            $error = "Gagal menyimpan data: " . mysqli_error($koneksi);
        }
    }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah User</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/style.css">
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
                    <h4 class="m-0 fw-bold" style="color: #374151;">Tambah User Baru</h4>
                </div>

                <div class="row">
                    <div class="col-xl-6 col-lg-8">
                        <div class="card card-custom">
                            <div class="card-body p-4">
                                
                                <?php if (isset($error)) { ?>
                                    <div class="alert alert-danger" role="alert">
                                        <i class="bi bi-exclamation-triangle-fill me-2"></i> <?= $error; ?>
                                    </div>
                                <?php } ?>

                                <form action="" method="POST">
                                    <div class="mb-3">
                                        <label class="form-label fw-medium text-dark">Username</label>
                                        <input type="text" name="username" class="form-control form-control-custom" placeholder="Masukkan username..." required autocomplete="off">
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label fw-medium text-dark">Password</label>
                                        <input type="password" name="password" class="form-control form-control-custom" placeholder="Masukkan kata sandi..." required>
                                    </div>
                                    <div class="mb-4">
                                        <label class="form-label fw-medium text-dark">Role</label>
                                        <select name="role_id" class="form-select form-select-custom" required>
                                            <option value="" selected disabled>-- Pilih Role --</option>
                                            <?php
                                            $role_query = mysqli_query($koneksi, "SELECT * FROM role ORDER BY id ASC");
                                            while ($row_role = mysqli_fetch_assoc($role_query)) {
                                                echo "<option value='".$row_role['id']."'>".$row_role['role']."</option>";
                                            }
                                            ?>
                                        </select>
                                    </div>
                                    
                                    <hr class="text-muted opacity-25">
                                    <div class="d-flex justify-content-end mt-4">
                                        <button type="reset" class="btn btn-light rounded-pill px-4 me-2">Batal</button>
                                        <button type="submit" name="simpan" class="btn btn-primary rounded-pill px-4" style="background-color: #5d87ff; border: none;">
                                            Simpan
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <?php include 'layout/footer.php'; ?>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="assets/js/script.js"></script>
</body>
</html>