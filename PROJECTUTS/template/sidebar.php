  <!-- Sidebar -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <a href="../dashboard.php" class="brand-link">
      <span class="brand-text font-weight-light ml-3">FASILITAS KESEHATAN</span>
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
            <a href="../profile.php" class="nav-link"><i class="nav-icon fas fa-user"></i><p>Profil</p></a>
          </li>
          <li class="nav-header">DATA MASTER</li>
          <li class="nav-item"><a href="../provinsi/list_provinsi.php" class="nav-link <?= strpos($_SERVER['PHP_SELF'], 'provinsi/') !== false ? 'active' : '' ?>"><i class="nav-icon fas fa-map"></i><p>Data Provinsi</p></a></li>
          <li class="nav-item"><a href="../kabkota/list_kabkota.php" class="nav-link <?= strpos($_SERVER['PHP_SELF'], 'kabkota/') !== false ? 'active' : '' ?>"><i class="nav-icon fas fa-city"></i><p>Data Kabupaten/Kota</p></a></li>
          <li class="nav-item"><a href="../jenis_faskes/list_jenis.php" class="nav-link <?= strpos($_SERVER['PHP_SELF'], 'jenis_faskes/') !== false ? 'active' : '' ?>"><i class="nav-icon fas fa-hospital-symbol"></i><p>Jenis Faskes</p></a></li>
          <li class="nav-item"><a href="../kategori/list_kategori.php" class="nav-link <?= strpos($_SERVER['PHP_SELF'], 'kategori/') !== false ? 'active' : '' ?>"><i class="nav-icon fas fa-tags"></i><p>Kategori</p></a></li>
          <li class="nav-item"><a href="../faskes/list_faskes.php" class="nav-link <?= strpos($_SERVER['PHP_SELF'], 'faskes/') !== false ? 'active' : '' ?>"><i class="nav-icon fas fa-clinic-medical"></i><p>Data Faskes</p></a></li>
          <li class="nav-header">LAPORAN</li>
          <li class="nav-item"><a href="../laporan.php" class="nav-link"><i class="nav-icon fas fa-file-alt"></i><p>Laporan</p></a></li>
        </ul>
      </nav>
    </div>
  </aside>
