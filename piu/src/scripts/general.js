
document.body.style.minHeight = window.innerHeight + "px";

window.addEventListener('resize', () => {
    document.body.style.minHeight = window.innerHeight + "px"
    document.body.style.paddingTop = window.getComputedStyle(header).height
});

const tooltips = Array.from(document.querySelectorAll('.has-tooltip'));
tooltips.forEach(elem => new bootstrap.Tooltip(elem, { container: 'body', placement: 'bottom', boundary: 'window' }));



const header = document.querySelector('body > nav.navbar');
let calculationCounter = 0;
let last = null;

const interval = setInterval(() => {   
    calculationCounter++;
    const newHeight = window.getComputedStyle(header).height;
    if (last !== null && newHeight >= last) {
        if (calculationCounter > 10) clearInterval(interval);
        return;
    }
    last = Number.parseFloat(newHeight);
    document.body.style.paddingTop = newHeight;
    console.log(`Updated body top padding (${last}).`)
    if (calculationCounter > 2) clearInterval(interval);
}, 200);  // sometimes there was problems in the calculation

