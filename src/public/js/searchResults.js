import { makeRequest } from './ajax/methods.js'
import { encodeForAjax } from './ajax/methods.js'
import { getRootUrl } from './utils/getRootUrl.js';

const nextButtons = Array.from(document.querySelectorAll('a.page-link'));
const urlParams = new URLSearchParams(window.location.search);
let searchQuery = urlParams.get('searchQuery') || "";
const itemsPerSelection = 3;

export const registerListeners = () => {
    nextButtons.forEach((nextBtn) => {
        nextBtn.addEventListener('click', (event) => {
        const target = event.target;
        let returnAux;

        if(target.getAttribute('aria-label') == 'Next')
            returnAux = changePageNumber(target.parentElement.previousElementSibling.firstElementChild, 1);
        else if(target.getAttribute('aria-label') == 'Previous')
            returnAux = changePageNumber(target.parentElement.nextElementSibling.firstElementChild, -1);

        if(returnAux.valid) {
            const typeSearch = target.closest('div.row').previousElementSibling.innerHTML.toLowerCase();
            const data = {
                'searchQuery': searchQuery,
                'page': returnAux.page
            };

            console.log("Sending search:", data);
            let requestURL = getRootUrl() + '/api/search/' + typeSearch + '?' + encodeForAjax(data);
            searchRequest(typeSearch, requestURL);
        }
    });
})};

let totalResults = 0;

const searchRequest = (typeSearch, requestURL, incrementTotalResults) => {
    makeRequest(requestURL, 'GET')
    .then((result) => {
        if (result.response.status == 200) {
            const boxContent = document.querySelector('div.' + typeSearch + "-box");

            Array.from(boxContent.querySelectorAll('div.col-lg-1')).forEach((div) => {
                boxContent.removeChild(div);
            });

            let recipes = "";
            result.content.result.reverse().forEach((result) => {
                recipes += `<div class="col-lg-1 col-md-6 w-auto">` + result + `</div>`;
            });

            boxContent.insertAdjacentHTML('afterbegin', recipes);

            if(incrementTotalResults) {
                totalResults += result.content.numResults;
                let pageNum = document.querySelector('a.' + typeSearch + '-page').textContent;
                document.querySelector('a.' + typeSearch + '-page').textContent = pageNum.replace(/Page (\d+) of (\d+)/, 'Page 1 of ' + Math.ceil(result.content.numResults / itemsPerSelection))
            }
            document.querySelector('strong.total-results').textContent = totalResults;
        } else {
            console.log(result.error);
        }
    });
}

const searchResultForm = document.querySelector('form.search-result-form');
searchResultForm.addEventListener('submit', handleSearchSubmit);

handleSearchSubmit();

function handleSearchSubmit(event) {
    totalResults = 0;

    if(event)
        event.preventDefault();

    const data = {
        'searchQuery': (event) ? document.querySelector('input[name=searchQuery]').value : searchQuery,
        'page': 1
    };

    searchQuery = data.searchQuery;

    // Recipes
    searchRequest('recipes', getRootUrl() + '/api/search/recipes?' + encodeForAjax(data), true);
    searchRequest('people', getRootUrl() + '/api/search/people?' + encodeForAjax(data), true);
    searchRequest('categories', getRootUrl() + '/api/search/categories?' + encodeForAjax(data), true);
    searchRequest('groups', getRootUrl() + '/api/search/groups?' + encodeForAjax(data), true);

    document.querySelector('strong.search-result').textContent = data.searchQuery;
}

const changePageNumber = (target, pageNumber) => {
    const pageTxt = target.textContent;
    const match = /Page (\d+) of (\d+)/.exec(pageTxt);
    console.log(match)
    const firstDigit = parseInt(match[1]);
    const secondDigit = parseInt(match[2]);
    if(!(firstDigit + pageNumber >= 1 && firstDigit + pageNumber <= secondDigit))
        return {
            'valid': false
        };

    const finalNumber = firstDigit + pageNumber;
    target.textContent = pageTxt.replace(/Page (\d+)/, 'Page ' + finalNumber);

    return {
        'valid': true,
        'page': finalNumber
    };
};

registerListeners();
