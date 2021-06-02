import { makeRequest } from './ajax/methods.js'
import { url } from './utils/url.js';

const loadMoreRecipesButton = document.querySelector('.load-more-button-feed');
const feedArea = document.querySelector('.feed-area');

const loadOneMoreRecipe = () => {
    makeRequest(url(`api/feed/load_more`), 'GET', {
        html: true,
    })
        .then(res => {
            if (res.response.status != 200) {
                console.error("Error when retrieving more recipes!");
            } else {
                feedArea.insertAdjacentHTML('beforeend', res.content.html);
            }
        })
}

const loadMoreRecipes = () => {
    for (let i = 0; i < 3; i++) {
        loadOneMoreRecipe();
    }
}


if (loadMoreRecipesButton) loadMoreRecipesButton.addEventListener('click', loadMoreRecipes);

