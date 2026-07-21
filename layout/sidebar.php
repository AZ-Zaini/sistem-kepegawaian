<div id="sidebar-wrapper">
    <div class="sidebar-heading text-center text-white">
        <i class="bi bi-buildings-fill me-2"></i> Sistem Kepegawaian
    </div>
    <div class="list-group list-group-flush mt-3 flex-grow-1">
        <a href="index.php" class="list-group-item list-group-item-action <?= basename($_SERVER['PHP_SELF']) == 'index.php' ? 'active' : ''; ?>">
            <i class="bi bi-grid me-2"></i> Dashboard
        </a>
        <a href="users.php" class="list-group-item list-group-item-action <?= in_array(basename($_SERVER['PHP_SELF']), ['users.php', 'tambah-user.php']) ? 'active' : ''; ?>">
            <i class="bi bi-person-fill me-2"></i> Users
        </a>
        <a href="pegawai.php" class="list-group-item list-group-item-action <?= in_array(basename($_SERVER['PHP_SELF']), ['pegawai.php', 'tambah-pegawai.php', 'edit-pegawai.php']) ? 'active' : ''; ?>">
            <i class="bi bi-people-fill me-2"></i> Data Pegawai
        </a>
        <a href="jabatan.php" class="list-group-item list-group-item-action <?= in_array(basename($_SERVER['PHP_SELF']), ['jabatan.php', 'tambah-jabatan.php']) ? 'active' : ''; ?>">
            <i class="bi bi-briefcase-fill"></i> Data Jabatan
        </a>
    </div>
    <div class="list-group list-group-flush mb-3">
        <a href="logout.php" class="list-group-item list-group-item-action text-danger border-top border-secondary">
            <i class="bi bi-box-arrow-left"></i> Logout
        </a>
    </div>
</div>