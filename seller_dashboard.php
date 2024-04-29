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

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Escape user inputs for security
    $address = $_POST["address"];
    $price = $_POST["price"];
    $bed = $_POST["bed"];
    $bath = $_POST["bath"];
    $sqft = $_POST["sqft"];

    // Prepare an insert statement
    $sql = "INSERT INTO sellerHouses (seller_id, address, price, bed, bath, sqft) VALUES (:seller_id, :address, :price, :bed, :bath, :sqft)";

    if($stmt = $pdo->prepare($sql)){
        // Bind variables to the prepared statement as parameters
        $stmt->bindParam(":seller_id", $_SESSION["user_id"]);
        $stmt->bindParam(":address", $address);
        $stmt->bindParam(":price", $price);
        $stmt->bindParam(":bed", $bed);
        $stmt->bindParam(":bath", $bath);
        $stmt->bindParam(":sqft", $sqft);

        // Attempt to execute the prepared statement
        if($stmt->execute()){
            // Set success message
            $success_message = "House added Successfully!";
        } else{
            $success_message = "Oops! Something went wrong. Please try again later.";
        }
    }
    
    // Close statement
    unset($stmt);
}

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
</head>
<body>
<header>
    <div class="logo">HomeNest</div>
    <nav>
        <ul>
            <li><a href="#">Home</a></li>
            <li><a href="#">Houses?</a></li>
            <li><a href="#">About</a></li>
            <li><a href="#">Contact</a></li>
        </ul>
    </nav>
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
        <div class="no-houses">
            <p>You currently are not selling any Houses. Click to add a Home!<p>
            <button id="add-house-btn" class="add-house-btn"><img src="add.png">Add A Home</button>
        </div>
    </div>
    <div class="popup" id="popup" style="display:none;">
        <div class="popup-content">
            <span class="close" id="close">&times;</span>
            <!-- Add House Form-->
            <div id="add-house-form" style="display:none;">
                <h2>Add a House</h2>
                <form action="" method="post">
                    <input type="text" name="address" placeholder="Address" required>
                    <input type="number" name="price" placeholder="Price" required>
                    <input type="number" name="bed" placeholder="Beds" required>
                    <input type="number" name="bath" placeholder="Baths" required>
                    <input type="number" name="sqft" placeholder="Square ft" required>
                    <div>
                        <label for="image">Choose image to upload</label>
                        <input type="file" id="image" name="image" accept=".jpg, .jpeg, .png" required/>
                    </div>
                    <textarea name="description" placeholder="Description"></textarea>
                    <button type="submit">Add House</button>
                </form>
            </div>
        </div>
    </div>
</main>




<script>
    const addHouseBtn = document.getElementById('add-house-btn');
    const popup = document.getElementById('popup');
    const closeBtn = document.getElementById('close');
    const addHouseForm = document.getElementById('add-house-form');

    function clearInputFields() {
        const inputFields = addHouseForm.querySelectorAll('input, textarea');
        inputFields.forEach(input => {
            input.value = ''; // clear input fields
        });
    }

    function resetFormState() {
        addHouseForm.style.display = 'block';
    }

    addHouseBtn.addEventListener('click', () => {
        popup.style.display = 'block';
        resetFormState();
    });

    closeBtn.addEventListener('click', () => {
        popup.style.display = 'none';
        resetFormState();
        clearInputFields();
    });

</script>
</body>
</html>
