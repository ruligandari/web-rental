<?= $this->extend('layout/main') ?>

<?= $this->section('content') ?>
<div class="mb-4">
    <a href="<?= base_url('admin/pelanggan') ?>" class="btn btn-secondary btn-sm">
        <i class="fas fa-arrow-left me-2"></i> Kembali
    </a>
</div>

<div class="card border-0 shadow-sm rounded-3">
    <div class="card-header bg-white py-3">
        <h5 class="mb-0">Edit Data Pelanggan</h5>
    </div>
    <div class="card-body">
        <form action="<?= base_url('admin/pelanggan/update/' . $pelanggan['id_pelanggan']) ?>" method="post">
            <?= csrf_field() ?>
            
            <div class="row">
                <div class="col-md-6">
                    <h6 class="text-primary mb-3">Informasi Profil</h6>
                    <div class="mb-3">
                        <label for="nama_pelanggan" class="form-label">Nama Lengkap</label>
                        <input type="text" class="form-control <?= session('errors.nama_pelanggan') ? 'is-invalid' : '' ?>" id="nama_pelanggan" name="nama_pelanggan" value="<?= old('nama_pelanggan', $pelanggan['nama_pelanggan']) ?>" required>
                        <div class="invalid-feedback"><?= session('errors.nama_pelanggan') ?></div>
                    </div>
                    <div class="mb-3">
                        <label for="no_telp" class="form-label">No. WhatsApp</label>
                        <input type="text" class="form-control <?= session('errors.no_telp') ? 'is-invalid' : '' ?>" id="no_telp" name="no_telp" value="<?= old('no_telp', $pelanggan['no_telp']) ?>" required>
                        <div class="invalid-feedback"><?= session('errors.no_telp') ?></div>
                    </div>
                    <div class="mb-3">
                        <label for="alamat" class="form-label">Alamat</label>
                        <textarea class="form-control <?= session('errors.alamat') ? 'is-invalid' : '' ?>" id="alamat" name="alamat" rows="3" required><?= old('alamat', $pelanggan['alamat']) ?></textarea>
                        <div class="invalid-feedback"><?= session('errors.alamat') ?></div>
                    </div>
                </div>

                <div class="col-md-6">
                    <h6 class="text-primary mb-3">Informasi Akun</h6>
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control <?= session('errors.email') ? 'is-invalid' : '' ?>" id="email" name="email" value="<?= old('email', $pelanggan['email']) ?>" required>
                        <div class="invalid-feedback"><?= session('errors.email') ?></div>
                    </div>
                    <div class="mb-3">
                        <label for="username" class="form-label">Username</label>
                        <input type="text" class="form-control <?= session('errors.username') ? 'is-invalid' : '' ?>" id="username" name="username" value="<?= old('username', $pelanggan['username']) ?>" required>
                        <div class="invalid-feedback"><?= session('errors.username') ?></div>
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">Password Baru (Opsional)</label>
                        <input type="password" class="form-control <?= session('errors.password') ? 'is-invalid' : '' ?>" id="password" name="password">
                        <div class="invalid-feedback"><?= session('errors.password') ?></div>
                        <small class="text-muted">Biarkan kosong jika tidak ingin mengubah password.</small>
                    </div>
                </div>
            </div>

            <hr>
            <button type="submit" class="btn btn-primary px-4">Perbarui Pelanggan</button>
        </form>
    </div>
</div>
<?= $this->endSection() ?>
