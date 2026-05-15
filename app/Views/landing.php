<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>YCR Rental | Solusi Perjalanan Anda</title>
    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- FontAwesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    
    <style>
        :root {
            --primary-color: #4f46e5;
            --primary-hover: #4338ca;
            --secondary-color: #1e293b;
        }
        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background-color: #f8fafc;
            color: #334155;
            overflow-x: hidden;
        }
        
        /* Navbar */
        .navbar {
            background-color: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            box-shadow: 0 4px 20px rgba(0,0,0,0.05);
            padding: 15px 0;
            transition: all 0.3s ease;
        }
        .navbar-brand img {
            width: 45px;
            height: 45px;
            object-fit: cover;
            border-radius: 12px;
            margin-right: 12px;
        }
        .navbar-brand span {
            font-weight: 800;
            color: var(--primary-color);
            font-size: 1.4rem;
            letter-spacing: -0.5px;
        }
        .nav-link {
            font-weight: 600;
            color: #475569 !important;
            margin: 0 10px;
            transition: 0.3s;
        }
        .nav-link:hover {
            color: var(--primary-color) !important;
        }
        .btn-custom {
            border-radius: 10px;
            font-weight: 600;
            padding: 10px 24px;
            transition: all 0.3s;
        }
        .btn-primary-custom {
            background-color: var(--primary-color);
            border: none;
            color: white;
            box-shadow: 0 4px 15px rgba(79, 70, 229, 0.3);
        }
        .btn-primary-custom:hover {
            background-color: var(--primary-hover);
            transform: translateY(-2px);
            color: white;
            box-shadow: 0 6px 20px rgba(79, 70, 229, 0.4);
        }
        .btn-outline-custom {
            border: 2px solid var(--primary-color);
            color: var(--primary-color);
        }
        .btn-outline-custom:hover {
            background-color: var(--primary-color);
            color: white;
        }

        /* Hero Section */
        .hero {
            padding: 160px 0 100px;
            background: linear-gradient(135deg, #f0f4ff 0%, #ffffff 100%);
            position: relative;
        }
        .hero::before {
            content: '';
            position: absolute;
            top: 0; right: 0;
            width: 500px; height: 500px;
            background: radial-gradient(circle, rgba(79, 70, 229, 0.1) 0%, rgba(255,255,255,0) 70%);
            border-radius: 50%;
            z-index: 0;
        }
        .hero-content {
            position: relative;
            z-index: 1;
        }
        .hero-title {
            font-weight: 800;
            font-size: 3.5rem;
            line-height: 1.2;
            color: var(--secondary-color);
            letter-spacing: -1px;
            margin-bottom: 20px;
        }
        .hero-title span {
            color: var(--primary-color);
        }
        .hero-subtitle {
            font-size: 1.15rem;
            color: #64748b;
            margin-bottom: 40px;
            max-width: 600px;
            line-height: 1.7;
        }
        .hero-image {
            position: relative;
            z-index: 1;
            animation: float 6s ease-in-out infinite;
        }
        @keyframes float {
            0% { transform: translateY(0px); }
            50% { transform: translateY(-20px); }
            100% { transform: translateY(0px); }
        }

        /* Featured Section */
        .section-title {
            font-weight: 800;
            color: var(--secondary-color);
            margin-bottom: 15px;
            letter-spacing: -0.5px;
        }
        .section-subtitle {
            color: #64748b;
            margin-bottom: 50px;
        }
        .car-card {
            background: #fff;
            border-radius: 20px;
            border: none;
            box-shadow: 0 10px 30px rgba(0,0,0,0.04);
            transition: all 0.3s;
            overflow: hidden;
            height: 100%;
        }
        .car-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 20px 40px rgba(0,0,0,0.08);
        }
        .car-card img {
            height: 220px;
            object-fit: cover;
        }
        .car-price {
            font-size: 1.4rem;
            font-weight: 700;
            color: var(--primary-color);
        }

        /* Features Section */
        .feature-box {
            padding: 40px 30px;
            background: #fff;
            border-radius: 20px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.03);
            text-align: center;
            height: 100%;
            transition: 0.3s;
        }
        .feature-box:hover {
            transform: translateY(-5px);
        }
        .feature-icon {
            width: 70px;
            height: 70px;
            background: rgba(79, 70, 229, 0.1);
            color: var(--primary-color);
            border-radius: 20px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            font-size: 1.8rem;
            margin-bottom: 20px;
        }

        /* Footer */
        footer {
            background: var(--secondary-color);
            color: #cbd5e1;
            padding: 60px 0 30px;
        }
        footer h5 {
            color: #fff;
            font-weight: 700;
            margin-bottom: 20px;
        }
        footer a {
            color: #cbd5e1;
            text-decoration: none;
            transition: 0.3s;
        }
        footer a:hover {
            color: #fff;
        }
    </style>
