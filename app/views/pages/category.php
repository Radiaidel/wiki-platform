<?php require APPROOT . '/views/inc/header.php'; ?>

<?php require APPROOT . '/views/inc/messages.php'; ?>




<div class="container mx-auto p-8">
    <div class="text-center mb-8">
        <h1 class="text-3xl font-semibold">Admin Categories</h1>
    </div>

    <div class="text-right mb-6">
        <button onclick="ShowForm('AddCategory','closeModalBtn')"
            class="bg-gray-500  border-2 border-black text-white px-4 py-2 rounded-full hover:bg-gray-700">Add New
            Category</button>
    </div>

    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-8">
        <?php foreach ($data['categories'] as $category): ?>
            <div class="bg-white p-4 rounded-md shadow-md flex items-center justify-between">
                <div class="flex items-center space-x-4">
                    <img class="w-16 h-16" src="<?php echo URLROOT . '/public/' . $category->category_picture; ?>"
                        alt="User" />
                    <span class="lg:text-lg font-semibold">
                        <?php echo $category->category_name; ?>
                    </span>
                </div>

                <div class="flex flex-col justify-center space-y-2">
                    <button type="button" class="editCategory" onclick="GetButton('.editCategory','ShowEditForm')"
                        data-category-id="<?php echo $category->category_id; ?>"
                        data-category-name="<?php echo $category->category_name; ?>"
                        data-category-picture="<?php echo URLROOT . '/public/' . $category->category_picture; ?>">

                        <svg width="20px" height="20px" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"
                            fill="#000000">

                            <g id="SVGRepo_bgCarrier" stroke-width="0" />

                            <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round" />

                            <g id="SVGRepo_iconCarrier">
                                <title />
                                <g id="Complete">
                                    <g id="edit">
                                        <g>
                                            <path d="M20,16v4a2,2,0,0,1-2,2H4a2,2,0,0,1-2-2V6A2,2,0,0,1,4,4H8" fill="none"
                                                stroke="#000000" stroke-linecap="round" stroke-linejoin="round"
                                                stroke-width="2" />
                                            <polygon fill="none" points="12.5 15.8 22 6.2 17.8 2 8.3 11.5 8 16 12.5 15.8"
                                                stroke="#000000" stroke-linecap="round" stroke-linejoin="round"
                                                stroke-width="2" />
                                        </g>
                                    </g>
                                </g>
                            </g>

                        </svg>
                    </button>

                    <form action="<?php echo URLROOT; ?>/AdminController/DeleteCategory" method="post" id="DeleteCategory">
                        <input type="hidden" value="<?php echo $category->category_id; ?>" name="categoryId">
                        <button type="submit" onclick="confirmDelete('DeleteCategory')">
                            <svg width="20px" height="20px" viewBox="0 0 24 24" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M18 6V16.2C18 17.8802 18 18.7202 17.673 19.362C17.3854 19.9265 16.9265 20.3854 16.362 20.673C15.7202 21 14.8802 21 13.2 21H10.8C9.11984 21 8.27976 21 7.63803 20.673C7.07354 20.3854 6.6146 19.9265 6.32698 19.362C6 18.7202 6 17.8802 6 16.2V6M4 6H20M16 6L15.7294 5.18807C15.4671 4.40125 15.3359 4.00784 15.0927 3.71698C14.8779 3.46013 14.6021 3.26132 14.2905 3.13878C13.9376 3 13.523 3 12.6936 3H11.3064C10.477 3 10.0624 3 9.70951 3.13878C9.39792 3.26132 9.12208 3.46013 8.90729 3.71698C8.66405 4.00784 8.53292 4.40125 8.27064 5.18807L8 6"
                                    stroke="#000000" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                            </svg>
                        </button>
                    </form>

                </div>
            </div>
        <?php endforeach; ?>
    </div>




    <div id="AddCategory" class="hidden fixed inset-0 bg-gray-800 bg-opacity-75 flex items-center justify-center z-50">
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
            <form id="addCategoryForm" method="POST" enctype="multipart/form-data" class=" items-center space-y-4"
                action="<?php echo URLROOT; ?>/AdminController/AddNewCategory">
                <div class="flex flex-row space-x-4 mt-4">

                    <label for="categorypicture"
                        class="w-20 h-12 rounded-md cursor-pointer flex items-center justify-center border border-3 border-dashed  border-gray-800"
                        id="categorypic">
                        <svg width="35px" height="35px" viewBox="0 0 24 24" fill="none" id="plusIcon"
                            xmlns="http://www.w3.org/2000/svg" stroke="#e9e9e9">

                            <g id="SVGRepo_bgCarrier" stroke-width="0" />

                            <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round" />

                            <g id="SVGRepo_iconCarrier">
                                <path d="M6 12H18M12 6V18" stroke="#e9e9e9" stroke-width="2" stroke-linecap="round"
                                    stroke-linejoin="round" />
                            </g>

                        </svg>
                    </label>
                    <input type="file" id="categorypicture" name="categorypicture" accept="image/*" class="hidden"
                        onchange="displayImage('categorypic','categorypicture')" required>
                    <!-- Category Name Input -->
                    <input type="text" id="categoryName" name="categoryName" placeholder="category name"
                        class="p-2 w-full border border-2 border-gray-600 rounded-md " required />
                </div>

                <button type="submit" id="addCategoryBtn"
                    class="w-full text-white bg-gray-500 rounded-full text-sm px-5 py-2.5">Add Category</button>
            </form>

        </div>
    </div>


    <div id="EditCategory" class="hidden fixed inset-0 bg-gray-800 bg-opacity-75 flex items-center justify-center z-50">
        <div class="max-w-md mx-auto p-6 bg-white rounded-2xl shadow-md border w-3/5">
            <div class="flex justify-end">
                <button id="closeBtnedit" class="text-gray-500 hover:text-gray-300 focus:outline-none">
                    <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                        xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12">
                        </path>
                    </svg>
                </button>
            </div>
            <form id="EditCategoryForm" method="POST" enctype="multipart/form-data" class="items-center space-y-4"
                action="<?php echo URLROOT; ?>/AdminController/UpdateCategory">
                <div class="flex flex-row space-x-4 mt-4">

                    <label for="Inputcategorypicture"
                        class="w-20 h-12 rounded-md cursor-pointer flex items-center justify-center border border-3 border-dashed  border-gray-800"
                        id="categorypictureedit">
                        <svg width="35px" height="35px" viewBox="0 0 24 24" fill="none" id="PlusIcon"
                            xmlns="http://www.w3.org/2000/svg" stroke="#e9e9e9">

                            <g id="SVGRepo_bgCarrier" stroke-width="0" />

                            <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round" />

                            <g id="SVGRepo_iconCarrier">
                                <path d="M6 12H18M12 6V18" stroke="#e9e9e9" stroke-width="2" stroke-linecap="round"
                                    stroke-linejoin="round" />
                            </g>

                        </svg>
                    </label>

                    <input type="file" id="Inputcategorypicture" name="Inputcategorypicture" accept="image/*" class="hidden"
                        onchange="displayImage('categorypictureedit', 'Inputcategorypicture')" required> 
                    <input type="hidden" name="categoryId" id="categoryId">
                    <input type="text" id="categoryName" name="categoryName" placeholder="category name"
                        class="p-2 w-full border border-2 border-gray-600 rounded-md " required />
                </div>

                <button type="submit"
                    class="w-full text-white bg-gray-500 rounded-full text-sm px-5 py-2.5" >Update Category</button>
            </form>

        </div>
    </div>


</div>

<?php require APPROOT . '/views/inc/footer.php'; ?>