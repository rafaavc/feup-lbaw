import { makeRequest } from './ajax/methods.js'
import { url } from './utils/url.js';

let searchQueryInput, searchResultForm, nextButtons, usersTable, tableDiv, paginationNav;
const itemsPerSelection = 7;

let searchQuery = "";

const registerbanButtonListeners = () => {
    let banButtons = [...document.querySelectorAll('button.user-action.user-ban')];

    banButtons.forEach((banBtn) => {
        banBtn.addEventListener('click', (event) => {
            let username = banBtn.closest('tr').firstElementChild.textContent;
            let requestURL = url('/api/user/' + username + '/ban');
            let newBanState = event.target.getAttribute('data-ban');
            let data = {
                ban: newBanState
            };

            makeRequest(requestURL, 'PUT', data);

            if(newBanState == "true") {
                swapBanButtonState(banBtn);
                banBtn.setAttribute('data-ban', 'false');
                banBtn.closest('tr').style.backgroundColor = 'var(--bs-red)';
            }
            else {
                swapBanButtonState(banBtn);
                banBtn.setAttribute('data-ban', 'true');
                banBtn.closest('tr').style.backgroundColor = '';
            }
        });
    });
}

const swapBanButtonState = (banBtn) => {
    banBtn.classList.toggle('btn-warning');
    banBtn.classList.toggle('btn-success');
    banBtn.firstElementChild.classList.toggle('fa-undo');
    banBtn.firstElementChild.classList.toggle('fa-ban');
}

const registerListeners = () => {
    searchQueryInput = document.querySelector('input[name=searchUser]');
    searchResultForm = document.querySelector('form.search-users-form');
    nextButtons = [...document.querySelectorAll('a.page-link')];
    usersTable = document.querySelector('tbody');
    tableDiv = document.querySelector('table');
    paginationNav = document.querySelector('nav.users-navigation');

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

const searchRequest = (requestURL, query, incrementTotalResults) => new Promise((resolve, reject) => {
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

            registerbanButtonListeners();
            resolve();
        });
});

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

    searchRequest(url('/api/search/people'), data, true)
        .then(() => {
            const url = new URL(window.location);
            url.searchParams.set('searchQuery', searchQuery);
            window.history.pushState({ html: document.querySelector('.user-search-page').innerHTML }, document.title, url);
        })
}

registerListeners();
searchResultForm.addEventListener('submit', handleSearchSubmit);
handleSearchSubmit();

window.onpopstate = function(e) {
    if (e.state){
        document.querySelector('.user-search-page').innerHTML = e.state.html;
        let urlParams = new URLSearchParams(window.location.search);
        searchQuery = urlParams.get('searchQuery');
    }

    registerListeners();
    searchResultForm.addEventListener('submit', handleSearchSubmit);
    registerbanButtonListeners();
}
