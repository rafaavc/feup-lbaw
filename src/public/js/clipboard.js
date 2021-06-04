import {Feedback} from "./feedback/Feedback.js";

function copyLinkToClipboard(event) {
    let footer = document.body.getElementsByTagName("footer")[0];
    let inputc = footer.parentElement.insertBefore(document.createElement("input"), footer);
    let target = event.target;
    if (target.tagName === 'I' || target.tagName === 'SPAN')
        target = target.parentElement;
    inputc.value = target.dataset.link;
    inputc.focus();
    inputc.select();
    document.execCommand('copy');
    inputc.parentNode.removeChild(inputc);

    let message = new Feedback(document.getElementById("feedback-div"), "floating-alert alert alert-success fade show", 3000, true);
    message.showMessage("Copied link to clipboard");
}

let buttons = Array.prototype.slice.call(document.getElementsByClassName("copy-link-button"));
for (let button of buttons) {
    button.addEventListener("click", (event) => {
        copyLinkToClipboard(event);
    });
}
