<?php
require "./dbkoneksi.php";

// Inisialisasi variabel untuk menampung data periksa
$periksa = [
    'tanggal' => date('Y-m-d'),
    'pasien_id' => '',
    'dokter_id' => '',
    'keluhan' => '',
    'tensi' => '',
    'berat' => '',
    'tinggi' => ''
];

// Cek apakah id ada di parameter URL
$id = $_GET['id'] ?? null;
$proses = $id ? "ubah" : "simpan";

// Jika ada id, ambil data pemeriksaan dari database
if ($id) {
    try {
        $query_periksa = $db->prepare("SELECT * FROM periksa WHERE id = ?");
        $query_periksa->execute([$id]);
        $result = $query_periksa->fetch();
        
        if ($result) {
            $periksa = $result;
        } else {
            // Jika data tidak ditemukan, redirect ke halaman list
            header("Location: list-periksa.php");
            exit;
        }
    } catch (\Throwable $e) {
        $error = "Error: " . $e->getMessage();
    }
}

// Query untuk mendapatkan daftar pasien
try {
    $query_pasien = $db->query("SELECT id, kode, nama FROM pasien ORDER BY nama");
    $pasien_list = $query_pasien->fetchAll();
} catch (\Throwable $e) {
    $error = "Error mengambil data pasien: " . $e->getMessage();
    $pasien_list = [];
}

// Query untuk mendapatkan daftar dokter
try {
    $query_dokter = $db->query("SELECT id, kode, nama FROM dokter ORDER BY nama");
    $dokter_list = $query_dokter->fetchAll();
} catch (\Throwable $e) {
    $error = "Error mengambil data dokter: " . $e->getMessage();
    $dokter_list = [];
}

$title = ($id ? "Edit" : "Tambah") . " Pemeriksaan";
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
            <h1 class="h3 mb-4 text-gray-800"><?= $id ? 'Edit' : 'Tambah' ?> Pemeriksaan</h1>

            <!-- Notification for debugging -->
            <?php if (isset($error)): ?>
            <div class="alert alert-danger">
                <?= $error ?>
            </div>
            <?php endif; ?>

            <!-- Periksa apakah ada data pasien dan dokter -->
            <?php if (empty($pasien_list)): ?>
            <div class="alert alert-warning">
                Tidak ada data pasien. <a href="form-pasien.php" class="alert-link">Tambahkan pasien terlebih dahulu</a>.
            </div>
            <?php endif; ?>

            <?php if (empty($dokter_list)): ?>
            <div class="alert alert-warning">
                Tidak ada data dokter. Tambahkan dokter terlebih dahulu.
            </div>
            <?php endif; ?>

            <!-- form pemeriksaan -->
            <form action="proses-periksa.php" method="post">
                <?php if ($id): ?>
                    <input type="hidden" name="id" value="<?= $id ?>">
                <?php endif; ?>
                
                <div class="form-group row">
                    <label for="tanggal" class="col-4 col-form-label">Tanggal</label>
                    <div class="col-8">
                        <input id="tanggal" name="tanggal" type="date" class="form-control" required
                               value="<?= $periksa['tanggal'] ?? date('Y-m-d') ?>">
                    </div>
                </div>
                
                <div class="form-group row">
                    <label for="pasien_id" class="col-4 col-form-label">Pasien</label>
                    <div class="col-8">
                        <select id="pasien_id" name="pasien_id" class="custom-select" required <?= empty($pasien_list) ? 'disabled' : '' ?>>
                            <option value="">Pilih Pasien</option>
                            <?php foreach ($pasien_list as $pasien): ?>
                                <option value="<?= $pasien['id'] ?>" <?= ($periksa['pasien_id'] ?? '') == $pasien['id'] ? 'selected' : '' ?>>
                                    <?= $pasien['kode'] ?> - <?= $pasien['nama'] ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>
                
                <div class="form-group row">
                    <label for="dokter_id" class="col-4 col-form-label">Dokter</label>
                    <div class="col-8">
                        <select id="dokter_id" name="dokter_id" class="custom-select" required <?= empty($dokter_list) ? 'disabled' : '' ?>>
                            <option value="">Pilih Dokter</option>
                            <?php foreach ($dokter_list as $dokter): ?>
                                <option value="<?= $dokter['id'] ?>" <?= ($periksa['dokter_id'] ?? '') == $dokter['id'] ? 'selected' : '' ?>>
                                    <?= $dokter['kode'] ?> - <?= $dokter['nama'] ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>
                
                <div class="form-group row">
                    <label for="keluhan" class="col-4 col-form-label">Keluhan</label>
                    <div class="col-8">
                        <textarea id="keluhan" name="keluhan" class="form-control" rows="3" required><?= $periksa['keluhan'] ?? '' ?></textarea>
                    </div>
                </div>
                
                <div class="form-group row">
                    <label for="tensi" class="col-4 col-form-label">Tensi</label>
                    <div class="col-8">
                        <input id="tensi" name="tensi" type="text" class="form-control" required
                               placeholder="Contoh: 120/80" value="<?= $periksa['tensi'] ?? '' ?>">
                    </div>
                </div>
                
                <div class="form-group row">
                    <label for="berat" class="col-4 col-form-label">Berat (kg)</label>
                    <div class="col-8">
                        <input id="berat" name="berat" type="number" step="0.1" min="0" class="form-control" required
                               value="<?= $periksa['berat'] ?? '' ?>">
                    </div>
                </div>
                
                <div class="form-group row">
                    <label for="tinggi" class="col-4 col-form-label">Tinggi (cm)</label>
                    <div class="col-8">
                        <input id="tinggi" name="tinggi" type="number" step="0.1" min="0" class="form-control" required
                               value="<?= $periksa['tinggi'] ?? '' ?>">
                    </div>
                </div>

                <div class="form-group row">
                    <div class="offset-4 col-8">
                        <input name="submit" type="submit" class="btn btn-primary" value="<?= $proses ?>" <?= (empty($pasien_list) || empty($dokter_list)) ? 'disabled' : '' ?>>
                        <a href="list-periksa.php" class="btn btn-secondary">Batal</a>
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