import { makeRequest } from './ajax/methods.js'
import { url } from './utils/url.js';

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

let usernameRepeated = false, emailRepeated = false;

firstStepButton.addEventListener('click', (e) => {
    let cont = true;
    if (!username.reportValidity()) cont = false;
    if (!email.reportValidity()) cont = false;
    if (!newPassword.reportValidity()) cont = false;
    if (!validatePasswords()) cont = false;
    if (usernameRepeated || emailRepeated) cont = false;
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
    if (document.body.contains(document.getElementById('error-messages')))
        document.getElementById('error-messages').classList.add('d-none');
});

// Client-side Validation (check repeated username)


const signUpValidation = () => {
    let usernameInput = document.querySelector('input[name="username"]');
    let emailInput = document.querySelector('input[name="email"]');

    emailInput.addEventListener('blur', (event) => {
        const email = emailInput.value;
        console.log(email);

        makeRequest(url(`api/validation/email`), 'GET', { email: email })
        .then(res => {
            if (res.response.status != 200) {
                if(!emailRepeated) {
                    emailInput.parentElement.insertAdjacentHTML('afterend', `<p class="email-repeated" style="font-size: 0.9rem; color: red;">Repeated email. Please enter another.</p>`);
                    emailRepeated = true;
                }
            } else if(emailRepeated) {
                document.querySelector('p.email-repeated').remove();
                emailRepeated = false;
            }
        });
    });

    usernameInput.addEventListener('blur', (event) => {
        const username = usernameInput.value;
        console.log(username);

        makeRequest(url(`api/validation/username`), 'GET', { username: username })
        .then(res => {
            if (res.response.status != 200) {
                if(!usernameRepeated) {
                    usernameInput.parentElement.insertAdjacentHTML('afterend', `<p class="username-repeated" style="font-size: 0.9rem; color: red;">Repeated username. Please enter another.</p>`);
                    usernameRepeated = true;
                }
            } else if(usernameRepeated) {
                document.querySelector('p.username-repeated').remove();
                usernameRepeated = false;
            }
        });


    });
};

signUpValidation();
