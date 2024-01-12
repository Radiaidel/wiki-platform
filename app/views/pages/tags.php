<?php require APPROOT . '/views/inc/header.php'; ?>

<?php require APPROOT . '/views/inc/messages.php'; ?>
<div class="container mx-auto p-8">
    <div class="text-right mb-6">
        <button onclick="ShowForm('AddTag','closeModalBtn')" class="bg-green-600 text-white px-4 py-2 rounded-md ">Add
            New
            Tag</button>
    </div>
    <div class="grid grid-cols-1 md:grid-cols-3 gap-4 p-4">
        <?php
        foreach ($data['Tagcategories']['categories'] as $categoryName => $categoryData) {
            ?>
            <div class="border border-blue-300 p-4 rounded">
                <h2 class="text-xl font-bold mb-4 text-center">
                    <?php echo htmlspecialchars($categoryName); ?>
                </h2>
                <div class="flex space-x-3 space-y-2  items-center">
                 <?php
                    foreach ($categoryData['tags'] as $tag) {
                        ?>
                        <a onclick="ShowTagDetailsForm(this)" class="tagsLabel bg-blue-100 hover:bg-blue-200 text-blue-800 text-sm font-medium me-2 cursor-pointer px-3 py-1
                            rounded border border-blue-400 inline-flex items-center justify-center"
                            data-tag-id="<?php echo $tag->tag_id; ?>"
                            data-tag-name="<?php echo htmlspecialchars($tag->tag_name); ?>"
                            data-category-id="<?php echo $tag->category_id; ?>">
                            <?php echo htmlspecialchars($tag->tag_name); ?>
                        </a>
                        <?php
                    }
                    ?>
                </div>
            </div>
            <?php
        }
        ?>

    </div>




    <div id="AddTag" class="hidden fixed inset-0 bg-gray-800 bg-opacity-75 flex items-center justify-center z-50">
        <div class="max-w-md mx-auto p-6 bg-white rounded-2xl shadow-md border w-3/5">
            <div class="flex justify-end">
                <button id="closeModalBtn" class="text-gray-500 hover:text-gray-300 focus:outline-none">
                    <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                        xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12">
                        </path>
                    </svg>
                </button>
            </div>
            <form id="addTagForm" method="POST" enctype="multipart/form-data" class="items-center space-y-4"
                action="<?php echo URLROOT; ?>/TagController/AddNewTag">
                <div class="flex flex-col space-y-4 mt-4">

                    <label for="categoryId" class="text-gray-600">Select Category:</label>
                    <select id="categoryId²" name="categoryId" class="p-2 border border-2 border-gray-600 rounded-md">
                        <?php foreach ($data['Tagcategories']['categories'] as $categoryName => $categoryData): ?>
                            <option value="<?php echo $categoryData['category_id']; ?>">
                                <?php echo htmlspecialchars($categoryName); ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                    <label for="tagName" class="text-gray-600">Tag Name:</label>
                    <input type="text" id="tagName" name="tagName" placeholder="Tag Name"
                        class="p-2 border border-2 border-gray-600 rounded-md " />
                </div>

                <button type="submit" class="w-full text-white bg-green-600 rounded-md text-sm px-5 py-2.5">Add
                    Tag</button>
            </form>
        </div>
    </div>



    <div id="TagDetails" class="hidden fixed inset-0 bg-gray-800 bg-opacity-75 flex items-center justify-center z-50">
        <div class="max-w-md mx-auto p-6 bg-white rounded-2xl shadow-md border w-3/5">
            <div class="flex justify-end">
                <button id="closeTagDetails" class="text-gray-500 hover:text-gray-300 focus:outline-none">
                    <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                        xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12">
                        </path>
                    </svg>
                </button>
            </div>
            <form id="TagForm" method="POST" enctype="multipart/form-data" class="items-center space-y-4"
                action="<?php echo URLROOT; ?>/TagController/UD_Tag">
                <div class="flex flex-col space-y-4 mt-4">

                    <label for="categoryId" class="text-gray-600">Select Category:</label>
                    <select id="categoryId" name="categoryId" class="p-2 border border-2 border-gray-600 rounded-md">
                        <?php foreach ($data['Tagcategories']['categories'] as $categoryName => $categoryData): ?>
                            <option value="<?php echo $categoryData['category_id']; ?>">
                                <?php echo htmlspecialchars($categoryName); ?>
                            </option>
                        <?php endforeach; ?>
                    </select>

                    <input type="hidden" id="tagId" name="tagId" value="">
                    <label for="tagNameedit" class="text-gray-600">Tag Name:</label>
                    <input type="text" id="tagNameedit" name="tagName" placeholder="Tag Name"
                        class="p-2 border border-2 border-gray-600 rounded-md " required />
                </div>
                <div class="flex space-x-3">

                    <button type="submit" name="updatetagbtn"
                        class="w-full text-white bg-green-600 rounded-md text-sm px-5 py-2.5">Update Tag</button>
                    <button type="submit" name="deletetagbtn" onclick="confirmDeleteTag('TagForm')"
                        class="w-full text-white bg-green-600 rounded-md text-sm px-5 py-2.5">Delete Tag</button>
                </div>
            </form>
        </div>
    </div>

    <script>
        document.getElementById('addTagForm').addEventListener('submit', function (event) {
            const tagName = document.getElementById('tagName').value;

            if (!validateTagName(tagName)) {
                alert('Veuillez entrer un nom de tag valide.');
                event.preventDefault();
            }
        });

        document.getElementById('TagForm').addEventListener('submit', function (event) {
            const tagName = document.getElementById('tagNameedit').value;

            if (!validateTagName(tagName)) {
                alert('Veuillez entrer un nom de tag valide.');
                event.preventDefault();
            }
        });

    </script>
</div>

<?php require APPROOT . '/views/inc/footer.php'; ?>