<?php
session_start();
require_once 'koneksi.php';
require_once 'auth.php';
isLogin();
cek_role(['admin']);

if (isset($_POST['simpan'])) {
    $nip = mysqli_real_escape_string($koneksi, $_POST['nip']);
    $nama = mysqli_real_escape_string($koneksi, $_POST['nama']);
    $jabatan_id = (int) $_POST['jabatan_id'];
    $jenkel = $_POST['jenkel'];
    $no_wa = mysqli_real_escape_string($koneksi, $_POST['no_wa']);
    $alamat = mysqli_real_escape_string($koneksi, $_POST['alamat']);

    $cek_nip = mysqli_query($koneksi, "SELECT * FROM pegawai WHERE nip = '$nip'");
    
    if (mysqli_num_rows($cek_nip) > 0) {
        $error = "NIP sudah terdaftar pada pegawai lain!";
    } else {
        $query = "INSERT INTO pegawai (nip, nama, jabatan_id, jenkel, no_wa, alamat) 
                  VALUES ('$nip', '$nama', '$jabatan_id', '$jenkel', '$no_wa', '$alamat')";
                  
        if (mysqli_query($koneksi, $query)) {
            $_SESSION['alert'] = [
                'tipe' => 'success',
                'pesan' => 'Data pegawai baru berhasil ditambahkan!'
            ];
            header("Location: pegawai.php");
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
    <title>Tambah Pegawai - HRDash</title>
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
                    <a href="pegawai.php" class="text-decoration-none text-muted mb-2 d-inline-block">
                        <i class="bi bi-arrow-left me-1"></i> Kembali ke Data Pegawai
                    </a>
                    <h4 class="m-0 fw-bold" style="color: #374151;">Tambah Pegawai Baru</h4>
                </div>

                <div class="row">
                    <div class="col-xl-8">
                        <div class="card card-custom">
                            <div class="card-body p-4">
                                
                                <?php if (isset($error)) { ?>
                                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                        <i class="bi bi-exclamation-triangle-fill me-2"></i> <?= $error; ?>
                                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                    </div>
                                <?php } ?>

                                <form action="" method="POST">
                                    <div class="row">
                                        <div class="col-md-6 mb-3">
                                            <label class="form-label fw-medium text-dark">NIP (Nomor Induk Pegawai)</label>
                                            <input type="text" name="nip" class="form-control form-control-custom" placeholder="Masukkan NIP (maks 18 digit)" required autocomplete="off" maxlength="18">
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label class="form-label fw-medium text-dark">Nama Lengkap</label>
                                            <input type="text" name="nama" class="form-control form-control-custom" placeholder="Masukkan nama lengkap" required autocomplete="off">
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-6 mb-3">
                                            <label class="form-label fw-medium text-dark">Jabatan</label>
                                            <select name="jabatan_id" class="form-select form-select-custom" required>
                                                <option value="" selected disabled>-- Pilih Jabatan --</option>
                                                <?php
                                                $jabatan_query = mysqli_query($koneksi, "SELECT * FROM jabatan ORDER BY nama_jabatan ASC");
                                                while ($row_jabatan = mysqli_fetch_assoc($jabatan_query)) {
                                                    echo "<option value='".$row_jabatan['id']."'>".$row_jabatan['nama_jabatan']."</option>";
                                                }
                                                ?>
                                            </select>
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label class="form-label fw-medium text-dark">Jenis Kelamin</label>
                                            <select name="jenkel" class="form-select form-select-custom" required>
                                                <option value="" selected disabled>-- Pilih Jenis Kelamin --</option>
                                                <option value="L">Laki-laki</option>
                                                <option value="P">Perempuan</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label fw-medium text-dark">Nomor WhatsApp</label>
                                        <input type="text" name="no_wa" class="form-control form-control-custom" placeholder="Contoh: 081234567890" maxlength="16">
                                    </div>

                                    <div class="mb-4">
                                        <label class="form-label fw-medium text-dark">Alamat Lengkap</label>
                                        <textarea name="alamat" class="form-control form-control-custom" rows="3" placeholder="Masukkan alamat lengkap tempat tinggal"></textarea>
                                    </div>
                                    
                                    <hr class="text-muted opacity-25">
                                    <div class="d-flex justify-content-end mt-4">
                                        <a href="pegawai.php" class="btn btn-light rounded-pill px-4 me-2">Batal</a>
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