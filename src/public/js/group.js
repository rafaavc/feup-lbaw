import {makeRequest} from './ajax/methods.js'
import {url} from './utils/url.js';
import {instantiateToolTip} from './utils/tooltip.js';
import {Feedback} from './feedback/Feedback.js';

// ----------------------------------------
// Join and leave
// ----------------------------------------

const joinButton = document.querySelector('button.group-join');
if (joinButton !== null) {
    let joinState = joinButton.textContent.trim();
    const groupPath = new URL(window.location.href).pathname;
    const groupId = /\/.*\/(.*)/.exec(groupPath)[1];

    const joinButtonHandler = (event) => {
        let requestURL = url('/api/group/' + groupId + "/request")
        let method = (joinState == 'Join') ? 'POST' : 'DELETE'
        if (joinState == 'Leave')
            requestURL = url('/api/group/' + groupId + "/member/" + document.body.dataset.username);
        makeRequest(requestURL, method)
            .then((result) => {
                if (result.response.status == 200)
                    location.reload();
            })
    }

    joinButton.addEventListener('click', joinButtonHandler);
}

// ----------------------------------------
// Members
// ----------------------------------------

const memberAmount = document.querySelectorAll('.group-member-amount');

const changeMemberAmount = (amount) => {
    memberAmount.forEach(el => {
        const value = el.innerText;
        const newValue = Number(value) + amount;
        el.innerText = newValue;
    })
}

const acceptButtons = document.querySelectorAll('.group-request-accept');
const rejectButtons = document.querySelectorAll('.group-request-reject');

const requestBox = document.querySelector('#memberRequests');
const membershipRequestsFeedback = new Feedback(requestBox, 'mt-4');


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
                membershipRequestsFeedback.showMessage('Error ' + res.response.status, 'danger');
            } else {

                membershipRequestsFeedback.showMessage(accept ? "The member has joined the group." : "The membership request was rejected.", 'success');

                const listItem = button.parentElement.parentElement.parentElement.parentElement.parentElement;
                const unorderedList = listItem.parentElement;

                if (unorderedList.children.length == 1) {
                    requestBox.remove();
                } else {
                    listItem.remove();
                }

                if (accept) {
                    const peopleBox = document.querySelector('#peopleBox');
                    peopleBox.firstElementChild.firstElementChild.nextElementSibling.insertAdjacentHTML('afterbegin', res.content.html);

                    const tooltipEl = peopleBox.firstElementChild.firstElementChild.nextElementSibling.firstElementChild.firstElementChild;
                    instantiateToolTip(tooltipEl);
                    changeMemberAmount(1);
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

const loadMembersButton = document.querySelector('#loadMoreMembersButton');
const membersModal = document.querySelector('#seeAllGroupMembersModal');
const table = membersModal.firstElementChild.firstElementChild.firstElementChild.nextElementSibling.firstElementChild;
const removeMemberFeedback = new Feedback(table, "mb-2");

const loadMoreMembers = () => {
    makeRequest(url(`api/group/${loadMembersButton.dataset.group}/members`), 'GET', {
        html: true,
        offset: Number(loadMembersButton.dataset.offset),
        amount: 10
    })
        .then(res => {
            if (res.response.status != 200) {
                console.error("Error when retrieving group members!");
            } else {
                loadMembersButton.parentElement.previousElementSibling.firstElementChild.insertAdjacentHTML('beforeend', res.content.html);
                if (res.content.end) loadMembersButton.remove();
                else loadMembersButton.dataset.offset = Number(loadMembersButton.dataset.offset) + 10;
                refreshRemoveMemberButtons();
            }
        })
}

if (loadMembersButton) loadMembersButton.addEventListener('click', loadMoreMembers);


const removeMember = (button) => {
    const member = button.dataset.member;
    const group = button.dataset.group;
    makeRequest(url(`api/group/${group}/member/${member}`), 'DELETE')
        .then((res) => {
            if (res.response.status != 200) {
                console.error("ERROR removing member from group!");
                removeMemberFeedback.showMessage('Error ' + res.response.status, 'danger');
            } else {
                button.parentElement.parentElement.parentElement.remove();
                changeMemberAmount(-1);
                removeMemberFeedback.showMessage('Member removed successfully.', 'success');
            }
        })
}


let removeMemberButtons = [];

const refreshRemoveMemberButtons = () => {
    const newButtons = document.querySelectorAll('.remove-group-member-button');
    for (const button of newButtons) {
        if (!removeMemberButtons.includes(button)) {
            button.addEventListener('click', () => removeMember(button));
        }
    }
    removeMemberButtons = [...newButtons];
}

refreshRemoveMemberButtons();

