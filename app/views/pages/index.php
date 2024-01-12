<?php require APPROOT . '/views/inc/header.php'; ?>

<?php require APPROOT . '/views/inc/messages.php'; ?>


<div class="p-2 md:p-12">
    <div id="searchResults"></div>


    <?php if (empty($data['wikis'])): ?>
        <div class="flex items-center justify-center">
            <p class="text-xl font-semibold text-gray-600">No wikis found.</p>
        </div>
    <?php else: ?>
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-8 ">
            <?php foreach ($data['wikis'] as $wiki): ?>
                <div class="cursor-pointer mb-4 p-6 rounded-xl bg-white flex flex-col"
                    data-wiki-id="<?php echo $wiki->wiki_id; ?>" onclick="ToDetailWiki(this)">
                    <div class="flex pb-4 items-center justify-between">
                        <div class="flex items-center space-x-4">
                            <a href="#" class="inline-block">
                                <img src="<?php echo URLROOT . '/public/' . $wiki->profile_picture; ?>" alt="User"
                                    class="rounded-full w-10 h-10">
                            </a>
                            <div class="flex flex-col">
                                <div class="flex items-center">
                                    <a href="#" class="inline-block text-sm font-bold mr-2">
                                        <?= $wiki->username; ?>
                                    </a>
                                </div>
                                <div class="text-slate-500 dark:text-slate-300 text-xs">
                                    <?= $wiki->created_at; ?>
                                </div>
                            </div>
                        </div>
                        <?php if (isset($_SESSION['user_id']) && $_SESSION['user_role'] == "admin"): ?>

                            <form action="<?php echo URLROOT; ?>/WikiController/ArchiveWiki" method="POST">
                                <input type="hidden" value="<?= $wiki->wiki_id; ?>" name="wikiId">
                                <button type="submit">
                                    <svg width="20px" height="20px" viewBox="0 0 24 24" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">

                                        <g id="SVGRepo_bgCarrier" stroke-width="0" />

                                        <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round" />

                                        <g id="SVGRepo_iconCarrier">
                                            <path fill-rule="evenodd" clip-rule="evenodd"
                                                d="M3.61399 4.21063C3.17804 3.87156 2.54976 3.9501 2.21069 4.38604C1.87162 4.82199 1.95016 5.45027 2.38611 5.78934L4.66386 7.56093C3.78436 8.54531 3.03065 9.68043 2.41854 10.896L2.39686 10.9389C2.30554 11.1189 2.18764 11.3514 2.1349 11.6381C2.09295 11.8661 2.09295 12.1339 2.1349 12.3618C2.18764 12.6485 2.30554 12.881 2.39686 13.0611L2.41854 13.104C4.35823 16.956 7.71985 20 12.0001 20C14.2313 20 16.2129 19.1728 17.8736 17.8352L20.3861 19.7893C20.8221 20.1284 21.4503 20.0499 21.7894 19.6139C22.1285 19.178 22.0499 18.5497 21.614 18.2106L3.61399 4.21063ZM16.2411 16.5654L14.4434 15.1672C13.7676 15.6894 12.9201 16 12.0001 16C9.79092 16 8.00006 14.2091 8.00006 12C8.00006 11.4353 8.11706 10.898 8.32814 10.4109L6.24467 8.79044C5.46659 9.63971 4.77931 10.6547 4.20485 11.7955C4.17614 11.8525 4.15487 11.8948 4.13694 11.9316C4.12114 11.964 4.11132 11.9853 4.10491 12C4.11132 12.0147 4.12114 12.036 4.13694 12.0684C4.15487 12.1052 4.17614 12.1474 4.20485 12.2045C5.9597 15.6894 8.76726 18 12.0001 18C13.5314 18 14.9673 17.4815 16.2411 16.5654ZM10.0187 11.7258C10.0064 11.8154 10.0001 11.907 10.0001 12C10.0001 13.1046 10.8955 14 12.0001 14C12.2667 14 12.5212 13.9478 12.7538 13.8531L10.0187 11.7258Z"
                                                fill="#0F1729" />
                                            <path
                                                d="M10.9506 8.13908L15.9995 12.0661C15.9999 12.0441 16.0001 12.022 16.0001 12C16.0001 9.79085 14.2092 7.99999 12.0001 7.99999C11.6369 7.99999 11.285 8.04838 10.9506 8.13908Z"
                                                fill="#0F1729" />
                                            <path
                                                d="M19.7953 12.2045C19.4494 12.8913 19.0626 13.5326 18.6397 14.1195L20.2175 15.3467C20.7288 14.6456 21.1849 13.8917 21.5816 13.104L21.6033 13.0611C21.6946 12.881 21.8125 12.6485 21.8652 12.3618C21.9072 12.1339 21.9072 11.8661 21.8652 11.6381C21.8125 11.3514 21.6946 11.1189 21.6033 10.9389L21.5816 10.896C19.6419 7.04402 16.2803 3.99998 12.0001 3.99998C10.2848 3.99998 8.71714 4.48881 7.32934 5.32257L9.05854 6.66751C9.98229 6.23476 10.9696 5.99998 12.0001 5.99998C15.2329 5.99998 18.0404 8.31058 19.7953 11.7955C19.824 11.8525 19.8453 11.8948 19.8632 11.9316C19.879 11.964 19.8888 11.9853 19.8952 12C19.8888 12.0147 19.879 12.036 19.8632 12.0684C19.8453 12.1052 19.824 12.1474 19.7953 12.2045Z"
                                                fill="#0F1729" />
                                        </g>

                                    </svg>
                                </button>
                            </form>


                        <?php endif; ?>

                    </div>

                    <!-- Wiki Content -->
                    <h2 class="text-xl font-extrabold text-sm">
                        <?= substr($wiki->title, 0, 70); ?>
                        <?= strlen($wiki->title) > 70 ? '...' : ''; ?>
                    </h2>
                    <div class="py-4 text-sm">
                        <p>
                            <?= substr($wiki->content, 0, 100); ?>
                            <?= strlen($wiki->content) > 100 ? '...' : ''; ?>
                        </p>
                    </div>

                    <!-- Tags -->
                    <?php if (!empty($wiki->tag_names)): ?>
                        <div class="flex space-x-2 text-sm text-gray-500">
                            <?php $tags = explode(',', $wiki->tag_names); ?>
                            <?php foreach ($tags as $tag): ?>
                                <span class="bg-blue-200 text-blue-800 text-sm font-medium me-2 cursor-pointer px-3 py-1 rounded">#
                                    <?= trim($tag); ?>
                                </span>
                            <?php endforeach; ?>
                        </div>
                    <?php endif; ?>
                </div>
            <?php endforeach; ?>

        </div>
    <?php endif; ?>





    <div id="AddWiki" class="hidden fixed inset-0 bg-gray-800 bg-opacity-75 flex items-center justify-center z-50">
        <div class="md:w-1/2 mx-auto p-6 bg-white rounded-2xl shadow-md border">
            <div class="flex justify-end">
                <button id="closeModalBtnwiki" class="text-gray-500 hover:text-gray-300 focus:outline-none">
                    <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                        xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12">
                        </path>
                    </svg>
                </button>
            </div>
            <form id="addWikiForm" method="POST" enctype="multipart/form-data" class="items-center space-y-4 "
                action="<?php echo URLROOT; ?>/WikiController/AddNewWiki">
                <div class="flex flex-col space-y-4 mt-4">
                    <div class="mb-4">
                        <label for="image" class="block text-sm font-medium text-gray-600 mb-1">Image:</label>
                        <input type="file" id="image" name="image" accept="image/*"
                            class="p-2 w-full border rounded-md">
                    </div>

                    <!-- Title -->
                    <div class="mb-4">
                        <label for="title" class="block text-sm font-medium text-gray-600 mb-1">Title:</label>
                        <input type="text" id="title" name="title" class="p-2 w-full border rounded-md">
                        <span id="titleError" class="text-red-500 text-sm"></span>
                    </div>

                    <!-- Content -->
                    <div class="mb-4">
                        <label for="content" class="block text-sm font-medium text-gray-600 mb-1">Content:</label>
                        <textarea id="content" name="content" class="p-2 w-full  border rounded-md"></textarea>
                        <span id="contentError" class="text-red-500 text-sm"></span>
                    </div>

                    <label for="categoryId" class="block text-sm font-medium text-gray-600 mb-1">Select
                        Category:</label>
                    <select id="categoryId" name="categoryId" class="p-2 border border-2 border-gray-600 rounded-md">
                        <?php foreach ($data['categories'] as $category): ?>
                            <option value="<?php echo $category->category_id; ?>">
                                <?php echo htmlspecialchars($category->category_name); ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                    <label for="selectedTags" class="block text-sm font-medium text-gray-600 mb-1">Tag Name:</label>
                    <input type="hidden" id="selectedTagsInput" name="selectedTags" value="">
                    <span id="tagsError" class="text-red-500 text-sm"></span>
                    <div id="tagsContainer" class=" space-x-3 space-y-2">
                    </div>
                </div>

                <button type="submit" class="w-full text-white bg-green-600 rounded-md text-sm px-5 py-2.5">Add
                    wiki</button>
            </form>
        </div>
    </div>





