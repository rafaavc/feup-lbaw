
import { makeRequest } from './ajax/methods.js'
import { url } from './utils/url.js';

// const messagesPopupButton = document.querySelector('#messagesPopupButton');
// messagesPopupButton.dataset.bsContent = ;

const popoverButtons = document.querySelectorAll('.nav-popover');
const allPopovers = [];

for (const button of popoverButtons) {
    let content = button.dataset.popoverContent ? document.querySelector(button.dataset.popoverContent).innerHTML : '';

    const popover = new bootstrap.Popover(button, {
        trigger: 'focus',
        html: true,
        content,
        sanitize: false
    })

    allPopovers.push(popover);

    button.addEventListener('click', () => {
        if (popover._hoverState === null) popover.hide()        // if the popup is open
        else if (popover._hoverState === "") popover.show()          // if the button is already focused and is clicked while the popup is not open
    })
}


// ------------------------ Follow Requests ------------------------ //

let numPopOvers = 0;

document.querySelector('#showPopOver').addEventListener('shown.bs.popover', () => {
    let followRequestBtns = Array.from(document.querySelectorAll('button.follow-request-button'));
    followRequestBtns.forEach((followRequestBtn) => {
        followRequestBtn.addEventListener('mousedown', (event) => {
            event.preventDefault();
            const target = event.currentTarget;
            const targetUsername = target.parentElement.previousElementSibling.querySelector('a').textContent
            const requestType = target.getAttribute('data-state') == 'accept' ? 'PUT' : 'DELETE';
            let requestURL = url('/api/user/request/' + targetUsername);
            const notificationBox = target.closest('ul');

            let fadeOutNotification = setInterval(async () => {
                if (!notificationBox.style.opacity)
                    notificationBox.style.opacity = 1;
                if (notificationBox.style.opacity > 0)
                    notificationBox.style.opacity -= 0.1;
                else {
                    if(numPopOvers == 0) {
                        for (const popOver of allPopovers)
                            popOver.hide();
                    } else
                        notificationBox.classList.add('d-none');

                    clearInterval(fadeOutNotification);
                }
            }, 35)

            makeRequest(requestURL, requestType)
                .then((result) => {
                    if(result.response.status == 200)
                        numPopOvers -= 1;
                })
            });
    });

    numPopOvers = document.querySelector('#notificationsPopupContent').childElementCount;
    console.log(numPopOvers)
});
