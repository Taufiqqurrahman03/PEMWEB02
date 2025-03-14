<?php
require_once 'class_nilaimahasiswa.php';

$mhs3 = new NilaiMahasiswa();
$mhs1->nama = "Budi Santoso";
$mhs1->matakuliah = "Pemrograman Web";
$mhs1->nilai_tugas = 85;
$mhs1->nilai_uts = 75;
$mhs1->nilai_uas = 85;


$mhs2 = new NilaiMahasiswa();
$mhs2->nama = "Fauziah Nuraini";
$mhs2->matakuliah = "Dasar-Dasar Pemrograman";
$mhs2->nilai_tugas = 90;
$mhs2->nilai_uts = 60;
$mhs2->nilai_uas = 88;

$mhs3 = new NilaiMahasiswa();
$mhs3->nama = "Bedu Bahlil";
$mhs3->matakuliah = "Tugas Akhir";
$mhs3->nilai_tugas = 60;
$mhs3->nilai_uts = 50;
$mhs3->nilai_uas = 55;

$ar_mahasiswa = [$mhs1, $mhs2, $mhs3];
?>

<h2>Daftar Nilai Mahasiswa</h2>
<table border="1" cellspacing="2" cellpadding="2" width= "100%">
    <thead>
        <tr>
            <th>NO</th><th>Nama</th><th>Mata Kuliah</th><th>Nilai Tugas</th>
            <th>Nilai UTS</th><th>Nilai UAS</th><th>Nilai Akhir</th>
        </tr>
    </thead>


    <tbody>
        <?php
        $no = 1;
        foreach ($ar_mahasiswa as $obj) {
        
        ?>
        <tr>
            <td><?=$no ?></td>
            <td><?=$obj->nama ?></td>
            <td><?=$obj->matakuliah ?></td>
            <td><?=$obj->nilai_tugas ?></td>
            <td><?=$obj->nilai_uts ?></td>
            <td><?=$obj->nilai_uas ?></td>
            <td><?=$obj->getNilaiAkhir();?></td>
            <td><?=$obj->kelulusan();?></td>
        </tr>

        <?php
        $no++;
        }
        ?>
    </tbody>
</table>