/**
 * Workout 3D - Main Frontend Logic
 */

const onReady = (fn) => {
  if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', fn);
  } else {
    fn();
  }
};

onReady(() => {
  // Utility references
  const $ = selector => document.querySelector(selector);
  const $$ = selector => document.querySelectorAll(selector);

  // --- NAVIGATION HIGHLIGHTING ---
  const currentPath = window.location.pathname;
  $$('.nav-links a').forEach(link => {
    if (link.getAttribute('href') === currentPath) {
      link.classList.add('active');
    }
  });

  // --- SOCIAL SHARING ---
  window.compartir = (plataforma) => {
    const url = window.location.href;
    const text = "¡Mira mi progreso en Workout 3D! La mejor plataforma fitness.";
    const shareLinks = {
      twitter: `https://twitter.com/intent/tweet?url=${encodeURIComponent(url)}&text=${encodeURIComponent(text)}`,
      facebook: `https://www.facebook.com/sharer/sharer.php?u=${encodeURIComponent(url)}`,
      whatsapp: `https://api.whatsapp.com/send?text=${encodeURIComponent(text + " " + url)}`
    };

    if (shareLinks[plataforma]) {
      window.open(shareLinks[plataforma], '_blank', 'width=600,height=400');
    }
  };

  // --- MODAL SYSTEN ---
  const modal = $('#modalRutinas');
  const btnRutinas = $('#btnRutinas');
  const modalClose = $('#modalClose');

  const toggleModal = (show) => {
    if (!modal) return;
    if (show) {
      modal.style.display = 'flex';
      setTimeout(() => modal.classList.add('active'), 10);
      document.body.style.overflow = 'hidden';
    } else {
      modal.classList.remove('active');
      setTimeout(() => {
        modal.style.display = 'none';
        document.body.style.overflow = '';
      }, 300);
    }
  };

  btnRutinas?.addEventListener('click', () => toggleModal(true));
  modalClose?.addEventListener('click', () => toggleModal(false));
  window.addEventListener('click', (e) => { if (e.target === modal) toggleModal(false); });

  // --- BODY FAT CALCULATOR ---
  const calcGrasa = () => {
    const sexo = $('#sexo')?.value;
    const edad = parseFloat($('#edad')?.value);
    const peso = parseFloat($('#peso')?.value);
    const altura = parseFloat($('#altura')?.value);
    const resultDiv = $('#resultadoGrasa');
    if (!resultDiv) return;

    if (!sexo || !edad || !peso || !altura || edad <= 0 || peso <= 0 || altura <= 0) {
      resultDiv.innerHTML = `
        <div class="resultado-box animate-fadeIn">
          <div class="result-item">Completa todos los campos para calcular el porcentaje de grasa.</div>
        </div>
      `;
      resultDiv.style.display = 'block';
      window.showToast?.('⚠️ Por favor, rellena todos los campos correctamente.', 'error');
      return;
    }

    const imc = peso / Math.pow(altura / 100, 2);
    const factorSexo = (sexo === 'hombre' ? 10.8 : 0);
    const grasa = (1.20 * imc) + (0.23 * edad) - factorSexo - 5.4;

    const getCategoria = (g, s) => {
      const limits = s === 'hombre' ? [6, 14, 18, 25] : [14, 21, 25, 32];
      const cats = ['Esencial', 'Atleta', 'Fitness', 'Promedio', 'Alto'];
      for (let i = 0; i < limits.length; i++) {
        if (g < limits[i]) return cats[i];
      }
      return cats[cats.length - 1];
    };

    resultDiv.innerHTML = `
            <div class="resultado-box animate-fadeIn">
                <div class="result-item">IMC: <strong>${imc.toFixed(1)}</strong></div>
                <div class="result-item">Grasa estimada: <strong>${grasa.toFixed(1)}%</strong></div>
                <div class="result-item">Categoría: <span class="badge">${getCategoria(grasa, sexo)}</span></div>
            </div>
        `;
    resultDiv.style.display = 'block';
  };

  $('#calcularGrasa')?.addEventListener('click', (e) => {
    e.preventDefault();
    calcGrasa();
  });

  // --- CARDIOMETABOLIC RISK CALCULATOR ---
  const calcRiesgo = () => {
    const cintura = parseFloat($('#cintura')?.value);
    const presion = parseFloat($('#presion')?.value);
    const glucosa = parseFloat($('#glucosa')?.value);
    const resultDiv = $('#resultadoRiesgo');
    if (!resultDiv) return;

    if (isNaN(cintura) || isNaN(presion) || isNaN(glucosa)) {
      resultDiv.innerHTML = `
        <div class="resultado-box animate-fadeIn">
          <div class="result-item">Completa cintura, presion y glucosa para ver tu nivel de riesgo.</div>
        </div>
      `;
      resultDiv.style.display = 'block';
      window.showToast?.('⚠️ Por favor, rellena los datos de riesgo.', 'error');
      return;
    }

    let score = 0;
    if (cintura > 94) score += (cintura > 102 ? 2 : 1);
    if (presion > 130) score += (presion > 140 ? 2 : 1);
    if (glucosa > 100) score += (glucosa > 126 ? 2 : 1);

    const riskLevels = ['Bajo', 'Moderado', 'Alto'];
    const level = score <= 2 ? 0 : (score <= 4 ? 1 : 2);
    const riskClass = ['risk-low', 'risk-med', 'risk-high'];

    resultDiv.innerHTML = `
            <div class="resultado-box animate-fadeIn">
                <div class="result-item">Puntuación: <strong>${score}/6</strong></div>
                <div class="result-item">Nivel de Riesgo: <strong class="${riskClass[level]}">${riskLevels[level]}</strong></div>
            </div>
        `;
    resultDiv.style.display = 'block';
  };

  $('#calcularRiesgo')?.addEventListener('click', (e) => {
    e.preventDefault();
    calcRiesgo();
  });

  // --- UI AUTO-COMMANDS ---
  const urlParams = new URLSearchParams(window.location.search);
  if (urlParams.has('rutina_creada')) {
    setTimeout(() => toggleModal(true), 600);
    window.showToast?.('✅ ¡Tu rutina ha sido creada!', 'success');
  }

  if (urlParams.get('msg') === 'login_requerido') {
    window.showToast?.('🔐 Por favor, inicia sesión para acceder.', 'info');
  }
});
