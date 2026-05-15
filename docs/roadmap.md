# DEVELOPMENT ROADMAP
# Sistem Informasi YCR Rental CI4

Framework: CodeIgniter 4
Frontend: Bootstrap 5
AI Editor: Antigravity
Database: MySQL

Aturan:

- Ikuti PRD
- Jangan ubah struktur database
- Gunakan Bootstrap 5
- Gunakan MVC CI4
- Kerjakan per tahap
- Jangan lompat tahap

==================================================

STEP 1 — INISIALISASI PROJECT

Tujuan:

Membuat pondasi project.

Yang dibuat:

- Install CI4
- Konfigurasi .env
- Koneksi database
- Konfigurasi baseURL
- Konfigurasi autoload
- Konfigurasi session
- Konfigurasi timezone
- Install Bootstrap 5
- Install SweetAlert
- Install DataTables
- Install ChartJS

Output:

Project berjalan normal.

Checklist:

[x] Halaman welcome tampil
[x] Database terkoneksi
[x] Bootstrap aktif

==================================================

STEP 2 — BUAT STRUKTUR FOLDER

Yang dibuat:

Controllers:

- Auth
- Admin
- Owner
- Pelanggan

Models:

- UserModel
- OwnerModel
- AdminModel
- PelangganModel
- TravelModel
- PemesananModel
- InvoiceModel

Views:

- auth
- admin
- owner
- pelanggan

Template:

- layout
- navbar
- sidebar
- footer

Output:

Struktur project rapi

Checklist:

[x] Folder selesai
[x] Template layout selesai

==================================================

STEP 3 — BUAT DATABASE MIGRATION

WAJIB ikuti Bab 3.

Buat migration:

1. user
2. owner
3. admin
4. pelanggan
5. travel
6. pemesanan
7. invoice

Output:

Semua tabel berhasil dibuat.

Checklist:

[x] migration:user
[x] migration:owner
[x] migration:admin
[x] migration:pelanggan
[x] migration:travel
[x] migration:pemesanan
[x] migration:invoice

==================================================

STEP 4 — BUAT MODEL

Buat model:

- UserModel
- OwnerModel
- AdminModel
- PelangganModel
- TravelModel
- PemesananModel
- InvoiceModel

Set:

protected table

primary key

allowed fields

timestamps

Output:

Semua model siap dipakai

Checklist:

[x] semua model selesai

==================================================

STEP 5 — AUTHENTICATION

Buat:

Registrasi

Login

Logout

Session

Middleware

Validasi

Role:

- pelanggan
- admin
- owner

Output:

User dapat login

Checklist:

[x] registrasi
[x] login
[x] logout
[x] session

==================================================

STEP 6 — UI TEMPLATE

Buat template bootstrap:

Navbar

Sidebar

Footer

Master Layout

Dashboard Layout

Output:

Semua halaman memakai layout sama

Checklist:

[x] navbar
[x] sidebar
[x] footer

==================================================

STEP 7 — HALAMAN REGISTRASI

Komponen:

Nama lengkap

Email

Username

Password

Button daftar

Validasi:

Semua field wajib

Output:

Registrasi berfungsi

Checklist:

[x] tambah akun berhasil

==================================================

STEP 8 — HALAMAN LOGIN

Komponen:

Username

Password

Button login

Output:

Login berhasil

Checklist:

[x] login sukses

==================================================

STEP 9 — DASHBOARD OWNER

Card:

Total penjualan

Total pendapatan

Ringkasan penjualan

ChartJS

Output:

Dashboard tampil

Checklist:

[x] card tampil
[x] grafik tampil

==================================================

STEP 10 — CRUD TRAVEL

Fitur:

Tambah travel

Edit

Hapus

Upload foto

Cari data

Pagination

Tabel:

Unit

Harga

Status

Foto

Aksi

Checklist:

[x] tambah
[x] edit
[x] hapus
[x] upload

==================================================

STEP 11 — CRUD PELANGGAN

Fitur:

Lihat pelanggan

Tambah

Edit

Hapus

Cari

Checklist:

[x] CRUD selesai

==================================================

STEP 12 — RESERVASI

Pelanggan:

Lihat travel

Pilih travel

Pesan travel

Status reservasi:

Pending

Diproses

Selesai

Checklist:

[x] reservasi berhasil

==================================================

STEP 13 — INVOICE

Fitur:

Generate invoice

Lihat invoice

Cetak invoice

Download PDF

Checklist:

[x] invoice tampil

==================================================

STEP 14 — LAPORAN

Laporan:

Pemesanan

Penjualan

Pendapatan

Filter:

Tanggal

Bulan

Tahun

Export:

PDF

Excel

Checklist:

[x] laporan selesai

==================================================

STEP 15 — CRM

Fitur:

Histori pelanggan

Pelanggan aktif

Riwayat transaksi

Dashboard CRM

Checklist:

[x] CRM selesai

==================================================

STEP 16 — TESTING

Pengujian:

Login

CRUD

Upload

Reservasi

Invoice

Laporan

Checklist:

[x] semua lolos

==================================================

STEP 17 — FINISHING

Perbaikan:

UI

Responsif

Bug fixing

Validasi

Optimasi query

Checklist:

[x] siap demo
[x] siap sidang

==================================================

STEP 18 — INTEGRASI PAYMENT GATEWAY MAYAR

Fitur:

- Konfigurasi API Key di .env
- Implementasi API Create Payment Link (cURL/HTTP Client)
- Simpan ID Transaksi Mayar di tabel pemesanan
- Redirect pelanggan ke halaman pembayaran Mayar
- Update status otomatis jika memungkinkan (opsional Webhook)

Checklist:

[x] API Key Terhubung
[x] Link Pembayaran Berhasil Dibuat
[x] Redirect Berfungsi
