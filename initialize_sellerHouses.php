<?php
$host = "localhost";
$dbusername = "apallapolu1";
$dbpassword = "apallapolu1";
$dbname = "apallapolu1";

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $dbusername, $dbpassword);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    $sql = "CREATE TABLE IF NOT EXISTS sellerHouses (
        id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
        seller_id INT(6) UNSIGNED NOT NULL, 
        address VARCHAR(255) NOT NULL,
        price DECIMAL(10, 2) NOT NULL, 
        bedrooms INT(6) UNSIGNED NOT NULL,
        bathrooms INT(6) UNSIGNED NOT NULL,
        site_sqft INT(6) UNSIGNED NOT NULL,
        age INT(6) UNSIGNED NOT NULL,
        garden BOOLEAN NOT NULL,
        parking BOOLEAN NOT NULL,
        proximity_facilities VARCHAR(255) NULL,
        proximity_roads VARCHAR(255) NULL,
        property_tax DECIMAL(10, 2) NOT NULL, 
        image VARCHAR(30) NULL,
        FOREIGN KEY (seller_id) REFERENCES account(id)
        )";
    
    $pdo->exec($sql);
} catch(PDOException $e) {
    die("ERROR: Could not connect. " . $e->getMessage());
}
?>
