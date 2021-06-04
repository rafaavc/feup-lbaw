import { defaultProperties } from './files/defaultProperties.js';
import { FileInput } from './files/FileInput.js';
import { getStepRow } from './templates/StepRow.js';


const alreadyHaveListeners = {
    ingredientSelects: [],
    ingredientAnchors: [],
    searchBoxTexts: [],
    tagAnchors: [],
    tagSelect: []
}

const addIngredientButton = document.querySelector('#addIngredientButton');
addIngredientButton.addEventListener('click', () => {
    const elem = document.createElement('template');
    elem.innerHTML = addIngredientButton.previousElementSibling.outerHTML;
    const el = elem.content.firstElementChild;
    const innerHtml = el.innerHTML;
    const id = innerHtml.match(/ingredients\[([0-9]+)\]/)[1];
    el.innerHTML = innerHtml.replace(/ingredients\[[0-9]+\]/g, `ingredients[${Number(id) + 1}]`);
    addIngredientButton.parentNode.insertBefore(el, addIngredientButton);
    registerEventListeners();

    // JS's bug...
    const tagSelect = document.querySelector("select#tagSelect");
    tagSelect.addEventListener('mousedown', (event) => {
        event.preventDefault();
        let target = event.target;
        let searchDiv = target.closest("div.col-lg").nextElementSibling;
        searchDiv.classList.toggle("show-searchBox");
    });
})

let steps = document.querySelectorAll("h5.step-number");
let stepCounter = steps[steps.length - 1].textContent.slice(-1);
registerEventListeners();
removeTagListeners();


let currentStepId = 0;

const createStepPhotoInput = (input, preexistingImages) => {
    new FileInput(input, `steps[${currentStepId}][image]`, defaultProperties(), preexistingImages, null, () => `steps[${currentStepId}][previousImage]`, (fileName) => fileName);
    currentStepId++;
}

const addStepButton = document.querySelector('#addStepButton');
addStepButton.addEventListener('click', () => {


    const header = document.createElement('h5');
    header.classList.add('mb-3');
    stepCounter++;
    header.innerText = 'Step ' + stepCounter;

    addStepButton.parentNode.insertBefore(header, addStepButton);
    addStepButton.insertAdjacentHTML('beforebegin', getStepRow(currentStepId));

    const elem = addStepButton.previousElementSibling;

    const photoInput = elem.querySelector('.step-photo-input');
    createStepPhotoInput(photoInput, []);
})

function registerEventListeners() {
    const ingredientSelects = Array.from(document.querySelectorAll("select.ingredientSelect"));

    ingredientSelects.forEach(ingredientSelect => {
        if (alreadyHaveListeners.ingredientSelects.includes(ingredientSelect)) return;
        alreadyHaveListeners.ingredientSelects.push(ingredientSelect);
        ingredientSelect.addEventListener('mousedown', (event) => {
            event.preventDefault();
            let target = event.target;
            let searchDiv = target.closest("div.col-lg").nextElementSibling;
            searchDiv.classList.toggle("show-searchBox");
        });
    });

    const ingredientAnchors = Array.from(document.querySelectorAll("a.ingredient"));
    ingredientAnchors.forEach(ingredient => {
        if (alreadyHaveListeners.ingredientAnchors.includes(ingredient)) return;
        alreadyHaveListeners.ingredientAnchors.push(ingredient);
        ingredient.addEventListener('click', ingredientSelected);
    });

    const searchBoxTexts = Array.from(document.querySelectorAll("input.searchBox-text"));
    searchBoxTexts.forEach(searchBox => {
        if (alreadyHaveListeners.searchBoxTexts.includes(searchBox)) return;
        alreadyHaveListeners.searchBoxTexts.push(searchBox);
        searchBox.addEventListener('keyup', (event) => {
            updateSearchItems(event.target);
        });
    });

    const tagAnchors = Array.from(document.querySelectorAll("a.tag"));
    tagAnchors.forEach(ingredient => {
        if (alreadyHaveListeners.tagAnchors.includes(ingredient)) return;
        alreadyHaveListeners.tagAnchors.push(ingredient);
        ingredient.addEventListener('click', tagSelected);
    });

    const tagSelect = document.querySelector("select#tagSelect");
    if (alreadyHaveListeners.tagSelect.includes(tagSelect)) return;
    alreadyHaveListeners.tagSelect.push(tagSelect);
    tagSelect.addEventListener('mousedown', (event) => {
        event.preventDefault();
        let target = event.target;
        let searchDiv = target.closest("div.col-lg").nextElementSibling;
        searchDiv.classList.toggle("show-searchBox");
    });
}

