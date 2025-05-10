<?php
require "./dbkoneksi.php";

// Inisialisasi variabel untuk menampung data paramedik
$paramedik = [
    'nama' => '',
    'gender' => '',
    'tgl_lahir' => '',
    'unit' => ''
];

// Cek apakah id ada di parameter URL
$id = $_GET['id'] ?? null;
$proses = $id ? "ubah" : "simpan";

// Jika ada id, ambil data paramedik dari database
if ($id) {
    try {
        $query_paramedik = $db->prepare("SELECT * FROM paramedik WHERE id = ?");
        $query_paramedik->execute([$id]);
        $result = $query_paramedik->fetch();
        
        if ($result) {
            $paramedik = $result;
        } else {
            // Jika data tidak ditemukan, redirect ke halaman list
            header("Location: list_paramedik.php");
            exit;
        }
    } catch (\Throwable $e) {
        $error = "Error: " . $e->getMessage();
    }
}

$title = ($id ? "Edit" : "Tambah") . " Paramedik";
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
            <h1 class="h3 mb-4 text-gray-800"><?= $id ? 'Edit' : 'Tambah' ?> Paramedik</h1>

            <!-- Notification for debugging -->
            <?php if (isset($error)): ?>
            <div class="alert alert-danger">
                <?= $error ?>
            </div>
            <?php endif; ?>

            <!-- form paramedik -->
            <form action="proses_paramedik.php" method="post">
                <?php if ($id): ?>
                    <input type="hidden" name="id" value="<?= $id ?>">
                <?php endif; ?>
                
                <div class="form-group row">
                    <label for="nama" class="col-4 col-form-label">Nama</label>
                    <div class="col-8">
                        <input id="nama" name="nama" type="text" class="form-control" required
                               value="<?= $paramedik['nama'] ?? '' ?>">
                    </div>
                </div>
                
                <div class="form-group row">
                    <label class="col-4">Gender</label>
                    <div class="col-8">
                        <div class="custom-control custom-radio custom-control-inline">
                            <input name="gender" id="gender_0" type="radio" class="custom-control-input" value="L" required
                                  <?= ($paramedik['gender'] ?? '') == 'L' ? 'checked' : '' ?>>
                            <label for="gender_0" class="custom-control-label">Laki-Laki</label>
                        </div>
                        <div class="custom-control custom-radio custom-control-inline">
                            <input name="gender" id="gender_1" type="radio" class="custom-control-input" value="P" required
                                  <?= ($paramedik['gender'] ?? '') == 'P' ? 'checked' : '' ?>>
                            <label for="gender_1" class="custom-control-label">Perempuan</label>
                        </div>
                    </div>
                </div>
                
                <div class="form-group row">
                    <label for="tgl_lahir" class="col-4 col-form-label">Tanggal Lahir</label>
                    <div class="col-8">
                        <input id="tgl_lahir" name="tgl_lahir" type="date" class="form-control" required
                               value="<?= $paramedik['tgl_lahir'] ?? '' ?>">
                    </div>
                </div>
                
                <div class="form-group row">
                    <label for="unit" class="col-4 col-form-label">Unit</label>
                    <div class="col-8">
                        <input id="unit" name="unit" type="text" class="form-control" required
                               value="<?= $paramedik['unit'] ?? '' ?>">
                    </div>
                </div>
                
                <div class="form-group row">
                    <div class="offset-4 col-8">
                        <input name="submit" type="submit" class="btn btn-primary" value="<?= $proses ?>">
                        <a href="list_paramedik.php" class="btn btn-secondary">Batal</a>
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