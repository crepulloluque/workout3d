/**
 * Maneja el cambio entre tabs de login y registro
 */
function showTab(tab) {
  // Remover clase active de todos los botones
  document.querySelectorAll('.tab-button').forEach(btn => {
    btn.classList.remove('active');
  });

  // Remover clase active de todos los forms
  document.querySelectorAll('form').forEach(form => {
    form.classList.remove('active');
  });

  // Añadir clase active al botón clickeado
  document.querySelectorAll('.tab-button').forEach(btn => {
    if (btn.textContent.toLowerCase().includes(tab === 'login' ? 'login' : 'registro')) {
      btn.classList.add('active');
    }
  });

  // Mostrar el form correspondiente
  const activeForm = document.getElementById(tab);
  if (activeForm) {
    activeForm.classList.add('active');
  }
}

// Inicializar: mostrar login por defecto
document.addEventListener('DOMContentLoaded', () => {
  const loginForm = document.getElementById('login');
  const firstBtn = document.querySelector('.tab-button');
  
  if (loginForm && firstBtn) {
    loginForm.classList.add('active');
    firstBtn.classList.add('active');
  }

  // Permitir que los botones funcionen con click
  document.querySelectorAll('.tab-button').forEach((btn, idx) => {
    btn.onclick = (e) => {
      e.preventDefault();
      const tabName = idx === 0 ? 'login' : 'registro';
      showTab(tabName);
    };
  });
});