function updateSearchItems(target) {
    let filter = target.value.toUpperCase();
    let searchBoxIngredients = target.parentElement.nextElementSibling;
    let ingredients = searchBoxIngredients.getElementsByTagName("a");
    for(let i = 0; i < ingredients.length; i++) {
        let txtValue = ingredients[i].innerText;
        if(txtValue.toUpperCase().indexOf(filter) > -1)
            ingredients[i].style.display = "";
        else
            ingredients[i].style.display = "none";
    }
}

function ingredientSelected(event) {
    let searchInput = updateBox(event.target);
    updateSearchItems(searchInput);
}

function updateBox(target) {
    let parent = target.closest("div.search-div").previousElementSibling;
    let ingredientOption = parent.querySelector("select.form-select option");
    ingredientOption.value = target.dataset.value;
    ingredientOption.innerHTML = target.innerHTML;
    target.closest("div.search-div").classList.toggle("show-searchBox");
    let searchInput = target.parentElement.previousElementSibling.firstElementChild;
    searchInput.value = "";
    return searchInput;
}

function tagSelected(event) {
    let searchInput = updateBox(event.target);
    updateSearchItems(searchInput);
    let tagList = event.target.closest(".row").nextElementSibling.querySelector(".tag-list");
    if(checkNotRepeatedTag(event.target.dataset.value, tagList)) {
        let li = document.createElement("li");
        li.textContent = event.target.textContent;
        let span = document.createElement("span");
        span.classList.add("close");
        span.innerHTML = "&times;";
        li.appendChild(span);
        tagList.append(li);
        let hiddenInput = document.createElement("input");
        hiddenInput.classList.add("d-none");
        hiddenInput.setAttribute("value", event.target.dataset.value);
        hiddenInput.setAttribute("name", "tags[]");
        tagList.appendChild(hiddenInput);


        span.addEventListener("click", function() {
            this.parentElement.parentElement.removeChild(this.parentElement.nextElementSibling);
            this.parentElement.parentElement.removeChild(this.parentElement);
        });
    }
}

function checkNotRepeatedTag(tagId, tagList) {
    let children = Array.from(tagList.children);
    for(let i = 0; i < children.length; i++) {
        if(children[i].getAttribute("value") == tagId)
            return false;
    }

    return true;
}

function removeTagListeners() {
    let closebtns = document.getElementsByClassName("close");
    let i;

    for (i = 0; i < closebtns.length; i++) {
        closebtns[i].addEventListener("click", function() {
            this.parentElement.parentElement.removeChild(this.parentElement.nextElementSibling);
            this.parentElement.parentElement.removeChild(this.parentElement);
        });
    }
}

