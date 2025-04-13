<!DOCTYPE html>
<?php 
  require_once 'fungsiku.php';
?>
<html>
<head>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css"> 
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body>
<h3>Form Nilai Mahasiswa</h3>
<?php 
    $ar_matkul = [
        'DDP'=>'Dasar-Dasar Pemrograman',
        'WEB1'=>'Pemrograman Web 1',
        'WEB2'=>'Pemrograman Web 2',
        'BASDAT'=>'Basis Data',
        'UI/UX'=>'UI/UX',
        "JARKOM"=>"Jaringan Komputer",
        "SE"=>"Sistem Enterprise",
    ];
?>
<form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
  <div class="form-group row">
    <label for="nama" class="col-4 col-form-label">Nama Lengkap</label> 
    <div class="col-8">
      <div class="input-group">
        <div class="input-group-prepend">
          <div class="input-group-text">
            <i class="fa fa-address-card"></i>
          </div>
        </div> 
        <input id="nama" name="nama" type="text" class="form-control">
      </div>
    </div>
  </div>
  <div class="form-group row">
    <label for="matkul" class="col-4 col-form-label">Mata Kuliah</label> 
    <div class="col-8">
      <select id="matkul" name="matkul" class="custom-select">
        <option value="0">-- Pilih Mata Kuliah --</option>
<?php 
    foreach($ar_matkul as $kode=>$matkul){
        echo "<option value='$kode'>$matkul</option>";
    }
?>
      </select>
    </div>
  </div>
  <div class="form-group row">
    <label for="nilai_uts" class="col-4 col-form-label">Nilai UTS</label> 
    <div class="col-8">
      <input id="nilai_uts" name="nilai_uts" type="text" class="form-control">
    </div>
  </div>
  <div class="form-group row">
    <label for="nilai_uas" class="col-4 col-form-label">Nilai UAS</label> 
    <div class="col-8">
      <input id="nilai_uas" name="nilai_uas" type="text" class="form-control">
    </div>
  </div>
  <div class="form-group row">
    <label for="nilai_tugas" class="col-4 col-form-label">Tugas/Praktikum</label> 
    <div class="col-8">
      <input id="nilai_tugas" name="nilai_tugas" type="text" class="form-control">
    </div>
  </div> 
  <div class="form-group row">
    <div class="offset-4 col-8">
      <button name="submit" type="submit" class="btn btn-primary">Submit</button>
    </div>
  </div>
</form>

<hr>
<?php 
    $_nama = $_POST['nama'];
    $_matkul = $_POST['matkul'];    
    $_nilai_uts = $_POST['nilai_uts'];
    $_nilai_uas = $_POST['nilai_uas'];
    $_nilai_tugas = $_POST['nilai_tugas'];

    if(isset($_nama)){ 
    
    $_nilai_akhir = hitung_nilai($_nilai_uts, $_nilai_uas, $_nilai_tugas);
    $_ket_lulus = kelulusan($_nilai_akhir);
    }
?>
<h3>Hasil Input Data</h3>
Nama Mahasiswa: <?=$_nama ?><br>
Mata Kuliah: <?=$ar_matkul[$_matkul]; ?><br>       
Nilai UTS: <?=$_nilai_uts; ?><br>
Nilai UAS: <?=$_nilai_uas; ?><br>
Nilai Tugas: <?=$_nilai_tugas; ?><br>
Nilai Akhir: <?=$_nilai_akhir; ?><br>
Hasil Kelulusan: <?=$_ket_lulus; ?><br>



<?php 
include_once '../praktikum4/daftar_nilai.php';
?>

</body>
</html>