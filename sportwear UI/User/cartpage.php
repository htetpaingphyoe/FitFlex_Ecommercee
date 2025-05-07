<?php
session_start();
require_once "head.php";
require_once "navbar.php";
require_once "../login/checklogin.php";

$total = 0; // Initialize total
$total_qty = 0; // Initialize total quantity

// Calculate the total amount and total quantity
if (isset($_SESSION['cart']) && !empty($_SESSION['cart'])) {
    foreach ($_SESSION['cart'] as $id => $product) {
        if (is_array($product) && isset($product['price']) && isset($product['qty'])) {
            $total += $product['price'] * $product['qty'];
            $total_qty += $product['qty'];
        }
    }
}

// Store the totals in the session
$_SESSION['total'] = $total;
// echo $total;
$_SESSION['total_qty'] = $total_qty;

// Debugging log
error_log("Cart totals - qty: $total_qty, total: $total");
?>

<head>
    <style>
        body {
            background-color: white;
        }
    </style>
</head>

<div class="font-sans max-w-6xl h-full max-md:max-w-xl mx-auto bg-white py-8 px-4">
    <h1 class="text-3xl font-bold text-gray-800 text-center mb-8">Shopping Cart</h1>

    <div class="grid md:grid-cols-3 gap-8">
        <!-- Cart Items -->
        <div class="md:col-span-2 space-y-6">
            <?php if (isset($_SESSION['cart']) && !empty($_SESSION['cart'])): ?>
                <?php foreach ($_SESSION['cart'] as $id => $product): ?>
                    <?php $totalamount += $product['price'] * $product['qty']; ?>
                    <div class="grid grid-cols-3 items-start gap-6 p-4 bg-gray-50 rounded-lg shadow-sm hover:shadow-md transition-shadow">
                        <div class="col-span-2 flex items-start gap-6">
                            <div class="w-28 h-28 max-sm:w-24 max-sm:h-24 shrink-0 bg-white p-2 rounded-lg border border-gray-200">
                                <img src="<?= htmlspecialchars("../product_img/".$product['img_url']) ?>" class="w-full h-full object-contain" alt="<?= htmlspecialchars($product['name']) ?>" />
                            </div>
                            <div class="flex flex-col">
                                <h3 class="text-lg font-bold text-gray-800"><?= htmlspecialchars($product['name']) ?></h3>
                                <p class="text-sm text-gray-500 mt-1">Size: <?= htmlspecialchars($product['size']) ?></p>
                                <form action="controlcart.php" method="POST" class="mt-4">
                                    <input type="hidden" name="id" value="<?= $product['id'] ?>">
                                    <button type="submit" name="remove" class="font-semibold text-red-500 text-sm flex items-center gap-1 hover:text-red-600 transition-colors">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 fill-current inline" viewBox="0 0 24 24">
                                            <path d="M19 7a1 1 0 0 0-1 1v11.191A1.92 1.92 0 0 1 15.99 21H8.01A1.92 1.92 0 0 1 6 19.191V8a1 1 0 0 0-2 0v11.191A3.918 3.918 0 0 0 8.01 23h7.98A3.918 3.918 0 0 0 20 19.191V8a1 1 0 0 0-1-1Zm1-3h-4V2a1 1 0 0 0-1-1H9a1 1 0 0 0-1 1v2H4a1 1 0 0 0 0 2h16a1 1 0 0 0 0-2ZM10 4V3h4v1Z" data-original="#000000"></path>
                                            <path d="M11 17v-7a1 1 0 0 0-2 0v7a1 1 0 0 0 2 0Zm4 0v-7a1 1 0 0 0-2 0v7a1 1 0 0 0 2 0Z" data-original="#000000"></path>
                                        </svg>
                                        REMOVE
                                    </button>
                                </form>
                            </div>
                        </div>
                        
                        <div class="ml-auto">
                            <h4 class="text-xl font-bold text-gray-800">$<?= number_format($product['price'], 2) ?></h4>
                            <form action="controlcart.php" method="POST" class="mt-4 flex items-center border border-gray-300 rounded-lg overflow-hidden w-24">
                                <input type="hidden" name="id" value="<?= $product['id'] ?>">
                                <button type="submit" name="decrease" class="px-3 py-1.5 bg-gray-100 hover:bg-gray-200 transition-colors">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-2 fill-current" viewBox="0 0 124 124">
                                        <path d="M112 50H12C5.4 50 0 55.4 0 62s5.4 12 12 12h100c6.6 0 12-5.4 12-12s-5.4-12-12-12z" data-original="#000000"></path>
                                    </svg>
                                </button>
                                <input type="text" class="border border-gray-200 rounded-full w-10 aspect-square outline-none text-gray-900 font-semibold text-sm py-1.5 px-3 bg-gray-100 text-center" value="<?= $product['qty'] ?>" readonly>
                                <button type="submit" name="increase" class="px-3 py-1.5 bg-gray-100 hover:bg-gray-200 transition-colors">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-2 fill-current" viewBox="0 0 42 42">
                                        <path d="M37.059 16H26V4.941C26 2.224 23.718 0 21 0s-5 2.224-5 4.941V16H4.941C2.224 16 0 18.282 0 21s2.224 5 4.941 5H16v11.059C16 39.776 18.282 42 21 42s5-2.224 5-4.941V26h11.059C39.776 26 42 23.718 42 21s-2.224-5-4.941-5z" data-original="#000000"></path>
                                    </svg>
                                </button>
                            </form>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <h2 class="text-gray-800 text-lg font-semibold">There are no items in your cart.</h2>
            <?php endif; ?>
        </div>

        <!-- Order Summary -->
        <div class="bg-gray-50 rounded-lg p-6 shadow-sm">
            <h3 class="text-xl font-bold text-gray-800 border-b border-gray-300 pb-3">Order Summary</h3>

            <form class="mt-6" action="checkout.php" method="POST">
                <div>
                    <h3 class="text-lg font-semibold text-gray-800 mb-4">Enter Details</h3>
                    <div class="space-y-4">
                        <div class="relative flex items-center">
                            <input type="text" name="shippingaddress" placeholder="Shipping Address" class="px-4 py-2.5 bg-white text-gray-800 rounded-lg w-full text-sm border border-gray-300 focus:border-gray-800 outline-none" required />
                        </div>
                        <!-- <div class="relative flex items-center">
                            <input type="email" name="email" placeholder="Email" class="px-4 py-2.5 bg-white text-gray-800 rounded-lg w-full text-sm border border-gray-300 focus:border-gray-800 outline-none" required />
                        </div>
                        <div class="relative flex items-center">
                            <input type="number" name="phone" placeholder="Phone No." class="px-4 py-2.5 bg-white text-gray-800 rounded-lg w-full text-sm border border-gray-300 focus:border-gray-800 outline-none" required />
                        </div> -->
                    </div>
                </div>
                <ul class="text-gray-800 mt-6 space-y-3">
                    <li class="flex flex-wrap gap-4 text-sm">Subtotal <span class="ml-auto font-bold">$<?= number_format($totalamount, 2) ?></span></li>
                    <li class="flex flex-wrap gap-4 text-sm">Shipping <span class="ml-auto font-bold">FREE</span></li>
                    <li class="flex flex-wrap gap-4 text-sm">Tax <span class="ml-auto font-bold">$4.00</span></li>
                    <hr class="border-gray-300" />
                    <li class="flex flex-wrap gap-4 text-sm font-bold">Total <span class="ml-auto">$<?= number_format($total + 4, 2) ?></span></li>
                </ul>

                <!-- Hidden Inputs for Cart Data -->
                <?php if (isset($_SESSION['cart']) && !empty($_SESSION['cart'])): ?>
                    <?php foreach ($_SESSION['cart'] as $id => $product): ?>
                        <input type="hidden" name="cart[<?= $id ?>][id]" value="<?= $product['id'] ?>">
                        <input type="hidden" name="cart[<?= $id ?>][name]" value="<?= $product['name'] ?>">
                        <input type="hidden" name="cart[<?= $id ?>][price]" value="<?= $product['price'] ?>">
                        <input type="hidden" name="cart[<?= $id ?>][qty]" value="<?= $product['qty'] ?>">
                        <input type="hidden" name="cart[<?= $id ?>][size]" value="<?= $product['size'] ?>">
                        <input type="hidden" name="cart[<?= $id ?>][img_url]" value="<?= $product['img_url'] ?>">
                    <?php endforeach; ?>
                <?php endif; ?>

                <div class="mt-6 space-y-3">
                    <button type="submit" class="text-sm px-4 py-2.5 w-full font-semibold tracking-wide bg-gray-800 hover:bg-gray-900 text-white rounded-lg transition-colors">Checkout</button>
                    <button type="button" class="text-sm px-4 py-2.5 w-full font-semibold tracking-wide bg-transparent text-gray-800 border border-gray-300 rounded-lg hover:bg-gray-100 transition-colors"><a href="sproduct.php">Continue Shopping</a></button>
                </div>
            </form>
        </div>
    </div>
</div>

<?php require_once "footer.php"; ?>