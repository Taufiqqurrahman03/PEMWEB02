<?php
session_start();
include 'dbkoneksi.php';

// Cek apakah user sudah login
if (!isset($_SESSION['id'])) {
    header("Location: login.php");
    exit();
}

// Ambil data user
$stmt = $dbh->prepare("SELECT * FROM users WHERE id = ?");
$stmt->execute([$_SESSION['id']]);
$user = $stmt->fetch();

$success_msg = '';
$error_msg = '';

// Proses update profil
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nama_lengkap = $_POST['nama_lengkap'] ?? '';
    $email = $_POST['email'] ?? '';
    $current_password = $_POST['current_password'] ?? '';
    $new_password = $_POST['new_password'] ?? '';
    $confirm_password = $_POST['confirm_password'] ?? '';
    
    // Validasi
    if (empty($nama_lengkap) || empty($email)) {
        $error_msg = "Nama lengkap dan email harus diisi";
    } elseif (!empty($new_password) && $new_password != $confirm_password) {
        $error_msg = "Password baru dan konfirmasi password tidak cocok";
    } elseif (!empty($new_password) && !password_verify($current_password, $user['password'])) {
        $error_msg = "Password saat ini tidak valid";
    } else {
        // Update data
        if (!empty($new_password)) {
            // Update dengan password baru
            $stmt = $dbh->prepare("UPDATE users SET nama_lengkap = ?, email = ?, password = ? WHERE id = ?");
            $hashed_password = password_hash($new_password, PASSWORD_DEFAULT);
            $stmt->execute([$nama_lengkap, $email, $hashed_password, $_SESSION['id']]);
        } else {
            // Update tanpa password
            $stmt = $dbh->prepare("UPDATE users SET nama_lengkap = ?, email = ? WHERE id = ?");
            $stmt->execute([$nama_lengkap, $email, $_SESSION['id']]);
        }
        
        // Update session
        $_SESSION['nama_lengkap'] = $nama_lengkap;
        
        $success_msg = "Profil berhasil diperbarui";
        
        // Refresh data
        $stmt = $dbh->prepare("SELECT * FROM users WHERE id = ?");
        $stmt->execute([$_SESSION['id']]);
        $user = $stmt->fetch();
    }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Profil - FASKES APP</title>
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
          <li class="nav-item">
            <a href="user.php" class="nav-link"><i class="nav-icon fas fa-users"></i><p>Data User</p></a>
          </li>
          <li class="nav-item">
            <a href="profil.php" class="nav-link active"><i class="nav-icon fas fa-user"></i><p>Profil</p></a>
          </li>
          <li class="nav-header">DATA MASTER</li>
          <li class="nav-item"><a href="provinsi/list_provinsi.php" class="nav-link"><i class="nav-icon fas fa-map"></i><p>Data Provinsi</p></a></li>
          <li class="nav-item"><a href="kabkota/list_kabkota.php" class="nav-link"><i class="nav-icon fas fa-city"></i><p>Data Kabupaten/Kota</p></a></li>
          <li class="nav-item"><a href="jenis_faskes/list_jenis.php" class="nav-link"><i class="nav-icon fas fa-hospital-symbol"></i><p>Jenis Faskes</p></a></li>
          <li class="nav-item"><a href="kategori/list_kategori.php" class="nav-link"><i class="nav-icon fas fa-tags"></i><p>Kategori</p></a></li>
          <li class="nav-item"><a href="faskes/list_faskes.php" class="nav-link"><i class="nav-icon fas fa-clinic-medical"></i><p>Data Faskes</p></a></li>
          <li class="nav-header">LAPORAN</li>
          <li class="nav-item"><a href="laporan.php" class="nav-link"><i class="nav-icon fas fa-file-alt"></i><p>Laporan</p></a></li>
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
            <h1 class="m-0 text-dark">Profil Pengguna</h1>
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
        
        <div class="row">
          <div class="col-md-3">
            <div class="card card-primary card-outline">
              <div class="card-body box-profile">
                <div class="text-center">
                  <img class="profile-user-img img-fluid img-circle" src="https://i.pravatar.cc/128?u=<?= $_SESSION['id'] ?>" alt="User profile picture">
                </div>
                <h3 class="profile-username text-center"><?= htmlspecialchars($user['nama_lengkap']) ?></h3>
                <p class="text-muted text-center"><?= htmlspecialchars($user['username']) ?></p>
                <ul class="list-group list-group-unbordered mb-3">
                  <li class="list-group-item">
                    <b>Role</b> <a class="float-right"><?= htmlspecialchars($user['role']) ?></a>
                  </li>
                  <li class="list-group-item">
                    <b>Last Login</b> <a class="float-right"><?= htmlspecialchars($user['last_login']) ?></a>
                  </li>
                </ul>
              </div>
            </div>
          </div>
          <div class="col-md-9">
            <div class="card">
              <div class="card-header p-2">
                <ul class="nav nav-pills">
                  <li class="nav-item"><a class="nav-link active" href="#settings" data-toggle="tab">Pengaturan</a></li>
                </ul>
              </div>
              <div class="card-body">
                <div class="tab-content">
                  <div class="active tab-pane" id="settings">
                    <form class="form-horizontal" method="post">
                      <div class="form-group row">
                        <label for="username" class="col-sm-2 col-form-label">Username</label>
                        <div class="col-sm-10">
                          <input type="text" class="form-control" id="username" value="<?= htmlspecialchars($user['username']) ?>" disabled>
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="nama_lengkap" class="col-sm-2 col-form-label">Nama Lengkap</label>
                        <div class="col-sm-10">
                          <input type="text" class="form-control" id="nama_lengkap" name="nama_lengkap" value="<?= htmlspecialchars($user['nama_lengkap']) ?>" required>
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="email" class="col-sm-2 col-form-label">Email</label>
                        <div class="col-sm-10">
                          <input type="email" class="form-control" id="email" name="email" value="<?= htmlspecialchars($user['email']) ?>" required>
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="current_password" class="col-sm-2 col-form-label">Password Saat Ini</label>
                        <div class="col-sm-10">
                          <input type="password" class="form-control" id="current_password" name="current_password">
                          <small class="text-muted">Diperlukan jika ingin mengubah password</small>
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="new_password" class="col-sm-2 col-form-label">Password Baru</label>
                        <div class="col-sm-10">
                          <input type="password" class="form-control" id="new_password" name="new_password">
                          <small class="text-muted">Kosongkan jika tidak ingin mengubah password</small>
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="confirm_password" class="col-sm-2 col-form-label">Konfirmasi Password</label>
                        <div class="col-sm-10">
                          <input type="password" class="form-control" id="confirm_password" name="confirm_password">
                        </div>
                      </div>
                      <div class="form-group row">
                        <div class="offset-sm-2 col-sm-10">
                          <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                        </div>
                      </div>
                      </form>
                  </div>
                </div>
              </div>
            </div>
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

