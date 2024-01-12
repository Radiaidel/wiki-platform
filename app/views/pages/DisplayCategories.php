<?php require APPROOT . '/views/inc/header.php'; ?>

<div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-3 p-12">
    <?php foreach ($data['categories'] as $category): ?>
        <div class="bg-white p-4 rounded-md shadow-md flex items-center justify-between">
            <div class="flex items-center space-x-4">
                <img class="w-16 h-16" src="<?php echo URLROOT . '/public/' . $category->category_picture; ?>" alt="User" />
                <span class="lg:text-lg font-semibold">
                    <?php echo $category->category_name; ?>
                </span>
            </div>


        </div>
    <?php endforeach; ?>
</div>
<?php require APPROOT . '/views/inc/footer.php'; ?>