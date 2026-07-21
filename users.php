<?php
session_start();
require_once 'koneksi.php';
require_once 'auth.php';
isLogin();
cek_role(['admin']);
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data User</title>
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
                    <h4 class="m-0 fw-bold" style="color: #374151;">Data User</h4>
                    <a href="tambah-user.php" class="btn btn-primary rounded-pill px-4" style="background-color: #5d87ff; border: none;">
                        <i class="bi bi-plus-lg me-2"></i>Tambah
                    </a>
                </div>

                <div class="card card-custom">
                    <div class="card-body px-0 pt-3 pb-0">
                        <div class="table-responsive">
                            <table class="table table-custom align-middle mb-0">
                                <thead>
                                    <tr>
                                        <th class="ps-4">No</th>
                                        <th>Username</th>
                                        <th>Role</th>
                                        <th class="pe-4 text-end">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $query = "SELECT user.id, user.username, role.role AS nama_role 
                                              FROM user 
                                              LEFT JOIN role ON user.role_id = role.id 
                                              ORDER BY user.id DESC";
                                    $result = mysqli_query($koneksi, $query);
                                    $no = 1;

                                    while ($row = mysqli_fetch_assoc($result)) {
                                        $badge_class = "badge-soft-success"; 
                                        if (strtolower($row['nama_role']) == 'admin') {
                                            $badge_class = "badge-soft-purple";
                                        } elseif (strtolower($row['nama_role']) == 'hrd') {
                                            $badge_class = "badge-soft-warning";
                                        }
                                    ?>
                                    <tr>
                                        <td class="ps-4 text-muted"><?= $no++; ?></td>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <span class="fw-semibold" style="color: #374151; font-size: 0.95rem;">
                                                    <?= htmlspecialchars($row['username']); ?>
                                                </span>
                                            </div>
                                        </td>
                                        <td><span class="badge-custom <?= $badge_class ?>"><?= htmlspecialchars($row['nama_role']); ?></span></td>
                                        <td class="pe-4 text-end">
                                            <a href="edit-user.php?id=<?= $row['id']; ?>" class="btn btn-sm btn-outline-secondary me-1" title="Edit">
                                                <i class="bi bi-pencil"></i>
                                            </a>
                                            <button type="button" class="btn btn-sm btn-outline-danger btn-delete" 
                                                    data-id="<?= $row['id']; ?>" 
                                                    data-username="<?= htmlspecialchars($row['username']); ?>" 
                                                    title="Hapus">
                                                <i class="bi bi-trash"></i>
                                            </button>
                                        </td>
                                    </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                            <?php if (mysqli_num_rows($result) == 0) { ?>
                                <div class="text-center py-4 text-muted">Belum ada data user.</div>
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
                    <p class="text-muted mb-4">Apakah Anda yakin ingin menghapus user <strong id="usernameTarget" class="text-dark"></strong>?</p>
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
            const usernameTarget = document.getElementById("usernameTarget");
            const confirmDeleteBtn = document.getElementById("confirmDeleteBtn");

            deleteButtons.forEach(button => {
                button.addEventListener("click", function () {
                    const id = this.getAttribute("data-id");
                    const username = this.getAttribute("data-username");

                    usernameTarget.textContent = username;
                    confirmDeleteBtn.setAttribute("href", "hapus-user.php?id=" + id);

                    const deleteModal = new bootstrap.Modal(document.getElementById("deleteModal"));
                    deleteModal.show();
                });
            });
        });
    </script>
</body>
</html>