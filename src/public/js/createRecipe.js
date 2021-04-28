
const addIngredientButton = document.querySelector('#addIngredientButton');
addIngredientButton.addEventListener('click', () => {
    const elem = document.createElement('template');
    elem.innerHTML = addIngredientButton.previousElementSibling.outerHTML;
    addIngredientButton.parentNode.insertBefore(elem.content.firstElementChild, addIngredientButton);
    registerEventListeners();
})

let stepCounter = 1;
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
    let li = document.createElement("li");
    console.log(searchInput);
    li.value = event.target.getAttribute("value");
    li.textContent = event.target.textContent;
    let span = document.createElement("span");
    span.classList.add("close");
    span.innerHTML = "&times;";
    li.appendChild(span);
    tagList.append(li);
    removeTagListeners();
}

function removeTagListeners() {
    let closebtns = document.getElementsByClassName("close");
    let i;

    for (i = 0; i < closebtns.length; i++) {
        closebtns[i].addEventListener("click", function() {
            this.parentElement.style.display = 'none';
        });
    }
}


