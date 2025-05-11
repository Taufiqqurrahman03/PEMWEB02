<?php
session_start();
include '../dbkoneksi.php';

// Cek apakah user sudah login
if (!isset($_SESSION['id'])) {
    header("Location: login.php");
    exit();
}
// Tidak ada pengecekan login

// Include template
include 'template/header.php';
include 'template/sidebar.php';
?>

<!-- Content Wrapper -->
<div class="content-wrapper">
    <!-- Content Header -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">APLIKASI FASILITAS KESEHATAN</h1>
                </div>
            </div>
        </div>
    </div>

    <!-- Main Content -->
    <div class="content">
        <div class="container-fluid">
            <!-- Konten halaman Anda di sini -->
        </div>
    </div>
</div>

<?php include 'template/footer.php'; ?>