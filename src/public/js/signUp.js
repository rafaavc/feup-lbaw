import { makeRequest } from './ajax/methods.js'
import { url } from './utils/url.js';

// Upload Profile Picture

import { defaultProperties } from "./files/defaultProperties.js";
import { FileInput } from "./files/FileInput.js";

fileUploadListeners();

function fileUploadListeners() {
    let fileUploads = document.querySelectorAll('.file-input');
    fileUploads.forEach((fileUpload) => {
        fileUpload.addEventListener('click', fileUploadHandler);
    });

    let fileInputs = document.querySelectorAll("input[name='profileImage']");
    fileInputs.forEach((fileInput) => {
        fileInput.addEventListener('change', fileInputHandler);
    })
}

function fileUploadHandler(event) {
    let target = event.target;
    target.nextElementSibling.click();
}

function fileInputHandler(event) {
    let img = event.target.previousElementSibling;
    img.src = URL.createObjectURL(event.target.files[0]);
    img.onload = () => {
        URL.revokeObjectURL(img.src);
    }
}

// Display Progress Stepper after filling first form

document.querySelector('#first-step').addEventListener('click', function () {
    document.querySelector('div.progress').parentNode.classList.remove('d-none');
    if(document.body.contains(document.getElementById('error-messages')))
        document.getElementById('error-messages').classList.add('d-none');
});


new FileInput('profile-photo-input', 'profileImage', defaultProperties(['rounded-circle', 'file-input']));

// Client-side Validation (check repeated username)

let usernameRepeated = false, emailRepeated = false;

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
