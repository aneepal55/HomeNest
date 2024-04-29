<?php
session_start();
// Check if user is logged in, if not redirect to login page
if (!isset($_SESSION["user_id"])) {
    header("location: logout.php");
    exit;
}

error_reporting(E_ALL);
ini_set('display_errors', 1);

include "initialize_sellerHouses.php";

// Query to fetch all houses for the current seller
$stmt = $pdo->prepare("SELECT * FROM sellerHouses WHERE seller_id = :seller_id");
$stmt->bindParam(":seller_id", $_SESSION["user_id"]);
$stmt->execute();
$houses = $stmt->fetchAll(PDO::FETCH_ASSOC);

unset($stmt);
// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
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

    // Calculate property tax (7% of the price)
    $property_tax = $price * 0.07;

    // Prepare an insert statement
    $sql = "INSERT INTO sellerHouses (seller_id, address, price, bedrooms, bathrooms, site_sqft, age, garden, parking, proximity_facilities, proximity_roads, property_tax, image) 
            VALUES (:seller_id, :address, :price, :bedrooms, :bathrooms, :site_sqft, :age, :garden, :parking, :proximity_facilities, :proximity_roads, :property_tax, :image)";

    if($stmt = $pdo->prepare($sql)){
        // Bind variables to the prepared statement as parameters
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
        $stmt->bindParam(":property_tax", $property_tax);

        if (isset($_FILES['house_image']) && $_FILES['house_image']['error'] === UPLOAD_ERR_OK) {
            // Get the file extension
            $file_extension = strtolower(pathinfo($_FILES['house_image']['name'], PATHINFO_EXTENSION));
        
            // Generate a unique file name
            $file_name = uniqid() . '.' . $file_extension;
        
            // Move the uploaded file to the images folder
            $upload_path = 'images/' . $file_name;
            if (move_uploaded_file($_FILES['house_image']['tmp_name'], $upload_path)) {
                // Bind the file name to the prepared statement
                $stmt->bindParam(":image", $file_name);
            } else {
                // Handle the upload error
                echo "Error uploading the image. Please try again.";
                // Bind NULL to the :image parameter
                $null_value = null;
                $stmt->bindValue(":image", $null_value, PDO::PARAM_NULL);
            }
        } else {
            // Bind NULL to the :image parameter if no image was uploaded
            $null_value = null;
            $stmt->bindValue(":image", $null_value, PDO::PARAM_NULL);
        }

        // Attempt to execute the prepared statement
        if($stmt->execute()){
            unset($_POST);
            header("location:seller_dashboard.php");
        } else{
            echo "Oops! Something went wrong. Please try again later.";
        }
    }

    // Close statement
    unset($stmt);
}

unset($_POST);

// Close connection
unset($pdo);

// Assuming $pdo is already initialized and connected to the database
// Query database to fetch user data for displaying on homepage
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HomeNest</title>
    <link rel="stylesheet" href="styles.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">
</head>
<body>

<header>
    <div class="profile">
        <p>
        Welcome, <?php echo $_SESSION["username"]; ?> | <a href="logout.php">Logout</a>
        </p>
    </div>
</header>


<main>
    <div class="board-title">
        <h2>Your Houses For Sale</h2>
    </div>

    <div class="seller-board">
        <?php if (empty($houses)): ?>
        <div class="no-houses">
            <p>You currently are not selling any Houses. Click to add a Home!</p>
            <button id="add-house-btn" class="add-house-btn" style="margin:auto;"><img src="images/add.png"><div>Add A Home</div></button>
        </div>
        <?php else: ?>
            <button id="add-house-btn" class="add-house-btn"><img src="images/add.png"><div>Add A Home</div></button>
            <div class="house-cards">
                <?php foreach ($houses as $house): ?>
                    <div class="house-card">
                        <div class="house-card-img">
                            <?php if (!empty($house['image'])): ?>
                                <img src="images/<?php echo $house['image']; ?>" alt="House Image">
                            <?php else: ?>
                                <img src="images/default_image.png" alt="House Image">
                            <?php endif; ?>
                        </div>
                        <div class="house-card-details">
                            <h3 class="house-card-address"><?php echo $house['address']; ?></h3>
                            <p class="house-card-price">$<?php echo number_format($house['price'], 0); ?></p>
                            <div class="house-card-info">
                                <span class="bed"><?php echo $house['bedrooms']; ?> beds</span>
                                <span class="bath"><?php echo $house['bathrooms']; ?> baths</span>
                                <span class="sqft"><?php echo $house['site_sqft']; ?> sqft</span>
                                <span class="age">Age: <?php echo $house['age']; ?></span>
                            </div>
                            <div class="house-card-features">
                                <span class="feature">
                                    <?php echo $house['garden'] ? 'Has Garden' : 'Does not have Garden'; ?>
                                </span>
                                <span class="feature">
                                    <?php echo $house['parking'] ? 'Has Parking' : 'Does not have Parking'; ?>
                                </span>
                                <?php if (!empty($house['proximity_facilities'])): ?>
                                    <span class="feature">Facilities: <?php echo $house['proximity_facilities']; ?></span>
                                <?php endif; ?>
                                <?php if (!empty($house['proximity_roads'])): ?>
                                    <span class="feature">Roads: <?php echo $house['proximity_roads']; ?></span>
                                <?php endif; ?>
                                <span class="feature">Property Tax: $<?php echo number_format($house['property_tax'], 2); ?></span>
                            </div>
                            <a href="#" class="edit-link" onclick="openEditPopup(<?php echo $house['id']; ?>)">Edit</a>
                            <button class="delete-btn" data-house-id="<?php echo $house['id']; ?>">Delete</button>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
    </div>


