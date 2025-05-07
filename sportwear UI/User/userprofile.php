<?php
    require_once "../db/connect.php";
    require_once "head.php";
    require_once "../admin/data.php";

    if (!isset($_SESSION['user_id'])) {
        session_start();
    }
    $id = $_SESSION['user_id'];
    $user = getUserById($id, $pdo);
    // Handle form submission for changing password
    $sale_details = getSalesByUserId($pdo,$id);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Profile</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&display=swap" rel="stylesheet">
    <!-- Custom CSS for Animations -->
    <style>
        /* Glassmorphism Effect */
        .glass {
            background: rgba(255, 255, 255, 0.8);
            backdrop-filter: blur(10px);
            border-radius: 12px;
            border: 1px solid rgba(0, 0, 0, 0.1);
        }

        /* Fade-In Animation */
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

        .fade-in {
            animation: fadeIn 1s ease-out;
        }
    </style>
</head>

<body class="bg-white text-black" style="font-family: 'Roboto', serif;">
    <?php require_once "navbar.php" ?>
    <!-- Centered Container -->
    <div class="min-h-auto flex items-center justify-center mt-6 p-4">
        <!-- Glassmorphism Card -->
        <div class="max-w-4xl w-full glass p-8 rounded-lg shadow-2xl fade-in">
            <div class="flex flex-col md:flex-row gap-8">
                <!-- User Information Section -->
                <div class="flex-1">
                    <h2 class="text-2xl font-bold mb-4">User Information</h2>
                    <div class="space-y-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-600">First_Name</label>
                            <p class="mt-1 text-lg text-black font-semibold"><?php echo htmlspecialchars($user['First_name']); ?></p>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-600">Last_Name</label>
                            <p class="mt-1 text-lg text-black font-semibold"><?php echo htmlspecialchars($user['Last_name']); ?></p>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-600">Email</label>
                            <p class="mt-1 text-lg text-black font-semibold"><?php echo htmlspecialchars($user['Gmail']); ?></p>
                        </div>
                        <div class="p-3">
                            <a href="logout.php">
                            <button
                                class="w-full mt-6 cursor-pointer bg-red-700 shadow-[0px_4px_32px_0_rgba(99,102,241,.70)] px-6 py-2 rounded-xl border-[1px]  text-white font-medium group">
                                <div class="relative overflow-hidden">
                                    <p
                                        class="group-hover:-translate-y-7 duration-[1.125s] ease-[cubic-bezier(0.19,1,0.22,1)]">
                                        Logout
                                    </p>
                                    <p
                                        class="absolute top-7 left-28 group-hover:top-0 duration-[1.125s] ease-[cubic-bezier(0.19,1,0.22,1)]">
                                        Are you Sure?
                                    </p>
                                </div>
                            </button>
                            </a>


                        </div>
                    </div>
                </div>

                <!-- Change Password Section -->
                <div class="flex-1">
                    <h2 class="text-2xl font-bold mb-4">Change Password</h2>
                    <?php if (isset($message)): ?>
                        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
                            <?php echo $message; ?>
                        </div>
                    <?php endif; ?>
                    <?php if (isset($error)): ?>
                        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
                            <?php echo $error; ?>
                        </div>
                    <?php endif; ?>
                    <form action="chgpassword.php" method="POST">
                        <input type="hidden" name="id" value="<?= $id ?>">
                        <div class="space-y-4">
                            <div>
                                <label for="current_password" class="block text-sm font-medium text-gray-600">Current Password</label>
                                <input type="password" name="current_password" id="current_password" class="mt-1 block w-full px-3 py-2 bg-gray-100/50 text-black rounded-md focus:outline-none focus:ring-2 focus:ring-black focus:border-blue-500 placeholder-gray-400 backdrop-filter backdrop-blur-md" placeholder="Enter current password" required>
                            </div>
                            <div>
                                <label for="new_password" class="block text-sm font-medium text-gray-600">New Password</label>
                                <input type="password" name="new_password" id="new_password" class="mt-1 block w-full px-3 py-2 bg-gray-100/50 text-black rounded-md focus:outline-none focus:ring-2 focus:ring-black focus:border-blue-500 placeholder-gray-400 backdrop-filter backdrop-blur-md" placeholder="Enter new password" required>
                            </div>
                            <div>
                                <label for="confirm_password" class="block text-sm font-medium text-gray-600">Confirm New Password</label>
                                <input type="password" name="confirm_password" id="confirm_password" class="mt-1 block w-full px-3 py-2 bg-gray-100/50 text-black rounded-md focus:outline-none focus:ring-2 focus:ring-black focus:border-blue-500 placeholder-gray-400 backdrop-filter backdrop-blur-md" placeholder="Confirm new password" required>
                            </div>
                            <div>
                                <button type="submit" name="change_password" class="w-full bg-black text-white py-2 px-4 rounded-md shadow-md hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-700 focus:ring-offset-2 transition duration-200">
                                    Change Password
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="m-4 p-2 pt-4 border-2 rounded-xl shadown">
        <h1 class="font-bold text-4xl text-center mb-4 tracking-wide" style="font-family: 'Roboto', serif;">Order History</h1>
    <table class="min-w-full rounded-md md:w-1/3">
    <thead class="bg-gray-800 whitespace-nowrap">
      <tr>
        <!-- <th class="p-4 text-md font-medium text-white text-center">Saledetail_ID</th> -->
        <th class="p-4 text-md font-medium text-white text-center">Sale_ID</th>
        <!-- <th class="p-4 text-md font-medium text-white text-center">Product Name</th> -->
        <th class="p-4 text-md font-medium text-white text-center">Total Quantity</th>
        <!-- <th class="p-4 text-md font-medium text-white text-center">Price</th> -->
        <th class="p-4 text-md font-medium text-white text-center">Subtotal</th>
        <th class="p-4 text-center text-md font-medium text-white">Purchase_At</th>
        <th class="p-4 text-center text-md font-medium text-white">Action</th>
      </tr>
    </thead>
    <?php foreach ($sale_details as $sale): ?>
      <tbody class="whitespace-nowrap bg-gray-200">
        <tr class="even:bg-blue-50">
          <!-- <td class="p-4 text-sm text-black text-center"><?= $sale["saledetail_id"] ?></td> -->
          <td class="p-4 text-sm text-black text-center"><?= $sale["sale_id"] ?></td>
          <!-- <td class="p-4 text-sm text-black text-center"><?= $sale["product_name"] ?></td> -->
          <td class="p-4 text-sm text-black text-center"><?= $sale["total_qty"] ?></td>
          <td class="p-4 text-sm text-black text-center"><?= "$".$sale["total_amount"] ?></td>
          <!-- <td class="p-4 text-sm text-black text-center"><?= $sale["subtotal"] ?></td> -->
          <td class="p-4 text-sm text-black text-center"><?= $sale["ordered_at"] ?></td>
          <td class="p-4 flex justify-center items-center">
                    <form action="saledetailforuser.php" method="POST">
                      <input type="hidden" name="sale_id" value="<?= $sale['sale_id'] ?>">
                      <button class="bg-black text-white p-4">
                          View More
                      </button>
                    </form>

                  </td>
        </tr>
      </tbody>
    <?php endforeach ?>
  </table>
  <!-- Pagination Controls -->
  <!-- <div class="pagination flex justify-center mt-6">
            <button id="prevPage" class="mx-1 px-4 py-2 bg-blue-500 text-white rounded-md hover:bg-blue-600 transition-all">Previous</button>
            <span id="pageInfo" class="mx-4 px-4 py-2 text-gray-700"></span>
            <button id="nextPage" class="mx-1 px-4 py-2 bg-blue-500 text-white rounded-md hover:bg-blue-600 transition-all">Next</button>
        </div>-->
    </div> 
    <?php require_once "footer.php" ?>
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const table = document.getElementById('salesTable');
            const rows = table.querySelectorAll('tbody tr');
            const rowsPerPage = 10; // Number of rows to display per page
            let currentPage = 1;

            // Function to show rows for the current page
            function showPage(page) {
                const start = (page - 1) * rowsPerPage;
                const end = start + rowsPerPage;

                rows.forEach((row, index) => {
                    if (index >= start && index < end) {
                        row.style.display = '';
                    } else {
                        row.style.display = 'none';
                    }
                });

                // Update page info
                document.getElementById('pageInfo').textContent = `Page ${page} of ${Math.ceil(rows.length / rowsPerPage)}`;
            }

            // Initial page load
            showPage(currentPage);

            // Previous button click
            document.getElementById('prevPage').addEventListener('click', () => {
                if (currentPage > 1) {
                    currentPage--;
                    showPage(currentPage);
                }
            });

            // Next button click
            document.getElementById('nextPage').addEventListener('click', () => {
                if (currentPage < Math.ceil(rows.length / rowsPerPage)) {
                    currentPage++;
                    showPage(currentPage);
                }
            });
        });
    </script>
</body>

</html>