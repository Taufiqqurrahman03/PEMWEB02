<?php
//variabel
$nama_depan = "Taufiq";
$nama_belakang = 'Qurrahman';
$umur = 20;
$tb = 167.1;

echo $nama_depan ." ".$nama_belakang;
echo "<br>Nama Saya Adalah $nama_depan $nama_belakang dan saya berumur $umur";

echo "<br /><br />";
//variabel system
echo 'Dokumen root' . $_SERVER
['DOCUMENT_ROOT'];

// Variabel Constanta 
    define('PHI',3,14);

    $r = 8;
    $luas = PHI * $r * 2;
    echo "lingkaran denngan jari-jari {$r}cm memiliki luas {$luas}";
?>