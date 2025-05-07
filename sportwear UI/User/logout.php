<?php
    echo "logout successfully";
    if(isset($_SESSION['user'])){
        $user = $_SESSION['user'];
        echo $user;
    }
    session_start();
    unset($_SESSION['cart']);
    session_destroy();
    header("location:index.php");
?>