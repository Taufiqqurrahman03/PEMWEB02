<?php 
/**
 * Fungsi untuk menghitung nilai akhir
 * @param float $nilai_uts Nilai UTS
 * @param float $nilai_uas Nilai UAS
 * @param float $nilai_tugas Nilai Tugas
 * @return float Nilai Akhir
 */
function hitung_nilai($nilai_uts, $nilai_uas, $nilai_tugas){
    define("UTS", 0.25);
    define("UAS", 0.30);
    define("TUGAS", 0.45);
    return UTS*$nilai_uts + UAS*$nilai_uas + TUGAS*$nilai_tugas;
}

/**
 * Fungsi untuk menentukan kelulusan
 * @param float $nilai_akhir Nilai Akhir
 * @param float $batas_nilai Batas Nilai Kelulusan default 60
 * @return string LULUS atau TIDAK LULUS
 */
function kelulusan($nilai_akhir, $batas_nilai = 60){
    if($nilai_akhir >= $batas_nilai){
        return "LULUS";
    } else {
        return "TIDAK LULUS";
    }
}


?>