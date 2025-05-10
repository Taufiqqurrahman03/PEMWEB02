<?php
require_once '../dbkoneksi.php';

$sql = "SELECT pr.*, pa.nama AS nama_pasien, pm.nama AS nama_dokter
        FROM periksa pr
        JOIN pasien pa ON pr.pasien_id = pa.id
        JOIN paramedik pm ON pr.dokter_id = pm.id";
$rs = $dbh->query($sql);

ob_start();
?>
<div class="bg-red-50 p-4 rounded-lg shadow-md">
    <a href="form_periksa.php" class="bg-red-700 hover:bg-red-800 text-white px-4 py-2 rounded-md shadow-sm transition duration-300">+ Tambah</a>
    <table class="w-full mt-4 border border-red-200">
        <thead class="bg-red-600 text-white">
            <tr>
                <th class="border border-red-300 px-3 py-2">Tanggal</th>
                <th class="border border-red-300 px-3 py-2">Pasien</th>
                <th class="border border-red-300 px-3 py-2">Dokter</th>
                <th class="border border-red-300 px-3 py-2">Tensi</th>
                <th class="border border-red-300 px-3 py-2">Berat</th>
                <th class="border border-red-300 px-3 py-2">Tinggi</th>
                <th class="border border-red-300 px-3 py-2">Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($rs as $row): ?>
            <tr class="hover:bg-red-100 transition duration-200">
                <td class="border border-red-200 px-3 py-2"><?= $row['tanggal'] ?></td>
                <td class="border border-red-200 px-3 py-2"><?= $row['nama_pasien'] ?></td>
                <td class="border border-red-200 px-3 py-2"><?= $row['nama_dokter'] ?></td>
                <td class="border border-red-200 px-3 py-2"><?= $row['tensi'] ?></td>
                <td class="border border-red-200 px-3 py-2"><?= $row['berat'] ?> kg</td>
                <td class="border border-red-200 px-3 py-2"><?= $row['tinggi'] ?> cm</td>
                <td class="border border-red-200 px-3 py-2">
                    <a href="form_periksa.php?id=<?= $row['id'] ?>" class="inline-block bg-yellow-500 hover:bg-yellow-600 text-white px-2 py-1 rounded-md text-sm shadow-sm transition duration-200">Edit</a> |
                    <a href="proses_periksa.php?delete=<?= $row['id'] ?>" class="inline-block bg-red-600 hover:bg-red-700 text-white px-2 py-1 rounded-md text-sm shadow-sm transition duration-200" onclick="return confirm('Hapus?')">Hapus</a>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>
<?php
$content = ob_get_clean();
$title = "Data Periksa";
include '../layout.php';
?>