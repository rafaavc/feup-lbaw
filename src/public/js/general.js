import { makeRequest } from "./ajax/methods.js";

document.body.style.minHeight = window.innerHeight + "px";

window.addEventListener('resize', () => {
    document.body.style.minHeight = window.innerHeight + "px"
    document.body.style.paddingTop = window.getComputedStyle(header).height
});

const tooltips = Array.from(document.querySelectorAll('.has-tooltip'));
tooltips.forEach(elem => new bootstrap.Tooltip(elem, { container: 'body', placement: 'bottom', boundary: 'window', html: true, sanitize: false }));



const header = document.querySelector('body > nav.navbar');
let calculationCounter = 0;
let last = null;

const interval = setInterval(() => {
    calculationCounter++;
    const newHeight = window.getComputedStyle(header).height;
    if (last !== null && newHeight >= last) {
        if (calculationCounter > 10) clearInterval(interval);
        return;
    }
    last = Number.parseFloat(newHeight);
    document.body.style.paddingTop = newHeight;
    console.log(`Updated body top padding (${last}).`);
    if (calculationCounter > 2) clearInterval(interval);
}, 200);  // sometimes there was problems in the calculation


/**
 * Deals with favourite buttons
 */
const favouriteButtons = document.querySelectorAll(".add-to-favourites-recipe-button");
for (const button of favouriteButtons) {
    button.addEventListener('click', function(event) {
        const recipeId = event.target.parentElement.dataset.recipeId || event.target.dataset.recipeId;

        let favouriteState = event.target.parentElement.dataset.favouriteState || event.target.dataset.favouriteState;
        favouriteState = favouriteState == "true";

        const rootUrl = document.body.dataset.rootUrl;

        makeRequest(`${rootUrl}/api/recipe/${recipeId}/favourite`, favouriteState ? 'DELETE' : 'POST')
            .then((result) => {
                if (result.response.status != 200) {
                    console.error("ERROR in favourites", result);
                    return;
                }
                const change = (el) => {
                    if (el.dataset.favouriteState != null) el.dataset.favouriteState = !favouriteState;
                }
                change(event.target.parentElement);
                change(event.target);
            });
    });

}

