
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


function displayImage(onlabel, inInput) {
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
function ShowForm(formname, closeModal) {
    document.getElementById(formname).classList.remove('hidden');
    document.getElementById(closeModal).addEventListener('click', () => {
        document.getElementById(formname).classList.add('hidden');
    });
}

function confirmDelete(formid) {
    var result = confirm("Are you sure you want to delete this category?");

    if (result) {
        document.getElementById(formid).submit();
    } else {
        event.preventDefault();
    }
}

function GetButton(classbtn, functionshow) {
    document.querySelectorAll(classbtn).forEach(button => {
        button.addEventListener('click', function () {
            window[functionshow](button);
        });
    });
}
function ShowEditForm(button) {
    document.getElementById('closeBtnedit').addEventListener('click', () => {
        document.getElementById('EditCategory').classList.add('hidden');
    });

    var editCategoryForm = document.getElementById('EditCategoryForm');
    var overlay = document.getElementById('EditCategory');
    overlay.classList.remove('hidden');

    if (editCategoryForm) {
        editCategoryForm.querySelector('#categoryNameedit').value = button.dataset.categoryName || '';
        editCategoryForm.querySelector('#categoryId').value = button.dataset.categoryId || '';
        var imageUrl = button.dataset.categoryPicture || '';
        displayImageforEdit('categorypictureedit', imageUrl);
        editCategoryForm.classList.remove('hidden');
    }
    
    function displayImageforEdit(labelid,url) {
        const label = document.getElementById(labelid);
        
        label.style.backgroundImage = 'url(' + url + ')';
        label.style.backgroundSize = 'cover';
        label.style.backgroundPosition = 'center';
        label.style.border = 'none';
        document.getElementById('PlusIcon').style.display = 'none';
    }
}


function ShowTagDetailsForm(tagElement) {
    document.getElementById('closeTagDetails').addEventListener('click', () => {
        document.getElementById('TagDetails').classList.add('hidden');
    });

    var TagDetails = document.getElementById('TagDetails');
    TagDetails.classList.remove('hidden');
    var tagId = tagElement.getAttribute('data-tag-id');
    var tagName = tagElement.getAttribute('data-tag-name');
    var categoryId = tagElement.getAttribute('data-category-id');

    document.getElementById('TagForm').querySelector('#categoryId').value = categoryId;
    document.getElementById('TagForm').querySelector('#tagNameedit').value = tagName;
    document.getElementById('TagForm').querySelector('#tagId').value = tagId;

    document.getElementById('TagDetails').classList.remove('hidden');

}

function confirmDeleteWiki(formid) {
    var result = confirm("Are you sure you want to delete this Wiki?");

    if (result) {
        document.getElementById(formid).submit();
    } else {
        event.preventDefault();
    }
}

function ShowEditWikiForm(button) {
    document.getElementById('closeBtnEditWiki').addEventListener('click', () => {
        document.getElementById('EditWiki').classList.add('hidden');
    });

    var editWikiForm = document.getElementById('editWikiForm');
    var overlay = document.getElementById('EditWiki');
    overlay.classList.remove('hidden');

    if (editWikiForm) {
        editWikiForm.querySelector('#editTitle').value = button.dataset.wikiTitle || '';
        editWikiForm.querySelector('#editContent').value = button.dataset.wikiContent || '';
        editWikiForm.querySelector('#wikiId').value = button.dataset.wikiId || '';
        editWikiForm.querySelector('#editCategoryId').value = button.dataset.wikiCategoryId || '';


        displayImageforEdit('editImage', button.dataset.wikiImage);

        // Display tags
        displayTagsForEdit('editSelectedTagsInput', 'editTagsContainer', button.dataset.wikiTags);



        editWikiForm.classList.remove('hidden');
    }

}


function displayImageforEdit(inputId, url) {
    const inputElement = document.getElementById(inputId);
    const urlParts = url.split('/upload/'); 
    const fileName = urlParts.length > 1 ? urlParts[1] : ''; 

    inputElement.previousElementSibling.textContent = fileName; 
    inputElement.value = ''; 
}


function displayTagsForEdit(inputId, containerId, tags) {
    const selectedTagsInput = document.getElementById(inputId);
    const tagsContainer = document.getElementById(containerId);

    let tagsArray = tags.split(',').map(tag => tag.trim());

    tagsContainer.innerHTML = "";

    tagsArray.forEach(function (tag) {
        if (tag) { 
            var tagButton = document.createElement("button");
            tagButton.textContent = tag;
            tagButton.type = "button";
            tagButton.classList.add("bg-blue-200", "text-blue-800", "text-sm", "font-medium", "me-2", "cursor-pointer", "px-3", "py-1", "rounded");

            tagButton.addEventListener("click", function () {
                this.classList.toggle("bg-blue-500");
                if (tagsArray.includes(tag)) {
                    tagsArray = tagsArray.filter(t => t !== tag);
                } else {
                    tagsArray.push(tag);
                }
                selectedTagsInput.value = tagsArray.join(', ');
            });

            tagsContainer.appendChild(tagButton);
        }
    });
}

function validateCategoryName(categoryName) {
    return categoryName.trim() !== '';
}
function validateTagName(tagName) {
    return tagName.trim() !== '';
}
function confirmDeleteTag(formid) {
    var result = confirm("Are you sure you want to delete this tag?");

    if (result) {
        document.getElementById(formid).submit();
    }
    else {
        event.preventDefault();
    }
}



