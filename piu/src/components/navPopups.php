<button id="messagesPopupButton" class="btn btn-primary my-popover" role="button" data-bs-placement="bottom" data-bs-toggle="popover" data-bs-trigger="focus" data-bs-content="">
    <i class="fas fa-envelope"></i>
</button>

<script>
const initPopup = () => {
    const messagesPopupButton = document.querySelector('#messagesPopupButton');
    messagesPopupButton.dataset.bsContent = `<?php include(__DIR__.'/messagesPopupContent.html'); ?>`;
    const popoverButton = document.querySelector('.my-popover');

    const popover = new bootstrap.Popover(popoverButton, {
        trigger: 'focus',
        html: true
    })

    popoverButton.addEventListener('click', () => {
        if (popover._hoverState === null) popover.hide()
        else if (popover._hoverState === "") popover.show()
    })

    console.log(popover)
}

setTimeout(initPopup, 2000)
</script>
