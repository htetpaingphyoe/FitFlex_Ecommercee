<?php
require_once "../db/connect.php";
require_once "../login/checkloginforadmin.php";

if (isset($_GET['term'])) {
    $searchTerm = $_GET['term'];

    // Prepare the SQL query
    $sql = "SELECT * FROM products WHERE Name LIKE :term";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(['term' => "%$searchTerm%"]);

    // Fetch results
    $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // Return results as JSON
    echo json_encode($results);
}