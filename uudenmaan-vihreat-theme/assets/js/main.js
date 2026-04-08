/* Uudenmaan Vihreät — main.js */
(function () {
  'use strict';

  // ── Mobile nav toggle ───────────────────────────────────────
  const toggle  = document.querySelector('.nav-toggle');
  const navMenu = document.querySelector('.nav-menu');

  if (toggle && navMenu) {
    toggle.addEventListener('click', function () {
      const isOpen = navMenu.classList.toggle('is-open');
      toggle.setAttribute('aria-expanded', String(isOpen));
      document.body.style.overflow = isOpen ? 'hidden' : '';
    });

    // Close on Escape
    document.addEventListener('keydown', function (e) {
      if (e.key === 'Escape' && navMenu.classList.contains('is-open')) {
        navMenu.classList.remove('is-open');
        toggle.setAttribute('aria-expanded', 'false');
        document.body.style.overflow = '';
        toggle.focus();
      }
    });

    // Close when clicking outside
    document.addEventListener('click', function (e) {
      if (!toggle.contains(e.target) && !navMenu.contains(e.target)) {
        navMenu.classList.remove('is-open');
        toggle.setAttribute('aria-expanded', 'false');
        document.body.style.overflow = '';
      }
    });
  }

  // ── Current year in footer ──────────────────────────────────
  const yearEl = document.querySelector('.js-current-year');
  if (yearEl) {
    yearEl.textContent = new Date().getFullYear();
  }

})();
