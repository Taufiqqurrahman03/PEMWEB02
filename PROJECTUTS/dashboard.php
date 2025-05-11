<?php
// Aktifkan pelaporan error untuk debugging
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Memulai sesi
session_start();

// Mengimpor file koneksi database
require_once 'config/database.php';

// Inisialisasi variabel untuk menyimpan data
$total_faskes = 0;
$total_provinsi = 0;
$total_kota = 0;
$faskes_per_jenis = [];
$faskes_per_provinsi = [];

try {
    // Query untuk mendapatkan total faskes
    $query_total = "SELECT COUNT(*) as total FROM faskes";
    $stmt_total = $conn->prepare($query_total);
    $stmt_total->execute();
    $result_total = $stmt_total->fetch(PDO::FETCH_ASSOC);
    $total_faskes = $result_total['total'] ?? 0;

    // Query untuk mendapatkan total provinsi
    $query_provinsi_total = "SELECT COUNT(*) as total FROM provinsi";
    $stmt_provinsi_total = $conn->prepare($query_provinsi_total);
    $stmt_provinsi_total->execute();
    $result_provinsi_total = $stmt_provinsi_total->fetch(PDO::FETCH_ASSOC);
    $total_provinsi = $result_provinsi_total['total'] ?? 0;

    // Query untuk mendapatkan total kota/kabupaten
    $query_kota_total = "SELECT COUNT(*) as total FROM kabkota";
    $stmt_kota_total = $conn->prepare($query_kota_total);
    $stmt_kota_total->execute();
    $result_kota_total = $stmt_kota_total->fetch(PDO::FETCH_ASSOC);
    $total_kota = $result_kota_total['total'] ?? 0;

    // Query untuk mendapatkan faskes per jenis
    $query_jenis = "SELECT j.nama AS jenis, COUNT(f.id) AS jumlah
        FROM faskes f
        JOIN jenis_faskes j ON f.jenis_faskes_id = j.id
        GROUP BY j.nama
        ORDER BY jumlah DESC
    ";
    $stmt_jenis = $conn->prepare($query_jenis);
    $stmt_jenis->execute();
    $faskes_per_jenis = $stmt_jenis->fetchAll(PDO::FETCH_ASSOC);

    // Query untuk mendapatkan top 5 kab/kota dengan faskes terbanyak
    $query_kabkota = "SELECT k.nama as nama, COUNT(f.id) as jumlah 
                      FROM faskes f 
                      JOIN kabkota k ON f.kabkota_id = k.id 
                      GROUP BY k.nama, k.id
                      ORDER BY jumlah DESC 
                      LIMIT 5";
    $stmt_kabkota = $conn->prepare($query_kabkota);
    $stmt_kabkota->execute();
    $faskes_per_kabkota = $stmt_kabkota->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    // Mencatat error ke file log
    error_log("Database Error: " . $e->getMessage());
    echo "Terjadi kesalahan database: " . $e->getMessage();
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Sistem Informasi Fasilitas Kesehatan</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body>
    <div class="container-fluid">
        <div class="row">
            <!-- Sidebar -->
            <div class="col-md-2 bg-dark text-white p-0">
                <div class="d-flex flex-column p-3">
                    <a href="/" class="d-flex align-items-center mb-3 mb-md-0 me-md-auto text-white text-decoration-none">
                        <span class="fs-4">SI Faskes</span>
                    </a>
                    <hr>
                    <ul class="nav nav-pills flex-column mb-auto">
                        <li class="nav-item">
                            <a href="dashboard.php" class="nav-link active">
                                <i class="fas fa-tachometer-alt me-2"></i> Dashboard
                            </a>
                        </li>
                        <li>
                            <a href="faskes/list_faskes.php" class="nav-link text-white">
                                <i class="fas fa-hospital me-2"></i> Fasilitas Kesehatan
                            </a>
                        </li>
                        <li>
                            <a href="provinsi/list_provinsi.php" class="nav-link text-white">
                                <i class="fas fa-map-marker-alt me-2"></i> Provinsi
                            </a>
                        </li>
                        <li>
                            <a href="kabkota/list_kabkota.php" class="nav-link text-white">
                                <i class="fas fa-city me-2"></i> Kota/Kabupaten
                            </a>
                        </li>
                    </ul>
                </div>
            </div>

            <!-- Main Content -->
            <div class="col-md-10 p-4">
                <h1 class="mb-4">Dashboard</h1>
                
                <!-- Info Cards -->
                <div class="row mb-4">
                    <div class="col-md-4">
                        <div class="card bg-primary text-white">
                            <div class="card-body">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div>
                                        <h5 class="card-title">Total Faskes</h5>
                                        <h2 class="mb-0"><?= number_format($total_faskes) ?></h2>
                                    </div>
                                    <i class="fas fa-hospital fa-3x"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card bg-success text-white">
                            <div class="card-body">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div>
                                        <h5 class="card-title">Total Provinsi</h5>
                                        <h2 class="mb-0"><?= number_format($total_provinsi) ?></h2>
                                    </div>
                                    <i class="fas fa-map-marker-alt fa-3x"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card bg-info text-white">
                            <div class="card-body">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div>
                                        <h5 class="card-title">Total Kota/Kabupaten</h5>
                                        <h2 class="mb-0"><?= number_format($total_kota) ?></h2>
                                    </div>
                                    <i class="fas fa-city fa-3x"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Faskes per Jenis -->
                <div class="row mb-4">
                    <div class="col-md-6">
                        <div class="card">
                            <div class="card-header bg-light">
                                <h5 class="card-title mb-0">Jenis Faskes</h5>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-striped table-hover">
                                        <thead>
                                            <tr>
                                                <th>Jenis Faskes</th>
                                                <th>Jumlah</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php if (!empty($faskes_per_jenis)): ?>
                                                <?php foreach ($faskes_per_jenis as $item): ?>
                                                    <tr>
                                                        <td><?= htmlspecialchars($item['jenis'] ?? 'Tidak diketahui') ?></td>
                                                        <td><?= htmlspecialchars($item['jumlah'] ?? '0') ?></td>
                                                    </tr>
                                                <?php endforeach; ?>
                                            <?php else: ?>
                                                <tr>
                                                    <td colspan="2" class="text-center">Data tidak tersedia</td>
                                                </tr>
                                            <?php endif; ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Faskes per Kabupaten atau Kota -->
                    <div class="col-md-6">
                        <div class="card">
                            <div class="card-header bg-light">
                                <h5 class="card-title mb-0">Faskes per Kab/Kota (Top 5)</h5>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-striped table-hover">
                                        <thead>
                                            <tr>
                                                <th>Kab/Kota</th>
                                                <th>Jumlah</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php if (!empty($faskes_per_kabkota)): ?>
                                                <?php foreach ($faskes_per_kabkota as $item): ?>
                                                    <tr>
                                                        <td><?= htmlspecialchars($item['nama'] ?? 'Tidak diketahui') ?></td>
                                                        <td><?= htmlspecialchars($item['jumlah'] ?? '0') ?></td>
                                                    </tr>
                                                <?php endforeach; ?>
                                            <?php else: ?>
                                                <tr>
                                                    <td colspan="2" class="text-center">Data tidak tersedia</td>
                                                </tr>
                                            <?php endif; ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Footer -->
                <footer class="mt-5 mb-3">
                    <div class="text-center">
                        <p class="text-muted">&copy; <?= date('Y') ?> Sistem Informasi Fasilitas Kesehatan</p>
                    </div>
                </footer>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
