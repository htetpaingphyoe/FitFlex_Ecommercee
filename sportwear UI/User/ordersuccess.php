<?php
session_start(); // Start the session
error_reporting(E_ALL);
ini_set('display_errors', 1);

require_once "../db/connect.php"; // Include database connection

// Check if the database connection is successful
if (!$pdo) {
    die("Database connection failed: " . print_r($pdo->errorInfo(), true));
}

// Check if the order ID is passed in the URL
if (!isset($_GET['sale_id'])) {
    die("sale ID is missing.");
}

$user_id = $_SESSION['user_id'];
$sale_id = $_GET['sale_id']; // Get the order ID from the URL

try {
    // Update payment_status in orders table to 'confirm'
    // $sql = "UPDATE orders SET payment_status = 'confirm' WHERE order_id = :order_id";
    // $stmt = $pdo->prepare($sql);
    // $stmt->execute([
    //     "order_id" => $order_id,
    // ]);

    // Fetch order details from the database
    $sql = "SELECT * FROM sales WHERE sale_id = :sale_id";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([
        "sale_id" => $sale_id,
    ]);
    $sale = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$sale) {
        die("sale not found.");
    }

    // Fetch order line items
    $sql = "SELECT * FROM sale_detail WHERE sale_id = :sale_id";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([
        "sale_id" => $sale_id,
    ]);
    $sale_detail = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // Get the payment type from the URL
    $payment_type = $_GET['payment_type'] ?? ''; // Use null coalescing operator to avoid undefined key warning
    if (empty($payment_type)) {
        die("Payment type is missing.");
    }
    $total = 0;
    $total = $_SESSION['total'];
    // Insert into sales Table
    // $sql = "INSERT INTO sales (order_id, user_id, total_amount, payment_type) VALUES (:order_id, :user_id, :total_amount, :payment_type)";
    // $stmt = $pdo->prepare($sql);
    // $stmt->execute([
    //     "order_id" => $order_id,
    //     "user_id" => $user_id,
    //     "total_amount" => $total + 4 ?? 0, // Use null coalescing operator to avoid undefined key warning
    //     "payment_type" => $payment_type,
    // ]);

    // Fetch payment details from the sales table
    $sql = "SELECT * FROM sales WHERE sale_id = :sale_id";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([
        "sale_id" => $sale_id,
    ]);
    $payment_type = $stmt->fetch(PDO::FETCH_ASSOC);
} catch (Exception $e) {
    die("An error occurred: " . $e->getMessage());
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Success</title>
    <style>
        /* General Styles */
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
        }

        .container {
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            max-width: 800px;
            width: 100%;
            margin: 20px;
        }

        h1 {
            color: #4CAF50;
            font-size: 2rem;
            text-align: center;
            margin-bottom: 20px;
        }

        h2 {
            font-size: 1.5rem;
            color: #333;
            margin-bottom: 10px;
        }

        p {
            color: #666;
            margin: 5px 0;
        }

        .success-icon {
            text-align: center;
            margin-bottom: 20px;
        }

        .success-icon svg {
            width: 80px;
            height: 80px;
            fill: #4CAF50;
        }

        /* Order Details */
        .order-details {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 20px;
            margin-bottom: 20px;
        }

        .order-details div {
            background-color: #f9f9f9;
            padding: 15px;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        /* Order Items Table */
        .order-items {
            margin-bottom: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            background-color: #fff;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        th, td {
            padding: 12px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        th {
            background-color: #f2f2f2;
            font-weight: bold;
            color: #333;
        }

        tr:hover {
            background-color: #f9f9f9;
        }

        /* Payment Details */
        .payment-details {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 20px;
            margin-bottom: 20px;
        }

        .payment-details div {
            background-color: #f9f9f9;
            padding: 15px;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        /* Continue Shopping Button */
        .continue-shopping {
            text-align: center;
            margin-top: 20px;
        }

        .continue-shopping a {
            display: inline-block;
            padding: 10px 20px;
            background-color: #4CAF50;
            color: #fff;
            text-decoration: none;
            border-radius: 5px;
            transition: background-color 0.3s ease;
        }

        .continue-shopping a:hover {
            background-color: #45a049;
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .order-details, .payment-details {
                grid-template-columns: 1fr;
            }

            h1 {
                font-size: 1.75rem;
            }

            h2 {
                font-size: 1.25rem;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <!-- Success Icon -->
        <div class="success-icon">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
            </svg>
        </div>

        <!-- Success Message -->
        <h1>Order Successful!</h1>
        <p class="text-center">Thank you for your purchase. Your order has been successfully processed.</p>

        <!-- Order Details -->
        <div class="order-details">
            <div>
                <p><strong>Order ID:</strong></p>
                <p><?php echo htmlspecialchars($sale['sale_id'] ?? ''); ?></p>
            </div>
            <div>
                <p><strong>Total Quantity:</strong></p>
                <p><?php echo htmlspecialchars($sale['total_qty'] ?? ''); ?></p>
            </div>
            <div>
                <p><strong>Total Amount:</strong></p>
                <p>$<?php echo htmlspecialchars(number_format($sale['total_amount'] ?? 0, 2)); ?></p>
            </div>
        </div>

        <!-- Order Items -->
        <div class="order-items">
            <h2>Order Items</h2>
            <table>
                <thead>
                    <tr>
                        <th>Product ID</th>
                        <th>Quantity</th>
                        <th>Price</th>
                        <th>Subtotal</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($sale_detail as $item): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($item['product_id'] ?? ''); ?></td>
                            <td><?php echo htmlspecialchars($item['qty'] ?? ''); ?></td>
                            <td>$<?php echo htmlspecialchars(number_format($item['price'] ?? 0, 2)); ?></td>
                            <td>$<?php echo htmlspecialchars(number_format(($item['qty'] ?? 0) * ($item['price'] ?? 0), 2)); ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>

        <!-- Payment Details -->
        <div class="payment-details">
            <div>
                <p><strong>Payment Type:</strong></p>
                <p><?php echo htmlspecialchars($payment_type['payment_type'] ?? ''); ?></p>
            </div>
            <div>
                <p><strong>Total Amount Paid:</strong></p>
                <p>$<?php echo htmlspecialchars(number_format($payment_type['total_amount'] ?? 0, 2)); ?></p>
            </div>
        </div>

        <!-- Continue Shopping Button -->
        <div class="continue-shopping">
            <a href="sproduct.php">Continue Shopping</a>
        </div>
    </div>

    <?php unset($_SESSION['cart']); ?>
</body>
</html>