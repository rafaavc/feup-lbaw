import { url } from './utils/url.js';
import { makeRequest } from './ajax/methods.js';

const acceptButtons = document.querySelectorAll('.group-request-accept');
const rejectButtons = document.querySelectorAll('.group-request-reject');

const dealWithMembershipRequest = (event, accept) => {
    const button = event.target.tagName == "I" ? event.target.parentElement.parentElement : event.target;
    const group = button.dataset.group;
    const member = button.dataset.member;
    let requestUrl = url(`api/group/${group}/request/${member}`), requestMethod = '';
    if (accept) requestMethod = 'POST';
    else requestMethod = 'DELETE';

    makeRequest(requestUrl, requestMethod)
        .then(res => {
            if (res.response.status != 200) {
                console.error('Error dealing with membership request:', res.content.message);
            } else {
                console.log('Dealt with membership request successfully!');
            }
        });
}

acceptButtons.forEach(button => {
    button.addEventListener('click', (event) => dealWithMembershipRequest(event, true));
});

rejectButtons.forEach(button => {
    button.addEventListener('click', (event) => dealWithMembershipRequest(event, false));
})
