var ButtonActions;
(function (ButtonActions) {
    ButtonActions[ButtonActions["ADD_FILE"] = 0] = "ADD_FILE";
    ButtonActions[ButtonActions["REMOVE_FILE"] = 1] = "REMOVE_FILE";
    ButtonActions[ButtonActions["REMOVE_ALL_FILES"] = 2] = "REMOVE_ALL_FILES";
})(ButtonActions || (ButtonActions = {}));
export class FileInput {
    constructor(containerId, inputName, elementProperties, multiple) {
        const box = document.querySelector('#' + containerId);
        this.addPropertiesToElement(box, elementProperties.box);
        if (box == null)
            throw new Error("Couldn't find the specified container!");
        this.box = box;
        this.multiple = multiple;
        this.elementProperties = elementProperties;
        this.inputName = inputName + (multiple ? '[]' : '');
        this.addButton = this.getButton(ButtonActions.ADD_FILE);
        this.files = [];
        this.freeInput = null;
        this.imagesWrapper = document.createElement('div');
        this.build();
    }
    /**
     * This builds all the HTML elements necessary
     */
    build() {
        this.box.appendChild(this.addButton);
        this.box.appendChild(this.imagesWrapper);
        this.addFreeInput();
    }
    addFile(image) {
        if (!this.freeInput)
            return;
        const file = {
            removeButton: null,
            input: this.freeInput,
            img: image,
            wrapper: this.getImageWrapper()
        };
        file.removeButton = this.getButton(ButtonActions.REMOVE_FILE, file);
        this.files.push(file);
        if (this.multiple && this.files.length < this.multiple.maximum)
            this.addFreeInput();
        else
            this.addButton.remove();
        file.wrapper.appendChild(file.removeButton);
        file.wrapper.appendChild(file.img);
        this.imagesWrapper.appendChild(file.wrapper);
    }
    addFreeInput() {
        this.freeInput = this.getFileInput(this.inputName);
        this.box.appendChild(this.freeInput);
        this.freeInput.addEventListener('change', this.onFreeInputChange.bind(this, this.freeInput));
    }
    onFreeInputChange(input) {
        console.log("onFreeInputChange");
        const file = input.files[0];
        const reader = new FileReader();
        reader.onload = ((e) => {
            const image = this.getImage(e.target.result);
            this.addFile(image);
        }).bind(this);
        reader.readAsDataURL(file);
    }
    /**
     *
     */
    onAddFileClick() {
        console.log("onAddFileClick");
        if (this.freeInput)
            this.freeInput.click();
    }
    addPropertiesToElement(element, properties) {
        if (properties.classes)
            element.classList.add(...properties.classes);
        if (properties.id)
            element.id = properties.id;
        if (properties.content)
            element.innerHTML = properties.content;
    }
    onRemoveFileClick(file) {
        file.wrapper.remove();
        file.input.remove();
        if (this.multiple && this.files.length == this.multiple.maximum)
            this.box.insertBefore(this.addButton, this.box.firstElementChild);
        this.files.splice(this.files.findIndex((f) => f == file));
        // if the add button is hidden, it should reappear when a file is deleted.
    }
    /**
     * Builds a new button that on click executes the specified action on the specified file (if applicable)
     * @param action the action to take when the button is pressed
     * @param idToActUpon the id of the file instance to act upon
     * @returns the button element
     */
    getButton(action, file) {
        const button = document.createElement('button');
        switch (action) {
            case ButtonActions.ADD_FILE:
                this.addPropertiesToElement(button, this.elementProperties.addFileButton);
                button.addEventListener('click', this.onAddFileClick.bind(this));
                break;
            case ButtonActions.REMOVE_FILE:
                this.addPropertiesToElement(button, this.elementProperties.removeFileButton);
                button.addEventListener('click', this.onRemoveFileClick.bind(this, file));
                break;
            case ButtonActions.REMOVE_ALL_FILES:
                break;
        }
        return button;
    }
    getImageWrapper() {
        const wrapper = document.createElement('div');
        this.addPropertiesToElement(wrapper, this.elementProperties.imageWrapper);
        return wrapper;
    }
    getImage(src) {
        const image = document.createElement('img');
        image.src = src;
        this.addPropertiesToElement(image, this.elementProperties.image);
        return image;
    }
    getFileInput(name) {
        const input = document.createElement('input');
        input.type = 'file';
        input.name = name;
        input.style.display = 'none';
        return input;
    }
}
