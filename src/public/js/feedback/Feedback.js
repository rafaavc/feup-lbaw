export class Feedback {
    /**
     * @param {HTMLElement} elementBeforeWhichToInsert The message element is inserted before this element
     * @param {String} classes Classes to add to the alert component
     * @param {Number} timeout Time that the message lasts on the screen, < 0 if forever
     * @param {Boolean} insert_inside If the alert will be inserted inside the element or not
     */
    constructor(elementBeforeWhichToInsert, classes = "", timeout = 3000, insert_inside = false) {
        this.elementBeforeWhichToInsert = elementBeforeWhichToInsert;
        this.timeout = timeout;
        this.timeoutObj = null;
        this.element = null;
        this.classes = classes;
        this.insertInside = insert_inside;
    }

    removeElement() {
        if (this.element != null) {
            this.element.style.opacity = '0';
            setTimeout(() => {
                this.element.remove();

                if (this.timeoutObj != null) {
                    clearTimeout(this.timeoutObj);
                    this.timeoutObj = null;
                }

                this.element = null;
            }, 400);
        }
    }

    /**
     * @param {String} message
     * @param {String} alertType One of 'primary', 'secondary', 'success', 'danger', 'warning', 'info', 'light', 'dark'
     */
    showMessage(message, alertType = 'success') {
        this.removeElement();

        if (!this.insertInside) {
            this.elementBeforeWhichToInsert.insertAdjacentHTML(
                'beforebegin',
                `<div class="alert alert-${alertType} ${this.classes}">
                ${message}
            </div>`
            );
            this.element = this.elementBeforeWhichToInsert.previousElementSibling;
        } else {
            this.element = document.createElement("div");
            this.element.classList.add("alert", `alert-${alertType}`, ...`${this.classes}`.split(" "));
            this.element.innerHTML = message;
            this.elementBeforeWhichToInsert.appendChild(this.element);
        }

        this.element.addEventListener('click', () => {
            this.removeElement();
        });

        if (this.timeout > 0)
            this.timeoutObj = setTimeout(() => {
                this.removeElement();
            }, this.timeout);
    }
}
