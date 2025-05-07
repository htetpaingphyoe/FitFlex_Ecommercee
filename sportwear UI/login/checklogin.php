<?php
    if(!isset($_SESSION)){
        session_start();
    }
    if(!isset($_SESSION['user'])){
        header('location: ../login/login.php');
    }
    if(!isset($_SESSION['admin'])){
        header('location: ../login/login.php');
    }
?>