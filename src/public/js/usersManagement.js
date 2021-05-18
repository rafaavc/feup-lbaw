import { makeRequest } from './ajax/methods.js'
import { url } from './utils/url.js';

const searchQueryInput = document.querySelector('input[name=searchUser]');
const searchResultForm = document.querySelector('form.search-users-form');
const nextButtons = [...document.querySelectorAll('a.page-link')];
const itemsPerSelection = 7;
const usersTable = document.querySelector('tbody');
const tableDiv = document.querySelector('table');
const paginationNav = document.querySelector('nav.users-navigation');

let searchQuery = "";

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
                'isAdmin': true
            };

            console.log("Sending search:", data);
            let requestURL = url('/api/search/people');
            searchRequest(requestURL, data, false);
        }
    });
})};

const searchRequest = (requestURL, query, incrementTotalResults) => {
    makeRequest(requestURL, 'GET', null, query)
        .then((result) => {
            if(result.response.status == 200) {
                if(incrementTotalResults) {
                    let pageNum = document.querySelector('a.users-page').textContent;
                    document.querySelector('a.users-page').textContent = pageNum.replace(/Page (\d+) of (\d+)/, 'Page 1 of ' + Math.ceil(result.content.numResults / itemsPerSelection))
                }

                usersTable.innerHTML = '';
                if(result.content.numResults > 0) {
                    if(tableDiv.parentElement.firstChild.nodeName === "H5")
                        tableDiv.parentElement.firstChild.remove();

                    tableDiv.classList.remove('d-none');
                    paginationNav.classList.remove('d-none');

                    let users = "";
                    result.content.result.forEach((result) => {
                        users += result;
                    });

                    usersTable.insertAdjacentHTML('beforeend', users);
                } else if(tableDiv.parentElement.firstChild.nodeName !== "H5") {
                    tableDiv.classList.add('d-none');
                    paginationNav.classList.add('d-none');
                    tableDiv.parentElement.insertAdjacentHTML('afterbegin','<h5 style="text-align: center;">No results found.</h5>')
                }
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
    if (event)
        event.preventDefault();

    const data = {
        'searchQuery': (event) ? searchQueryInput.value : searchQuery,
        'page': 1,
        'isAdmin': true
    };

    searchQuery = data.searchQuery;

    searchRequest(url('/api/search/people'), data, true);
}

searchResultForm.addEventListener('submit', handleSearchSubmit);

handleSearchSubmit();
registerListeners();
