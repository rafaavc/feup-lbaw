
document.body.style.minHeight = window.innerHeight + "px";

window.addEventListener('resize', () => {
    document.body.style.minHeight = window.innerHeight + "px"
    document.body.style.paddingTop = window.getComputedStyle(header).height
});

const tooltips = Array.from(document.querySelectorAll('.has-tooltip'));
tooltips.forEach(elem => new bootstrap.Tooltip(elem));



const header = document.querySelector('body > nav.navbar');
let counter = 0;

const interval = setInterval(() => {   
    counter++;
    document.body.style.paddingTop = window.getComputedStyle(header).height
    console.log("hey")
    if (counter > 7) clearInterval(interval)
}, 200);  // sometimes there was problems in the calculation


