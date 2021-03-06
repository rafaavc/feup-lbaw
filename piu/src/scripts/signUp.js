// Upload Profile Picture

fileUploadListeners();

function fileUploadListeners() {
    let fileUploads = document.querySelectorAll('.file-input');
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
    let img = event.target.previousElementSibling;
    img.src = URL.createObjectURL(event.target.files[0]);
    img.onload = () => {
        URL.revokeObjectURL(img.src);
    }
}

// Progress Bar

let progressSteps = Array.from(document.querySelectorAll('ul.nav-pills button'));
let progressBar = document.querySelector('div.progress-bar');
let stepWidth = 0;

progressStepsListeners();

function progressStepsListeners() {
    progressSteps.forEach((step) => {
        step.addEventListener('click', progressStepClick.bind(step, stepWidth));
        stepWidth += 100 / (progressSteps.length - 1);
    });
}

function progressStepClick(width) {
    progressBar.style.width = `${width}%`;    
}

let nextStepBtns = Array.from(document.querySelectorAll('button.next-step'));

nextStepBtns.forEach((nextStepBtn) => {
    nextStepBtn.addEventListener('click', nextStepHandler);
});

let nextStepLabels = Array.from(document.querySelectorAll('li.next-step'))

function nextStepHandler(event) {
    let target = event.target;
    let btnIndex = nextStepBtns.indexOf(target);

    for(let i = 0; i <= btnIndex + 1; i++) {
        progressSteps[i].removeAttribute('disabled');
        progressSteps[i].removeAttribute('active');
    }

    nextStepLabels[btnIndex].classList.remove('d-none');
    if(btnIndex + 1 == progressSteps.length - 1)
        nextStepLabels[btnIndex + 1].classList.remove('d-none');

    progressSteps[btnIndex + 1].setAttribute('active', 'true');
    progressSteps[btnIndex + 1].click();
}

// Display Progress Bar after filling first form

document.querySelector('#first-step').addEventListener('click', function() {
    document.querySelector('div.progress').parentNode.classList.remove('d-none');
});