<?php
class NilaiMahasiswa {
    // Properti untuk menyimpan data mahasiswa
    public $nama;
    public $matakuliah;
    public $nilai_tugas;
    public $nilai_uts;
    public $nilai_uas;

    // Konstanta bobot nilai
    public const PERSENTASE_UTS = 0.25;
    public const PERSENTASE_UAS = 0.3;
    public const PERSENTASE_TUGAS = 0.45;
    public const KKM = 60; // Kriteria Ketuntasan Minimal

    /**
     * Menghitung nilai akhir berdasarkan bobot nilai tugas, UTS, dan UAS
     */
    public function getNilaiAkhir() {
        $nilai = (self::PERSENTASE_UTS * $this->nilai_uts) + 
                 (self::PERSENTASE_UAS * $this->nilai_uas) + 
                 (self::PERSENTASE_TUGAS * $this->nilai_tugas);
        return number_format($nilai, 2); // Menampilkan nilai dengan 2 angka di belakang koma
    }

    /**
     * Menentukan status kelulusan berdasarkan nilai akhir
     */
    public function kelulusan() {
        return ($this->getNilaiAkhir() >= self::KKM) ? "Lulus" : "Tidak Lulus";
    }
}
?>
