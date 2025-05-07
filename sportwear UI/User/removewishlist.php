<?php
require_once "../db/connect.php";

if (!isset($_SESSION)) {
    session_start();
}
if (isset($_POST['id'])) {
    $product_id = $_POST['id'];
    $user_id = $_SESSION['user_id']; // Get the logged-in user's ID

    // Delete the product from the wishlist table
    $delete_sql = "DELETE FROM wishlist WHERE user_id = :user_id AND product_id = :product_id";
    $delete_stmt = $pdo->prepare($delete_sql);
    $delete_stmt->execute(['user_id' => $user_id, 'product_id' => $product_id]);

    if ($delete_stmt->rowCount() > 0) {
        echo "Product removed from wishlist.";
    } else {
        echo "Product not found in wishlist.";
    }

    // Redirect back to the wishlist page
    header("Location: wishlist.php?item$product_id.removed");
    exit();
} else {
    die("Invalid request.");
}
?>