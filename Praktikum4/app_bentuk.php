<?php
require_once 'Lingkaran.php';
echo "NILAI PHI" . Lingkaran :: PHI;
$lingkaran1 = new Lingkaran(8.4);
$lingkaran2 = new Lingkaran(20);
echo "Jari-jari LIngkaran1 = " . $lingkaran1->jari;
echo "<br> Nilai PHI = " . $lingkaran1 :: PHI;
echo "<br> Luas Lingkaran1 = " . $lingkaran1->getLuas();
echo "<br> Keliling Lingkaran1 = " . $lingkaran1->getKeliling();
echo "<hr>";
$lingkaran1->cetak();
echo "<hr>";
$lingkaran2->cetak();
?>