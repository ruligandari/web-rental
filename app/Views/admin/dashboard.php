<?= $this->extend('layout/main') ?>

<?= $this->section('content') ?>
<div class="row">
    <div class="col-md-4 mb-4">
        <div class="card border-0 shadow-sm rounded-3 bg-white h-100">
            <div class="card-body p-4">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h6 class="text-uppercase mb-2 text-muted" style="font-size: 0.75rem; font-weight: 700; letter-spacing: 0.5px;">Total Armada</h6>
                        <h2 class="mb-0 fw-bold text-dark"><?= $total_travel ?></h2>
                    </div>
                    <div class="rounded-circle d-flex align-items-center justify-content-center" style="background-color: rgba(79, 70, 229, 0.1); color: #4f46e5; width: 60px; height: 60px;">
                        <i class="fas fa-car fa-xl"></i>
                    </div>
                </div>
                <hr class="text-muted opacity-25 mt-4 mb-3">
                <a href="<?= base_url('admin/travel') ?>" class="text-primary small text-decoration-none fw-semibold">Lihat Detail <i class="fas fa-arrow-right ms-1"></i></a>
            </div>
        </div>
    </div>

    <div class="col-md-4 mb-4">
        <div class="card border-0 shadow-sm rounded-3 bg-white h-100">
            <div class="card-body p-4">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h6 class="text-uppercase mb-2 text-muted" style="font-size: 0.75rem; font-weight: 700; letter-spacing: 0.5px;">Total Pelanggan</h6>
                        <h2 class="mb-0 fw-bold text-dark"><?= $total_pelanggan ?></h2>
                    </div>
                    <div class="rounded-circle d-flex align-items-center justify-content-center" style="background-color: rgba(16, 185, 129, 0.1); color: #10b981; width: 60px; height: 60px;">
                        <i class="fas fa-users fa-xl"></i>
                    </div>
                </div>
                <hr class="text-muted opacity-25 mt-4 mb-3">
                <a href="<?= base_url('admin/pelanggan') ?>" class="text-success small text-decoration-none fw-semibold" style="color: #10b981 !important;">Lihat Detail <i class="fas fa-arrow-right ms-1"></i></a>
            </div>
        </div>
    </div>

    <div class="col-md-4 mb-4">
        <div class="card border-0 shadow-sm rounded-3 bg-white h-100">
            <div class="card-body p-4">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h6 class="text-uppercase mb-2 text-muted" style="font-size: 0.75rem; font-weight: 700; letter-spacing: 0.5px;">Pesanan Pending</h6>
                        <h2 class="mb-0 fw-bold text-dark"><?= $pending_orders ?></h2>
                    </div>
                    <div class="rounded-circle d-flex align-items-center justify-content-center" style="background-color: rgba(245, 158, 11, 0.1); color: #f59e0b; width: 60px; height: 60px;">
                        <i class="fas fa-clock fa-xl"></i>
                    </div>
                </div>
                <hr class="text-muted opacity-25 mt-4 mb-3">
                <a href="<?= base_url('admin/reservasi') ?>" class="text-warning small text-decoration-none fw-semibold" style="color: #f59e0b !important;">Konfirmasi Sekarang <i class="fas fa-arrow-right ms-1"></i></a>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        <div class="card border-0 shadow-sm rounded-3">
            <div class="card-header bg-white py-3">
                <h5 class="mb-0">Pesanan Terbaru</h5>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover align-middle">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Pelanggan</th>
                                <th>Tanggal</th>
                                <th>Total</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($recent_orders as $row) : ?>
                            <tr>
                                <td>#<?= $row['id_reservasi'] ?></td>
                                <td><strong><?= $row['nama_pelanggan'] ?></strong></td>
                                <td><?= date('d/m/Y', strtotime($row['tgl_mulai'])) ?></td>
                                <td>Rp <?= number_format($row['total_bayar'], 0, ',', '.') ?></td>
                                <td>
                                    <span class="badge <?= $row['status_reservasi'] == 'Pending' ? 'bg-warning text-dark' : ($row['status_reservasi'] == 'Dikonfirmasi' ? 'bg-success' : 'bg-primary') ?>">
                                        <?= $row['status_reservasi'] ?>
                                    </span>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>
