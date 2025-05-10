<?php
require_once '../dbkoneksi.php';
// Query untuk mendapatkan data paramedik dan nama unit kerja melalui join
$rs = $dbh->query("SELECT p.*, u.nama as nama_unit 
                   FROM paramedik p 
                   LEFT JOIN unit_kerja u ON p.unit_kerja_id = u.id");

ob_start();
?>

<div class="bg-red-50 p-4 rounded-lg shadow-md">
    <a href="form_paramedik.php" class="bg-red-700 hover:bg-red-800 text-white px-4 py-2 rounded-md shadow-sm transition duration-300 mb-4 inline-block">+ Tambah Paramedik</a>

    <table class="w-full border border-red-200">
        <thead class="bg-red-600 text-white">
            <tr>
                <th class="border border-red-300 px-3 py-2">ID</th>
                <th class="border border-red-300 px-3 py-2">Nama</th>
                <th class="border border-red-300 px-3 py-2">Gender</th>
                <th class="border border-red-300 px-3 py-2">Kategori</th>
                <th class="border border-red-300 px-3 py-2">Tempat/Tgl Lahir</th>
                <th class="border border-red-300 px-3 py-2">Telepon</th>
                <th class="border border-red-300 px-3 py-2">Unit Kerja</th>
                <th class="border border-red-300 px-3 py-2">Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($rs as $row): ?>
            <tr class="hover:bg-red-100 transition duration-200">
                <td class="border border-red-200 px-3 py-2"><?= $row['id'] ?></td>
                <td class="border border-red-200 px-3 py-2"><?= $row['nama'] ?></td>
                <td class="border border-red-200 px-3 py-2">
                    <?= $row['gender'] == 'L' ? 'Laki-laki' : 'Perempuan' ?>
                </td>
                <td class="border border-red-200 px-3 py-2"><?= ucfirst($row['kategori']) ?></td>
                <td class="border border-red-200 px-3 py-2">
                    <?= $row['tmp_lahir'] ?>, <?= date('d-m-Y', strtotime($row['tgl_lahir'])) ?>
                </td>
                <td class="border border-red-200 px-3 py-2"><?= $row['telpon'] ?></td>
                <td class="border border-red-200 px-3 py-2"><?= $row['nama_unit'] ?? '-' ?></td>
                <td class="border border-red-200 px-3 py-2">
                    <a href="form_paramedik.php?id=<?= $row['id'] ?>" class="inline-block bg-yellow-500 hover:bg-yellow-600 text-white px-2 py-1 rounded-md text-sm shadow-sm transition duration-200">Edit</a> |
                    <a href="proses_paramedik.php?delete=<?= $row['id'] ?>" class="inline-block bg-red-600 hover:bg-red-700 text-white px-2 py-1 rounded-md text-sm shadow-sm transition duration-200" onclick="return confirm('Hapus data paramedik ini?')">Hapus</a>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

<?php
$content = ob_get_clean();
$title = "Data Paramedik";
include '../layout.php';
?>