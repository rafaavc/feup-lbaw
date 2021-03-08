
const tooltips = Array.from(document.querySelectorAll('.has-tooltip'));
tooltips.forEach(elem => new bootstrap.Tooltip(elem));

const header = document.querySelector('body > nav');
document.body.style.paddingTop = window.getComputedStyle(header).height;

