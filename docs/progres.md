# Laporan Progres: Modernisasi UI/UX & Peningkatan Fitur
**Proyek:** YCR Rental
**Tanggal:** 15 Mei 2026

Berikut adalah seluruh daftar perombakan antarmuka (UI/UX) dan fitur yang diselesaikan pada sesi ini:

### 1. Re-desain UI/UX ke Modern Minimalist (SaaS Premium Style)
- **Tipografi:** Mengganti font bawaan sistem/Bootstrap dengan **Plus Jakarta Sans** untuk memberikan kesan modern, bersih, dan mewah.
- **Global CSS (`layout/main.php`):** 
  - Mengubah desain sidebar dari dark-theme (kaku) menjadi *light-theme* putih bersih dengan border lembut.
  - Memperbarui gaya *card* secara global (tanpa border kasar, radius membulat 16px, dan bayangan *box-shadow* melayang yang lembut).
- **Dashboard Admin & Owner:**
  - Menghilangkan *stat-card* dengan warna solid (biru, hijau, kuning) bergaya jadul.
  - Mengubah *stat-card* menjadi warna putih bersih, di mana warna penanda kini diaplikasikan sebagai *background* lingkaran ikon dengan *opacity* yang lembut (contoh: teks hijau dan ikon hijau dengan *background* hijau transparan).

### 2. Peningkatan Fungsionalitas Sidebar
- **Deteksi Menu Aktif Dinamis:** Memperbarui logika `class="active"` di `layout/sidebar.php` menggunakan fungsi bawaan `uri_string()`. Indikator sidebar (berwarna Indigo/Ungu) kini secara presisi mendeteksi halaman mana yang sedang diakses.
- **Responsivitas (Mobile-Friendly):** 
  - Sidebar akan secara otomatis disembunyikan (*hide*) jika dibuka di layar *smartphone*.
  - Mengaktifkan fungsi tombol "Hamburger" di navigasi atas (`layout/navbar.php`) lengkap dengan *event listener* Javascript.
- **Informasi Bisnis:**
  - Mengganti teks statis dengan logo resmi YCR Rental di bagian paling atas (*Header*).
  - Menambahkan *widget* alamat resmi lengkap perusahaan (Perumahan Panorama Asri, Kuningan) di bagian dasar (*Footer*) Sidebar.

### 3. Halaman Autentikasi (Login & Registrasi)
- Mengubah desain dasar kotak login di `layout/auth.php` dengan latar belakang gradien pastel yang estetik.
- Mengganti ikon standar FontAwesome (User/Car) dengan logo resmi YCR Rental berformat gambar kotak dengan sudut membulat.
- Input data kini memiliki *padding* lebih lega, batas (*border*) membulat, dan efek transisi elegan saat field diklik.

### 4. Optimalisasi DataTables & CodeIgniter Pagination
- **Perbaikan "Double Pagination":** Menghapus kode *renderer* halaman bawaan CodeIgniter (`$pager->links()`) dari file-file *index* karena *plugin* DataTables telah menangani pagination, pencarian, dan pengurutan secara otomatis.
  - File yang di-refactor: `admin/travel/index.php`, `admin/reservasi/index.php`, dan `admin/pelanggan/index.php`.

### 5. Halaman Pencarian Armada Pelanggan
- Mengubah *label* tombol/menu dari "Cari Travel" menjadi "**Cari Armada**".
- Menyisipkan antarmuka *Search-Bar* modern di halaman Pemilihan Armada (`pelanggan/travel.php`).
- Menerapkan fungsionalitas Backend di *Controller* `Pelanggan\Reservasi.php` yang dapat membaca parameter `$_GET['search']` dan memfilter data *database* berdasarkan kolom `nama_mobil`.

### 6. Peningkatan Keamanan & UX (Konfirmasi Logout)
- Mencegah pengguna tidak sengaja keluar (*logout*) dengan menanamkan validasi konfirmasi dua lapis.
- Menyuntikkan SweetAlert Javascript ke semua tombol *logout* (`btn-logout`) untuk memunculkan peringatan estetik sebelum sesi dihentikan secara sepihak.

### 7. Integrasi Invoice
- Mengubah alamat *dummy* Jakarta menjadi alamat bisnis aktual YCR Rental (Kuningan, Jawa Barat) di *template* kwitansi cetak (`invoice/view.php`).

### 8. Fitur "Lanjut Pembayaran" (Resume Payment)
- **Database:** Membuat *migration* untuk menambahkan kolom `payment_link` pada tabel `pemesanan`.
- **Backend:** Memperbarui `Pelanggan\Reservasi.php` untuk menyimpan tautan (*link*) pembayaran Mayar secara persisten ke dalam *database* sesaat setelah tautan di-_generate_.
- **Frontend:** Mengubah UI halaman **Riwayat Pesanan** (`pelanggan/riwayat.php`) untuk memunculkan tombol peringatan kuning "**Lanjut Bayar**" khusus bagi reservasi berstatus *Pending* yang memiliki *payment link*.

