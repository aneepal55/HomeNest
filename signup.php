<?php
session_start();

// Initializes and connects to the database
include "initialize_database.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Handle signup form submission
    $name_first = $_POST['name_first'];
    $name_last = $_POST['name_last'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $birthday = $_POST['birthday'];
    
    $stmt = $pdo->prepare("INSERT INTO account (name_first, name_last, email, password, birthday) VALUES (:name_first, :name_last, :email, :password, :birthday)");
    $stmt->bindParam(':name_first', $name_first);
    $stmt->bindParam(':name_last', $name_last);
    $stmt->bindParam(':email', $email);
    $stmt->bindParam(':password', $password);
    $stmt->bindParam(':birthday', $birthday);
    $stmt->execute();
    
    $_SESSION["user_id"] = $pdo->lastInsertId();
    $_SESSION["username"] = $name_first;
    
    header("location: homepage.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="container">
        <h2>Sign Up</h2>
        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
            <input type="text" name="name_first" placeholder="First Name" required>
            <input type="text" name="name_last" placeholder="Last Name" required>
            <input type="email" name="email" placeholder="Email" required>
            <input type="password" name="password" placeholder="Password" required>
            <input type="date" name="birthday" placeholder="Birthday" required>
            <button type="submit">Sign Up</button>
        </form>
        <p>Already have an account? <a href="login.php">Login</a></p>
    </div>
</body>
</html>
