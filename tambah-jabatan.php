<?php
session_start();
require_once 'koneksi.php';
require_once 'auth.php';
isLogin();

if (isset($_POST['simpan'])) {
    $nama_jabatan = mysqli_real_escape_string($koneksi, $_POST['nama_jabatan']);

    $cek = mysqli_query($koneksi, "SELECT * FROM jabatan WHERE nama_jabatan = '$nama_jabatan'");
    if (mysqli_num_rows($cek) > 0) {
        $error = "Nama jabatan tersebut sudah terdaftar!";
    } else {
        $query = "INSERT INTO jabatan (nama_jabatan) VALUES ('$nama_jabatan')";
        if (mysqli_query($koneksi, $query)) {
            $_SESSION['alert'] = [
                'tipe' => 'success',
                'pesan' => 'Data jabatan baru berhasil ditambahkan!'
            ];
            header("Location: jabatan.php");
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
    <title>Tambah Jabatan - HRDash</title>
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
                    <a href="jabatan.php" class="text-decoration-none text-muted mb-2 d-inline-block">
                        <i class="bi bi-arrow-left me-1"></i> Kembali ke Data Jabatan
                    </a>
                    <h4 class="m-0 fw-bold" style="color: #374151;">Tambah Jabatan Baru</h4>
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
                                    <div class="mb-4">
                                        <label class="form-label fw-medium text-dark">Nama Jabatan</label>
                                        <input type="text" name="nama_jabatan" class="form-control form-control-custom" placeholder="Masukan Nama Jabatan" required autocomplete="off">
                                    </div>
                                    
                                    <hr class="text-muted opacity-25">
                                    <div class="d-flex justify-content-end mt-4">
                                        <a href="jabatan.php" class="btn btn-light rounded-pill px-4 me-2">Batal</a>
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
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="assets/js/script.js"></script>
</body>
</html>