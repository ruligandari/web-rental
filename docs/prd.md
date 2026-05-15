# PRODUCT REQUIREMENT DOCUMENT (PRD)

# Sistem Informasi Customer Relationship Management (CRM) Travel Berbasis Web

## KONTEKS PROYEK

Saya ingin membuat aplikasi Sistem Informasi Customer Relationship Management (CRM) Travel berbasis web menggunakan:

- Framework: CodeIgniter 4
- AI Code Editor: Antigravity
- Frontend: Bootstrap 5
- Database: MySQL
- Arsitektur: MVC bawaan CI4
- Bahasa: Indonesia

Aplikasi digunakan untuk membantu proses reservasi travel, pengelolaan pelanggan, transaksi, dan laporan.

---

# ATURAN WAJIB PROYEK

WAJIB:

- Gunakan CodeIgniter 4
- Gunakan Bootstrap 5
- Gunakan MVC bawaan CI4
- Gunakan Bahasa Indonesia
- Gunakan migration database
- Gunakan model terpisah setiap tabel
- Gunakan validation bawaan CI4
- Gunakan session authentication
- Gunakan pagination
- Gunakan upload gambar travel
- Gunakan SweetAlert untuk notifikasi
- Gunakan DataTables pada tabel

DILARANG:

- Mengubah nama tabel
- Mengubah struktur database
- Menambah field database tanpa instruksi
- Mengubah relasi tabel
- Menggunakan framework frontend selain Bootstrap 5

---

# LATAR BELAKANG

Permasalahan sistem saat ini:

1. Proses reservasi masih manual dan tidak efisien
2. Belum diterapkan CRM
3. Pelaporan transaksi masih manual

Tujuan sistem:

- Mempermudah reservasi online
- Mengelola pelanggan
- Mengelola transaksi
- Menampilkan laporan
- Meningkatkan hubungan pelanggan melalui CRM

---

# AKTOR SISTEM

## Pelanggan

Hak akses:

- Registrasi
- Login
- Melihat data travel
- Reservasi
- Melihat status reservasi
- Melihat invoice

---

## Admin

Hak akses:

- Kelola pelanggan
- Kelola travel
- Kelola invoice
- Kelola transaksi
- Kelola reservasi

---

## Owner

Hak akses:

- Dashboard
- Melihat laporan
- Monitoring statistik

---

# FITUR UTAMA

1. Registrasi
2. Login
3. Dashboard
4. Kelola pelanggan
5. Kelola travel
6. Reservasi online
7. Invoice
8. Laporan
9. CRM operasional

---

# ALUR SISTEM

PELANGGAN:

Registrasi

↓

Login

↓

Lihat Travel

↓

Pilih Travel

↓

Reservasi

↓

Pembayaran

↓

Invoice

---

ADMIN:

Login

↓

Kelola Pelanggan

↓

Kelola Travel

↓

Kelola Reservasi

↓

Kelola Invoice

↓

Laporan

---

OWNER:

Login

↓

Dashboard

↓

Monitoring

↓

Export laporan

---

# DATABASE

IKUTI STRUKTUR DATABASE INI PERSIS.

JANGAN UBAH NAMA TABEL ATAU FIELD.

## TABEL USER

Nama tabel: user

Field:

id_user int(11) PRIMARY KEY

username varchar(20)

password varchar(20)

---

## TABEL OWNER

Nama tabel: owner

Field:

id_owner int(11) PRIMARY KEY

id_user int(11) FOREIGN KEY

data_owner varchar(50)

---

## TABEL ADMIN

Nama tabel: admin

Field:

id_admin int(11) PRIMARY KEY

id_user int(11) FOREIGN KEY

data_admin varchar(50)

---

## TABEL PELANGGAN

Nama tabel: pelanggan

Field:

id_pelanggan int(11) PRIMARY KEY

id_user int(11) FOREIGN KEY

data_pelanggan varchar(50)

---

## TABEL TRAVEL

Nama tabel: travel

Field:

id_travel int(11) PRIMARY KEY

id_mobil int(11) FOREIGN KEY

data_mobil varchar(50)

harga_sewa_mobil varchar(50)

foto text

---

## TABEL PEMESANAN

Nama tabel: pemesanan

Field:

id_reservasi int(11) PRIMARY KEY

id_pelanggan int(11)

total_bayar int

id_mobil int

tgl_bayar date

status_pembayaran varchar

---

## TABEL INVOICE

Nama tabel: invoice

Field:

id_invoice int(11)

id_reservasi int(11)

id_pelanggan int(11)

rincian_reservasi text

---

# STRUKTUR FOLDER CI4

app/

├── Controllers/

│ ├── Auth/

│ ├── Admin/

│ ├── Owner/

│ └── Pelanggan/

│

├── Models/

│ ├── UserModel.php

│ ├── OwnerModel.php

│ ├── AdminModel.php

│ ├── PelangganModel.php

│ ├── TravelModel.php

│ ├── PemesananModel.php

│ └── InvoiceModel.php

│

├── Views/

│ ├── auth/

│ ├── admin/

│ ├── owner/

│ └── pelanggan/

---

# ROUTING

/login

/register

/dashboard

/travel

/pemesanan

/invoice

/laporan

---

# UI BOOTSTRAP 5

## Halaman Registrasi

Komponen:

- Nama Lengkap
- Email
- Username
- Password
- Tombol Daftar

Card bootstrap di tengah halaman.

---

## Halaman Login

Komponen:

- Username
- Password
- Tombol Login

Card bootstrap di tengah halaman.

---

## Dashboard Owner

Sidebar:

- Dashboard
- User
- Laporan Pemesanan
- Laporan Penjualan
- Logout

Konten:

Card:

- Total Penjualan
- Total Pendapatan

Ringkasan penjualan menggunakan ChartJS

---

## Halaman Travel

Komponen:

- Search
- Tombol tambah unit
- Tabel bootstrap

Kolom:

- Unit
- Harga
- Status
- Foto
- Aksi Edit

---

# OUTPUT YANG HARUS DIBUAT BERTAHAP

Tahap 1:

- Migration

Tahap 2:

- Model

Tahap 3:

- Route

Tahap 4:

- Authentication

Tahap 5:

- CRUD Travel

Tahap 6:

- Reservasi

Tahap 7:

- Invoice

Tahap 8:

- Dashboard

Tahap 9:

- Laporan

Jangan mengerjakan semua sekaligus.
Kerjakan per tahap dan tunggu instruksi berikutnya.