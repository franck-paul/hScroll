'use strict';

{
  const hscroll_bar = () => {
    /**
     * @type       {HTMLElement}
     */
    const t = document.querySelector('#hscroll-bar');
    t.style.width = `${(window.scrollY / (document.body.clientHeight - window.innerHeight)) * 100}%`;
  };
  window.addEventListener('load', hscroll_bar);
  window.addEventListener('scroll', hscroll_bar);
}
