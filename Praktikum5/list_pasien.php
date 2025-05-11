<?php
require_once 'db_koneksi.php';  // Mengimpor file koneksi database

// Buat Query SQL untuk mengambil data pasien
$sql = "SELECT * FROM pasien";

// Eksekusi Query SQL
$rs = $dbh->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Pasien</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css"> <!-- Bootstrap -->
</head>
<body>

<div class="container mt-4">
    <h2 class="text-center">Daftar Pasien</h2>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th width="10%">No</th>
                <th>Kode</th>
                <th>Nama Pasien</th>
                <th>Alamat</th>
                <th>Email</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $nomor = 1;  // Variabel untuk nomor urut
            // Looping data dari hasil query dan menampilkan dalam tabel
            foreach ($rs as $row) {
                echo "<tr>";
                echo "<td>" . $nomor++ . "</td>";
                echo "<td>" . $row->kode . "</td>";     // Akses properti sebagai objek
                echo "<td>" . $row->nama . "</td>";
                echo "<td>" . $row->alamat . "</td>";
                echo "<td>" . $row->email . "</td>";
                echo "</tr>";
            }
            ?>
        </tbody>
    </table>
</div>

</body>
</html>
