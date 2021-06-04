// Upload Profile Picture

import { Feedback } from "./feedback/Feedback.js";
import { defaultProperties } from "./files/defaultProperties.js";
import { FileInput } from "./files/FileInput.js";




new FileInput('profile-photo-input', 'profileImage', defaultProperties(['rounded-circle', 'file-input']));

const registerForm = document.querySelector('#pills-tabContent');

const username = registerForm.querySelector('input[name=username]');
const email = registerForm.querySelector('input[name=email]');
const newPassword = registerForm.querySelector('input[name=password]');
const repeatNewPassword = registerForm.querySelector('input[name=repeat-password]');
const name = registerForm.querySelector('input[name=name]');
const country = registerForm.querySelector('select[name=countryId]');

const firstStepButton = document.querySelector('#first-step');
const secondStepButton = document.querySelector('#second-step');

const repeatNewPasswordFeedback = new Feedback(repeatNewPassword.parentElement, "", 3000);

const validatePasswords = () => {
    if (newPassword.value != '' && repeatNewPassword.value != newPassword.value) {
        repeatNewPasswordFeedback.showMessage("The repeated password doesn't match!", "danger");
        return false;
    }
    return true;
}

firstStepButton.addEventListener('click', (e) => {
    let cont = true;
    if (!username.reportValidity()) cont = false;
    if (!email.reportValidity()) cont = false;
    if (!newPassword.reportValidity()) cont = false;
    if (!validatePasswords()) cont = false;
    if (!cont) {
        e.preventDefault();
        e.stopImmediatePropagation();
    }
});

secondStepButton.addEventListener('click', (e) => {
    let cont = true;
    if (!name.reportValidity()) cont = false;
    if (!country.reportValidity()) cont = false;
    if (!cont) {
        e.preventDefault();
        e.stopImmediatePropagation();
    }
});

// Display Progress Stepper after filling first form

firstStepButton.addEventListener('click', function () {
    document.querySelector('div.progress').parentNode.classList.remove('d-none');
    document.getElementById('error-messages').classList.add('d-none');
});
