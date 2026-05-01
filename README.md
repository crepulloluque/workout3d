# 🏋️ WORKOUT 3D

Aplicación Web de Fitness con Modelos 3D interactivos

[![Laravel](https://img.shields.io/badge/Laravel-12-red.svg)](https://laravel.com)
[![License](https://img.shields.io/badge/license-MIT-blue.svg)](LICENSE)
[![Status](https://img.shields.io/badge/status-Production--Ready-brightgreen.svg)](https://github.com/crepulloluque/Workout3D)

---

## 📋 Descripción

**Workout 3D** es una aplicación web moderna de fitness que combina tecnología 3D con gestión completa de rutinas de ejercicio. Los usuarios pueden explorar grupos musculares mediante modelos 3D interactivos, crear rutinas personalizadas, hacer seguimiento de su progreso y comprar suplementos en la tienda integrada.

### ✨ Características Principales

- 🎯 **Modelos 3D Interactivos**: Visualiza 7 grupos musculares en 3D
- 💪 **84 Ejercicios**: 12 ejercicios por cada grupo muscular con videos
- 📊 **Seguimiento de Progreso**: Registra peso, grasa corporal y masa muscular
- 🏃 **Rutinas Personalizadas**: Crea y gestiona tus propias rutinas
- 🛒 **Tienda de Suplementos**: 14 productos disponibles con carrito de compras
- 🔐 **Autenticación Completa**: Login con email, Google y GitHub OAuth
- 👨‍💼 **Panel Admin**: Gestión completa de usuarios, ejercicios y productos
- 📈 **Gráficos y Estadísticas**: Visualiza tu progreso con Chart.js
- 🧮 **3 Calculadoras Integradas**: Grasa corporal, IMC y riesgo cardiometabólico

---

## 🚀 Tecnologías

- **Backend**: Laravel 12
- **Frontend**: Blade Templates + Vanilla JavaScript
- **Bundler**: Vite
- **Base de Datos**: SQLite (MySQL compatible)
- **3D Rendering**: Model-Viewer Web Component
- **Gráficos**: Chart.js
- **Autenticación**: Laravel Socialite (OAuth)
- **Estilos**: CSS personalizado con animaciones

---

## 📦 Instalación

### Requisitos Previos

- PHP 8.1+
- Composer
- Node.js & npm
- Laragon (recomendado) o cualquier servidor local

### Pasos de Instalación

1. **Clonar el repositorio**
```bash
git clone https://github.com/crepulloluque/Workout3D.git
cd Workout3D
```

2. **Instalar dependencias PHP**
```bash
composer install
```

3. **Instalar dependencias JavaScript**
```bash
npm install
```

4. **Configurar variables de entorno**
```bash
cp .env.example .env
php artisan key:generate
```

5. **Configurar base de datos**
```bash
# Edita .env y configura tu base de datos
php artisan migrate:fresh --seed
```

6. **Compilar assets**
```bash
npm run dev
```

7. **Iniciar servidor**
```bash
# Con Laragon: Solo hacer clic en "Start All"
# O con Artisan:
php artisan serve
```

8. **Acceder a la aplicación**
- Frontend: http://localhost/workout3d o http://localhost:8000
- Admin: http://localhost/workout3d/admin/login

---

## 🔐 Credenciales

### Administrador
- **Usuario**: admin
- **Contraseña**: admin123
- **URL**: `/admin/login`

### Usuario Normal
- Crear cuenta en `/auth` o usar OAuth (Google/GitHub)

---

## 📱 Funcionalidades

### Página de Inicio
- Modelo 3D del cuerpo humano completo
- 7 botones de acceso rápido a grupos musculares
- Tienda con productos destacados
- Calculadora de grasa corporal (Jackson-Pollock)
- Gráfico de progreso de peso
- Modal flotante de gestión de rutinas

### Páginas de Músculos
- Modelos 3D específicos por grupo muscular
- 12 ejercicios por página con videos de YouTube
- Buscador en tiempo real
- Paginación funcional
- Descripción y nivel de dificultad

### Sistema de Rutinas
- Crear rutinas personalizadas
- Editar rutinas existentes
- Agregar/eliminar ejercicios
- Modo entrenamiento con seguimiento
- Exportar rutinas a PDF ✅

### Progreso
- Registro de peso, grasa y masa muscular
- Comparador antes/después con gráficos
- Historial completo en tabla
- Eliminar registros individuales

### Tienda
- Catálogo de 14 suplementos
- Carrito de compras funcional
- Checkout seguro
- Historial de compras

### Panel Admin
- Dashboard con estadísticas
- CRUD de ejercicios, usuarios, productos
- Gestión de pedidos y rutinas
- Gráficos con Chart.js

---

## 🎨 Diseño

### Paleta de Colores
- **Fondo**: `#071017` (Dark Blue Navy)
- **Primario**: `#00b4d8` (Cyan Blue)
- **Secundario**: `#1CAAD9` (Light Blue)
- **Peligro**: `#E63946` (Red)
- **Éxito**: `#2ec286` (Green)

### Animaciones
- fadeInUp, slideInLeft/Right
- float, glow, pulse
- shimmer, ripple effects

---

## 📊 Estadísticas del Proyecto

- **19** Controladores PHP
- **36** Vistas Blade
- **15** Archivos CSS
- **5** Archivos JavaScript
- **~30,000** Líneas de código total
- **84** Ejercicios en base de datos
- **14** Productos en tienda
- **7** Grupos musculares con modelos 3D

---

## 🔄 Próximas Mejoras

### Prioridad Alta
- [ ] Recuperación de contraseña
- [ ] Verificación de email con OTP
- [ ] Fotos de progreso (galería antes/después)
- [ ] Notificaciones por email

### Prioridad Media
- [ ] Retos de 30 días (gamificación)
- [ ] Compartir rutinas con código único
- [ ] Sistema de logros y badges
- [ ] Modo "Entreno Activo" con timer

### Prioridad Baja
- [ ] Chat/comunidad entre usuarios
- [ ] App móvil (React Native/Flutter)
- [ ] Integración con wearables
- [ ] Sistema de recomendaciones con IA

---

## 🤝 Contribuir

Las contribuciones son bienvenidas. Si deseas contribuir:

1. Fork el proyecto
2. Crea una rama para tu feature (`git checkout -b feature/AmazingFeature`)
3. Commit tus cambios (`git commit -m 'Add some AmazingFeature'`)
4. Push a la rama (`git push origin feature/AmazingFeature`)
5. Abre un Pull Request

---

## 📄 Licencia

Este proyecto está bajo la Licencia MIT. Ver el archivo `LICENSE` para más detalles.

---

## 📞 Contacto

**Desarrollador**: Carlos Repullo Luque  
**GitHub**: [@crepulloluque](https://github.com/crepulloluque)  
**Repositorio**: [Workout3D](https://github.com/crepulloluque/Workout3D)

---

## 💡 Comandos Útiles

```bash
# Recargar base de datos
php artisan migrate:fresh --seed

# Limpiar cachés
php artisan optimize:clear

# Compilar assets (producción)
npm run build

# Ver logs
tail -f storage/logs/laravel.log

# Cachear rutas
php artisan route:cache

# Cachear config
php artisan config:cache
```

---

## 🎉 Agradecimientos

- [Laravel](https://laravel.com) - Framework PHP
- [Model-Viewer](https://modelviewer.dev) - Visor 3D
- [Chart.js](https://www.chartjs.org) - Gráficos
- [Sketchfab](https://sketchfab.com) - Modelos 3D
- Comunidad de Laravel

---

<p align="center">
  <strong>💪 ¡Construido con pasión por el fitness y la tecnología!</strong>
</p>
