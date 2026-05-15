<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { background: #f0f0f0; padding-top: 50px; font-family: 'Inter', sans-serif; }
        .invoice-box { max-width: 800px; margin: auto; padding: 30px; border: 1px solid #eee; box-shadow: 0 0 10px rgba(0, 0, 0, .15); font-size: 16px; line-height: 24px; color: #555; background: #fff; }
        .invoice-box table { width: 100%; line-height: inherit; text-align: left; }
        @media print {
            .no-print { display: none; }
            body { padding-top: 0; background: #fff; }
            .invoice-box { box-shadow: none; border: none; max-width: 100%; }
        }
    </style>
</head>
<body>

<div class="container no-print mb-4 text-center">
    <button onclick="window.print()" class="btn btn-primary"><i class="fas fa-print me-2"></i> Cetak Invoice</button>
    <a href="<?= base_url('dashboard') ?>" class="btn btn-secondary">Kembali ke Dashboard</a>
</div>

<div class="invoice-box">
    <table cellpadding="0" cellspacing="0">
        <tr class="top">
            <td colspan="2">
                <table class="mb-4">
                    <tr>
                        <td class="title">
                            <h2 class="text-primary mb-0">YCR RENTAL</h2>
                            <small>Rental Mobil Kuningan</small>
                        </td>
                        <td class="text-end">
                            <strong>Invoice #:</strong> <?= $invoice['id_reservasi'] ?><br>
                            <strong>Tanggal:</strong> <?= date('d M Y', strtotime($invoice['tgl_bayar'] ?? date('Y-m-d'))) ?><br>
                            <strong>Status:</strong> <span class="badge bg-success mb-1"><?= $invoice['status_reservasi'] ?></span><br>
                            <strong>Metode:</strong> <?= esc($invoice['metode_pembayaran'] ?? '-') ?>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>

        <tr class="information">
            <td colspan="2">
                <table class="mb-4">
                    <tr>
                        <td>
                            <strong>Dari:</strong><br>
                            YCR Rental Office<br>
                            Perumahan Panorama Asri Jl.Cendrawasih A.59<br>
                            Kuningan, Jawa Barat
                        </td>
                        <td class="text-end">
                            <strong>Kepada:</strong><br>
                            <?= $invoice['nama_pelanggan'] ?><br>
                            <?= $invoice['no_telp'] ?><br>
                            <?= $invoice['alamat'] ?>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>

        <tr>
            <td colspan="2">
                <table class="table table-bordered">
                    <thead class="table-light">
                        <tr>
                            <th>Deskripsi Armada</th>
                            <th class="text-center">Durasi</th>
                            <th class="text-end">Harga/Hari</th>
                            <th class="text-end">Total</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>
                                <strong><?= $invoice['nama_mobil'] ?></strong><br>
                                <small class="text-muted">Plat: <?= $invoice['plat_nomor'] ?></small><br>
                                <small class="text-muted">Periode: <?= date('d/m/Y', strtotime($invoice['tgl_mulai'])) ?> - <?= date('d/m/Y', strtotime($invoice['tgl_selesai'])) ?></small>
                            </td>
                            <?php 
                                $tgl1 = new \DateTime($invoice['tgl_mulai']);
                                $tgl2 = new \DateTime($invoice['tgl_selesai']);
                                $durasi = $tgl1->diff($tgl2)->days + 1;
                            ?>
                            <td class="text-center"><?= $durasi ?> Hari</td>
                            <td class="text-end">Rp <?= number_format($invoice['harga_sewa'], 0, ',', '.') ?></td>
                            <td class="text-end">Rp <?= number_format($invoice['total_bayar'], 0, ',', '.') ?></td>
                        </tr>
                    </tbody>
                    <tfoot>
                        <tr>
                            <td colspan="3" class="text-end"><strong>Grand Total</strong></td>
                            <td class="text-end"><strong>Rp <?= number_format($invoice['total_bayar'], 0, ',', '.') ?></strong></td>
                        </tr>
                    </tfoot>
                </table>
            </td>
        </tr>
    </table>
    
    <div class="mt-5 text-center small text-muted">
        <p>Terima kasih telah mempercayai layanan kami.<br>Harap simpan invoice ini sebagai bukti reservasi yang sah.</p>
    </div>
</div>

<!-- FontAwesome for icons -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</body>
</html>
