<?php
session_start();

// Check if user is logged in, if not redirect to login page
if (!isset($_SESSION["user_id"])) {
    header("location: logout.php");
    exit;
}

// Include database connection
include "initialize_sellerHouses.php";

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $house_id = $_POST['house_id'];
    $address = $_POST["address"];
    $price = number_format($_POST["price"], 2, '.', ''); // Format the price with 2 decimal places
    $bedrooms = $_POST["bedrooms"];
    $bathrooms = $_POST["bathrooms"];
    $site_sqft = $_POST["site_sqft"];
    $age = $_POST["age"];
    $garden = $_POST["garden"];
    $parking = $_POST["parking"];
    $proximity_facilities = $_POST["proximity_facilities"];
    $proximity_roads = $_POST["proximity_roads"];

    // Prepare SQL statement to update house details
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
        // Bind parameters
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

        // Execute the statement
        if ($stmt->execute()) {
            // House details updated successfully
            header("location: seller_dashboard.php");
            exit;
        } else {
            // Error occurred while updating house details
            echo "Error updating house details. Please try again.";
        }
    }

    // Close statement
    unset($stmt);
}

// Redirect if accessed directly without form submission
header("location: seller_dashboard.php");
exit;
?>
