<?= $this->extend('layout/main') ?>

<?= $this->section('content') ?>
<div class="mb-4">
    <a href="<?= base_url('admin/crm') ?>" class="btn btn-secondary btn-sm">
        <i class="fas fa-arrow-left me-2"></i> Kembali ke CRM
    </a>
</div>

<div class="row">
    <div class="col-md-4 mb-4">
        <div class="card border-0 shadow-sm rounded-3 h-100">
            <div class="card-body text-center">
                <div class="mb-3">
                    <i class="fas fa-user-circle fa-5x text-primary"></i>
                </div>
                <h5><?= $pelanggan['nama_pelanggan'] ?></h5>
                <p class="text-muted small"><?= $pelanggan['no_telp'] ?></p>
                <hr>
                <div class="text-start">
                    <p class="mb-1"><strong>Alamat:</strong></p>
                    <p class="small text-muted"><?= $pelanggan['alamat'] ?></p>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-8 mb-4">
        <div class="card border-0 shadow-sm rounded-3">
            <div class="card-header bg-white py-3">
                <h5 class="mb-0">Histori Perjalanan</h5>
            </div>
            <div class="card-body">
                <?php if (empty($riwayat)) : ?>
                    <p class="text-center text-muted py-5">Belum ada riwayat transaksi.</p>
                <?php else : ?>
                    <div class="table-responsive">
                        <table class="table table-hover align-middle">
                            <thead class="table-light">
                                <tr>
                                    <th>#</th>
                                    <th>Armada</th>
                                    <th>Tanggal</th>
                                    <th class="text-end">Biaya</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $no = 1; foreach ($riwayat as $row) : ?>
                                <tr>
                                    <td><?= $no++ ?></td>
                                    <td><strong><?= $row['nama_mobil'] ?></strong></td>
                                    <td><?= date('d/m/Y', strtotime($row['tgl_mulai'])) ?></td>
                                    <td class="text-end">Rp <?= number_format($row['total_bayar'], 0, ',', '.') ?></td>
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
