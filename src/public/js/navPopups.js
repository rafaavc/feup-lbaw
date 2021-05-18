
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
let numNotifications;

if(document.body.contains(document.querySelector('#showPopOver'))) {
    notifications = document.querySelector('#notificationsPopupContent');
    numNotifications = document.querySelector('div.notif-quantity-indicator').firstElementChild;

    document.querySelector('#showPopOver').addEventListener('shown.bs.popover', (event) => {
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
                            notificationPopOver.config.content = '<b>You don\'t have any new notifications.</b>';
                            notificationPopOver.hide();
                        } else
                            notificationBox.classList.add('d-none');

                        clearInterval(fadeOutNotification);
                    }
                }, 35)

                makeRequest(requestURL, requestType)
                    .then((result) => {
                        if(result.response.status == 200) {
                            numNotifications.textContent = parseInt(numNotifications.textContent) - 1;
                            numPopOvers -= 1;
                        }
                    })
                });
        });

        numPopOvers = document.querySelector('#notificationsPopupContent').childElementCount;
    });
}


