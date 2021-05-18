import { makeRequest } from './ajax/methods.js'
import { url } from './utils/url.js';

const searchQueryInput = document.querySelector('input[name=searchUser]');
const searchResultForm = document.querySelector('form.search-users-form');
const nextButtons = [...document.querySelectorAll('a.page-link')];
let searchQuery = "", totalResults = 0;

const registerListeners = () => {
    nextButtons.forEach((nextBtn) => {
        nextBtn.addEventListener('click', (event) => {
        const target = event.target;
        let returnAux;

        if(target.getAttribute('aria-label') == 'Next')
            returnAux = changePageNumber(target.parentElement.previousElementSibling.firstElementChild, 1);
        else if(target.getAttribute('aria-label') == 'Previous')
            returnAux = changePageNumber(target.parentElement.nextElementSibling.firstElementChild, -1);

        if(returnAux.valid) {
            const data = {
                'searchQuery': searchQuery,
                'page': returnAux.page,
            };

            console.log("Sending search:", data);
            let requestURL = url('/api/admin/users');
            searchRequest(requestURL, data);
        }
    });
})};

const searchRequest = (requestURL, query) => {
    makeRequest(requestURL, 'GET', null, query)
        .then((result) => {
            if(result.response.status == 200) {

            }
        });
};

const changePageNumber = (target, pageNumber) => {
    const pageTxt = target.textContent;
    const match = /Page (\d+) of (\d+)/.exec(pageTxt);
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

async function handleSearchSubmit(event) {
    totalResults = 0;

    if (event)
        event.preventDefault();

    const data = {
        'searchQuery': (event) ? searchQueryInput.value : searchQuery,
        'page': 1,
    };

    searchQuery = data.searchQuery;

    searchRequest(url('/api/admin/users'), data);
}

searchResultForm.addEventListener('submit', handleSearchSubmit);

handleSearchSubmit();
registerListeners();
