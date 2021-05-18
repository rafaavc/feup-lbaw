// File Upload

fileUploadListeners();

function fileUploadListeners() {
    let fileUploads = document.querySelectorAll('a.file-input');
    fileUploads.forEach((fileUpload) => {
        fileUpload.addEventListener('click', fileUploadHandler);
    });

    let fileInputs = document.querySelectorAll("input.myFile");
    fileInputs.forEach((fileInput) => {
        fileInput.addEventListener('change', fileInputHandler);
    })
}

function fileUploadHandler(event) {
    let target = event.target;
    console.log(target);
    target.nextElementSibling.click();
}

function fileInputHandler(event) {
    let target = event.target;
    let img = target.closest('div.row.row-with-image').nextElementSibling;
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
    let img = target.closest('div.row.row-with-image').nextElementSibling;
    img.src = "storage/images/people/no_image.png";
}
