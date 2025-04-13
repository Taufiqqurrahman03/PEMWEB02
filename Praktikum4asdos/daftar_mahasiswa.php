<?php
require_once 'class_mahasiswa.php';

// Membuat objek mahasiswa
$mhs1 = new Mahasiswa("02011", "Faiz Fikri", "Teknik Informatika", 2012, 3.8);
$mhs2 = new Mahasiswa("02012", "Alisa Kharunisa", "Teknik Informatika", 2012, 3.9);
$mhs3 = new Mahasiswa("01011", "Rosalle Naurah", "Sistem Informasi", 2010, 3.46);
$mhs4 = new Mahasiswa("01012", "Defghi Muhammad", "Sistem Informasi", 2010, 3.2);

// Memasukkan semua objek ke dalam array
$ar_mahasiswa = [$mhs1, $mhs2, $mhs3, $mhs4];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Mahasiswa</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-4">
        <h2 class="text-center">Daftar Mahasiswa</h2>
        <table class="table table-bordered">
            <thead class="table-dark">
                <tr>
                    <th scope="col">NO</th>
                    <th scope="col">NIM</th>
                    <th scope="col">Nama</th>
                    <th scope="col">Prodi</th>
                    <th scope="col">Angkatan</th>
                    <th scope="col">IPK</th>
                    <th scope="col">Predikat</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $no = 1;
                foreach ($ar_mahasiswa as $mhs) {
                    echo "<tr>
                        <td>{$no}</td>
                        <td>{$mhs->nim}</td>
                        <td>{$mhs->nama}</td>
                        <td>{$mhs->prodi}</td>
                        <td>{$mhs->thn_angkatan}</td>
                        <td>{$mhs->ipk}</td>
                        <td><span class='badge bg-success'>{$mhs->predikat_ipk()}</span></td>
                    </tr>";
                    $no++;
                }
                ?>
            </tbody>
        </table>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
