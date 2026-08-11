<?php
$host   = getenv('DB_HOST') ?: 'db';
$port   = getenv('DB_PORT') ?: '5432';
$user   = getenv('DB_USER') ?: 'portal';
$pass   = getenv('DB_PASSWORD') ?: 'portal_pass';
$dbname = getenv('DB_NAME') ?: 'captive_portal';

try {
    $dsn = "pgsql:host={$host};port={$port};dbname={$dbname}";
    $options = [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    ];
    $conn = new PDO($dsn, $user, $pass, $options);
} catch (PDOException $e) {
    die("Koneksi database gagal: " . $e->getMessage());
}
?>
