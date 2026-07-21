<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
$current_user = isset($_SESSION['username']) ? $_SESSION['username'] : 'Administrator';
$current_role = isset($_SESSION['role_name']) ? $_SESSION['role_name'] : 'Admin';
?>
<nav class="navbar navbar-expand-lg px-4 py-3 bg-white shadow-sm">
    <div class="d-flex align-items-center">
        <button class="btn btn-outline-primary me-3" id="menu-toggle">
            <i class="bi bi-list"></i>
        </button>
        <h4 class="m-0 text-dark fs-5">Dashboard</h4> 
    </div>

    <div class="d-flex ms-auto">
        <ul class="navbar-nav">
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle fw-semibold d-flex align-items-center" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                    <i class="bi bi-person-circle fs-5 me-1"></i> 
                    <span class="d-none d-md-block ms-1"><?= $current_user; ?></span>
                </a>
                
                <ul class="dropdown-menu dropdown-menu-end shadow-sm border-0 position-absolute" aria-labelledby="navbarDropdown">
                    <li><a class="dropdown-item" href="#"><i class="bi bi-person me-2"></i>Profil</a></li>
                    <li><hr class="dropdown-divider"></li>
                    <li><a class="dropdown-item text-danger" href="logout.php"><i class="bi bi-box-arrow-left me-2"></i>Logout</a></li>
                </ul>
            </li>
        </ul>
    </div>
</nav>