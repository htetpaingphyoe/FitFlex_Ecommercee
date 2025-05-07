<?php
// Enable error reporting
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Rest of your PHP code
require_once "head.php";
require_once "../db/connect.php";
require_once "data.php";
require_once "../User/head.php";
// require_once "../login/checkloginforadmin.php";

if (!isset($_SESSION['admin'])) {
  session_start();
}
// print_r($_SESSION['admin']);
// Database connection
$con = mysqli_connect("localhost", "root", "", "fitflexweb");
if (!$con) {
  die("Database connection failed: " . mysqli_connect_error());
}

// Pagination variables
$limit = 10; // Number of records per page
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1; // Current page
$offset = ($page - 1) * $limit; // Offset for SQL query

// Fetch products based on search term (if any)
if (isset($_GET['term']) && !empty($_GET['term'])) {
  $filtervalue = $_GET['term'];

  // Check if the search term is numeric (for Product ID)
  if (is_numeric($filtervalue)) {
    // Exact match for Product ID
    $query = "SELECT * FROM products WHERE Product_ID = $filtervalue LIMIT $limit OFFSET $offset";
  } else {
    // Fallback to LIKE for other fields (e.g., Name)
    $query = "SELECT * FROM products WHERE Name LIKE '%$filtervalue%' LIMIT $limit OFFSET $offset";
  }
} else {
  // Fetch all products if no search term is provided
  $query = "SELECT * FROM products LIMIT $limit OFFSET $offset";
}

$query_run = mysqli_query($con, $query);

// Count total number of products for pagination
$total_query = "SELECT COUNT(*) as total FROM products";
$total_result = mysqli_query($con, $total_query);
$total_row = mysqli_fetch_assoc($total_result);
$total_products = $total_row['total'];
$total_pages = ceil($total_products / $limit); // Total pages needed

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>FitFlex | Admin</title>
  <style>
    /* CSS for the page */
    #title {
      animation: changecolor 4s infinite ease-in-out;
      font-family: 'Bungee Shade', sans-serif;
    }

    /* Pagination Styles */
    .pagination {
      display: flex;
      justify-content: center;
      margin-top: 20px;
    }

    .pagination ul {
      list-style: none;
      padding: 0;
      display: flex;
      gap: 5px;
    }

    .pagination li {
      display: inline-block;
    }

    .pagination-link {
      text-decoration: none;
      padding: 8px 12px;
      border: 1px solid #ddd;
      border-radius: 4px;
      color: #007bff;
      transition: background-color 0.3s ease, color 0.3s ease;
    }

    .pagination-link:hover {
      background-color: #007bff;
      color: white;
      border-color: #007bff;
    }

    /* Active Page Style */
    .pagination-link.active {
      background-color: black;
      /* Black background for the active page */
      color: white;
      /* White text for better contrast */
      border-color: black;
    }

    .pagination .disabled a {
      color: #ddd;
      pointer-events: none;
      cursor: default;
    }

    @keyframes changecolor {
      0% {
        color: rgb(220, 38, 38);
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
        color: rgb(220, 38, 38);
      }
    }

    .table-row:hover {
      background-color: #f0f0f0;
      transition: background-color 0.3s ease;
    }

    .action-buttons a,
    .action-buttons button {
      padding: 8px 12px;
      /* Increased padding for larger buttons */
      border-radius: 5px;
      transition: background-color 0.3s ease;
      font-size: 14px;
      /* Slightly larger font size */
    }

    .action-buttons a:hover,
    .action-buttons button:hover {
      opacity: 0.8;
    }
  </style>
</head>

