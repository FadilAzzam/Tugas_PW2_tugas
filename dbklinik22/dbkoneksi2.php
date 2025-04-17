<?php
// 1) Corrected database connection variables
$host = 'localhost';        // Fixed typo from $hodt to $host
$dbname = "dbpuskesmas";
$username = "root";
$password = "";              // Fixed typo from $pwassword to $password
$charset = "utf8mb4";

// 2) Corrected DSN and database options
$dsn = "mysql:host=$host;dbname=$dbname;charset=$charset"; // Fixed variables and syntax
$options = [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES => false,
];

// 3) Create database connection object
try {
    $dbh = new PDO($dsn, $username, $password, $options);
    echo "Database connected.";
} catch (\Throwable $th) {
    echo "Database connection error: " . $th;
}
?>