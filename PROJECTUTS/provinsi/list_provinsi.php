<?php
session_start();
include '../dbkoneksi.php';

// Cek apakah user sudah login
if (!isset($_SESSION['id'])) {
    header("Location: ../login.php");
    exit();
}

// Tambahkan pesan flash
$success_msg = isset($_SESSION['success_msg']) ? $_SESSION['success_msg'] : '';
$error_msg = isset($_SESSION['error_msg']) ? $_SESSION['error_msg'] : '';
unset($_SESSION['success_msg'], $_SESSION['error_msg']);

// Pengaturan pagination
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$per_page = 10;
$start = ($page - 1) * $per_page;

// Pengaturan pencarian
$search = isset($_GET['search']) ? $_GET['search'] : '';
$search_condition = $search ? "WHERE nama LIKE :search" : "";

// Query untuk menghitung total data
$count_query = "SELECT COUNT(*) FROM provinsi $search_condition";
$count_stmt = $dbh->prepare($count_query);
if ($search) {
    $count_stmt->bindValue(':search', "%$search%", PDO::PARAM_STR);
}
$count_stmt->execute();
$total_records = $count_stmt->fetchColumn();
$total_pages = ceil($total_records / $per_page);

// Query untuk mengambil data dengan pagination dan pencarian
$query = "SELECT * FROM provinsi $search_condition ORDER BY nama LIMIT :start, :per_page";
$stmt = $dbh->prepare($query);
if ($search) {
    $stmt->bindValue(':search', "%$search%", PDO::PARAM_STR);
}
$stmt->bindValue(':start', $start, PDO::PARAM_INT);
$stmt->bindValue(':per_page', $per_page, PDO::PARAM_INT);
$stmt->execute();
$provinsi_data = $stmt->fetchAll();
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Data Provinsi</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/admin-lte@3.2/dist/css/adminlte.min.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free/css/all.min.css">
  <meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<body class="hold-transition sidebar-mini">
