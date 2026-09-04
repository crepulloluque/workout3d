# 🏋️ WORKOUT 3D

Aplicación Web de Fitness con Modelos 3D interactivos

[![Laravel](https://img.shields.io/badge/Laravel-12-red.svg)](https://laravel.com)
[![License](https://img.shields.io/badge/license-MIT-blue.svg)](LICENSE)
[![Status](https://img.shields.io/badge/status-Production--Ready-brightgreen.svg)](https://github.com/crepulloluque/Workout3D)

---

## 📋 Descripción

**Workout 3D** es una aplicación web moderna de fitness que combina tecnología 3D con gestión completa de rutinas de ejercicio. Los usuarios pueden explorar grupos musculares mediante modelos 3D interactivos, crear rutinas personalizadas, hacer seguimiento de su progreso y comprar suplementos en la tienda integrada.

### ✨ Características Principales

- 🎯 **Modelos 3D Interactivos**: Visualiza 7 grupos musculares en 3D con rotación 360° y modo AR
- 💪 **84 Ejercicios**: 12 ejercicios por cada grupo muscular con vídeos de YouTube
- 📊 **Seguimiento de Progreso**: Registra peso, grasa corporal y masa muscular con gráficos históricos
- 🏃 **Rutinas Personalizadas**: Crea y gestiona tus propias rutinas por día de la semana
- 🛒 **Tienda de Suplementos**: 14 productos disponibles con carrito de compras y checkout
- 🔐 **Autenticación Completa**: Login con email/contraseña, Google y GitHub (OAuth 2.0)
- 👨‍💼 **Panel Admin**: Gestión completa de usuarios, ejercicios y productos con sesión independiente
- 📈 **Gráficos y Estadísticas**: Visualiza tu progreso con Chart.js
- 🧮 **Calculadoras de Salud**: Grasa corporal (Jackson-Pollock) y riesgo cardiometabólico

---

## 🚀 Tecnologías

- **Backend**: Laravel 12 (PHP 8.2+)
- **Frontend**: Blade Templates + Vanilla JavaScript (ES6+)
- **Bundler**: Vite 5
- **Base de Datos**: MySQL 8.0
- **3D Rendering**: Model-Viewer (Google) + Sketchfab Embed API
- **Gráficos**: Chart.js
- **Autenticación OAuth**: Laravel Socialite (Google + GitHub)
- **Estilos**: CSS personalizado con variables globales y animaciones
- **Entorno de desarrollo**: Laragon (Apache + PHP + MySQL)

---

## 📦 Instalación

### Requisitos Previos

- PHP 8.2+
- Composer >= 2.6
- Node.js >= 18.x y npm
- MySQL 8.0
- Laragon (recomendado) o cualquier servidor local con Apache/Nginx

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

5. **Configurar base de datos en `.env`**
```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=musculosdb
DB_USERNAME=root
DB_PASSWORD=
```

6. **Crear la base de datos y ejecutar migraciones + seeders**
```bash
# Crea la base de datos primero en MySQL:
# CREATE DATABASE musculosdb CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;

php artisan migrate:fresh --seed
```

7. **Compilar assets**
```bash
npm run dev
# Para producción: npm run build
```

8. **Iniciar servidor**
```bash
# Con Laragon: clic en "Start All" y acceder a http://localhost/workout3d
# O con Artisan:
php artisan serve
```

9. **Acceder a la aplicación**
   - Frontend: `http://localhost/workout3d` o `http://localhost:8000`
   - Panel admin: `http://localhost/workout3d/admin/login`

---

## 🔐 Credenciales de demo

> ⚠️ Estas credenciales son exclusivamente para entorno de desarrollo/demo. Cámbialas antes de cualquier despliegue en producción.

### Administrador
- **Usuario**: `admin`
- **Contraseña**: `admin123`
- **URL**: `/admin/login`
- Cambiar contraseña:
cd c:\laragon\www\workout3d
php artisan tinker

Dentro de Tinker:
use Illuminate\Support\Facades\Hash;
echo Hash::make('admin123');

DB:
UPDATE administradores
SET password = '$2y$12$TuHashGeneradoAqui'
WHERE usuario = 'admin';

### Usuario Normal
- Crear cuenta en `/auth` o usar OAuth (Google/GitHub)

---

## 📱 Funcionalidades

### Página de Inicio
- Modelo 3D del cuerpo humano completo (GLTF + Model Viewer)
- 7 botones de acceso rápido a grupos musculares
- Tienda con 4 productos destacados
- Calculadora de grasa corporal (Jackson-Pollock)
- Gráfico de evolución de peso (últimos 7 días)
- Modal flotante de gestión de rutinas

### Páginas de Músculos
- Modelos 3D específicos por grupo muscular (Sketchfab Embed)
- 12 ejercicios por página con vídeos de YouTube integrados
- Buscador en tiempo real
- Paginación funcional (3 páginas × 4 ejercicios)
- Descripción y nivel de dificultad por ejercicio

### Sistema de Rutinas
- Crear rutinas personalizadas (nombre + día de la semana)
- Editar rutinas: añadir/eliminar ejercicios, configurar series y repeticiones
- Eliminar rutinas con modal de confirmación
- Timer de descanso automático al completar series
- Modal de acceso rápido desde el inicio

### Progreso
- Registro diario de peso, grasa corporal y masa muscular
- IMC calculado automáticamente desde los datos del perfil
- Comparador antes/después con gráficos históricos (Chart.js)
- Estadísticas automáticas: peso total levantado y músculo más entrenado
- Historial completo con eliminación de registros individuales

### Tienda
- Catálogo de 14 suplementos en 4 categorías (Proteínas, Creatina, Vitaminas, Accesorios)
- Carrito de compras gestionado con sesiones PHP
- Checkout con datos de envío y 3 métodos de pago (Tarjeta, Bizum, PayPal)
- Historial de pedidos paginado con detalle de productos

### Panel Admin
- Dashboard con estadísticas globales (usuarios, productos, ingresos)
- CRUD completo de ejercicios, productos y usuarios
- Gestión de pedidos y rutinas de usuarios
- Sesión de administrador independiente a la sesión de usuario

---

## 🎨 Diseño

### Paleta de Colores
- **Fondo**: `#071017` (Dark Blue Navy)
- **Primario**: `#00b4d8` (Cyan Blue)
- **Secundario**: `#1CAAD9` (Light Blue)
- **Peligro**: `#E63946` (Red)
- **Éxito**: `#2ec286` (Green)
- **Muted**: `#9aa7b0` (Gray)

### Tipografía
- **Títulos**: Oswald 700
- **Cuerpo**: Lato 400/600
- **Datos**: Roboto 400/500

### Animaciones
- fadeInUp, slideInLeft/Right
- float, glow, pulse
- shimmer, ripple effects

### Responsividad
- Desktop (> 1000px): layout de dos columnas
- Tablet (≤ 1000px): layout de una columna
- Mobile: ajustes de padding y tipografía

---

## 📊 Estadísticas del Proyecto

- **19** Controladores PHP
- **36** Vistas Blade
- **15** Archivos CSS personalizados
- **5** Archivos JavaScript
- **10** Migraciones de base de datos
- **~30.000** Líneas de código total
- **84** Ejercicios en base de datos (12 por músculo)
- **14** Productos en tienda
- **7** Grupos musculares con modelos 3D

---

## 🔄 Próximas Mejoras

### Prioridad Alta
- [ ] Recuperación de contraseña olvidada
- [ ] Verificación de email con código OTP
- [ ] Notificaciones por email (confirmación de registro y pedidos)
- [ ] Exportar rutinas a PDF

### Prioridad Media
- [ ] Fotos de progreso (galería antes/después)
- [ ] Retos de entrenamiento de 30 días (gamificación)
- [ ] Compartir rutinas con código único
- [ ] Sistema de logros y badges

### Prioridad Baja
- [ ] Chat/comunidad entre usuarios
- [ ] Aplicación móvil nativa (React Native o Flutter)
- [ ] Integración con wearables (Fitbit, Apple Watch)
- [ ] Sistema de recomendaciones con IA

---

## 🐛 Problemas conocidos resueltos

| Problema | Solución aplicada |
|---|---|
| Timer de descanso se duplicaba al marcar series | `clearInterval()` antes de inicializar + validación de existencia previa |
| Modelos 3D no cargaban con rutas locales | Migración a Sketchfab Embed con URLs externas + lazy loading |
| Historial de entrenamiento no se actualizaba | Query con `MAX(fecha_finalizacion)` agrupando por `ejercicio_id` |
| Selectores invisibles en tema oscuro | CSS global: `select option { background: #1a1a2e; color: #fff; }` |
| OAuth GitHub falla si el email es privado | Pendiente de resolver — ver issue abierto |

---

## 💡 Comandos Útiles

```bash
# Recargar base de datos con datos de prueba
php artisan migrate:fresh --seed

# Limpiar cachés
php artisan optimize:clear

# Compilar assets (producción)
npm run build

# Ver logs en tiempo real
tail -f storage/logs/laravel.log

# Cachear rutas y configuración (producción)
php artisan route:cache
php artisan config:cache

# Optimizar autoload
composer dump-autoload -o
```

---

## 🤝 Contribuir

Las contribuciones son bienvenidas. Si deseas contribuir:

1. Fork el proyecto
2. Crea una rama para tu feature (`git checkout -b feature/NuevaFuncionalidad`)
3. Commit tus cambios (`git commit -m 'Add: descripción del cambio'`)
4. Push a la rama (`git push origin feature/NuevaFuncionalidad`)
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

## 🎉 Agradecimientos

- [Laravel](https://laravel.com) — Framework PHP
- [Model-Viewer](https://modelviewer.dev) — Visor 3D en web
- [Chart.js](https://www.chartjs.org) — Gráficos interactivos
- [Sketchfab](https://sketchfab.com) — Modelos 3D anatómicos
- [Laravel Socialite](https://laravel.com/docs/socialite) — OAuth 2.0

---

<p align="center">
  <strong>💪 Proyecto Integrado · 2º DAW · ITEC · Curso 2024–2026</strong>
</p>
