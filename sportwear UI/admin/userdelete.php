<?php
require_once "../db/connect.php";
// require_once "../login/checkloginforadmin.php";

$id = $_GET['id'];
// var_dump($id);

$sql =  "DELETE FROM users WHERE User_Id=:id";
$stmt = $pdo->prepare($sql);
$stmt->bindParam(':id', $id);
$stmt->execute();

header("Location: users.php?productdeletedsuccessfully");
?>