<?php
// sertakan pustaka program koneksi
require 'dbkoneksi.php';

// ambil data dari form
if (isset($_POST["submit"])) {

    // tangkap data dari form
    $kode = $_POST['kode'];
    $nama   = $_POST['nama'];
    $tmp_lahir   = $_POST['tgl_lahir'];
    $tgl_lahir   = $_POST['tgl_lahir'];
    $gender = $_POST['gender'];
    $email = $_POST['email'];
    $alamat = $_POST['alamat'];
    $keluraha_id = $_POST['kelurahan_id'];



    // proses insert ke database 
    try {
        $sql = "INSERT INTO pasien (nama, kode,tmp_lahir, tgl_lahir, gender, email, alamat, kelurahan_id) VALUES (?,?,?,?,?,?,?,?)";
        $stmt = $db->prepare($sql);
        $stmt->execute([$nama, $kode, $tmp_lahir, $tgl_lahir, $gender, $email, $alamat, $keluraha_id]);


        header("Location: list-pasien.php");
    } catch (\Throwable $e) {
        echo "Error while insert data pasien<br>";
        echo $e;
    }
}
