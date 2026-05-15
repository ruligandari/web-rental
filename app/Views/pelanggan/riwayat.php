<?= $this->extend('layout/main') ?>

<?= $this->section('content') ?>
<div class="mb-4">
    <h3>Riwayat Reservasi Anda</h3>
    <p class="text-muted">Pantau status pemesanan travel Anda di sini.</p>
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
                        <th>Armada</th>
                        <th>Plat Nomor</th>
                        <th>Tanggal Sewa</th>
                        <th>Total Bayar</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $no = 1; foreach ($riwayat as $row) : ?>
                    <tr>
                        <td><?= $no++ ?></td>
                        <td><strong><?= $row['nama_mobil'] ?></strong></td>
                        <td><?= $row['plat_nomor'] ?></td>
                        <td><?= date('d M Y', strtotime($row['tgl_mulai'])) ?> - <?= date('d M Y', strtotime($row['tgl_selesai'])) ?></td>
                        <td><strong>Rp <?= number_format($row['total_bayar'], 0, ',', '.') ?></strong></td>
                        <td>
                            <span class="badge <?= $row['status_reservasi'] == 'Pending' ? 'bg-warning text-dark' : ($row['status_reservasi'] == 'Dikonfirmasi' ? 'bg-success' : 'bg-primary') ?>">
                                <?= $row['status_reservasi'] ?>
                            </span>
                        </td>
                        <td>
                            <?php if ($row['status_reservasi'] == 'Dikonfirmasi' || $row['status_reservasi'] == 'Selesai') : ?>
                                <a href="<?= base_url('invoice/' . $row['id_reservasi']) ?>" class="btn btn-sm btn-outline-primary" target="_blank">
                                    <i class="fas fa-file-invoice me-1"></i> Invoice
                                </a>
                            <?php elseif ($row['status_reservasi'] == 'Pending' && !empty($row['payment_link'])) : ?>
                                <a href="<?= $row['payment_link'] ?>" class="btn btn-sm btn-warning text-dark fw-bold" target="_blank">
                                    <i class="fas fa-credit-card me-1"></i> Lanjut Bayar
                                </a>
                            <?php else : ?>
                                <span class="text-muted small">Menunggu Pembayaran</span>
                            <?php endif; ?>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<?= $this->endSection() ?>
