<?php

require_once __DIR__.'/boot.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/main.css">
    <title>Register New User</title>
</head>
<body class="app overflow-x-hidden">
<div class="min-h-screen flex flex-col justify-center py-12 sm:px-6 lg:px-8 bg-gradient-to-r from-black via-red-900 to-black">
    <div class="sm:mx-auto sm:w-full sm:max-w-md">
        <a href="/">
            <svg viewBox="0 0 81 94" fill="none" xmlns="http://www.w3.org/2000/svg" class="mx-auto h-16 w-auto">
                <g clip-path="url(#clip0_4_50)">
                    <path d="M27.07 7.75999L0 23.39V35.51L27.06 19.88L54.12 35.51V23.39L27.07 7.75999ZM53.66 85.85L26.6 70.22V58.1L53.67 73.73L80.72 58.1V70.22L53.66 85.85Z" fill="white"/>
                    <path d="M0 38.76L27.06 23.13L37.55 29.19L10.5 44.83V76.08L0 70.02V38.76ZM67.44 15.63L40.38 0L29.88 6.06L56.94 21.68V52.93L67.44 46.87V15.63Z" fill="white"/>
                    <path d="M13.37 77.88V46.63L23.87 40.57V71.82L50.93 87.45L40.43 93.51L13.37 77.88ZM80.72 54.84V23.59L70.22 17.53V48.78L43.16 64.41L53.66 70.47L80.72 54.84Z" fill="white"/>
                </g>
                <defs>
                    <clipPath id="clip0_4_50">
                        <rect width="80.72" height="93.51" fill="white"/>
                    </clipPath>
                </defs>
            </svg>

        </a>
        <h2 class="my-6 text-center text-3xl font-extrabold text-white">Registration</h2>
    </div>

    <div class="my-8 mx-4 sm:mx-auto sm:w-full sm:max-w-md">
        <div class="bg-white py-8 px-4 md:py-10 shadow rounded sm:px-10">

            <?php if(isset($_SESSION['flash'])) {
                flash();
            }?>
            <form class="space-y-6 md:m-4" method="POST" action="do_register.php">
                <!-- Login -->
                <div>
                    <label class="block font-medium text-sm text-gray-700" for="username">Email or Username</label>
                    <div class="mt-1">
                        <input id="username" class="appearance-none block w-full px-3 py-2 sm:text-sm border border-gray-300 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-red-500 focus:border-red-500" type="text" name="username" placeholder="Enter your usernamer or email"/>
                    </div>
                </div>

                <!-- Password -->
                <div>
                    <label class="block font-medium text-sm text-gray-700" for="password">Password</label>

                    <div class="mt-1 relative">
                        <input id="password" class="appearance-none block w-full px-3 py-2 sm:text-sm border border-gray-300 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-red-500 focus:border-red-500" type="password" name="password" placeholder="Enter your password"/>
                        <i class="icon-toggler absolute inset-y-1/3 md:top-2.5 right-3 text-gray-500 far fa-eye"></i>
                    </div>
                </div>

                <div class="py-4">
                    <button type="submit" class="w-full flex justify-center py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-red-500 hover:bg-red-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500">Register</button>
                    <p class="text-center text-sm overflow-hidden before:h-[1px] after:h-[1px] after:bg-black after:inline-block after:relative after:align-middle after:w-1/4 before:bg-black before:inline-block before:relative before:align-middle before:w-1/4 before:right-2 after:left-2 p-4">
                        or
                    </p>
                    <a href="login.php" class="w-full flex justify-center py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-blue-500 hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500">Sign In</a>
                </div>
            </form>
        </div>

    </div>
</div>
<script src="https://unpkg.com/flowbite@1.4.7/dist/flowbite.js"></script>
<script>
    const iconToggler = document.querySelector('.icon-toggler');
    const password = document.querySelector('#password');

    if (password.value.length === 0) {
        iconToggler.classList.add('hidden');
    }

    password.addEventListener('input', (event) => {
        if (event.target.value > 0) {
            iconToggler.classList.remove('hidden');
        } else {
            iconToggler.classList.add('hidden');
        }
    });

    iconToggler.addEventListener('click', function () {
        const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
        password.setAttribute('type', type);
        this.classList.toggle('fa-eye-slash');
    });
</script>
</body>
</html>
