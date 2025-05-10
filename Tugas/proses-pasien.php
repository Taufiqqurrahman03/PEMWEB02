<?php
// sertakan pustaka program koneksi
require 'dbkoneksi.php';

// ambil data dari form
if (isset($_POST["submit"])) {

    // tangkap data dari form dengan aman
    $id = $_POST['id'] ?? null;
    $kode = $_POST['kode'] ?? '';
    $nama = $_POST['nama'] ?? '';
    $tmp_lahir = $_POST['tmp_lahir'] ?? '';
    $tgl_lahir = $_POST['tgl_lahir'] ?? '';
    $gender = $_POST['gender'] ?? '';
    $email = $_POST['email'] ?? '';
    $alamat = $_POST['alamat'] ?? '';
    $kelurahan_id = $_POST['kelurahan_id'] ?? '';
    
    switch ($_POST['submit']) {
        case 'simpan':
            // proses insert ke database 
            try {
                $sql = "INSERT INTO pasien (kode, nama, tmp_lahir, tgl_lahir, gender, email, alamat, kelurahan_id) 
                        VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
                $stmt = $db->prepare($sql);
                $stmt->execute([$kode, $nama, $tmp_lahir, $tgl_lahir, $gender, $email, $alamat, $kelurahan_id]);

                header("Location: list-pasien.php");
                exit;
            } catch (\Throwable $e) {
                echo "Error while insert data pasien<br>";
                echo $e->getMessage();
            }
            break;

        case 'ubah':
            // proses update ke database
            try {
                $sql = "UPDATE pasien 
                        SET kode = ?, nama = ?, tmp_lahir = ?, tgl_lahir = ?, 
                            gender = ?, email = ?, alamat = ?, kelurahan_id = ? 
                        WHERE id = ?";
                $stmt = $db->prepare($sql);
                $stmt->execute([$kode, $nama, $tmp_lahir, $tgl_lahir, $gender, $email, $alamat, $kelurahan_id, $id]);

                header("Location: list-pasien.php");
                exit;
            } catch (\Throwable $e) {
                echo "Error while update data pasien<br>";
                echo $e->getMessage();
            }
            break;

        case 'Hapus':
            // proses hapus
            try {
                $sql = "DELETE FROM pasien WHERE id = ?";
                $stmt = $db->prepare($sql);
                $stmt->execute([$id]);
        
                header("Location: list-pasien.php");
                exit;
            } catch (\Throwable $e) {
                echo "Error while delete data pasien<br>";
                echo $e->getMessage();
            }
            break;
    }
}