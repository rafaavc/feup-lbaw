import { makeRequest } from './ajax/methods.js'
import { defaultProperties } from './files/defaultProperties.js';
import { FileInput } from './files/FileInput.js';
import { url } from './utils/url.js';

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


// Delete Profile

document.querySelector('.deleteProfile').addEventListener('click', () => {
    event.preventDefault();
    const urlPath = new URL(window.location.href).pathname;
    const username = /\/.*\/(.*)\/.*/.exec(urlPath)[1];
    let entireURL = window.location.href;
    let regex = new RegExp(`(.*?)user\/${username}\/edit`);
    entireURL = entireURL.replace(regex , "$1logout");
    entireURL += "?message=" + encodeURIComponent("Account successfully deleted!");

    makeRequest(url('api/user/' + username), 'DELETE')
        .then((result) => {
            if (result.response.status == 200) {
                console.log('Deleted profile successfully!');
                window.location.href = entireURL;
            }
        });
});

/** FILE UPLOAD */

const preexistingProfileImages = [];
const profilePictureInput = document.querySelector('#user-profile-image-input');

for (const child of profilePictureInput.children) {
    preexistingProfileImages.push({
        url: child.dataset.url,
        fileName: 'randomName'
    });
}

profilePictureInput.innerHTML = '';

const profileProperties = defaultProperties(['rounded-circle', 'z-depth-2', 'profile-image']);

new FileInput(profilePictureInput, 'profileImage', profileProperties, preexistingProfileImages, null, () => 'previousProfileImage');


const preexistingCoverImages = [];
const coverPictureInput = document.querySelector('#user-cover-image-input');

for (const child of coverPictureInput.children) {
    preexistingCoverImages.push({
        url: child.dataset.url,
        fileName: 'randomName'
    });
}

coverPictureInput.innerHTML = '';

const coverProperties = defaultProperties(['bg-placeholder-img']);

new FileInput(coverPictureInput, 'coverImage', coverProperties, preexistingCoverImages, null, () => 'previousCoverImage');