<body>
  <div class="relative font-[sans-serif] pt-[70px] h-screen">
    <!-- Header -->
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

          <div class="max-lg:fixed max-lg:bg-white max-lg:w-1/2 max-lg:min-w-[300px] max-lg:top-0 max-lg:left-0 max-lg:p-6 max-lg:h-full max-lg:shadow-md max-lg:overflow-auto z-50">

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

    <!-- Main Content -->
    <div class="flex items-start">
      <!-- Sidebar -->
      <nav id="sidebar" class="lg:min-w-[250px] w-max max-lg:min-w-8">
        <div id="sidebar-collapse-menu" class="bg-white shadow-lg h-screen fixed py-6 px-4 top-[70px] left-0 overflow-auto z-[99] lg:min-w-[250px] lg:w-max max-lg:w-0 max-lg:invisible transition-all duration-500">
          <ul class="space-y-2">
            <li><a href="index.php" class="text-gray-800 text-sm flex items-center hover:bg-gray-100 rounded-md px-4 py-2 transition-all">Dashboard</a></li>
            <li><a href="users.php" class="text-gray-800 text-sm flex items-center hover:bg-gray-100 rounded-md px-4 py-2 transition-all">User</a></li>
            <li><a href="products.php" class="text-gray-800 text-sm flex items-center hover:bg-gray-100 rounded-md px-4 py-2 transition-all">Product</a></li>
            <li><a href="sales.php" class="text-gray-800 text-sm flex items-center hover:bg-gray-100 rounded-md px-4 py-2 transition-all">Sale</a></li>
            <li><a href="logout.php" class="text-gray-800 text-sm flex items-center hover:bg-gray-100 rounded-md px-4 py-2 transition-all">Logout</a></li>
          </ul>
        </div>
      </nav>

      <!-- Toggle Sidebar Button -->
      <button id="toggle-sidebar" class='lg:hidden w-8 h-8 z-[100] fixed top-[74px] left-[10px] cursor-pointer bg-[#007bff] flex items-center justify-center rounded-full outline-none transition-all duration-500'>
        <svg xmlns="http://www.w3.org/2000/svg" fill="#fff" class="w-3 h-3" viewBox="0 0 55.752 55.752">
          <path d="M43.006 23.916a5.36 5.36 0 0 0-.912-.727L20.485 1.581a5.4 5.4 0 0 0-7.637 7.638l18.611 18.609-18.705 18.707a5.398 5.398 0 1 0 7.634 7.635l21.706-21.703a5.35 5.35 0 0 0 .912-.727 5.373 5.373 0 0 0 1.574-3.912 5.363 5.363 0 0 0-1.574-3.912z" />
        </svg>
      </button>

      <!-- Main Section -->
      <section class="main-content w-full p-6">
        <!-- Search and Add Product Button -->
        <div class="flex mb-2">
          <form method="GET" action="" class="flex border-2 border-gray-500 overflow-hidden max-w-md mx-auto font-[sans-serif] rounded-lg">
            <input type="text" name="term" id="searchInput" placeholder="Search product by name or ID..." class="w-full lg:w-[400px] outline-none bg-white text-gray-600 text-sm px-4 py-3" value="<?= isset($_GET['term']) ? htmlspecialchars($_GET['term']) : '' ?>" />
            <button type="submit" class="flex items-center justify-center bg-black px-4 text-sm text-white">Search</button>
          </form>
          <a href="newcreateproduct.php">
            <button class="px-10 py-4 text-xs border-2 font-sans font-medium tracking-widest text-black uppercase transition-all duration-300 ease-in-out transform bg-white rounded-full shadow-lg hover:bg-green-400 hover:text-white hover:shadow-2xl hover:-translate-y-2 active:translate-y-0 focus:outline-none">Add product</button>
          </a>
        </div>

        <!-- Product Table -->
        <div class="overflow-x-auto rounded-lg">
          <table class="min-w-full md:w-1/3 border-2 border-black">
            <thead class="bg-gray-800 whitespace-nowrap border-2 border-black">
              <tr>
                <th class="p-4 text-left text-sm font-medium text-white">ID</th>
                <th class="p-4 text-left text-sm font-medium text-white">Product Name</th>
                <th class="p-4 text-left text-sm font-medium text-white">Description</th>
                <th class="p-4 text-left text-sm font-medium text-white">Category</th>
                <th class="p-4 text-left text-sm font-medium text-white">Brand</th>
                <th class="p-4 text-left text-sm font-medium text-white">Size</th>
                <th class="p-4 text-left text-sm font-medium text-white">Color</th>
                <th class="p-4 text-left text-sm font-medium text-white">Price</th>
                <th class="p-4 text-left text-sm font-medium text-white">Stock</th>
                <th class="p-4 text-left text-sm font-medium text-white">Image</th>
                <th class="p-4 text-center text-sm font-medium text-white">Created_at</th>
                <th class="p-4 text-left text-sm font-medium text-white">Actions</th>
              </tr>
            </thead>
            <tbody id="tableBody" class="whitespace-nowrap bg-gray-200">
              <?php
              if (mysqli_num_rows($query_run) > 0) {
                foreach ($query_run as $items) {
              ?>
                  <tr class="even:bg-blue-50 table-row">
                    <td class="p-1 text-xs text-black text-center"><?= $items["Product_ID"] ?></td>
                    <td class="p-1 text-xs text-black"><?= $items["Name"] ?></td>
                    <td class="p-1 text-xs text-black"><?= $items["Description"] ?></td>
                    <td class="p-1 text-xs text-black"><?= $items["Category"] ?></td>
                    <td class="p-1 text-xs text-black"><?= $items["Brand"] ?? 'N/A' ?></td>
                    <td class="p-1 text-xs text-black"><?= $items["Size"] ?></td>
                    <td class="p-1 text-xs text-black"><?= $items["Color"] ?? 'N/A' ?></td>
                    <td class="p-1 text-xs text-black"><?= "$" . $items["Price"] ?></td>
                    <td class="p-1 text-xs text-black text-center"><?= $items["Stock_Quantity"] ?></td>
                    <td class="p-1 text-xs text-black"><img src="<?= "../product_img/" . $items["Image_URL"] ?>" class="w-8 h-8 border-2 border-white"></td>
                    <td class="p-1 text-xs text-black"><?= $items["Created_At"] ?></td>
                    <td class="p-1">
                      <div class="flex item-center gap-2">
                        <a href="newproductedit.php?id=<?= $items["Product_ID"] ?>" class="font-medium text-blue-600 dark:text-gray-100 item-center bg-green-400 h-full p-4 rounded-md hover:bg-yellow-500">
                          <i class="fa-solid fa-pencil"></i>
                        </a>
                        <form action="productDelete.php">
                          <input type="hidden" name="id" value="<?= $items["Product_ID"] ?>">
                          <button class="font-medium text-blue-600 dark:text-gray-100 item-center bg-red-600 p-4 rounded-md hover:bg-red-500">
                            <i class="fa-solid fa-trash"></i>
                          </button>
                        </form>
                      </div>
                    </td>
                  </tr>
                <?php
                }
              } else {
                ?>
                <tr>
                  <td colspan="12" class="p-4 text-center text-gray-600">No record found!</td>
                </tr>
              <?php
              }
              ?>
            </tbody>
          </table>
        </div>
        <!-- Pagination Controls -->
        <div class="pagination">
          <ul>
            <?php if ($page > 1): ?>
              <li>
                <a href="?page=<?= $page - 1 ?>&term=<?= isset($_GET['term']) ? htmlspecialchars($_GET['term']) : '' ?>" class="pagination-link">Previous</a>
              </li>
            <?php endif; ?>

            <?php for ($i = 1; $i <= $total_pages; $i++): ?>
              <li>
                <a href="?page=<?= $i ?>&term=<?= isset($_GET['term']) ? htmlspecialchars($_GET['term']) : '' ?>" class="pagination-link <?= $page == $i ? 'active' : '' ?>"><?= $i ?></a>
              </li>
            <?php endfor; ?>

            <?php if ($page < $total_pages): ?>
              <li>
                <a href="?page=<?= $page + 1 ?>&term=<?= isset($_GET['term']) ? htmlspecialchars($_GET['term']) : '' ?>" class="pagination-link">Next</a>
              </li>
            <?php endif; ?>
          </ul>
        </div>
      </section>
    </div>
  </div>
  <script>
    document.addEventListener('DOMContentLoaded', () => {
      // header
      var toggleOpen = document.getElementById('toggleOpen');
      var toggleClose = document.getElementById('toggleClose');
      var collapseMenu = document.getElementById('collapseMenu');

      function handleClick() {
        if (collapseMenu.style.display === 'block') {
          collapseMenu.style.display = 'none';
        } else {
          collapseMenu.style.display = 'block';
        }
      }

      toggleOpen.addEventListener('click', handleClick);
      toggleClose.addEventListener('click', handleClick);

      // sidebar
      let sidebarToggleBtn = document.getElementById('toggle-sidebar');
      let sidebar = document.getElementById('sidebar');
      let sidebarCollapseMenu = document.getElementById('sidebar-collapse-menu');

      sidebarToggleBtn.addEventListener('click', () => {
        if (!sidebarCollapseMenu.classList.contains('open')) {
          sidebarCollapseMenu.classList.add('open');
          sidebarCollapseMenu.style.cssText = 'width: 250px; visibility: visible; opacity: 1;';
          sidebarToggleBtn.style.cssText = 'left: 236px;';
        } else {
          sidebarCollapseMenu.classList.remove('open');
          sidebarCollapseMenu.style.cssText = 'width: 32px; visibility: hidden; opacity: 0;';
          sidebarToggleBtn.style.cssText = 'left: 10px;';
        }

      });
    });
    // Toggle Sidebar on Small Screens
    const toggleSidebarButton = document.getElementById('toggle-sidebar');
    const sidebar = document.getElementById('sidebar-collapse-menu');

    toggleSidebarButton.addEventListener('click', () => {
      sidebar.classList.toggle('max-lg:w-0');
      sidebar.classList.toggle('max-lg:invisible');
      sidebar.classList.toggle('max-lg:w-64'); // Adjust width as needed
      sidebar.classList.toggle('max-lg:visible');
    });

    // Toggle Header Dropdown Menu
    const toggleOpenButton = document.getElementById('toggleOpen');
    const collapseMenu = document.getElementById('collapseMenu');

    toggleOpenButton.addEventListener('click', () => {
      collapseMenu.classList.toggle('max-lg:hidden');
      collapseMenu.classList.toggle('max-lg:block');
    });

    // Close Dropdown When Clicking Outside
    document.addEventListener('click', (event) => {
      const dropdownMenu = document.querySelector('.dropdown-menu');
      const isClickInsideDropdown = dropdownMenu.contains(event.target);

      if (!isClickInsideDropdown) {
        const dropdownContent = document.querySelector('.dropdown-content');
        dropdownContent.classList.add('hidden');
      }
    });

    // Toggle Dropdown Content on Profile Icon Click
    const profileIcon = document.querySelector('.dropdown-menu img');
    const dropdownContent = document.querySelector('.dropdown-content');

    profileIcon.addEventListener('click', (event) => {
      event.stopPropagation(); // Prevent the document click event from closing the dropdown
      dropdownContent.classList.toggle('hidden');
    });
  </script>
</body>

</html>