<?= $this->extend('layout/main') ?>

<?= $this->section('content') ?>
<div class="d-flex justify-content-between align-items-center mb-4">
    <h3>Kelola Data Pelanggan</h3>
    <a href="<?= base_url('admin/pelanggan/create') ?>" class="btn btn-primary">
        <i class="fas fa-plus me-2"></i> Tambah Pelanggan
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
                        <th>Nama Pelanggan</th>
                        <th>Username</th>
                        <th>Email</th>
                        <th>WhatsApp</th>
                        <th>Alamat</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $no = 1; foreach ($pelanggan as $row) : ?>
                    <tr>
                        <td><?= $no++ ?></td>
                        <td><strong><?= $row['nama_pelanggan'] ?></strong></td>
                        <td><?= $row['username'] ?></td>
                        <td><?= $row['email'] ?></td>
                        <td><?= $row['no_telp'] ?></td>
                        <td><small><?= $row['alamat'] ?></small></td>
                        <td>
                            <a href="<?= base_url('admin/pelanggan/edit/' . $row['id_pelanggan']) ?>" class="btn btn-sm btn-info text-white">
                                <i class="fas fa-edit"></i>
                            </a>
                            <a href="<?= base_url('admin/pelanggan/delete/' . $row['id_pelanggan']) ?>" class="btn btn-sm btn-danger" onclick="return confirm('Apakah Anda yakin ingin menghapus pelanggan ini? Seluruh data akun akan terhapus.')">
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
