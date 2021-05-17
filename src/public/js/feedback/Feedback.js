export class Feedback {
    /**
     * @param {HTMLElement} elementBeforeWhichToInsert The message element is inserted before this element
     * @param {String} alertType One of 'primary', 'secondary', 'success', 'danger', 'warning', 'info', 'light', 'dark'
     * @param {Number} timeout Time that the message lasts on the screen, < 0 if forever
     */
    constructor(elementBeforeWhichToInsert, alertType, classes="", timeout=3000) {
        this.elementBeforeWhichToInsert = elementBeforeWhichToInsert;
        this.alertType = alertType;
        this.timeout = timeout;
        this.timeoutObj = null;
        this.element = null;
        this.classes = classes;
    }

    removeElement() {
        if (this.element != null) {
            this.element.remove();
            if (this.timeoutObj != null) {
                clearTimeout(this.timeoutObj);
                this.timeoutObj = null;
            }
        }
        this.element = null;
    }

    showMesssage(message) {
        this.removeElement();

        this.elementBeforeWhichToInsert.insertAdjacentHTML(
            'beforebegin',
            `<div class="alert alert-${this.alertType} ${this.classes}">
                ${message}
            </div>`
        );

        this.element = this.elementBeforeWhichToInsert.previousElementSibling;
        if (this.timeout > 0) {
            this.timeoutObj = setTimeout(() => this.removeElement(), this.timeout);
        }
    }
}
