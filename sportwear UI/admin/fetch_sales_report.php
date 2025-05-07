<?php
require_once "../db/connect.php"; // Include your database connection

$period = $_GET['period'] ?? 'daily'; // Default to daily if no period is specified

try {
    // Query the database based on the selected period
    if ($period === 'daily') {
        $query = "SELECT DATE(ordered_at) AS PERIOD, SUM(total_amount) AS TOTAL_SALES FROM sales GROUP BY DATE(ordered_at)";
    } elseif ($period === 'monthly') {
        $query = "SELECT DATE_FORMAT(ordered_at, '%Y-%m') AS PERIOD, SUM(total_amount) AS TOTAL_SALES FROM sales GROUP BY DATE_FORMAT(ordered_at, '%Y-%m')";
    } elseif ($period === 'yearly') {
        $query = "SELECT YEAR(ordered_at) AS PERIOD, SUM(total_amount) AS TOTAL_SALES FROM sales GROUP BY YEAR(ordered_at)";
    } else {
        throw new Exception("Invalid period specified.");
    }

    $stmt = $pdo->prepare($query);
    $stmt->execute();
    $data = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // Format the data based on the period
    $formattedData = [];
    foreach ($data as $row) {
        if ($period === 'daily') {
            // Convert date to day name (e.g., Monday, Tuesday)
            $dayName = date('l', strtotime($row['PERIOD'])); // 'l' gives the full day name
            $formattedData[] = [
                'PERIOD' => $dayName,
                'TOTAL_SALES' => $row['TOTAL_SALES']
            ];
        } elseif ($period === 'monthly') {
            // Convert date to month name (e.g., January, February)
            $monthName = date('F', strtotime($row['PERIOD'] . '-01')); // 'F' gives the full month name
            $formattedData[] = [
                'PERIOD' => $monthName,
                'TOTAL_SALES' => $row['TOTAL_SALES']
            ];
        } else {
            // For yearly, keep as is
            $formattedData[] = $row;
        }
    }

    header('Content-Type: application/json');
    echo json_encode($formattedData);
} catch (PDOException $e) {
    // Log the error and return a JSON error message
    error_log("Database error: " . $e->getMessage());
    header('Content-Type: application/json');
    echo json_encode(['error' => 'An error occurred while fetching the sales report.']);
} catch (Exception $e) {
    // Log the error and return a JSON error message
    error_log("Error: " . $e->getMessage());
    header('Content-Type: application/json');
    echo json_encode(['error' => $e->getMessage()]);
}