<?php
require_once "head.php";
require_once "navbar.php";
require_once "../db/connect.php"; // Include the file with database connection

// Start the session
if (!isset($_SESSION)) {
    session_start();
}

// Ensure the user is logged in
if (!isset($_SESSION['user'])) {
    header("../login/login.php");
}

$user_id = $_SESSION['user']['User_Id']; // Get the logged-in user's ID

// Fetch wishlist items from the database
try {
    $sql = "SELECT p.Product_ID, p.Name, p.Price, p.Size, p.Color, p.Image_URL
            FROM wishlist w
            JOIN products p ON w.product_id = p.Product_ID
            WHERE w.user_id = :user_id";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(['user_id' => $user_id]);
    $wishlist_items = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    die("Database error: " . $e->getMessage());
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Your Wishlist</title>
    <style>
        body {
            background-color: white;
        }
    </style>
</head>

<body>
    <h1 class="text-3xl font-bold text-gray-800 text-center mt-4 font-sans">Your Wish List</h1>
    <div class="font-sans max-w-6xl h-auto max-md:max-w-xl mx-auto bg-white py-8 px-4">
        <!-- Wishlist Items Container -->
        <div class="flex flex-wrap gap-6 justify-center">
            <?php if (!empty($wishlist_items)): ?>
                <?php foreach ($wishlist_items as $product): ?>
                    <!-- Product Card -->
                    <div class="flex flex-col w-80 p-4 bg-gray-50 rounded-lg shadow-sm border-2 hover:shadow-xl transition-shadow">
                        <!-- Product Image -->
                        <div class="w-full h-52 bg-white rounded-lg border border-gray-200 overflow-hidden">
                            <img src="<?= "../product_img/".htmlspecialchars($product['Image_URL']) ?>" class="w-full h-full object-contain" alt="<?= htmlspecialchars($product['Name']) ?>" />
                        </div>
                        <!-- Product Details -->
                        <div class="flex flex-col mt-4">
                            <div>
                            <h3 class="text-lg font-bold text-gray-800"><?= "Name: " . htmlspecialchars($product['Name']) ?></h3>
                            <p class="text-sm text-gray-500 mt-1">Size: <?= htmlspecialchars($product['Size']) ?></p>
                            <p class="text-sm text-gray-500 mt-1">Color: <?= htmlspecialchars($product['Color']) ?></p>
                            <p class="text-lg font-bold text-gray-800 mt-2"><?= "Price: $" . number_format($product['Price'], 2) ?></p>
                            </div>
                            <!-- Remove from Wishlist and Add to Cart Buttons -->
                             <div>
                             <form action="removewishlist.php" method="POST" class="mt-4 flex justify-center gap-2 p-4 border-2 hover:-translate-y-2 duration-300">
                                <input type="hidden" name="id" value="<?= $product['Product_ID'] ?>">
                                <button type="submit" name="remove" class="font-semibold text-red-500 text-sm flex items-center gap-1 hover:text-red-600 transition-colors">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 fill-current inline" viewBox="0 0 24 24">
                                        <path d="M19 7a1 1 0 0 0-1 1v11.191A1.92 1.92 0 0 1 15.99 21H8.01A1.92 1.92 0 0 1 6 19.191V8a1 1 0 0 0-2 0v11.191A3.918 3.918 0 0 0 8.01 23h7.98A3.918 3.918 0 0 0 20 19.191V8a1 1 0 0 0-1-1Zm1-3h-4V2a1 1 0 0 0-1-1H9a1 1 0 0 0-1 1v2H4a1 1 0 0 0 0 2h16a1 1 0 0 0 0-2ZM10 4V3h4v1Z" data-original="#000000"></path>
                                        <path d="M11 17v-7a1 1 0 0 0-2 0v7a1 1 0 0 0 2 0Zm4 0v-7a1 1 0 0 0-2 0v7a1 1 0 0 0 2 0Z" data-original="#000000"></path>
                                    </svg>
                                    Remove
                                </button>
                                </form>
                            </div>
                            <div>
                                <!-- Add to Cart Button -->
                                <form action="addtocart.php" method="POST" class="gap-2">
                                    <input type="hidden" name="id" value="<?= $product['Product_ID'] ?>">
                                    <button class="cartBtn" type="submit">
                                        <svg class="cart" fill="white" viewBox="0 0 576 512" height="1em" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M0 24C0 10.7 10.7 0 24 0H69.5c22 0 41.5 12.8 50.6 32h411c26.3 0 45.5 25 38.6 50.4l-41 152.3c-8.5 31.4-37 53.3-69.5 53.3H170.7l5.4 28.5c2.2 11.3 12.1 19.5 23.6 19.5H488c13.3 0 24 10.7 24 24s-10.7 24-24 24H199.7c-34.6 0-64.3-24.6-70.7-58.5L77.4 54.5c-.7-3.8-4-6.5-7.9-6.5H24C10.7 48 0 37.3 0 24zM128 464a48 48 0 1 1 96 0 48 48 0 1 1 -96 0zm336-48a48 48 0 1 1 0 96 48 48 0 1 1 0-96z"></path>
                                        </svg>
                                        ADD TO CART
                                        <svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 640 512" class="product">
                                            <path d="M211.8 0c7.8 0 14.3 5.7 16.7 13.2C240.8 51.9 277.1 80 320 80s79.2-28.1 91.5-66.8C413.9 5.7 420.4 0 428.2 0h12.6c22.5 0 44.2 7.9 61.5 22.3L628.5 127.4c6.6 5.5 10.7 13.5 11.4 22.1s-2.1 17.1-7.8 23.6l-56 64c-11.4 13.1-31.2 14.6-44.6 3.5L480 197.7V448c0 35.3-28.7 64-64 64H224c-35.3 0-64-28.7-64-64V197.7l-51.5 42.9c-13.3 11.1-33.1 9.6-44.6-3.5l-56-64c-5.7-6.5-8.5-15-7.8-23.6s4.8-16.6 11.4-22.1L137.7 22.3C155 7.9 176.7 0 199.2 0h12.6z"></path>
                                        </svg>
                                    </button>
                                </form>
                             </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <h2 class="text-gray-800 text-lg font-semibold">Your wishlist is empty.</h2>
            <?php endif; ?>
        </div>
    </div>
    <?php require_once "footer.php"; ?>
</body>
</html>