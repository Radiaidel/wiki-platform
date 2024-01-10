<?php require APPROOT . '/views/inc/header.php'; ?>

<?php require APPROOT . '/views/inc/messages.php'; ?>

<div class="relative  h-full flex items-center justify-center bg-center py-6 sm:px-6 lg:px-8  items-center">



    <div class="max-w-md w-full space-y-8 p-10 bg-white rounded-xl shadow-lg z-10">
        <div class="grid gap-8 grid-cols-1">
            <!-- Message en haut du formulaire -->
            <div class="flex flex-col items-center">
                <h2 class="font-semibold text-lg text-center">Welcome, enter your details to create an account
                </h2>
            </div>

            <div class="flex flex-col">
                <div class="mt-3">
                    <form class="form" method="POST" action="<?php echo URLROOT; ?>/UserController/register"
                        enctype="multipart/form-data" onsubmit="return validateFormRegister()">
                        <div class="mb-3 space-y-2 w-full text-xs">
                            <div class="flex items-center justify-center">
                                <label for="profilePicture"
                                    class="w-20 h-20 rounded-full cursor-pointer flex items-center justify-center border border-dashed border-gray-500"
                                    id="profilePictureLabel">
                                    <svg width="35px" height="35px" viewBox="0 0 24 24" fill="none" id="plusIcon"
                                        xmlns="http://www.w3.org/2000/svg" stroke="#e9e9e9">

                                        <g id="SVGRepo_bgCarrier" stroke-width="0" />

                                        <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round" />

                                        <g id="SVGRepo_iconCarrier">
                                            <path d="M6 12H18M12 6V18" stroke="#e9e9e9" stroke-width="2"
                                                stroke-linecap="round" stroke-linejoin="round" />
                                        </g>

                                    </svg>
                                </label>
                                <input type="file" id="profilePicture" name="profilePicture" accept="image/*"
                                    class="hidden" onchange="displayImage('profilePictureLabel','profilePicture' )">
                            </div>
                        </div>


                        <div class="mb-3 space-y-2 w-full text-xs">
                            <label class="font-semibold text-gray-600 py-2">Your name</label>
                            <input placeholder="full name"
                                class="appearance-none block w-full bg-grey-lighter text-grey-darker border border-grey-lighter rounded-lg h-10 px-4"
                                required="required" type="text" name="name" id="name">
                            <p class="text-red-500 text-xs hidden" id="nameError">Please enter a valid name with only
                                alphabetical characters and spaces.</p>
                        </div>
                        <div class="mb-3 space-y-2 w-full text-xs">
                            <label class="font-semibold text-gray-600 py-2">Your email</label>
                            <input placeholder="example@gmail.com"
                                class="appearance-none block w-full bg-grey-lighter text-grey-darker border border-grey-lighter rounded-lg h-10 px-4"
                                required="required" type="text" name="email" id="email">
                            <p class="text-red-500 text-xs hidden" id="emailError">Please enter a valid email address.
                            </p>
                        </div>
                        <div class="mb-3 space-y-2 w-full text-xs">
                            <label class="font-semibold text-gray-600 py-2">Your password</label>
                            <input placeholder="***"
                                class="appearance-none block w-full bg-grey-lighter text-grey-darker border border-grey-lighter rounded-lg h-10 px-4"
                                required="required" type="password" name="password" id="password">
                            <p class="text-red-500 text-xs hidden" id="passwordError">Password must be at least 6
                                characters long.</p>
                        </div>

                        <div class="mt-5 text-center">
                            <button type="submit"
                                class="w-3/4 font-semibold text-black border border-2 border-gray-900 hover:bg-gray-800  hover:text-white rounded-full px-5 py-2.5 text-center">
                                Register</button>
                            <p class="mt-4 text-gray-600 text-xs text-center">You already have an account? <a
                                    href="<?php echo URLROOT; ?>/Pages/AuthLogin"
                                    class="text-blue-500 hover:underline">Sign in here</a>.</p>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<?php require APPROOT . '/views/inc/footer.php'; ?>