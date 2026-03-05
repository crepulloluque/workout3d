import './bootstrap';

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