</head>
<body>

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg fixed-top">
        <div class="container">
            <a class="navbar-brand d-flex align-items-center" href="<?= base_url() ?>">
                <img src="<?= base_url('assets/img/ycr-rental.jpg') ?>" alt="YCR Rental Logo">
                <span>YCR Rental</span>
            </a>
            <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <i class="fas fa-bars text-dark"></i>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav mx-auto">
                    <li class="nav-item"><a class="nav-link" href="#beranda">Beranda</a></li>
                    <li class="nav-item"><a class="nav-link" href="#armada">Armada Kami</a></li>
                    <li class="nav-item"><a class="nav-link" href="#keunggulan">Keunggulan</a></li>
                </ul>
                <div class="d-flex gap-3 mt-3 mt-lg-0">
                    <?php if (session()->get('isLoggedIn')) : ?>
                        <a href="<?= base_url('dashboard') ?>" class="btn btn-custom btn-primary-custom">Dashboard Saya</a>
                    <?php else : ?>
                        <a href="<?= base_url('login') ?>" class="btn btn-custom btn-outline-custom">Log In</a>
                        <a href="<?= base_url('register') ?>" class="btn btn-custom btn-primary-custom">Daftar</a>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <section id="beranda" class="hero">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6 hero-content text-center text-lg-start mb-5 mb-lg-0">
                    <span class="badge bg-primary bg-opacity-10 text-primary px-3 py-2 rounded-pill mb-3 fw-bold">Penyewaan Mobil Premium</span>
                    <h1 class="hero-title">Perjalanan Nyaman,<br>Harga <span>Aman.</span></h1>
                    <p class="hero-subtitle">Kami menyediakan berbagai pilihan armada terbaik yang terawat untuk menemani perjalanan bisnis, liburan, atau kebutuhan operasional Anda dengan proses pemesanan yang super mudah.</p>
                    <div class="d-flex gap-3 justify-content-center justify-content-lg-start">
                        <a href="<?= base_url('register') ?>" class="btn btn-custom btn-primary-custom btn-lg px-4"><i class="fas fa-car me-2"></i> Sewa Sekarang</a>
                        <a href="#armada" class="btn btn-custom btn-outline-custom btn-lg px-4">Lihat Armada</a>
                    </div>
                </div>
                <div class="col-lg-6">
                    <!-- Ilustrasi atau Foto Mobil -->
                    <div class="position-relative text-center">
                        <img src="<?= base_url('assets/img/ycr-rental.jpg') ?>" alt="Mobil Premium" class="img-fluid rounded-4 shadow-lg hero-image" style="max-height: 400px; width: auto; object-fit: cover; border-radius: 30px !important;">
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Armada Section -->
    <section id="armada" class="py-5 bg-white">
        <div class="container py-5">
            <div class="text-center mb-5">
                <h2 class="section-title">Armada Unggulan Kami</h2>
                <p class="section-subtitle">Pilih mobil yang sesuai dengan gaya dan kebutuhan Anda.</p>
            </div>
            
            <div class="row g-4">
                <?php if (!empty($armada)) : ?>
                    <?php foreach ($armada as $mobil) : ?>
                    <div class="col-md-6 col-lg-4">
                        <div class="car-card">
                            <img src="<?= base_url('uploads/travel/' . $mobil['foto']) ?>" class="card-img-top w-100" alt="<?= esc($mobil['nama_mobil']) ?>">
                            <div class="card-body p-4">
                                <div class="d-flex justify-content-between align-items-center mb-3">
                                    <h5 class="fw-bold mb-0 text-dark"><?= esc($mobil['nama_mobil']) ?></h5>
                                    <?php if ($mobil['status_mobil'] == 'Tersedia') : ?>
                                        <span class="badge bg-success bg-opacity-10 text-success px-2 py-1 rounded">Tersedia</span>
                                    <?php elseif ($mobil['status_mobil'] == 'Disewa') : ?>
                                        <span class="badge bg-warning bg-opacity-10 text-warning px-2 py-1 rounded">Disewa</span>
                                    <?php else : ?>
                                        <span class="badge bg-danger bg-opacity-10 text-danger px-2 py-1 rounded">Servis</span>
                                    <?php endif; ?>
                                </div>
                                <div class="d-flex gap-3 text-muted small mb-4">
                                    <span><i class="fas fa-gas-pump me-1"></i> Bensin</span>
                                    <span><i class="fas fa-cogs me-1"></i> Auto/MT</span>
                                    <span><i class="fas fa-id-card me-1"></i> <?= esc($mobil['plat_nomor']) ?></span>
                                </div>
                                <div class="d-flex justify-content-between align-items-center border-top pt-3">
                                    <div>
                                        <span class="text-muted small d-block">Mulai dari</span>
                                        <div class="car-price">Rp <?= number_format($mobil['harga_sewa'], 0, ',', '.') ?></div>
                                    </div>
                                    <?php if ($mobil['status_mobil'] == 'Tersedia') : ?>
                                        <a href="<?= session()->get('isLoggedIn') ? base_url('pelanggan/reservasi/'.$mobil['id_travel']) : base_url('login') ?>" class="btn btn-primary-custom btn-custom px-3 py-2">Sewa</a>
                                    <?php else : ?>
                                        <button class="btn btn-secondary btn-custom px-3 py-2 border-0" style="opacity: 0.6;" disabled>Tidak Tersedia</button>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php endforeach; ?>
                <?php else : ?>
                    <div class="col-12 text-center py-5">
                        <div class="text-muted">Belum ada armada yang tersedia saat ini.</div>
                    </div>
                <?php endif; ?>
            </div>
            
            <div class="text-center mt-5">
                <a href="<?= session()->get('isLoggedIn') ? base_url('pelanggan/travel') : base_url('login') ?>" class="btn btn-custom btn-outline-custom">Lihat Semua Armada <i class="fas fa-arrow-right ms-2"></i></a>
            </div>
        </div>
    </section>

    <!-- Keunggulan Section -->
    <section id="keunggulan" class="py-5" style="background-color: #f8fafc;">
        <div class="container py-5">
            <div class="text-center mb-5">
                <h2 class="section-title">Mengapa Memilih YCR Rental?</h2>
                <p class="section-subtitle">Pelayanan prioritas dan kualitas armada adalah komitmen kami.</p>
            </div>
            
            <div class="row g-4">
                <div class="col-md-4">
                    <div class="feature-box">
                        <div class="feature-icon"><i class="fas fa-shield-alt"></i></div>
                        <h5 class="fw-bold mb-3">Aman & Terawat</h5>
                        <p class="text-muted mb-0">Seluruh armada kami melewati inspeksi berkala untuk memastikan kenyamanan dan keamanan Anda di jalan.</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="feature-box">
                        <div class="feature-icon"><i class="fas fa-hand-holding-usd"></i></div>
                        <h5 class="fw-bold mb-3">Harga Transparan</h5>
                        <p class="text-muted mb-0">Tidak ada biaya tersembunyi. Anda hanya membayar sesuai dengan yang tertera saat pemesanan.</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="feature-box">
                        <div class="feature-icon"><i class="fas fa-bolt"></i></div>
                        <h5 class="fw-bold mb-3">Booking Cepat</h5>
                        <p class="text-muted mb-0">Proses reservasi online yang mudah dengan berbagai metode pembayaran otomatis via Mayar.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer>
        <div class="container">
            <div class="row gy-4">
                <div class="col-lg-4">
                    <div class="d-flex align-items-center mb-3">
                        <img src="<?= base_url('assets/img/ycr-rental.jpg') ?>" alt="Logo" style="width: 40px; border-radius: 10px; margin-right: 10px;">
                        <h4 class="text-white fw-bold mb-0">YCR Rental</h4>
                    </div>
                    <p class="mb-4 text-white">Sistem informasi manajemen rental mobil berbasis web yang modern, mudah digunakan, dan terintegrasi pembayaran otomatis.</p>
                    <div class="d-flex gap-3">
                        <a href="#" class="fs-5"><i class="fab fa-facebook"></i></a>
                        <a href="#" class="fs-5"><i class="fab fa-instagram"></i></a>
                        <a href="#" class="fs-5"><i class="fab fa-whatsapp"></i></a>
                    </div>
                </div>
                <div class="col-lg-2 offset-lg-2 col-md-4">
                    <h5>Navigasi</h5>
                    <ul class="list-unstyled d-flex flex-column gap-2">
                        <li><a href="#beranda">Beranda</a></li>
                        <li><a href="#armada">Armada</a></li>
                        <li><a href="#keunggulan">Keunggulan</a></li>
                    </ul>
                </div>
                <div class="col-lg-4 col-md-8">
                    <h5>Kontak Kami</h5>
                    <ul class="list-unstyled d-flex flex-column gap-3 text-white">
                        <li><i class="fas fa-map-marker-alt me-3 text-primary"></i> Perumahan Panorama Asri Jl.Cendrawasih A.59, Kuningan, Jawa Barat</li>
                        <li><i class="fas fa-envelope me-3 text-primary"></i> cs@ycr-rental.com</li>
                        <li><i class="fas fa-phone-alt me-3 text-primary"></i> +62 812 3456 7890</li>
                    </ul>
                </div>
            </div>
            <hr class="mt-5 mb-4 border-secondary">
            <div class="text-center text-muted small">
                &copy; <?= date('Y') ?> YCR Rental. Hak Cipta Dilindungi.
            </div>
        </div>
    </footer>

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
