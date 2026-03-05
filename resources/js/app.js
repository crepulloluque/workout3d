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
});

// ✅ Limpiar carrito al cerrar sesión
document.addEventListener('DOMContentLoaded', () => {
    // Si viene la flag de limpiar carrito
    if (window._CLEAR_CART) {
        localStorage.removeItem('carrito');
        console.log('🗑️ Carrito limpiado al cerrar sesión');
        window._CLEAR_CART = null;
    }
});

// Hacer accesible showToast globalmente
window.showToast = showToast;
