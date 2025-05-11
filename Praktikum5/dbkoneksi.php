<?php 
// Variabel untuk koneksi database
$host = "localhost";
$dbname = "dbhospital";
$username = "root";
$password = "";
$charset = "utf8mb4";

// Buat DSN dan opsi akses database
$dsn = "mysql:host=$host;dbname=$dbname;charset=$charset";
$options = [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ,  // Hasil query berupa objek
    PDO::ATTR_EMULATE_PREPARES => false,
];

// Buat objek koneksi ke database 
try {
    $dbh = new PDO($dsn, $username, $password, $options);
} catch (PDOException $e) {
    echo "Koneksi database gagal: " . $e->getMessage();
    exit;
}
?>
