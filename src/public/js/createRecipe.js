import { defaultProperties } from './files/defaultProperties.js';
import { FileInput } from './files/FileInput.js'

const addIngredientButton = document.querySelector('#addIngredientButton');
addIngredientButton.addEventListener('click', () => {
    const elem = document.createElement('template');
    elem.innerHTML = addIngredientButton.previousElementSibling.outerHTML;
    addIngredientButton.parentNode.insertBefore(elem.content.firstElementChild, addIngredientButton);
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

const addStepButton = document.querySelector('#addStepButton');
addStepButton.addEventListener('click', () => {

    const elem = document.createElement('template');
    elem.innerHTML = addStepButton.previousElementSibling.outerHTML;

    const header = document.createElement('h5');
    header.classList.add('mb-3');
    stepCounter++;
    header.innerText = 'Step ' + stepCounter;

    addStepButton.parentNode.insertBefore(header, addStepButton);
    addStepButton.parentNode.insertBefore(elem.content.firstElementChild, addStepButton);
})

function registerEventListeners() {
    const ingredientSelects = Array.from(document.querySelectorAll("select#ingredientSelect"));

    ingredientSelects.forEach(ingredientSelect => {
        ingredientSelect.addEventListener('mousedown', (event) => {
            event.preventDefault();
            let target = event.target;
            let searchDiv = target.closest("div.col-lg").nextElementSibling;
            searchDiv.classList.toggle("show-searchBox");
        });
    });

    const ingredientAnchors = Array.from(document.querySelectorAll("a.ingredient"));
    ingredientAnchors.forEach(ingredient => {
        ingredient.addEventListener('click', ingredientSelected);
    });

    const searchBoxTexts = Array.from(document.querySelectorAll("input.searchBox-text"));
    searchBoxTexts.forEach(searchBox => {
        searchBox.addEventListener('keyup', (event) => {
            updateSearchItems(event.target);
        });
    });

    const tagAnchors = Array.from(document.querySelectorAll("a.tag"));
    tagAnchors.forEach(ingredient => {
        ingredient.addEventListener('click', tagSelected);
    });

    const tagSelect = document.querySelector("select#tagSelect");
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
    ingredientOption.value = target.getAttribute("value")
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
    if(checkNotRepeatedTag(event.target.getAttribute("value"), tagList)) {
        let li = document.createElement("li");
        // li.value = event.target.getAttribute("value");
        li.textContent = event.target.textContent;
        let span = document.createElement("span");
        span.classList.add("close");
        span.innerHTML = "&times;";
        li.appendChild(span);
        tagList.append(li);
        let hiddenInput = document.createElement("input");
        hiddenInput.classList.add("d-none");
        hiddenInput.setAttribute("value", event.target.getAttribute("value"));
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
        if(!elem.getAttribute("name").includes("image"))
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

function setInvalidElement(elem) {
    if(elem != null) {
        if(elem.value == "")
            elem.style.borderColor = "red";
        else
            return true;
    }
    return false;
}

/** FILE INPUT */

new FileInput('end-product-photos-input', 'images', defaultProperties, [], { maximum: 5 });

const stepPhotoInputs = document.querySelectorAll('.step-photo-input');

for (const input of stepPhotoInputs)
    new FileInput(input, `steps[${Number(input.dataset.index) - 1}][image]`, defaultProperties, []);
