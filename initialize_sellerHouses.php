<?php
// Database connection
$host = "localhost";
$dbusername = "apallapolu1";
$dbpassword = "apallapolu1";
$dbname = "apallapolu1";

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $dbusername, $dbpassword);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    // Create table if not exists
    $sql = "CREATE TABLE IF NOT EXISTS sellerHouses (
        id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
        seller_id INT(6) UNSIGNED NOT NULL, 
        address VARCHAR(255) NOT NULL,
        price INT(6) UNSIGNED NOT NULL,
        bed INT(6) UNSIGNED NOT NULL,
        bath INT(6) UNSIGNED NOT NULL,
        sqft INT(6) UNSIGNED NOT NULL,
        image MEDIUMBLOB NOT NULL DEFAULT 'default_image.png',
        FOREIGN KEY (seller_id) REFERENCES account(id)
        )";
    
    $pdo->exec($sql);
} catch(PDOException $e) {
    die("ERROR: Could not connect. " . $e->getMessage());
}
?>
