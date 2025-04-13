<?php
require "./dbkoneksi.php";

// query database
$query = $db->query("SELECT * FROM kelurahan");

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
        <?php require_once './template/topbar.php'; ?>
        <!-- End of Topbar -->

        <!-- Begin Page Content -->
        <div class="container-fluid">

            <!-- Page Heading -->
            <h1 class="h3 mb-4 text-gray-800">Tambah Pasien</h1>

            <!-- form pasien -->
            <form action="proses-pasien.php" method="post">
                <div class="form-group row">
                    <label for="kode" class="col-4 col-form-label">Kode</label>
                    <div class="col-8">
                        <input id="kode" name="kode" placeholder=" " type="text" class="form-control" required>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="nama" class="col-4 col-form-label">Nama</label>
                    <div class="col-8">
                        <input id="nama" name="nama" type="text" class="form-control" required>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="tmp_lahir" class="col-4 col-form-label">Tempat Lahir</label>
                    <div class="col-8">
                        <input id="tmp_lahir" name="tmp_lahir" type="text" class="form-control" required>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="tgl_lahir" class="col-4 col-form-label">Tanggal Lahir</label>
                    <div class="col-8">
                        <input id="tgl_lahir" name="tgl_lahir" type="date" class="form-control" required>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-4">Gender</label>
                    <div class="col-8">
                        <div class="custom-control custom-radio custom-control-inline">
                            <input name="gender" id="gender_0" type="radio" class="custom-control-input" value="L" required>
                            <label for="gender_0" class="custom-control-label">Laki-Laki</label>
                        </div>
                        <div class="custom-control custom-radio custom-control-inline">
                            <input name="gender" id="gender_1" type="radio" class="custom-control-input" value="P" required>
                            <label for="gender_1" class="custom-control-label">Perempuan</label>
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="email" class="col-4 col-form-label">Email</label>
                    <div class="col-8">
                        <input id="email" name="email" type="email" class="form-control">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="alamat" class="col-4 col-form-label">Alamat</label>
                    <div class="col-8">
                        <textarea id="alamat" name="alamat" cols="40" rows="5" class="form-control" required></textarea>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="kelurahan_id" class="col-4 col-form-label">Kelurahan</label>
                    <div class="col-8">
                        <select id="kelurahan_id" name="kelurahan_id" class="custom-select" required>
                            <?php foreach ($query as $kelurahan): ?>
                                <option value="<?= $kelurahan['id'] ?>"><?= $kelurahan['nama'] ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="offset-4 col-8">
                        <input name="submit" type="submit" class="btn btn-primary" value="Simpan">
                    </div>
                </div>
            </form>

        </div>
        <!-- /.container-fluid -->

    </div>
    <!-- End of Main Content -->

    <!-- Footer -->
    <?php require_once './template/footer.php'; ?>
    <!-- End of Footer -->

</div>
<!-- End of Content Wrapper -->

<?php require_once './template/bottom.php'; ?>
