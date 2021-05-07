export function encodeForAjax(data) {
    return Object.keys(data).map(function(k){
        return encodeURIComponent(k) + '=' + encodeURIComponent(data[k])
    }).join('&')
}

export const makeRequest = (requestUrl, method, body) => new Promise((resolve, reject) => {
    const requestBody = { ...body, _token: document.body.dataset.csrfToken };

    fetch(requestUrl, {
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
            console.log(`Received result of ${method} to ${requestUrl}:`, result.content);
            resolve(result);
        })
        .catch((error) => {
            console.error(`Received error of ${method} to ${requestUrl}:`, error);
            reject(error);
        })
})
