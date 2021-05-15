
import { makeRequest } from './ajax/methods.js'
import { url } from './utils/url.js';

// const messagesPopupButton = document.querySelector('#messagesPopupButton');
// messagesPopupButton.dataset.bsContent = ;

const popoverButtons = document.querySelectorAll('.nav-popover');

for (const button of popoverButtons) {
    let content = button.dataset.popoverContent ? document.querySelector(button.dataset.popoverContent).innerHTML : '';

    const popover = new bootstrap.Popover(button, {
        trigger: 'focus',
        html: true,
        content,
        sanitize: false
    })

    button.addEventListener('click', () => {
        if (popover._hoverState === null) popover.hide()        // if the popup is open
        else if (popover._hoverState === "") popover.show()          // if the button is already focused and is clicked while the popup is not open
    })
}


// ------------------------ Follow Requests ------------------------ //

document.querySelector('#showPopOver').addEventListener('shown.bs.popover', () => {
    let followRequestBtns = Array.from(document.querySelectorAll('button.follow-request-button'));
    followRequestBtns.forEach((followRequestBtn) => {
        followRequestBtn.addEventListener('mousedown', (event) => {
            event.preventDefault();
            const target = event.currentTarget;
            const targetUsername = target.parentElement.previousElementSibling.querySelector('a').textContent
            const requestType = target.getAttribute('data-state') == 'accept' ? 'PUT' : 'DELETE';
            let requestURL = url('/api/user/request/' + targetUsername);
            console.log(requestURL);
            console.log(requestType);
        makeRequest(requestURL, requestType)
            .then((result) => {
                console.log(result);
                // if(result.response.status == 200) {

                // }
            })

            console.log("Click Test");
        });
    });
});
