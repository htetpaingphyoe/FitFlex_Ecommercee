<?php
    require_once "../db/connect.php";
    if($_SERVER['REQUEST_METHOD'] == "POST"){
        $firstname = $_POST['name'];
        $lastname = $_POST['lname'];
        $gmail = $_POST['email'];
        $ph_no = $_POST['ph_number'];
        $password = $_POST['password'];
        $address = $_POST['address'];
    }
    function signup($pdo, $gmail, $password, $firstname, $lastname, $address, $ph_no) {
        $sql = "INSERT INTO users (First_name, Last_name, Address, Ph_number, Gmail, Password)
                VALUES (:firstname, :lastname, :address, :ph_no, :gmail, :password)";
        try {
            // Prepare and execute the SQL statement
            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(":gmail", $gmail);
            $stmt->bindParam(":password", $password);
            $stmt->bindParam(":firstname", $firstname);
            $stmt->bindParam(":lastname", $lastname);
            $stmt->bindParam(":address", $address);
            $stmt->bindParam(":ph_no", $ph_no);
            $stmt->execute();
            // Redirect to the user dashboard
            header("location: ../login/login.php?signup=successful");
            // exit();
        } catch (PDOException $e) {
            // Handle errors
            echo "ERROR: " . $e->getMessage();
        }
    }
    signup($pdo,$gmail,$password,$firstname,$lastname,$address,$ph_no);
?>