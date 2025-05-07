<?php
require_once "../db/connect.php";

// Get the token from the URL
$token = urldecode($_GET["token"]); // Decode the token
// echo "Token from URL: $token<br>";

if (empty($token)) {
    die("Token is missing.");
}

// Check if the token is valid and not expired
$sql = "SELECT email, expires FROM password_resets 
        WHERE token = :token AND expires > NOW()";

$stmt = $pdo->prepare($sql);
$stmt->bindParam(':token', $token);
$stmt->execute();

$row = $stmt->fetch(PDO::FETCH_ASSOC);

if ($row) {
    // Token is valid
    $email = $row["email"];
    $tokenExpiry = strtotime($row["expires"]); // Convert expiry to timestamp

    // Check if the token has expired
    if (time() > $tokenExpiry) {
        echo "Token has expired.";
        exit;
    }

    // Handle the password reset form submission
    if ($_SERVER["REQUEST_METHOD"] === "POST") {
        $new_password = $_POST["new_password"];
        $hashed_password = password_hash($new_password, PASSWORD_DEFAULT);

        // Update the user's password in the database
        $sql = "UPDATE users SET password = :hashed_password WHERE email = :email";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':hashed_password', $hashed_password);
        $stmt->bindParam(':email', $email);

        if ($stmt->execute()) {
            echo "Password updated successfully.";

            // Delete the used token from the password_resets table
            $sql = "DELETE FROM password_resets WHERE email = :email";
            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(':email', $email);
            $stmt->execute();
        } else {
            echo "Failed to update password.";
        }
    } else {
        // Display the password reset form
?>
        <!DOCTYPE html>
        <html lang="en">

        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Reset Password</title>
            <script src="https://cdn.tailwindcss.com"></script>
            <style>
                /* Custom styles for the eye icon */
                .toggle-icon {
                    cursor: pointer;
                    transition: color 0.3s ease;
                }

                .toggle-icon:hover {
                    color: #4a5568;
                    /* Change to a darker gray on hover */
                }
            </style>
        </head>

        <body class="bg-gray-100 flex items-center justify-center min-h-screen">
            <div class="bg-white p-8 rounded-lg shadow-lg w-full max-w-md">
                <h2 class="text-2xl font-bold text-center text-gray-800 mb-6">Reset Your Password</h2>
                <form method="POST" action="update_password.php">
                    <!-- Hidden token field -->
                    <input type="hidden" name="token" value="<?= htmlspecialchars($token) ?>">

                    <!-- New Password Field -->
                    <div class="mb-6 relative">
                        <label for="new_password" class="block text-sm font-medium text-gray-700 mb-2">New Password</label>
                        <div class="relative">
                            <input
                                type="password"
                                id="new_password"
                                name="new_password"
                                placeholder="Enter your new password"
                                required
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all">
                            <!-- Eye icon to toggle password visibility -->
                            <span
                                class="toggle-icon absolute right-3 top-1/2 transform -translate-y-1/2 text-gray-500"
                                onclick="togglePasswordVisibility()">
                                👁️
                            </span>
                        </div>
                    </div>

                    <!-- Submit Button -->
                    <button
                        type="submit"
                        class="w-full bg-blue-600 text-white py-2 px-4 rounded-lg hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition-all">
                        Reset Password
                    </button>
                </form>
            </div>

            <script>
                // Toggle password visibility
                function togglePasswordVisibility() {
                    const passwordInput = document.getElementById('new_password');
                    const toggleIcon = document.querySelector('.toggle-icon');

                    if (passwordInput.type === 'password') {
                        passwordInput.type = 'text';
                        toggleIcon.textContent = '👁️';
                    } else {
                        passwordInput.type = 'password';
                        toggleIcon.textContent = '👁️';
                    }
                }
            </script>
        </body>

        </html>
<?php
    }
} else {
    echo "Invalid or expired token.";
}
?>