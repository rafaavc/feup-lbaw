if(document.body.contains(document.getElementById('bannedMessageModal'))) {
    let myModal = new bootstrap.Modal(document.getElementById('bannedMessageModal'), {});
    myModal.show();
}

const urlParams = new URLSearchParams(window.location.search);
const message = urlParams.get('message');

if(message) {
    document.querySelector('div.alert-success').classList.remove('d-none');
    document.querySelector('div.alert-success').firstChild.remove();
    document.querySelector('div.alert-success').insertAdjacentText('afterbegin', message);
}
