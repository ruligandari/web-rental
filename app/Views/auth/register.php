<?= $this->extend('layout/auth') ?>

<?= $this->section('content') ?>
<div class="text-center mb-4">
    <img src="<?= base_url('assets/img/ycr-rental.jpg') ?>" alt="Logo YCR Rental" style="width: 100px; height: 100px; object-fit: cover; border-radius: 20px;" class="mb-3 shadow-sm">
    <h3>Daftar Akun</h3>
    <p class="text-muted small">Lengkapi data di bawah ini untuk mulai mereservasi armada terbaik kami.</p>
</div>

<form action="<?= base_url('register') ?>" method="post">
    <?= csrf_field() ?>
    
    <div class="mb-3">
        <label for="nama_lengkap" class="form-label">Nama Lengkap</label>
        <input type="text" class="form-control <?= session('errors.nama_lengkap') ? 'is-invalid' : '' ?>" id="nama_lengkap" name="nama_lengkap" value="<?= old('nama_lengkap') ?>" required>
        <div class="invalid-feedback"><?= session('errors.nama_lengkap') ?></div>
    </div>

    <div class="mb-3">
        <label for="email" class="form-label">Email</label>
        <input type="email" class="form-control <?= session('errors.email') ? 'is-invalid' : '' ?>" id="email" name="email" value="<?= old('email') ?>" required>
        <div class="invalid-feedback"><?= session('errors.email') ?></div>
    </div>

    <div class="mb-3">
        <label for="no_telp" class="form-label">No. WhatsApp</label>
        <input type="text" class="form-control <?= session('errors.no_telp') ? 'is-invalid' : '' ?>" id="no_telp" name="no_telp" value="<?= old('no_telp') ?>" required>
        <div class="invalid-feedback"><?= session('errors.no_telp') ?></div>
    </div>

    <div class="mb-3">
        <label for="alamat" class="form-label">Alamat</label>
        <textarea class="form-control <?= session('errors.alamat') ? 'is-invalid' : '' ?>" id="alamat" name="alamat" rows="2" required><?= old('alamat') ?></textarea>
        <div class="invalid-feedback"><?= session('errors.alamat') ?></div>
    </div>

    <hr>

    <div class="mb-3">
        <label for="username" class="form-label">Username</label>
        <input type="text" class="form-control <?= session('errors.username') ? 'is-invalid' : '' ?>" id="username" name="username" value="<?= old('username') ?>" required>
        <div class="invalid-feedback"><?= session('errors.username') ?></div>
    </div>

    <div class="mb-3">
        <label for="password" class="form-label">Password</label>
        <input type="password" class="form-control <?= session('errors.password') ? 'is-invalid' : '' ?>" id="password" name="password" required>
        <div class="invalid-feedback"><?= session('errors.password') ?></div>
    </div>

    <button type="submit" class="btn btn-primary w-100 py-2">Daftar Sekarang</button>
</form>

<div class="mt-4 text-center">
    <p class="mb-0">Sudah punya akun? <a href="<?= base_url('login') ?>">Login di sini</a></p>
</div>
<?= $this->endSection() ?>
