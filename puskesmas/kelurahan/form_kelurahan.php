<?php
require_once '../dbkoneksi.php';
$id = $_GET['id'] ?? '';
$row = [];

if ($id) {
    $stmt = $dbh->prepare("SELECT * FROM kelurahan WHERE id = ?");
    $stmt->execute([$id]);
    $row = $stmt->fetch();
}

ob_start();
?>

<div class="bg-red-50 p-6 rounded-lg shadow-md">
    <form method="POST" action="proses_kelurahan.php" class="space-y-4">
        <input type="hidden" name="id" value="<?= $row['id'] ?? '' ?>">

        <div>
            <label class="block text-red-800 font-medium">Nama Kelurahan</label>
            <input name="nama" type="text" value="<?= $row['nama'] ?? '' ?>" class="w-full border border-red-300 px-3 py-2 rounded-md focus:ring-2 focus:ring-red-500 focus:border-red-500" required>
        </div>

        <div>
            <label class="block text-red-800 font-medium">ID Kecamatan</label>
            <input name="kec_id" type="number" value="<?= $row['kec_id'] ?? '' ?>" class="w-full border border-red-300 px-3 py-2 rounded-md focus:ring-2 focus:ring-red-500 focus:border-red-500" required>
        </div>

        <div class="pt-4">
            <button type="submit" name="proses" value="simpan" class="bg-red-700 hover:bg-red-800 text-white px-4 py-2 rounded-md shadow-sm transition duration-300">Simpan</button>
            <a href="data_kelurahan.php" class="ml-2 bg-gray-100 hover:bg-gray-200 text-red-800 px-4 py-2 rounded-md shadow-sm transition duration-300">Kembali</a>
        </div>
    </form>
</div>

<?php
$content = ob_get_clean();
$title = $id ? "Edit Kelurahan" : "Tambah Kelurahan";
include '../layout.php';
?>