document.querySelector("a.submit-recipe-form").addEventListener('click', (event) => {
    let valid = true;
    valid &= setInvalidElement(document.querySelector("[name='name']"));
    valid &= setInvalidElement(document.querySelector("[name='category']"));
    valid &= setInvalidElement(document.querySelector("[name='description']"));
    valid &= setInvalidElement(document.querySelector("[name='difficulty']"));
    valid &= setInvalidElement(document.querySelector("[name='servings']"));
    valid &= setInvalidElement(document.querySelector("[name='preparation_time']"));
    valid &= setInvalidElement(document.querySelector("[name='cooking_time']"));
    valid &= setInvalidElement(document.querySelector("[name='additional_time']"));

    if(!setInvalidElement(document.querySelector("[name='tags[]']"))) {
        setInvalidElement(document.querySelector("#tagSelect"));
        valid = false;
    }

    Array.from(document.querySelectorAll("[name^='steps']")).forEach((elem) => {
        if(!elem.getAttribute("name").includes("image") && !elem.getAttribute("name").includes("name"))
            valid &= setInvalidElement(elem);
    });
    Array.from(document.querySelectorAll("[name^='ingredients']")).forEach((elem) => {
        valid &= setInvalidElement(elem);
    });

    if(valid)
        document.querySelector("form.recipe-form").submit();
    else {
        if(!document.body.contains(document.querySelector('div.alert.alert-danger[role=danger]'))) {
            let alert = document.createElement("div");
            alert.classList.add("alert");
            alert.classList.add("alert-danger");
            alert.setAttribute("role", "danger");
            alert.innerHTML = "Empty field(s) detected!";
            document.querySelector("#create-recipe-stepper").prepend(alert, document.querySelector("div.card-body"));
        }
        document.querySelector('div.alert.alert-danger[role=danger]').parentElement.parentElement.scrollIntoView();
    }

});

const removeInvalid = (elem) => elem.classList.remove('invalid');

function setInvalidElement(elem) {
    if(elem != null) {
        elem.removeEventListener('blur', () => removeInvalid(elem));
        elem.addEventListener('blur', () => removeInvalid(elem));
        if(elem.value == "") {
            elem.focus();
            elem.classList.add('invalid');
        }
        else
            return true;
    }
    return false;
}

/** FILE INPUT */

const productPhotos = document.querySelector('#end-product-photos-input');

const preexistingImages = [];
for (const child of productPhotos.children) {
    preexistingImages.push({
        url: child.dataset.url,
        fileName: child.dataset.name
    })
}

productPhotos.innerHTML = '';

new FileInput(productPhotos, 'images', defaultProperties(), preexistingImages, { maximum: 5 });

const stepPhotoInputs = document.querySelectorAll('.step-photo-input');

for (const input of stepPhotoInputs)
{
    const preexistingImages = [];
    for (const child of input.children) {
        preexistingImages.push({
            url: child.dataset.url,
            fileName: child.dataset.name
        });
    }

    currentStepId = Number(input.dataset.index) - 1;
    input.innerHTML = '';

    createStepPhotoInput(input, preexistingImages);
}

const createRecipeForm = document.querySelector('.recipe-form');

const secondStepSubmit = document.querySelector('#second-step-submit');
const firstStepSubmit = document.querySelector('#first-step-submit');

const nameInput = createRecipeForm.querySelector('input[name=name]');
const categoryInput = createRecipeForm.querySelector('select[name=category]');
const descriptionInput = createRecipeForm.querySelector('textarea[name=description]');
const difficultyInput = createRecipeForm.querySelector('select[name=difficulty]');
const servingsInput = createRecipeForm.querySelector('input[name=servings]');


firstStepSubmit.addEventListener('click', (e) => {
    let valid = true;

    valid &= nameInput.reportValidity();
    valid &= categoryInput.reportValidity();
    valid &= descriptionInput.reportValidity();
    valid &= difficultyInput.reportValidity();
    valid &= servingsInput.reportValidity();

    if(!setInvalidElement(document.querySelector("[name='tags[]']"))) {
        setInvalidElement(document.querySelector("#tagSelect"));
        valid = false;
    }

    if (!valid) {
        e.preventDefault();
        e.stopImmediatePropagation();
    }
});



secondStepSubmit.addEventListener('click', (e) => {
    const ingredientQuantityInputs = document.querySelectorAll('.ingredient-quantity');

    let valid = true;

    for (const input of ingredientQuantityInputs)
        valid &= input.reportValidity();

    Array.from(document.querySelectorAll("[name^='ingredients']")).forEach((elem) => {
        valid &= setInvalidElement(elem);
    });

    if (!valid) {
        e.preventDefault();
        e.stopImmediatePropagation();
    }
});


