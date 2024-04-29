<?php
session_start();

if (isset($_SESSION["user_id"])) {
    if ($_SESSION["account_type"] == "buyer") {
        header("location: buyer_dashboard.php");
        exit;
    } elseif ($_SESSION["account_type"] == "seller") {
        header("location: seller_dashboard.php");
        exit;
    } elseif ($_SESSION["account_type"] == "admin") {
        header("location: admin_dashboard.php");
        exit;
    }
}

include "initialize_database.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $name_first = $_POST['name_first'];
    $name_last = $_POST['name_last'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $account_type = $_POST['account_type'];

    $hashed_password = password_hash($password, PASSWORD_DEFAULT);
    
    $stmt_check = $pdo->prepare("SELECT * FROM account WHERE username = :username OR email = :email");
    $stmt_check->bindParam(':username', $username);
    $stmt_check->bindParam(':email', $email);
    $stmt_check->execute();
    
    $existing_user = $stmt_check->fetch(PDO::FETCH_ASSOC);
    
    if ($existing_user) {
        header("location: index.php?error=username_exists#signup-popup");
        exit;
    } else {
        $stmt = $pdo->prepare("INSERT INTO account (username, name_first, name_last, email, password, account_type) VALUES (:username, :name_first, :name_last, :email, :password, :account_type)");
        $stmt->bindParam(':username', $username);
        $stmt->bindParam(':name_first', $name_first);
        $stmt->bindParam(':name_last', $name_last);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':password', $hashed_password);
        $stmt->bindParam(':account_type', $account_type);
        $stmt->execute();
        
        $_SESSION["user_id"] = $pdo->lastInsertId();
        $_SESSION["username"] = $name_first;
        
        $_SESSION["signup_success"] = true;
        header("location: index.php#login-popup");
        exit;
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up</title>
    <link rel="stylesheet" href="form.css">
</head>
<body>
<div class="container">
    <h2>Sign Up</h2>
    <?php if (isset($_GET['error']) && $_GET['error'] === 'username_exists') { ?>
        <p class="error">Username or email already exists.</p>
    <?php } ?>
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
        <input type="text" name="username" placeholder="Username" required><br>
        <input type="text" name="name_first" placeholder="First Name" required><br>
        <input type="text" name="name_last" placeholder="Last Name" required><br>
        <input type="email" name="email" placeholder="Email" required><br>
        <input type="password" name="password" placeholder="Password" required><br>
        <label for="account_type">Account Type:</label>
        <div>
            <input type="radio" id="buyer" name="account_type" value="buyer" required>
            <label for="buyer">Buyer</label>
        </div>
        <div>
            <input type="radio" id="seller" name="account_type" value="seller" required>
            <label for="seller">Seller</label>
        </div>
        <div>
            <input type="radio" id="admin" name="account_type" value="admin" required>
            <label for="admin">Admin</label>
        </div>
        <button type="submit" id="signupButton">Sign Up</button>
    </form>
    <p>Already have an account? <a href="#" id="loginLink">Login</a></p>
</div>
<script src="index.js"></script>
</body>
</html>