<div class="wrapper">

  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
    </ul>
    <ul class="navbar-nav ml-auto">
      <li class="nav-item dropdown user-menu">
        <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">
          <img src="https://i.pravatar.cc/30?u=<?= $_SESSION['id'] ?>" class="user-image img-circle elevation-2" alt="User Image">
          <span class="d-none d-md-inline"><?= $_SESSION['username'] ?></span>
        </a>
        <ul class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
          <li class="user-header bg-primary">
            <img src="https://i.pravatar.cc/90?u=<?= $_SESSION['id'] ?>" class="img-circle elevation-2" alt="User Image">
            <p><?= $_SESSION['username'] ?></p>
          </li>
          <li class="user-footer">
            <a href="../profil.php" class="btn btn-default btn-flat">Profil</a>
            <a href="../logout.php" class="btn btn-default btn-flat float-right">Logout</a>
          </li>
        </ul>
      </li>
    </ul>
  </nav>

  <!-- Sidebar -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <a href="../dashboard.php" class="brand-link">
      <span class="brand-text font-weight-light ml-3">FASKES APP</span>
    </a>
    <div class="sidebar">
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" role="menu">
          <li class="nav-item">
            <a href="../dashboard.php" class="nav-link"><i class="nav-icon fas fa-tachometer-alt"></i><p>Dashboard</p></a>
          </li>
          <li class="nav-item">
            <a href="../user.php" class="nav-link"><i class="nav-icon fas fa-users"></i><p>Data User</p></a>
          </li>
          <li class="nav-item">
            <a href="../profil.php" class="nav-link"><i class="nav-icon fas fa-user"></i><p>Profil</p></a>
          </li>
          <li class="nav-header">DATA MASTER</li>
          <li class="nav-item"><a href="list_provinsi.php" class="nav-link active"><i class="nav-icon fas fa-map"></i><p>Data Provinsi</p></a></li>
          <li class="nav-item"><a href="../kabkota/list_kabkota.php" class="nav-link"><i class="nav-icon fas fa-city"></i><p>Data Kabupaten/Kota</p></a></li>
          <li class="nav-item"><a href="../jenis_faskes/list_jenis.php" class="nav-link"><i class="nav-icon fas fa-hospital-symbol"></i><p>Jenis Faskes</p></a></li>
          <li class="nav-item"><a href="../kategori/list_kategori.php" class="nav-link"><i class="nav-icon fas fa-tags"></i><p>Kategori</p></a></li>
          <li class="nav-item"><a href="../faskes/list_faskes.php" class="nav-link"><i class="nav-icon fas fa-clinic-medical"></i><p>Data Faskes</p></a></li>
          <li class="nav-header">LAPORAN</li>
          <li class="nav-item"><a href="../laporan.php" class="nav-link"><i class="nav-icon fas fa-file-alt"></i><p>Laporan</p></a></li>
        </ul>
      </nav>
    </div>
  </aside>

  <!-- Content -->
  <div class="content-wrapper">
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Data Provinsi</h1>
          </div>
        </div>
      </div>
    </div>
    <div class="content">
      <div class="container-fluid">
        
        <!-- Messages -->
        <?php if ($success_msg): ?>
          <div class="alert alert-success alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            <h5><i class="icon fas fa-check"></i> Berhasil!</h5>
            <?= $success_msg ?>
          </div>
        <?php endif; ?>
        
        <?php if ($error_msg): ?>
          <div class="alert alert-danger alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            <h5><i class="icon fas fa-ban"></i> Gagal!</h5>
            <?= $error_msg ?>
          </div>
        <?php endif; ?>
        
        <div class="card">
          <div class="card-header">
            <h3 class="card-title">Daftar Provinsi</h3>
            <div class="card-tools">
              <form action="" method="GET" class="input-group input-group-sm" style="width: 250px;">
                <input type="text" name="search" class="form-control float-right" placeholder="Cari..." value="<?= htmlspecialchars($search) ?>">
                <div class="input-group-append">
                  <button type="submit" class="btn btn-default">
                    <i class="fas fa-search"></i>
                  </button>
                </div>
              </form>
            </div>
          </div>
          <div class="card-body table-responsive p-0">
            <table class="table table-hover text-nowrap">
              <thead>
                <tr>
                  <th>No</th>
                  <th>Kode</th>
                  <th>Nama Provinsi</th>
                </tr>
              </thead>
              <tbody>
                <?php if (count($provinsi_data) > 0): ?>
                  <?php $no = $start + 1; foreach ($provinsi_data as $row): ?>
                    <tr>
                      <td><?= $no++ ?></td>
                      <td><?= htmlspecialchars($row['id']) ?></td>
                      <td><?= htmlspecialchars($row['nama']) ?></td>
                      <td>
                      
                      </td>
                    </tr>
                  <?php endforeach; ?>
                <?php else: ?>
                  <tr>
                    <td colspan="4" class="text-center">Tidak ada data</td>
                  </tr>
                <?php endif; ?>
              </tbody>
            </table>
          </div>
          <div class="card-footer clearfix">
            <!-- Pagination -->
            <ul class="pagination pagination-sm m-0 float-right">
              <?php if ($page > 1): ?>
                <li class="page-item"><a class="page-link" href="?page=1<?= $search ? "&search=$search" : "" ?>">&laquo;</a></li>
              <?php endif; ?>
              
              <?php
              // Tampilkan maksimal 5 halaman
              $start_page = max(1, $page - 2);
              $end_page = min($start_page + 4, $total_pages);
              
              for ($i = $start_page; $i <= $end_page; $i++): ?>
                <li class="page-item <?= $i == $page ? 'active' : '' ?>">
                  <a class="page-link" href="?page=<?= $i ?><?= $search ? "&search=$search" : "" ?>"><?= $i ?></a>
                </li>
              <?php endfor; ?>
              
              <?php if ($page < $total_pages): ?>
                <li class="page-item"><a class="page-link" href="?page=<?= $total_pages ?><?= $search ? "&search=$search" : "" ?>">&raquo;</a></li>
              <?php endif; ?>
            </ul>
          </div>
        </div>

      </div>
    </div>
  </div>

  <!-- Footer -->
  <footer class="main-footer">
    <div class="float-right d-none d-sm-block">
      <b>Version</b> 1.0.0
    </div>
    <strong>Copyright &copy; <?= date('Y') ?> <a href="#">FASKES APP</a>.</strong> All rights reserved.
  </footer>
</div>

<!-- JS -->
<script src="https://cdn.jsdelivr.net/npm/jquery@3.6.4/dist/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/admin-lte@3.2/dist/js/adminlte.min.js"></script>
</body>
</html>