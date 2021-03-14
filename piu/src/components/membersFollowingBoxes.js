document.querySelectorAll('.profile-popover').forEach((elem) => new bootstrap.Popover(elem, {
    trigger: 'hover',
    sanitize: false,
    html: true
}));