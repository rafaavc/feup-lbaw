import { makeRequest } from './ajax/methods.js'
import { encodeForAjax } from './ajax/methods.js'
import { getRootUrl } from './utils/getRootUrl.js';

const searchResultForm = document.querySelector('form.search-result-form');

const handleSearchSubmit = (event) => {
    event.preventDefault();
    const data = {
        'searchQuery': document.querySelector('input[name=searchQuery]').value,
    };

    console.log("Sending search:", data);
    let requestURL = getRootUrl() + '/api/search?' + encodeForAjax(data);
    makeRequest(requestURL, 'GET')
        .then((result) => {
            if (result.response.status == 200) {
                document.querySelector('html').innerHTML = result.content.searchResults;
            } else {
                console.log(result.error);
            }
        });
}

searchResultForm.addEventListener('submit', handleSearchSubmit);
