<?php
// Database connection
$host = "";
$username = "";
$password = "";
$dbname = "";

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    // Create table if not exists
    $sql = "CREATE TABLE IF NOT EXISTS account (
        id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
        name_first VARCHAR(30) NOT NULL,
        name_last VARCHAR(30) NOT NULL,
        email VARCHAR(30) NOT NULL,
        password VARCHAR(30) NOT NULL,
        birthday DATE NOT NULL)";
    
    $pdo->exec($sql);
} catch(PDOException $e) {
    die("ERROR: Could not connect. " . $e->getMessage());
}
?>
