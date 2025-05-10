<?php
require_once './dbkoneksi.php'; 

// Query database untuk mendapatkan data periksa dengan join ke pasien dan dokter
$query = $db->query("
    SELECT p.*, 
           ps.nama as nama_pasien, 
           d.nama as nama_dokter 
    FROM periksa p
    LEFT JOIN pasien ps ON p.pasien_id = ps.id
    LEFT JOIN dokter d ON p.dokter_id = d.id
    ORDER BY p.tanggal DESC
");

$title = "Daftar Pemeriksaan";
require_once './template/top.php';
?>
        <!-- Sidebar -->
        <?php
        require_once './template/sidebar.php';
        ?>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <?php
                require_once './template/topbar.php';
                ?>
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <h1 class="h3 mb-4 text-gray-800">Halaman List Pemeriksaan</h1>

                    <!-- Notification for debugging -->
                    <?php if (isset($error)): ?>
                    <div class="alert alert-danger">
                        <?= $error ?>
                    </div>
                    <?php endif; ?>

                    <!--card daftar pemeriksaan-->
                    <div class="card">
                        <div class="card-header">
                            <a href="form-periksa.php" class="btn btn-primary">
                                <i class="fas fa-plus"></i> Tambah Pemeriksaan
                            </a>
                        </div>
                        <div class="card-body">
                        <?php
                        $data = $query->fetchAll();
                        if (count($data) > 0): ?>
                            <table class="table">
                                <thead>
                                <tr>
                                    <th scope="col">Tanggal</th>
                                    <th scope="col">Pasien</th>
                                    <th scope="col">Dokter</th>
                                    <th scope="col">Keluhan</th>
                                    <th scope="col">Tensi</th>
                                    <th scope="col">Berat</th>
                                    <th scope="col">Tinggi</th>
                                    <th scope="col">Aksi</th>
                                </tr>  
                                </thead>
                                <tbody>
                                <?php
                                foreach($data as $periksa) :  
                                ?>
                                <tr>
                                    <td><?= date('d/m/Y', strtotime($periksa['tanggal'])) ?></td>    
                                    <td><?= $periksa['nama_pasien'] ?></td>
                                    <td><?= $periksa['nama_dokter'] ?></td>
                                    <td><?= $periksa['keluhan'] ?></td>
                                    <td><?= $periksa['tensi'] ?></td>
                                    <td><?= $periksa['berat'] ?> kg</td>
                                    <td><?= $periksa['tinggi'] ?> cm</td>
                                    <td class="d-flex">
                                        <a href="form-periksa.php?id=<?= $periksa['id'] ?>" class="btn btn-sm btn-outline-warning mr-2">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <form action="proses-periksa.php" method="post">
                                            <input type="hidden" name="id" value="<?= $periksa['id'] ?>">
                                            <button class="btn btn-sm btn-outline-danger" type="submit" name="submit" value="Hapus" onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                                <?php
                                endforeach;
                                ?> 
                                </tbody>  
                            </table>
                        <?php else: ?>
                            <div class="alert alert-info">
                                Belum ada data pemeriksaan. Silakan tambahkan data baru dengan mengklik tombol "Tambah Pemeriksaan".
                            </div>
                        <?php endif; ?>
                        </div>
                    </div>

                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

            <!-- Footer -->
            <?php
            require_once './template/footer.php';
            ?>
            <!-- End of Footer -->

        </div>
        <!-- End of Content Wrapper -->
         
        <?php
        require_once './template/bottom.php';
        ?>