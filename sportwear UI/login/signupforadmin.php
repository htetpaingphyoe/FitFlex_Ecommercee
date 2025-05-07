<?php
require_once "../User/head.php";
?>

<head>
  <!-- <link href="../User/fontfamily.css" rel="stylesheet"> -->
  <style>
    body {
      /* background-image: url("../User/img/signupforadmin.jpg"); */
      background-repeat: repeat;
      background-size: cover;
    }

    #title {
      animation-duration: 4s;
      animation-name: changecolor;
      animation-iteration-count: infinite;
      animation-timing-function: ease-in-out;
    }
    @keyframes changecolor {
  0% {
    color: rgb(220 38 38);
  }
  25% {
    color: darkred; /* Adding intermediate colors */
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

<body>
  <div class="max-w-4xl mx-auto font-[sans-serif] p-6 mt-0" id="signup">
    <div class="text-center mb-10">
      <a href="../User/index.php">
        <h1 class="text-6xl font-bold" style="font-family: 'Bungee Shade', sans-serif;" id="title">FitFlex</h1>
      </a>
      <h4 class="text-gray-800 text-base font-semibold mt-4 font-Roboto">Sign up into your account For New Admin</h4>
    </div>
    <form action="signupprocessforadmin.php" method="POST">
      <div class="grid sm:grid-cols-2 gap-6">
        <div>
          <label class="text-gray-800 text-sm mb-2 block">First Name</label>
          <input name="name" type="text" class="bg-gray-100 w-full text-gray-800 text-sm px-4 py-3.5 rounded-md border-2 border-black focus:bg-transparent outline-red-700 transition-all" required placeholder="Enter name" />
        </div>
        <div>
          <label class="text-gray-800 text-sm mb-2 block">Last Name</label>
          <input name="lname" type="text" class="bg-gray-100 w-full text-gray-800 text-sm px-4 py-3.5 rounded-md border-2 border-black focus:bg-transparent outline-red-700 transition-all" required placeholder="Enter last name" />
        </div>
        <div>
          <label class="text-gray-800 text-sm mb-2 block">Email</label>
          <input name="email" type="email" class="bg-gray-100 w-full text-gray-800 text-sm px-4 py-3.5 rounded-md border-2 border-black focus:bg-transparent outline-red-700 transition-all" required placeholder="Enter email" />
        </div>
        <div>
          <label class="text-gray-800 text-sm mb-2 block">Mobile No.</label>
          <input name="ph_number" type="text" class="bg-gray-100 w-full text-gray-800 text-sm px-4 py-3.5 rounded-md border-2 border-black focus:bg-transparent outline-red-700 transition-all" required placeholder="Enter mobile number" />
        </div>
        <div>
          <label class="text-gray-800 text-sm mb-2 block">Password</label>
          <input name="password" type="password" class="bg-gray-100 w-full text-gray-800 text-sm px-4 py-3.5 rounded-md border-2 border-black focus:bg-transparent outline-red-700 transition-all" required placeholder="Enter password" />
        </div>
        <div>
          <label class="text-gray-800 text-sm mb-2 block">NRC</label>
          <input name="nrc" type="text" pattern="\d{1,2}\/[A-Za-z]{3}\([A-Za-z]\)\d{6}" placeholder="e.g., 12/ABC(N)123456" class="bg-gray-100 w-full text-gray-800 text-sm px-4 py-3.5 rounded-md border-2 border-black focus:bg-transparent outline-red-700 transition-all" required  />
        </div>
        <div class="col-span-2">
          <label class="text-gray-800 text-sm mb-2 block">Address</label>
          <input name="address" type="text" class="bg-gray-100 w-full text-gray-800 text-sm px-4 py-3.5 rounded-md border-2 border-black focus:bg-transparent outline-red-700 transition-all" required placeholder="Enter Address" />
        </div>
      </div>
      <!-- <div class="flex flex-col mt-4 space-y-0.5">
        <label for="address" class="mb-2 text-sm">Address</label>
        <input name="address" type="text" class="bg-gray-100 w-full text-gray-800 text-sm px-4 py-3.5 rounded-md focus:bg-transparent outline-blue-500 transition-all" placeholder="Enter confirm password"">
        </div> -->
        <div class=" mt-2">
        <h1 class=" text-sm">Already a admin? <a href="login.php" class="text-black hover:text-blue-500 font-bold">Login here!</a></h1>
      </div>
      <div class="!mt-2 flex justify-center">
        <button type="submit" class="py-3.5 px-7 text-sm font-Roboto font-semibold tracking-wider rounded-md text-white bg-black hover:bg-green-700 focus:outline-none">
          Sign up
        </button>
      </div>
    </form>
  </div>
</body>