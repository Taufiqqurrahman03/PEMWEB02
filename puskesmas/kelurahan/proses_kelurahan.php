<?php
require_once '../dbkoneksi.php';

if ($_POST['proses'] == 'simpan') {
    if ($_POST['id']) {
        // Update
        $sql = "UPDATE kelurahan SET nama = ?, kec_id = ? WHERE id = ?";
        $stmt = $dbh->prepare($sql);
        $stmt->execute([$_POST['nama'], $_POST['kec_id'], $_POST['id']]);
    } else {
        // Insert
        $sql = "INSERT INTO kelurahan (nama, kec_id) VALUES (?, ?)";
        $stmt = $dbh->prepare($sql);
        $stmt->execute([$_POST['nama'], $_POST['kec_id']]);
    }
} elseif (isset($_GET['delete'])) {
    // Delete
    $stmt = $dbh->prepare("DELETE FROM kelurahan WHERE id = ?");
    $stmt->execute([$_GET['delete']]);
}

header("Location: data_kelurahan.php");
exit;
