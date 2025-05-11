<?php
session_start();
include '../dbkoneksi.php';

// Cek apakah user sudah login
if (!isset($_SESSION['id'])) {
    header("Location: ../login.php");
    exit();
}

// Ambil data jenis faskes
$stmt_jenis = $dbh->query("SELECT * FROM jenis_faskes ORDER BY nama");
$jenis_data = $stmt_jenis->fetchAll();

// Ambil data provinsi
$stmt_provinsi = $dbh->query("SELECT * FROM provinsi ORDER BY nama");
$provinsi_data = $stmt_provinsi->fetchAll();

// Ambil data kategori
$stmt_kategori = $dbh->query("SELECT * FROM kategori ORDER BY nama");
$kategori_data = $stmt_kategori->fetchAll();

// Inisialisasi variabel
$kabkota_data = [];
$selected_provinsi = '';
$error_msg = '';

// Jika ada provinsi yang dipilih, ambil data kabkota
if (isset($_POST['provinsi_id']) && !empty($_POST['provinsi_id'])) {
    $selected_provinsi = $_POST['provinsi_id'];
    $stmt_kabkota = $dbh->prepare("SELECT * FROM kabkota WHERE provinsi_id = ? ORDER BY nama");
    $stmt_kabkota->execute([$selected_provinsi]);
    $kabkota_data = $stmt_kabkota->fetchAll();
}

