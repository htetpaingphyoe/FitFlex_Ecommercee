<?php
require_once "head.php";
require_once "navbar.php";
require_once "../db/connect.php";
require_once "../admin/data.php";
require_once "../login/checklogin.php";
// unset($_SESSION['cart']);
// Pagination logic
$limit = 8; // Number of products per page
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1; // Current page
$offset = ($page - 1) * $limit; // Offset for SQL query

// Check if a search query is present
$searchQuery = isset($_GET['query']) ? $_GET['query'] : '';

// Check if a category is selected
$selectedCategory = isset($_GET['category']) ? $_GET['category'] : '';

// Check if a price range is selected
$minPrice = isset($_GET['min_price']) ? (float)$_GET['min_price'] : 0;
$maxPrice = isset($_GET['max_price']) ? (float)$_GET['max_price'] : 0;

// Check if a brand is selected
$selectedBrand = isset($_GET['brand']) ? $_GET['brand'] : '';

// Check if a color is selected
$selectedColor = isset($_GET['color']) ? $_GET['color'] : '';

// Check if a size is selected
$selectedSize = isset($_GET['size']) ? $_GET['size'] : '';

// Base SQL query
$sql = "SELECT * FROM products";
$countSql = "SELECT COUNT(*) FROM products";

// Add conditions based on search query, category, price range, brand, color, and size
$conditions = [];
$params = [];
// Fetch categories from the database
$sqlforcategory = "SELECT DISTINCT Category FROM products"; // Use DISTINCT to avoid duplicates
$stmt = $pdo->prepare($sqlforcategory);
$stmt->execute();
$categories1 = $stmt->fetchAll(PDO::FETCH_COLUMN); // Fetch all categories as an array
// Fetch brands from the database
$sqlforbrand = "SELECT DISTINCT brand FROM products"; // Use DISTINCT to avoid duplicates
$stmt = $pdo->prepare($sqlforbrand);
$stmt->execute();
$brands = $stmt->fetchAll(PDO::FETCH_COLUMN); // Fetch all brands as an array

$sqlforcolor = "SELECT DISTINCT color FROM products";
$stmt = $pdo->prepare($sqlforcolor);
$stmt->execute();
$colors = $stmt->fetchAll(PDO::FETCH_COLUMN);

$sqlfofdistinct = "SELECT DISTINCT size FROM products";
$stmt = $pdo->prepare($sqlfofdistinct);
$stmt->execute();
$sizes = $stmt->fetchAll(PDO::FETCH_COLUMN);

// Get selected values from the query string
$selectedBrand = $_GET['brand'] ?? '';
$selectedColor = $_GET['color'] ?? '';
$selectedSize = $_GET['size'] ?? '';
if ($searchQuery) {
    $conditions[] = "name LIKE :query";
    $params[':query'] = '%' . $searchQuery . '%';
}

if ($selectedCategory) {
    $conditions[] = "category = :category";
    $params[':category'] = $selectedCategory;
}

if ($minPrice || $maxPrice) {
    $conditions[] = "price BETWEEN :min_price AND :max_price";
    $params[':min_price'] = $minPrice;
    $params[':max_price'] = $maxPrice;
}

if ($selectedBrand) {
    $conditions[] = "brand = :brand";
    $params[':brand'] = $selectedBrand;
}

if ($selectedColor) {
    $conditions[] = "color = :color";
    $params[':color'] = $selectedColor;
}

if ($selectedSize) {
    $conditions[] = "size = :size";
    $params[':size'] = $selectedSize;
}

// Combine conditions
if (!empty($conditions)) {
    $sql .= " WHERE " . implode(" AND ", $conditions);
    $countSql .= " WHERE " . implode(" AND ", $conditions);
}

// Add pagination
$sql .= " LIMIT :limit OFFSET :offset";

// Fetch products
$stmt = $pdo->prepare($sql);
foreach ($params as $key => &$val) {
    $stmt->bindValue($key, $val, is_int($val) ? PDO::PARAM_INT : PDO::PARAM_STR);
}
$stmt->bindValue(':limit', $limit, PDO::PARAM_INT);
$stmt->bindValue(':offset', $offset, PDO::PARAM_INT);
$stmt->execute();
$Allproducts = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Fetch total number of products
$totalProducts = $pdo->prepare($countSql);
foreach ($params as $key => &$val) {
    $totalProducts->bindValue($key, $val, is_int($val) ? PDO::PARAM_INT : PDO::PARAM_STR);
}
$totalProducts->execute();
$totalProducts = $totalProducts->fetchColumn();

