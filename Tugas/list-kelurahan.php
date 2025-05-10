<?php
require_once './dbkoneksi.php';

// query database
$query = $db->query("SELECT * FROM kelurahan");

$title = "Daftar Kelurahan";
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
                    <h1 class="h3 mb-4 text-gray-800">Halaman list kelurahan </h1>

                    <!--card daftar kelurahan-->
                    <div class="card ">
                        <div class="card-header">
                            <a href="form-kelurahan.php" class="btn btn-primary">
                                <i class="fas fa-plus"></i> Tambah Kelurahan
                            </a>
                        </div>
                        <div class="card-body">
                        
                            <table class="table">
                                <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Nama</th>
                                    <th scope="col">Kecamatan ID</th>
                                    <th scope="col">Aksi</th>
                                </tr>  
                                </thead>
                                <tbody>
                                <?php
                                foreach($query as $idx => $kelurahan) :  
                                ?>
                                <tr>
                                    <td><?= $idx+1 ?></td>    
                                    <td><?= $kelurahan['nama'] ?></td>
                                    <td><?= $kelurahan['kec_id'] ?></td>
                                    <td class="d-flex">
                                        <a href="form-kelurahan.php?id=<?= $kelurahan['id'] ?>" class="btn btn-sm btn-outline-warning mr-2">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <form action="proses-kelurahan.php" method="post">
                                            <input type="hidden" name="id" value="<?= $kelurahan['id'] ?>">
                                            <button class="btn btn-sm btn-outline-danger" type="submit" name="submit" value="Hapus">
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