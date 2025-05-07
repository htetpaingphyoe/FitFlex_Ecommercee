<?php
require_once "../db/connect.php";
function getProduct($pdo)
{
    $sql = "SELECT * from products";
    try {
        $stmt = $pdo->query($sql);
        $products = $stmt->fetchALL(PDO::FETCH_ASSOC);
        return $products;
    } catch (Exception $e) {
        echo $e->getMessage();
    }
}
function getUser($pdo)
{
    $sql = "SELECT * from users";
    try {
        $stmt = $pdo->query($sql);
        $products = $stmt->fetchALL(PDO::FETCH_ASSOC);
        return $products;
    } catch (Exception $e) {
        echo $e->getMessage();
    }
}
function getsale($pdo, $offset = 0, $limit = 10) {
    try {
        // SQL query to fetch sales data with the user's name
        $sql = "
            SELECT 
                s.sale_id, 
                s.user_id, 
                u.First_name, 
                u.Last_name, 
                s.ordered_at,
                s.total_qty,
                s.payment_type, 
                s.total_amount,
                s.Shipping_Address 
            FROM 
                sales s
            INNER JOIN 
                users u ON s.user_id = u.user_id
            LIMIT :limit OFFSET :offset
        ";

        // Prepare and execute the query
        $stmt = $pdo->prepare($sql);
        $stmt->bindValue(':limit', $limit, PDO::PARAM_INT);
        $stmt->bindValue(':offset', $offset, PDO::PARAM_INT);
        $stmt->execute();

        // Fetch all results as an associative array
        $sales = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return $sales;
    } catch (Exception $e) {
        // Handle the exception, e.g., log it or rethrow it
        error_log($e->getMessage());
        return false; // or throw $e; depending on your error handling strategy
    }
}

