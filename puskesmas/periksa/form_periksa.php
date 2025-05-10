<?php
require_once '../dbkoneksi.php';

$id = $_GET['id'] ?? '';
$row = [];

if ($id) {
    $stmt = $dbh->prepare("SELECT * FROM periksa WHERE id=?");
    $stmt->execute([$id]);
    $row = $stmt->fetch();
}

$pasien = $dbh->query("SELECT * FROM pasien");
$dokter = $dbh->query("SELECT * FROM paramedik");

ob_start();
?>
<div class="bg-red-50 p-6 rounded-lg shadow-md">
    <form action="proses_periksa.php" method="POST" class="space-y-4">
        <input type="hidden" name="id" value="<?= $row['id'] ?? '' ?>">

        <div>
            <label class="block text-red-800 font-medium">Tanggal</label>
            <input type="date" name="tanggal" value="<?= $row['tanggal'] ?? '' ?>" class="w-full border border-red-300 px-3 py-2 rounded-md focus:ring-2 focus:ring-red-500 focus:border-red-500">
        </div>
        <div>
            <label class="block text-red-800 font-medium">Pasien</label>
            <select name="pasien_id" class="w-full border border-red-300 px-3 py-2 rounded-md focus:ring-2 focus:ring-red-500 focus:border-red-500">
                <?php foreach ($pasien as $p): 
                    $sel = ($row['pasien_id'] ?? '') == $p['id'] ? 'selected' : '';
                    echo "<option value='{$p['id']}' $sel>{$p['nama']}</option>";
                endforeach; ?>
            </select>
        </div>
        <div>
            <label class="block text-red-800 font-medium">Dokter</label>
            <select name="dokter_id" class="w-full border border-red-300 px-3 py-2 rounded-md focus:ring-2 focus:ring-red-500 focus:border-red-500">
                <?php foreach ($dokter as $d): 
                    $sel = ($row['dokter_id'] ?? '') == $d['id'] ? 'selected' : '';
                    echo "<option value='{$d['id']}' $sel>{$d['nama']}</option>";
                endforeach; ?>
            </select>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
            <div>
                <label class="block text-red-800 font-medium">Tensi</label>
                <input type="text" name="tensi" value="<?= $row['tensi'] ?? '' ?>" class="w-full border border-red-300 px-3 py-2 rounded-md focus:ring-2 focus:ring-red-500 focus:border-red-500">
            </div>
            <div>
                <label class="block text-red-800 font-medium">Berat (kg)</label>
                <input type="number" step="0.1" name="berat" value="<?= $row['berat'] ?? '' ?>" class="w-full border border-red-300 px-3 py-2 rounded-md focus:ring-2 focus:ring-red-500 focus:border-red-500">
            </div>
            <div>
                <label class="block text-red-800 font-medium">Tinggi (cm)</label>
                <input type="number" step="0.1" name="tinggi" value="<?= $row['tinggi'] ?? '' ?>" class="w-full border border-red-300 px-3 py-2 rounded-md focus:ring-2 focus:ring-red-500 focus:border-red-500">
            </div>
        </div>
        <div>
            <label class="block text-red-800 font-medium">Keterangan</label>
            <textarea name="keterangan" class="w-full border border-red-300 px-3 py-2 rounded-md focus:ring-2 focus:ring-red-500 focus:border-red-500"><?= $row['keterangan'] ?? '' ?></textarea>
        </div>

        <div class="pt-4">
            <button type="submit" name="proses" value="simpan" class="bg-red-700 hover:bg-red-800 text-white px-4 py-2 rounded-md shadow-sm transition duration-300">Simpan</button>
            <a href="data_periksa.php" class="ml-2 bg-gray-100 hover:bg-gray-200 text-red-800 px-4 py-2 rounded-md shadow-sm transition duration-300">Kembali</a>
        </div>
    </form>
</div>
<?php
$content = ob_get_clean();
$title = $id ? "Edit Pemeriksaan" : "Tambah Pemeriksaan";
include '../layout.php';
?>