function encodeForAjax(data) {
    return Object.keys(data).map(function(k){
        return encodeURIComponent(k) + '=' + encodeURIComponent(data[k])
    }).join('&')
}

export const makeRequest = (requestUrl, method, body) => new Promise((resolve) => {
    const requestBody = { ...body, _token: document.body.dataset.csrfToken };

    fetch(requestUrl, {
        method,
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded',
            'X-CSRF-TOKEN': document.body.dataset.csrfToken
        },
        body: method == 'POST' || method == 'PUT' ? encodeForAjax(requestBody) : undefined
    })
        .then((response) => {
            return {response: response, content: response.json()};
        })
        .then((result) => {
            resolve(result);
        })
})
