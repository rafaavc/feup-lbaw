import {makeRequest} from './ajax/methods.js'
import {url} from './utils/url.js';

const joinButton = document.querySelector('button.group-join');
let joinState = joinButton.textContent.trim();
const groupPath = new URL(window.location.href).pathname;
const groupId = /\/.*\/(.*)/.exec(groupPath)[1];

const registerListeners = () => {
    joinButton.addEventListener('click', joinButtonHandler),
        checkStatePending(joinButton);
}

const joinButtonHandler = (event) => {
    let requestURL = url('/api/group/' + groupId + "/request")
    let method = (joinState == 'Join') ? 'POST' : 'DELETE'
    if (joinState == 'Leave')
        return
    console.log(requestURL);
    makeRequest(requestURL, method)
        .then((result) => {
            if (result.response.status == 200) {
                joinButton.classList.toggle('user-follow');
                const newFollowState = result.content.newState;
                joinButton.removeChild(joinButton.lastChild);

                if (newFollowState == "pending") {
                    joinState = 'Pending Request';
                    joinButton.querySelector('.fa-user-plus').classList.add('d-none');
                    joinButton.querySelector('.fa-user-times').classList.add('d-none');
                    joinButton.setAttribute('disabled', 'true');
                } else if (newFollowState == "accepted") {
                    joinState = 'Leave';
                    joinButton.querySelector('.fa-user-plus').classList.add('d-none');
                    joinButton.querySelector('.fa-user-times').classList.remove('d-none');
                } else {
                    joinState = 'Join';
                    joinButton.querySelector('.fa-user-plus').classList.remove('d-none');
                    joinButton.querySelector('.fa-user-times').classList.add('d-none');
                }

                joinButton.append(joinState);
            }
        })
}

const checkStatePending = (followBtn) => {
    if (joinState == 'Pending Request')
        followBtn.setAttribute('disabled', true);
    else if (joinState == 'Join')
        followBtn.classList.toggle('user-follow');
}

registerListeners();
