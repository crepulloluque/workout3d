/**
 * Workout 3D - Store Checkout Logic
 */

function siguientePaso(paso) {
  const notify = (msg) => {
    if (window.showToast) {
      window.showToast(msg, 'error');
    } else {
      alert(msg);
    }
  };

  if (paso === 2) {
    const camposEnvio = ['nombre', 'apellidos', 'telefono', 'direccion', 'pais', 'provincia', 'codigo_postal', 'tipo_entrega'];
    for (let campo of camposEnvio) {
      const el = document.getElementById(campo);
      if (!el || !el.value.trim()) {
        notify('⚠️ Por favor, completa todos los campos de envío.');
        el?.focus();
        return;
      }
    }
  }

  if (paso === 3) {
    const metodo = document.getElementById('metodo_pago').value;
    if (!metodo) {
      notify('⚠️ Debes seleccionar un método de pago.');
      return;
    }

    if (metodo === 'tarjeta') {
      const num = document.getElementById('num_tarjeta').value.trim();
      const mes = document.getElementById('exp_mes').value.trim();
      const anio = document.getElementById('exp_anio').value.trim();
      const cvv = document.getElementById('cvv').value.trim();

      if (num.length !== 16 || !/^[0-9]+$/.test(num)) {
        notify('⚠️ El número de tarjeta debe tener 16 dígitos.');
        return;
      }
      if (!/^(0[1-9]|1[0-2])$/.test(mes) || !/^[0-9]{2}$/.test(anio)) {
        notify('⚠️ Fecha de expiración inválida.');
        return;
      }
      if (cvv.length !== 3 || !/^[0-9]+$/.test(cvv)) {
        notify('⚠️ El CVV debe tener 3 dígitos.');
        return;
      }
    } else if (metodo === 'bizum') {
      const bizumNum = document.getElementById('bizum_numero').value.trim();
      if (bizumNum.length !== 9 || !/^[0-9]+$/.test(bizumNum)) {
        notify('⚠️ El número de Bizum debe tener 9 dígitos.');
        return;
      }
    }

    // Mapping values to hidden inputs for final submission
    const mapping = {
      'nombre': 'input_nombre',
      'apellidos': 'input_apellidos',
      'telefono': 'input_telefono',
      'direccion': 'input_direccion',
      'pais': 'input_pais',
      'provincia': 'input_provincia',
      'codigo_postal': 'input_codigo_postal',
      'tipo_entrega': 'input_tipo_entrega'
    };

    for (let [source, target] of Object.entries(mapping)) {
      const sEl = document.getElementById(source);
      const tEl = document.getElementById(target);
      if (sEl && tEl) tEl.value = sEl.value;
    }

    const mEl = document.getElementById('input_metodo_pago');
    if (mEl) mEl.value = metodo;
  }

  // Step switching logic
  document.querySelectorAll('.step').forEach((s, i) => s.classList.toggle('active', i === paso - 1));
  document.querySelectorAll('.checkout-form-section').forEach(f => f.classList.remove('active'));

  const sections = ['form-envio', 'form-pago', 'form-finalizar'];
  const activeSection = document.getElementById(sections[paso - 1]);
  if (activeSection) {
    activeSection.classList.add('active');
    window.scrollTo({ top: 0, behavior: 'smooth' });
  }
}

function mostrarPago() {
  const divs = ['pago-tarjeta', 'pago-bizum', 'pago-paypal'];
  divs.forEach(id => {
    const el = document.getElementById(id);
    if (el) el.style.display = 'none';
  });

  const metodo = document.getElementById('metodo_pago').value;
  const target = document.getElementById(`pago-${metodo}`);
  if (target) {
    target.style.display = 'block';
    target.classList.add('animate-fadeIn');
  }
}

document.addEventListener('DOMContentLoaded', () => {
  const paySelect = document.getElementById('metodo_pago');
  if (paySelect) {
    paySelect.addEventListener('change', mostrarPago);
  }
});
