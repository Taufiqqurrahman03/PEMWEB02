<?php

class NilaiMahasiswa{
    public $nama;
    public $matakuliah;
    public $nilai_tugas;
    public $nilai_uts;
    public $nilai_uas;
    public const PERSENTASE_UTS = 0.25;
    public const PERSENTASE_UAS = 0.3;
    public const PERSENTASE_TUGAS = 0.45;
    public const KKM = 60;
/**
 * kostanta untuk nilai kriteria ketuntasan minimal (KKN)
 */
    public function getNilaiAkhir(){
        $nilai = self::PERSENTASE_UTS * $this->nilai_uts 
        + self::PERSENTASE_UAS * $this->nilai_uas
        + self::PERSENTASE_TUGAS * $this->nilai_tugas;
    return $nilai;
    }

    public function kelulusan(){
        if ($this->getNilaiAkhir() >= self::KKM){
        return "Lulus";
        }else{
        return "Tidak Lulus";
        }
    }


}

?>

