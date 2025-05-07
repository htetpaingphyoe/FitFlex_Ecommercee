<?php
    echo "logout successfully";
    if(isset($_SESSION['admin'])){
        $admin = $_SESSION['admin'];
        echo $admin;
    }
    session_start();
    session_destroy();
    header("location:../login/login.php?status=logoutsuccessful");
?>