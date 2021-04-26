
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
