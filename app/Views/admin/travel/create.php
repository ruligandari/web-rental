<?= $this->extend('layout/main') ?>

<?= $this->section('content') ?>
<div class="mb-4">
    <a href="<?= base_url('admin/travel') ?>" class="btn btn-secondary btn-sm">
        <i class="fas fa-arrow-left me-2"></i> Kembali
    </a>
</div>

<div class="card border-0 shadow-sm rounded-3">
    <div class="card-header bg-white py-3">
        <h5 class="mb-0">Tambah Armada Baru</h5>
    </div>
    <div class="card-body">
        <form action="<?= base_url('admin/travel/store') ?>" method="post" enctype="multipart/form-data">
            <?= csrf_field() ?>
            
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="nama_mobil" class="form-label">Nama / Unit Mobil</label>
                    <input type="text" class="form-control <?= session('errors.nama_mobil') ? 'is-invalid' : '' ?>" id="nama_mobil" name="nama_mobil" value="<?= old('nama_mobil') ?>" required>
                    <div class="invalid-feedback"><?= session('errors.nama_mobil') ?></div>
                </div>

                <div class="col-md-6 mb-3">
                    <label for="plat_nomor" class="form-label">Plat Nomor</label>
                    <input type="text" class="form-control <?= session('errors.plat_nomor') ? 'is-invalid' : '' ?>" id="plat_nomor" name="plat_nomor" value="<?= old('plat_nomor') ?>" required>
                    <div class="invalid-feedback"><?= session('errors.plat_nomor') ?></div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="harga_sewa" class="form-label">Harga Sewa (Per Hari)</label>
                    <div class="input-group">
                        <span class="input-group-text">Rp</span>
                        <input type="number" class="form-control <?= session('errors.harga_sewa') ? 'is-invalid' : '' ?>" id="harga_sewa" name="harga_sewa" value="<?= old('harga_sewa') ?>" required>
                        <div class="invalid-feedback"><?= session('errors.harga_sewa') ?></div>
                    </div>
                </div>

                <div class="col-md-6 mb-3">
                    <label for="status_mobil" class="form-label">Status Awal</label>
                    <select class="form-select" id="status_mobil" name="status_mobil">
                        <option value="Tersedia">Tersedia</option>
                        <option value="Disewa">Disewa</option>
                        <option value="Servis">Servis</option>
                    </select>
                </div>
            </div>

            <div class="mb-3">
                <label for="foto" class="form-label">Foto Armada</label>
                <input type="file" class="form-control <?= session('errors.foto') ? 'is-invalid' : '' ?>" id="foto" name="foto" required>
                <div class="invalid-feedback"><?= session('errors.foto') ?></div>
                <small class="text-muted">Format: JPG/PNG/JPEG, Max size: 2MB</small>
            </div>

            <hr>
            <button type="submit" class="btn btn-primary px-4">Simpan Data</button>
        </form>
    </div>
</div>
<?= $this->endSection() ?>
