<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?? 'Dashboard' ?> | YCR Rental</title>
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- FontAwesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- DataTables -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/dataTables.bootstrap5.min.css">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        :root { --primary-color: #4f46e5; --sidebar-width: 260px; --bg-light: #f8fafc; }
        body { font-family: 'Plus Jakarta Sans', sans-serif; background-color: var(--bg-light); color: #334155; }
        .wrapper { display: flex; width: 100%; align-items: stretch; }
        
        /* Modern Minimalist Sidebar */
        #sidebar { min-width: var(--sidebar-width); max-width: var(--sidebar-width); background: #ffffff; border-right: 1px solid #e2e8f0; transition: all 0.3s; min-height: 100vh; position: sticky; top: 0; display: flex; flex-direction: column; }
        #sidebar .sidebar-header { padding: 24px 24px 10px; text-align: left; }
        #sidebar .sidebar-header h4 { font-weight: 800; color: var(--primary-color); font-size: 1.4rem; letter-spacing: -0.5px; }
        #sidebar ul.components { padding: 15px; border-bottom: none; }
        #sidebar ul li { margin-bottom: 5px; }
        #sidebar ul li a { padding: 12px 18px; display: flex; align-items: center; color: #64748b; text-decoration: none; transition: 0.2s ease; border-radius: 10px; font-weight: 600; font-size: 0.95rem; }
        #sidebar ul li a i { width: 24px; font-size: 1.1rem; margin-right: 10px; }
        #sidebar ul li a:hover { color: var(--primary-color); background: #f1f5f9; }
        #sidebar ul li.active > a { color: #fff; background: var(--primary-color); box-shadow: 0 4px 12px rgba(79, 70, 229, 0.3); }
        
        /* Content & Navbar */
        #content { width: 100%; padding: 0 0 20px 0; min-height: 100vh; transition: all 0.3s; display: flex; flex-direction: column; }
        .navbar { background: #ffffff; border-bottom: 1px solid #e2e8f0; padding: 15px 30px; box-shadow: 0 2px 10px rgba(0,0,0,0.01); }
        main.container-fluid { padding: 30px 40px !important; }
        
        /* Global UI Elements */
        .card { border: none !important; box-shadow: 0 4px 20px rgba(0,0,0,0.03) !important; border-radius: 16px !important; overflow: hidden; }
        .card-header { background: #fff !important; border-bottom: 1px solid #f1f5f9 !important; padding: 20px 24px !important; }
        .card-header h5 { font-weight: 700; color: #1e293b; font-size: 1.1rem; letter-spacing: -0.3px; }
        .btn { border-radius: 8px; font-weight: 600; padding: 8px 16px; letter-spacing: 0.2px; transition: all 0.2s; }
        .btn-primary { background-color: var(--primary-color); border-color: var(--primary-color); }
        .btn-primary:hover { background-color: #4338ca; border-color: #4338ca; transform: translateY(-1px); box-shadow: 0 4px 12px rgba(79, 70, 229, 0.2); }
        .table > :not(caption) > * > * { padding: 16px 20px; border-bottom-color: #f1f5f9; }
        thead th { font-weight: 600; text-transform: uppercase; font-size: 0.75rem; letter-spacing: 0.5px; color: #64748b; }
        tbody td { vertical-align: middle; color: #475569; font-weight: 500; }
        .badge { padding: 6px 12px; font-weight: 600; border-radius: 6px; }
        h3 { font-weight: 700; color: #0f172a; letter-spacing: -0.5px; }

        /* Responsive Sidebar */
        @media (max-width: 768px) {
            #sidebar { margin-left: calc(-1 * var(--sidebar-width)); position: fixed; z-index: 1050; height: 100vh; }
            #sidebar.active { margin-left: 0; box-shadow: 4px 0 15px rgba(0,0,0,0.1); }
            main.container-fluid { padding: 20px 15px !important; }
        }
    </style>
</head>
<body>

    <div class="wrapper">
        <!-- Sidebar -->
        <?= $this->include('layout/sidebar') ?>

        <div id="content">
            <!-- Navbar -->
            <?= $this->include('layout/navbar') ?>

            <main class="container-fluid mt-4 flex-grow-1">
                <?= $this->renderSection('content') ?>
            </main>

            <!-- Footer -->
            <?= $this->include('layout/footer') ?>
        </div>
    </div>

    <!-- Scripts -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.4/js/dataTables.bootstrap5.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <script>
        $(document).ready(function() {
            $('.datatable').DataTable();
            
            $('#sidebarCollapse').on('click', function() {
                $('#sidebar').toggleClass('active');
            });

            // Logout Confirmation
            $('.btn-logout').on('click', function(e) {
                e.preventDefault();
                const href = $(this).attr('href');
                
                Swal.fire({
                    title: 'Konfirmasi Logout',
                    text: "Apakah Anda yakin ingin keluar dari sistem?",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#4f46e5',
                    cancelButtonColor: '#ef4444',
                    confirmButtonText: 'Ya, Logout!',
                    cancelButtonText: 'Batal',
                    reverseButtons: true
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.location.href = href;
                    }
                });
            });
        });
    </script>
</body>
</html>