$totalPages = ceil($totalProducts / $limit); // Total pages
?>

<section class="py-14 relative">
    <div class="w-full max-w-12xl mx-auto px-4 md:px-4">
        <div class="grid grid-cols-12">
            <!-- Sidebar -->
            <div class="col-span-12 md:col-span-3 w-full max-md:max-w-md max-md:mx-auto">
                <div class="box rounded-xl border border-gray-300 bg-white p-6 w-full md:max-w-sm">
                    <form method="GET" action="" id="filterForm" style="font-family: 'Roboto',san-serif;">
                        <!-- Category Filter -->
                        <label for="category" class="block mb-2 text-md font-medium text-gray-600 w-full">Category</label>
                        <div class="relative w-full mb-8"> 
                            <select id="category" name="category" class="h-12 border border-gray-300 text-gray-900 text-sm font-medium rounded-full block w-full py-2.5 px-4 appearance-none relative focus:outline-none bg-white">
                                <option value="">Choose Category</option>
                                <?php foreach ($categories1 as $category): ?>
                                    <option value="<?= htmlspecialchars($category) ?>" <?= $selectedCategory === $category ? 'selected' : '' ?>>
                                        <?= htmlspecialchars($category) ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                            <svg class="absolute top-1/2 -translate-y-1/2 right-4 z-50" width="16" height="16"
                                viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M12.0002 5.99845L8.00008 9.99862L3.99756 5.99609" stroke="#111827"
                                    stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round" />
                            </svg>
                        </div>

                        <!-- Price Range Filter -->
                        <label for="price" class="block mb-2 text-md font-medium text-gray-600 w-full">Price Range</label>
                        <div class="flex gap-2 mb-8">
                            <input type="number" name="min_price" placeholder="Min Price" value="<?= $minPrice ?>"
                                class="h-12 border border-gray-300 text-gray-900 text-xs font-medium rounded-full block w-full py-2.5 px-4 appearance-none relative focus:outline-none bg-white">
                            <input type="number" name="max_price" placeholder="Max Price" value="<?= $maxPrice ?>"
                                class="h-12 border border-gray-300 text-gray-900 text-xs font-medium rounded-full block w-full py-2.5 px-4 appearance-none relative focus:outline-none bg-white">
                        </div>

                        <!-- Brand Filter -->
                        <label for="brand" class="block mb-2 text-md font-medium text-gray-600 w-full">Brand</label>
                        <div class="relative w-full mb-8">
                            <select id="brand" name="brand" class="h-12 border border-gray-300 text-gray-900 text-sm font-medium rounded-full block w-full py-2.5 px-4 appearance-none relative focus:outline-none bg-white">
                                <option value="">Choose Brand</option>
                                <?php foreach ($brands as $brand): ?>
                                    <option value="<?= htmlspecialchars($brand) ?>" <?= $selectedBrand === $brand ? 'selected' : '' ?>>
                                        <?= htmlspecialchars($brand) ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                            <svg class="absolute top-1/2 -translate-y-1/2 right-4 z-50" width="16" height="16"
                                viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M12.0002 5.99845L8.00008 9.99862L3.99756 5.99609" stroke="#111827"
                                    stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round" />
                            </svg>
                        </div>

                        <!-- Color Filter -->
                        <label for="color" class="block mb-2 text-md font-medium text-gray-600 w-full">Color</label>
                        <div class="relative w-full mb-8">
                            <select id="color" name="color" class="block w-full px-4 py-3 pr-8 text-sm font-medium text-gray-900 bg-white border border-gray-300 rounded-full appearance-none focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                                <option value="">Choose Color</option>
                                <?php foreach ($colors as $color): ?>
                                    <option value="<?= htmlspecialchars($color) ?>" <?= $selectedColor === $color ? 'selected' : '' ?>>
                                        <?= htmlspecialchars($color) ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                            <svg class="absolute top-1/2 -translate-y-1/2 right-4 z-50" width="16" height="16"
                                viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M12.0002 5.99845L8.00008 9.99862L3.99756 5.99609" stroke="#111827"
                                    stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round" />
                            </svg>
                        </div>

                        <!-- Size Filter -->
                        <label for="size" class="block mb-2 text-md font-medium text-gray-600 w-full">Size</label>
                        <div class="relative w-full mb-8">
                            <select id="size" name="size" class="block w-full px-4 py-3 pr-8 text-sm font-medium text-gray-900 bg-white border border-gray-300 rounded-full appearance-none focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                                <option value="">Choose Size</option>
                                <?php foreach ($sizes as $size): ?>
                                    <option value="<?= htmlspecialchars($size) ?>" <?= $selectedSize === $size ? 'selected' : '' ?>>
                                        <?= htmlspecialchars($size) ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                            <svg class="absolute top-1/2 -translate-y-1/2 right-4 z-50" width="16" height="16"
                                viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M12.0002 5.99845L8.00008 9.99862L3.99756 5.99609" stroke="#111827"
                                    stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round" />
                            </svg>
                        </div>

                        <button type="submit"
                            class="w-full py-2.5 flex items-center justify-center gap-2 rounded-full bg-indigo-600 text-white font-semibold text-md shadow-sm shadow-transparent transition-all duration-500 hover:bg-indigo-700 hover:shadow-indigo-200">
                            Filter
                        </button>

                        <!-- Reset Button -->
                        <button type="reset" id="resetButton"
                            class="w-full py-2.5 mt-4 flex items-center justify-center gap-2 rounded-full bg-gray-600 text-white font-semibold text-md shadow-sm shadow-transparent transition-all duration-500 hover:bg-gray-700 hover:shadow-gray-200">
                            Reset
                        </button>
                    </form>
                </div>
            </div>

            <!-- Product Page -->
            <div class="col-span-12 md:col-span-9 mt-6 md:mt-0 md:ml-10" style="font-family: 'Roboto', serif;">
                <div class=" bg-white p-6 mx-auto max-w-[1400px]" style="font-family: 'Roboto', serif;">

                    <!-- Display "No Products Found" message if no products match the filters -->
                    <?php if (empty($Allproducts)): ?>
                        <div class="text-center py-10">
                            <p class="text-xl font-bold text-gray-800">No products found.</p>
                            <p class="text-gray-600">Try adjusting your filters or search terms.</p>
                        </div>
                    <?php else: ?>
                        <div class="grid grid-cols-1 md:grid-cols-3 lg:grid-cols-4 gap-4 sm:gap-6">
                            <?php foreach ($Allproducts as $product): ?>
                                <!-- Product Cards -->
                                <div class="group overflow-hidden cursor-pointer relative">
                                    <div class="bg-gray-100 w-full overflow-hidden">
                                        <div class="relative pt-[133.33%]"> <!-- 3:4 aspect ratio -->
                                            <a href="productoverview.php?id=<?= $product["Product_ID"] . "&category=" . $product['Category'] ?>"><img
                                                    src="<?= '../product_img/' . $product['Image_URL'] ?>"
                                                    alt="Product 1"
                                                    class="absolute top-0 left-0 w-full h-full object-cover object-bottom hover:scale-110 transition-all duration-700" /></a>
                                        </div>
                                    </div>

                                    <div class="p-4 relative">
                                        <!-- Wishlist and Add to Cart Buttons (Hidden by default, shown on hover) -->
                                        <div class="flex flex-wrap justify-between gap-2 w-full absolute px-4 pt-3 z-10
                                            transition-all duration-500
                                            left-0 right-0
                                            group-hover:bottom-20
                                            lg:bottom-5 lg:opacity-0 lg:group-hover:opacity-100
                                            max-lg:bottom-20 max-lg:py-3 max-lg:bg-white/60">

                                            <!-- Wishlist Button -->
                                            <form action="addtowishlist.php" method="POST" class="bg-white p-2 rounded-full shadow-md">
                                                <input type="hidden" name="id" value="<?= $product['Product_ID'] ?>">

                                                <button type="submit" title="Add to wishlist" class="bg-transparent outline-none border-none">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="fill-gray-800 w-5 h-5 inline-block" viewBox="0 0 64 64">
                                                        <path
                                                            d="M45.5 4A18.53 18.53 0 0 0 32 9.86 18.5 18.5 0 0 0 0 22.5C0 40.92 29.71 59 31 59.71a2 2 0 0 0 2.06 0C34.29 59 64 40.92 64 22.5A18.52 18.52 0 0 0 45.5 4ZM32 55.64C26.83 52.34 4 36.92 4 22.5a14.5 14.5 0 0 1 26.36-8.33 2 2 0 0 0 3.27 0A14.5 14.5 0 0 1 60 22.5c0 14.41-22.83 29.83-28 33.14Z"
                                                            data-original="#000000"></path>
                                                    </svg>
                                                </button>
                                            </form>

                                            <!-- Add to Cart Button -->
                                            <form action="addtocart.php" method="POST" class="bg-white p-2 rounded-full shadow-md">
                                                <input type="hidden" name="id" value="<?= $product['Product_ID'] ?>">
                                                <button type="submit" title="Add to cart" class="bg-transparent outline-none border-none">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="fill-gray-800 w-5 h-5 inline-block" viewBox="0 0 512 512">
                                                        <path
                                                            d="M164.96 300.004h.024c.02 0 .04-.004.059-.004H437a15.003 15.003 0 0 0 14.422-10.879l60-210a15.003 15.003 0 0 0-2.445-13.152A15.006 15.006 0 0 0 497 60H130.367l-10.722-48.254A15.003 15.003 0 0 0 105 0H15C6.715 0 0 6.715 0 15s6.715 15 15 15h77.969c1.898 8.55 51.312 230.918 54.156 243.71C131.184 280.64 120 296.536 120 315c0 24.812 20.188 45 45 45h272c8.285 0 15-6.715 15-15s-6.715-15-15-15H165c-8.27 0-15-6.73-15-15 0-8.258 6.707-14.977 14.96-14.996zM477.114 90l-51.43 180H177.032l-40-180zM150 405c0 24.813 20.188 45 45 45s45-20.188 45-45-20.188-45-45-45-45 20.188-45 45zm45-15c8.27 0 15 6.73 15 15s-6.73 15-15 15-15-6.73-15-15 6.73-15 15-15zm167 15c0 24.813 20.188 45 45 45s45-20.188 45-45-20.188-45-45-45-45 20.188-45 45zm45-15c8.27 0 15 6.73 15 15s-6.73 15-15 15-15-6.73-15-15 6.73-15 15-15zm0 0"
                                                            data-original="#000000"></path>
                                                    </svg>
                                                </button>
                                            </form>
                                        </div>

                                        <div class="z-20 relative bg-white">
                                            <h6 class="text-lg font-semibold text-gray-800 truncate"><?= $product['Name'] ?></h6>
                                            <h6 class="text-md text-gray-600 mt-2"><?= "$ " . $product['Price'] ?></h6>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach ?>
                        </div>

                        <!-- Pagination -->
                        <div class="flex justify-center items-center mt-8 space-x-2">
                            <?php if ($page > 1): ?>
                                <a href="?page=<?= $page - 1 ?>&category=<?= $selectedCategory ?>&min_price=<?= $minPrice ?>&max_price=<?= $maxPrice ?>&brand=<?= $selectedBrand ?>&color=<?= $selectedColor ?>&size=<?= $selectedSize ?><?= $searchQuery ? '&query=' . urlencode($searchQuery) : '' ?>"
                                    class="px-4 py-2 bg-gray-200 rounded-lg hover:bg-gray-300">Previous</a>
                            <?php endif; ?>

                            <?php for ($i = 1; $i <= $totalPages; $i++): ?>
                                <a href="?page=<?= $i ?>&category=<?= $selectedCategory ?>&min_price=<?= $minPrice ?>&max_price=<?= $maxPrice ?>&brand=<?= $selectedBrand ?>&color=<?= $selectedColor ?>&size=<?= $selectedSize ?><?= $searchQuery ? '&query=' . urlencode($searchQuery) : '' ?>"
                                    class="px-4 py-2 rounded-lg <?= $i === $page ? 'bg-blue-500 text-white' : 'bg-gray-200 hover:bg-gray-300' ?>">
                                    <?= $i ?>
                                </a>
                            <?php endfor; ?>

                            <?php if ($page < $totalPages): ?>
                                <a href="?page=<?= $page + 1 ?>&category=<?= $selectedCategory ?>&min_price=<?= $minPrice ?>&max_price=<?= $maxPrice ?>&brand=<?= $selectedBrand ?>&color=<?= $selectedColor ?>&size=<?= $selectedSize ?><?= $searchQuery ? '&query=' . urlencode($searchQuery) : '' ?>"
                                    class="px-4 py-2 bg-gray-200 rounded-lg hover:bg-gray-300">Next</a>
                            <?php endif; ?>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- JavaScript to Reset the Form -->
<script>
    document.getElementById('resetButton').addEventListener('click', function() {
        // Reset the form fields
        document.getElementById('filterForm').reset();

        // Redirect to the base URL (without any filters)
        window.location.href = window.location.pathname;
    });
</script>

<?php
require_once "footer.php";
?>