### 9. Transparansi Status Ketersediaan Armada
- **Backend:** Menghapus *filter* statis (`status_mobil = 'Tersedia'`) pada *Controller* `Pelanggan\Reservasi.php` agar pelanggan bisa melihat semua armada.
- **Frontend (`pelanggan/travel.php`):** 
  - Menampilkan *badge* dinamis: Hijau (Tersedia), Kuning (Disewa), dan Merah (Servis).
  - Mengubah tombol "Pesan Sekarang" menjadi warna abu-abu (dinonaktifkan / *disabled*) bertuliskan "**Tidak Tersedia**" untuk armada yang sedang disewa atau diservis.

### 10. Pencatatan Metode & Tanggal Pembayaran
- **Database:** Membuat *migration* baru untuk menambahkan kolom `metode_pembayaran` (VARCHAR) ke tabel `pemesanan`.
- **Webhook Mayar (`Webhook.php`):** Mengonfigurasi sistem agar dapat menangkap data `channel` atau `paymentMethod` dari *payload* Mayar API saat transaksi sukses.
- **UI Admin (`admin/reservasi/index.php`):** Merombak kolom "Total Bayar" menjadi "**Info Pembayaran**" yang mengelompokkan Nominal Bayar, Metode Bayar, dan Tanggal Bayar.
- **Kwitansi / Invoice (`invoice/view.php`):** Memasukkan informasi metode pembayaran ke dalam rincian status Invoice.

### 11. Perbaikan Bug Server (Session File Lock)
- **Backend:** Menyelesaikan masalah halaman web yang terkadang *loading* tanpa henti (ERR_CONNECTION_ABORTED) pada PHP Development Server dengan menambahkan `session_write_close()` di dalam `Home.php`. Ini mencegah penguncian file sesi saat memuat aset ganda secara bersamaan.

### 12. Penyempurnaan Landing Page (`landing.php`)
- **Tampilan:** Mengubah teks deskripsi dan kontak pada bagian *Footer* menjadi warna putih (`text-white`) agar terbaca jelas dengan *background* gelap. Memperbaiki ikon versi *Pro* menjadi versi *Free* (`fa-shield-alt`).
- **Data Dinamis:** Mengubah pengaturan katalog armada di *Landing Page* agar dapat menampilkan maksimal 6 mobil tanpa dibatasi oleh status "Tersedia".
- **UX Booking:** Menerapkan pengecekan dinamis. Armada yang sedang berstatus di-sewa/servis akan memiliki tombol "Sewa" yang berubah warna abu-abu kemerahan, bertuliskan "**Tidak Tersedia**", dan dimatikan (*disabled*).

### 13. Resolusi Logika Reservasi & Tanggal Overlap
- **Backend (Status Induk):** Menghentikan praktik perubahan otomatis pada kolom `status_mobil` di tabel `travel` menjadi "Disewa" setelah pesanan masuk. Hal ini memastikan mobil tetap ada di katalog agar pelanggan lain bisa mem-*booking* untuk **tanggal yang berbeda**. (Perubahan pada `Webhook.php` dan `Admin/Reservasi.php`).
- **Backend (Validasi Bentrok):** Menambahkan *query* validasi "overlap" di `Pelanggan/Reservasi::store()`. Jika pelanggan memesan jadwal yang bersinggungan (*overlap*) dengan pesanan orang lain yang belum *Selesai*, sistem akan menolaknya.

### 14. Integrasi Kalender Visual (Flatpickr)
- Mengubah *form* tanggal yang kaku di `reservasi_form.php` menjadi interaktif dengan *plugin* **Flatpickr**.
- Menambahkan **Card Ketersediaan Bulan Ini** berupa kalender interaktif langsung (*inline calendar*) di bagian panel informasi mobil.
- Secara cerdas, kalender akan langsung **mencoret warna abu-abu (disable)** seluruh rentang tanggal di mana armada tersebut sudah ter-*booking* berdasarkan *database*, memberikan transparansi *availability* secara total kepada pelanggan.
- Menambahkan proteksi *Javascript* untuk mencegah *bypass* pada rentang tanggal yang dipesan.

---
**Status Saat Ini:** Seluruh fitur pembayaran (termasuk *resume payment*), manajemen tanggal, visualisasi kalender ketersediaan, dan modernisasi UI/UX telah **100% tuntas**. Sistem dipastikan tangguh dan siap *Production-Ready*.
