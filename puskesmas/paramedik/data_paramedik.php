<?php
require_once '../dbkoneksi.php';

$sql = "SELECT p.*, u.nama AS unit FROM paramedik p 
        LEFT JOIN unit_kerja u ON p.unit_kerja_id = u.id";
$rs = $dbh->query($sql);

ob_start();
?>
<a href="form_paramedik.php" class="bg-blue-600 text-white px-4 py-2 rounded">+ Tambah</a>
<table class="w-full mt-4 border border-gray-300">
    <thead class="bg-gray-100">
        <tr>
            <th class="border px-3 py-2">Nama</th>
            <th class="border px-3 py-2">Gender</th>
            <th class="border px-3 py-2">Tgl Lahir</th>
            <th class="border px-3 py-2">Unit</th>
            <th class="border px-3 py-2">Aksi</th>
        </tr>
    </thead>
    <tbody>
    <?php foreach ($rs as $row): ?>
        <tr>
            <td class="border px-3 py-2"><?= $row['nama'] ?></td>
            <td class="border px-3 py-2"><?= $row['gender'] ?></td>
            <td class="border px-3 py-2"><?= $row['tgl_lahir'] ?></td>
            <td class="border px-3 py-2"><?= $row['unit'] ?></td>
            <td class="border px-3 py-2">
                <a href="form_paramedik.php?id=<?= $row['id'] ?>" class="text-blue-500">Edit</a> |
                <a href="proses_paramedik.php?delete=<?= $row['id'] ?>" class="text-red-500" onclick="return confirm('Hapus?')">Hapus</a>
            </td>
        </tr>
    <?php endforeach; ?>
    </tbody>
</table>
<?php
$content = ob_get_clean();
$title = "Data Paramedik";
include '../layout.php';
?>
