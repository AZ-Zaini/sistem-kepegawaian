<?php
require_once 'koneksi.php';
require_once 'auth.php';
isLogin();

$query_pegawai = mysqli_query($koneksi, "SELECT COUNT(id) as total FROM pegawai");
$data_pegawai = mysqli_fetch_assoc($query_pegawai);
$total_pegawai = $data_pegawai['total'];

$query_jabatan = mysqli_query($koneksi, "SELECT COUNT(id) as total FROM jabatan");
$data_jabatan = mysqli_fetch_assoc($query_jabatan);
$total_jabatan = $data_jabatan['total'];

$query_user = mysqli_query($koneksi, "SELECT COUNT(id) as total FROM user");
$data_user = mysqli_fetch_assoc($query_user);
$total_user = $data_user['total'];
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Sistem Kepegawaian</title>
    
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
                
                <div class="row g-4">
                    <div class="col-md-4">
                        <div class="card bg-primary text-white h-100 p-3">
                            <div class="card-body">
                                <h6 class="card-title"><i class="bi bi-people"></i> Total Pegawai</h6>
                                <h2 class="mb-0 mt-3"><?= $total_pegawai; ?></h2>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card bg-success text-white h-100 p-3">
                            <div class="card-body">
                                <h6 class="card-title"><i class="bi bi-briefcase"></i> Total Jabatan</h6>
                                <h2 class="mb-0 mt-3"><?= $total_jabatan; ?></h2>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card bg-warning text-dark h-100 p-3">
                            <div class="card-body">
                                <h6 class="card-title"><i class="bi bi-person"></i> User</h6>
                                <h2 class="mb-0 mt-3"><?= $total_user; ?></h2>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row mt-4">
                    <div class="col-12">
                        <div class="card p-4">
                            <h5>Selamat Datang di Sistem Kepegawaian</h5>
                            <p class="text-muted">Gunakan menu di sebelah kiri untuk mengelola data.</p>
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