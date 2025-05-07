<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

session_start();
require_once "../login/checklogin.php";

// Debugging: Print session variables
echo "<pre>";
// print_r($_SESSION);
echo "</pre>";

// Ensure the user is logged in
if (!isset($_SESSION['user_id'])) {
    die("You must be logged in to add items to your wishlist.");
}

// Include the database connection file
require_once "../admin/data.php";

if (isset($_POST['id'])) {
    $product_id = $_POST['id'];
    $user_id = $_SESSION['user_id'];

    try {
        // Check if the product exists in the products table
        $product_sql = "SELECT * FROM products WHERE Product_ID = :product_id";
        $product_stmt = $pdo->prepare($product_sql);
        $product_stmt->execute(['product_id' => $product_id]);
        $product = $product_stmt->fetch(PDO::FETCH_ASSOC);

        if (!$product) {
            die("Product not found.");
        }

        // Check if the product is already in the user's wishlist
        $check_sql = "SELECT * FROM wishlist WHERE user_id = :user_id AND product_id = :product_id";
        $check_stmt = $pdo->prepare($check_sql);
        $check_stmt->execute(['user_id' => $user_id, 'product_id' => $product_id]);

        if ($check_stmt->rowCount() > 0) {
            // Product already exists in the wishlist
            echo "Product is already in your wishlist.";
        } else {
            // Insert the product into the wishlist table
            $insert_sql = "INSERT INTO wishlist (user_id, product_id, added_at) 
                           VALUES (:user_id, :product_id, NOW())";
            $insert_stmt = $pdo->prepare($insert_sql);
            $insert_stmt->execute([
                'user_id' => $user_id,
                'product_id' => $product_id
            ]);

            if ($insert_stmt->rowCount() > 0) {
                echo "Product added to wishlist!";
            } else {
                die("Failed to add product to wishlist.");
            }
        }
    } catch (PDOException $e) {
        die("Database error: " . $e->getMessage());
    }

    // Redirect to the wishlist page
    header("Location: wishlist.php");
    exit();
} else {
    die("Invalid request.");
}
?>