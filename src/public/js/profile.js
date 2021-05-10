import { makeRequest } from './ajax/methods.js'
import { url } from './utils/url.js';

const followBtn = document.querySelector('button.user-follow');
let followState = followBtn.textContent.trim();
const profilePath = new URL(window.location.href).pathname;
const profileName = /\/.*\/(.*?)\//.exec(profilePath)[1];

const registerListeners = () => {
    followBtn.addEventListener('click', followBtnHandler),
    checkStatePending(followBtn);
}

const followBtnHandler = (event) => {
    let requestURL = url('/api/user/' + profileName + "/request");
    console.log(requestURL);
    makeRequest(requestURL, (followState == 'Follow') ? 'POST' : 'DELETE')
        .then((result) => {
            if(result.response.status == 200) {
                followBtn.classList.toggle('user-follow');
                const newFollowState = result.content.newState;
                followBtn.removeChild(followBtn.lastChild);

                if(newFollowState == "pending") {
                    followState = 'Pending Request';
                    followBtn.querySelector('.fa-user-plus').classList.add('d-none');
                    followBtn.querySelector('.fa-user-times').classList.add('d-none');
                    followBtn.setAttribute('disabled', 'true');
                }
                else if(newFollowState == "accepted") {
                    followState = 'Unfollow';
                    followBtn.querySelector('.fa-user-plus').classList.add('d-none');
                    followBtn.querySelector('.fa-user-times').classList.remove('d-none');
                }
                else {
                    followState = 'Follow';
                    followBtn.querySelector('.fa-user-plus').classList.remove('d-none');
                    followBtn.querySelector('.fa-user-times').classList.add('d-none');
                }

                followBtn.append(followState);
            }
        })
}

const checkStatePending = (followBtn) => {
    if(followState == 'Pending Request')
        followBtn.setAttribute('disabled', true);
    else if(followState == 'Follow')
        followBtn.classList.toggle('user-follow');
}

registerListeners();