<div class="popup" id="popup" style="display:none;">
    <div class="popup-content">
        <span class="close" id="close">&times</span>
        <!-- Add House Form-->
        <div id="add-house-form" style="display:none;">
            <h2>Add a House</h2>
            <form action="" method="post" enctype="multipart/form-data">
                <div class="form-group">
                    <label for="address">Address:</label>
                    <input type="text" name="address" placeholder="Address" required>
                </div>
                <div class="form-group">
                    <label for="price">Price:</label>
                    <input type="number" name="price" placeholder="Price" step="0.01" required>
                </div>
                <div class="form-group">
                    <label for="bedrooms">Number of Bedrooms:</label>
                    <input type="number" name="bedrooms" placeholder="Number of Bedrooms" required>
                </div>
                <div class="form-group">
                    <label for="bathrooms">Number of Bathrooms:</label>
                    <input type="number" name="bathrooms" placeholder="Number of Bathrooms" required>
                </div>
                <div class="form-group">
                    <label for="site_sqft">Site Square Footage:</label>
                    <input type="number" name="site_sqft" placeholder="Site Square Footage" required>
                </div>
                <div class="form-group">
                    <label for="age">Age of Property:</label>
                    <input type="number" name="age" placeholder="Age of Property" required>
                </div>
                <div class="form-group">
                    <label for="garden">Garden:</label>
                    <select name="garden">
                        <option value="1">Has Garden</option>
                        <option value="0">No Garden</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="parking">Parking:</label>
                    <select name="parking">
                        <option value="1">Has Parking</option>
                        <option value="0">No Parking</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="proximity_facilities">Proximity to Nearby Facilities:</label>
                    <input type="text" name="proximity_facilities" placeholder="Nearby Facilities (Optional)">
                </div>
                <div class="form-group">
                    <label for="proximity_roads">Proximity to Main Roads:</label>
                    <input type="text" name="proximity_roads" placeholder="Main Roads (Optional)">
                </div>
                <div class="form-group">
                    <input type="file" name="house_image" accept="image/.jpg,image/.jpeg,image/.png">
                </div>
                <button type="submit">Add House</button>
            </form>
        </div>
    </div>
</div>

<div id="edit-form-container" style="display: none; z-index:1;"></div>

</main>




<script>
    const addHouseBtn = document.getElementById('add-house-btn');
    const popup = document.getElementById('popup');
    const closeBtn = document.getElementById('close');
    const addHouseForm = document.getElementById('add-house-form');
    const deleteButtons = document.querySelectorAll('.delete-btn');

    function clearInputFields() {
        const inputFields = addHouseForm.querySelectorAll('input, textarea');
        inputFields.forEach(input => {
            input.value = ''; // clear input fields
        });
    }

    addHouseBtn.addEventListener('click', () => {
        popup.style.display = 'block';
        addHouseForm.style.display = 'block';
    });

    closeBtn.addEventListener('click', () => {
        popup.style.display = 'none';
        document.getElementById('edit-form-container').innerHTML = '';
        if (addHouseForm) {
            addHouseForm.style.display = 'none';
            clearInputFields();
        }
        clearInputFields();

    });

    deleteButtons.forEach(button => {
        button.addEventListener('click', () => {
            const houseId = button.dataset.houseId;
            const confirmed = confirm('Are you sure you want to delete this house?');

            if (confirmed) {
                window.location.href = `update-house.php?delete=true&house_id=${houseId}`;
            }
        });
    });
    

    function openEditPopup(houseId) {
        // Fetch the edit form for the specific house ID using AJAX
        fetch(`edit-house.php?id=${houseId}`)
            .then(response => response.text())
            .then(data => {
                // Load the edit form into the popup container
                document.getElementById('edit-form-container').innerHTML = data;
                    // Display the popup
                document.getElementById('popup').style.display = 'block';
                document.getElementById('edit-form-container').style.display = 'block';

            })
            .catch(error => console.error('Error fetching edit form:', error));
    }
    
</script>
</body>
</html>
