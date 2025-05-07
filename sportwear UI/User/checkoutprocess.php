<?php
session_start(); // Start the session
error_reporting(E_ALL);
ini_set('display_errors', 1);

require_once "../db/connect.php"; // Include database connection

// Check if the database connection is successful
if (!$pdo) {
    die("Database connection failed: " . print_r($pdo->errorInfo(), true));
}

// Check if the request is a POST and the cart data is valid
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['cart'])) {
    // Decode the cart data from JSON
    $cart = json_decode($_POST['cart'], true);
    $total = 0;
    $total_qty = 0;
    $payment_type = $_POST['payment'];
    $address = $_POST['shipaddress'];
    echo $address;
    echo $payment_type;

    // Validate cart data
    foreach ($cart as $item) {
        if (!isset($item['price'], $item['qty'], $item['id'])) {
            die("Invalid item in cart.");
        }
        $total += $item['price'] * $item['qty'];
        $total_qty += $item['qty']; // Calculate total quantity
    }

    try {
        $pdo->beginTransaction(); // Start a transaction

        $sql = "INSERT INTO sales (user_id, total_qty, total_amount, ordered_at ,payment_type, Shipping_Address) VALUES (:user_id, :total_qty, :total_amount, NOW(), :payment_type, :Shipping_Address)";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([
            "user_id" => $_SESSION['user_id'],
            "total_qty" => count($_SESSION['cart']),
            "total_amount" => $total,
            "payment_type" => $payment_type,
            "Shipping_Address" => $address
        ]);

        // Get the last inserted order ID
        $sale_id = $pdo->lastInsertId();
        $user_id = $_SESSION['user_id'];
        if (!is_numeric($sale_id)) {
            die("Error: Invalid order ID.");
        }

        // Insert into order_line Table
        foreach ($cart as $item) {
            $sql = "INSERT INTO sale_detail (sale_id, user_id, product_id, qty, price) VALUES (:sale_id, :user_id, :product_id, :qty, :price)";
            $stmt = $pdo->prepare($sql);
            $stmt->execute([
                "sale_id" => $sale_id,
                "user_id" => $user_id, // Add user_id for order_line
                "product_id" => $item['id'],
                "qty" => $item['qty'],
                "price" => $item['price'],
            ]);
            // Reduce the stock of the product
            $sql = "UPDATE products SET Stock_Quantity = Stock_Quantity - :qty WHERE Product_ID = :product_id";
            $stmt = $pdo->prepare($sql);
            $stmt->execute([
                "qty" => $item['qty'],
                "product_id" => $item['id'],
            ]);
        }
        $pdo->commit(); // Commit the transaction

        // Redirect to the order success page with the order ID
        header("Location: ordersuccess.php?sale_id=" . $sale_id . "&payment_type=" . $payment_type . "&cart=" . $cart);
        exit();
    } catch (Exception $e) {
        $pdo->rollBack(); // Roll back the transaction on error
        die("An error occurred: " . $e->getMessage());
    }
} else {
    // Handle invalid request
    die("Invalid request.");
}
