<?php
require_once "head.php";
require_once "../User/head.php";
require_once "../login/checkloginforadmin.php";
require_once "../admin/data.php";

if (!isset($_SESSION['admin'])) {
    session_start();
}

$userCount = user($pdo);
$orderCount = sale($pdo);
$productCount = product($pdo);
$loyaluser = getTopLoyalUsers($pdo);
$mostsaleproducts = getMostSoldProducts($pdo);
// var_dump($mostsaleproducts);
$daysOfWeek = ['Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday'];
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FitFlex | Admin</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
        #title {
            animation-duration: 4s;
            animation-name: changecolor;
            animation-iteration-count: infinite;
            animation-timing-function: ease-in-out;
            font-family: 'Bungee Shade', sans-serif;
        }

        @keyframes changecolor {
            0% {
                color: rgb(220 38 38);
            }

            25% {
                color: darkred;
            }

            50% {
                color: black;
            }

            75% {
                color: darkred;
            }

            100% {
                color: rgb(220 38 38);
            }
        }

        /* Responsive Chart */
        .chart-container {
            width: 100%;
            height: 300px;
            /* Adjust height for smaller screens */
        }

        @media (max-width: 768px) {
            .chart-container {
                height: 200px;
            }
        }

        /* Flex layout for charts */
        .charts-grid {
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
        }

        .chart-wrapper {
            flex: 1 1 calc(50% - 20px);
            /* Two columns with gap */
            min-width: 300px;
            /* Minimum width for responsiveness */
        }

        @media (max-width: 768px) {
            .chart-wrapper {
                flex: 1 1 100%;
                /* Stack charts vertically on smaller screens */
            }
        }
    </style>
</head>

