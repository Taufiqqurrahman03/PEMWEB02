<?php
// sertakan pustaka program koneksi
require 'dbkoneksi.php';

// ambil data dari form
if (isset($_POST["submit"])) {

    // tangkap data dari form dengan aman
    $id = $_POST['id'] ?? null;
    $nama = $_POST['nama'] ?? '';
    $gender = $_POST['gender'] ?? '';
    $tgl_lahir = $_POST['tgl_lahir'] ?? '';
    $unit = $_POST['unit'] ?? '';
    
    // Validasi data
    $errors = [];
    
    if (empty($nama)) {
        $errors[] = "Nama tidak boleh kosong";
    }
    
    if (empty($gender)) {
        $errors[] = "Gender harus dipilih";
    }
    
    if (empty($tgl_lahir)) {
        $errors[] = "Tanggal lahir tidak boleh kosong";
    }
    
    if (empty($unit)) {
        $errors[] = "Unit tidak boleh kosong";
    }
    
    // Jika ada error, tampilkan pesan error
    if (!empty($errors)) {
        echo "<div style='padding: 20px; background-color: #f8d7da; color: #721c24; margin-bottom: 20px;'>";
        echo "<h4>Terjadi kesalahan:</h4>";
        echo "<ul>";
        foreach ($errors as $error) {
            echo "<li>" . htmlspecialchars($error) . "</li>";
        }
        echo "</ul>";
        echo "<p><a href='javascript:history.back()'>Kembali</a></p>";
        echo "</div>";
        exit;
    }
    
    switch ($_POST['submit']) {
        case 'simpan':
            // proses insert ke database 
            try {
                $sql = "INSERT INTO paramedik (nama, gender, tgl_lahir, unit) 
                        VALUES (?, ?, ?, ?)";
                $stmt = $db->prepare($sql);
                $stmt->execute([$nama, $gender, $tgl_lahir, $unit]);

                header("Location: list-paramedik.php");
                exit;
            } catch (\Throwable $e) {
                echo "<div style='padding: 20px; background-color: #f8d7da; color: #721c24; margin-bottom: 20px;'>";
                echo "<h4>Error while insert data paramedik:</h4>";
                echo "<p>" . $e->getMessage() . "</p>";
                echo "<p><a href='javascript:history.back()'>Kembali</a></p>";
                echo "</div>";
                exit;
            }
            break;

        case 'ubah':
            // proses update ke database
            try {
                $sql = "UPDATE paramedik 
                        SET nama = ?, gender = ?, tgl_lahir = ?, unit = ? 
                        WHERE id = ?";
                $stmt = $db->prepare($sql);
                $stmt->execute([$nama, $gender, $tgl_lahir, $unit, $id]);

                header("Location: list-paramedik.php");
                exit;
            } catch (\Throwable $e) {
                echo "<div style='padding: 20px; background-color: #f8d7da; color: #721c24; margin-bottom: 20px;'>";
                echo "<h4>Error while update data paramedik:</h4>";
                echo "<p>" . $e->getMessage() . "</p>";
                echo "<p><a href='javascript:history.back()'>Kembali</a></p>";
                echo "</div>";
                exit;
            }
            break;

        case 'Hapus':
            // proses hapus
            try {
                $sql = "DELETE FROM paramedik WHERE id = ?";
                $stmt = $db->prepare($sql);
                $stmt->execute([$id]);
        
                header("Location: list-paramedik.php");
                exit;
            } catch (\Throwable $e) {
                echo "<div style='padding: 20px; background-color: #f8d7da; color: #721c24; margin-bottom: 20px;'>";
                echo "<h4>Error while delete data paramedik:</h4>";
                echo "<p>" . $e->getMessage() . "</p>";
                echo "<p><a href='javascript:history.back()'>Kembali</a></p>";
                echo "</div>";
                exit;
            }
            break;
            
        default:
            header("Location: list-paramedik.php");
            exit;
    }
} else {
    // Jika tidak ada data yang dikirim, redirect ke halaman list
    header("Location: list-paramedik.php");
    exit;
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