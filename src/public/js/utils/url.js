export const url = (path) => {
    const hasSlash = path.substring(0, 1) == '/';
    return document.body.dataset.rootUrl + (hasSlash ? '' : '/') + path;
}
