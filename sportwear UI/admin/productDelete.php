<?php
require_once "../db/connect.php";
// require_once "../login/checkloginforadmin.php";

$id = $_GET['id'];
// var_dump($id);

$sql =  "DELETE FROM products WHERE Product_ID=:id";
$stmt = $pdo->prepare($sql);
$stmt->bindParam(':id', $id);
$stmt->execute();

header("Location: products.php?productdeletedsuccessfully");
?>