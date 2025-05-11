<?php
session_start();
include '../dbkoneksi.php';

// Cek apakah user sudah login
if (!isset($_SESSION['id'])) {
    header("Location: ../login.php");
    exit();
}

// Cek apakah ada ID yang dikirim
if (!isset($_GET['id']) || empty($_GET['id'])) {
    $_SESSION['error_msg'] = "ID faskes tidak valid";
    header("Location: list_faskes.php");
    exit();
}

$id = $_GET['id'];

// Cek apakah data faskes ada
$stmt = $dbh->prepare("SELECT * FROM faskes WHERE id = ?");
$stmt->execute([$id]);
$faskes = $stmt->fetch();

if (!$faskes) {
    $_SESSION['error_msg'] = "Data faskes tidak ditemukan";
    header("Location: list_faskes.php");
    exit();
}

try {
    $dbh->beginTransaction();
    
    // Hapus data faskes_kategori terlebih dahulu
    $stmt = $dbh->prepare("DELETE FROM faskes_kategori WHERE faskes_id = ?");
    $stmt->execute([$id]);
    
    // Hapus data faskes
    $stmt = $dbh->prepare("DELETE FROM faskes WHERE id = ?");
    $stmt->execute([$id]);
    
    $dbh->commit();
    
    $_SESSION['success_msg'] = "Data faskes berhasil dihapus";
} catch (PDOException $e) {
    $dbh->rollBack();
    $_SESSION['error_msg'] = "Gagal menghapus data: " . $e->getMessage();
}

header("Location: list_faskes.php");
exit();
