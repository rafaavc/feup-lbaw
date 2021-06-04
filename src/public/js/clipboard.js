import {Feedback} from "./feedback/Feedback.js";

function copyLinkToClipboard() {
    let main = document.body.getElementsByTagName("main")[0];
    let inputc = main.parentElement.insertBefore(document.createElement("input"), main);
    inputc.value = window.location.href;
    inputc.focus();
    inputc.select();
    document.execCommand('copy');
    inputc.parentNode.removeChild(inputc);

    let message = new Feedback(document.getElementById("feedback-div"), "floating-alert alert alert-success fade show", 3000, true);
    message.showMessage("Copied link to clipboard");
}

let buttons = Array.prototype.slice.call(document.body.getElementsByClassName("copy-link-button"));
for (let button of buttons) {
    button.addEventListener("click", copyLinkToClipboard);
}
