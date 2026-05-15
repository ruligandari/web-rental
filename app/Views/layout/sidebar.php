<?php $uri = uri_string(); ?>
<nav id="sidebar">
    <div class="sidebar-header text-center pb-0">
        <img src="<?= base_url('assets/img/ycr-rental.jpg') ?>" alt="Logo YCR Rental" style="width: 80px; height: 80px; object-fit: cover; border-radius: 16px;" class="mb-3 shadow-sm">
    </div>

    <ul class="list-unstyled components">
        <li class="<?= $uri == 'dashboard' || $uri == 'owner/dashboard' || $uri == 'admin/dashboard' || $uri == 'pelanggan/dashboard' ? 'active' : '' ?>">
            <a href="<?= base_url('dashboard') ?>"><i class="fas fa-tachometer-alt me-2"></i> Dashboard</a>
        </li>

        <?php if (session()->get('role') == 'owner') : ?>
            <li class="<?= strpos($uri, 'owner/laporan') !== false ? 'active' : '' ?>">
                <a href="<?= base_url('owner/laporan') ?>"><i class="fas fa-file-invoice-dollar me-2"></i> Laporan</a>
            </li>
        <?php endif; ?>

        <?php if (session()->get('role') == 'admin') : ?>
            <li class="<?= strpos($uri, 'admin/travel') !== false ? 'active' : '' ?>">
                <a href="<?= base_url('admin/travel') ?>"><i class="fas fa-car me-2"></i> Kelola Armada</a>
            </li>
            <li class="<?= strpos($uri, 'admin/pelanggan') !== false ? 'active' : '' ?>">
                <a href="<?= base_url('admin/pelanggan') ?>"><i class="fas fa-users me-2"></i> Kelola Pelanggan</a>
            </li>
            <li class="<?= strpos($uri, 'admin/reservasi') !== false ? 'active' : '' ?>">
                <a href="<?= base_url('admin/reservasi') ?>"><i class="fas fa-clipboard-list me-2"></i> Kelola Reservasi</a>
            </li>
            <li class="<?= strpos($uri, 'admin/crm') !== false ? 'active' : '' ?>">
                <a href="<?= base_url('admin/crm') ?>"><i class="fas fa-chart-line me-2"></i> CRM Operasional</a>
            </li>
        <?php endif; ?>

        <?php if (session()->get('role') == 'pelanggan') : ?>
            <li class="<?= strpos($uri, 'pelanggan/travel') !== false ? 'active' : '' ?>">
                <a href="<?= base_url('pelanggan/travel') ?>"><i class="fas fa-search me-2"></i> Cari Armada</a>
            </li>
            <li class="<?= strpos($uri, 'pelanggan/riwayat') !== false ? 'active' : '' ?>">
                <a href="<?= base_url('pelanggan/riwayat') ?>"><i class="fas fa-history me-2"></i> Riwayat Pesanan</a>
            </li>
        <?php endif; ?>

        <li>
            <a href="<?= base_url('logout') ?>" class="text-danger btn-logout"><i class="fas fa-sign-out-alt me-2"></i> Logout</a>
        </li>
    </ul>
</nav>
