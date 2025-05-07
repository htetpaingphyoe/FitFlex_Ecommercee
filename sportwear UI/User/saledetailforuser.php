<?php
require_once "head.php";
require_once "../User/head.php";
require_once "../admin/data.php";


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $sale_id = $_POST['sale_id'];
    $Allsaledetail = getSaleDetailsBySaleId($pdo,$sale_id);
    // print_r($Allsaledetail); // Assuming your function can handle sale_id
} else {
    // Handle the case where no sale_id is provided, perhaps redirect back to sales.php
    header("Location: userprofile.php");
    exit();
}

?>
<head>
  <title>FitFlex | Admin</title>
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
        /* Adding intermediate colors */
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
  </style>
</head>
<body class="" style="font-family: 'Roboto',serif;">
<?php require_once "navbar.php" ?>

      <section class="main-content w-full p-6">
        <div class="overflow-x-auto rounded-lg mb-36 p-2">
            <h1 class="text-center text-4xl font-bold p-4">Order Detail</h1>
        <table class="min-w-full md:w-1/3 border-2 border-black">
    <thead class="bg-gray-800 whitespace-nowrap border-2 border-black">
        <tr>
        <th class="p-4 text-md font-medium text-white text-center">Saledetail_ID</th>
            <!-- <th class="p-4 text-md font-medium text-white text-center">Sale_ID</th> -->
            <!-- <th class="p-4 text-md font-medium text-white text-center">Last Name</th> -->
            <th class="p-4 text-md font-medium text-white text-center">Product Name</th>
            <th class="p-4 text-md font-medium text-white text-center">Quantity</th>
            <th class="p-4 text-md font-medium text-white text-center">Price</th>
            <!-- <th class="p-4 text-md font-medium text-white text-center">Subtotal</th> -->
        </tr>
    </thead>
    <?php foreach ($Allsaledetail as $saledetail): ?>
        <tbody class="whitespace-nowrap bg-gray-200">
            <tr class="even:bg-blue-50">
            <td class="p-4 text-sm text-black text-center"><?= $saledetail["saledetail_id"] ?></td>
                <!-- <td class="p-4 text-sm text-black text-center"><?= $saledetail["sale_id"] ?></td> -->
                <td class="p-4 text-sm text-black text-center"><?= $saledetail["product_name"] ?></td>
                <td class="p-4 text-sm text-black text-center"><?= $saledetail["qty"] ?></td>
                <!-- <td class="p-4 text-sm text-black text-center"><?= $saledetail[""] ?></td> -->
                <td class="p-4 text-sm text-black text-center"><?= "$".$saledetail["price"] ?></td>
                <!-- <td class="p-4 text-sm text-black text-center"><?= "$".$saledetail["subtotal"] ?></td> -->
            </tr>
        </tbody>
    <?php endforeach ?>
</table>
<div class="flex justify-end p-2">
<a href="userprofile.php">
<button class="bg-black px-10 py-4 text-white rounded-lg">
    Back
</button>
</a>
</div>
</div>
      </section>
    </div>
  </div>
</div>
<?php require_once "footer.php"; ?>
</body>
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
</script>