// Proses form submit
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit'])) {
    $nama = $_POST['nama'] ?? '';
    $jenis_id = $_POST['jenis_id'] ?? '';
    $deskripsi = $_POST['deskripsi'] ?? '';
    $alamat = $_POST['alamat'] ?? '';
    $kabkota_id = $_POST['kabkota_id'] ?? '';
    $website = $_POST['website'] ?? '';
    $telepon = $_POST['telepon'] ?? '';
    $email = $_POST['email'] ?? '';
    $kategori_ids = $_POST['kategori_id'] ?? [];
    
    // Handle latitude and longitude from latlong input
    $latitude = null;
    $longitude = null;
    if (!empty($_POST['latlong'])) {
        $latlong_parts = explode(',', $_POST['latlong']);
        if (count($latlong_parts) == 2) {
            $latitude = trim($latlong_parts[0]);
            $longitude = trim($latlong_parts[1]);
        }
    }
    
    // Validasi
    if (empty($nama) || empty($jenis_id) || empty($alamat) || empty($kabkota_id)) {
        $error_msg = "Nama, jenis, alamat, dan kabupaten/kota harus diisi";
    } else {
        try {
            $dbh->beginTransaction();
            
            // Masukkan data faskes dengan field latitude dan longitude terpisah (bukan latlong)
            // Field telepon tidak ada di database berdasarkan pesan error
            $stmt = $dbh->prepare("INSERT INTO faskes (nama, jenis_id, deskripsi, alamat, latitude, longitude, kabkota_id, website, email) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
            $stmt->execute([$nama, $jenis_id, $deskripsi, $alamat, $latitude, $longitude, $kabkota_id, $website, $email]);
            $faskes_id = $dbh->lastInsertId();
            
            // Insert kategori faskes
            if (!empty($kategori_ids)) {
                $stmt_kategori = $dbh->prepare("INSERT INTO faskes_kategori (faskes_id, kategori_id) VALUES (?, ?)");
                foreach ($kategori_ids as $kategori_id) {
                    $stmt_kategori->execute([$faskes_id, $kategori_id]);
                }
            }
            
            $dbh->commit();
            
            $_SESSION['success_msg'] = "Data faskes berhasil ditambahkan";
            header("Location: list_faskes.php");
            exit();
        } catch (PDOException $e) {
            $dbh->rollBack();
            $error_msg = "Error: " . $e->getMessage();
        }
    }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Tambah Fasilitas Kesehatan</title>
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
          <li class="nav-item"><a href="../provinsi/list_provinsi.php" class="nav-link"><i class="nav-icon fas fa-map"></i><p>Data Provinsi</p></a></li>
          <li class="nav-item"><a href="../kabkota/list_kabkota.php" class="nav-link"><i class="nav-icon fas fa-city"></i><p>Data Kabupaten/Kota</p></a></li>
          <li class="nav-item"><a href="../jenis_faskes/list_jenis.php" class="nav-link"><i class="nav-icon fas fa-hospital-symbol"></i><p>Jenis Faskes</p></a></li>
          <li class="nav-item"><a href="../kategori/list_kategori.php" class="nav-link"><i class="nav-icon fas fa-tags"></i><p>Kategori</p></a></li>
          <li class="nav-item"><a href="list_faskes.php" class="nav-link active"><i class="nav-icon fas fa-clinic-medical"></i><p>Data Faskes</p></a></li>
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
            <h1 class="m-0 text-dark">Tambah Fasilitas Kesehatan</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="../dashboard.php">Dashboard</a></li>
              <li class="breadcrumb-item"><a href="list_faskes.php">Data Faskes</a></li>
              <li class="breadcrumb-item active">Tambah Faskes</li>
            </ol>
          </div>
        </div>
      </div>
    </div>
    <div class="content">
      <div class="container-fluid">
        
        <?php if ($error_msg): ?>
          <div class="alert alert-danger alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            <h5><i class="icon fas fa-ban"></i> Gagal!</h5>
            <?= $error_msg ?>
          </div>
        <?php endif; ?>
        
        <div class="card">
          <div class="card-header">
            <h3 class="card-title">Form Tambah Faskes</h3>
          </div>
          <form method="post" action="">
            <div class="card-body">
              <div class="form-group">
                <label for="nama">Nama Faskes <span class="text-danger">*</span></label>
                <input type="text" class="form-control" id="nama" name="nama" required>
              </div>
              <div class="form-group">
                <label for="jenis_id">Jenis Faskes <span class="text-danger">*</span></label>
                <select class="form-control select2" id="jenis_id" name="jenis_id" required>
                  <option value="">-- Pilih Jenis Faskes --</option>
                  <?php foreach ($jenis_data as $jenis): ?>
                    <option value="<?= $jenis['id'] ?>"><?= htmlspecialchars($jenis['nama']) ?></option>
                  <?php endforeach; ?>
                </select>
              </div>
              <div class="form-group">
                <label for="deskripsi">Deskripsi</label>
                <textarea class="form-control" id="deskripsi" name="deskripsi" rows="3"></textarea>
              </div>
              <div class="form-group">
                <label for="alamat">Alamat <span class="text-danger">*</span></label>
                <textarea class="form-control" id="alamat" name="alamat" rows="2" required></textarea>
              </div>
              <div class="form-group">
                <label for="latlong">Koordinat (Latitude, Longitude)</label>
                <input type="text" class="form-control" id="latlong" name="latlong" placeholder="Contoh: -6.123456, 106.789012">
                <small class="form-text text-muted">Format: latitude, longitude (dipisahkan dengan koma)</small>
              </div>
              <div class="form-group">
                <label for="provinsi_id">Provinsi <span class="text-danger">*</span></label>
                <select class="form-control select2" id="provinsi_id" name="provinsi_id" required>
                  <option value="">-- Pilih Provinsi --</option>
                  <?php foreach ($provinsi_data as $provinsi): ?>
                    <option value="<?= $provinsi['id'] ?>" <?= $selected_provinsi == $provinsi['id'] ? 'selected' : '' ?>>
                      <?= htmlspecialchars($provinsi['nama']) ?>
                    </option>
                  <?php endforeach; ?>
                </select>
              </div>
              <div class="form-group">
                <label for="kabkota_id">Kabupaten/Kota <span class="text-danger">*</span></label>
                <select class="form-control select2" id="kabkota_id" name="kabkota_id" required <?= empty($kabkota_data) ? 'disabled' : '' ?>>
                  <option value="">-- Pilih Kabupaten/Kota --</option>
                  <?php foreach ($kabkota_data as $kabkota): ?>
                    <option value="<?= $kabkota['id'] ?>"><?= htmlspecialchars($kabkota['nama']) ?></option>
                  <?php endforeach; ?>
                </select>
              </div>
              <div class="form-group">
                <label for="website">Website</label>
                <input type="url" class="form-control" id="website" name="website" placeholder="https://example.com">
              </div>
              <div class="form-group">
                <label for="telepon">Telepon</label>
                <input type="text" class="form-control" id="telepon" name="telepon">
              </div>
              <div class="form-group">
                <label for="email">Email</label>
                <input type="email" class="form-control" id="email" name="email">
              </div>
              <div class="form-group">
                <label for="kategori_id">Kategori</label>
                <select class="form-control select2" id="kategori_id" name="kategori_id[]" multiple>
                  <?php foreach ($kategori_data as $kategori): ?>
                    <option value="<?= $kategori['id'] ?>"><?= htmlspecialchars($kategori['nama']) ?></option>
                  <?php endforeach; ?>
                </select>
              </div>
            </div>
            <div class="card-footer">
              <button type="submit" name="submit" class="btn btn-primary">Simpan</button>
              <a href="list_faskes.php" class="btn btn-default">Batal</a>
            </div>
          </form>
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
      $('<form action="" method="post">' +
        '<input type="hidden" name="provinsi_id" value="' + provinsi_id + '">' +
        '</form>').appendTo('body').submit();
    } else {
      // Kosongkan dan disable dropdown kabkota
      $('#kabkota_id').empty().append('<option value="">-- Pilih Kabupaten/Kota --</option>').prop('disabled', true);
    }
  });
});
</script>
</body>
</html>