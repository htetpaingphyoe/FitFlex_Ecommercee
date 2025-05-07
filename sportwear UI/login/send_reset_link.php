<?php
require_once "../db/connect.php";
require_once "mailer.php"; // Ensure this path is correct

// Set the timezone
date_default_timezone_set('UTC');

$email = $_POST["email"];

// Validate email
if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    die("Invalid email format.");
}
// Check if the email exists in the users table
$sql = "SELECT * FROM users WHERE Gmail = :email";
$stmt = $pdo->prepare($sql);
$stmt->bindParam(':email', $email);
$stmt->execute();

if ($stmt->rowCount() == 0) {
    header("location:forgot_password.php?emailisnotregistered");
}

// Generate a secure random token
$token = bin2hex(random_bytes(16)); // 32-character hexadecimal token
// echo "Generated Token: $token<br>";

// Insert or update the token in the password_resets table
$sql = "INSERT INTO password_resets (email, token, expires)
        VALUES (:email, :token, DATE_ADD(NOW(), INTERVAL 30 MINUTE))
        ON DUPLICATE KEY UPDATE
        token = :token, expires = DATE_ADD(NOW(), INTERVAL 30 MINUTE)";

$stmt = $pdo->prepare($sql);

// Bind parameters
$params = [
    ':email' => $email,
    ':token' => $token,
];

// Execute the query
if (!$stmt->execute($params)) {
    die("Execution failed: " . $stmt->errorInfo()[2]);
}

// echo "Database updated with token: $token and expiry: NOW() + 30 minutes<br>";

// Debugging: Check if the query affected any rows
$rowCount = $stmt->rowCount();
if ($rowCount > 0) {
    // Include the mailer configuration
    $mail = mailer($mail);

    // Configure the email
    $mail->setFrom("noreply@example.com", "FitFlex");
    $mail->addAddress($email); // Ensure $email is a valid email address
    $mail->Subject = "Password Reset";
    $mail->isHTML(true);
    $mail->Body = <<<END
Click <a href="http://localhost:3000/sportwear UI/login/reset_password.php?token={$token}">here</a> 
to reset your password.
END;

    // Send the email
    try {
        if ($mail->send()) {
            echo "Message sent, please check your inbox. Please close this tab!!^-^";
        } else {
            echo "Message could not be sent. Mailer error: {$mail->ErrorInfo}";
        }
    } catch (Exception $e) {
        echo "Message could not be sent. Mailer error: {$mail->ErrorInfo}";
    }
}
?>