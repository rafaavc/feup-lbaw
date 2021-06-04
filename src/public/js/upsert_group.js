import { FileInput } from './files/FileInput.js';
import { defaultProperties } from './files/defaultProperties.js';

/** FILE UPLOAD */

const preexistingProfileImages = [];
const profilePictureInput = document.querySelector('#group-profile-image-input');

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
const coverPictureInput = document.querySelector('#group-cover-image-input');

for (const child of coverPictureInput.children) {
    preexistingCoverImages.push({
        url: child.dataset.url,
        fileName: 'randomName'
    });
}

coverPictureInput.innerHTML = '';

const coverProperties = defaultProperties(['bg-placeholder-img']);

new FileInput(coverPictureInput, 'coverImage', coverProperties, preexistingCoverImages, null, () => 'previousCoverImage');


document.querySelector('.delete-group-button').addEventListener('click', (e) => e.preventDefault());
