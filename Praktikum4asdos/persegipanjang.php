<?php
class persegipanjang{
    public $panjang;
    public $lebar;

    public function __construct($panjang, $lebar){
        $this->panjang = $panjang;
        $this->lebar = $lebar;

    
}
    public function Hitungluas(){
        return $this->panjang * $this->lebar;
}

    public function Hitungkeliling(){
        return 2 * ($this->panjang + $this->lebar);
}

}
$persegi = new persegipanjang(5, 6);
echo "Luas Persegi Panjang : " . $persegi->Hitungluas() ."<br>";
echo "Keliling Persegi Panjang : " . $persegi->Hitungkeliling();
?>