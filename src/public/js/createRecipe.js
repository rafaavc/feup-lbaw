
const addIngredientButton = document.querySelector('#addIngredientButton');
addIngredientButton.addEventListener('click', () => {
    const elem = document.createElement('template');
    elem.innerHTML = addIngredientButton.previousElementSibling.outerHTML;
    addIngredientButton.parentNode.insertBefore(elem.content.firstElementChild, addIngredientButton);
})

let stepCounter = 1;

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
    searchBox.addEventListener('keyup', updateIngredients);
});

function updateIngredients(event) {
    let target = event.target;
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
    let target = event.target;
    let parent = target.closest("div.search-div").previousElementSibling;
    let ingredientOption = parent.querySelector("select.form-select option");
    ingredientOption.value = target.value;
    ingredientOption.innerHTML = target.innerHTML;
    target.closest("div.search-div").classList.toggle("show-searchBox");
    target.parentElement.previousElementSibling.firstElementChild.value = "";
}
