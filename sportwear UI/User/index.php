<?php
require_once "head.php";
// require_once "../login/checklogin.php";
require_once "navbar.php";
?>

    <div class="slider">
        <div class="list">
            <div class="item">
                <!-- <img src="../img/sportshoes.jpg" alt=""> -->
                <div class="flex w-full">
                    <div class="flex w-full h-auto" id="bodycontainer">
                        <div class="w-full flex">
                            <div class="w-1/2 h-auto pt-[50px] pl-36 mr-14" id="textdiv">
                                <p class="text-[150px] text-black font-thin italic" style="font-family: 'Bebas Neue', sans-serif;" id="text1">Wear <span class="text-red-600" id="s1">Nice</span></h1>
                                <p class="text-[150px] text-black font-thin italic -mt-20" style="font-family: 'Bebas Neue', sans-serif;" id="text2"><span class="text-red-600" id="s2">Play</span> Hype</h1>
                                <div class="flex h-auto pl-14 -mt-10" id="undertextdiv">
                                    <p class="text-5xl line-through decoration-red-600 tracking-wider mt-4" style="font-family: 'Bebas Neue', sans-serif;" id="price1">$299</p>
                                    <p class="text-5xl tracking-wider mt-4 ml-4" style="font-family: 'Bebas Neue', sans-serif;" id="price2">$200</p>
                                    <a href="sproduct.php"><button class="px-10 py-4 text-white text-3xl bg-[#795757] rounded-full hover:px-12 hover:bg-[#664343] ease-in duration-300 ml-4" style="font-family: 'Bebas Neue', sans-serif;" id="button1">Buy Now!</button></a>
                                </div>
                            </div>
                            <div class="w-[650px] h-[470px] ml-[50px] mt-[45px] mb-[200px] mr-56 p-6 rounded-md" id="coverdiv">
                                <img src="img\barshoes.jpg" alt="newbalancecover" class="w-[550px] h-[420px] rounded-md border-2 border-black" id="cover">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="item">
                <!-- <img src="img/2.jpg" alt=""> -->
                <div class="flex w-full">
                    <div class="flex w-full h-auto pb-[200px]" id="secondslider">
                        <div class="w-full flex">
                            <div class="w-full h-auto pt-[50px] ml-40 mt-10 mr-[1000px]" id="textdiv">
                                <p class="text-[120px] text-black font-thin italic" style="font-family: 'Bebas Neue', sans-serif;" id="text1">New <span class="text-red-600" id="s1">Collection</span></h1>
                                <p class="text-[120px] text-black font-thin italic -mt-16" style="font-family: 'Bebas Neue', sans-serif;" id="text2">by Top Brands</h1>
                                <div class="flex h-auto pl-14 -mt-6">
                                    <a href="sproduct.php"><button class="px-10 py-4 text-white text-3xl bg-[#795757] rounded-full hover:px-12 hover:bg-[#664343] ease-in duration-300 ml-28" style="font-family: 'Bebas Neue', sans-serif;">Go to store!</button></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="item">
                <!-- <img src="img/3.jpg" alt=""> -->
                <div class="w-full h-auto ml-[-12px] mr-[400px]" id="thirdslider">
                    <div class="flex flex-col w-full h-auto" id="textdiv">
                        <p class="text-[150px] text-white font-normal tracking-[25px] text-center" style="font-family: 'Teko', sans-serif;" id="text1">WELL BEING</p>
                        <p class="text-[50px] text-white font-normal text-center mt-36 tracking-[20px]" style="font-family: 'Teko', sans-serif;" id="text2">FACE ALL CHALLENGES WITH FITFLEX</p>
                    </div>
                    <div class="w-full flex justify-center pb-10 mt-4">
                        <a href="sproduct.php"><button class="text-3xl px-10 py-4 font-thin text-white rounded-full bg-yellow-600 hover:bg-yellow-400 hover:text-black hover:px-12 ease-in duration-300" style="font-family: 'Bebas Neue', sans-serif;">Go To Store</button></a>
                    </div>
                </div>
            </div>
            <div class="item">
                <!-- <img src="img/4.jpg" alt=""> -->
                <div class="flex w-full h-auto bg-cover bg-top bg-no-repeat brightness-[95%] justify-center items-center mr-[400px]" style="background-image: url(img/background2.jpg);">
                    <div class="w-1/2 h-auto mt-28 mb-32 pl-20">
                        <p class="text-[100px] text-white justify-self-center cursor-default" style="font-family: 'Bebas Neue', sans-serif;">Jump high, run wild</p>
                        <p class="text-[100px] text-white ml-6 -mt-6 cursor-default" style="font-family: 'Bebas Neue', sans-serif;">shine bright</p>
                        <a href="sproduct.php"><button class="px-6 py-2 bg-white text-3xl font-thin tracking-wide hover:tracking-wider rounded-full ml-6 hover:px-10 duration-300 ease-in hover:bg-red-600 hover:text-white" style="font-family: 'Bebas Neue', sans-serif;">Go to Store!</button></a>
                    </div>
                    <div class="w-1/2 h-auto mt-32 mb-32 -ml-24">
                        <img src="img/thirdnewslidercover-nobg.png" class="w-[520px] h-[300px] rounded-full shadow-md shadow-red-700 justify-self-center">
                    </div>
                </div>
            </div>
        </div>
        <div class="buttons">
            <button id="prev"><
                </button>
                    <button id="next">></button>
        </div>
        <ul class="dots">
            <li class="active"></li>
            <li></li>
            <li></li>
            <li></li>
            <li></li>
        </ul>
    </div>
    <script src="app.js"></script>
    <!--three card part-->
    <div class="flex flex-wrap" id="secondcontainer">
        <div class="max-w-sm h-auto p-6 bg-white rounded-lg shadow dark:bg-[#664343] dark:border-gray-700 mt-20 ml-24 justify-self-center" id="card1">
            <a href="#">
                <img src="img/sportwearcard.jpg" alt="image" class="w-[350px] h-auto rounded-lg">
            </a>
            <p class="mb-3 font-normal text-gray-700 dark:text-white text-3xl mt-4 text-center tracking-wide" style="font-family: 'Bebas Neue', sans-serif;">Sport Accessories</p>
            <a href="sproduct.php" class="inline-flex items-center py-4 px-2 ml-[111px] text-xl font-medium text-center text-white bg-[#3B3030] rounded-lg hover:bg-white-200 hover:text-black hover:ml-[100px] hover:px-6 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-[#3B3030] dark:hover:bg-white dark:focus:ring-blue-800 duration-700 hover:tracking-wider" style="font-family: 'Bebas Neue', sans-serif;">
                <!-- <a href="#" class="inline-flex justify-center py-4 px-2 ml-[120px] text-sm font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"> -->
                View More
                <svg class="rtl:rotate-180 w-3.5 h-3.5 ms-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 10">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 5h12m0 0L9 1m4 4L9 9" />
                </svg>
            </a>
        </div>
        <div class="max-w-sm h-auto p-6 bg-white rounded-lg shadow dark:bg-[#664343] dark:border-gray-700 mt-20 ml-24" id="card2">
            <a href="#">
                <img src="img/footballjersey.jpg" alt="image" class="w-[350px] h-auto rounded-lg">
            </a>
            <p class="mb-3 font-normal text-gray-700 dark:text-white text-3xl mt-4 text-center tracking-wide" style="font-family: 'Bebas Neue', sans-serif;">Sport Jersey</p>
            <a href="sproduct.php" class="inline-flex items-center py-4 px-2 ml-[111px] text-xl font-medium text-center text-white bg-[#3B3030] rounded-lg hover:bg-white-200 hover:text-black hover:ml-[100px] hover:px-6 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-[#3B3030] dark:hover:bg-white dark:focus:ring-blue-800 duration-700 hover:tracking-wide" style="font-family: 'Bebas Neue', sans-serif;">
                <!-- <a href="#" class="inline-flex items-center py-4 px-2 ml-[110px] text-sm font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"> -->
                View More
                <svg class="rtl:rotate-180 w-3.5 h-3.5 ms-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 10">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 5h12m0 0L9 1m4 4L9 9" />
                </svg>
            </a>
        </div>
        <div class="max-w-sm h-auto p-6 bg-white rounded-lg shadow dark:bg-[#664343] dark:border-gray-700 mt-20 ml-24" id="card3">
            <a href="#">
                <img src="img/sportshoes.jpg" alt="image" class="w-[350px] h-auto rounded-lg">
            </a>
            <p class="mb-3 font-normal text-gray-700 dark:text-white text-3xl mt-4 text-center tracking-wide" style="font-family: 'Bebas Neue', sans-serif;">Sport Shoes</p>
            <a href="sproduct.php" class="inline-flex items-center py-4 px-2 ml-[112px] text-xl font-medium text-center text-white bg-[#3B3030] rounded-lg hover:bg-white-200 hover:text-black hover:ml-[100px] hover:px-6 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-[#3B3030] dark:hover:bg-white dark:focus:ring-blue-800 duration-700 hover:tracking-wider" style="font-family: 'Bebas Neue', sans-serif;">
                View More
                <svg class="rtl:rotate-180 w-3.5 h-3.5 ms-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 10">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 5h12m0 0L9 1m4 4L9 9" />
                </svg>
            </a>
        </div>
    </div>
    <!--big image container-->
    <div class="w-full h-auto bg-red-100 flex mt-20">
        <div class="w-1/2 h-auto">
            <img src="img/big card.jpg">
        </div>
        <div class="w-1/2 h-auto">
            <img src="img/big card2.jpg">
        </div>
    </div>
    <!--Text-->
    <div class="w-full h-auto flex mt-4">
        <div class="w-1/2 h-auto ml-2">
            <h1 class="text-4xl font-bold tracking-widest" style="font-family: 'Bebas Neue', sans-serif;">BE Stylish</h1>
            <p class="text-xl" style="font-family: 'Roboto';">High performance, reliability, and comfort</p>
        </div>
        <div class="w-1/2 h-auto ml-4">
            <h1 class="text-4xl font-bold tracking-widest" style="font-family: 'Bebas Neue', sans-serif;">Shine like Diamond</h1>
            <p class="text-xl" style="font-family: 'Roboto';">Lifestyle essentials</p>
        </div>
    </div>
    <!--extra-->
    <!-- <div class="bg-gradient-to-r from-[#6626d9] via-[#a91079] to-[#e91e63] py-20 px-6 font-[sans-serif] mt-6">
        <div class="container mx-auto text-center">
            <h2 class="text-4xl font-bold text-white mb-6">Join Us Today</h2>
            <p class="text-lg text-white mb-12">Experience the future of our innovative solutions. Sign up now for exclusive access.</p>
            <a href="jacascrip:void(0);" class="bg-white text-[#a91079] hover:bg-[#a91079] hover:text-white py-3 px-8 rounded-full text-lg font-semibold transition duration-300 hover:shadow-lg">
                Get Started
            </a>
        </div>
    </div> -->
    <!--Footer-->
    <?php
    require_once "footer.php";
    ?>