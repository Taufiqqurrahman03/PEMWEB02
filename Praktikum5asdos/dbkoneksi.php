<?php 
// Variabel untuk koneksi database
$host = "localhost";
$dbname = "dbklinik";
$username = "root";
$password = "";
$charset = "utf8mb4";

$dsn = "mysql:host=$host;dbname=$dbname;charset=$charset";

$opt = [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES => false,
];

try {
    $db = new PDO($dsn, $username, $password, $opt);
    echo "Database connected.";
} catch (\Throwable $th) {
    echo "Database conection error: " . $th;
    
}