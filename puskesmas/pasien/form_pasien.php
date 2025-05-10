<?php
require_once '../dbkoneksi.php';

$id = $_GET['id'] ?? '';
$row = [];

if ($id) {
    $stmt = $dbh->prepare("SELECT * FROM pasien WHERE id = ?");
    $stmt->execute([$id]);
    $row = $stmt->fetch();
}

$kelurahan = $dbh->query("SELECT * FROM kelurahan");

ob_start();
?>
<div class="bg-white rounded-lg shadow-md p-6">
    <h1 class="text-2xl font-bold mb-6 text-primary-700">
        <i class="fas fa-<?= $id ? 'edit' : 'plus' ?>"></i> 
        <?= $id ? 'Edit' : 'Tambah' ?> Pasien
    </h1>

    <form method="POST" action="proses_pasien.php" class="space-y-4">
        <input type="hidden" name="id" value="<?= $row['id'] ?? '' ?>">

        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
                <label class="block text-gray-700 mb-2">Kode</label>
                <input name="kode" type="text" value="<?= $row['kode'] ?? '' ?>" 
                       class="w-full border rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-primary-600" required>
            </div>
            
            <div>
                <label class="block text-gray-700 mb-2">Nama</label>
                <input name="nama" type="text" value="<?= $row['nama'] ?? '' ?>" 
                       class="w-full border rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-primary-600" required>
            </div>
            
            <div>
                <label class="block text-gray-700 mb-2">Tempat Lahir</label>
                <input name="tmp_lahir" type="text" value="<?= $row['tmp_lahir'] ?? '' ?>" 
                       class="w-full border rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-primary-600" required>
            </div>
            
            <div>
                <label class="block text-gray-700 mb-2">Tanggal Lahir</label>
                <input name="tgl_lahir" type="date" value="<?= $row['tgl_lahir'] ?? '' ?>" 
                       class="w-full border rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-primary-600" required>
            </div>
            
            <div>
                <label class="block text-gray-700 mb-2">Gender</label>
                <div class="flex gap-4">
                    <label class="flex items-center">
                        <input type="radio" name="gender" value="L" <?= ($row['gender'] ?? '') === 'L' ? 'checked' : '' ?> 
                               class="text-primary-600 focus:ring-primary-500">
                        <span class="ml-2">Laki-laki</span>
                    </label>
                    <label class="flex items-center">
                        <input type="radio" name="gender" value="P" <?= ($row['gender'] ?? '') === 'P' ? 'checked' : '' ?> 
                               class="text-primary-600 focus:ring-primary-500">
                        <span class="ml-2">Perempuan</span>
                    </label>
                </div>
            </div>
            
            <div>
                <label class="block text-gray-700 mb-2">Email</label>
                <input name="email" type="email" value="<?= $row['email'] ?? '' ?>" 
                       class="w-full border rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-primary-600" required>
            </div>
        </div>
        
        <div>
            <label class="block text-gray-700 mb-2">Alamat</label>
            <textarea name="alamat" 
                      class="w-full border rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-primary-600" 
                      rows="3"><?= $row['alamat'] ?? '' ?></textarea>
        </div>
        
        <div>
            <label class="block text-gray-700 mb-2">Kelurahan</label>
            <select name="kelurahan_id" 
                    class="w-full border rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-primary-600" required>
                <option value="">-- Pilih Kelurahan --</option>
                <?php foreach ($kelurahan as $k): 
                    $sel = ($row['kelurahan_id'] ?? '') == $k['id'] ? 'selected' : '';
                    echo "<option value='{$k['id']}' $sel>{$k['nama']}</option>";
                endforeach; ?>
            </select>
        </div>

        <div class="flex gap-3 pt-3">
            <button type="submit" name="proses" value="simpan" 
                    class="bg-primary-600 hover:bg-primary-700 text-white px-4 py-2 rounded transition duration-200">
                <i class="fas fa-save"></i> Simpan
            </button>
            <a href="data_pasien.php" 
               class="bg-gray-500 hover:bg-gray-600 text-white px-4 py-2 rounded transition duration-200">
                <i class="fas fa-arrow-left"></i> Kembali
            </a>
        </div>
    </form>
</div>
<?php
$content = ob_get_clean();
$title = $id ? "Edit Pasien" : "Tambah Pasien";
include '../layout.php';
?>