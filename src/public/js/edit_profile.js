import { makeRequest } from './ajax/methods.js'
import { defaultProperties } from './files/defaultProperties.js';
import { FileInput } from './files/FileInput.js';
import { url } from './utils/url.js';
import { Feedback } from './feedback/Feedback.js';


// Delete Profile
document.querySelector('.deleteProfile').addEventListener('click', (e) => e.preventDefault())

document.querySelector('#confirmAccountDeletion').addEventListener('click', () => {
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


const form = document.querySelector('#edit-profile-form');
const newPassword = form.querySelector('input[name=newPassword]');
const repeatNewPassword = form.querySelector('input[name=repeatNewPassword]');
const currentPassword = form.querySelector('input[name=currentPassword]');
const repeatNewPasswordFeedback = new Feedback(repeatNewPassword, "danger", 3000);
const currentPasswordFeedback = new Feedback(currentPassword, "danger", 3000);

const validate = (checkRepeat) => {
    let submit = true;
    if (newPassword.value != '') {
        if (repeatNewPassword.value != newPassword.value) {
            repeatNewPasswordFeedback.showMessage("The repeated password doesn't match!", "danger");
            submit = false;
        }
        if (currentPassword.value == '') {
            currentPasswordFeedback.showMessage("If you want to change the password, you must insert your current password!", "danger");
            submit = false;
        }
    }
    return submit;
}

repeatNewPassword.addEventListener('change', validate);
newPassword.addEventListener('change', validate);

form.addEventListener('submit', (e) => {
    if (!validate()) e.preventDefault();
})

