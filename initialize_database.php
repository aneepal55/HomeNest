<?php
$host = "localhost";
$dbusername = "apallapolu1";
$dbpassword = "apallapolu1";
$dbname = "apallapolu1";

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $dbusername, $dbpassword);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    $sql = "CREATE TABLE IF NOT EXISTS account (
        id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
        username VARCHAR(30) NOT NULL,
        name_first VARCHAR(30) NOT NULL,
        name_last VARCHAR(30) NOT NULL,
        email VARCHAR(30) NOT NULL,
        password VARCHAR(255) NOT NULL,
        account_type ENUM('buyer', 'seller', 'admin') NOT NULL
        )";
    
    $pdo->exec($sql);
} catch(PDOException $e) {
    die("ERROR: Could not connect. " . $e->getMessage());
}
?>
