<?php require APPROOT . '/views/inc/header.php'; ?>

<?php require APPROOT . '/views/inc/messages.php'; ?>

<div class="relative  h-full flex items-center justify-center bg-center py-6 sm:px-6 lg:px-8  items-center">



    <div class="max-w-md w-full space-y-8 p-10 bg-white rounded-xl shadow-lg z-10">
        <div class="grid gap-8 grid-cols-1">
            <div class="flex flex-col my-auto">
                <div class="flex flex-col sm:flex-row items-center">
                    <h2 class="font-semibold text-lg mr-auto text-center">Hey,<br>Enter your details to sign into your
                        account</h2>
                    <div class="w-full sm:w-auto sm:ml-auto mt-3 sm:mt-0"></div>
                </div>
                <div class="mt-5">
                    <form class="form" method="POST" action="<?php echo URLROOT; ?>/UserController/login"
                        onsubmit="return validateFormLogin()">
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
                                Get started</button>
                            <p class="mt-4 text-gray-600 text-xs text-center">Don't have an account? <a
                                    href="<?php echo URLROOT; ?>/Pages/AuthRegister"
                                    class="text-blue-500 hover:underline">Sign up here</a>.</p>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<?php require APPROOT . '/views/inc/footer.php'; ?>