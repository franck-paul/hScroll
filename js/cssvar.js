/*global hscroll_color:true, hscroll_top:true, hscroll_bottom:true, hscroll_shadow:true */
'use strict';

if (typeof hscroll_color === 'undefined') {
    hscroll_color = '#e9573f';
}
if (typeof hscroll_top === 'undefined' || typeof hscroll_bottom === 'undefined') {
    hscroll_top = '0';
    hscroll_bottom = 'unset';
}
if (typeof hscroll_shadow === 'undefined' || hscroll_shadow != '1') {
    hscroll_shadow = 'unset';
} else {
    if (hscroll_top == '0') {
        hscroll_shadow = '1px 1px 4px rgba(0, 0, 0, 0.5)';
    } else {
        hscroll_shadow = '1px -1px 4px rgba(0, 0, 0, 0.5)';
    }
}
document.documentElement.style.setProperty('--hscroll-color', hscroll_color);
document.documentElement.style.setProperty('--hscroll-top', hscroll_top);
document.documentElement.style.setProperty('--hscroll-bottom', hscroll_bottom);
document.documentElement.style.setProperty('--hscroll-shadow', hscroll_shadow);
