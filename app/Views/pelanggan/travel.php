<?= $this->extend('layout/main') ?>

<?= $this->section('content') ?>
<div class="row mb-4 align-items-center">
    <div class="col-md-6">
        <h3>Pilih Armada</h3>
        <p class="text-muted mb-0">Temukan kendaraan yang sesuai dengan kebutuhan perjalanan Anda.</p>
    </div>
    <div class="col-md-6 mt-3 mt-md-0">
        <form action="<?= base_url('pelanggan/travel') ?>" method="get">
            <div class="input-group shadow-sm" style="border-radius: 12px; overflow: hidden;">
                <input type="text" class="form-control border-0 py-2 ps-4" name="search" placeholder="Cari nama armada..." value="<?= esc($search ?? '') ?>" style="font-size: 0.95rem;">
                <button class="btn btn-primary px-4 py-2 border-0" type="submit"><i class="fas fa-search me-1"></i> Cari</button>
            </div>
        </form>
    </div>
</div>

<?php if (empty($travel)) : ?>
    <div class="alert alert-info">Maaf, saat ini belum ada armada yang tersedia.</div>
<?php else : ?>
    <div class="row">
        <?php foreach ($travel as $row) : ?>
            <div class="col-md-6 col-lg-4 mb-4">
                <div class="card h-100 border-0 shadow-sm rounded-3 overflow-hidden">
                    <img src="<?= base_url('uploads/travel/' . $row['foto']) ?>" class="card-img-top" alt="<?= $row['nama_mobil'] ?>" style="height: 200px; object-fit: cover;">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center mb-2">
                            <h5 class="card-title mb-0"><?= $row['nama_mobil'] ?></h5>
                            <?php if ($row['status_mobil'] == 'Tersedia') : ?>
                                <span class="badge bg-success">Tersedia</span>
                            <?php elseif ($row['status_mobil'] == 'Disewa') : ?>
                                <span class="badge bg-warning text-dark">Disewa</span>
                            <?php else : ?>
                                <span class="badge bg-danger">Servis</span>
                            <?php endif; ?>
                        </div>
                        <p class="text-muted mb-3"><i class="fas fa-id-card me-1"></i> <?= $row['plat_nomor'] ?></p>
                        <h4 class="text-primary mb-3">Rp <?= number_format($row['harga_sewa'], 0, ',', '.') ?> <small class="text-muted" style="font-size: 0.8rem;">/ Hari</small></h4>
                        
                        <?php if ($row['status_mobil'] == 'Tersedia') : ?>
                            <a href="<?= base_url('pelanggan/reservasi/' . $row['id_travel']) ?>" class="btn btn-primary w-100 py-2">Pesan Sekarang</a>
                        <?php else : ?>
                            <button class="btn btn-secondary w-100 py-2" disabled>Tidak Tersedia</button>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
<?php endif; ?>
<?= $this->endSection() ?>
