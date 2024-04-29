<?php
session_start();

if (!isset($_SESSION["user_id"])) {
    header("location: logout.php");
    exit;
}

include "initialize_sellerHouses.php";

if (isset($_GET['delete']) && $_GET['delete'] === 'true') {
    $house_id = $_GET['house_id'];

    $sql = "DELETE FROM sellerHouses WHERE id = :house_id AND seller_id = :seller_id";

    if ($stmt = $pdo->prepare($sql)) {
        $stmt->bindParam(":house_id", $house_id);
        $stmt->bindParam(":seller_id", $_SESSION["user_id"]);

        if ($stmt->execute()) {
            header("location: seller_dashboard.php");
            exit;
        } else {
            echo "Error deleting house. Please try again.";
        }
    }

    unset($stmt);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $house_id = $_POST['house_id'];
    $address = $_POST["address"];
    $price = number_format($_POST["price"], 2, '.', '');
    $bedrooms = $_POST["bedrooms"];
    $bathrooms = $_POST["bathrooms"];
    $site_sqft = $_POST["site_sqft"];
    $age = $_POST["age"];
    $garden = $_POST["garden"];
    $parking = $_POST["parking"];
    $proximity_facilities = $_POST["proximity_facilities"];
    $proximity_roads = $_POST["proximity_roads"];

    $sql = "UPDATE sellerHouses 
            SET address = :address, 
                price = :price, 
                bedrooms = :bedrooms, 
                bathrooms = :bathrooms, 
                site_sqft = :site_sqft, 
                age = :age, 
                garden = :garden, 
                parking = :parking, 
                proximity_facilities = :proximity_facilities, 
                proximity_roads = :proximity_roads
            WHERE id = :house_id AND seller_id = :seller_id";

    if ($stmt = $pdo->prepare($sql)) {
        $stmt->bindParam(":house_id", $house_id);
        $stmt->bindParam(":seller_id", $_SESSION["user_id"]);
        $stmt->bindParam(":address", $address);
        $stmt->bindParam(":price", $price);
        $stmt->bindParam(":bedrooms", $bedrooms);
        $stmt->bindParam(":bathrooms", $bathrooms);
        $stmt->bindParam(":site_sqft", $site_sqft);
        $stmt->bindParam(":age", $age);
        $stmt->bindParam(":garden", $garden);
        $stmt->bindParam(":parking", $parking);
        $stmt->bindParam(":proximity_facilities", $proximity_facilities);
        $stmt->bindParam(":proximity_roads", $proximity_roads);

        if ($stmt->execute()) {
            header("location: seller_dashboard.php");
            exit;
        } else {
            echo "Error updating house details. Please try again.";
        }
    }

    unset($stmt);
}

header("location: seller_dashboard.php");
exit;
?>
