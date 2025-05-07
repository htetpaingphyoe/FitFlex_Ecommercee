<?php
session_start();
// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    header("location:../login/login.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $address = $_POST['shippingaddress'];
}

require_once "head.php";

// Check if the cart exists
if (!isset($_SESSION['cart']) || empty($_SESSION['cart'])) {
    die("Error: Cart is empty.");
}

// Calculate the total amount
$total = 0;
foreach ($_SESSION['cart'] as $item) {
    if (!isset($item['id'], $item['price'], $item['qty'])) {
        die("Error: Invalid item in cart.");
    }
    $total += $item['price'] * $item['qty'];
}

// Store the total in the session
$_SESSION['total'] = $total;
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkout</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <style>
        /* Custom Animations */
        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(20px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes pulse {
            0% {
                transform: scale(1);
            }

            50% {
                transform: scale(1.05);
            }

            100% {
                transform: scale(1);
            }
        }

        .fade-in {
            animation: fadeIn 0.8s ease-out;
        }

        .pulse-hover:hover {
            animation: pulse 1.5s infinite;
        }

        /* Custom Scrollbar */
        ::-webkit-scrollbar {
            width: 8px;
        }

        ::-webkit-scrollbar-track {
            background: #f1f1f1;
        }

        ::-webkit-scrollbar-thumb {
            background: #888;
            border-radius: 4px;
        }

        ::-webkit-scrollbar-thumb:hover {
            background: #555;
        }
    </style>
</head>

<body class="font-[sans-serif] bg-white text-gray-800">
    <?php require_once "navbar.php"; ?>

    <div class="lg:flex lg:items-center lg:justify-center lg:h-screen max-lg:py-4 fade-in">
        <div class="bg-gray-50 p-8 w-full max-w-5xl max-lg:max-w-xl mx-auto rounded-md shadow-2xl transform transition-all hover:scale-105">
            <h2 class="text-3xl font-extrabold text-gray-800 text-center mb-8">Checkout</h2>

            <div class="grid lg:grid-cols-3 gap-6 max-lg:gap-8">
                <!-- Payment Method Section -->
                <div class="lg:col-span-2">
                    <h3 class="text-lg font-bold text-gray-800 mb-4">Choose your payment method</h3>
                    <form class="mt-6" action="checkoutprocess.php" method="POST" id="checkout-form">
                        <div class="grid gap-4 sm:grid-cols-2">
                            <!-- Card Payment -->
                            <div class="flex items-center mb-4">
                                <input type="radio" name="payment" class="w-5 h-5 cursor-pointer" id="card" value="Card" checked />
                                <label for="card" class="ml-4 flex gap-2 cursor-pointer">
                                    <img src="https://readymadeui.com/images/visa.webp" class="w-12" alt="card1" />
                                    <img src="https://readymadeui.com/images/american-express.webp" class="w-12" alt="card2" />
                                    <img src="https://readymadeui.com/images/master.webp" class="w-12" alt="card3" />
                                </label>
                            </div>

                            <!-- PayPal Payment -->
                            <div class="flex items-center mb-4">
                                <input type="radio" name="payment" class="w-5 h-5 cursor-pointer" id="paypal" value="PayPal" />
                                <label for="paypal" class="ml-4 flex gap-2 cursor-pointer">
                                    <img src="https://readymadeui.com/images/paypal.webp" class="w-20" alt="paypalCard" />
                                </label>
                            </div>
                        </div>

                        <!-- Hidden Inputs -->
                        <input type="hidden" name="payment_type" id="payment_type" value="Card" />
                        <input type="hidden" name="cart" value='<?= json_encode($_SESSION['cart']) ?>' />
                        <input type="hidden" name="shipaddress" value="<?= htmlspecialchars($address) ?>">

                        <!-- Card Payment Fields -->
                        <div id="card-fields" class="space-y-4">
                            <!-- Name of Card Holder -->
                            <input type="text" name="full_name" placeholder="Name of card holder"
                                class="w-full px-4 py-3 bg-white text-gray-800 rounded-md focus:outline-none focus:ring-2 focus:ring-black border border-gray-200"
                                pattern="[A-Za-z\s]+" title="Only alphabets and spaces are allowed" />

                            <!-- Postal Code -->
                            <input type="text" name="postal_code" placeholder="Postal code"
                                class="w-full px-4 py-3 bg-white text-gray-800 rounded-md focus:outline-none focus:ring-2 focus:ring-black border border-gray-200"
                                pattern="[0-9]{5}" title="Postal code must be 5 digits" />

                            <!-- Card Number -->
                            <input type="text" name="card_number" placeholder="Card number"
                                class="w-full px-4 py-3 bg-white text-gray-800 rounded-md focus:outline-none focus:ring-2 focus:ring-black border border-gray-200"
                                pattern="[0-9]{16}" title="Card number must be 16 digits" />

                            <div class="grid grid-cols-2 gap-4">
                                <!-- Expiry Date (MM/YY) -->
                                <input type="text" name="expiry" placeholder="EXP. (MM/YY)"
                                    class="w-full px-4 py-3 bg-white text-gray-800 rounded-md focus:outline-none focus:ring-2 focus:ring-black border border-gray-200"
                                    pattern="(0[1-9]|1[0-2])\/[0-9]{2}" title="Expiry date must be in MM/YY format" />

                                <!-- CVV -->
                                <input type="text" name="cvv" placeholder="CVV"
                                    class="w-full px-4 py-3 bg-white text-gray-800 rounded-md focus:outline-none focus:ring-2 focus:ring-black border border-gray-200"
                                    pattern="[0-9]{3}" title="CVV must be 3 digits" />
                            </div>
                        </div>

                        <!-- PayPal Payment Fields -->
                        <div id="paypal-fields" class="space-y-4" style="display: none;">
                            <input type="email" name="paypal_email" placeholder="PayPal Email"
                                class="w-full px-4 py-3 bg-white text-gray-800 rounded-md focus:outline-none focus:ring-2 focus:ring-black border border-gray-200" />
                        </div>

                        <!-- Submit Button -->
                        <button type="submit"
                            class="w-full mt-6 px-6 py-3 bg-black text-white rounded-md hover:bg-gray-900 transition-all pulse-hover">
                            Submit Payment
                        </button>
                    </form>
                </div>

                <!-- Order Summary Section -->
                <div class="bg-white p-6 rounded-md max-lg:-order-1 shadow-md">
                    <h3 class="text-lg font-bold text-gray-800 mb-4">Summary</h3>
                    <ul class="text-gray-800 space-y-3">
                        <li class="flex justify-between text-sm">
                            <span>Subtotal</span>
                            <span class="font-bold">$<?= number_format($total, 2) ?></span>
                        </li>
                        <li class="flex justify-between text-sm">
                            <span>Tax</span>
                            <span class="font-bold">$4.00</span>
                        </li>
                        <hr class="my-2 border-gray-300" />
                        <li class="flex justify-between text-base font-bold">
                            <span>Total</span>
                            <span>$<?= number_format($total + 4, 2) ?></span>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const cardRadio = document.getElementById('card');
            const paypalRadio = document.getElementById('paypal');
            const cardFields = document.getElementById('card-fields');
            const paypalFields = document.getElementById('paypal-fields');
            const paymentTypeInput = document.getElementById('payment_type');

            if (cardRadio && paypalRadio && cardFields && paypalFields && paymentTypeInput) {
                // Set initial state
                if (cardRadio.checked) {
                    cardFields.style.display = 'block';
                    paypalFields.style.display = 'none';
                    paymentTypeInput.value = 'Card';
                } else if (paypalRadio.checked) {
                    cardFields.style.display = 'none';
                    paypalFields.style.display = 'block';
                    paymentTypeInput.value = 'PayPal';
                }

                cardRadio.addEventListener('change', () => {
                    cardFields.style.display = 'block';
                    paypalFields.style.display = 'none';
                    paymentTypeInput.value = 'Card';
                });

                paypalRadio.addEventListener('change', () => {
                    cardFields.style.display = 'none';
                    paypalFields.style.display = 'block';
                    paymentTypeInput.value = 'PayPal';
                });
            } else {
                console.error('One or more required elements are missing in the DOM.');
            }
        });
    </script>

    <?php require_once "footer.php"; ?>
</body>

</html>