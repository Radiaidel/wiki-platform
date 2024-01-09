<?php require APPROOT . '/views/inc/header.php'; ?>

<?php require APPROOT . '/views/inc/messages.php'; ?>

<div class="p-2 md:p-12">

<!-- Display category buttons -->
<div class="flex space-x-4 overflow-x-auto p-2 md:p-10">
    <?php foreach ($data['categories'] as $category): ?>
        <button class="px-4 py-2 rounded-md bg-blue-500 text-white" onclick="filterByCategory('<?php echo $category->category_id; ?>')">
            <?php echo htmlspecialchars($category->category_name); ?>
        </button>
    <?php endforeach; ?>
</div>

    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-8 ">
        <?php foreach ($data['wikis'] as $wiki): ?>
            <div class="cursor-pointer mb-4 p-6 rounded-xl bg-white flex flex-col" data-wiki-id="<?php echo $wiki->wiki_id; ?>" onclick="ToDetailWiki(this)">                                <!-- Author Info -->
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
                action="<?php echo URLROOT; ?>/AuthorController/AddNewWiki">
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
                    </div>

                    <!-- Content -->
                    <div class="mb-4">
                        <label for="content" class="block text-sm font-medium text-gray-600 mb-1">Content:</label>
                        <textarea id="content" name="content" class="p-2 w-full  border rounded-md"></textarea>
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
                    <input type="hidden" id="selectedTagsInput" name="selectedTags" value="" require>
                    <div id="tagsContainer" class=" space-x-3 space-y-2">
                    </div>
                </div>

                <button type="submit" class="w-full text-white bg-gray-500 rounded-full text-sm px-5 py-2.5">Add
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
    });
    function ToDetailWiki(element) {
        // Retrieve the wiki ID from the data attribute
        var wikiId = element.getAttribute('data-wiki-id');
        // Assuming you have the wiki ID, use it to construct the URL
        var wikiUrl = "<?php echo URLROOT . '/WikiController/singleWiki/'; ?>" + wikiId;
        // Redirect to the constructed URL
        window.location.href = wikiUrl;
    }
</script>