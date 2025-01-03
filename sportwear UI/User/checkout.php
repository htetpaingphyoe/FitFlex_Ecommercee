<?php
    require_once "head.php";
    require_once "navbar.php";
?>
<div class="font-[sans-serif] bg-white">
      <div class="flex max-sm:flex-col gap-12 max-lg:gap-4 h-full">
        <div class="bg-gray-100 sm:h-screen sm:sticky sm:top-0 lg:min-w-[370px] sm:min-w-[300px]">
          <div class="relative h-full">
            <div class="px-4 py-8 sm:overflow-auto sm:h-[calc(100vh-60px)]">
              <div class="space-y-4">

                <div class="flex items-start gap-4">
                  <div class="w-32 h-28 max-lg:w-24 max-lg:h-24 flex p-3 shrink-0 bg-gray-200 rounded-md">
                    <img src='https://readymadeui.com/images/product10.webp' class="w-full object-contain" />
                  </div>
                  <div class="w-full">
                    <h3 class="text-sm lg:text-base text-gray-800">Split Sneakers</h3>
                    <ul class="text-xs text-gray-800 space-y-1 mt-3">
                      <li class="flex flex-wrap gap-4">Size <span class="ml-auto">37</span></li>
                      <li class="flex flex-wrap gap-4">Quantity <span class="ml-auto">2</span></li>
                      <li class="flex flex-wrap gap-4">Total Price <span class="ml-auto">$40</span></li>
                    </ul>
                  </div>
                </div>

                <div class="flex items-start gap-4">
                  <div class="w-32 h-28 max-lg:w-24 max-lg:h-24 flex p-3 shrink-0 bg-gray-200 rounded-md">
                    <img src='https://readymadeui.com/images/product11.webp' class="w-full object-contain" />
                  </div>
                  <div class="w-full">
                    <h3 class="text-sm lg:text-base text-gray-800">Velvet Boots</h3>
                    <ul class="text-xs text-gray-800 space-y-1 mt-3">
                      <li>Size <span class="float-right">37</span></li>
                      <li>Quantity <span class="float-right">2</span></li>
                      <li>Total Price <span class="float-right">$40</span></li>
                    </ul>
                  </div>
                </div>

                <div class="flex items-start gap-4">
                  <div class="w-32 h-28 max-lg:w-24 max-lg:h-24 flex p-3 shrink-0 bg-gray-200 rounded-md">
                    <img src='https://readymadeui.com/images/product14.webp' class="w-full object-contain" />
                  </div>
                  <div class="w-full">
                    <h3 class="text-sm lg:text-base text-gray-800">Echo Elegance</h3>
                    <ul class="text-xs text-gray-800 space-y-1 mt-3">
                      <li>Size <span class="float-right">37</span></li>
                      <li>Quantity <span class="float-right">2</span></li>
                      <li>Total Price <span class="float-right">$40</span></li>
                    </ul>
                  </div>
                </div>

                <div class="flex items-start gap-4">
                  <div class="w-32 h-28 max-lg:w-24 max-lg:h-24 flex p-3 shrink-0 bg-gray-200 rounded-md">
                    <img src='https://readymadeui.com/images/product13.webp' class="w-full object-contain" />
                  </div>
                  <div class="w-full">
                    <h3 class="text-sm lg:text-base text-gray-800">Pumps</h3>
                    <ul class="text-xs text-gray-800 space-y-1 mt-3">
                      <li>Size <span class="float-right">37</span></li>
                      <li>Quantity <span class="float-right">2</span></li>
                      <li>Total Price <span class="float-right">$40</span></li>
                    </ul>
                  </div>
                </div>
              </div>
            </div>

            <div class="md:absolute md:left-0 md:bottom-0 bg-gray-200 w-full p-4">
              <h4 class="flex flex-wrap gap-4 text-sm lg:text-base text-gray-800">Total <span class="ml-auto">$84.00</span></h4>
            </div>
          </div>
        </div>

        <div class="max-w-4xl w-full h-max rounded-md px-4 py-8 sticky top-0">
          <h2 class="text-2xl font-bold text-gray-800">Complete your order</h2>
          <form class="mt-8">
            <div>
              <h3 class="text-sm lg:text-base text-gray-800 mb-4">Personal Details</h3>
              <div class="grid md:grid-cols-2 gap-4">
                <div>
                  <input type="text" placeholder="First Name"
                    class="px-4 py-3 bg-gray-100 focus:bg-transparent text-gray-800 w-full text-sm rounded-md focus:outline-blue-600" />
                </div>

                <div>
                  <input type="text" placeholder="Last Name"
                    class="px-4 py-3 bg-gray-100 focus:bg-transparent text-gray-800 w-full text-sm rounded-md focus:outline-blue-600" />
                </div>

                <div>
                  <input type="email" placeholder="Email"
                    class="px-4 py-3 bg-gray-100 focus:bg-transparent text-gray-800 w-full text-sm rounded-md focus:outline-blue-600" />
                </div>

                <div>
                  <input type="number" placeholder="Phone No."
                    class="px-4 py-3 bg-gray-100 focus:bg-transparent text-gray-800 w-full text-sm rounded-md focus:outline-blue-600" />
                </div>
              </div>
            </div>

            <div class="mt-8">
              <h3 class="text-sm lg:text-base text-gray-800 mb-4">Shipping Address</h3>
              <div class="grid md:grid-cols-2 gap-4">
                <div>
                  <input type="text" placeholder="Address Line"
                    class="px-4 py-3 bg-gray-100 focus:bg-transparent text-gray-800 w-full text-sm rounded-md focus:outline-blue-600" />
                </div>
                <div>
                  <input type="text" placeholder="City"
                    class="px-4 py-3 bg-gray-100 focus:bg-transparent text-gray-800 w-full text-sm rounded-md focus:outline-blue-600" />
                </div>
                <div>
                  <input type="text" placeholder="State"
                    class="px-4 py-3 bg-gray-100 focus:bg-transparent text-gray-800 w-full text-sm rounded-md focus:outline-blue-600" />
                </div>
                <div>
                  <input type="text" placeholder="Zip Code"
                    class="px-4 py-3 bg-gray-100 focus:bg-transparent text-gray-800 w-full text-sm rounded-md focus:outline-blue-600" />
                </div>
              </div>

              <div class="flex gap-4 max-md:flex-col mt-8">
                <button type="button" class="rounded-md px-4 py-2.5 w-full text-sm tracking-wide bg-transparent hover:bg-gray-100 border border-gray-300 text-gray-800 max-md:order-1">Cancel</button>
                <button type="button" class="rounded-md px-4 py-2.5 w-full text-sm tracking-wide bg-blue-600 hover:bg-blue-700 text-white">Complete Purchase</button>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
    <?php
        require_once "footer.php";
    ?>