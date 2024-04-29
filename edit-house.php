<?php
session_start();

if (!isset($_SESSION["user_id"])) {
    header("location: logout.php");
    exit;
}

include "initialize_sellerHouses.php";

if (isset($_GET['id'])) {
    $houseId = $_GET['id'];
    $stmt = $pdo->prepare("SELECT * FROM sellerHouses WHERE id = :house_id AND seller_id = :seller_id");
    $stmt->bindParam(":house_id", $houseId);
    $stmt->bindParam(":seller_id", $_SESSION["user_id"]);
    $stmt->execute();
    $house = $stmt->fetch(PDO::FETCH_ASSOC);
    unset($stmt);
}

unset($pdo);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit House - HomeNest</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <main>
        <div class="popup" style="display:block;">
            <div class="popup-content" style="display:block;">
            <h2>Edit House Details</h2>
            <form action="update-house.php" method="post">
                <input type="hidden" name="house_id" value="<?php echo $house['id']; ?>">
                <div class="form-group">
                    <label for="address">Address:</label>
                    <input type="text" id="address" name="address" value="<?php echo $house['address']; ?>" required>
                </div>
                <div class="form-group">
                    <label for="price">Price:</label>
                    <input type="number" id="price" name="price" step="0.01" value="<?php echo $house['price']; ?>" required>
                </div>
                <div class="form-group">
                    <label for="bedrooms">Number of Bedrooms:</label>
                    <input type="number" id="bedrooms" name="bedrooms" value="<?php echo $house['bedrooms']; ?>" required>
                </div>
                <div class="form-group">
                    <label for="bathrooms">Number of Bathrooms:</label>
                    <input type="number" id="bathrooms" name="bathrooms" value="<?php echo $house['bathrooms']; ?>" required>
                </div>
                <div class="form-group">
                    <label for="site_sqft">Site Square Footage:</label>
                    <input type="number" id="site_sqft" name="site_sqft" value="<?php echo $house['site_sqft']; ?>" required>
                </div>
                <div class="form-group">
                    <label for="age">Age of Property:</label>
                    <input type="number" id="age" name="age" value="<?php echo $house['age']; ?>" required>
                </div>
                <div class="form-group">
                    <label for="garden">Garden:</label>
                    <select id="garden" name="garden" required>
                        <option value="1" <?php if ($house['garden'] == 1) echo "selected"; ?>>Has Garden</option>
                        <option value="0" <?php if ($house['garden'] == 0) echo "selected"; ?>>No Garden</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="parking">Parking:</label>
                    <select id="parking" name="parking" required>
                        <option value="1" <?php if ($house['parking'] == 1) echo "selected"; ?>>Has Parking</option>
                        <option value="0" <?php if ($house['parking'] == 0) echo "selected"; ?>>No Parking</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="proximity_facilities">Proximity to Nearby Facilities:</label>
                    <input type="text" id="proximity_facilities" name="proximity_facilities" value="<?php echo $house['proximity_facilities']; ?>" placeholder="Nearby Facilities (Optional)">
                </div>
                <div class="form-group">
                    <label for="proximity_roads">Proximity to Main Roads:</label>
                    <input type="text" id="proximity_roads" name="proximity_roads" value="<?php echo $house['proximity_roads']; ?>" placeholder="Main Roads (Optional)">
                </div>
                <button type="reset">Undo Changes</button>
                <button type="submit">Save Changes</button>
            </form>
            </div>

        </div>
    </main>
</body>
</html>