<?php
    session_start();
    session_destroy();
    $_SESSION["user_id"] = "";
    $_SESSION["username"] = "";
    $_SESSION["account_type"] = "";
    header("Location: index.php");
    exit();
?>