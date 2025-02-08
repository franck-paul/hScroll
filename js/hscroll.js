/*global dotclear */
'use strict';

dotclear.ready(() => {
  // Loaded in Body
  const updateScrollbar = () => {
    /**
     * @type       {HTMLElement}
     */
    const scrollbar = document.querySelector('#hscroll-bar');
    scrollbar.style.width = `${(window.scrollY / (document.body.clientHeight - window.innerHeight)) * 100}%`;
  };
  window.addEventListener('load', updateScrollbar);
  window.addEventListener('scroll', updateScrollbar);
  updateScrollbar();
});
