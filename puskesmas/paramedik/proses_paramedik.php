<?php
require_once '../dbkoneksi.php';

if ($_POST['proses'] == 'simpan') {
    if ($_POST['id']) {
        // Update
        $sql = "UPDATE paramedik SET 
                nama = ?, 
                gender = ?, 
                tmp_lahir = ?, 
                tgl_lahir = ?, 
                kategori = ?, 
                alamat = ?, 
                telpon = ?, 
                unit_kerja_id = ? 
                WHERE id = ?";
        $stmt = $dbh->prepare($sql);
        $stmt->execute([
            $_POST['nama'], 
            $_POST['gender'], 
            $_POST['tmp_lahir'], 
            $_POST['tgl_lahir'], 
            $_POST['kategori'], 
            $_POST['alamat'], 
            $_POST['telpon'], 
            $_POST['unit_kerja_id'],
            $_POST['id']
        ]);
    } else {
        // Insert
        $sql = "INSERT INTO paramedik 
                (nama, gender, tmp_lahir, tgl_lahir, kategori, alamat, telpon, unit_kerja_id) 
                VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = $dbh->prepare($sql);
        $stmt->execute([
            $_POST['nama'], 
            $_POST['gender'], 
            $_POST['tmp_lahir'], 
            $_POST['tgl_lahir'], 
            $_POST['kategori'], 
            $_POST['alamat'], 
            $_POST['telpon'], 
            $_POST['unit_kerja_id']
        ]);
    }
} elseif (isset($_GET['delete'])) {
    // Delete
    $stmt = $dbh->prepare("DELETE FROM paramedik WHERE id = ?");
    $stmt->execute([$_GET['delete']]);
}

header("Location: data_paramedik.php");
exit;