function getSale_detail($pdo)
{
    $sql = "SELECT * from sale_detail";
    try {
        $stmt = $pdo->query($sql);
        $saledetail = $stmt->fetchALL(PDO::FETCH_ASSOC);
        return $saledetail;
    } catch (Exception $e) {
        echo $e->getMessage();
    }
}
function getSale_detailById($pdo, $sale_id)
{
    $sql = "SELECT 
                s.sale_id,
                sd.saledetail_id,
                s.user_id,
                u.First_name,  
                u.Last_name,   
                s.total_qty,
                s.total_amount,
                s.ordered_at,
                s.payment_type,
                sd.product_id,
                p.Name AS product_name,
                sd.qty,
                sd.price,
                (sd.qty * sd.price) AS subtotal
            FROM 
                sales s
            JOIN 
                sale_detail sd ON s.sale_id = sd.sale_id
            JOIN 
                users u ON s.user_id = u.user_id
            JOIN 
                products p ON sd.product_id = p.Product_ID 
            WHERE 
                s.sale_id = $sale_id"; // Filter by sale_id

    try {
        $stmt = $pdo->prepare($sql);
        $stmt->execute(); // Bind the sale_id parameter
        $saledetail = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $saledetail;
    } catch (Exception $e) {
        echo $e->getMessage();
        return []; // Return an empty array in case of an error
    }
}
function getProductById($id, $pdo)
{
    $sql = "SELECT * fROM products WHERE Product_ID=$id";
    try {
        $stmt = $pdo->query($sql);
        $products = $stmt->fetch(PDO::FETCH_ASSOC);
        return $products;
    } catch (Exception $e) {
        echo $e->getMessage();
    }
}
function getProductByCategory($category, $pdo, $excludeId = null)
{
    // Base SQL query
    $sql = "SELECT * FROM products WHERE Category = :category";

    // Exclude the current product if an ID is provided
    if ($excludeId !== null) {
        $sql .= " AND Product_ID != :excludeId";
    }

    try {
        // Prepare the SQL statement
        $stmt = $pdo->prepare($sql);

        // Bind the category parameter
        $stmt->bindParam(':category', $category, PDO::PARAM_STR);

        // Bind the excludeId parameter if provided
        if ($excludeId !== null) {
            $stmt->bindParam(':excludeId', $excludeId, PDO::PARAM_INT);
        }

        // Execute the query
        $stmt->execute();

        // Fetch all results
        $products = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $products;
    } catch (Exception $e) {
        echo $e->getMessage();
        return []; // Return an empty array in case of an error
    }
}
function getUserById($id, $pdo)
{
    $sql = "SELECT * fROM users WHERE User_Id=$id";
    try {
        $stmt = $pdo->query($sql);
        $products = $stmt->fetch(PDO::FETCH_ASSOC);
        return $products;
    } catch (Exception $e) {
        echo $e->getMessage();
    }
}
function getCategories($pdo)
{
    $sql = "SELECT DISTINCT Category FROM products"; // Fetch unique categories
    try {
        $stmt = $pdo->query($sql); // Execute the query
        $categories = $stmt->fetchAll(PDO::FETCH_COLUMN); // Fetch results as an array of category names
        return $categories; // Return the array of categories
    } catch (Exception $e) {
        echo $e->getMessage(); // Handle errors
        return []; // Return an empty array in case of an error
    }
}
function user($pdo)
{
    try {
        $sql = "SELECT COUNT(*) FROM users;";
        $stmt = $pdo->prepare($sql);
        $stmt->execute();
        $userCount = $stmt->fetchColumn();
        return $userCount;
    } catch (Exception $e) {
        // Handle the exception, e.g., log it or rethrow it
        error_log($e->getMessage());
        return false; // or throw $e; depending on your error handling strategy
    }
}
function sale($pdo)
{
    try {
        $sql = "SELECT COUNT(*) FROM sales;";
        $stmt = $pdo->prepare($sql);
        $stmt->execute();
        $sale = $stmt->fetchColumn();
        return $sale;
    } catch (Exception $e) {
        // Handle the exception, e.g., log it or rethrow it
        error_log($e->getMessage());
        return false; // or throw $e; depending on your error handling strategy
    }
}
function product($pdo)
{
    try {
        $sql = "SELECT COUNT(*) FROM products;";
        $stmt = $pdo->prepare($sql);
        $stmt->execute();
        $productCount = $stmt->fetchColumn();
        return $productCount;
    } catch (Exception $e) {
        // Handle the exception, e.g., log it or rethrow it
        error_log($e->getMessage());
        return false; // or throw $e; depending on your error handling strategy
    }
}
function getTopLoyalUsers($pdo)
{
    try {
        $sql = "
            SELECT 
                u.User_Id AS USER_ID,
                CONCAT(u.First_name, ' ', u.Last_name) AS NAME,
                COUNT(s.sale_id) AS TOTAL_ORDERS,
                SUM(s.total_amount) AS TOTAL_SPENT
            FROM 
                users u
            JOIN 
                sales s ON u.User_Id = s.user_id
            GROUP BY 
                u.User_Id
            ORDER BY 
                TOTAL_ORDERS DESC, TOTAL_SPENT DESC
            LIMIT 10;
        ";
        $stmt = $pdo->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch (Exception $e) {
        error_log($e->getMessage());
        return false;
    }
}
function getMostSoldProducts($pdo)
{
    try {
        $sql = "
            SELECT 
                p.Product_ID AS PRODUCTID,
                p.Name AS NAME,
                SUM(sd.qty) AS QUANTITY_SOLD
            FROM 
                products p
            JOIN 
                sale_detail sd ON p.Product_ID = sd.product_id
            GROUP BY 
                p.Product_ID
            ORDER BY 
                QUANTITY_SOLD DESC
            LIMIT 10;
        ";
        $stmt = $pdo->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch (Exception $e) {
        error_log($e->getMessage());
        return false;
    }
}
function getTotalSalesCount($pdo) {
    try {
        // SQL query to count total sales
        $sql = "SELECT COUNT(*) as total FROM sales";

        // Prepare and execute the query
        $stmt = $pdo->prepare($sql);
        $stmt->execute();

        // Fetch the total count
        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        return $result['total'];
    } catch (Exception $e) {
        // Handle the exception, e.g., log it or rethrow it
        error_log($e->getMessage());
        return 0; // Return 0 in case of an error
    }
}
function getSalesByUserId($pdo, $user_id) {
    $sql = "
        SELECT 
            s.sale_id, 
            s.total_qty, 
            s.total_amount, 
            s.ordered_at
        FROM 
            sales s
        JOIN 
            users u ON s.user_id = u.user_id
        WHERE 
            u.user_id = :user_id;
    ";

    try {
        $stmt = $pdo->prepare($sql);
        $stmt->bindValue(':user_id', $user_id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch (Exception $e) {
        error_log($e->getMessage());
        return [];
    }
}
function getSaleDetailsBySaleId($pdo, $sale_id) {
    $sql = "
        SELECT 
            sd.saledetail_id, 
            sd.sale_id, 
            p.Name AS product_name, 
            sd.qty, 
            sd.price
        FROM 
            sale_detail sd
        JOIN 
            products p ON sd.product_id = p.Product_ID
        WHERE 
            sd.sale_id = :sale_id;
    ";

    try {
        $stmt = $pdo->prepare($sql);
        $stmt->bindValue(':sale_id', $sale_id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch (Exception $e) {
        error_log($e->getMessage());
        return [];
    }
}