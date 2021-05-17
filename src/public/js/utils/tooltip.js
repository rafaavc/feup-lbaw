export const instantiateToolTip = (el) => {
    new bootstrap.Tooltip(el, { container: 'body', placement: 'bottom', boundary: 'window', html: true, sanitize: false })
}
