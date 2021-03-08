
document.body.style.minHeight = window.innerHeight + "px";

window.addEventListener('resize', () => {
    document.body.style.minHeight = window.innerHeight + "px";
});

const tooltips = Array.from(document.querySelectorAll('.has-tooltip'));
tooltips.forEach(elem => new bootstrap.Tooltip(elem));

const header = document.querySelector('body > nav.navbar');
document.body.style.paddingTop = window.getComputedStyle(header).height;

