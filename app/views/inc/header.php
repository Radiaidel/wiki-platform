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
                        <input type="text" id="searchInput" placeholder="Rechercher..."
                            class="h-10 w-48 sm:w-96 px-4 text-sm text-white placeholder-white bg-gray-700 rounded-full ">

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
                                <span class="hidden md:inline-block ml-2 text-white mr-4">
                                    <?php echo isset($_SESSION['user_name']) ? $_SESSION['user_name'] : 'Guest'; ?>
                                </span>
                                <img class="w-12 h-12 rounded-full"
                                    src="<?php echo isset($_SESSION['userprofile']) ? URLROOT . '/public/' . $_SESSION["userprofile"] : 'https://upload.wikimedia.org/wikipedia/commons/2/2c/Default_pfp.svg'; ?>"
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
                                    <a href="<?php echo URLROOT; ?>/Pages/getCategorie_sTags"
                                        class="block hover:bg-gray-100 px-4 py-2 text-sm text-gray-700">Tags</a>
                                    <a href="<?php echo URLROOT; ?>/Pages/index"
                                        class="block hover:bg-gray-100 px-4 py-2 text-sm text-gray-700">Accueil</a>
                                    <a href="<?php echo URLROOT; ?>/UserController/LogOut"
                                        class="block hover:bg-gray-100 px-4 py-2 text-sm text-gray-700">Log out</a>


                                <?php elseif (isset($_SESSION['user_role']) && $_SESSION['user_role'] == "auteur"): ?>

                                    <a href="<?php echo URLROOT; ?>/Pages/index"
                                        class="block hover:bg-gray-100 px-4 py-2 text-sm text-gray-700">Accueil</a>
                                    <a href="<?php echo URLROOT; ?>/Pages/PageCategories"
                                        class="block hover:bg-gray-100 px-4 py-2 text-sm text-gray-700">Categories</a>
                                    <a href="<?php echo URLROOT; ?>/Pages/index/addForm"
                                        class="block hover:bg-gray-100 px-4 py-2 text-sm text-gray-700">Add new
                                        wiki</a>
                                    <a href="<?php echo URLROOT; ?>/WikiController/Mywikis"
                                        class="block hover:bg-gray-100 px-4 py-2 text-sm text-gray-700">My
                                        wikis</a>
                                    <a href="<?php echo URLROOT; ?>/UserController/LogOut"
                                        class="block hover:bg-gray-100 px-4 py-2 text-sm text-gray-700">Log out</a>

                                <?php else: ?>
                                    <a href="<?php echo URLROOT; ?>/Pages/index"
                                        class="block hover:bg-gray-100 px-4 py-2 text-sm text-gray-700">Accueil</a>
                                    <a href="<?php echo URLROOT; ?>/Pages/PageCategories"
                                        class="block hover:bg-gray-100 px-4 py-2 text-sm text-gray-700">Categories</a>
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

    <div id="searchResults" class ="p-4 m-auto"></div>
<script>
    document.addEventListener("DOMContentLoaded", function () {
    const searchInput = document.getElementById('searchInput');
    const searchResultsContainer = document.getElementById('searchResults');

    searchInput.addEventListener('input', function () {
        const searchTerm = searchInput.value;
        const context = getContext();
        if (searchTerm.length >= 3) {
            const xhr = new XMLHttpRequest();
            xhr.open('POST', '<?php echo URLROOT; ?>/Pages/search', true);
            xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');

            xhr.onreadystatechange = function () {
                if (xhr.readyState === 4 && xhr.status === 200) {
                    showResults(JSON.parse(xhr.responseText), context);
                }
            };

            xhr.send('searchTerm=' + searchTerm + '&context=' + context);
        } else {
            hideResults();
        }
    });

    function getContext() {
        const currentUrl = window.location.href;
        if (currentUrl.includes("Categories")) {
            return "categories";
        } else if (currentUrl.includes("Tags")) {
            return "tags";
        } else {
            return "accueil";
        }
    }

    function showResults(results, context) {
        searchResultsContainer.innerHTML = ''; // Clear previous results
        if (results.length === 0) {
        // Display a message when there are no search results
        searchResultsContainer.innerHTML = `<div class="text-center text-gray-500 py-4">Aucun résultat trouvé.</div>`;
        return;
    }

        switch (context) {
            case 'categories':
                displayCategories(results);
                break;
            case 'tags':
                displayTags(results);
                break;
            default:
                displayWikis(results);
                break;
        }
    }

    function hideResults() {
        searchResultsContainer.innerHTML = '';
    }

    function displayCategories(categories) {
        const URLROOT = <?php echo json_encode(URLROOT); ?>;

    const html = categories.map(category => `
        <div class="bg-white p-4 rounded-md shadow-md flex items-center justify-between">
            <div class="flex items-center space-x-4">
                <img class="w-16 h-16" src="${URLROOT}/public/${category.category_picture}" alt="User" />
                <span class="lg:text-lg font-semibold">
                    ${category.category_name}
                </span>
            </div>
        </div>
    `).join('');

    searchResultsContainer.innerHTML = `<div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-3 p-12">${html}</div>`;
}

function displayWikis(wikis) {
    const URLROOT = <?php echo json_encode(URLROOT); ?>;

    const html = wikis.map(wiki => `
        <div class="cursor-pointer mb-4 p-6 rounded-xl bg-white flex flex-col" data-wiki-id="${wiki.wiki_id}" onclick="ToDetailWiki(this)">
            <div class="flex pb-4 items-center justify-between">
                <div class="flex items-center space-x-4">
                    <a href="#" class="inline-block">
                        <img src="${URLROOT}/public/${wiki.profile_picture}" alt="User" class="rounded-full w-10 h-10">
                    </a>
                    <div class="flex flex-col">
                        <div class="flex items-center">
                            <a href="#" class="inline-block text-sm font-bold mr-2">
                                ${wiki.username}
                            </a>
                        </div>
                        <div class="text-slate-500 dark:text-slate-300 text-xs">
                            ${wiki.created_at}
                        </div>
                    </div>
                </div>
        
            </div>

            <!-- Wiki Content -->
            <h2 class="text-xl font-extrabold text-sm">
                ${wiki.title.substring(0, 70)}${wiki.title.length > 70 ? '...' : ''}
            </h2>
            <div class="py-4 text-sm">
                <p>
                    ${wiki.content.substring(0, 100)}${wiki.content.length > 100 ? '...' : ''}
                </p>
            </div>

            ${wiki.tag_names ? `
    <div class="flex space-x-2 text-sm text-gray-500">
        ${wiki.tag_names.split(',').map(tag => `
            <span class="bg-blue-200 text-blue-800 text-sm font-medium me-2 cursor-pointer px-3 py-1 rounded">
                #${tag.trim()}
            </span>
        `).join('')}
    </div>
` : ''}
        </div>
    `).join('');

    searchResultsContainer.innerHTML = `<div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-8">${html}</div>`;
}

function displayTags(tags) {
    
    const html = tags.map(tag => `
        <a onclick="ShowTagDetailsForm(this)" class="tagsLabel bg-blue-100 hover:bg-blue-200 text-blue-800 text-sm font-medium me-2 cursor-pointer px-3 py-1 rounded border border-blue-400 items-center justify-center"
            data-tag-id="${tag.tag_id}"
            data-tag-name="${tag.tag_name}"
            data-category-id="${tag.category_id}">
            ${tag.tag_name}
        </a>
    `).join('');

    searchResultsContainer.innerHTML = `<div class="flex flex-row items-center space-x-3 space-y-2">${html}</div>`;
}

});
</script>