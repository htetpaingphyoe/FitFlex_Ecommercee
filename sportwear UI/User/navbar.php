<?php
if (!isset($_SESSION)) {
    session_start();
}

$qty = 0;
if (isset($_SESSION['cart'])) {
    foreach ($_SESSION['cart'] as $record) {
        // print_r($record); echo "<br>";
        $qty += $record['qty'];
    }
}
// Fetch wishlist count
$wishlist_count = 0;
if (isset($_SESSION['user'])) {
    $user_id = $_SESSION['user']['User_Id'];
    require_once "../db/connect.php"; // Include the database connection file

    try {
        $sql = "SELECT COUNT(*) as count FROM wishlist WHERE user_id = :user_id";
        $stmt = $pdo->prepare($sql);
        $stmt->execute(['user_id' => $user_id]);
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        $wishlist_count = $result['count'];
    } catch (PDOException $e) {
        die("Database error: " . $e->getMessage());
    }
}

?>

<header class='shadow-md bg-white font-[sans-serif] tracking-wide relative z-50'>
    <section class='flex items-center flex-wrap lg:justify-center gap-4 py-2.5 sm:px-10 px-4 border-gray-200 border-b min-h-[70px]'>

        <div class='left-10 absolute z-50 bg-gray-100 flex items-center px-4 py-2.5 rounded max-lg:hidden'>
            <form id="searchForm" action="sproduct.php" method="GET" class="flex items-center">
                <div class="input-wrapper">
                    <input id="searchInput" class="input-box" type="text" name="query" placeholder="Search..." required>
                    <span class="underline"></span>
                </div>
                <button type="submit" class="cursor-pointer">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 192.904 192.904" class="fill-black-400 mr-2.5 inline-block w-[18px] h-[20px]">
                        <path
                            d="m190.707 180.101-47.078-47.077c11.702-14.072 18.752-32.142 18.752-51.831C162.381 36.423 125.959 0 81.191 0 36.422 0 0 36.423 0 81.193c0 44.767 36.422 81.187 81.191 81.187 19.688 0 37.759-7.049 51.831-18.751l47.079 47.078a7.474 7.474 0 0 0 5.303 2.197 7.498 7.498 0 0 0 5.303-12.803zM15 81.193C15 44.694 44.693 15 81.191 15c36.497 0 66.189 29.694 66.189 66.193 0 36.496-29.692 66.187-66.189 66.187C44.693 147.38 15 117.689 15 81.193z">
                        </path>
                    </svg>
                </button>
            </form>
        </div>

        <a href="index.php" class="max-sm:hidden">
            <!-- <img src="https://readymadeui.com/readymadeui.svg" alt="logo" class='w-36' /> -->
            <h1 class="text-5xl font-bold" style="font-family: 'Bungee Shade', sans-serif;" id="title">FitFlex</h1>
        </a>
        <a href="index.php" class="hidden max-sm:block">
            <!-- <img src="https://readymadeui.com/readymadeui-short.svg" alt="logo" class='w-9' /> -->
            <h2 class="text-4xl font-bold" style="font-family: 'Bungee Shade', sans-serif;" id="title">FitFlex</h2>
        </a>

        <div class="lg:absolute lg:right-10 flex items-center ml-2 space-x-6">
            <a href="wishlist.php">
                <span class="relative">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20px"
                        class="cursor-pointer fill-gray-800 hover:fill-red-700 inline-block" viewBox="0 0 64 64">
                        <path
                            d="M45.5 4A18.53 18.53 0 0 0 32 9.86 18.5 18.5 0 0 0 0 22.5C0 40.92 29.71 59 31 59.71a2 2 0 0 0 2.06 0C34.29 59 64 40.92 64 22.5A18.52 18.52 0 0 0 45.5 4ZM32 55.64C26.83 52.34 4 36.92 4 22.5a14.5 14.5 0 0 1 26.36-8.33 2 2 0 0 0 3.27 0A14.5 14.5 0 0 1 60 22.5c0 14.41-22.83 29.83-28 33.14Z"
                            data-original="#000000" />
                    </svg>
                    <span class="absolute left-auto -ml-1 top-2 rounded-full bg-black px-1 py-0 text-xs text-white"><?= $wishlist_count ?></span>
                </span>
            </a>

            <a href="cartpage.php">
                <span class="relative">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20px" height="20px"
                        class="cursor-pointer fill-black hover:fill-red-700 inline-block" viewBox="0 0 512 512">
                        <path
                            d="M164.96 300.004h.024c.02 0 .04-.004.059-.004H437a15.003 15.003 0 0 0 14.422-10.879l60-210a15.003 15.003 0 0 0-2.445-13.152A15.006 15.006 0 0 0 497 60H130.367l-10.722-48.254A15.003 15.003 0 0 0 105 0H15C6.715 0 0 6.715 0 15s6.715 15 15 15h77.969c1.898 8.55 51.312 230.918 54.156 243.71C131.184 280.64 120 296.536 120 315c0 24.812 20.188 45 45 45h272c8.285 0 15-6.715 15-15s-6.715-15-15-15H165c-8.27 0-15-6.73-15-15 0-8.258 6.707-14.977 14.96-14.996zM477.114 90l-51.43 180H177.032l-40-180zM150 405c0 24.813 20.188 45 45 45s45-20.188 45-45-20.188-45-45-45-45 20.188-45 45zm45-15c8.27 0 15 6.73 15 15s-6.73 15-15 15-15-6.73-15-15 6.73-15 15-15zm167 15c0 24.813 20.188 45 45 45s45-20.188 45-45-20.188-45-45-45-45 20.188-45 45zm45-15c8.27 0 15 6.73 15 15s-6.73 15-15 15-15-6.73-15-15 6.73-15 15-15zm0 0"
                            data-original="#000000"></path>
                    </svg>
                    <span class="absolute left-auto -ml-1 top-2 rounded-full bg-black px-1 py-0 text-xs text-white"><?= $qty ?></span>
                </span>
            </a>
            <?php if (!isset($_SESSION['user'])): ?>
                <div class="inline-block cursor-pointer border-gray-300">
                    <a href="../login/login.php">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20px" height="20px" viewBox="0 0 24 24" class="hover:fill-red-700">
                            <circle cx="10" cy="7" r="6" data-original="#000000" />
                            <path d="M14 15H6a5 5 0 0 0-5 5 3 3 0 0 0 3 3h12a3 3 0 0 0 3-3 5 5 0 0 0-5-5zm8-4h-2.59l.3-.29a1 1 0 0 0-1.42-1.42l-2 2a1 1 0 0 0 0 1.42l2 2a1 1 0 0 0 1.42 0 1 1 0 0 0 0-1.42l-.3-.29H22a1 1 0 0 0 0-2z" data-original="#000000" />
                        </svg>
                    </a>
                </div>
            <?php endif; ?>
            <?php if (isset($_SESSION['user'])): ?>
                <div class="inline-block">
                    <a href="userprofile.php">
                        <!-- <i class="fa-solid  fa-right-from-bracket hover:text-red-700"></i> -->
                        <i class="fa-solid fa-lg fa-user hover:text-red-700"></i>
                    </a>
                </div>
            <?php endif; ?>
        </div>
    </section>

    <div class='flex flex-wrap justify-center px-10 py-3 relative'>

        <div id="collapseMenu"
            class='max-lg:hidden lg:!block max-lg:before:fixed max-lg:before:bg-black max-lg:before:opacity-40 max-lg:before:inset-0 max-lg:before:z-50'>
            <button id="toggleClose" class='lg:hidden fixed top-2 right-4 z-[100] rounded-full bg-white w-9 h-9 flex items-center justify-center border'>
                <svg xmlns="http://www.w3.org/2000/svg" class="w-3.5 h-3.5 fill-black" viewBox="0 0 320.591 320.591">
                    <path
                        d="M30.391 318.583a30.37 30.37 0 0 1-21.56-7.288c-11.774-11.844-11.774-30.973 0-42.817L266.643 10.665c12.246-11.459 31.462-10.822 42.921 1.424 10.362 11.074 10.966 28.095 1.414 39.875L51.647 311.295a30.366 30.366 0 0 1-21.256 7.288z"
                        data-original="#000000"></path>
                    <path
                        d="M287.9 318.583a30.37 30.37 0 0 1-21.257-8.806L8.83 51.963C-2.078 39.225-.595 20.055 12.143 9.146c11.369-9.736 28.136-9.736 39.504 0l259.331 257.813c12.243 11.462 12.876 30.679 1.414 42.922-.456.487-.927.958-1.414 1.414a30.368 30.368 0 0 1-23.078 7.288z"
                        data-original="#000000"></path>
                </svg>
            </button>

            <ul
                class='lg:flex lg:gap-x-10 max-lg:space-y-3 max-lg:fixed max-lg:bg-white max-lg:w-2/3 max-lg:min-w-[280px] max-lg:top-0 max-lg:left-0 max-lg:p-4 max-lg:h-full max-lg:shadow-md max-lg:overflow-auto z-50'>
                <li class='max-lg:border-b max-lg:pb-4 px-3 lg:hidden'>
                    <a href="index.php">
                        <h1 class="text-5xl font-bold" style="font-family: 'Bungee Shade', sans-serif;" id="title">FitFlex</h1>
                    </a>
                </li>
                <li class='max-lg:border-b max-lg:px-3 max-lg:py-3'><a href='index.php'
                        class='hover:text-red-700 text-black block text-[25px]' style="font-family: 'Bebas Neue', sans-serif;">Home</a></li>
                <li class='group max-lg:border-b max-lg:px-3 max-lg:py-3 relative'>
                    <a href='sproduct.php'
                        class='hover:text-red-700 hover:fill-[#007bff] text-gray-800 text-[25px] flex items-center' style="font-family: 'Bebas Neue', sans-serif;">Store
                    </a>
                    <ul
                        class='absolute top-5 max-lg:top-8 left-0 z-50 hidden space-y-2 shadow-lg bg-white max-h-0 overflow-hidden min-w-[230px] group-hover:opacity-100 group-hover:max-h-[700px] px-6 group-hover:pb-4 group-hover:pt-6 transition-all duration-[400ms]'>
                    </ul>
                </li>
                <li class='max-lg:border-b max-lg:px-3 max-lg:py-3' style="font-family: 'Bebas Neue', sans-serif;"><a href='aboutus.php'
                        class='hover:text-red-700 text-gray-800 text-[25px] block'>About</a></li>
                <li class='max-lg:border-b max-lg:px-3 max-lg:py-3' style="font-family: 'Bebas Neue', sans-serif;"><a href='contactus.php'
                        class='hover:text-red-700 text-gray-800 text-[25px] block'>Contact</a></li>
            </ul>
        </div>
        <div id="toggleOpen" class='flex ml-auto lg:hidden'>
            <button>
                <svg class="w-7 h-7" fill="#000" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd"
                        d="M3 5a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 10a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 15a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1z"
                        clip-rule="evenodd"></path>
                </svg>
            </button>
        </div>
    </div>
</header>
<script>
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
    document.getElementById('searchInput').addEventListener('input', function(e) {
        const query = e.target.value;
        if (query.length > 2) { // Only search if the query is at least 3 characters long
            fetch(`/search?query=${encodeURIComponent(query)}`)
                .then(response => response.json())
                .then(data => {
                    console.log(data); // Display search results (e.g., in a dropdown)
                })
                .catch(error => console.error('Error fetching search results:', error));
        }
    });
</script>