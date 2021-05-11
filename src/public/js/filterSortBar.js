
/*
    THIS CODE IS NOT VERY HANDSOME BUT IT CAN BE REFACTORED IN THE FUTURE
*/

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
        if (input != inp) input.value = inp.value
        updateElementLabel(input)
    }) // make all max inputs match with one another
}));

ratingMinInputs.forEach((inp) => inp.addEventListener('input', () => {
    ratingMinInputs.forEach((input) => {
        if (input != inp) input.value = inp.value
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
        if (input != inp) input.value = inp.value
    }) // make all max inputs match with one another
}));

dateMinInputs.forEach((inp) => inp.addEventListener('input', () => {
    dateMinInputs.forEach((input) => {
        if (input != inp) input.value = inp.value
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
        if (input != inp) input.value = inp.value
        updateElementLabel(input)
    }) // make all max inputs match with one another
}));

durationMinInputs.forEach((inp) => inp.addEventListener('input', () => {
    durationMinInputs.forEach((input) => {
        if (input != inp) input.value = inp.value
        updateElementLabel(input)
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
                checkbox.dispatchEvent(new Event('change'));
            }
        });
    });
});

const clearFilterDuration = document.querySelector('#clearFilterDuration');
const clearFilterDate = document.querySelector('#clearFilterDate');
const clearFilterRating = document.querySelector('#clearFilterRating');

clearFilterDuration.addEventListener('click', () => {
    durationMinInputs.forEach(input => {
        input.value = 0;
        input.dispatchEvent(new Event('input'));
    });
    durationMaxInputs.forEach(input => {
        input.value = input.max;
        input.dispatchEvent(new Event('input'));
    });
});


clearFilterDate.addEventListener('click', () => {
    dateMinInputs.forEach(input => {
        input.value = "";
        input.dispatchEvent(new Event('input'));
    });
    dateMaxInputs.forEach(input => {
        input.value = input.max;
        input.dispatchEvent(new Event('input'));
    });
});

clearFilterRating.addEventListener('click', () => {
    ratingMinInputs.forEach(input => {
        input.value = input.min;
        input.dispatchEvent(new Event('input'));
    });
    ratingMaxInputs.forEach(input => {
        input.value = input.max;
        input.dispatchEvent(new Event('input'));
    });
});
