<?php
$host = 'localhost';        // Host database
$db   = 'dbhospital';    // Ganti dengan nama database Anda
$user = 'root';             // Username database
$pass = '';                 // Password database, biasanya kosong di XAMPP
$charset = 'utf8mb4';       // Charset yang digunakan

$dsn = "mysql:host=$host;dbname=$db;charset=$charset";
$options = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION, // Menangani error dengan exception
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,       // Fetch data sebagai array asosiatif
    PDO::ATTR_EMULATE_PREPARES   => false,                  // Nonaktifkan emulasi prepare
];

try {
    $conn = new PDO($dsn, $user, $pass, $options);
} catch (\PDOException $e) {
    die("Koneksi database gagal: " . $e->getMessage());
}
?>
