<?php
require_once "head.php";
require_once "navbar.php";
require_once "../admin/data.php";

$id = 0;
if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $id = (int)$_GET['id']; // Sanitize the input
}
$category = "";
if (isset($_GET["category"])) {
    $category = $_GET["category"]; // Sanitize the input
}

$product = getProductById($id, $pdo); // Fetch product details
$category_product = getProductByCategory($category,$pdo,$id);
// print_r($category_product);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Product Page</title>
    <!-- Tailwind CSS -->
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <!-- Custom Styles -->
    <style>
        /* Custom CSS for smooth transitions */
        .transition-all {
            transition: all 0.3s ease;
        }
    </style>
</head>
<body class="bg-gray-100 font-sans">

    <!-- Header -->
    <?php require_once "navbar.php"; ?>

    <!-- Hero Section -->
    <section class="max-w-7xl mx-auto p-8" style="font-family: 'Oswald', serif;">
        <div class="flex flex-col lg:flex-row gap-12">
            <!-- Product Image -->
            <div class="w-full lg:w-1/2">
                <div class="bg-white rounded-lg shadow-lg overflow-hidden p-6 flex items-center justify-center">
                    <img src="<?= "../product_img/".$product['Image_URL'] ?>" alt="Product Image" class="lg:w-[500px] lg:h-[450px] md:w-[500px] md:h-[450px] transition-transform hover:scale-105 rounded-md">
                </div>
            </div>
            <!-- Product Details -->
            <div class="w-full lg:w-1/2">
                <h1 class="text-4xl font-bold text-gray-800 mb-6"><?= $product['Name'] ?></h1>
                <p class="text-3xl font-bold text-purple-600 mb-6">$<?= $product['Price'] ?></p>
                <div class="space-y-4 mb-8">
                    <p class="text-xl font-medium text-gray-600">Brand: <?= $product['Brand'] ?></p>
                    <p class="text-xl font-medium text-gray-600">Size: <?= $product['Size'] ?></p>
                    <p class="text-xl font-medium text-gray-600">Color: <?= $product['Color'] ?></p>
                </div>
                <!-- Action Buttons -->
                <div class="flex gap-4">
                    
                    <form action="addtocart.php" method="POST">
                    <input type="hidden" name="id" value="<?= $product['Product_ID'] ?>">
                        <button type="submit" class="bg-white border border-purple-600 text-purple-600 px-14 py-3 rounded-lg font-medium hover:bg-purple-100 transition-colors">Add to Cart</button>
                    </form>
                </div>
            </div>
        </div>
    </section>

    <!-- Tabs Section -->
    <div class="max-w-7xl mx-auto p-8">
        <!-- Description and Reviews Header -->
        <div class="flex justify-start gap-4 items-center mb-8">
            <h2 id="descriptionHeader" class="text-2xl font-bold text-gray-800 border-b-2 border-black">Description</h2>
            <h2 id="reviewHeader" class="text-2xl font-bold text-gray-800 cursor-pointer hover:text-purple-600 transition-all">Reviews</h2>
        </div>

        <!-- Description Content -->
        <div id="descriptionContent" class="bg-white p-6 rounded-lg shadow-lg">
            <h3 class="text-xl font-bold text-gray-800 mb-4">Product Description</h3>
            <p><?= $product['Description'] ?></p>
        </div>

        <!-- Reviews Content (Hidden by Default) -->
        <div id="reviewContent" class="bg-white p-6 rounded-lg shadow-lg mt-8 hidden">
            <h3 class="text-xl font-bold text-gray-800 mb-4">Reviews</h3>
            <p class="text-gray-700">Incoming Feature</p>
        </div>
    </div>

    <!-- Related Products Section -->
    <section class="max-w-7xl mx-auto p-8">
    <h2 class="text-3xl font-bold text-gray-800 mb-8">Related Products</h2>
    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
        <!-- Related Product Item -->
        <?php
        // Limit the number of cards to 4 (or any number you want)
        $limit = 4;
        $limited_products = array_slice($category_product, 0, $limit);
        foreach($limited_products as $category): ?>
        <div class="bg-white rounded-lg overflow-hidden shadow-lg hover:shadow-xl transition-shadow duration-300 transform hover:-translate-y-2 transition-transform duration-300 h-full flex flex-col">
            <!-- Image Container -->
            <div class="relative overflow-hidden group flex-grow">
                <img src="<?= '../product_img/' . $category['Image_URL'] ?>" alt="Related Product" class="w-full aspect-[4/3] object-cover group-hover:scale-110 transition-transform duration-300">
            </div>
            <!-- Product Details -->
            <div class="p-4 flex flex-col">
                <h3 class="text-xl font-bold text-gray-800 hover:text-purple-600 transition-colors duration-300"><?= $category['Name'] ?></h3>
                <p class="text-gray-600 text-lg">Price: $<?= $category['Price'] ?></p>
                <a href="<?php echo 'productoverview.php?id=' . $category['Product_ID'] . '&category=' . $product['Category']; ?>" class="inline-block w-full text-center mt-4 text-white bg-gradient-to-r from-purple-600 to-blue-600 px-6 py-2 rounded-lg font-medium hover:from-purple-700 hover:to-blue-700 transition-all duration-300">
                    View Product
                </a>
            </div>
        </div>
        <?php endforeach ?>
        <!-- More Related Products... -->
    </div>
</section>

    <!-- Footer -->
    <?php require_once "footer.php"; ?>

    <!-- JavaScript for Tabs -->
    <script>
        // Get the elements
        const reviewHeader = document.getElementById('reviewHeader');
        const descriptionHeader = document.getElementById('descriptionHeader');
        const reviewContent = document.getElementById('reviewContent');
        const descriptionContent = document.getElementById('descriptionContent');

        // Add a click event listener to the Reviews header
        reviewHeader.addEventListener('click', () => {
            // Toggle the visibility of the Reviews content
            reviewContent.classList.toggle('hidden');
            // Toggle the bottom border of the Reviews header
            reviewHeader.classList.add('border-b-2', 'border-black');

            // Hide the Description content
            descriptionContent.classList.add('hidden');
            // Remove the bottom border of the Description header
            descriptionHeader.classList.remove('border-b-2', 'border-black');
        });

        // Add a click event listener to the Description header
        descriptionHeader.addEventListener('click', () => {
            // Show the Description content
            descriptionContent.classList.remove('hidden');
            // Add the bottom border of the Description header
            descriptionHeader.classList.add('border-b-2', 'border-black');

            // Hide the Reviews content
            reviewContent.classList.add('hidden');
            // Remove the bottom border of the Reviews header
            reviewHeader.classList.remove('border-b-2', 'border-black');
        });
    </script>
</body>
</html>