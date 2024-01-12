<?php require APPROOT . '/views/inc/header.php'; ?>

<?php require APPROOT . '/views/inc/messages.php'; ?>

<div class="p-2 md:p-12">

    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-8 ">
        <?php foreach ($data['wikis'] as $wiki): ?>
            <div class="cursor-pointer mb-4 p-6 rounded-xl bg-white flex flex-col">                            
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

                        <?php if (isset($_SESSION['user_id']) && $_SESSION['user_id'] == $wiki->author_id): ?>
                            <div class="flex space-x-2">
                                <button type="button" class="editWiki" onclick="GetButton('.editWiki','ShowEditWikiForm')"
                                    data-wiki-id="<?php echo $wiki->wiki_id; ?>" data-wiki-title="<?php echo $wiki->title; ?>"
                                    data-wiki-content="<?php echo $wiki->content; ?>"
                                    data-wiki-image="<?php echo URLROOT . '/public/' . $wiki->image_wiki; ?>"
                                    data-wiki-category-id="<?php echo $wiki->category_id; ?>"
                                    data-wiki-tags="<?php echo $wiki->tag_names; ?>">

                                    <svg width="20px" height="20px" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"
                                        fill="#000000">


                                        <g id="SVGRepo_bgCarrier" stroke-width="0" />

                                        <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round" />

                                        <g id="SVGRepo_iconCarrier">
                                            <title />
                                            <g id="Complete">
                                                <g id="edit">
                                                    <g>
                                                        <path d="M20,16v4a2,2,0,0,1-2,2H4a2,2,0,0,1-2-2V6A2,2,0,0,1,4,4H8"
                                                            fill="none" stroke="#000000" stroke-linecap="round"
                                                            stroke-linejoin="round" stroke-width="2" />
                                                        <polygon fill="none"
                                                            points="12.5 15.8 22 6.2 17.8 2 8.3 11.5 8 16 12.5 15.8"
                                                            stroke="#000000" stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-width="2" />
                                                    </g>
                                                </g>
                                            </g>
                                        </g>

                                    </svg>
                                </button>

                                <form action="<?php echo URLROOT; ?>/WikiController/DeleteWiki" method="post" id="DeleteWiki">
                                    <input type="hidden" value="<?= $wiki->wiki_id; ?>" name="wikiId">
                                    <button type="submit" onclick="confirmDeleteWiki('DeleteWiki')">
                                        <svg width="22px" height="22px" viewBox="0 0 24 24" fill="none" class="align-middle"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path
                                                d="M18 6V16.2C18 17.8802 18 18.7202 17.673 19.362C17.3854 19.9265 16.9265 20.3854 16.362 20.673C15.7202 21 14.8802 21 13.2 21H10.8C9.11984 21 8.27976 21 7.63803 20.673C7.07354 20.3854 6.6146 19.9265 6.32698 19.362C6 18.7202 6 17.8802 6 16.2V6M4 6H20M16 6L15.7294 5.18807C15.4671 4.40125 15.3359 4.00784 15.0927 3.71698C14.8779 3.46013 14.6021 3.26132 14.2905 3.13878C13.9376 3 13.523 3 12.6936 3H11.3064C10.477 3 10.0624 3 9.70951 3.13878C9.39792 3.26132 9.12208 3.46013 8.90729 3.71698C8.66405 4.00784 8.53292 4.40125 8.27064 5.18807L8 6"
                                                stroke="#000000" stroke-width="2" stroke-linecap="round"
                                                stroke-linejoin="round" />
                                        </svg>
                                    </button>
                                </form>

                            </div>

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



    <div id="EditWiki" class="hidden fixed inset-0 bg-gray-800 bg-opacity-75 flex items-center justify-center z-50">
        <div class="md:w-1/2 mx-auto p-6 bg-white rounded-2xl shadow-md border">
            <div class="flex justify-end">
                <button id="closeBtnEditWiki" class="text-gray-500 hover:text-gray-300 focus:outline-none">
                    <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                        xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12">
                        </path>
                    </svg>
                </button>
            </div>
            <form id="editWikiForm" method="POST" enctype="multipart/form-data" class="items-center space-y-4 "
                action="<?php echo URLROOT; ?>/WikiController/EditWiki">
                <div class="flex flex-col space-y-4 mt-4">
                    <input type="hidden" id="wikiId" name="wikiId" value="">

                    <div class="mb-4">
                        <label for="editImage" class="block text-sm font-medium text-gray-600 mb-1">Image:</label>
                        <input type="file" id="editImage" name="editImage" accept="image/*"
                            class="p-2 w-full border rounded-md">
                    </div>

                    <!-- Title -->
                    <div class="mb-4">
                        <label for="editTitle" class="block text-sm font-medium text-gray-600 mb-1">Title:</label>
                        <input type="text" id="editTitle" name="editTitle" class="p-2 w-full border rounded-md">
                    </div>

                    <!-- Content -->
                    <div class="mb-4">
                        <label for="editContent" class="block text-sm font-medium text-gray-600 mb-1">Content:</label>
                        <textarea id="editContent" name="editContent" class="p-2 w-full  border rounded-md"></textarea>
                    </div>

                    <label for="editCategoryId" class="block text-sm font-medium text-gray-600 mb-1">Select
                        Category:</label>
                    <select id="editCategoryId" name="editCategoryId"
                        class="p-2 border border-2 border-gray-600 rounded-md">
                        <?php foreach ($data['categories'] as $category): ?>
                            <option value="<?php echo $category->category_id; ?>">
                                <?php echo htmlspecialchars($category->category_name); ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                    <label for="editSelectedTags" class="block text-sm font-medium text-gray-600 mb-1">Tag Name:</label>
                    <input type="hidden" id="editSelectedTagsInput" name="editSelectedTags" value="">
                    <div id="editTagsContainer" class=" space-x-3 space-y-2">
                    </div>
                </div>

                <button type="submit" class="w-full text-white bg-green-600 rounded-md text-sm px-5 py-2.5">Edit
                    wiki</button>
            </form>
        </div>
    </div>


</div>



<script>
    document.addEventListener("DOMContentLoaded", function () {

        var editSelectedTags = [];

        function updateTagsForEdit() {
            var categoryId = document.getElementById("editCategoryId").value;
            var tagsContainer = document.getElementById("editTagsContainer");


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
                        var index = editSelectedTags.indexOf(tag.tag_id);
                        if (index === -1) {
                            editSelectedTags.push(tag.tag_id);
                        } else {
                            editSelectedTags.splice(index, 1);
                        }
                        editSelectedTagsInput.value = JSON.stringify(editSelectedTags);
                    });

                    tagsContainer.appendChild(tagButton);

                });
            }
        }

        updateTagsForEdit();
        document.getElementById("editCategoryId").addEventListener("change", function () {
            selectedTags = [];
            updateTagsForEdit();

        });

    });
</script>