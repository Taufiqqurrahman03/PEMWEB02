<?php
session_start();
include 'dbkoneksi.php';

// Cek apakah user sudah login
if (!isset($_SESSION['id'])) {
    header("Location: login.php");
    exit();
}

// Filter data
$jenis_id = isset($_GET['jenis_id']) ? $_GET['jenis_id'] : '';
$provinsi_id = isset($_GET['provinsi_id']) ? $_GET['provinsi_id'] : '';
$kabkota_id = isset($_GET['kabkota_id']) ? $_GET['kabkota_id'] : '';

// Ambil data jenis faskes
$stmt_jenis = $dbh->query("SELECT * FROM jenis_faskes ORDER BY nama");
$jenis_data = $stmt_jenis->fetchAll();

// Ambil data provinsi
$stmt_provinsi = $dbh->query("SELECT * FROM provinsi ORDER BY nama");
$provinsi_data = $stmt_provinsi->fetchAll();

// Ambil data kabkota berdasarkan provinsi
$kabkota_data = [];
if (!empty($provinsi_id)) {
    $stmt_kabkota = $dbh->prepare("SELECT * FROM kabkota WHERE provinsi_id = ? ORDER BY nama");
    $stmt_kabkota->execute([$provinsi_id]);
    $kabkota_data = $stmt_kabkota->fetchAll();
}

// Buat kondisi filter
$conditions = [];
$params = [];

if (!empty($jenis_id)) {
    $conditions[] = "f.jenis_faskes_id = ?";
    $params[] = $jenis_id;
}

if (!empty($kabkota_id)) {
    $conditions[] = "f.kabkota_id = ?";
    $params[] = $kabkota_id;
} elseif (!empty($provinsi_id)) {
    $conditions[] = "k.provinsi_id = ?";
    $params[] = $provinsi_id;
}

$where_clause = !empty($conditions) ? "WHERE " . implode(" AND ", $conditions) : "";

// Query untuk mengambil data faskes dengan filter
$query = "SELECT f.*, j.nama as jenis_nama, k.nama as kabkota_nama, p.nama as provinsi_nama 
          FROM faskes f 
          JOIN jenis_faskes j ON f.jenis_faskes_id = j.id 
          JOIN kabkota k ON f.kabkota_id = k.id
          JOIN provinsi p ON k.provinsi_id = p.id
          $where_clause 
          ORDER BY f.nama";