</div>



<script>
    document.addEventListener("DOMContentLoaded", function () {
        var selectedTags = [];

        function updateTags() {
            var categoryId = document.getElementById("categoryId").value;
            var tagsContainer = document.getElementById("tagsContainer");


            tagsContainer.innerHTML = "";


            var tags = <?php echo json_encode($data['categoryTags']); ?>[categoryId];

            if (tags) {
                tags.forEach(function (tag) {
                    var tagButton = document.createElement("button");
                    tagButton.textContent = tag.tag_name;
                    tagButton.type = "button";
                    tagButton.classList.add("bg-blue-200", "text-blue-800", "text-sm", "font-medium", "me-2", "cursor-pointer", "px-3", "py-1", "rounded");
                    tagButton.dataset.tagId = tag.tagId;

                    tagButton.addEventListener("click", function () {
                        this.classList.toggle("bg-blue-500");
                        var index = selectedTags.indexOf(tag.tag_id);
                        if (index === -1) {
                            selectedTags.push(tag.tag_id);
                        } else {
                            selectedTags.splice(index, 1);
                        }
                        selectedTagsInput.value = JSON.stringify(selectedTags);
                    });

                    tagsContainer.appendChild(tagButton);

                });
            }
        }

        updateTags();

        document.getElementById("categoryId").addEventListener("change", function () {
            selectedTags = [];
            updateTags();

        });




        document.getElementById("addWikiForm").addEventListener("submit", function (event) {
            const titleInput = document.getElementById("title");
            const contentInput = document.getElementById("content");
            const selectedTagsInput = document.getElementById("selectedTagsInput");

            const titleValue = titleInput.value.trim();
            const contentValue = contentInput.value.trim();
            const selectedTagsValue = selectedTagsInput.value.trim();

            document.getElementById("titleError").textContent = "";
            document.getElementById("contentError").textContent = "";
            document.getElementById("tagsError").textContent = "";

            if (titleValue.length <= 5) {
                document.getElementById("titleError").textContent = "Le titre doit contenir plus de 5 caractères.";
                event.preventDefault();
            }

            if (contentValue.length <= 5) {
                document.getElementById("contentError").textContent = "Le contenu doit contenir plus de 5 caractères.";
                event.preventDefault();
            }

            if (!selectedTagsValue) {
                document.getElementById("tagsError").textContent = "Veuillez sélectionner au moins un tag.";
                event.preventDefault();
            }
        });


        const searchInput = document.getElementById('searchInput');
        const searchResultsContainer = document.getElementById('searchResults');

        searchInput.addEventListener('input', function () {
            const searchTerm = searchInput.value;

            if (searchTerm.length >= 3) {
                const xhr = new XMLHttpRequest();
                xhr.open('POST', '<?php echo URLROOT; ?>/WikiController/search', true);
                xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');

                xhr.onreadystatechange = function () {
                    if (xhr.readyState === 4 && xhr.status === 200) {
                        searchResultsContainer.innerHTML = xhr.responseText;
                    }
                };

                xhr.send('searchTerm=' + searchTerm);
            } else {
                searchResultsContainer.innerHTML = '';
            }
        });
    });
    function ToDetailWiki(element) {
    var wikiId = element.getAttribute('data-wiki-id');
    var wikiUrl = "<?php echo URLROOT . '/Pages/singleWiki/'; ?>" + wikiId;
    window.location.href = wikiUrl;
}

</script>