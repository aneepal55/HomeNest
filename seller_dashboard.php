<?php
session_start();
// Check if user is logged in, if not redirect to login page
if (!isset($_SESSION["user_id"])) {
    header("location: logout.php");
    exit;
}

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
</body>
</html>
