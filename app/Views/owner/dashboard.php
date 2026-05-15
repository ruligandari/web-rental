<?= $this->extend('layout/main') ?>

<?= $this->section('content') ?>
<div class="row">
    <div class="col-md-6 col-lg-3 mb-4">
        <div class="card border-0 shadow-sm rounded-3 bg-white h-100">
            <div class="card-body p-4">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h6 class="text-uppercase mb-2 text-muted" style="font-size: 0.75rem; font-weight: 700; letter-spacing: 0.5px;">Total Penjualan</h6>
                        <h2 class="mb-0 fw-bold text-dark"><?= number_format($total_penjualan) ?></h2>
                    </div>
                    <div class="rounded-circle d-flex align-items-center justify-content-center" style="background-color: rgba(79, 70, 229, 0.1); color: #4f46e5; width: 60px; height: 60px;">
                        <i class="fas fa-shopping-cart fa-xl"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-6 col-lg-4 mb-4">
        <div class="card border-0 shadow-sm rounded-3 bg-white h-100">
            <div class="card-body p-4">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h6 class="text-uppercase mb-2 text-muted" style="font-size: 0.75rem; font-weight: 700; letter-spacing: 0.5px;">Total Pendapatan</h6>
                        <h2 class="mb-0 fw-bold text-success">Rp <?= number_format($total_pendapatan, 0, ',', '.') ?></h2>
                    </div>
                    <div class="rounded-circle d-flex align-items-center justify-content-center" style="background-color: rgba(16, 185, 129, 0.1); color: #10b981; width: 60px; height: 60px;">
                        <i class="fas fa-money-bill-wave fa-xl"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-lg-8 mb-4">
        <div class="card border-0 shadow-sm rounded-3">
            <div class="card-header bg-white py-3">
                <h5 class="mb-0">Ringkasan Penjualan</h5>
            </div>
            <div class="card-body">
                <canvas id="salesChart" height="300"></canvas>
            </div>
        </div>
    </div>
    
    <div class="col-lg-4 mb-4">
        <div class="card border-0 shadow-sm rounded-3">
            <div class="card-header bg-white py-3">
                <h5 class="mb-0">Aktivitas Terbaru</h5>
            </div>
            <div class="card-body p-0">
                <div class="list-group list-group-flush">
                    <?php if (empty($aktifitas_terbaru)): ?>
                        <p class="text-muted text-center py-5">Belum ada aktivitas terbaru.</p>
                    <?php else: ?>
                        <?php foreach ($aktifitas_terbaru as $aktifitas): ?>
                        <div class="list-group-item px-4 py-3">
                            <div class="d-flex justify-content-between align-items-center mb-1">
                                <h6 class="mb-0 text-primary">#TRX-<?= $aktifitas['id_reservasi'] ?></h6>
                                <span class="badge <?= $aktifitas['status_reservasi'] == 'Pending' ? 'bg-warning' : 'bg-success' ?> rounded-pill" style="font-size: 0.7rem;">
                                    <?= $aktifitas['status_reservasi'] ?>
                                </span>
                            </div>
                            <p class="mb-1 fw-bold"><?= $aktifitas['nama_pelanggan'] ?></p>
                            <div class="d-flex justify-content-between align-items-center">
                                <small class="text-muted"><i class="fas fa-car me-1"></i> <?= $aktifitas['nama_mobil'] ?></small>
                                <small class="text-muted">Rp <?= number_format($aktifitas['total_bayar'], 0, ',', '.') ?></small>
                            </div>
                        </div>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const ctx = document.getElementById('salesChart').getContext('2d');
        new Chart(ctx, {
            type: 'line',
            data: {
                labels: <?= json_encode($chart_data['labels']) ?>,
                datasets: [{
                    label: 'Pendapatan (Rp)',
                    data: <?= json_encode($chart_data['values']) ?>,
                    borderColor: '#3498db',
                    backgroundColor: 'rgba(52, 152, 219, 0.1)',
                    borderWidth: 2,
                    fill: true,
                    tension: 0.3
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    tooltip: {
                        callbacks: {
                            label: function(context) {
                                let label = context.dataset.label || '';
                                if (label) label += ': ';
                                if (context.parsed.y !== null) {
                                    label += new Intl.NumberFormat('id-ID', { style: 'currency', currency: 'IDR' }).format(context.parsed.y);
                                }
                                return label;
                            }
                        }
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    });
</script>
<?= $this->endSection() ?>
