<?php require APPROOT . '/views/inc/header.php'; ?>
<?php require APPROOT . '/views/inc/messages.php'; ?>

<div class="container mx-auto mt-3">
    <div class="max-w-3xl mx-auto md:px-8 md:py-3 p-2 bg-white ">
        <!-- Category Name -->
        <div class="mb-4 text-gray-500">>
            <?= $data['wiki']->category_name; ?>
        </div>
        <!-- Wiki Title -->
        <h1 class="text-3xl font-bold mb-4">
            <?= $data['wiki']->title; ?>
        </h1>

        <!-- Author Info -->
        <div class="flex items-center space-x-4 mb-4">
            <img src="<?= URLROOT . '/public/' . $data['wiki']->profile_picture; ?>" alt="User"
                class="rounded-full w-10 h-10">
            <div class="flex flex-col">
                <div class="flex items-center">
                    <span class="text-sm font-bold">
                        <?= $data['wiki']->username; ?>
                    </span>
                </div>
                <div class="text-slate-500 dark:text-slate-300 text-xs">
                    <?= $data['wiki']->created_at; ?>
                </div>
            </div>
        </div>

        <img src="<?= URLROOT . '/public/' . $data['wiki']->image_wiki; ?>" alt="" class="mb-4 rounded-lg">


        <!-- Tags -->
        <?php if (!empty($data['wiki']->tag_names)): ?>
            <div class="flex space-x-2 text-sm text-gray-500 mb-4">
                <?php $tags = explode(',', $data['wiki']->tag_names); ?>
                <?php foreach ($tags as $tag): ?>
                    <span class="bg-blue-200 text-blue-800 text-sm font-medium me-2 cursor-pointer px-3 py-1 rounded">
                        #
                        <?= trim($tag); ?>
                    </span>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>


        <!-- Wiki Content -->
        <div class="mb-4">
            <p class="text-base">
                <?= $data['wiki']->content; ?>
            </p>
        </div>


    </div>
</div>

<?php require APPROOT . '/views/inc/footer.php'; ?>