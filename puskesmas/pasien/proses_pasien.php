<?php
require_once '../dbkoneksi.php';

if ($_POST['proses'] == 'simpan') {
    if ($_POST['id']) {
        $sql = "UPDATE pasien SET kode=?, nama=?, tmp_lahir=?, tgl_lahir=?, gender=?, email=?, alamat=?, kelurahan_id=? WHERE id=?";
        $stmt = $dbh->prepare($sql);
        $stmt->execute([
            $_POST['kode'], $_POST['nama'], $_POST['tmp_lahir'], $_POST['tgl_lahir'],
            $_POST['gender'], $_POST['email'], $_POST['alamat'], $_POST['kelurahan_id'], $_POST['id']
        ]);
    } else {
        $sql = "INSERT INTO pasien (kode, nama, tmp_lahir, tgl_lahir, gender, email, alamat, kelurahan_id) VALUES (?,?,?,?,?,?,?,?)";
        $stmt = $dbh->prepare($sql);
        $stmt->execute([
            $_POST['kode'], $_POST['nama'], $_POST['tmp_lahir'], $_POST['tgl_lahir'],
            $_POST['gender'], $_POST['email'], $_POST['alamat'], $_POST['kelurahan_id']
        ]);
    }
} elseif (isset($_GET['delete'])) {
    $stmt = $dbh->prepare("DELETE FROM pasien WHERE id=?");
    $stmt->execute([$_GET['delete']]);
}

header("Location: data_pasien.php");
exit;
