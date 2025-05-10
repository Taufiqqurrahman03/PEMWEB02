<?php
require_once '../dbkoneksi.php';

$id = $_GET['id'] ?? '';
$row = [];

if ($id) {
    $stmt = $dbh->prepare("SELECT * FROM paramedik WHERE id=?");
    $stmt->execute([$id]);
    $row = $stmt->fetch();
}
$units = $dbh->query("SELECT * FROM unit_kerja");

ob_start();
?>
<div class="bg-white rounded-lg shadow-md p-6">
    <h1 class="text-2xl font-bold mb-6 text-primary-700">
        <i class="fas fa-<?= $id ? 'edit' : 'plus' ?>"></i> 
        <?= $id ? 'Edit' : 'Tambah' ?> Paramedik
    </h1>

    <form action="proses_paramedik.php" method="POST" class="space-y-5">
        <input type="hidden" name="id" value="<?= $row['id'] ?? '' ?>">
        
        <div class="mb-4">
            <label class="block text-gray-700 mb-2">Nama</label>
            <input name="nama" type="text" class="w-full border rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-primary-600" 
                   value="<?= $row['nama'] ?? '' ?>" required>
        </div>
        
        <div class="mb-4">
            <label class="block text-gray-700 mb-2">Gender</label>
            <div class="flex gap-4">
                <label class="flex items-center">
                    <input type="radio" name="gender" value="L" <?= ($row['gender'] ?? '') === 'L' ? 'checked' : '' ?> 
                           class="text-primary-600 focus:ring-primary-500" required>
                    <span class="ml-2">Laki-laki</span>
                </label>
                <label class="flex items-center">
                    <input type="radio" name="gender" value="P" <?= ($row['gender'] ?? '') === 'P' ? 'checked' : '' ?> 
                           class="text-primary-600 focus:ring-primary-500">
                    <span class="ml-2">Perempuan</span>
                </label>
            </div>
        </div>
        
        <div class="mb-4">
            <label class="block text-gray-700 mb-2">Tempat Lahir</label>
            <input name="tmp_lahir" type="text" class="w-full border rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-primary-600" 
                   value="<?= $row['tmp_lahir'] ?? '' ?>" required>
        </div>
        
        <div class="mb-4">
            <label class="block text-gray-700 mb-2">Tanggal Lahir</label>
            <input name="tgl_lahir" type="date" class="w-full border rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-primary-600" 
                   value="<?= $row['tgl_lahir'] ?? '' ?>" required>
        </div>
        
        <div class="mb-4">
            <label class="block text-gray-700 mb-2">Kategori</label>
            <select name="kategori" class="w-full border rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-primary-600" required>
                <option value="">-- Pilih Kategori --</option>
                <option value="dokter" <?= ($row['kategori'] ?? '') === 'dokter' ? 'selected' : '' ?>>Dokter</option>
                <option value="perawat" <?= ($row['kategori'] ?? '') === 'perawat' ? 'selected' : '' ?>>Perawat</option>
                <option value="bidan" <?= ($row['kategori'] ?? '') === 'bidan' ? 'selected' : '' ?>>Bidan</option>
            </select>
        </div>
        
        <div class="mb-4">
            <label class="block text-gray-700 mb-2">Alamat</label>
            <textarea name="alamat" class="w-full border rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-primary-600" 
                      rows="3" required><?= $row['alamat'] ?? '' ?></textarea>
        </div>
        
        <div class="mb-4">
            <label class="block text-gray-700 mb-2">Telepon</label>
            <input name="telpon" type="text" class="w-full border rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-primary-600" 
                   value="<?= $row['telpon'] ?? '' ?>" required>
        </div>
        
        <div class="mb-4">
            <label class="block text-gray-700 mb-2">Unit Kerja</label>
            <select name="unit_kerja_id" class="w-full border rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-primary-600" required>
                <option value="">-- Pilih Unit Kerja --</option>
                <?php foreach ($units as $u): 
                    $sel = ($row['unit_kerja_id'] ?? '') == $u['id'] ? 'selected' : '';
                    echo "<option value='{$u['id']}' $sel>{$u['nama']}</option>";
                endforeach; ?>
            </select>
        </div>
        
        <div class="flex gap-3 pt-3">
            <button type="submit" name="proses" value="simpan" 
                    class="bg-primary-600 hover:bg-primary-700 text-white px-4 py-2 rounded transition duration-200">
                <i class="fas fa-save"></i> Simpan
            </button>
            <a href="data_paramedik.php" 
               class="bg-gray-500 hover:bg-gray-600 text-white px-4 py-2 rounded transition duration-200">
                <i class="fas fa-arrow-left"></i> Kembali
            </a>
        </div>
    </form>
</div>
<?php
$content = ob_get_clean();
$title = $id ? "Edit Paramedik" : "Tambah Paramedik";
include '../layout.php';
?>