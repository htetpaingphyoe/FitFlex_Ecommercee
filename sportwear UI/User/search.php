<?php
    require_once "../db/connect.php";
    if (isset($_GET['query'])) {
        $query = '%' . $_GET['query'] . '%'; // Add wildcards for partial matching
    
        try {
            // Prepare the SQL query
            $sql = "SELECT * FROM products WHERE name LIKE :query";
            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(':query', $query, PDO::PARAM_STR);
            $stmt->execute();
    
            // Fetch all matching products
            $products = $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            die("Error fetching search results: " . $e->getMessage());
        }
    }

?>