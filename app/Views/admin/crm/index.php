<?= $this->extend('layout/main') ?>

<?= $this->section('content') ?>
<div class="mb-4">
    <h3>CRM Operasional</h3>
    <p class="text-muted">Analisis perilaku dan loyalitas pelanggan Anda.</p>
</div>

<div class="row">
    <div class="col-md-12">
        <div class="card border-0 shadow-sm rounded-3">
            <div class="card-header bg-white py-3">
                <h5 class="mb-0">Peringkat Loyalitas Pelanggan</h5>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover align-middle datatable">
                        <thead class="table-light">
                            <tr>
                                <th>#</th>
                                <th>Nama Pelanggan</th>
                                <th>WhatsApp</th>
                                <th>Total Pesanan</th>
                                <th class="text-end">Total Kontribusi</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $no = 1; foreach ($pelanggan as $row) : ?>
                            <tr>
                                <td><?= $no++ ?></td>
                                <td><strong><?= $row['nama_pelanggan'] ?></strong></td>
                                <td><?= $row['no_telp'] ?></td>
                                <td><?= $row['total_pesanan'] ?> Kali</td>
                                <td class="text-end"><strong>Rp <?= number_format($row['total_duit'], 0, ',', '.') ?></strong></td>
                                <td>
                                    <a href="<?= base_url('admin/crm/pelanggan/' . $row['id_pelanggan']) ?>" class="btn btn-sm btn-outline-primary">
                                        <i class="fas fa-history me-1"></i> Lihat Histori
                                    </a>
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
