<?php
require_once __DIR__.'/boot.php';

$user = null;

if (check_auth()) {
    // Get user by saved ID
    $stmt = pdo()->prepare("SELECT * FROM `users` WHERE `id` = :id");
    $stmt->execute(['id' => $_SESSION['user_id']]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);
}

// List all films
$films = [];
$stmt = pdo()->prepare("SELECT * FROM `movies`");
$stmt->execute();
$films = $stmt->fetchAll(PDO::FETCH_ASSOC);

// List films as search query
if(isset($_GET['search']))  {
    $search = $_GET['search'];
    $stmt = pdo()->prepare("SELECT * FROM `movies` where title like '%$search%' or stars like '%$search%'");
    $stmt->execute();
    $films = $stmt->fetchAll(PDO::FETCH_ASSOC);
}

// List sorted films
if(isset($_GET['sort'])) {
    $search = $_GET['sort'];
    $stmt = pdo()->prepare("SELECT * FROM `movies` ORDER BY `title` $search");
    $stmt->execute();
    $films = $stmt->fetchAll(PDO::FETCH_ASSOC);
}
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/main.css">
    <title>Main</title>
</head>
<body>
    <?php if ($user) { ?>
        <main class="min-h-screen w-full bg-gray-100 p-4">
            <div class="md:mx-2 p-4 bg-white shadow-sm rounded-lg border-b border-gray-200 flex flex-wrap sm:flex-no-wrap justify-between items-center">
                <h1 class="font-bold text-xl md:text-2xl">Hello, <?= htmlspecialchars($user['username']) ?></h1>
                <form method="post" action="do_logout.php">
                    <button type="submit" class="bg-transparent hover:bg-blue-500 text-blue-700 font-semibold hover:text-white py-2 px-4 border border-blue-500 hover:border-transparent rounded">Logout</button>
                </form>
            </div>
            <?php if(isset($_SESSION['flash'])) {
                flash();
            }?>
            <div class="md:mx-2 my-4 col-span-12 flex flex-wrap sm:flex-no-wrap justify-between items-center">
                <div class="flex flex-wrap sm:flex-no-wrap">
                    <button class="w-full uppercase md:w-40 md:mr-4 lg:w-48 mb-4 md:mb-0 flex justify-center p-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-red-500 hover:bg-red-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500" type="button" data-modal-toggle="defaultModal">
                        Add new film
                    </button>
                    <!-- Main modal -->
                    <div id="defaultModal" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 w-full md:inset-0 h-modal md:h-full">
                        <div class="relative p-4 w-full max-w-2xl h-full md:h-auto">
                            <!-- Modal content -->
                            <div class="relative bg-white rounded-lg shadow">
                                <!-- Modal header -->
                                <div class="flex justify-between items-start p-4 rounded-t border-b">
                                    <h3 class="text-xl text-center font-semibold text-gray-900">
                                        Create Film
                                    </h3>
                                    <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center" data-modal-toggle="defaultModal">
                                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                                    </button>
                                </div>
                                <!-- Modal body -->
                                <div class="p-6 space-y-6">
                                    <form action="create.php" method="POST" class="space-y-4">
                                        <div>
                                            <label class="block font-medium text-sm text-gray-700" for="title">Title</label>
                                            <input name="title" type="text" id="title"
                                                   class="appearance-none block w-full px-3 py-2 sm:text-sm placeholder:italic
                                                    border border-gray-300 rounded-md shadow-sm placeholder-gray-400
                                                    focus:outline-none focus:ring-red-500 focus:border-red-500"/>
                                        </div>
                                        <div>
                                            <label class="block font-medium text-sm text-gray-700" for="year">Release Year</label>
                                            <input name="year" type="number" id="year" min="1900" max="2022"
                                                   class="appearance-none block w-full px-3 py-2 sm:text-sm placeholder:italic
                                                    border border-gray-300 rounded-md shadow-sm placeholder-gray-400
                                                    focus:outline-none focus:ring-red-500 focus:border-red-500"/>
                                        </div>
                                        <div>
                                            <label class="block font-medium text-sm text-gray-700" for="format">Format</label>
                                            <select id="format" name="format" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-red-500 focus:border-red-500 block w-full p-2.5">
                                                <option selected>Choose a format</option>
                                                <option value="vhs">VHS</option>
                                                <option value="dvd">DVD</option>
                                                <option value="bd">Blu-Ray</option>
                                            </select>
                                        </div>
                                        <div>
                                            <label class="block font-medium text-sm text-gray-700" for="actors">Stars</label>
                                            <textarea style="resize: none;" name="stars" id="actors" rows="5" class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-red-500 focus:border-red-500" placeholder="Enter actors and actress separated by comma..."></textarea>
                                        </div>
                                        <!-- Modal footer -->
                                        <div class="flex items-center pt-5 space-x-2 rounded-b border-t border-gray-200">
                                            <button name="submit" type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center">Save</button>
                                            <button data-modal-toggle="defaultModal" type="button" class="text-gray-500 bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-blue-300 rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5 hover:text-gray-900 focus:z-10">Cancel</button>
                                        </div>
                                    </form>
                                </div>

                            </div>
                        </div>
                    </div>
                    <form action="upload.php" method="POST" enctype="multipart/form-data" class="w-full md:w-48">
                        <label class="relative cursor-pointer w-full uppercase md:w-40 md:mr-4 lg:w-48 flex justify-center p-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-green-500 hover:bg-green-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500" for="file_input">Import Data from file</label>
                        <input class="absolute" name="file_input" id="file_input" type="file" accept="text/plain" onchange="this.form.submit()" style="opacity: 0">
                    </form>
                </div>

                <form method="GET" role="search" action="index.php" class="w-full md:w-1/3 lg:w-80">
                    <div class="relative mt-4 md:mt-0">
                        <label class="block font-medium text-sm text-gray-700" for="search"></label>
                        <input name="search" type="text" id="search"
                                 class="appearance-none block w-full px-3 py-2 sm:text-sm placeholder:italic
                                    border border-gray-300 rounded-md shadow-sm placeholder-gray-400
                                    focus:outline-none focus:ring-red-500 focus:border-red-500"
                                 placeholder="Search..."/>
                        <button type="submit" class="absolute inset-y-1/3 md:top-2.5 right-3 text-gray-500 fa-solid fa-magnifying-glass"></button>
                    </div>
                </form>
            </div>

            <div class="md:mx-2 my-4 col-span-12 overflow-auto">
                <?php if (empty($films)) { ?>
                    <div class="p-4 bg-white shadow-sm rounded-lg border-b border-gray-200">
                        <h2 class="font-bold text-xl">'No items found</h2>
                    </div>
                <?php } else { ?>
                    <table class="table-report table-auto border-separate lg:-mt-2 w-full text-left">
                        <thead>
                        <tr class="uppercase">
                            <th class="whitespace-nowrap">Id</th>
                            <th class="whitespace-nowrap flex">Title
                                <form class="mx-4" id="sort" action="index.php" method="GET">
                                    <input id="sort_type" type="hidden" value="" name="sort">
                                    <a class="mx-2" href="javascript:void(0)" onclick="document.getElementById('sort_type').value = 'ASC'; document.getElementById('sort').submit()" >
                                        <i class="icon fa-solid fa-arrow-down-a-z"></i>
                                    </a>
                                    <a href="javascript:void(0)" onclick="document.getElementById('sort_type').value = 'DESC'; document.getElementById('sort').submit()">
                                        <i class="icon fa-solid fa-arrow-down-z-a"></i>
                                    </a>
                                </form>
                            </th>
                            <th class="whitespace-nowrap">Release Year</th>
                            <th class="whitespace-nowrap">Stars</th>
                            <th class="whitespace-nowrap">Actions</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php foreach ($films as $film) { ?>
                            <tr class="relative">
                                <td class="w-12"><?php echo $film['id'] ?></td>
                                <td><?php echo $film['title'] ?></td>
                                <td class="w-20"><?php echo $film['year'] ?></td>
                                <td><?php echo unserialize($film['stars']) ?></td>
                                <td>
                                    <form id="delete-<?= $film['id']?>" action="delete.php" method="POST">
                                        <input name="delete_id" type="hidden" value="<?= $film['id']?>">
                                        <a role="button" class="flex items-center text-red-600 hover:text-red-800" href="javascript:void(0)" data-modal-toggle="popup-modal-<?= $film['id']?>">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                                 fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"
                                                 stroke-linejoin="round" class="feather feather-trash-2 w-4 h-4 mr-1">
                                                <polyline points="3 6 5 6 21 6"></polyline>
                                                <path
                                                        d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path>
                                                <line x1="10" y1="11" x2="10" y2="17"></line>
                                                <line x1="14" y1="11" x2="14" y2="17"></line>
                                            </svg> Delete
                                        </a>
                                        <div id="popup-modal-<?= $film['id']?>" tabindex="-1" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 md:inset-0 h-modal md:h-full">
                                            <div class="relative p-4 w-full max-w-md h-full md:h-auto">
                                                <div class="relative bg-white rounded-lg shadow">
                                                    <button type="button" class="absolute top-3 right-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center" data-modal-toggle="popup-modal-<?= $film['id']?>">
                                                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                                                    </button>
                                                    <div class="p-6 text-center">
                                                        <svg class="mx-auto mb-4 w-14 h-14 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                                        <h3 class="mb-5 text-lg font-normal text-gray-500">Are you sure you want to delete this item?</h3>
                                                        <button data-modal-toggle="popup-modal-<?= $film['id']?>" type="submit" name="delete" class="text-white bg-red-600 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm inline-flex items-center px-5 py-2.5 text-center mr-2">
                                                            Yes, I'm sure
                                                        </button>
                                                        <button data-modal-toggle="popup-modal-<?= $film['id']?>" type="button" class="text-gray-500 bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-gray-200 rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5 hover:text-gray-900 focus:z-10">No, cancel</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </td>
                            </tr>
                        <?php } ?>
                        </tbody>
                    </table>
                <?php } ?>
            </div>
        </main>
    <?php } else {
        header('Location: login.php');
    } ?>
    <script src="https://unpkg.com/flowbite@1.4.7/dist/flowbite.js"></script>
</body>
</html>
