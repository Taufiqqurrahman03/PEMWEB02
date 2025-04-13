<?php
$list_buah = ["pepaya","mangga","pisanng","jambu"];
echo $list_buah[2];

/** 
 * nilai di dalam array masing masing memmiliki sebuah kunci yang di sebut dengan index
 * index dimulai dari 0
*/
 echo $list_buah[2];
 echo "<br>List Berisi ". count($list_buah). " buah";

 // mencetak seluruh niali yang ada di array 
 echo "<ol>";
 foreach ($list_buah as $buah) {
    echo "<li>$buah</li>";
 }
 echo "</ol>";
 //menambahkan nilai array 
 $list_buah[] = "Durian";
 echo "<ol>";
 foreach ($list_buah as $buah) {
    echo "<li>$buah</li>";
 }
 echo "</ol>";

 // menghapus nilai array berdasarkan index
 unset($list_buah[1]);
 echo "<ol>";
 foreach ($list_buah as $buah) {
    echo "<li>$buah</li>";
 }
 echo "</ol>";

 //Menganti nilai array berdasarkan index 
 $list_buah[0] = "Manggis";
 echo "<ol>";
 foreach ($list_buah as $buah) {
    echo "<li>$buah</li>";
 }
 echo "</ol>";
//mencetak seluruh nialai array beserta indexnya 
 echo "<ol>";
 foreach ($list_buah as $index => $buah) {
    echo "<li>$buah</li>";
 }
 echo "</ol>";


?>