/*global dotclear */
'use strict';

dotclear.ready(() => {
  // Loaded in Head
  const hscroll_data = dotclear.getData('hscroll');
  if (hscroll_data.color === undefined) {
    // Default light mode color
    hscroll_data.color = '#e9573f';
  }
  if (hscroll_data.color_dark === undefined) {
    // Default dark mode color
    hscroll_data.color_dark = '#e9573f';
  }
  if (hscroll_data.width === undefined) {
    // Défault width
    hscroll_data.width = '4px';
  }

  if (hscroll_data.top === undefined) hscroll_data.top = 'unset';
  if (hscroll_data.bottom === undefined) hscroll_data.bottom = 'unset';
  if (hscroll_data.left === undefined) hscroll_data.left = 'unset';
  if (hscroll_data.right === undefined) hscroll_data.right = 'unset';

  let offset = '1px 1px';
  switch (hscroll_data.position) {
    case 'top':
      break;
    case 'bottom':
      offset = '1px -1px';
      break;
    case 'left':
      break;
    case 'right':
      offset = '-1px 1px';
      break;
  }

  hscroll_data.shadow =
    hscroll_data.shadow === undefined || !hscroll_data.shadow
      ? 'unset'
      : `${offset} ${hscroll_data.width} color-mix(in srgb, currentColor, rgb(255, 255, 255) 50%)`;

  for (const param of Object.getOwnPropertyNames(hscroll_data)) {
    document.documentElement.style.setProperty(`--hscroll-${param}`, hscroll_data[param]);
  }
});
