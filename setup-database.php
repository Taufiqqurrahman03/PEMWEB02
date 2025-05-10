<?php
require_once './dbkoneksi.php';

// Fungsi untuk memeriksa apakah tabel sudah ada
function tableExists($db, $table) {
    $stmt = $db->query("SHOW TABLES LIKE '$table'");
    return $stmt->rowCount() > 0;
}

// Buat tabel dokter jika belum ada
if (!tableExists($db, 'dokter')) {
    try {
        $db->exec("
            CREATE TABLE dokter (
                id INT AUTO_INCREMENT PRIMARY KEY,
                kode VARCHAR(10) NOT NULL,
                nama VARCHAR(50) NOT NULL,
                spesialis VARCHAR(50),
                alamat TEXT,
                no_telp VARCHAR(15),
                created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
                updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
            )
        ");
        echo "Tabel dokter berhasil dibuat.<br>";
    } catch (PDOException $e) {
        echo "Error membuat tabel dokter: " . $e->getMessage() . "<br>";
    }
}

// Buat tabel pasien jika belum ada
if (!tableExists($db, 'pasien')) {
    try {
        $db->exec("
            CREATE TABLE pasien (
                id INT AUTO_INCREMENT PRIMARY KEY,
                kode VARCHAR(10) NOT NULL,
                nama VARCHAR(50) NOT NULL,
                alamat TEXT,
                tanggal_lahir DATE,
                jenis_kelamin ENUM('L', 'P'),
                created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
                updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
            )
        ");
        echo "Tabel pasien berhasil dibuat.<br>";
    } catch (PDOException $e) {
        echo "Error membuat tabel pasien: " . $e->getMessage() . "<br>";
    }
}

// Buat tabel periksa jika belum ada
if (!tableExists($db, 'periksa')) {
    try {
        $db->exec("
            CREATE TABLE periksa (
                id INT AUTO_INCREMENT PRIMARY KEY,
                tanggal DATE NOT NULL,
                pasien_id INT NOT NULL,
                dokter_id INT NOT NULL,
                keluhan TEXT NOT NULL,
                tensi VARCHAR(10) NOT NULL,
                berat DECIMAL(5,2) NOT NULL,
                tinggi DECIMAL(5,2) NOT NULL,
                created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
                updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
                FOREIGN KEY (pasien_id) REFERENCES pasien(id),
                FOREIGN KEY (dokter_id) REFERENCES dokter(id)
            )
        ");
        echo "Tabel periksa berhasil dibuat.<br>";
    } catch (PDOException $e) {
        echo "Error membuat tabel periksa: " . $e->getMessage() . "<br>";
    }
}

echo "<p>Setup database selesai. <a href='index.php'>Kembali ke halaman utama</a></p>";
?>