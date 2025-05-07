<?php
require_once "../db/connect.php";
require_once "../admin/head.php";
?>

<div class="font-[sans-serif]">
    <div class="min-h-screen flex flex-col items-center justify-center">
        <div class="max-w-md w-full p-4 m-4 shadow-[0_2px_10px_-3px_rgba(6,81,237,0.3)] rounded-md">
            <form action="send_reset_link.php" method="POST">
                <div class="mb-12">
                    <h3 class="text-gray-800 text-3xl font-extrabold">Forgot Password</h3>
                    <p class="text-sm mt-4 text-gray-800">Enter your email to reset your password.</p>
                </div>

                <div>
                    <label class="text-gray-800 text-xs block mb-2">Email</label>
                    <div class="relative flex items-center">
                        <input name="email" type="email" required class="w-full text-gray-800 text-sm border-b border-gray-300 focus:border-blue-600 px-2 py-3 outline-none" placeholder="Enter email" />
                    </div>
                </div>

                <div class="mt-12">
                    <button type="submit" class="w-full shadow-xl py-2.5 px-4 text-sm tracking-wide rounded-md text-white bg-blue-600 hover:bg-blue-700 focus:outline-none">
                        Send Reset Link
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>