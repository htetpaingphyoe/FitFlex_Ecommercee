<?php
    require_once "connection.php";
    $hostname = "localhost";
    $dbname = "fitflexweb";
    $username = "root";
    $password = "";
    $connection = new connection($hostname,$dbname,$username,$password);
    // print_r($connection);
    $pdo = $connection->getConnection();
    $pdo->exec("Use fitflexweb");
    // print_r($pdo);
?>
