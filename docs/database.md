-- 1. Tabel User (Ganti panjang password menjadi 255 untuk Hashing)
CREATE TABLE user (
    id_user INT(11) AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL,
    password VARCHAR(255) NOT NULL, -- Diperlebar untuk keamanan CI4
    role ENUM('owner', 'admin', 'pelanggan') NOT NULL
);

-- 2. Tabel Pelanggan (Breakdown dari data_pelanggan agar CRM berjalan maksimal)
CREATE TABLE pelanggan (
    id_pelanggan INT(11) AUTO_INCREMENT PRIMARY KEY,
    id_user INT(11),
    nama_pelanggan VARCHAR(100),
    no_telp VARCHAR(20), -- Penting untuk CRM WhatsApp/Follow-up
    alamat TEXT,
    FOREIGN KEY (id_user) REFERENCES user(id_user) ON DELETE CASCADE
);

-- 3. Tabel Owner & Admin (Pisahkan jika data profilnya berbeda)
CREATE TABLE owner (
    id_owner INT(11) AUTO_INCREMENT PRIMARY KEY,
    id_user INT(11),
    nama_owner VARCHAR(100),
    FOREIGN KEY (id_user) REFERENCES user(id_user)
);

CREATE TABLE admin (
    id_admin INT(11) AUTO_INCREMENT PRIMARY KEY,
    id_user INT(11),
    nama_admin VARCHAR(100),
    FOREIGN KEY (id_user) REFERENCES user(id_user)
);

-- 4. Tabel Travel / Armada Mobil
CREATE TABLE travel (
    id_travel INT(11) AUTO_INCREMENT PRIMARY KEY,
    nama_mobil VARCHAR(50) NOT NULL,
    plat_nomor VARCHAR(20),
    harga_sewa INT(11) NOT NULL, -- Ubah ke INT agar bisa dihitung otomatis secara matematis
    status_mobil ENUM('Tersedia', 'Disewa', 'Servis') DEFAULT 'Tersedia',
    foto TEXT
);

-- 5. Tabel Pemesanan (Menambahkan kontrol waktu sewa armada)
CREATE TABLE pemesanan (
    id_reservasi INT(11) AUTO_INCREMENT PRIMARY KEY,
    id_pelanggan INT(11),
    id_travel INT(11), -- Foreign Key konsisten ke tabel travel
    tgl_mulai DATE NOT NULL, -- Kapan mobil disewa
    tgl_selesai DATE NOT NULL, -- Kapan mobil dikembalikan
    total_bayar INT(11), -- INT agar mudah di-SUM di Dashboard Owner
    tgl_bayar DATE NULL,
    status_reservasi VARCHAR(50), -- Contoh: 'Pending', 'Dikonfirmasi', 'Selesai'
    FOREIGN KEY (id_pelanggan) REFERENCES pelanggan(id_pelanggan),
    FOREIGN KEY (id_travel) REFERENCES travel(id_travel)
);

-- 6. Tabel Invoice
CREATE TABLE invoice (
    id_invoice INT(11) AUTO_INCREMENT PRIMARY KEY,
    id_reservasi INT(11),
    no_invoice VARCHAR(50),
    rincian_tambahan TEXT,
    FOREIGN KEY (id_reservasi) REFERENCES pemesanan(id_reservasi)
);