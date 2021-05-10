import { makeRequest } from './ajax/methods.js'
import { getFilterBarForm, getFilterBarData } from './utils/getFilterSortBarData.js';
import { url } from './utils/url.js';

const nextButtons = Array.from(document.querySelectorAll('a.page-link'));
let urlParams = null;
const searchQueryInput = document.querySelector('input[name=searchQuery]');
const searchResultForm = document.querySelector('form.search-result-form');
const itemsPerSelection = 3;

let searchQuery = "";

const refreshSearchQuery = () => {
    urlParams = new URLSearchParams(window.location.search);
    searchQuery = urlParams.get('searchQuery') || searchQuery;

    if (searchQuery != "") {
        searchQueryInput.value = searchQuery;
    }
}

refreshSearchQuery();

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
            const typeSearch = target.closest('div.row').previousElementSibling.innerHTML.toLowerCase();
            const data = {
                'searchQuery': searchQuery,
                'page': returnAux.page,
                ...getFilterBarData()
            };

            console.log("Sending search:", data);
            let requestURL = url('/api/search/' + typeSearch);
            searchRequest(typeSearch, requestURL, data);
        }
    });
})};

let totalResults = 0;

const searchRequest = (typeSearch, requestURL, query, incrementTotalResults) => new Promise((resolve, reject) => {
    const lastBreadcrumArg = document.querySelector('li.last-breadcrumb').firstElementChild.innerHTML
    if(lastBreadcrumArg != "Recipe")
        document.querySelector('li.last-breadcrumb').firstElementChild.innerHTML = searchQuery;
    else if(searchQuery != "") {
        document.querySelector('li.last-breadcrumb').classList.remove('last-breadcrumb');
        let li = document.createElement('li');
        li.classList.add('breadcrumb-item');
        li.classList.add('last-breadcrumb');
        let a = document.createElement('a');
        a.innerHTML = searchQuery;
        a.href = "";
        li.appendChild(a);
        document.querySelector('ol.breadcrumb').insertAdjacentElement('beforeend', li);
    }

    makeRequest(requestURL, 'GET', null, query)
        .then((result) => {
            if (result.response.status == 200) {
                const boxContent = document.querySelector('div.' + typeSearch + "-box");

                Array.from(boxContent.querySelectorAll('div.col-lg-1')).forEach((div) => {
                    boxContent.removeChild(div);
                });

                let noResults = boxContent.querySelector('h5.no-results') == null;
                if(result.content.numResults == 0 && noResults) {
                    document.querySelector('nav.' + typeSearch + '-navigation').classList.add('d-none');
                    boxContent.insertAdjacentHTML('afterbegin', `<h5 class="no-results">No results found.</h5>`);
                } else if(result.content.numResults > 0) {
                    if(!noResults)
                        boxContent.removeChild(boxContent.querySelector('h5.no-results'));
                    document.querySelector('nav.' + typeSearch + '-navigation').classList.remove('d-none');

                    let recipes = "";
                    result.content.result.reverse().forEach((result) => {
                        recipes += `<div class="col-lg-1 col-md-6 w-auto">` + result + `</div>`;
                    });

                    boxContent.insertAdjacentHTML('afterbegin', recipes);
                }

                if(incrementTotalResults) {
                    totalResults += result.content.numResults;
                    let pageNum = document.querySelector('a.' + typeSearch + '-page').textContent;
                    document.querySelector('a.' + typeSearch + '-page').textContent = pageNum.replace(/Page (\d+) of (\d+)/, 'Page 1 of ' + Math.ceil(result.content.numResults / itemsPerSelection))
                }
                document.querySelector('strong.total-results').textContent = totalResults;
                resolve();
            } else {
                console.log(result.error);
                reject();
            }
        });
});

async function handleSearchSubmit(event) {
    totalResults = 0;

    if (event)
        event.preventDefault();

    const data = {
        'searchQuery': (event) ? searchQueryInput.value : searchQuery,
        'page': 1,
        ...getFilterBarData()
    };

    searchQuery = data.searchQuery;

    // Recipes
    const promises = [
        searchRequest('recipes', url('/api/search/recipes'), data, true),
        searchRequest('people', url('/api/search/people'), data, true),
        searchRequest('categories', url('/api/search/categories'), data, true)
    ];
    // searchRequest('groups', url('/api/search/groups'), data, true);

    Promise.all(promises)
        .then(() => {
            const url = new URL(window.location);
            url.searchParams.set('searchQuery', searchQuery);
            window.history.pushState({ html: document.body.innerHTML }, document.title, url);
        });

    document.querySelector('strong.search-result').textContent = data.searchQuery;
}

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

searchResultForm.addEventListener('submit', handleSearchSubmit);

handleSearchSubmit();
registerListeners();


/* FILTERS */

const filterBarForm = getFilterBarForm();
const categorySelect = filterBarForm.querySelector('select[name=category]');
const difficultySelect = filterBarForm.querySelector('select[name=difficulty]');


filterBarForm.addEventListener('submit', handleSearchSubmit);
categorySelect.addEventListener('change', handleSearchSubmit);
difficultySelect.addEventListener('change', handleSearchSubmit);

window.onpopstate = function(e) {
    if (e.state){
        document.body.innerHTML = e.state.html;
    }
    refreshSearchQuery();
}
