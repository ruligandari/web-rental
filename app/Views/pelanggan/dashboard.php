<?= $this->extend('layout/main') ?>

<?= $this->section('content') ?>
<div class="row mb-4">
    <div class="col-md-12">
        <div class="card border-0 shadow-sm rounded-3 bg-white p-4">
            <h4>Selamat Datang, <?= session()->get('username') ?>!</h4>
            <p class="text-muted">Pesan armada travel favorit Anda dengan mudah dan cepat.</p>
            <a href="<?= base_url('pelanggan/travel') ?>" class="btn btn-primary">
                <i class="fas fa-search me-2"></i> Cari Armada Sekarang
            </a>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-4 mb-4">
        <div class="card border-0 shadow-sm rounded-3 bg-info text-white">
            <div class="card-body">
                <h6 class="text-uppercase" style="font-size: 0.8rem; opacity: 0.8;">Total Pesanan Anda</h6>
                <h2 class="mb-0"><?= $total_pesanan ?></h2>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        <div class="card border-0 shadow-sm rounded-3">
            <div class="card-header bg-white py-3">
                <h5 class="mb-0">Aktivitas Reservasi Terbaru</h5>
            </div>
            <div class="card-body">
                <?php if (empty($pesanan_terbaru)) : ?>
                    <p class="text-center text-muted py-4">Belum ada riwayat pesanan.</p>
                <?php else : ?>
                    <div class="table-responsive">
                        <table class="table table-hover align-middle">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Tanggal Sewa</th>
                                    <th>Total Bayar</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($pesanan_terbaru as $row) : ?>
                                <tr>
                                    <td>#<?= $row['id_reservasi'] ?></td>
                                    <td><?= date('d/m/Y', strtotime($row['tgl_mulai'])) ?> - <?= date('d/m/Y', strtotime($row['tgl_selesai'])) ?></td>
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
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>
