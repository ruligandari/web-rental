<?= $this->extend('layout/main') ?>

<?= $this->section('content') ?>
<div class="mb-4">
    <a href="<?= base_url('pelanggan/travel') ?>" class="btn btn-secondary btn-sm">
        <i class="fas fa-arrow-left me-2"></i> Kembali ke Katalog
    </a>
</div>

<div class="row">
    <div class="col-lg-5 mb-4">
        <div class="card border-0 shadow-sm rounded-3 overflow-hidden">
            <img src="<?= base_url('uploads/travel/' . $travel['foto']) ?>" class="card-img-top" alt="<?= $travel['nama_mobil'] ?>" style="height: 250px; object-fit: cover;">
            <div class="card-body">
                <h4><?= $travel['nama_mobil'] ?></h4>
                <p class="text-muted"><i class="fas fa-id-card me-1"></i> <?= $travel['plat_nomor'] ?></p>
                <hr>
                <div class="d-flex justify-content-between">
                    <span>Harga Sewa:</span>
                    <h5 class="text-primary">Rp <?= number_format($travel['harga_sewa'], 0, ',', '.') ?> / Hari</h5>
                </div>
            </div>
        </div>

        <div class="card border-0 shadow-sm rounded-3 mt-4">
            <div class="card-header bg-white py-3">
                <h6 class="mb-0 fw-bold"><i class="fas fa-calendar-alt me-2 text-primary"></i>Ketersediaan Bulan Ini</h6>
            </div>
            <div class="card-body p-0 d-flex justify-content-center pb-2 pt-3">
                <div id="inline-calendar"></div>
            </div>
            <div class="card-footer bg-white border-top-0 pt-0 pb-3">
                <small class="text-muted d-flex align-items-start">
                    <i class="fas fa-info-circle text-primary mt-1 me-2"></i>
                    <span>Tanggal yang pudar / tercoret menandakan armada sudah di-booking pada jadwal tersebut.</span>
                </small>
            </div>
        </div>
    </div>

    <div class="col-lg-7 mb-4">
        <div class="card border-0 shadow-sm rounded-3">
            <div class="card-header bg-white py-3">
                <h5 class="mb-0">Form Reservasi</h5>
            </div>
            <div class="card-body">
                <form action="<?= base_url('pelanggan/reservasi/store') ?>" method="post">
                    <?= csrf_field() ?>
                    <input type="hidden" name="id_travel" value="<?= $travel['id_travel'] ?>">

                    <!-- Info Kalender dihapus, pindah ke visual kalender di kiri -->

                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="tgl_mulai" class="form-label">Tanggal Mulai Sewa</label>
                            <input type="text" class="form-control bg-white" id="tgl_mulai" name="tgl_mulai" required placeholder="Pilih tanggal">
                        </div>
                        <div class="col-md-6">
                            <label for="tgl_selesai" class="form-label">Tanggal Selesai Sewa</label>
                            <input type="text" class="form-control bg-white" id="tgl_selesai" name="tgl_selesai" required placeholder="Pilih tanggal">
                        </div>
                    </div>

                    <div class="alert alert-info py-3" id="alert-total">
                        <small><i class="fas fa-info-circle me-1"></i> Pilih tanggal mulai dan selesai untuk melihat total biaya.</small>
                    </div>

                    <hr>
                    <button type="submit" class="btn btn-primary w-100 py-2" id="btn-submit">Lanjut ke Pembayaran</button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Flatpickr CSS & JS -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const hargaSewa = <?= $travel['harga_sewa'] ?>;
    const alertTotal = document.getElementById('alert-total');
    const btnSubmit = document.getElementById('btn-submit');
    
    const bookedDates = <?= $booked_dates ?>;
    const disabledRanges = bookedDates.map(b => ({from: b.start, to: b.end}));

    const fpConfig = {
        minDate: "today",
        disable: disabledRanges,
        dateFormat: "Y-m-d",
        onChange: function() {
            hitungTotal();
        }
    };

    const fpStart = flatpickr("#tgl_mulai", fpConfig);
    const fpEnd = flatpickr("#tgl_selesai", fpConfig);

    // Initialize visual inline calendar on the left side
    flatpickr("#inline-calendar", {
        inline: true,
        minDate: "today",
        disable: disabledRanges,
        dateFormat: "Y-m-d"
    });

    function hitungTotal() {
        const startVal = document.getElementById('tgl_mulai').value;
        const endVal = document.getElementById('tgl_selesai').value;

        if(startVal && endVal) {
            const start = new Date(startVal);
            const end = new Date(endVal);
            
            start.setHours(0,0,0,0);
            end.setHours(0,0,0,0);

            if(end < start) {
                tampilkanError('Tanggal selesai tidak boleh mendahului tanggal mulai.');
                return;
            }

            // Check if any booked date falls inside the selected range
            let isOverlap = false;
            for(let i = 0; i < bookedDates.length; i++) {
                const bStart = new Date(bookedDates[i].start);
                const bEnd = new Date(bookedDates[i].end);
                bStart.setHours(0,0,0,0);
                bEnd.setHours(0,0,0,0);
                
                // If there's an intersection
                if (start <= bEnd && end >= bStart) {
                    isOverlap = true;
                    break;
                }
            }

            if(isOverlap) {
                tampilkanError('Rentang tanggal yang Anda pilih bertabrakan dengan jadwal yang sudah terisi.');
                return;
            }

            btnSubmit.disabled = false;
            alertTotal.classList.remove('alert-danger');
            alertTotal.classList.add('alert-info');

            // Hitung durasi (minimal 1 hari)
            const diffTime = Math.abs(end - start);
            const diffDays = Math.ceil(diffTime / (1000 * 60 * 60 * 24)) + 1; 
            const totalBayar = diffDays * hargaSewa;

            const formatter = new Intl.NumberFormat('id-ID', {
                style: 'currency',
                currency: 'IDR',
                minimumFractionDigits: 0
            });

            alertTotal.innerHTML = `
                <div class="d-flex justify-content-between align-items-center">
                    <span class="fs-6">Durasi Sewa: <strong>${diffDays} Hari</strong></span>
                    <h4 class="mb-0 text-primary"><strong>${formatter.format(totalBayar)}</strong></h4>
                </div>
            `;
        }
    }

    function tampilkanError(msg) {
        alertTotal.innerHTML = '<small class="text-danger"><i class="fas fa-exclamation-triangle me-1"></i> ' + msg + '</small>';
        alertTotal.classList.remove('alert-info');
        alertTotal.classList.add('alert-danger');
        btnSubmit.disabled = true;
    }
});
</script>
<?= $this->endSection() ?>
