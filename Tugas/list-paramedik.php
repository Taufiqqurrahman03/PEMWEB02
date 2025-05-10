<?php
require_once './dbkoneksi.php'; 

// Query database untuk mendapatkan data paramedik
$query = $db->query("SELECT * FROM paramedik");

$title = "Daftar Paramedik";
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
                    <h1 class="h3 mb-4 text-gray-800">Daftar Paramedik</h1>

                    <!-- Notification for debugging -->
                    <?php if (isset($error)): ?>
                    <div class="alert alert-danger">
                        <?= $error ?>
                    </div>
                    <?php endif; ?>

                    <!--card daftar paramedik-->
                    <div class="card">
                        <div class="card-header">
                            <a href="form_paramedik.php" class="btn btn-primary">
                                <i class="fas fa-plus"></i> Tambah Paramedik
                            </a>
                        </div>
                        <div class="card-body">
                        <?php
                        $data = $query->fetchAll();
                        if (count($data) > 0): ?>
                            <table class="table">
                                <thead>
                                <tr>
                                    <th scope="col">Nama</th>
                                    <th scope="col">Gender</th>
                                    <th scope="col">Tgl Lahir</th>
                                    <th scope="col">Unit</th>
                                    <th scope="col">Aksi</th>
                                </tr>  
                                </thead>
                                <tbody>
                                <?php
                                foreach($data as $paramedik) :  
                                ?>
                                <tr>
                                    <td><?= $paramedik['nama'] ?></td>
                                    <td><?= $paramedik['gender'] == "L" ? "Laki-Laki" : "Perempuan" ?></td>
                                    <td><?= date('d/m/Y', strtotime($paramedik['tgl_lahir'])) ?></td>
                                    <td><?= $paramedik['unit'] ?></td>
                                    <td class="d-flex">
                                        <a href="form_paramedik.php?id=<?= $paramedik['id'] ?>" class="btn btn-sm btn-outline-warning mr-2">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <form action="proses_paramedik.php" method="post">
                                            <input type="hidden" name="id" value="<?= $paramedik['id'] ?>">
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
                                Belum ada data paramedik. Silakan tambahkan data baru dengan mengklik tombol "Tambah Paramedik".
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