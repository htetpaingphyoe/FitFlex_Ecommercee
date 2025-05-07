<?php
require_once "../db/connect.php";
session_start();

if ($_SERVER['REQUEST_METHOD'] === "POST") {
    $gmail = $_POST['email'];
    $password = $_POST['password'];

    // Check if the user is a regular user
    $sql = "SELECT * FROM users WHERE Gmail = :Gmail";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(":Gmail", $gmail);
    $stmt->execute();
    $user = $stmt->fetch(PDO::FETCH_ASSOC);
    if ($user && $user['Password'] === $password) {
        // Set session variables for regular users
        $_SESSION["user"] = $user;
        $_SESSION["user_id"] = $user['User_Id']; // Ensure this matches the column name in your database
        header("location: ../User/index.php");
        exit();
    }

    // Check if the user is an admin
    $sql = "SELECT * FROM admins WHERE gmail = :Gmail";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(":Gmail", $gmail);
    $stmt->execute();
    $admin = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($admin && $admin['password'] === $password) {
        // Set session variables for admins
        $_SESSION["admin"] = $admin;
        header("location: ../admin/index.php");
        exit();
    }
    print_r($_SESSION);
    // If login fails, redirect back to the login page with an error message
    header("location: ../login/login.php?login=failed");
    exit();
}
?>