<?php
$host = 'localhost';
$db = 'dbhospital';
$user = 'root'; // Sesuaikan dengan username MySQL Anda
$pass = ''; // Sesuaikan dengan password MySQL Anda
$charset = 'utf8mb4';

$dsn = "mysql:host=$host;dbname=$db;charset=$charset";
$options = [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES => false,
];

try {
    $dbh = new PDO($dsn, $user, $pass, $options);
} catch (PDOException $e) {
    die("Koneksi database gagal: " . $e->getMessage());
}
?>

