
<?php
require_once './dbkoneksi.php'; 

//query database
$query = $db->query("SELECT * FROM pasien") ;

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
                    <h1 class="h3 mb-4 text-gray-800">Halaman List Pasien</h1>

                                        <!--card daftar pasien-->
                                        <div class="card ">
                        <div class="card-body">
                        
                    <table class="table">
                        <thead>
                        <tr>
                            <th scope="col">kode</th>
                            <th scope="col">Nama</th>
                            <th scope="col">Gender</th>
                            <th scope="col">Tempat lahir</th>
                        
                        </tr>  
                        </thead>
                        <tbody>
                         <?php
                        foreach($query as  $pasien) :  
                        ?>
                        <tr>
                            <td><?= $pasien['kode'] ?></td>    
                            <td><?= $pasien['nama'] ?></td>
                            <td><?= $pasien['gender'] == "L" ? "Laki-Laki" : "Perempuan" ?></td>
                            <td><?= $pasien['tmp_lahir'] ?></td>
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

    