<?= $this->extend('layout/main') ?>

<?= $this->section('content') ?>
<div class="d-flex justify-content-between align-items-center mb-4 no-print">
    <h3>Laporan Transaksi</h3>
    <button onclick="window.print()" class="btn btn-outline-primary">
        <i class="fas fa-print me-2"></i> Cetak Laporan
    </button>
</div>

<div class="card border-0 shadow-sm rounded-3 mb-4 no-print">
    <div class="card-body">
        <form action="<?= base_url('owner/laporan/filter') ?>" method="post" class="row g-3 align-items-end">
            <?= csrf_field() ?>
            <div class="col-md-4">
                <label for="tgl_awal" class="form-label">Tanggal Awal</label>
                <input type="date" class="form-control" id="tgl_awal" name="tgl_awal" value="<?= $tgl_awal ?>">
            </div>
            <div class="col-md-4">
                <label for="tgl_akhir" class="form-label">Tanggal Akhir</label>
                <input type="date" class="form-control" id="tgl_akhir" name="tgl_akhir" value="<?= $tgl_akhir ?>">
            </div>
            <div class="col-md-4">
                <button type="submit" class="btn btn-primary w-100">Filter Laporan</button>
            </div>
        </form>
    </div>
</div>

<div class="card border-0 shadow-sm rounded-3">
    <div class="card-body">
        <div class="text-center mb-4 only-print">
            <h3>LAPORAN TRANSAKSI CRM TRAVEL</h3>
            <p>Periode: <?= $tgl_awal ? date('d/m/Y', strtotime($tgl_awal)) : 'Semua' ?> - <?= $tgl_akhir ? date('d/m/Y', strtotime($tgl_akhir)) : 'Semua' ?></p>
            <hr>
        </div>

        <div class="table-responsive">
            <table class="table table-bordered align-middle">
                <thead class="table-light">
                    <tr>
                        <th>#</th>
                        <th>Tanggal</th>
                        <th>Pelanggan</th>
                        <th>Armada</th>
                        <th>Status</th>
                        <th class="text-end">Total Bayar</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                    $total = 0;
                    $no = 1; 
                    foreach ($laporan as $row) : 
                        $total += $row['total_bayar'];
                    ?>
                    <tr>
                        <td><?= $no++ ?></td>
                        <td><?= date('d/m/Y', strtotime($row['tgl_mulai'])) ?></td>
                        <td><?= $row['nama_pelanggan'] ?></td>
                        <td><?= $row['nama_mobil'] ?></td>
                        <td>
                            <span class="badge <?= $row['status_reservasi'] == 'Pending' ? 'bg-warning text-dark' : ($row['status_reservasi'] == 'Dikonfirmasi' ? 'bg-success' : 'bg-primary') ?>">
                                <?= $row['status_reservasi'] ?>
                            </span>
                        </td>
                        <td class="text-end">Rp <?= number_format($row['total_bayar'], 0, ',', '.') ?></td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
                <tfoot class="table-light">
                    <tr>
                        <th colspan="5" class="text-end">Total Pendapatan</th>
                        <th class="text-end text-primary">Rp <?= number_format($total, 0, ',', '.') ?></th>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>
</div>

<style>
    @media print {
        .no-print { display: none !important; }
        .only-print { display: block !important; }
        .card { border: none !important; box-shadow: none !important; }
        #sidebar, .navbar { display: none !important; }
        #content { padding: 0 !important; width: 100% !important; }
        .wrapper { display: block !important; }
    }
    .only-print { display: none; }
</style>
<?= $this->endSection() ?>
