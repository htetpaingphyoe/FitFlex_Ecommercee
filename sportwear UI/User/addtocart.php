<?php
require_once "../admin/data.php"; // Include the file with getProductById()
require_once "../login/checklogin.php";

if (!isset($_SESSION)) {
    session_start();
}

if (isset($_POST['id'])) {
    $id = $_POST['id'];
    $product = getProductById($id, $pdo); // Fetch the specific product
    print_r($product);

    if ($product) {
        if (isset($_SESSION['cart'][$id])) {
            $_SESSION['cart'][$id]['qty']++; // Increase quantity if product already exists
        } else {
            // Add new product to the cart
            $_SESSION['cart'][$id] = [
                'id' => $product['Product_ID'],
                'name' => $product['Name'],
                'price' => $product['Price'],
                'size' => $product['Size'],
                'img_url' => $product['Image_URL'],
                'qty' => 1,
            ];
        }

        // Debugging: Print the session data
         // Stop execution to check the output
         
        // Redirect after adding to cart
        header("Location: sproduct.php");
        exit();
    } else {
        die("Product not found.");
    }
} else {
    die("Invalid request.");
}
?>