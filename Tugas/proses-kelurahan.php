<?php
// sertakan pustaka program koneksi
require 'dbkoneksi.php';

// ambil data dari form
if (isset($_POST["submit"])) {

    // tangkap data dari form dengan aman
    $id     = $_POST['id'] ?? null;
    $kec_id = $_POST['kec_id'] ?? null;
    $nama   = $_POST['nama'] ?? null;

    switch ($_POST['submit']) {
        case 'Simpan':
            // proses insert ke database 
            try {
                $sql = "INSERT INTO kelurahan (nama, kec_id) VALUES (?, ?)";
                $stmt = $db->prepare($sql);
                $stmt->execute([$nama, $kec_id]);

                header("Location: list-kelurahan.php");
            } catch (\Throwable $e) {
                echo "Error while insert data kelurahan<br>";
                echo $e;
            }
            break;

        case 'Ubah':
            // proses update ke database
            try {
                $sql = "UPDATE kelurahan SET nama = ?, kec_id = ? WHERE id = ?";
                $stmt = $db->prepare($sql);
                $stmt->execute([$nama, $kec_id, $id]);

                header("Location: list-kelurahan.php");
            } catch (\Throwable $e) {
                echo "Error while update data kelurahan<br>";
                echo $e;
            }
            break;

        default:
            // proses hapus
            try {
                $sql = "DELETE FROM kelurahan WHERE id = ?";
                $stmt = $db->prepare($sql);
                $stmt->execute([$id]);

                header("Location: list-kelurahan.php");
            } catch (\Throwable $e) {
                echo "Error while delete data kelurahan<br>";
                echo $e;
            }
            break;
    }
}
 