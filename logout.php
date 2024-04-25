<?php
    session_start();
    session_destroy();
    $_SESSION["user_id"] = "";
    $_SESSION["username"] = "";
    header("Location: login.php");
    exit();
?>