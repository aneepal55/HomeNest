<?php
session_start();

// Check if signup was successful and display message
$signup_success_message = "";
if (isset($_SESSION["signup_success"]) && $_SESSION["signup_success"]) {
    $signup_success_message = "Sign up successful. You can now log in.";
}

// Initializes and connects to the database
include "initialize_database.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check login credentials and redirect to homepage if successful
    $username_email = $_POST['username_email'];
    $password = $_POST['password'];
    
    // Check if the input is an email address
    if (filter_var($username_email, FILTER_VALIDATE_EMAIL)) {
        $sql = "SELECT * FROM account WHERE email = :username_email";
    } else {
        $sql = "SELECT * FROM account WHERE username = :username_email";
    }
    
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':username_email', $username_email);
    $stmt->execute();
    
    $user = $stmt->fetch(PDO::FETCH_ASSOC);
    
    if ($user && password_verify($password, $user['password'])) {
        $_SESSION["user_id"] = $user["id"];
        $_SESSION["username"] = $user["name_first"];
        $_SESSION["account_type"] = $user["account_type"]; // Store account type in session

        unset($_SESSION["signup_success"]);

        // Redirect based on account type
        if ($user["account_type"] == "buyer") {
            header("location: buyer_dashboard.php");
            exit;
        } elseif ($user["account_type"] == "seller") {
            header("location: seller_dashboard.php");
            exit;
        } elseif ($user["account_type"] == "admin") {
            header("location: admin_dashboard.php");
            exit;
        }
        exit;
    } else {
        $login_error = "Invalid username/email or password.";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
<div class="container">
        <h2>Login</h2>
        <?php if(isset($login_error)) { ?>
            <p class="error"><?php echo $login_error; ?></p>
        <?php } ?>
        <?php if(isset($signup_success_message)) { ?>
            <p class="success"><?php echo $signup_success_message; ?></p>
        <?php } ?>
        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
            <input type="text" name="username_email" placeholder="Username or Email" required>
            <input type="password" name="password" placeholder="Password" required>
            <button type="submit">Login</button>
        </form>
        <p>Don't have an account? <a href="#" id="signupLink">Sign up</a></p>
    </div>
    <script src="index.js"></script>
</body>
</html>
