<?php
require_once "../db/connect.php";

if ($_SERVER['REQUEST_METHOD'] === "POST") {
    $token = $_POST['token'];
    $newPassword = $_POST['new_password'];

    // Check if the token is valid and not expired
    $sql = "SELECT * FROM password_resets WHERE token = :token AND expires > NOW()";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(":token", $token);
    $stmt->execute();
    $resetRequest = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($resetRequest) {
        $email = $resetRequest['email'];
        // echo $email;

        // Update the user's password
        $sql = "UPDATE users SET Password = :password WHERE Gmail = :email";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(":password", $newPassword);
        $stmt->bindParam(":email", $email);
        $stmt->execute();

        // Delete the reset token
        $sql = "DELETE FROM password_resets WHERE token = :token";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(":token", $token);
        $stmt->execute();

        header("location: login.php?updatepasswordsuccessfully");
    } else {
        echo "Invalid or expired token.";
    }
}
?>