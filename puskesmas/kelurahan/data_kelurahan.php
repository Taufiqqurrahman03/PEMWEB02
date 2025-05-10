<?php
require_once '../dbkoneksi.php';
$rs = $dbh->query("SELECT * FROM kelurahan");

ob_start();
?>

<div class="bg-red-50 p-4 rounded-lg shadow-md">
    <a href="form_kelurahan.php" class="bg-red-700 hover:bg-red-800 text-white px-4 py-2 rounded-md shadow-sm transition duration-300 mb-4 inline-block">+ Tambah Kelurahan</a>

    <table class="w-full border border-red-200">
        <thead class="bg-red-600 text-white">
            <tr>
                <th class="border border-red-300 px-3 py-2">ID</th>
                <th class="border border-red-300 px-3 py-2">Nama Kelurahan</th>
                <th class="border border-red-300 px-3 py-2">Kecamatan ID</th>
                <th class="border border-red-300 px-3 py-2">Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($rs as $row): ?>
            <tr class="hover:bg-red-100 transition duration-200">
                <td class="border border-red-200 px-3 py-2"><?= $row['id'] ?></td>
                <td class="border border-red-200 px-3 py-2"><?= $row['nama'] ?></td>
                <td class="border border-red-200 px-3 py-2"><?= $row['kec_id'] ?></td>
                <td class="border border-red-200 px-3 py-2">
                    <a href="form_kelurahan.php?id=<?= $row['id'] ?>" class="inline-block bg-yellow-500 hover:bg-yellow-600 text-white px-2 py-1 rounded-md text-sm shadow-sm transition duration-200">Edit</a> |
                    <a href="proses_kelurahan.php?delete=<?= $row['id'] ?>" class="inline-block bg-red-600 hover:bg-red-700 text-white px-2 py-1 rounded-md text-sm shadow-sm transition duration-200" onclick="return confirm('Hapus?')">Hapus</a>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

<?php
$content = ob_get_clean();
$title = "Data Kelurahan";
include '../layout.php';
?>