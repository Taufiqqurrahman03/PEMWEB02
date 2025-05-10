<?php
// sertakan pustaka program koneksi
require 'dbkoneksi.php';

// ambil data dari form
if (isset($_POST["submit"])) {

    // tangkap data dari form dengan aman
    $id = $_POST['id'] ?? null;
    $tanggal = $_POST['tanggal'] ?? date('Y-m-d');
    $pasien_id = $_POST['pasien_id'] ?? null;
    $dokter_id = $_POST['dokter_id'] ?? null;
    $keluhan = $_POST['keluhan'] ?? '';
    $tensi = $_POST['tensi'] ?? '';
    $berat = $_POST['berat'] ?? 0;
    $tinggi = $_POST['tinggi'] ?? 0;
    
    // Validasi data
    $errors = [];
    
    if (empty($pasien_id)) {
        $errors[] = "Pasien harus dipilih";
    }
    
    if (empty($dokter_id)) {
        $errors[] = "Dokter harus dipilih";
    }
    
    if (empty($keluhan)) {
        $errors[] = "Keluhan tidak boleh kosong";
    }
    
    if (empty($tensi)) {
        $errors[] = "Tensi tidak boleh kosong";
    }
    
    if (empty($berat) || $berat <= 0) {
        $errors[] = "Berat harus lebih dari 0";
    }
    
    if (empty($tinggi) || $tinggi <= 0) {
        $errors[] = "Tinggi harus lebih dari 0";
    }
    
    // Jika ada error, tampilkan pesan error
    if (!empty($errors)) {
        echo "<div style='padding: 20px; background-color: #f8d7da; color: #721c24; margin-bottom: 20px;'>";
        echo "<h4>Terjadi kesalahan:</h4>";
        echo "<ul>";
        foreach ($errors as $error) {
            echo "<li>" . htmlspecialchars($error) . "</li>";
        }
        echo "</ul>";
        echo "<p><a href='javascript:history.back()'>Kembali</a></p>";
        echo "</div>";
        exit;
    }
    
    switch ($_POST['submit']) {
        case 'simpan':
            // proses insert ke database 
            try {
                $sql = "INSERT INTO periksa (tanggal, pasien_id, dokter_id, keluhan, tensi, berat, tinggi) 
                        VALUES (?, ?, ?, ?, ?, ?, ?)";
                $stmt = $db->prepare($sql);
                $stmt->execute([$tanggal, $pasien_id, $dokter_id, $keluhan, $tensi, $berat, $tinggi]);

                header("Location: list-periksa.php");
                exit;
            } catch (\Throwable $e) {
                echo "<div style='padding: 20px; background-color: #f8d7da; color: #721c24; margin-bottom: 20px;'>";
                echo "<h4>Error while insert data pemeriksaan:</h4>";
                echo "<p>" . $e->getMessage() . "</p>";
                echo "<p><a href='javascript:history.back()'>Kembali</a></p>";
                echo "</div>";
                exit;
            }
            break;

        case 'ubah':
            // proses update ke database
            try {
                $sql = "UPDATE periksa 
                        SET tanggal = ?, pasien_id = ?, dokter_id = ?, 
                            keluhan = ?, tensi = ?, berat = ?, tinggi = ? 
                        WHERE id = ?";
                $stmt = $db->prepare($sql);
                $stmt->execute([$tanggal, $pasien_id, $dokter_id, $keluhan, $tensi, $berat, $tinggi, $id]);

                header("Location: list-periksa.php");
                exit;
            } catch (\Throwable $e) {
                echo "<div style='padding: 20px; background-color: #f8d7da; color: #721c24; margin-bottom: 20px;'>";
                echo "<h4>Error while update data pemeriksaan:</h4>";
                echo "<p>" . $e->getMessage() . "</p>";
                echo "<p><a href='javascript:history.back()'>Kembali</a></p>";
                echo "</div>";
                exit;
            }
            break;

        case 'Hapus':
            // proses hapus
            try {
                $sql = "DELETE FROM periksa WHERE id = ?";
                $stmt = $db->prepare($sql);
                $stmt->execute([$id]);
        
                header("Location: list-periksa.php");
                exit;
            } catch (\Throwable $e) {
                echo "<div style='padding: 20px; background-color: #f8d7da; color: #721c24; margin-bottom: 20px;'>";
                echo "<h4>Error while delete data pemeriksaan:</h4>";
                echo "<p>" . $e->getMessage() . "</p>";
                echo "<p><a href='javascript:history.back()'>Kembali</a></p>";
                echo "</div>";
                exit;
            }
            break;
            
        default:
            header("Location: list-periksa.php");
            exit;
    }
} else {
    // Jika tidak ada data yang dikirim, redirect ke halaman list
    header("Location: list-periksa.php");
    exit;
}