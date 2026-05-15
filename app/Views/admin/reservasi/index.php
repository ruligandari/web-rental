<?= $this->extend('layout/main') ?>

<?= $this->section('content') ?>
<div class="mb-4">
    <h3>Kelola Reservasi Pelanggan</h3>
    <p class="text-muted">Konfirmasi pesanan masuk dan pantau status armada.</p>
</div>

<?php if (session()->getFlashdata('success')) : ?>
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <?= session()->getFlashdata('success') ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
<?php endif; ?>

<div class="card border-0 shadow-sm rounded-3">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-hover align-middle datatable">
                <thead class="table-light">
                    <tr>
                        <th>#</th>
                        <th>Pelanggan</th>
                        <th>Armada</th>
                        <th>Tanggal Sewa</th>
                        <th>Info Pembayaran</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $no = 1; foreach ($reservasi as $row) : ?>
                    <tr>
                        <td><?= $no++ ?></td>
                        <td><strong><?= $row['nama_pelanggan'] ?></strong></td>
                        <td><?= $row['nama_mobil'] ?> <br><small class="text-muted"><?= $row['plat_nomor'] ?></small></td>
                        <td><?= date('d/m/y', strtotime($row['tgl_mulai'])) ?> - <?= date('d/m/y', strtotime($row['tgl_selesai'])) ?></td>
                        <td>
                            <strong>Rp <?= number_format($row['total_bayar'], 0, ',', '.') ?></strong><br>
                            <small class="text-muted">Metode: <?= esc($row['metode_pembayaran'] ?? '-') ?></small><br>
                            <small class="text-muted">Tgl Bayar: <?= $row['tgl_bayar'] ? date('d/m/Y', strtotime($row['tgl_bayar'])) : '-' ?></small>
                        </td>
                        <td>
                            <span class="badge <?= $row['status_reservasi'] == 'Pending' ? 'bg-warning text-dark' : ($row['status_reservasi'] == 'Dikonfirmasi' ? 'bg-success' : 'bg-primary') ?>">
                                <?= $row['status_reservasi'] ?>
                            </span>
                        </td>
                        <td>
                            <?php if ($row['status_reservasi'] == 'Pending') : ?>
                                <a href="<?= base_url('admin/reservasi/konfirmasi/' . $row['id_reservasi']) ?>" class="btn btn-sm btn-success" onclick="return confirm('Konfirmasi reservasi ini?')">
                                    <i class="fas fa-check me-1"></i> Konfirmasi
                                </a>
                            <?php elseif ($row['status_reservasi'] == 'Dikonfirmasi') : ?>
                                <a href="<?= base_url('admin/reservasi/selesai/' . $row['id_reservasi']) ?>" class="btn btn-sm btn-primary" onclick="return confirm('Selesaikan sewa ini?')">
                                    <i class="fas fa-flag-checkered me-1"></i> Selesai
                                </a>
                            <?php endif; ?>
                            <a href="<?= base_url('invoice/' . $row['id_reservasi']) ?>" class="btn btn-sm btn-outline-info" target="_blank">
                                <i class="fas fa-file-invoice"></i>
                            </a>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
    </div>
</div>
<?= $this->endSection() ?>
