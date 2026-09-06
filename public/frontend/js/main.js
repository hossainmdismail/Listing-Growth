/**
 * ListingGrowth - Main JavaScript
 */

document.addEventListener('DOMContentLoaded', () => {
  // ===== 1. Scroll Reveal Animations =====
  const revealItems = document.querySelectorAll('[data-reveal]');
  if (revealItems.length > 0) {
    const observerOptions = {
      threshold: 0.12,
      rootMargin: '0px 0px -50px 0px'
    };

    const revealObserver = new IntersectionObserver((entries) => {
      entries.forEach((entry) => {
        if (entry.isIntersecting) {
          entry.target.classList.add('in');
          revealObserver.unobserve(entry.target);
        }
      });
    }, observerOptions);

    revealItems.forEach((item) => revealObserver.observe(item));
  }

  // ===== 2. Mobile Navigation Toggle =====
  const navToggle = document.querySelector('.nav-toggle');
  const navLinks = document.querySelector('.nav-links');

  if (navToggle && navLinks) {
    navToggle.addEventListener('click', () => {
      navLinks.classList.toggle('active');
    });
  }

  // ===== 3. Active Link Highlighter =====
  const currentPath = window.location.pathname.split('/').pop() || 'index.html';
  const links = document.querySelectorAll('.nav-links a');

  links.forEach(link => {
    const href = link.getAttribute('href');
    if (href === currentPath || (currentPath === '' && href === 'index.html')) {
      link.classList.add('active');
    }
  });

  // ===== 4. Category / Filter Pills Interactivity =====
  const filterPills = document.querySelectorAll('.filter-pill');
  if (filterPills.length > 0) {
    filterPills.forEach(pill => {
      pill.addEventListener('click', () => {
        filterPills.forEach(p => p.classList.remove('active'));
        pill.classList.add('active');
      });
    });
  }

});
