<?php
require_once '../dbkoneksi.php';

if ($_POST['proses'] == 'simpan') {
    if ($_POST['id']) {
        $sql = "UPDATE periksa SET tanggal=?, berat=?, tinggi=?, tensi=?, keterangan=?, pasien_id=?, dokter_id=? WHERE id=?";
        $stmt = $dbh->prepare($sql);
        $stmt->execute([
            $_POST['tanggal'], $_POST['berat'], $_POST['tinggi'], $_POST['tensi'],
            $_POST['keterangan'], $_POST['pasien_id'], $_POST['dokter_id'], $_POST['id']
        ]);
    } else {
        $sql = "INSERT INTO periksa (tanggal, berat, tinggi, tensi, keterangan, pasien_id, dokter_id) VALUES (?,?,?,?,?,?,?)";
        $stmt = $dbh->prepare($sql);
        $stmt->execute([
            $_POST['tanggal'], $_POST['berat'], $_POST['tinggi'], $_POST['tensi'],
            $_POST['keterangan'], $_POST['pasien_id'], $_POST['dokter_id']
        ]);
    }
} elseif (isset($_GET['delete'])) {
    $stmt = $dbh->prepare("DELETE FROM periksa WHERE id=?");
    $stmt->execute([$_GET['delete']]);
}

header("Location: data_periksa.php");
exit;
