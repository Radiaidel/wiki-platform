
function dismissMessage() {
    var messageContainer = document.getElementById('MessageContainerId');

    if (messageContainer) {
        messageContainer.style.display = 'none';
    }
}

function validateFormRegister() {
    let isValid = true;

    // Name validation
    let nameInput = document.getElementById('name');
    let nameError = document.getElementById('nameError');
    if (nameInput.value.trim() === '' || !/^[a-zA-Z\s]+$/.test(nameInput.value)) {
        nameError.classList.remove('hidden');
        isValid = false;
    } else {
        nameError.classList.add('hidden');
    }

    // Email validation
    let emailInput = document.getElementById('email');
    let emailError = document.getElementById('emailError');
    let emailPattern = /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/;
    if (!emailPattern.test(emailInput.value)) {
        emailError.classList.remove('hidden');
        isValid = false;
    } else {
        emailError.classList.add('hidden');
    }

    // Password validation
    let passwordInput = document.getElementById('password');
    let passwordError = document.getElementById('passwordError');
    if (passwordInput.value.trim().length < 6) {
        passwordError.classList.remove('hidden');
        isValid = false;
    } else {
        passwordError.classList.add('hidden');
    }

    return isValid;
}


function displayImage(onlabel,inInput) {
    var input = document.getElementById(inInput);
    var label = document.getElementById(onlabel);

    var file = input.files[0];

    if (file) {
        var reader = new FileReader();

        reader.onload = function (e) {
            label.style.backgroundImage = 'url(' + e.target.result + ')';
            label.style.backgroundSize = 'cover';
            label.style.backgroundPosition = 'center';
            label.style.border = 'none';
            document.getElementById('plusIcon').style.display = 'none';

        };

        reader.readAsDataURL(file);
    }
}

function validateFormLogin() {
    let isValid = true;

    // Email validation
    let emailInput = document.getElementById('email');
    let emailError = document.getElementById('emailError');
    let emailPattern = /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/;
    if (!emailPattern.test(emailInput.value)) {
        emailError.classList.remove('hidden');
        isValid = false;
    } else {
        emailError.classList.add('hidden');
    }

    // Password validation
    let passwordInput = document.getElementById('password');
    let passwordError = document.getElementById('passwordError');
    if (passwordInput.value.trim().length < 6) {
        passwordError.classList.remove('hidden');
        isValid = false;
    } else {
        passwordError.classList.add('hidden');
    }

    return isValid;
}

function toggleDropdown() {
    var dropdownContent = document.getElementById('dropdown-content');
    dropdownContent.classList.toggle('hidden');
}
function ShowForm(formname,closeModal){
        document.getElementById(formname).classList.remove('hidden');
        document.getElementById(closeModal).addEventListener('click', () => {
            document.getElementById(formname).classList.add('hidden');
            document.getElementById(formname).reset();
        });
}