import { url } from './utils/url.js';
import { makeRequest } from './ajax/methods.js';
import { instantiateToolTip } from './utils/tooltip.js';
import { Feedback } from './feedback/Feedback.js';

const acceptButtons = document.querySelectorAll('.group-request-accept');
const rejectButtons = document.querySelectorAll('.group-request-reject');

const requestBox = document.querySelector('#memberRequests');
let successFeedback = new Feedback(requestBox, 'success', 'mt-4');


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

                successFeedback.showMesssage(accept ? "The member has joined the group." : "The membership request was rejected.");

                const listItem = button.parentElement.parentElement.parentElement.parentElement.parentElement;
                const unorderedList = listItem.parentElement;

                if (unorderedList.children.length == 1) {
                    requestBox.remove();
                } else {
                    listItem.remove();
                }

                if (accept) {
                    const peopleBox = document.querySelector('#peopleBox');
                    peopleBox.firstElementChild.lastElementChild.insertAdjacentHTML('afterbegin', res.content.html);

                    const tooltipEl = peopleBox.firstElementChild.lastElementChild.firstElementChild.firstElementChild;
                    instantiateToolTip(tooltipEl);
                }
            }
        });
}

acceptButtons.forEach(button => {
    button.addEventListener('click', (event) => dealWithMembershipRequest(event, true));
});

rejectButtons.forEach(button => {
    button.addEventListener('click', (event) => dealWithMembershipRequest(event, false));
})
