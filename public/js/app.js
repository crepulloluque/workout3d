/**
 * Utilidades globales para toda la aplicación
 */

// ----------------------------
// Función: Mostrar toasts
// ----------------------------
function showToast(text, type = 'info', timeout = 3500) {
  const container = document.getElementById('toasts');
  if (!container) return;

  const div = document.createElement('div');
  div.className = 'toast ' + (type || 'info');
  div.textContent = text;
  container.appendChild(div);

  setTimeout(() => {
    div.style.opacity = '1';
  }, 20);

  setTimeout(() => {
    div.style.transition = 'opacity 400ms';
    div.style.opacity = '0';
    setTimeout(() => div.remove(), 420);
  }, timeout);
}

// Mostrar toast inicial si viene del servidor
document.addEventListener('DOMContentLoaded', () => {
  if (window._INITIAL_TOAST) {
    showToast(window._INITIAL_TOAST.text, window._INITIAL_TOAST.type);
    window._INITIAL_TOAST = null;
  }

  // Navbar mobile toggle
  const navToggle = document.getElementById('navToggle');
  const navPanel = document.getElementById('navPanel');
  const navbar = document.querySelector('.navbar');

  if (navToggle && navPanel && navbar) {
    const closeMenu = () => {
      navbar.classList.remove('is-open');
      document.body.classList.remove('nav-open');
      navToggle.setAttribute('aria-expanded', 'false');
    };

    navToggle.addEventListener('click', () => {
      const willOpen = !navbar.classList.contains('is-open');
      navbar.classList.toggle('is-open', willOpen);
      document.body.classList.toggle('nav-open', willOpen);
      navToggle.setAttribute('aria-expanded', willOpen ? 'true' : 'false');
    });

    navPanel.querySelectorAll('a').forEach((link) => {
      link.addEventListener('click', closeMenu);
    });

    document.addEventListener('click', (event) => {
      if (!navbar.classList.contains('is-open')) return;
      const clickedInsideNavbar = navbar.contains(event.target);
      if (!clickedInsideNavbar) closeMenu();
    });

    window.addEventListener('resize', () => {
      if (window.innerWidth > 980) closeMenu();
    });
  }

  // Global Exercise Search (Muscle Pages)
  const exerciseSearch = document.getElementById('buscadorEjercicios');
  if (exerciseSearch) {
    const cards = Array.from(document.querySelectorAll('.exercise'));
    exerciseSearch.addEventListener('input', (e) => {
      const q = e.target.value.trim().toLowerCase();
      cards.forEach(card => {
        const name = card.getAttribute('data-nombre') || '';
        card.style.display = name.includes(q) ? 'block' : 'none';
        if (q === '') card.style.animation = 'fadeInUp 0.6s ease forwards';
      });
    });
  }
});

// Hacer accesible showToast globalmente
window.showToast = showToast;
