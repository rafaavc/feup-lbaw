import { makeRequest } from './ajax/methods.js'
import { url } from './utils/url.js';

// const messagesPopupButton = document.querySelector('#messagesPopupButton');
// messagesPopupButton.dataset.bsContent = ;

const popoverButtons = document.querySelectorAll('.nav-popover');
let notificationPopOver;

for (const button of popoverButtons) {
    let content = button.dataset.popoverContent ? document.querySelector(button.dataset.popoverContent).innerHTML : '';

    const popover = new bootstrap.Popover(button, {
        trigger: 'focus',
        html: true,
        content,
        sanitize: false
    })
    if(button.id == 'showPopOver')
        notificationPopOver = popover;

    button.addEventListener('click', () => {
        if (popover._hoverState === null) popover.hide()        // if the popup is open
        else if (popover._hoverState === "") popover.show()          // if the button is already focused and is clicked while the popup is not open
    })
}


// ------------------------ Follow Requests ------------------------ //
let numPopOvers = 0;

let notifications;
let numNotifications, numNotificationsMobile;
let alreadyRunRead = false;


const updateReadNotifications = () => {
    if(!alreadyRunRead) {
        alreadyRunRead = true;

        // Delete
        let deleteIds = [...document.querySelectorAll('[data-notification-type="deleteNotification"]')].map(function (input) {
            return parseInt(input.dataset.notificationId);
        });
        deleteIds = [... new Set(deleteIds)];

        if(deleteIds.length > 0) {
            makeRequest(url('api/notification/deleteNotification'), 'PUT', { notificationIds: deleteIds });
        }


        // Favourites
        let favouriteIds = [...document.querySelectorAll('[data-notification-type="favouriteNotification"]')].map(function (input) {
            return parseInt(input.dataset.notificationId);
        });
        favouriteIds = [... new Set(favouriteIds)];

        if(favouriteIds.length > 0) {
            makeRequest(url('api/notification/favouriteNotification'), 'PUT', { notificationIds: favouriteIds });
        }

        // Comment/Review
        let commentIds = [...document.querySelectorAll('[data-notification-type="commentNotification"]')].map(function (input) {
            return parseInt(input.dataset.notificationId);
        });
        commentIds = [... new Set(commentIds)];

        if(commentIds.length > 0) {
            makeRequest(url('api/notification/commentNotification'), 'PUT', { notificationIds: commentIds });
        }

        let affectedNotifications = deleteIds.length + favouriteIds.length + commentIds.length;
        if(affectedNotifications > 0) {
            if(numNotifications)
                numNotifications.firstElementChild.textContent = parseInt(numNotifications.firstElementChild.textContent) - affectedNotifications;
            if(numNotificationsMobile)
                numNotificationsMobile.firstElementChild.textContent = parseInt(numNotificationsMobile.firstElementChild.textContent) - affectedNotifications;
        }
    }
};

if(document.body.contains(document.querySelector('#showPopOver'))) {
    acceptDeclineFollowRequest(false); // mobile
    document.querySelector('#showPopOver').addEventListener('shown.bs.popover', (event) => {
        // updateReadNotifications();
        acceptDeclineFollowRequest(true);
    });

    document.getElementById('mobile-notificationPopUp').addEventListener('click', () => {
        updateReadNotifications();
    });
}

function acceptDeclineFollowRequest(updateRead) {
    notifications = document.querySelector('#notificationsPopupContent');
    numNotifications = document.querySelector('span.notif-quantity-indicator');
    numNotificationsMobile = document.querySelector('span.notif-quantity-indicator-mobile');

    if(updateRead)
        updateReadNotifications();
    let followRequestBtns = Array.from(document.querySelectorAll('button.follow-request-button'));
        followRequestBtns.forEach((followRequestBtn) => {
            followRequestBtn.addEventListener('mousedown', (event) => {
                event.preventDefault();
                const target = event.currentTarget;
                const targetUsername = target.parentElement.previousElementSibling.querySelector('a').textContent;
                const requestType = target.getAttribute('data-state') == 'accept' ? 'PUT' : 'DELETE';
                let requestURL = url('/api/user/request/' + targetUsername);
                const notificationBox = target.closest('ul');

                let followId = /follow-(\d+)/.exec(notificationBox.getAttribute('data-follow'))[1];

                let fadeOutNotification = setInterval(async () => {
                    if (!notificationBox.style.opacity)
                        notificationBox.style.opacity = 1;
                    if (notificationBox.style.opacity > 0)
                        notificationBox.style.opacity -= 0.1;
                    else {
                        notifications.removeChild(notifications.querySelector('[data-follow=follow-' + followId));
                        notificationPopOver.config.content = notifications.innerHTML;

                        if(numPopOvers == 0) {
                            document.getElementById('notificationsPopupContent').innerHTML = `
                                <div style=\"display: flex; align-items: center; height: 5rem;\">
                                    <b>You don\'t have any notifications.</b>
                                </div>`;

                            notificationPopOver.config.content = `
                                <div style=\"display: flex; align-items: center; height: 5rem;\">
                                    <b>You don\'t have any notifications.</b>
                                </div>`;
                            notificationPopOver.hide();
                        } else
                            notificationBox.classList.add('d-none');

                        clearInterval(fadeOutNotification);
                    }
                }, 35)

                makeRequest(requestURL, requestType)
                    .then((result) => {
                        if(result.response.status == 200) {
                            if(numNotifications)
                                numNotifications.firstElementChild.textContent = parseInt(numNotifications.firstElementChild.textContent) - 1;
                            if(numNotificationsMobile)
                                numNotificationsMobile.firstElementChild.textContent = parseInt(numNotificationsMobile.firstElementChild.textContent) - 1;
                            numPopOvers -= 1;
                        }
                    })
                });
        });

        numPopOvers = document.querySelector('#notificationsPopupContent').childElementCount;
}

if (window.location.pathname.split("/").pop() === 'feed')
    document.querySelector('.nav-item:first-of-type').firstElementChild.firstElementChild.style.color = "black";
