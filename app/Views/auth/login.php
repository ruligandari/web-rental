<?= $this->extend('layout/auth') ?>

<?= $this->section('content') ?>
<div class="text-center mb-4">
    <img src="<?= base_url('assets/img/ycr-rental.jpg') ?>" alt="Logo YCR Rental" style="width: 100px; height: 100px; object-fit: cover; border-radius: 20px;" class="mb-3 shadow-sm">
    <h3>YCR Rental</h3>
    <p class="text-muted small">Selamat datang kembali! Silakan login untuk melanjutkan.</p>
</div>

<form action="<?= base_url('login') ?>" method="post">
    <?= csrf_field() ?>
    
    <div class="mb-3">
        <label for="username" class="form-label">Username</label>
        <input type="text" class="form-control" id="username" name="username" required autofocus>
    </div>

    <div class="mb-3">
        <label for="password" class="form-label">Password</label>
        <input type="password" class="form-control" id="password" name="password" required>
    </div>

    <div class="mb-3 form-check">
        <input type="checkbox" class="form-check-input" id="remember">
        <label class="form-check-label" for="remember">Ingat saya</label>
    </div>

    <button type="submit" class="btn btn-primary w-100 py-2">Login</button>
</form>

<div class="mt-4 text-center">
    <p class="mb-0">Belum punya akun? <a href="<?= base_url('register') ?>">Daftar sekarang</a></p>
</div>
<?= $this->endSection() ?>
