
/*
    THIS CODE IS NOT VERY HANDSOME BUT IT CAN BE REFACTORED IN THE FUTURE
*/

import { getFilterBarForm, getMobileFilterBar } from "./utils/getFilterSortBarData.js";

const updateInnerTextWithTimeFromMins = (element, minsValue) => {
    const num = Number(minsValue)
    const hours = Math.floor(num / 60)
    const mins = num % 60

    if (hours == 0 && mins == 0) {
        element.innerText = "0min";
        return;
    }
    element.innerText = (hours != 0 ? hours + "h" : "") + (mins != 0 ? mins + "min" : "")
}

const updateElementLabel = (element) => {
    const label = element.previousElementSibling;
    if (element.classList.contains('time-in-mins')) {
        updateInnerTextWithTimeFromMins(label.firstElementChild, element.value)
    } else {
        label.firstElementChild.innerText = element.value
    }
}


const ratingMinInputs = Array.from(document.querySelectorAll('.filter-rating-min-input'));
const ratingMaxInputs = Array.from(document.querySelectorAll('.filter-rating-max-input'));

ratingMaxInputs.forEach((inp) => inp.addEventListener('input', () => {
    ratingMaxInputs.forEach((input) => {
        if (input != inp) {
            input.value = inp.value;
            input.dispatchEvent(new Event('change'));
        }
        updateElementLabel(input)
    }) // make all max inputs match with one another
}));

ratingMinInputs.forEach((inp) => inp.addEventListener('input', () => {
    ratingMinInputs.forEach((input) => {
        if (input != inp) {
            input.value = inp.value;
            input.dispatchEvent(new Event('change'));
        }
        updateElementLabel(input)
    }) // make all min inputs match with one another

    // assuming thath all duration max inputs are synchronized
    if (Number(inp.value) > Number(ratingMaxInputs[0].value)) {
        ratingMaxInputs.forEach((input) => input.previousElementSibling.firstElementChild.innerText = inp.value)
    }
    ratingMaxInputs.forEach((input) => input.min = inp.value);
}));


const dateMinInputs = Array.from(document.querySelectorAll('.filter-date-min-input'));
const dateMaxInputs = Array.from(document.querySelectorAll('.filter-date-max-input'));

dateMaxInputs.forEach((inp) => inp.addEventListener('input', () => {
    dateMaxInputs.forEach((input) => {
        if (input != inp) {
            input.value = inp.value;
            input.dispatchEvent(new Event('change'));
        }
    }) // make all max inputs match with one another
}));

dateMinInputs.forEach((inp) => inp.addEventListener('input', () => {
    dateMinInputs.forEach((input) => {
        if (input != inp) {
            input.value = inp.value;
            input.dispatchEvent(new Event('change'));
        }
    }) // make all min inputs match with one another

    // assuming thath all duration max inputs are synchronized
    if (inp.value > dateMaxInputs[0].value) {
        dateMaxInputs.forEach((input) => input.value = inp.value)
    }
    dateMaxInputs.forEach((input) => input.min = inp.value);
}));


const durationMinInputs = Array.from(document.querySelectorAll('.filter-duration-min-input'));
const durationMaxInputs = Array.from(document.querySelectorAll('.filter-duration-max-input'));

durationMaxInputs.forEach((inp) => inp.addEventListener('input', () => {
    durationMaxInputs.forEach((input) => {
        if (input != inp) {
            input.value = inp.value;
            input.dispatchEvent(new Event('change'));
        }
        updateElementLabel(input)
    }) // make all max inputs match with one another
}));

durationMinInputs.forEach((inp) => inp.addEventListener('input', () => {
    durationMinInputs.forEach((input) => {
        if (input != inp) {
            input.value = inp.value;
            input.dispatchEvent(new Event('change'));
        }
        updateElementLabel(input);
    }) // make all min inputs match with one another

    // assuming thath all duration max inputs are synchronized
    if (Number(inp.value) > Number(durationMaxInputs[0].value)) {
        durationMaxInputs.forEach((input) => updateInnerTextWithTimeFromMins(input.previousElementSibling.firstElementChild, inp.value))
    }
    durationMaxInputs.forEach((input) => input.min = inp.value);
}));


const clearParentsCheckboxes = document.querySelectorAll('.clear-parents-checkboxes');

clearParentsCheckboxes.forEach((button) => {
    button.addEventListener('click', (event) => {
        event.preventDefault();
        const checkboxes = button.parentElement.querySelectorAll('input[type=checkbox]');
        checkboxes.forEach((checkbox) => {
            if (checkbox.checked) {
                checkbox.checked = false;
                checkbox.dispatchEvent(new Event('input'));
                checkbox.dispatchEvent(new Event('change'));
            }
        });
    });
});


const clearFilterDuration = document.querySelectorAll('#clearFilterDuration');
const clearFilterDate = document.querySelectorAll('#clearFilterDate');
const clearFilterRating = document.querySelectorAll('#clearFilterRating');

function addClearEvents(buttons, minInputs, maxInputs, min, max) {
    buttons.forEach(button => button.addEventListener('click', () => {
        minInputs.forEach(input => {
            input.value = min === null ? input.min : min;
            input.dispatchEvent(new Event('input'));
        });
        maxInputs.forEach(input => {
            input.value = max === null ? input.max : max;
            input.dispatchEvent(new Event('input'));
        });
    }));
}

addClearEvents(clearFilterDuration, durationMinInputs, durationMaxInputs, 0, null);
addClearEvents(clearFilterDate, dateMinInputs, dateMaxInputs, "", null);
addClearEvents(clearFilterRating, ratingMinInputs, ratingMaxInputs, null, null);


const categorySelects = document.querySelectorAll('.category-select');
const difficultySelects = document.querySelectorAll('.difficulty-select');

const synchronizeInputs = (inputs) => {
    inputs.forEach(input => {
        input.addEventListener('input', () => {
            inputs.forEach(inp => {
                if (inp != input) {
                    inp.value = input.value;  // synchronizing the selects
                    inp.dispatchEvent(new Event('change'));
                }
            });
        });
    });
}

synchronizeInputs(categorySelects);
synchronizeInputs(difficultySelects);

const synchronizedCheckboxes = document.querySelectorAll('.synchronized-checkbox');

synchronizedCheckboxes.forEach(checkbox => {
    checkbox.addEventListener('input', () => {
        const synchronizedClass = checkbox.dataset.synchronizedClass;
        const synched = document.querySelectorAll(`.${synchronizedClass}`);

        synched.forEach(check => {
            if (check != checkbox) {
                check.checked = checkbox.checked;
                check.dispatchEvent(new Event('change'));
            }
        });
    });
});

getMobileFilterBar().addEventListener('submit', event => {
    event.preventDefault();
    getFilterBarForm().dispatchEvent(new Event('submit'));
});
