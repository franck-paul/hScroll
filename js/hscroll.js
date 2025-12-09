/*global dotclear */
'use strict';

dotclear.ready(() => {
  // Loaded in Body
  const scrollbar = document.getElementById('hscroll-bar');
  if (!scrollbar) {
    return;
  }
  const vertical = scrollbar.classList.contains('vertical');
  const updateScrollbar = () => {
    const position = `${(globalThis.scrollY / (document.body.clientHeight - globalThis.innerHeight)) * 100}%`;
    if (vertical) scrollbar.style.height = position;
    else scrollbar.style.width = position;
  };
  globalThis.addEventListener('load', updateScrollbar);
  globalThis.addEventListener('scroll', updateScrollbar);
  updateScrollbar();
});
