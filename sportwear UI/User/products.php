<?php
require_once "head.php";
require_once "navbar.php";
?>
<div class="font-[sans-serif] bg-white p-4 mx-auto max-w-[1400px]">
      <h2 class="text-3xl sm:text-xl font-bold text-gray-800 mb-6 sm:mb-8">Home/Product</h2>

      <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4 sm:gap-6">
        <div class="group overflow-hidden cursor-pointer relative">
          <div class="bg-gray-100 w-full overflow-hidden">
            <img src="https://readymadeui.com/images/fashion-img-1.webp" alt="Product 1"
              class="aspect-[3/4] w-full object-cover object-top hover:scale-110 transition-all duration-700" />
          </div>

          <div class="p-4 relative">
            <div class="flex flex-wrap justify-between gap-2 w-full absolute px-4 pt-3 z-10
            transition-all duration-500
            left-0 right-0
            group-hover:bottom-20
            lg:bottom-5 lg:opacity-0 lg:bg-white lg:group-hover:opacity-100
            max-lg:bottom-20 max-lg:py-3 max-lg:bg-white/60">
              <button type="button" title="Add to wishlist" class="bg-transparent outline-none border-none">
                <svg xmlns="http://www.w3.org/2000/svg" class="fill-gray-800 w-5 h-5 inline-block" viewBox="0 0 64 64">
                  <path
                    d="M45.5 4A18.53 18.53 0 0 0 32 9.86 18.5 18.5 0 0 0 0 22.5C0 40.92 29.71 59 31 59.71a2 2 0 0 0 2.06 0C34.29 59 64 40.92 64 22.5A18.52 18.52 0 0 0 45.5 4ZM32 55.64C26.83 52.34 4 36.92 4 22.5a14.5 14.5 0 0 1 26.36-8.33 2 2 0 0 0 3.27 0A14.5 14.5 0 0 1 60 22.5c0 14.41-22.83 29.83-28 33.14Z"
                    data-original="#000000"></path>
                </svg>
              </button>
              <button type="button" title="Add to cart" class="bg-transparent outline-none border-none">
                <svg xmlns="http://www.w3.org/2000/svg" class="fill-gray-800 w-5 h-5 inline-block" viewBox="0 0 512 512">
                  <path
                    d="M164.96 300.004h.024c.02 0 .04-.004.059-.004H437a15.003 15.003 0 0 0 14.422-10.879l60-210a15.003 15.003 0 0 0-2.445-13.152A15.006 15.006 0 0 0 497 60H130.367l-10.722-48.254A15.003 15.003 0 0 0 105 0H15C6.715 0 0 6.715 0 15s6.715 15 15 15h77.969c1.898 8.55 51.312 230.918 54.156 243.71C131.184 280.64 120 296.536 120 315c0 24.812 20.188 45 45 45h272c8.285 0 15-6.715 15-15s-6.715-15-15-15H165c-8.27 0-15-6.73-15-15 0-8.258 6.707-14.977 14.96-14.996zM477.114 90l-51.43 180H177.032l-40-180zM150 405c0 24.813 20.188 45 45 45s45-20.188 45-45-20.188-45-45-45-45 20.188-45 45zm45-15c8.27 0 15 6.73 15 15s-6.73 15-15 15-15-6.73-15-15 6.73-15 15-15zm167 15c0 24.813 20.188 45 45 45s45-20.188 45-45-20.188-45-45-45-45 20.188-45 45zm45-15c8.27 0 15 6.73 15 15s-6.73 15-15 15-15-6.73-15-15 6.73-15 15-15zm0 0"
                    data-original="#000000"></path>
                </svg>
              </button>
            </div>
            <div class="z-20 relative bg-white">
              <h6 class="text-sm font-semibold text-gray-800 truncate">Lexicon Luxe - Tshirt</h6>
              <h6 class="text-sm text-gray-600 mt-2">$100.00</h6>
            </div>
          </div>
        </div>

        <div class="group overflow-hidden cursor-pointer relative">
          <div class="bg-gray-100 w-full overflow-hidden">
            <img src="https://readymadeui.com/images/fashion-img-2.webp" alt="Product 2"
              class="aspect-[3/4] w-full object-cover object-top hover:scale-110 transition-all duration-700" />
          </div>

          <div class="p-4 relative">
            <div class="flex flex-wrap justify-between gap-2 w-full absolute px-4 pt-3 z-10
            transition-all duration-500
            left-0 right-0
            group-hover:bottom-20
            lg:bottom-5 lg:opacity-0 lg:bg-white lg:group-hover:opacity-100
            max-lg:bottom-20 max-lg:py-3 max-lg:bg-white/60">
              <button type="button" title="Add to wishlist" class="bg-transparent outline-none border-none">
                <svg xmlns="http://www.w3.org/2000/svg" class="fill-gray-800 w-5 h-5 inline-block" viewBox="0 0 64 64">
                  <path
                    d="M45.5 4A18.53 18.53 0 0 0 32 9.86 18.5 18.5 0 0 0 0 22.5C0 40.92 29.71 59 31 59.71a2 2 0 0 0 2.06 0C34.29 59 64 40.92 64 22.5A18.52 18.52 0 0 0 45.5 4ZM32 55.64C26.83 52.34 4 36.92 4 22.5a14.5 14.5 0 0 1 26.36-8.33 2 2 0 0 0 3.27 0A14.5 14.5 0 0 1 60 22.5c0 14.41-22.83 29.83-28 33.14Z"
                    data-original="#000000"></path>
                </svg>
              </button>
              <button type="button" title="Add to cart" class="bg-transparent outline-none border-none">
                <svg xmlns="http://www.w3.org/2000/svg" class="fill-gray-800 w-5 h-5 inline-block" viewBox="0 0 512 512">
                  <path
                    d="M164.96 300.004h.024c.02 0 .04-.004.059-.004H437a15.003 15.003 0 0 0 14.422-10.879l60-210a15.003 15.003 0 0 0-2.445-13.152A15.006 15.006 0 0 0 497 60H130.367l-10.722-48.254A15.003 15.003 0 0 0 105 0H15C6.715 0 0 6.715 0 15s6.715 15 15 15h77.969c1.898 8.55 51.312 230.918 54.156 243.71C131.184 280.64 120 296.536 120 315c0 24.812 20.188 45 45 45h272c8.285 0 15-6.715 15-15s-6.715-15-15-15H165c-8.27 0-15-6.73-15-15 0-8.258 6.707-14.977 14.96-14.996zM477.114 90l-51.43 180H177.032l-40-180zM150 405c0 24.813 20.188 45 45 45s45-20.188 45-45-20.188-45-45-45-45 20.188-45 45zm45-15c8.27 0 15 6.73 15 15s-6.73 15-15 15-15-6.73-15-15 6.73-15 15-15zm167 15c0 24.813 20.188 45 45 45s45-20.188 45-45-20.188-45-45-45-45 20.188-45 45zm45-15c8.27 0 15 6.73 15 15s-6.73 15-15 15-15-6.73-15-15 6.73-15 15-15zm0 0"
                    data-original="#000000"></path>
                </svg>
              </button>
            </div>
            <div class="z-20 relative bg-white">
              <h6 class="text-sm font-semibold text-gray-800 truncate">Adjective Attire - Tshirt</h6>
              <h6 class="text-sm text-gray-600 mt-2">$120.00</h6>
            </div>
          </div>
        </div>

        <div class="group overflow-hidden cursor-pointer relative">
          <div class="bg-gray-100 w-full overflow-hidden">
            <img src="https://readymadeui.com/images/fashion-img-3.webp" alt="Product 3"
              class="aspect-[3/4] w-full object-cover object-top hover:scale-110 transition-all duration-700" />
          </div>

          <div class="p-4 relative">
            <div class="flex flex-wrap justify-between gap-2 w-full absolute px-4 pt-3 z-10
            transition-all duration-500
            left-0 right-0
            group-hover:bottom-20
            lg:bottom-5 lg:opacity-0 lg:bg-white lg:group-hover:opacity-100
            max-lg:bottom-20 max-lg:py-3 max-lg:bg-white/60">
              <button type="button" title="Add to wishlist" class="bg-transparent outline-none border-none">
                <svg xmlns="http://www.w3.org/2000/svg" class="fill-gray-800 w-5 h-5 inline-block" viewBox="0 0 64 64">
                  <path
                    d="M45.5 4A18.53 18.53 0 0 0 32 9.86 18.5 18.5 0 0 0 0 22.5C0 40.92 29.71 59 31 59.71a2 2 0 0 0 2.06 0C34.29 59 64 40.92 64 22.5A18.52 18.52 0 0 0 45.5 4ZM32 55.64C26.83 52.34 4 36.92 4 22.5a14.5 14.5 0 0 1 26.36-8.33 2 2 0 0 0 3.27 0A14.5 14.5 0 0 1 60 22.5c0 14.41-22.83 29.83-28 33.14Z"
                    data-original="#000000"></path>
                </svg>
              </button>
              <button type="button" title="Add to cart" class="bg-transparent outline-none border-none">
                <svg xmlns="http://www.w3.org/2000/svg" class="fill-gray-800 w-5 h-5 inline-block" viewBox="0 0 512 512">
                  <path
                    d="M164.96 300.004h.024c.02 0 .04-.004.059-.004H437a15.003 15.003 0 0 0 14.422-10.879l60-210a15.003 15.003 0 0 0-2.445-13.152A15.006 15.006 0 0 0 497 60H130.367l-10.722-48.254A15.003 15.003 0 0 0 105 0H15C6.715 0 0 6.715 0 15s6.715 15 15 15h77.969c1.898 8.55 51.312 230.918 54.156 243.71C131.184 280.64 120 296.536 120 315c0 24.812 20.188 45 45 45h272c8.285 0 15-6.715 15-15s-6.715-15-15-15H165c-8.27 0-15-6.73-15-15 0-8.258 6.707-14.977 14.96-14.996zM477.114 90l-51.43 180H177.032l-40-180zM150 405c0 24.813 20.188 45 45 45s45-20.188 45-45-20.188-45-45-45-45 20.188-45 45zm45-15c8.27 0 15 6.73 15 15s-6.73 15-15 15-15-6.73-15-15 6.73-15 15-15zm167 15c0 24.813 20.188 45 45 45s45-20.188 45-45-20.188-45-45-45-45 20.188-45 45zm45-15c8.27 0 15 6.73 15 15s-6.73 15-15 15-15-6.73-15-15 6.73-15 15-15zm0 0"
                    data-original="#000000"></path>
                </svg>
              </button>
            </div>
            <div class="z-20 relative bg-white">
              <h6 class="text-sm font-semibold text-gray-800 truncate">ThreadCraft Vibes - Tshirt</h6>
              <h6 class="text-sm text-gray-600 mt-2">$140.00</h6>
            </div>
          </div>
        </div>

        <div class="group overflow-hidden cursor-pointer relative">
          <div class="bg-gray-100 w-full overflow-hidden">
            <img src="https://readymadeui.com/images/fashion-img-4.webp" alt="Product 3"
              class="aspect-[3/4] w-full object-cover object-top hover:scale-110 transition-all duration-700" />
          </div>

          <div class="p-4 relative">
            <div class="flex flex-wrap justify-between gap-2 w-full absolute px-4 pt-3 z-10
            transition-all duration-500
            left-0 right-0
            group-hover:bottom-20
            lg:bottom-5 lg:opacity-0 lg:bg-white lg:group-hover:opacity-100
            max-lg:bottom-20 max-lg:py-3 max-lg:bg-white/60">
              <button type="button" title="Add to wishlist" class="bg-transparent outline-none border-none">
                <svg xmlns="http://www.w3.org/2000/svg" class="fill-gray-800 w-5 h-5 inline-block" viewBox="0 0 64 64">
                  <path
                    d="M45.5 4A18.53 18.53 0 0 0 32 9.86 18.5 18.5 0 0 0 0 22.5C0 40.92 29.71 59 31 59.71a2 2 0 0 0 2.06 0C34.29 59 64 40.92 64 22.5A18.52 18.52 0 0 0 45.5 4ZM32 55.64C26.83 52.34 4 36.92 4 22.5a14.5 14.5 0 0 1 26.36-8.33 2 2 0 0 0 3.27 0A14.5 14.5 0 0 1 60 22.5c0 14.41-22.83 29.83-28 33.14Z"
                    data-original="#000000"></path>
                </svg>
              </button>
              <button type="button" title="Add to cart" class="bg-transparent outline-none border-none">
                <svg xmlns="http://www.w3.org/2000/svg" class="fill-gray-800 w-5 h-5 inline-block" viewBox="0 0 512 512">
                  <path
                    d="M164.96 300.004h.024c.02 0 .04-.004.059-.004H437a15.003 15.003 0 0 0 14.422-10.879l60-210a15.003 15.003 0 0 0-2.445-13.152A15.006 15.006 0 0 0 497 60H130.367l-10.722-48.254A15.003 15.003 0 0 0 105 0H15C6.715 0 0 6.715 0 15s6.715 15 15 15h77.969c1.898 8.55 51.312 230.918 54.156 243.71C131.184 280.64 120 296.536 120 315c0 24.812 20.188 45 45 45h272c8.285 0 15-6.715 15-15s-6.715-15-15-15H165c-8.27 0-15-6.73-15-15 0-8.258 6.707-14.977 14.96-14.996zM477.114 90l-51.43 180H177.032l-40-180zM150 405c0 24.813 20.188 45 45 45s45-20.188 45-45-20.188-45-45-45-45 20.188-45 45zm45-15c8.27 0 15 6.73 15 15s-6.73 15-15 15-15-6.73-15-15 6.73-15 15-15zm167 15c0 24.813 20.188 45 45 45s45-20.188 45-45-20.188-45-45-45-45 20.188-45 45zm45-15c8.27 0 15 6.73 15 15s-6.73 15-15 15-15-6.73-15-15 6.73-15 15-15zm0 0"
                    data-original="#000000"></path>
                </svg>
              </button>
            </div>
            <div class="z-20 relative bg-white">
              <h6 class="text-sm font-semibold text-gray-800 truncate">Verbal Vogue Tees - Tshirt</h6>
              <h6 class="text-sm text-gray-600 mt-2">$120.00</h6>
            </div>
          </div>
        </div>

        <div class="group overflow-hidden cursor-pointer relative">
          <div class="bg-gray-100 w-full overflow-hidden">
            <img src="https://readymadeui.com/images/fashion-img-5.webp" alt="Product 3"
              class="aspect-[3/4] w-full object-cover object-top hover:scale-110 transition-all duration-700" />
          </div>

          <div class="p-4 relative">
            <div class="flex flex-wrap justify-between gap-2 w-full absolute px-4 pt-3 z-10
            transition-all duration-500
            left-0 right-0
            group-hover:bottom-20
            lg:bottom-5 lg:opacity-0 lg:bg-white lg:group-hover:opacity-100
            max-lg:bottom-20 max-lg:py-3 max-lg:bg-white/60">
              <button type="button" title="Add to wishlist" class="bg-transparent outline-none border-none">
                <svg xmlns="http://www.w3.org/2000/svg" class="fill-gray-800 w-5 h-5 inline-block" viewBox="0 0 64 64">
                  <path
                    d="M45.5 4A18.53 18.53 0 0 0 32 9.86 18.5 18.5 0 0 0 0 22.5C0 40.92 29.71 59 31 59.71a2 2 0 0 0 2.06 0C34.29 59 64 40.92 64 22.5A18.52 18.52 0 0 0 45.5 4ZM32 55.64C26.83 52.34 4 36.92 4 22.5a14.5 14.5 0 0 1 26.36-8.33 2 2 0 0 0 3.27 0A14.5 14.5 0 0 1 60 22.5c0 14.41-22.83 29.83-28 33.14Z"
                    data-original="#000000"></path>
                </svg>
              </button>
              <button type="button" title="Add to cart" class="bg-transparent outline-none border-none">
                <svg xmlns="http://www.w3.org/2000/svg" class="fill-gray-800 w-5 h-5 inline-block" viewBox="0 0 512 512">
                  <path
                    d="M164.96 300.004h.024c.02 0 .04-.004.059-.004H437a15.003 15.003 0 0 0 14.422-10.879l60-210a15.003 15.003 0 0 0-2.445-13.152A15.006 15.006 0 0 0 497 60H130.367l-10.722-48.254A15.003 15.003 0 0 0 105 0H15C6.715 0 0 6.715 0 15s6.715 15 15 15h77.969c1.898 8.55 51.312 230.918 54.156 243.71C131.184 280.64 120 296.536 120 315c0 24.812 20.188 45 45 45h272c8.285 0 15-6.715 15-15s-6.715-15-15-15H165c-8.27 0-15-6.73-15-15 0-8.258 6.707-14.977 14.96-14.996zM477.114 90l-51.43 180H177.032l-40-180zM150 405c0 24.813 20.188 45 45 45s45-20.188 45-45-20.188-45-45-45-45 20.188-45 45zm45-15c8.27 0 15 6.73 15 15s-6.73 15-15 15-15-6.73-15-15 6.73-15 15-15zm167 15c0 24.813 20.188 45 45 45s45-20.188 45-45-20.188-45-45-45-45 20.188-45 45zm45-15c8.27 0 15 6.73 15 15s-6.73 15-15 15-15-6.73-15-15 6.73-15 15-15zm0 0"
                    data-original="#000000"></path>
                </svg>
              </button>
            </div>
            <div class="z-20 relative bg-white">
              <h6 class="text-sm font-semibold text-gray-800 truncate">Jargon Jungle - Tshirt</h6>
              <h6 class="text-sm text-gray-600 mt-2">$150.00</h6>
            </div>
          </div>
        </div>

        <div class="group overflow-hidden cursor-pointer relative">
          <div class="bg-gray-100 w-full overflow-hidden">
            <img src="https://readymadeui.com/images/fashion-img-6.webp" alt="Product 3"
              class="aspect-[3/4] w-full object-cover object-top hover:scale-110 transition-all duration-700" />
          </div>

          <div class="p-4 relative">
            <div class="flex flex-wrap justify-between gap-2 w-full absolute px-4 pt-3 z-10
            transition-all duration-500
            left-0 right-0
            group-hover:bottom-20
            lg:bottom-5 lg:opacity-0 lg:bg-white lg:group-hover:opacity-100
            max-lg:bottom-20 max-lg:py-3 max-lg:bg-white/60">
              <button type="button" title="Add to wishlist" class="bg-transparent outline-none border-none">
                <svg xmlns="http://www.w3.org/2000/svg" class="fill-gray-800 w-5 h-5 inline-block" viewBox="0 0 64 64">
                  <path
                    d="M45.5 4A18.53 18.53 0 0 0 32 9.86 18.5 18.5 0 0 0 0 22.5C0 40.92 29.71 59 31 59.71a2 2 0 0 0 2.06 0C34.29 59 64 40.92 64 22.5A18.52 18.52 0 0 0 45.5 4ZM32 55.64C26.83 52.34 4 36.92 4 22.5a14.5 14.5 0 0 1 26.36-8.33 2 2 0 0 0 3.27 0A14.5 14.5 0 0 1 60 22.5c0 14.41-22.83 29.83-28 33.14Z"
                    data-original="#000000"></path>
                </svg>
              </button>
              <button type="button" title="Add to cart" class="bg-transparent outline-none border-none">
                <svg xmlns="http://www.w3.org/2000/svg" class="fill-gray-800 w-5 h-5 inline-block" viewBox="0 0 512 512">
                  <path
                    d="M164.96 300.004h.024c.02 0 .04-.004.059-.004H437a15.003 15.003 0 0 0 14.422-10.879l60-210a15.003 15.003 0 0 0-2.445-13.152A15.006 15.006 0 0 0 497 60H130.367l-10.722-48.254A15.003 15.003 0 0 0 105 0H15C6.715 0 0 6.715 0 15s6.715 15 15 15h77.969c1.898 8.55 51.312 230.918 54.156 243.71C131.184 280.64 120 296.536 120 315c0 24.812 20.188 45 45 45h272c8.285 0 15-6.715 15-15s-6.715-15-15-15H165c-8.27 0-15-6.73-15-15 0-8.258 6.707-14.977 14.96-14.996zM477.114 90l-51.43 180H177.032l-40-180zM150 405c0 24.813 20.188 45 45 45s45-20.188 45-45-20.188-45-45-45-45 20.188-45 45zm45-15c8.27 0 15 6.73 15 15s-6.73 15-15 15-15-6.73-15-15 6.73-15 15-15zm167 15c0 24.813 20.188 45 45 45s45-20.188 45-45-20.188-45-45-45-45 20.188-45 45zm45-15c8.27 0 15 6.73 15 15s-6.73 15-15 15-15-6.73-15-15 6.73-15 15-15zm0 0"
                    data-original="#000000"></path>
                </svg>
              </button>
            </div>
            <div class="z-20 relative bg-white">
              <h6 class="text-sm font-semibold text-gray-800 truncate">Syllable Streetwear - Tshirt</h6>
              <h6 class="text-sm text-gray-600 mt-2">$140.00</h6>
            </div>
          </div>
        </div>

        <div class="group overflow-hidden cursor-pointer relative">
          <div class="bg-gray-100 w-full overflow-hidden">
            <img src="https://readymadeui.com/images/fashion-img-7.webp" alt="Product 3"
              class="aspect-[3/4] w-full object-cover object-top hover:scale-110 transition-all duration-700" />
          </div>

          <div class="p-4 relative">
            <div class="flex flex-wrap justify-between gap-2 w-full absolute px-4 pt-3 z-10
            transition-all duration-500
            left-0 right-0
            group-hover:bottom-20
            lg:bottom-5 lg:opacity-0 lg:bg-white lg:group-hover:opacity-100
            max-lg:bottom-20 max-lg:py-3 max-lg:bg-white/60">
              <button type="button" title="Add to wishlist" class="bg-transparent outline-none border-none">
                <svg xmlns="http://www.w3.org/2000/svg" class="fill-gray-800 w-5 h-5 inline-block" viewBox="0 0 64 64">
                  <path
                    d="M45.5 4A18.53 18.53 0 0 0 32 9.86 18.5 18.5 0 0 0 0 22.5C0 40.92 29.71 59 31 59.71a2 2 0 0 0 2.06 0C34.29 59 64 40.92 64 22.5A18.52 18.52 0 0 0 45.5 4ZM32 55.64C26.83 52.34 4 36.92 4 22.5a14.5 14.5 0 0 1 26.36-8.33 2 2 0 0 0 3.27 0A14.5 14.5 0 0 1 60 22.5c0 14.41-22.83 29.83-28 33.14Z"
                    data-original="#000000"></path>
                </svg>
              </button>
              <button type="button" title="Add to cart" class="bg-transparent outline-none border-none">
                <svg xmlns="http://www.w3.org/2000/svg" class="fill-gray-800 w-5 h-5 inline-block" viewBox="0 0 512 512">
                  <path
                    d="M164.96 300.004h.024c.02 0 .04-.004.059-.004H437a15.003 15.003 0 0 0 14.422-10.879l60-210a15.003 15.003 0 0 0-2.445-13.152A15.006 15.006 0 0 0 497 60H130.367l-10.722-48.254A15.003 15.003 0 0 0 105 0H15C6.715 0 0 6.715 0 15s6.715 15 15 15h77.969c1.898 8.55 51.312 230.918 54.156 243.71C131.184 280.64 120 296.536 120 315c0 24.812 20.188 45 45 45h272c8.285 0 15-6.715 15-15s-6.715-15-15-15H165c-8.27 0-15-6.73-15-15 0-8.258 6.707-14.977 14.96-14.996zM477.114 90l-51.43 180H177.032l-40-180zM150 405c0 24.813 20.188 45 45 45s45-20.188 45-45-20.188-45-45-45-45 20.188-45 45zm45-15c8.27 0 15 6.73 15 15s-6.73 15-15 15-15-6.73-15-15 6.73-15 15-15zm167 15c0 24.813 20.188 45 45 45s45-20.188 45-45-20.188-45-45-45-45 20.188-45 45zm45-15c8.27 0 15 6.73 15 15s-6.73 15-15 15-15-6.73-15-15 6.73-15 15-15zm0 0"
                    data-original="#000000"></path>
                </svg>
              </button>
            </div>
            <div class="z-20 relative bg-white">
              <h6 class="text-sm font-semibold text-gray-800 truncate">Syllable Streetwear - Tshirt</h6>
              <h6 class="text-sm text-gray-600 mt-2">$140.00</h6>
            </div>
          </div>
        </div>

        <div class="group overflow-hidden cursor-pointer relative">
          <div class="bg-gray-100 w-full overflow-hidden">
            <img src="https://readymadeui.com/images/fashion-img-9.webp" alt="Product 3"
              class="aspect-[3/4] w-full object-cover object-top hover:scale-110 transition-all duration-700" />
          </div>

          <div class="p-4 relative">
            <div class="flex flex-wrap justify-between gap-2 w-full absolute px-4 pt-3 z-10
            transition-all duration-500
            left-0 right-0
            group-hover:bottom-20
            lg:bottom-5 lg:opacity-0 lg:bg-white lg:group-hover:opacity-100
            max-lg:bottom-20 max-lg:py-3 max-lg:bg-white/60">
              <button type="button" title="Add to wishlist" class="bg-transparent outline-none border-none">
                <svg xmlns="http://www.w3.org/2000/svg" class="fill-gray-800 w-5 h-5 inline-block" viewBox="0 0 64 64">
                  <path
                    d="M45.5 4A18.53 18.53 0 0 0 32 9.86 18.5 18.5 0 0 0 0 22.5C0 40.92 29.71 59 31 59.71a2 2 0 0 0 2.06 0C34.29 59 64 40.92 64 22.5A18.52 18.52 0 0 0 45.5 4ZM32 55.64C26.83 52.34 4 36.92 4 22.5a14.5 14.5 0 0 1 26.36-8.33 2 2 0 0 0 3.27 0A14.5 14.5 0 0 1 60 22.5c0 14.41-22.83 29.83-28 33.14Z"
                    data-original="#000000"></path>
                </svg>
              </button>
              <button type="button" title="Add to cart" class="bg-transparent outline-none border-none">
                <svg xmlns="http://www.w3.org/2000/svg" class="fill-gray-800 w-5 h-5 inline-block" viewBox="0 0 512 512">
                  <path
                    d="M164.96 300.004h.024c.02 0 .04-.004.059-.004H437a15.003 15.003 0 0 0 14.422-10.879l60-210a15.003 15.003 0 0 0-2.445-13.152A15.006 15.006 0 0 0 497 60H130.367l-10.722-48.254A15.003 15.003 0 0 0 105 0H15C6.715 0 0 6.715 0 15s6.715 15 15 15h77.969c1.898 8.55 51.312 230.918 54.156 243.71C131.184 280.64 120 296.536 120 315c0 24.812 20.188 45 45 45h272c8.285 0 15-6.715 15-15s-6.715-15-15-15H165c-8.27 0-15-6.73-15-15 0-8.258 6.707-14.977 14.96-14.996zM477.114 90l-51.43 180H177.032l-40-180zM150 405c0 24.813 20.188 45 45 45s45-20.188 45-45-20.188-45-45-45-45 20.188-45 45zm45-15c8.27 0 15 6.73 15 15s-6.73 15-15 15-15-6.73-15-15 6.73-15 15-15zm167 15c0 24.813 20.188 45 45 45s45-20.188 45-45-20.188-45-45-45-45 20.188-45 45zm45-15c8.27 0 15 6.73 15 15s-6.73 15-15 15-15-6.73-15-15 6.73-15 15-15zm0 0"
                    data-original="#000000"></path>
                </svg>
              </button>
            </div>
            <div class="z-20 relative bg-white">
              <h6 class="text-sm font-semibold text-gray-800 truncate">Syllable Streetwear - Tshirt</h6>
              <h6 class="text-sm text-gray-600 mt-2">$140.00</h6>
            </div>
          </div>
        </div>
      </div>
    </div>
    <ul class="flex space-x-5 mt-6 justify-center font-[sans-serif]">
      <li class="flex items-center justify-center shrink-0 bg-gray-100 w-9 h-9 rounded-md">
        <svg xmlns="http://www.w3.org/2000/svg" class="w-3 fill-gray-400" viewBox="0 0 55.753 55.753">
          <path
            d="M12.745 23.915c.283-.282.59-.52.913-.727L35.266 1.581a5.4 5.4 0 0 1 7.637 7.638L24.294 27.828l18.705 18.706a5.4 5.4 0 0 1-7.636 7.637L13.658 32.464a5.367 5.367 0 0 1-.913-.727 5.367 5.367 0 0 1-1.572-3.911 5.369 5.369 0 0 1 1.572-3.911z"
            data-original="#000000" />
        </svg>
      </li>
      <li
        class="flex items-center justify-center shrink-0 bg-black border-2 hover:border-red-700 cursor-pointer text-base font-bold text-white px-[13px] h-9 rounded-md">
        1
      </li>
      <li
        class="flex items-center justify-center shrink-0 border-2 hover:border-red-700 cursor-pointer text-base font-bold text-gray-800 px-[13px] h-9 rounded-md">
        2
      </li>
      <li
        class="flex items-center justify-center shrink-0 border-2 hover:border-red-700 cursor-pointer text-base font-bold text-gray-800 px-[13px] h-9 rounded-md">
        3
      </li>
      <li
        class="flex items-center justify-center shrink-0 border-2 hover:border-red-700 cursor-pointer text-base font-bold text-gray-800 px-[13px] h-9 rounded-md">
        4
      </li>
      <li class="flex items-center justify-center shrink-0 border-2 hover:border-red-700 cursor-pointer w-9 h-9 rounded-md">
        <svg xmlns="http://www.w3.org/2000/svg" class="w-3 fill-gray-400 rotate-180" viewBox="0 0 55.753 55.753">
          <path
            d="M12.745 23.915c.283-.282.59-.52.913-.727L35.266 1.581a5.4 5.4 0 0 1 7.637 7.638L24.294 27.828l18.705 18.706a5.4 5.4 0 0 1-7.636 7.637L13.658 32.464a5.367 5.367 0 0 1-.913-.727 5.367 5.367 0 0 1-1.572-3.911 5.369 5.369 0 0 1 1.572-3.911z"
            data-original="#000000" />
        </svg>
      </li>
    </ul>
    <?php
        require_once "footer.php";
    ?>