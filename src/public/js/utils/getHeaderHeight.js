const header = document.querySelector('body > nav.navbar');

export const getHeaderHeight = () => {
    const heightString = window.getComputedStyle(header).height;
    return Number(heightString.substring(0, heightString.length-2));
}
