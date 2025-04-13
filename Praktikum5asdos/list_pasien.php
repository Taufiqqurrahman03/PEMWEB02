<?php
require_once './dbkoneksi.php';


// query data pasien
$list_pasien = $db->query("SELECT * FROM pasien");
?>

<table border="1">
    <thead>
        <tr>
            <th>No</th>
            <th>Kode</th>
            <th>Nama</th>
            <th>Gender</th>
        </tr>
    </thead>

    <tbody>
    <?php foreach ($list_pasien as $idx => $pasien ) { ?>
        <tr> <!-- Tambahkan ini -->
            <td><?= $idx + 1 ?></td>
            <td><?= $pasien['kode'] ?></td>
            <td><?= $pasien['nama'] ?></td>
            <td><?= $pasien['gender'] ?></td>
        </tr> <!-- Dan ini -->
    <?php } ?>
    </tbody>
</table>