$stmt = $dbh->prepare($query);
if (!empty($params)) {
    $stmt->execute($params);
} else {
    $stmt->execute();
}
$faskes_data = $stmt->fetchAll();
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Laporan Fasilitas Kesehatan</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/admin-lte@3.2/dist/css/adminlte.min.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free/css/all.min.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2-bootstrap4-theme@1.0.0/dist/select2-bootstrap4.min.css">
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
            <a href="profil.php" class="btn btn-default btn-flat">Profil</a>
            <a href="logout.php" class="btn btn-default btn-flat float-right">Logout</a>
          </li>
        </ul>
      </li>
    </ul>
  </nav>

  <!-- Sidebar -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <a href="dashboard.php" class="brand-link">
      <span class="brand-text font-weight-light ml-3">FASKES APP</span>
    </a>
    <div class="sidebar">
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" role="menu">
          <li class="nav-item">
            <a href="dashboard.php" class="nav-link"><i class="nav-icon fas fa-tachometer-alt"></i><p>Dashboard</p></a>
          </li>
          <?php if ($_SESSION['role'] === 'admin'): ?>
          <li class="nav-item">
            <a href="user.php" class="nav-link"><i class="nav-icon fas fa-users"></i><p>Data User</p></a>
          </li>
          <?php endif; ?>
          <li class="nav-item">
            <a href="profil.php" class="nav-link"><i class="nav-icon fas fa-user"></i><p>Profil</p></a>
          </li>
          <li class="nav-header">DATA MASTER</li>
          <li class="nav-item"><a href="provinsi/list_provinsi.php" class="nav-link"><i class="nav-icon fas fa-map"></i><p>Data Provinsi</p></a></li>
          <li class="nav-item"><a href="kabkota/list_kabkota.php" class="nav-link"><i class="nav-icon fas fa-city"></i><p>Data Kabupaten/Kota</p></a></li>
          <li class="nav-item"><a href="jenis_faskes/list_jenis.php" class="nav-link"><i class="nav-icon fas fa-hospital-symbol"></i><p>Jenis Faskes</p></a></li>
          <li class="nav-item"><a href="kategori/list_kategori.php" class="nav-link"><i class="nav-icon fas fa-tags"></i><p>Kategori</p></a></li>
          <li class="nav-item"><a href="faskes/list_faskes.php" class="nav-link"><i class="nav-icon fas fa-clinic-medical"></i><p>Data Faskes</p></a></li>
          <li class="nav-header">LAPORAN</li>
          <li class="nav-item"><a href="laporan.php" class="nav-link active"><i class="nav-icon fas fa-file-alt"></i><p>Laporan</p></a></li>
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
            <h1 class="m-0 text-dark">Laporan Fasilitas Kesehatan</h1>
          </div>
        </div>
      </div>
    </div>
    <div class="content">
      <div class="container-fluid">
        
        <!-- Filter Card -->
        <div class="card">
          <div class="card-header">
            <h3 class="card-title">Filter Data</h3>
          </div>
          <div class="card-body">
            <form action="" method="GET" id="filter-form">
              <div class="row">
                <div class="col-md-4">
                  <div class="form-group">
                    <label for="jenis_id">Jenis Faskes</label>
                    <select class="form-control select2" id="jenis_id" name="jenis_id">
                      <option value="">Semua Jenis</option>
                      <?php foreach ($jenis_data as $jenis): ?>
                        <option value="<?= $jenis['id'] ?>" <?= $jenis_id == $jenis['id'] ? 'selected' : '' ?>>
                          <?= htmlspecialchars($jenis['nama']) ?>
                        </option>
                      <?php endforeach; ?>
                    </select>
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-group">
                    <label for="provinsi_id">Provinsi</label>
                    <select class="form-control select2" id="provinsi_id" name="provinsi_id">
                      <option value="">Semua Provinsi</option>
                      <?php foreach ($provinsi_data as $provinsi): ?>
                        <option value="<?= $provinsi['id'] ?>" <?= $provinsi_id == $provinsi['id'] ? 'selected' : '' ?>>
                          <?= htmlspecialchars($provinsi['nama']) ?>
                        </option>
                      <?php endforeach; ?>
                    </select>
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-group">
                    <label for="kabkota_id">Kabupaten/Kota</label>
                    <select class="form-control select2" id="kabkota_id" name="kabkota_id" <?= empty($kabkota_data) ? 'disabled' : '' ?>>
                      <option value="">Semua Kabupaten/Kota</option>
                      <?php foreach ($kabkota_data as $kabkota): ?>
                        <option value="<?= $kabkota['id'] ?>" <?= $kabkota_id == $kabkota['id'] ? 'selected' : '' ?>>
                          <?= htmlspecialchars($kabkota['nama']) ?>
                        </option>
                      <?php endforeach; ?>
                    </select>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-12">
                  <button type="submit" class="btn btn-primary">Filter</button>
                  <a href="laporan.php" class="btn btn-default">Reset</a>
                  <button type="button" id="btn-print" class="btn btn-success float-right">
                    <i class="fas fa-print"></i> Cetak Laporan
                  </button>
                </div>
              </div>
            </form>
          </div>
        </div>
        
        <!-- Data Card -->
        <div class="card">
          <div class="card-header">
            <h3 class="card-title">Data Fasilitas Kesehatan</h3>
          </div>
          <div class="card-body table-responsive p-0">
            <table class="table table-hover text-nowrap" id="faskes-table">
              <thead>
                <tr>
                  <th>No</th>
                  <th>Nama Faskes</th>
                  <th>Jenis</th>
                  <th>Alamat</th>
                  <th>Kabupaten/Kota</th>
                  <th>Provinsi</th>
                  <th>Telepon</th>
                </tr>
              </thead>
              <tbody>
                <?php if (count($faskes_data) > 0): ?>
                  <?php $no = 1; foreach ($faskes_data as $row): ?>
                    <tr>
                      <td><?= $no++ ?></td>
                      <td><?= htmlspecialchars($row['nama']) ?></td>
                      <td><?= htmlspecialchars($row['jenis_nama']) ?></td>
                      <td><?= htmlspecialchars($row['alamat']) ?></td>
                      <td><?= htmlspecialchars($row['kabkota_nama']) ?></td>
                      <td><?= htmlspecialchars($row['provinsi_nama']) ?></td>
                      <td><?= htmlspecialchars($row['telepon']) ?></td>
                    </tr>
                  <?php endforeach; ?>
                <?php else: ?>
                  <tr>
                    <td colspan="7" class="text-center">Tidak ada data</td>
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
  <footer class="main-footer">
    <div class="float-right d-none d-sm-block">
      <b>Version</b> 1.0.0
    </div>
    <strong>Copyright &copy; <?= date('Y') ?> <a href="#">FASKES APP</a>.</strong> All rights reserved.
  </footer>
