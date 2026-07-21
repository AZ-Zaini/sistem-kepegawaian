<?php
session_start();
require_once 'koneksi.php';
require_once 'auth.php';
isLogin();
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Pegawai</title>
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
                
                <?php if (isset($_SESSION['alert'])): ?>
                    <div class="alert alert-<?= $_SESSION['alert']['tipe']; ?> alert-dismissible fade show" role="alert">
                        <i class="bi bi-<?= $_SESSION['alert']['tipe'] == 'success' ? 'check-circle-fill' : 'trash-fill'; ?> me-2"></i> 
                        <?= $_SESSION['alert']['pesan']; ?>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                    <?php unset($_SESSION['alert']); ?>
                <?php endif; ?>

                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h4 class="m-0 fw-bold" style="color: #374151;">Data Pegawai</h4>
                    <a href="tambah-pegawai.php" class="btn btn-primary rounded-pill px-4" style="background-color: #5d87ff; border: none;">
                        <i class="bi bi-plus-lg me-2"></i>Tambah
                    </a>
                </div>

                <div class="card card-custom">
                    <div class="card-body px-0 pt-3 pb-0">
                        <div class="table-responsive">
                            <table class="table table-custom align-middle mb-0">
                                <thead>
                                    <tr>
                                        <th>No.</th>
                                        <th class="ps-4">Profil Pegawai</th>
                                        <th>Jenis Kelamin</th>
                                        <th>Jabatan</th>
                                        <th>No.Wa</th>
                                        <th class="pe-4 text-end">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $query = "SELECT p.*, j.nama_jabatan 
                                              FROM pegawai p 
                                              LEFT JOIN jabatan j ON p.jabatan_id = j.id 
                                              ORDER BY p.id DESC";
                                    $result = mysqli_query($koneksi, $query);
                                    $no = 1;

                                    while ($row = mysqli_fetch_assoc($result)) {
                                        $bg_color = ($row['jenkel'] == 'L') ? 'e0f2fe' : 'fce7f3';
                                        $text_color = ($row['jenkel'] == 'L') ? '0284c7' : 'be185d';
                                    ?>
                                    <tr>
                                        <td class="ps-4">
                                            <?= $no++; ?>
                                        </td>
                                        <td class="ps-4">
                                            <div class="d-flex align-items-center">
                                                <img src="https://ui-avatars.com/api/?name=<?= urlencode($row['nama']); ?>&background=<?= $bg_color; ?>&color=<?= $text_color; ?>&rounded=false" class="avatar-square me-3" width="45" height="45">
                                                <div>
                                                    <div class="fw-semibold" style="color: #374151; font-size: 0.95rem;"><?= htmlspecialchars($row['nama']); ?></div>
                                                    <div class="text-muted" style="font-size: 0.8rem;">NIP: <?= htmlspecialchars($row['nip']); ?></div>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <span class="badge-custom badge-soft-purple"><?php if($row['jenkel'] == 'L'){ echo 'Laki-laki'; }elseif($row['jenkel'] == 'P'){ echo 'Perempuan'; }else{ echo '-'; } ?></span>
                                        </td>
                                        <td>
                                            <span class="badge-custom badge-soft-purple"><?= htmlspecialchars($row['nama_jabatan']); ?></span>
                                        </td>
                                        <td>
                                            <div style="font-size: 0.85rem; color: #566a7f;">
                                                <i class="bi bi-whatsapp me-1 text-success"></i> <?= htmlspecialchars($row['no_wa']); ?>
                                            </div>
                                        </td>
                                        <td class="pe-4 text-end">
                                            <a href="edit-pegawai.php?id=<?= $row['id']; ?>" class="btn btn-sm btn-outline-secondary me-1" title="Edit">
                                                <i class="bi bi-pencil"></i>
                                            </a>
                                            <button type="button" class="btn btn-sm btn-outline-danger btn-delete" 
                                                    data-id="<?= $row['id']; ?>" 
                                                    data-nama="<?= htmlspecialchars($row['nama']); ?>" 
                                                    data-nip="<?= htmlspecialchars($row['nip']); ?>" 
                                                    title="Hapus">
                                                <i class="bi bi-trash"></i>
                                            </button>
                                        </td>
                                    </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                            <?php if (mysqli_num_rows($result) == 0) { ?>
                                <div class="text-center py-4 text-muted">Belum ada data pegawai.</div>
                            <?php } ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content border-0 shadow" style="border-radius: 16px;">
                <div class="modal-body text-center p-4">
                    <div class="mb-3 text-danger fs-1">
                        <i class="bi bi-exclamation-circle"></i>
                    </div>
                    <h5 class="fw-bold mb-2" style="color: #374151;">Konfirmasi Hapus</h5>
                    <p class="text-muted mb-4">Apakah Anda yakin ingin menghapus data pegawai <strong id="namaTarget" class="text-dark"></strong> NIP. <strong id="nipTarget" class="text-dark"></strong>?</p>
                    <div class="d-flex justify-content-center gap-2">
                        <button type="button" class="btn btn-light rounded-pill px-4" data-bs-dismiss="modal">Batal</button>
                        <a href="#" id="confirmDeleteBtn" class="btn btn-danger rounded-pill px-4">Ya, Hapus</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="assets/js/script.js"></script>
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const deleteButtons = document.querySelectorAll(".btn-delete");
            const namaTarget = document.getElementById("namaTarget");
            const nipTarget = document.getElementById("nipTarget");
            const confirmDeleteBtn = document.getElementById("confirmDeleteBtn");

            deleteButtons.forEach(button => {
                button.addEventListener("click", function () {
                    const id = this.getAttribute("data-id");
                    const nama = this.getAttribute("data-nama");
                    const nip = this.getAttribute("data-nip");

                    namaTarget.textContent = nama;
                    nipTarget.textContent = nip;
                    confirmDeleteBtn.setAttribute("href", "hapus-pegawai.php?id=" + id);

                    const deleteModal = new bootstrap.Modal(document.getElementById("deleteModal"));
                    deleteModal.show();
                });
            });
        });
    </script>
</body>
</html>