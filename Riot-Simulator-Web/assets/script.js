// Transition fade-in/out
window.addEventListener('load', () => document.body.classList.add('loaded'));
document.querySelectorAll('nav a').forEach(link => {
  link.addEventListener('click', e => {
    e.preventDefault();
    document.body.classList.remove('loaded');
    setTimeout(() => (window.location.href = link.href), 400);
  });
});

// Highlight active nav
document.querySelectorAll('nav a').forEach(link => {
  if (link.href === window.location.href) link.classList.add('active');
});