<body class="relative font-sans pt-[70px] h-screen">
    <header class='flex shadow-md py-1 px-4 sm:px-7 bg-white min-h-[70px] tracking-wide z-[110] fixed top-0 w-full'>
        <div class='flex flex-wrap items-center justify-between gap-4 w-full relative'>
            <a href="#">
                <h1 class="text-5xl font-bold" style="font-family: 'Bungee Shade', sans-serif;" id="title">FitFlex</h1>
            </a>
            <?php if (isset($_SESSION['admin'])): ?>
                <h1>Welcome <?= $_SESSION['admin']['last_name'] . "! ^-^" ?></h1>
            <?php endif; ?>
            <div id="collapseMenu"
                class='max-lg:hidden lg:!block max-lg:before:fixed max-lg:before:bg-black max-lg:before:opacity-50 max-lg:before:inset-0 max-lg:before:z-50'>
                <button id="toggleClose" class='lg:hidden fixed top-2 right-4 z-[100] rounded-full bg-white p-3'>
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-3 fill-black" viewBox="0 0 320.591 320.591">
                        <path
                            d="M30.391 318.583a30.37 30.37 0 0 1-21.56-7.288c-11.774-11.844-11.774-30.973 0-42.817L266.643 10.665c12.246-11.459 31.462-10.822 42.921 1.424 10.362 11.074 10.966 28.095 1.414 39.875L51.647 311.295a30.366 30.366 0 0 1-21.256 7.288z"
                            data-original="#000000"></path>
                        <path
                            d="M287.9 318.583a30.37 30.37 0 0 1-21.257-8.806L8.83 51.963C-2.078 39.225-.595 20.055 12.143 9.146c11.369-9.736 28.136-9.736 39.504 0l259.331 257.813c12.243 11.462 12.876 30.679 1.414 42.922-.456.487-.927.958-1.414 1.414a30.368 30.368 0 0 1-23.078 7.288z"
                            data-original="#000000"></path>
                    </svg>
                </button>

                <div
                    class="max-lg:fixed max-lg:bg-white max-lg:w-1/2 max-lg:min-w-[300px] max-lg:top-0 max-lg:left-0 max-lg:p-6 max-lg:h-full max-lg:shadow-md max-lg:overflow-auto z-50">
                    <div class='flex items-center max-lg:flex-col-reverse max-lg:ml-auto gap-8'>
                        <div
                            class='flex w-full bg-gray-100 px-4 py-2.5 rounded outline-none border focus-within:border-blue-600 focus-within:bg-transparent transition-all'>
                            <input type='text' placeholder='Search something...'
                                class='w-full text-sm bg-transparent rounded outline-none pr-2' />
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 192.904 192.904" width="16px"
                                class="cursor-pointer fill-gray-400">
                                <path
                                    d="m190.707 180.101-47.078-47.077c11.702-14.072 18.752-32.142 18.752-51.831C162.381 36.423 125.959 0 81.191 0 36.422 0 0 36.423 0 81.193c0 44.767 36.422 81.187 81.191 81.187 19.688 0 37.759-7.049 51.831-18.751l47.079 47.078a7.474 7.474 0 0 0 5.303 2.197 7.498 7.498 0 0 0 5.303-12.803zM15 81.193C15 44.694 44.693 15 81.191 15c36.497 0 66.189 29.694 66.189 66.193 0 36.496-29.692 66.187-66.189 66.187C44.693 147.38 15 117.689 15 81.193z">
                                </path>
                            </svg>
                        </div>

                        <div class="dropdown-menu relative flex shrink-0 group">
                            <img src="https://readymadeui.com/team-1.webp" alt="profile-pic"
                                class="w-9 h-9 max-lg:w-16 max-lg:h-16 rounded-full border-2 border-gray-300 cursor-pointer" />

                            <div
                                class="dropdown-content hidden group-hover:block shadow-md p-2 bg-white rounded-md absolute top-9 right-0 w-56">
                                <div class="w-full">
                                    <a href="index.php"
                                        class="text-sm text-gray-800 cursor-pointer flex items-center p-2 rounded-md hover:bg-gray-100 dropdown-item transition duration-300 ease-in-out">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="w-4 h-4 mr-3 fill-current" viewBox="0 0 24 24">
                                            <path d="M19.56 23.253H4.44a4.051 4.051 0 0 1-4.05-4.05v-9.115c0-1.317.648-2.56 1.728-3.315l7.56-5.292a4.062 4.062 0 0 1 4.644 0l7.56 5.292a4.056 4.056 0 0 1 1.728 3.315v9.115a4.051 4.051 0 0 1-4.05 4.05zM12 2.366a2.45 2.45 0 0 0-1.393.443l-7.56 5.292a2.433 2.433 0 0 0-1.037 1.987v9.115c0 1.34 1.09 2.43 2.43 2.43h15.12c1.34 0 2.43-1.09 2.43-2.43v-9.115c0-.788-.389-1.533-1.037-1.987l-7.56-5.292A2.438 2.438 0 0 0 12 2.377z" data-original="#000000"></path>
                                            <path d="M16.32 23.253H7.68a.816.816 0 0 1-.81-.81v-5.4c0-2.83 2.3-5.13 5.13-5.13s5.13 2.3 5.13 5.13v5.4c0 .443-.367.81-.81.81zm-7.83-1.62h7.02v-4.59c0-1.933-1.577-3.51-3.51-3.51s-3.51 1.577-3.51 3.51z" data-original="#000000"></path>
                                        </svg>
                                        Dashboard</a>
                                    <a href="newcreateproduct.php"
                                        class="text-sm text-gray-800 cursor-pointer flex items-center p-2 rounded-md hover:bg-gray-100 dropdown-item transition duration-300 ease-in-out">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 mr-3 fill-current" viewBox="0 0 24 24">
                                            <path
                                                d="M18 2c2.206 0 4 1.794 4 4v12c0 2.206-1.794 4-4 4H6c-2.206 0-4-1.794-4-4V6c0-2.206 1.794-4 4-4zm0-2H6a6 6 0 0 0-6 6v12a6 6 0 0 0 6 6h12a6 6 0 0 0 6-6V6a6 6 0 0 0-6-6z"
                                                data-original="#000000" />
                                            <path d="M12 18a1 1 0 0 1-1-1V7a1 1 0 0 1 2 0v10a1 1 0 0 1-1 1z" data-original="#000000" />
                                            <path d="M6 12a1 1 0 0 1 1-1h10a1 1 0 0 1 0 2H7a1 1 0 0 1-1-1z" data-original="#000000" />
                                        </svg>
                                        Product</a>
                                    <a href="logout.php"
                                        class="text-sm text-gray-800 cursor-pointer flex items-center p-2 rounded-md hover:bg-gray-100 dropdown-item transition duration-300 ease-in-out">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 mr-3 fill-current" viewBox="0 0 6 6">
                                            <path
                                                d="M3.172.53a.265.266 0 0 0-.262.268v2.127a.265.266 0 0 0 .53 0V.798A.265.266 0 0 0 3.172.53zm1.544.532a.265.266 0 0 0-.026 0 .265.266 0 0 0-.147.47c.459.391.749.973.749 1.626 0 1.18-.944 2.131-2.116 2.131A2.12 2.12 0 0 1 1.06 3.16c0-.65.286-1.228.74-1.62a.265.266 0 1 0-.344-.404A2.667 2.667 0 0 0 .53 3.158a2.66 2.66 0 0 0 2.647 2.663 2.657 2.657 0 0 0 2.645-2.663c0-.812-.363-1.542-.936-2.03a.265.266 0 0 0-.17-.066z"
                                                data-original="#000000" />
                                        </svg>
                                        Logout</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <button id="toggleOpen" class='lg:hidden !ml-7 outline-none'>
                <svg class="w-7 h-7" fill="#000" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd"
                        d="M3 5a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 10a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 15a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1z"
                        clip-rule="evenodd"></path>
                </svg>
            </button>
        </div>
    </header>

    <div class="flex items-start">
        <nav id="sidebar" class="lg:min-w-[250px] w-max max-lg:min-w-8">
            <div id="sidebar-collapse-menu" class="bg-white shadow-lg h-screen fixed py-6 px-4 top-[70px] left-0 overflow-auto z-[99] lg:min-w-[250px] lg:w-max max-lg:w-0 max-lg:invisible transition-all duration-500">
                <ul class="space-y-2">
                    <li><a href="index.php" class="text-black text-md flex items-center hover:bg-gray-100 rounded-md px-4 py-2 transition-all">Dashboard</a></li>
                    <li><a href="users.php" class="text-black text-md flex items-center hover:bg-gray-100 rounded-md px-4 py-2 transition-all">User</a></li>
                    <li><a href="products.php" class="text-black text-md flex items-center hover:bg-gray-100 rounded-md px-4 py-2 transition-all">Product</a></li>
                    <li><a href="sales.php" class="text-black text-md flex items-center hover:bg-gray-100 rounded-md px-4 py-2 transition-all">Sale</a></li>
                    <li><a href="logout.php" class="text-black text-md flex items-center hover:bg-gray-100 rounded-md px-4 py-2 transition-all">Logout</a></li>
                </ul>
            </div>
        </nav>

        <section class="main-content w-full p-6">
            <!-- Metrics Section -->
            <div class="container mx-auto">
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
                    <!-- New Users -->
                    <div class="bg-white p-4 rounded-lg shadow hover:shadow-lg border-2 transition-shadow duration-300 transform hover:-translate-y-1">
                        <div class="flex items-center space-x-4">
                            <div class="p-3 bg-blue-100 rounded-full">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 text-blue-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                                </svg>
                            </div>
                            <div>
                                <h3 class="text-gray-500 text-lg font-medium">New Users</h3>
                                <p class="text-2xl font-bold"><?= $userCount ?></p>
                            </div>
                        </div>
                    </div>

                    <!-- Total Orders -->
                    <div class="bg-white p-4 rounded-lg shadow hover:shadow-lg border-2 transition-shadow duration-300 transform hover:-translate-y-1">
                        <div class="flex items-center space-x-4">
                            <div class="p-3 bg-green-100 rounded-full">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 text-green-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" />
                                </svg>
                            </div>
                            <div>
                                <h3 class="text-gray-500 text-lg font-medium">Total Order</h3>
                                <p class="text-2xl font-bold"><?= $orderCount ?></p>
                            </div>
                        </div>
                    </div>

                    <!-- Available Products -->
                    <div class="bg-white p-4 rounded-lg shadow hover:shadow-lg border-2 transition-shadow duration-300 transform hover:-translate-y-1">
                        <div class="flex items-center space-x-4">
                            <div class="p-3 bg-purple-100 rounded-full">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 text-purple-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 8h14M5 8a2 2 0 110-4h14a2 2 0 110 4M5 8v10a2 2 0 002 2h10a2 2 0 002-2V8m-9 4h4" />
                                </svg>
                            </div>
                            <div>
                                <h3 class="text-gray-500 text-lg font-medium">Products</h3>
                                <p class="text-2xl font-bold"><?= $productCount ?></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Charts Section -->
            <div class="container mx-auto mt-6">
                <div class="flex flex-wrap gap-6">
                    <!-- Sales Reports -->
                    <div class="bg-white flex-1 min-w-[800px] p-4 rounded-lg shadow border-2">
                        <h3 class="text-gray-700 text-lg font-bold text-center mb-4">Sales Reports</h3>
                        <select id="periodSelect" class="mb-4 p-2 border rounded">
                            <option value="daily">Daily</option>
                            <option value="monthly">Monthly</option>
                        </select>

                        <!-- Bar Chart -->
                        <div class="border-2 rounded-lg p-4">
                            <h4 class="text-gray-600 text-md font-semibold mb-2">Sales Data</h4>
                            <div class="chart-container ml-20">
                                <canvas id="barChart"></canvas>
                            </div>
                        </div>
                    </div>

                    <!-- Pie Chart -->
                    <div class="bg-white min-w-[320px] p-4 rounded-lg shadow border-2">
                        <h4 class="text-gray-600 text-center text-lg font-bold mb-4">Most Sold Product Categories</h4>
                        <div class="chart-container">
                            <canvas id="pieChart" class="mt-12"></canvas>
                        </div>
                    </div>
                </div>
            </div>
            <div class="container mx-auto mt-6">
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                    <!-- Top 10 Loyal Users -->
                    <div class="bg-white p-4 rounded-lg shadow border-2">
                        <h3 class="text-gray-700 text-center text-lg font-bold mb-4">Top 10 Loyal Users</h3>
                        <div class="responsive-table">
                            <table class="min-w-full">
                                <thead>
                                    <tr>
                                        <th class="px-4 py-2 text-center text-xs font-medium text-black uppercase">User ID</th>
                                        <th class="px-4 py-2 text-xs font-medium text-black uppercase">Name</th>
                                        <th class="px-4 py-2 text-center text-xs font-medium text-black uppercase">Total Orders</th>
                                        <th class="px-4 py-2 text-center text-xs font-medium text-black uppercase">Total Spent</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($loyaluser as $loyal) : ?>
                                        <tr>
                                            <td class="px-4 py-2 text-center text-xs font-medium text-black uppercase"><?= $loyal['USER_ID'] ?></td>
                                            <td class="px-4 py-2 text-xs font-medium text-black uppercase"><?= $loyal['NAME'] ?></td>
                                            <td class="px-4 py-2 text-center text-xs font-medium text-black uppercase"><?= $loyal['TOTAL_ORDERS'] ?></td>
                                            <td class="px-4 py-2 text-center text-xs font-medium text-black uppercase"><?= "$" . $loyal['TOTAL_SPENT'] ?></td>
                                        </tr>
                                    <?php endforeach ?>
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <!-- Most Sold Products -->
                    <div class="bg-white p-4 rounded-lg shadow border-2">
                        <h3 class="text-gray-700 text-center text-lg font-bold mb-4">Most Sold Products</h3>
                        <div class="responsive-table">
                            <table class="min-w-full">
                                <thead>
                                    <tr>
                                        <th class="px-4 py-2 text-center text-xs font-medium text-black uppercase">Product ID</th>
                                        <th class="px-4 py-2 text-left text-xs font-medium text-black uppercase">Name</th>
                                        <th class="px-4 py-2 text-center text-xs font-medium text-black uppercase">Quantity Sold</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($mostsaleproducts as $product) : ?>
                                        <tr>
                                            <td class="px-4 py-2 text-center text-xs font-medium text-black uppercase"><?= $product['PRODUCTID'] ?></td>
                                            <td class="px-4 py-2 text-xs font-medium text-black uppercase"><?= $product['NAME'] ?></td>
                                            <td class="px-4 py-2 text-center text-xs font-medium text-black uppercase"><?= $product['QUANTITY_SOLD'] ?></td>
                                        </tr>
                                    <?php endforeach ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
        </section>

    </div>


    <script>
        let barChart, pieChart;

        async function fetchSalesReport(period) {
            try {
                // Fetch sales data
                const salesResponse = await fetch(`fetch_sales_report.php?period=${period}`);
                const salesData = await salesResponse.json();
                console.log("Fetched Sales Data:", salesData);

                // Fetch most sold product categories
                const productsResponse = await fetch(`fetch_most_sold_products.php`);
                const productsData = await productsResponse.json();
                console.log("Fetched Products Data:", productsData);

                // Define day names and month names
                const dayNames = ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday'];
                const monthNames = ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'];

                // Map sales data to day names if period is daily, or to month names if period is monthly
                let salesLabels, salesValues;
                if (period === 'daily') {
                    salesLabels = dayNames;
                    salesValues = dayNames.map(day => {
                        const report = salesData.find(report => report.PERIOD === day);
                        return report ? report.TOTAL_SALES : 0;
                    });
                } else if (period === 'monthly') {
                    salesLabels = monthNames;
                    salesValues = monthNames.map(month => {
                        const report = salesData.find(report => report.PERIOD === month);
                        return report ? report.TOTAL_SALES : 0;
                    });
                } else {
                    salesLabels = salesData.map(report => report.PERIOD);
                    salesValues = salesData.map(report => report.TOTAL_SALES);
                }

                const productLabels = productsData.map(product => product.CATEGORY);
                const productValues = productsData.map(product => product.QUANTITY_SOLD);

                const barCtx = document.getElementById('barChart').getContext('2d');
                const pieCtx = document.getElementById('pieChart').getContext('2d');

                // Destroy existing charts if they exist
                if (barChart) {
                    barChart.destroy();
                }
                if (pieChart) {
                    pieChart.destroy();
                }

                // Create a new bar chart for sales data
                barChart = new Chart(barCtx, {
                    type: 'bar',
                    data: {
                        labels: salesLabels,
                        datasets: [{
                            label: 'Total Sales',
                            data: salesValues,
                            backgroundColor: 'rgba(75, 192, 192, 0.2)',
                            borderColor: 'rgba(75, 192, 192, 1)',
                            borderWidth: 1
                        }]
                    },
                    options: {
                        scales: {
                            y: {
                                beginAtZero: true
                            }
                        },
                        animation: {
                            duration: 1000, // Smooth transition duration
                            easing: 'easeInOutQuad' // Smooth easing function
                        }
                    }
                });

                // Create a new pie chart for most sold product categories
                pieChart = new Chart(pieCtx, {
                    type: 'pie',
                    data: {
                        labels: productLabels,
                        datasets: [{
                            label: 'Quantity Sold',
                            data: productValues,
                            backgroundColor: [
                                'rgba(255, 99, 132, 0.2)',
                                'rgba(54, 162, 235, 0.2)',
                                'rgba(255, 206, 86, 0.2)',
                                'rgba(75, 192, 192, 0.2)',
                                'rgba(153, 102, 255, 0.2)',
                                'rgba(255, 159, 64, 0.2)'
                            ],
                            borderColor: [
                                'rgba(255, 99, 132, 1)',
                                'rgba(54, 162, 235, 1)',
                                'rgba(255, 206, 86, 1)',
                                'rgba(75, 192, 192, 1)',
                                'rgba(153, 102, 255, 1)',
                                'rgba(255, 159, 64, 1)'
                            ],
                            borderWidth: 1
                        }]
                    },
                    options: {
                        animation: {
                            duration: 1000, // Smooth transition duration
                            easing: 'easeInOutQuad' // Smooth easing function
                        }
                    }
                });
            } catch (error) {
                console.error('Error fetching data:', error);
                const chartContainer = document.getElementById('barChart').parentElement;
                chartContainer.innerHTML = '<p class="text-red-500">An error occurred while fetching the data.</p>';
            }
        }

        // Event listener for the period select dropdown
        document.getElementById('periodSelect').addEventListener('change', (e) => {
            const selectedPeriod = e.target.value;
            fetchSalesReport(selectedPeriod);
        });

        // Initial fetch for the default period (e.g., daily)
        fetchSalesReport('daily');
    </script>
</body>

</html>