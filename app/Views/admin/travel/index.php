<?= $this->extend('layout/main') ?>

<?= $this->section('content') ?>
<div class="d-flex justify-content-between align-items-center mb-4">
    <h3>Daftar Armada YCR Rental</h3>
    <a href="<?= base_url('admin/travel/create') ?>" class="btn btn-primary">
        <i class="fas fa-plus me-2"></i> Tambah Unit
    </a>
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
                        <th>Foto</th>
                        <th>Unit / Mobil</th>
                        <th>Plat Nomor</th>
                        <th>Harga Sewa</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $no = 1; foreach ($travel as $row) : ?>
                    <tr>
                        <td><?= $no++ ?></td>
                        <td>
                            <img src="<?= base_url('uploads/travel/' . $row['foto']) ?>" alt="Foto" class="rounded" style="width: 80px; height: 50px; object-fit: cover;">
                        </td>
                        <td><strong><?= $row['nama_mobil'] ?></strong></td>
                        <td><?= $row['plat_nomor'] ?></td>
                        <td>Rp <?= number_format($row['harga_sewa'], 0, ',', '.') ?></td>
                        <td>
                            <?php if ($row['status_mobil'] == 'Tersedia') : ?>
                                <span class="badge bg-success">Tersedia</span>
                            <?php elseif ($row['status_mobil'] == 'Disewa') : ?>
                                <span class="badge bg-warning text-dark">Disewa</span>
                            <?php else : ?>
                                <span class="badge bg-danger">Servis</span>
                            <?php endif; ?>
                        </td>
                        <td>
                            <a href="<?= base_url('admin/travel/edit/' . $row['id_travel']) ?>" class="btn btn-sm btn-info text-white">
                                <i class="fas fa-edit"></i>
                            </a>
                            <a href="<?= base_url('admin/travel/delete/' . $row['id_travel']) ?>" class="btn btn-sm btn-danger" onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')">
                                <i class="fas fa-trash"></i>
                            </a>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
    </div>
</div>
<?= $this->endSection() ?>
