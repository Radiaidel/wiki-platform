<?php require APPROOT . '/views/inc/header.php'; ?>

<?php if (isset($_SESSION['message'])): ?>
    <?php
    $messageType = $_SESSION['message']['type'];
    $bgColorClass = $messageType === 'error' ? 'bg-red-100' : 'bg-green-100';
    $borderColorClass = $messageType === 'error' ? 'border-red-400' : 'border-green-400';
    $textColorClass = $messageType === 'error' ? 'text-red-800' : 'text-green-800';
    ?>
    <div class="<?php echo $bgColorClass; ?> border-b <?php echo $borderColorClass; ?> text-sm p-4 flex justify-between mt-1" id="MessageContainerId">
        <div>
            <div class="flex items-center">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd"
                        d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z"
                        clip-rule="evenodd" />
                </svg>
                <p class="<?php echo $textColorClass; ?>">
                    <span class="font-bold">Info:</span>
                    <?php echo $_SESSION['message']['text']; ?>
                </p>
            </div>
        </div>
        <div>
            <svg onclick="dismissMessage()" xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
            </svg>
        </div>
    </div>
    <?php unset($_SESSION['message']); // Clear the message after displaying ?>
<?php endif; ?>

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
                    <form class="form" method="POST" action="<?php echo URLROOT; ?>/UserController/Login"
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