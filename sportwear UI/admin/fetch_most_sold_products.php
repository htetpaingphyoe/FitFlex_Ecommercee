<?php
require_once "../db/connect.php"; // Include your database connection

try {
    // Query to fetch most sold product categories
    $query = "
        SELECT 
            p.Category AS CATEGORY, 
            SUM(sd.qty) AS QUANTITY_SOLD 
        FROM 
            sale_detail sd
        JOIN 
            products p ON sd.product_id = p.Product_ID
        GROUP BY 
            p.Category
        ORDER BY 
            QUANTITY_SOLD DESC
    ";

    $stmt = $pdo->prepare($query);
    $stmt->execute();
    $data = $stmt->fetchAll(PDO::FETCH_ASSOC);

    header('Content-Type: application/json');
    echo json_encode($data);
} catch (PDOException $e) {
    // Log the error and return a JSON error message
    error_log("Database error: " . $e->getMessage());
    header('Content-Type: application/json');
    echo json_encode(['error' => 'An error occurred while fetching the most sold product categories.']);
}