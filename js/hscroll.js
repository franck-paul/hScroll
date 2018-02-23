'use strict';

function hscroll_bar() {
    var t = document.querySelector('#hscroll-bar'),
        a = document.body.clientHeight,
        n = window.innerHeight,
        g = window.pageYOffset,
        o = g / (a - n) * 100;
    t.style.width = o + '%';
}
window.addEventListener('load', hscroll_bar);
window.addEventListener('scroll', hscroll_bar);
