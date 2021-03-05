let aboutText = document.querySelector('a.edit-content-text');
aboutText.addEventListener('click', editTextHandler);

function editTextHandler(event) {
    aboutText.removeEventListener("click", editTextHandler);
    let textBox = document.querySelector('div.edit-content-text');
    textBox.firstChild.remove();
    let textArea = createTextBox();
    let subBtn = createSubmitBtn();
    textBox.appendChild(textArea);
    textBox.appendChild(subBtn);
}

function createTextBox() {
    let div = document.createElement('div');
    div.className = "form-floating";
    let textArea = document.createElement('textarea');
    textArea.className = "form-control";
    textArea.setAttribute('rows', 10);
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

let removeBoxes = document.querySelectorAll('a.remove-box');
removeBoxes.forEach((removeBox) => {
    removeBox.addEventListener('click', removeBoxHandler);
});

function removeBoxHandler(event) {
    let target = event.target;
    target.closest('div.col-lg-2').remove();
}

// Add Person

let addImage = document.querySelector('a.add-content-img');
addImage.addEventListener('click', addImageBoxHandler);

function addImageBoxHandler(event) {
    console.log('Entered');
    let newPerson = document.querySelector("div.col-lg-2").cloneNode(true);
    newPerson.querySelector('input[type="text"]').value = "";
    newPerson.querySelector('img').src="../images/noImage.png";
    let row = document.querySelector('div.img-row');
    row.appendChild(newPerson);
}

// File Upload

let fileUploads = document.querySelectorAll('a.file-input');
fileUploads.forEach((fileUpload) => {
    fileUpload.addEventListener('click', fileUploadHandler);
});

function fileUploadHandler(event) {
    let target = event.target;
    target.nextElementSibling.click();
}

let fileInputs = document.querySelectorAll("input[name='myfile']");
fileInputs.forEach((fileInput) => {
    fileInput.addEventListener('change', fileInputHandler);
})

function fileInputHandler(event) {
    let target = event.target;
    let img = target.closest('div.btn-group').nextElementSibling;
    img.src = URL.createObjectURL(target.files[0]);
    img.onload = () => {
        URL.revokeObjectURL(img.src);
    }
}

// Clear Image 

let fileDeletes = document.querySelectorAll('a.file-delete');
fileDeletes.forEach((fileDelete) => {
    fileDelete.addEventListener('click', fileDeleteHandler);
});

function fileDeleteHandler(event) {
    let target = event.target;
    let img = target.closest('div.btn-group').nextElementSibling;
    img.src = "../images/noImage.png";
}