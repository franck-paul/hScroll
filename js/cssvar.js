/*global dotclear */
'use strict';

dotclear.ready(() => {
  // Loaded in Head
  const hscroll_data = dotclear.getData('hscroll');
  if (typeof hscroll_data.color === 'undefined') {
    hscroll_data.color = '#e9573f';
  }
  if (typeof hscroll_data.top === 'undefined' || typeof hscroll_data.bottom === 'undefined') {
    hscroll_data.top = '0';
    hscroll_data.bottom = 'unset';
  }
  if (typeof hscroll_data.shadow === 'undefined' || !hscroll_data.shadow) {
    hscroll_data.shadow = 'unset';
  } else if (hscroll_data.top === '0') {
    hscroll_data.shadow = '1px 1px 4px rgba(0, 0, 0, 0.5)';
  } else {
    hscroll_data.shadow = '1px -1px 4px rgba(0, 0, 0, 0.5)';
  }
  for (const param of Object.getOwnPropertyNames(hscroll_data)) {
    document.documentElement.style.setProperty(`--hscroll-${param}`, hscroll_data[param]);
  }
});
