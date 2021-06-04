function encodeForAjax(data) {
    return Object.keys(data).map(function(k){
        return encodeURIComponent(k) + '=' + encodeURIComponent(data[k])
    }).join('&')
}

export const makeRequest = (requestUrl, method, body, query) => new Promise((resolve, reject) => {
    const requestBody = { ...body, _token: document.body.dataset.csrfToken };

    let urlParams;
    if (method == 'GET') urlParams = {...body, ...query};
    else urlParams = {...query};

    fetch(requestUrl + (Object.keys(urlParams).length ? '?' + encodeForAjax(urlParams) : ''), {
        method,
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded',
            'X-CSRF-TOKEN': document.body.dataset.csrfToken
        },
        body: method == 'POST' || method == 'PUT' ? encodeForAjax(requestBody) : undefined
    })
        .then(async (response) => {
            const content = await response.json();
            return {response, content};
        })
        .then((result) => {
            resolve(result);
        })
        .catch((error) => {
            reject(error);
        })
})
