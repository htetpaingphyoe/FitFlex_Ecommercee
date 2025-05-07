<?php
require_once "../login/checklogin.php";
if (!isset($_SESSION)) {
    session_start();
}

if (isset($_POST['id'])) {
    $id = $_POST['id'];

    if (isset($_POST['increase'])) {
        $_SESSION['cart'][$id]['qty']++; // Increase quantity
    } elseif (isset($_POST['decrease'])) {
        if ($_SESSION['cart'][$id]['qty'] <= 1) {
            unset($_SESSION['cart'][$id]); // Remove product if quantity is 1 or less
        } else {
            $_SESSION['cart'][$id]['qty']--; // Decrease quantity
        }
    } elseif (isset($_POST['remove'])) {
        unset($_SESSION['cart'][$id]); // Remove product from cart
    }

    // Debugging: Print the session data
    // echo "<pre>";
    // print_r($_SESSION['cart']);
    // echo "</pre>";
    // exit(); // Stop execution to check the output
}

header("Location: cartpage.php"); // Redirect back to the cart page
exit();
?>