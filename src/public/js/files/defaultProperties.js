export const defaultProperties = (extraImageClasses) => {
    return {
        addFileButton: {
            content: 'Add image',
            classes: ['btn', 'btn-secondary', 'mb-3']
        },
        removeFileButton: {
            content: '<i class="fas fa-times"></i>',
            classes: ['btn', 'btn-sm', 'btn-danger', 'fileInputRemoveButton']
        },
        image: {
            classes: ['fileInputImage', ...(extraImageClasses != undefined ? extraImageClasses : [])]
        },
        imageWrapper: {
            classes: ['fileInputImageWrapper']
        },
        box: {

        }
    }
}
