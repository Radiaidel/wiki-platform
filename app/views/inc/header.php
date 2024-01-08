<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://unpkg.com/tailwindcss@^2/dist/tailwind.min.css" rel="stylesheet">
    <script defer src="<?php echo URLROOT . '/public/js/script.js'; ?>"></script>
    <title>
        <?php echo SITENAME; ?>
    </title>

</head>

<body class="bg-gray-100  h-screen">
    <nav class="bg-gray-900">
        <div class="px-4 mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="flex items-center justify-between h-16">
                <div class="flex items-center">
                    <div class="w-12 h-12">
                        <div class="w-full text-center ">
                            <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/8/80/Wikipedia-logo-v2.svg/1200px-Wikipedia-logo-v2.svg.png"
                                class=" responsive-image" alt="Logo">
                        </div>
                    </div>
                    <div class="relative sm:flex items-center ml-10">
                        <!-- Removed sm:hidden to keep the search bar always visible -->
                        <input type="text" placeholder="Rechercher ..."
                            class="h-10 w-48 sm:w-96 px-4 text-sm text-white placeholder-white bg-gray-700 rounded-full focus:outline-none focus:shadow-none">
                        <svg class="absolute right-3 top-3 h-4 w-4 text-white" xmlns="http://www.w3.org/2000/svg"
                            fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                        </svg>
                    </div>




                </div>
                <div class="flex items-center ml-4 md:ml-6">
                    <div class="relative ml-3">
                        <div class="group inline-block">
                            <button
                                class="flex items-center max-w-xs text-sm text-white rounded-full focus:outline-none focus:shadow-solid"
                                id="user-menu" aria-label="User menu" aria-haspopup="true" onclick="toggleDropdown()">
                                <span class="hidden md:inline-block ml-2 text-white mr-4"><?php echo isset($_SESSION['user_name']) ? $_SESSION['user_name'] : 'Guest'; ?></span>
                                <img  class="w-12 h-12 rounded-full"
                                    src="<?php echo isset($_SESSION['userprofile']) ? URLROOT . '/public/'.$_SESSION["userprofile"]: 'https://upload.wikimedia.org/wikipedia/commons/2/2c/Default_pfp.svg'; ?>"
                                    alt="User" />
                                <svg width="30px" height="30px" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"
                                    fill="#c0c0c0">
                                    <g id="SVGRepo_bgCarrier" stroke-width="0" />
                                    <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round" />
                                    <g id="SVGRepo_iconCarrier">
                                        <g>
                                            <path fill="none" d="M0 0h24v24H0z" />
                                            <path
                                                d="M12 15l-4.243-4.243 1.415-1.414L12 12.172l2.828-2.829 1.415 1.414z" />
                                        </g>
                                    </g>
                                </svg>
                            </button>

                            <!-- Dropdown content -->
                            <div id="dropdown-content"
                                class="hidden group-hover:block absolute right-0 mt-2 w-48 bg-white border border-gray-300 rounded-md shadow-lg z-10">
                                <?php if (isset($_SESSION['user_role']) && $_SESSION['user_role'] == "admin"): ?>
                                    <a href="<?php echo URLROOT; ?>/Pages/dashboard"
                                        class="block hover:bg-gray-100 px-4 py-2 text-sm text-gray-700">Dashboard</a>
                                        <a href="<?php echo URLROOT; ?>/CategoryController/GetAllCategories"
                                        class="block hover:bg-gray-100 px-4 py-2 text-sm text-gray-700">Categories</a>
                                        <a href="<?php echo URLROOT; ?>/AdminController/getCategoriesAndTags"
                                        class="block hover:bg-gray-100 px-4 py-2 text-sm text-gray-700">Tags</a>

                                <a href="<?php echo URLROOT; ?>/Pages/index"
                                    class="block hover:bg-gray-100 px-4 py-2 text-sm text-gray-700">Accueil</a>

                                <?php elseif (isset($_SESSION['user_role']) && $_SESSION['user_role'] == "auteur"): ?>
                                    <a href="#" class="block hover:bg-gray-100 px-4 py-2 text-sm text-gray-700">Add new
                                        wiki</a>
                                    <a href="#" class="block hover:bg-gray-100 px-4 py-2 text-sm text-gray-700">Log out</a>

                                <?php else: ?>
                                    <a href="<?php echo URLROOT; ?>/Pages/AuthLogin"
                                        class="block hover:bg-gray-100 px-4 py-2 text-sm text-gray-700">Login</a>
                                    <a href="<?php echo URLROOT; ?>/Pages/AuthRegister"
                                        class="block hover:bg-gray-100 px-4 py-2 text-sm text-gray-700">Register</a>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </nav>

