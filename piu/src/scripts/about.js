document.querySelector('main').style.minHeight = screen.height + "px";
// Text Part

let aboutText = document.querySelector('a.edit-content-text');
aboutText.addEventListener('click', editTextHandler);

function editTextHandler(event) {
    aboutText.removeEventListener("click", editTextHandler);
    let textBox = document.querySelector('div.edit-content-text');
    let textArea = createTextBox();
    let subBtn = createSubmitBtn();
    textBox.firstChild.remove();
    textBox.appendChild(textArea);
    textBox.appendChild(subBtn);
}

function createTextBox() {
    let div = document.createElement('div');
    div.className = "form-floating";
    let textArea = document.createElement('textarea');
    textArea.className = "form-control";
    textArea.setAttribute('rows', 10);
    textArea.value = document.querySelector('div.edit-content-text').firstChild.textContent.trim();
    textArea.style.height = "100%";
    div.appendChild(textArea);
    return div;
}

function createSubmitBtn() {
    let subBtn = document.createElement('button');
    subBtn.classList = ["btn btn-primary mt-3"];
    subBtn.style.float = "right";
    subBtn.textContent = "Submit";
    return subBtn;
}

// Switch views 

let editImages = document.querySelector('a.edit-content-img');
editImages.addEventListener('click', editImagesHandler);

function editImagesHandler() {
    console.log(document.querySelector('div.admin-images-settings'));
    document.querySelector('div.admin-images-settings').classList.remove('d-none');
    document.querySelector('div.user-images-settings').classList.add('d-none');
    document.querySelectorAll('.add-images').forEach((elem) => {
        elem.classList.remove('d-none');
    });
}

// Remove Box

removeBoxListeners();

function removeBoxListeners() {
    let removeBoxes = document.querySelectorAll('a.remove-box');
        removeBoxes.forEach((removeBox) => {
        removeBox.addEventListener('click', removeBoxHandler);
    });
}

function removeBoxHandler(event) {
    let target = event.target;
    target.closest('div.col-lg-2').remove();
}

// Add Person

let addImage = document.querySelector('a.add-content-img');
addImage.addEventListener('click', addImageBoxHandler);

function addImageBoxHandler() {
    let newPerson = document.querySelector("div.col-lg-2").cloneNode(true);
    newPerson.querySelector('input[type="text"]').value = "";
    newPerson.querySelector('img').src="../images/noImage.png";
    let row = document.querySelector('div.img-row');
    row.appendChild(newPerson);

    removeBoxListeners();
    fileUploadListeners();
    clearImageListeners();
}

// File Upload

fileUploadListeners();

function fileUploadListeners() {
    let fileUploads = document.querySelectorAll('a.file-input');
    fileUploads.forEach((fileUpload) => {
        fileUpload.addEventListener('click', fileUploadHandler);
    });

    let fileInputs = document.querySelectorAll("input[name='myfile']");
    fileInputs.forEach((fileInput) => {
        fileInput.addEventListener('change', fileInputHandler);
    })
}

function fileUploadHandler(event) {
    let target = event.target;
    target.nextElementSibling.click();
}

function fileInputHandler(event) {
    let target = event.target;
    let img = target.closest('div.btn-group').nextElementSibling;
    img.src = URL.createObjectURL(target.files[0]);
    img.onload = () => {
        URL.revokeObjectURL(img.src);
    }
}

// Clear Image 

clearImageListeners();

function clearImageListeners() {
    let fileDeletes = document.querySelectorAll('a.file-delete');
    fileDeletes.forEach((fileDelete) => {
        fileDelete.addEventListener('click', fileDeleteHandler);
    });
}

function fileDeleteHandler(event) {
    let target = event.target;
    let img = target.closest('div.btn-group').nextElementSibling;
    img.src = "../images/noImage.png";
}