</div>

<!-- Print Template -->
<div id="print-area" style="display: none;">
  <div style="text-align: center; margin-bottom: 20px;">
    <h2>LAPORAN FASILITAS KESEHATAN</h2>
    <p id="print-filter-info">Filter: Semua Data</p>
  </div>
  <table border="1" cellpadding="5" cellspacing="0" width="100%">
    <thead>
      <tr>
        <th>No</th>
        <th>Nama Faskes</th>
        <th>Jenis</th>
        <th>Alamat</th>
        <th>Kabupaten/Kota</th>
        <th>Provinsi</th>
        <th>Telepon</th>
      </tr>
    </thead>
    <tbody id="print-data">
      <!-- Data akan diisi oleh JavaScript -->
    </tbody>
  </table>
  <div style="margin-top: 30px; text-align: right;">
    <p>Dicetak pada: <span id="print-date"></span></p>
  </div>
</div>

<!-- JS -->
<script src="https://cdn.jsdelivr.net/npm/jquery@3.6.4/dist/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/admin-lte@3.2/dist/js/adminlte.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.full.min.js"></script>
<script>
$(document).ready(function() {
  // Inisialisasi Select2
  $('.select2').select2({
    theme: 'bootstrap4'
  });
  
  // Ketika provinsi dipilih, ambil data kabkota
  $('#provinsi_id').change(function() {
    var provinsi_id = $(this).val();
    if (provinsi_id) {
      // Submit form untuk refresh halaman dengan data kabkota
      $('#filter-form').submit();
    } else {
      // Kosongkan dan disable dropdown kabkota
      $('#kabkota_id').empty().append('<option value="">Semua Kabupaten/Kota</option>').prop('disabled', true);
    }
  });
  
  // Fungsi cetak laporan
  $('#btn-print').click(function() {
    // Salin data dari tabel utama ke template cetak
    var printData = '';
    $('#faskes-table tbody tr').each(function() {
      printData += '<tr>';
      $(this).find('td').each(function() {
        printData += '<td>' + $(this).text() + '</td>';
      });
      printData += '</tr>';
    });
    $('#print-data').html(printData);
    
    // Set informasi filter
    var filterInfo = 'Filter: ';
    var jenis = $('#jenis_id option:selected').text();
    var provinsi = $('#provinsi_id option:selected').text();
    var kabkota = $('#kabkota_id option:selected').text();
    
    if (jenis !== 'Semua Jenis') filterInfo += 'Jenis: ' + jenis + ', ';
    if (provinsi !== 'Semua Provinsi') filterInfo += 'Provinsi: ' + provinsi + ', ';
    if (kabkota !== 'Semua Kabupaten/Kota') filterInfo += 'Kabupaten/Kota: ' + kabkota + ', ';
    
    if (filterInfo === 'Filter: ') filterInfo += 'Semua Data';
    else filterInfo = filterInfo.slice(0, -2); // Hapus koma terakhir
    
    $('#print-filter-info').text(filterInfo);
    
    // Set tanggal cetak
    var now = new Date();
    var dateStr = now.getDate() + '/' + (now.getMonth() + 1) + '/' + now.getFullYear() + ' ' + 
                 now.getHours() + ':' + now.getMinutes();
    $('#print-date').text(dateStr);
    
    // Buka jendela cetak
    var printContent = document.getElementById('print-area').innerHTML;
    var originalContent = document.body.innerHTML;
    document.body.innerHTML = printContent;
    window.print();
    document.body.innerHTML = originalContent;
    location.reload(); // Reload halaman setelah cetak
  });
});
</script>
</body>
</html>
