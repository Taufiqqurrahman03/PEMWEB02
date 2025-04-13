<?php

// define("HOST", "localhost");
// define("DBNAME", "dbpuskesmas");
// define("USER", "root");
// define("PASSWORD", "");
// define("CHARSET ", "utf8mb4");
$host = "localhost";
$dbname = "dbpukesmas";
$user = "root";
$password = "";
$charset = "utf8mb4";


// $dsn = "mysql:host=". HOST.";dbname=".DBNAME.";charset=".CHARSET;
$dsn = "mysql:host={$host};dbname={$dbname}; charset={$charset}";

$opt= [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES   => false,
    ];



try {
    $db = new PDO($dsn, $user, $password, $opt);
} catch (\Throwable $e) {
    echo "Conection error: " . $e;
}


 