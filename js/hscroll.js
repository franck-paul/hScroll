'use strict';

function hscroll_bar() {
  const t = document.querySelector('#hscroll-bar');
  t.style.width = `${window.pageYOffset / (document.body.clientHeight - window.innerHeight) * 100}%`;
}
window.addEventListener('load', hscroll_bar);
window.addEventListener('scroll', hscroll_bar);
