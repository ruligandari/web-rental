<nav class="navbar navbar-expand-lg navbar-light">
    <div class="container-fluid">
        <button type="button" id="sidebarCollapse" class="btn btn-light border-0 d-md-none me-3 shadow-sm">
            <i class="fas fa-bars"></i>
        </button>

        <div class="ms-auto d-flex align-items-center">
            <span class="me-3">Halo, <strong><?= session()->get('username') ?></strong> (<?= ucfirst(session()->get('role')) ?>)</span>
            <div class="dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown">
                    <i class="fas fa-user-circle fa-lg"></i>
                </a>
                <ul class="dropdown-menu dropdown-menu-end">
                    <li><a class="dropdown-item btn-logout" href="<?= base_url('logout') ?>">Logout</a></li>
                </ul>
            </div>
        </div>
    </div>
</nav>
