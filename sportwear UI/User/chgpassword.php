<?php
require_once "../db/connect.php"; // Ensure this file initializes $pdo
require_once "../login/checklogin.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['change_password'])) {
    $currentPassword = trim($_POST['current_password']); // Current password from the form
    $newPassword = $_POST['new_password']; // New password from the form
    $confirmPassword = $_POST['confirm_password']; // Confirm new password from the form
    $id = $_POST['id']; // User ID from the form

    // Check if new password and confirm password match
    if ($newPassword === $confirmPassword) {
        // Fetch the user's current password from the database
        $sql = "SELECT Password FROM users WHERE User_Id = :user_id";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(":user_id", $id);
        $stmt->execute();
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        // Check if the current password is correct
        if ($user && $currentPassword === $user['Password']) {
            // Current password is correct, update the password
            $sql = "UPDATE users SET Password = :password WHERE User_Id = :user_id";
            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(":password", $confirmPassword); // Store new password in plain text
            $stmt->bindParam(":user_id", $id);
            $result = $stmt->execute();

            if ($result) {
                // Password updated successfully, redirect to user profile
                header("location: userprofile.php?changedpassword=$id");
                exit();
            } else {
                $error = "Failed to update password.";
            }
        } else {
            $error = "Current password is incorrect.";
        }
    } else {
        $error = "New passwords do not match.";
    }
}

// Display errors (if any)
if (isset($error)) {
    echo $error;
}
?>