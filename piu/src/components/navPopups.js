
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
