<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MusculosDbSeeder extends Seeder
{
    public function run(): void
    {
        // ===== DESACTIVAR FOREIGN KEYS TEMPORALMENTE =====
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');

        // ===== PRODUCTOS (SIEMPRE VACIAR Y RELLENAR) =====
        DB::table('productos')->truncate();

        DB::table('productos')->insert([
            ['nombre' => 'Creatina Monohidratada 500g', 'descripcion' => 'Mejora la fuerza y el rendimiento muscular durante el entrenamiento.', 'precio' => 24.99, 'imagen_url' => 'https://www.hsnstore.com/media/catalog/product/c/r/creatine-creapure-excell-powder-hsn_1.jpg', 'categoria' => 'Creatina', 'created_at' => now(), 'updated_at' => now()],
            ['nombre' => 'Proteína Whey 1kg', 'descripcion' => 'Suplemento de proteína de suero ideal para el crecimiento muscular.', 'precio' => 32.50, 'imagen_url' => 'https://www.hsnstore.com/media/catalog/product/e/v/evowhey-gral-new-front-hsn_1.webp', 'categoria' => 'Proteína', 'created_at' => now(), 'updated_at' => now()],
            ['nombre' => 'BCAA + Glutamina', 'descripcion' => 'Aminoácidos esenciales para la recuperación y mantenimiento muscular.', 'precio' => 18.90, 'imagen_url' => 'https://www.hsnstore.com/media/catalog/product/e/v/evobcaa-powder-hsn_1.jpg', 'categoria' => 'Vitaminas', 'created_at' => now(), 'updated_at' => now()],
            ['nombre' => 'Pro Shaker', 'descripcion' => 'Shaker de alta calidad con bola mezcladora y cierre hermético.', 'precio' => 9.99, 'imagen_url' => 'https://www.hsnstore.com/media/catalog/product/p/r/pro-shaker-hsn-we-are-nutrition-bola-mezcladora-400ml-verde-lima-7-hsn_1_1.webp', 'categoria' => 'Accesorios', 'created_at' => now(), 'updated_at' => now()],
            ['nombre' => 'Pre-Entreno Explosivo', 'descripcion' => 'Aumenta tu energía y concentración para entrenamientos intensos.', 'precio' => 22.50, 'imagen_url' => 'https://www.myprotein.es/images?url=https://static.thcdn.com/productimg/original/14269806-3455129203332345.jpg&format=webp&auto=avif&crop=1100,1200,smart', 'categoria' => 'Vitaminas', 'created_at' => now(), 'updated_at' => now()],
            ['nombre' => 'Multivitamínico Diario', 'descripcion' => 'Complejo vitamínico para apoyar la salud general y el bienestar.', 'precio' => 15.75, 'imagen_url' => 'https://www.hsnstore.com/media/catalog/product/e/v/evovits-gral-veg-caps-front-hsn_1.webp', 'categoria' => 'Vitaminas', 'created_at' => now(), 'updated_at' => now()],
            ['nombre' => 'Creatina Micronizada', 'descripcion' => 'Creatina pura micronizada para mejor absorción y rendimiento.', 'precio' => 16.99, 'imagen_url' => 'https://www.myprotein.es/images?url=https://static.thcdn.com/productimg/original/10574930-2114860399336489.jpg&format=webp&auto=avif&crop=1100,1200,smart', 'categoria' => 'Creatina', 'created_at' => now(), 'updated_at' => now()],
            ['nombre' => 'Omega 3 1000mg', 'descripcion' => 'Ácidos grasos omega-3 para salud cardiovascular y articulaciones.', 'precio' => 12.99, 'imagen_url' => 'https://www.myprotein.es/images?url=https://static.thcdn.com/productimg/original/10529329-5784860398509689.jpg&format=webp&auto=avif&crop=1100,1200,smart', 'categoria' => 'Vitaminas', 'created_at' => now(), 'updated_at' => now()],
            ['nombre' => 'L-Glutamina Polvo 500g', 'descripcion' => 'Aminoácido esencial para recuperación muscular post-entrenamiento.', 'precio' => 19.99, 'imagen_url' => 'https://www.myprotein.es/images?url=https://static.thcdn.com/productimg/original/10636931-1495183632332726.jpg&format=webp&auto=avif&crop=1100,1200,smart', 'categoria' => 'Vitaminas', 'created_at' => now(), 'updated_at' => now()],
            ['nombre' => 'ZMA Mineral Complex', 'descripcion' => 'Zinc, magnesio y vitamina B6 para recuperación y descanso.', 'precio' => 11.99, 'imagen_url' => 'https://www.myprotein.es/images?url=https://static.thcdn.com/productimg/original/10529452-5084907332039314.jpg&format=webp&auto=avif&crop=1100,1200,smart', 'categoria' => 'Vitaminas', 'created_at' => now(), 'updated_at' => now()],
            ['nombre' => 'Bandas Elásticas Set', 'descripcion' => 'Set completo de bandas elásticas para entrenamiento en casa.', 'precio' => 13.99, 'imagen_url' => 'https://www.myprotein.es/images?url=https://static.thcdn.com/productimg/original/14704752-8515118375029985.jpg&format=webp&auto=avif&crop=1100,1200,smart', 'categoria' => 'Accesorios', 'created_at' => now(), 'updated_at' => now()],
            ['nombre' => 'Caseína Micelar', 'descripcion' => 'Proteína de absorción lenta ideal para recuperación nocturna.', 'precio' => 26.99, 'imagen_url' => 'https://www.myprotein.es/images?url=https://static.thcdn.com/productimg/original/10798909-1695183632470828.jpg&format=webp&auto=avif&crop=1100,1200,smart', 'categoria' => 'Proteína', 'created_at' => now(), 'updated_at' => now()],
            ['nombre' => 'Vitamina C 1000mg', 'descripcion' => 'Vitamina C de alta potencia para reforzar el sistema inmune.', 'precio' => 8.99, 'imagen_url' => 'https://www.solgar.es/media/catalog/product/cache/841564aa151c7256e353391159214053/0/0/00033984032804_sg.vit_c.1000.mg.100.cap.jpg', 'categoria' => 'Vitaminas', 'created_at' => now(), 'updated_at' => now()],
            ['nombre' => 'Complejo Hierro + C', 'descripcion' => 'Hierro biodisponible con vitamina C para máxima absorción.', 'precio' => 10.99, 'imagen_url' => 'https://www.myprotein.es/images?url=https://static.thcdn.com/productimg/original/11214984-4854904415865563.jpg&format=webp&auto=avif&crop=1100,1200,smart', 'categoria' => 'Vitaminas', 'created_at' => now(), 'updated_at' => now()],
        ]);

        // ===== REACTIVAR FOREIGN KEYS =====
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        // Administrador
        if (!DB::table('administradores')->where('usuario', 'admin')->exists()) {
            DB::table('administradores')->insert([
                'usuario' => 'admin',
                'password' => '$2y$12$cI9TzdZDSdasbNykrc6sReClfckiu76VtKn6ZmX6Pb7joQOaJNBze',
            ]);
        }

        // ===== MÚSCULOS =====
        if (DB::table('musculos')->count() === 0) {
            DB::table('musculos')->insert([
                ['nombre' => 'Bíceps', 'modelo_3d_url' => 'https://sketchfab.com/models/91cf45e3cf8b490f96caa34d994c545b/embed', 'descripcion' => 'Músculo del brazo encargado de la flexión del codo.'],
                ['nombre' => 'Pecho', 'modelo_3d_url' => 'https://sketchfab.com/models/65e1a062661f4af89bad2822cd3dbb08/embed', 'descripcion' => 'Músculo principal de la parte superior del torso.'],
                ['nombre' => 'Abdomen', 'modelo_3d_url' => 'https://sketchfab.com/models/a6831716a15540d1889efb57305572f8/embed', 'descripcion' => 'Músculos encargados de la flexión del tronco y estabilidad del core.'],
                ['nombre' => 'Espalda', 'modelo_3d_url' => '---', 'descripcion' => 'Dorsal ancho y trapecio para tracción y estabilidad.'],
                ['nombre' => 'Tríceps', 'modelo_3d_url' => 'https://sketchfab.com/models/1f23b4ee5a1f4703b15a939412837638/embed', 'descripcion' => 'Músculo del brazo posterior para extensión del codo.'],
                ['nombre' => 'Piernas', 'modelo_3d_url' => 'https://sketchfab.com/models/91cbf0093e094a0e9df0d73636dfface/embed', 'descripcion' => 'Cuádriceps, isquiotibiales y glúteos para potencia y resistencia.'],
                ['nombre' => 'Hombros', 'modelo_3d_url' => '---', 'descripcion' => 'Deltoides anterior, lateral y posterior para movilidad.'],
            ]);
        }

        // ===== EJERCICIOS (12 por músculo para 3 páginas de 4) =====
        if (DB::table('ejercicios')->count() === 0) {
            DB::table('ejercicios')->insert([
                // ===== BÍCEPS =====
                ['musculo_id' => 1, 'nombre' => 'Curl con Barra', 'descripcion' => 'Ponte de pie con la barra en las manos. Mantén los codos pegados al torso. Sube la barra contrayendo el bíceps.', 'video_url' => 'https://www.youtube.com/embed/mFgTFstIfFs', 'dificultad' => 'Principiante'],
                ['musculo_id' => 1, 'nombre' => 'Curl con Mancuernas Alterno', 'descripcion' => 'Sujeta una mancuerna en cada mano. Levanta un brazo a la vez alternadamente.', 'video_url' => 'https://www.youtube.com/embed/qZaMpIcIswY', 'dificultad' => 'Principiante'],
                ['musculo_id' => 1, 'nombre' => 'Curl Martillo', 'descripcion' => 'Agarre neutro tipo martillo. Flexiona el codo y eleva la mancuerna.', 'video_url' => 'https://www.youtube.com/embed/j99intoPKGE', 'dificultad' => 'Intermedio'],
                ['musculo_id' => 1, 'nombre' => 'Curl Concentrado', 'descripcion' => 'Siéntate en un banco. Apoya el codo en el muslo y eleva la mancuerna.', 'video_url' => 'https://www.youtube.com/embed/Is3JRhq37o4', 'dificultad' => 'Avanzado'],
                ['musculo_id' => 1, 'nombre' => 'Curl en Banco Scott', 'descripcion' => 'Apoya brazos en banco inclinado. Curl aislado con máximo enfoque.', 'video_url' => 'https://www.youtube.com/embed/fIWP-FRFNU0', 'dificultad' => 'Intermedio'],
                ['musculo_id' => 1, 'nombre' => 'Curl con Polea Baja', 'descripcion' => 'De pie frente a polea baja. Tira del cable hacia arriba flexionando bíceps.', 'video_url' => 'https://www.youtube.com/embed/NDsbR64Z5jU?si=L_uZBz9K_qvlXGMf', 'dificultad' => 'Principiante'],
                ['musculo_id' => 1, 'nombre' => 'Curl 21s', 'descripcion' => 'Serie de 21 reps: 7 mitad inferior + 7 mitad superior + 7 completas.', 'video_url' => 'https://www.youtube.com/embed/DOat3S4alNA?si=4UlDXhhviSqB9BHo', 'dificultad' => 'Avanzado'],
                ['musculo_id' => 1, 'nombre' => 'Curl Araña', 'descripcion' => 'Tumbado boca abajo en banco inclinado con brazos colgando.', 'video_url' => 'https://www.youtube.com/embed/9zf1-_Hk23o?si=2qY9zaEZ8xZ5Lj9v&amp;start=11', 'dificultad' => 'Intermedio'],
                ['musculo_id' => 1, 'nombre' => 'Curl Inverso', 'descripcion' => 'Palmas hacia abajo, enfatiza antebrazo y bíceps braquial.', 'video_url' => 'https://www.youtube.com/embed/r70FSepsHIY?si=z0fWFZjUk3OmofKf', 'dificultad' => 'Intermedio'],
                ['musculo_id' => 1, 'nombre' => 'Curl Zottman', 'descripcion' => 'Subir con palmas hacia arriba, bajar rotando palmas hacia abajo.', 'video_url' => 'https://www.youtube.com/embed/ZrpRBgswtHs', 'dificultad' => 'Avanzado'],
                ['musculo_id' => 1, 'nombre' => 'Curl con Banda Elástica', 'descripcion' => 'Pisa banda elástica con ambos pies. Tira hacia arriba flexionando bíceps.', 'video_url' => 'https://www.youtube.com/embed/JgGYyML2DLg?si=JCkq539gm73MIOS1&amp', 'dificultad' => 'Principiante'],
                ['musculo_id' => 1, 'nombre' => 'Curl Predicador Unilateral', 'descripcion' => 'Un brazo en banco Scott para máxima concentración en el bíceps.', 'video_url' => 'https://www.youtube.com/embed/9eMb1AfMafM?si=y0PpoBmCpFCgkInw&amp', 'dificultad' => 'Intermedio'],

                // ===== PECHO =====
                ['musculo_id' => 2, 'nombre' => 'Press de Banca', 'descripcion' => 'Túmbate en banco plano. Baja la barra hasta el pecho y empuja hacia arriba.', 'video_url' => 'https://www.youtube.com/embed/GeLq8cMODLc', 'dificultad' => 'Intermedio'],
                ['musculo_id' => 2, 'nombre' => 'Aperturas con Mancuernas', 'descripcion' => 'En banco plano. Abre los brazos hacia los lados y vuelve al centro.', 'video_url' => 'https://www.youtube.com/embed/eozdVDA78K0', 'dificultad' => 'Intermedio'],
                ['musculo_id' => 2, 'nombre' => 'Flexiones', 'descripcion' => 'Apoya las manos en el suelo. Baja el pecho y empuja hacia arriba.', 'video_url' => 'https://www.youtube.com/embed/IODxDxX7oi4', 'dificultad' => 'Principiante'],
                ['musculo_id' => 2, 'nombre' => 'Press Inclinado', 'descripcion' => 'Banco inclinado 30-45°. Enfatiza pectoral superior.', 'video_url' => 'https://www.youtube.com/embed/0WPRqCYF4pA', 'dificultad' => 'Avanzado'],
                ['musculo_id' => 2, 'nombre' => 'Fondos en Paralelas', 'descripcion' => 'Agarra barras paralelas. Baja el cuerpo y empuja hacia arriba.', 'video_url' => 'https://www.youtube.com/embed/2z8JmcrW-As', 'dificultad' => 'Intermedio'],
                ['musculo_id' => 2, 'nombre' => 'Press con Mancuernas', 'descripcion' => 'Banco plano con mancuernas. Mayor rango de movimiento que con barra.', 'video_url' => 'https://www.youtube.com/embed/VmB1G1K7v94', 'dificultad' => 'Principiante'],
                ['musculo_id' => 2, 'nombre' => 'Cruces en Polea Alta', 'descripcion' => 'Poleas altas a los lados. Cruza los cables frente al pecho.', 'video_url' => 'https://www.youtube.com/embed/taI4XduLpTk', 'dificultad' => 'Intermedio'],
                ['musculo_id' => 2, 'nombre' => 'Press Declinado', 'descripcion' => 'Banco declinado. Empuja barra enfatizando pectoral inferior.', 'video_url' => 'https://www.youtube.com/embed/LfyQBUKR8SE', 'dificultad' => 'Avanzado'],
                ['musculo_id' => 2, 'nombre' => 'Pullover con Mancuerna', 'descripcion' => 'Tumbado perpendicular al banco. Baja mancuerna detrás de la cabeza.', 'video_url' => 'https://www.youtube.com/embed/qRhCDkJH8Ck?si=J-ZuF1_2hB99Khh8&amp', 'dificultad' => 'Intermedio'],
                ['musculo_id' => 2, 'nombre' => 'Flexiones Diamante', 'descripcion' => 'Manos juntas formando diamante. Mayor énfasis en pectoral interno.', 'video_url' => 'https://www.youtube.com/embed/J0DnG1_S92I', 'dificultad' => 'Avanzado'],
                ['musculo_id' => 2, 'nombre' => 'Press en Máquina', 'descripcion' => 'Máquina de press pectoral. Empuja hacia adelante controlando el peso.', 'video_url' => 'https://www.youtube.com/embed/xUm0BiZCWlQ', 'dificultad' => 'Principiante'],
                ['musculo_id' => 2, 'nombre' => 'Aperturas en Polea', 'descripcion' => 'Poleas a media altura. Cruza cables simulando aperturas con mancuernas.', 'video_url' => 'https://www.youtube.com/embed/6oqK95erRik?si=YMLKMToLbFzp334d&amp', 'dificultad' => 'Intermedio'],

                // ===== ABDOMEN =====
                ['musculo_id' => 3, 'nombre' => 'Crunch Abdominal', 'descripcion' => 'Túmbate boca arriba con rodillas flexionadas. Eleva el tronco.', 'video_url' => 'https://www.youtube.com/embed/p-kdPTKDgNs', 'dificultad' => 'Principiante'],
                ['musculo_id' => 3, 'nombre' => 'Plancha Frontal', 'descripcion' => 'Apoya antebrazos y puntas de pies. Mantén cuerpo recto.', 'video_url' => 'https://www.youtube.com/embed/pSHjTRCQxIw', 'dificultad' => 'Intermedio'],
                ['musculo_id' => 3, 'nombre' => 'Elevación de Piernas', 'descripcion' => 'Acostado, eleva ambas piernas hasta 90°. Baja sin tocar suelo.', 'video_url' => 'https://www.youtube.com/embed/JB2oyawG9KI', 'dificultad' => 'Intermedio'],
                ['musculo_id' => 3, 'nombre' => 'Bicicleta en el Aire', 'descripcion' => 'Túmbate boca arriba, simula pedaleo llevando codo a rodilla opuesta.', 'video_url' => 'https://www.youtube.com/embed/Iwyvozckjak', 'dificultad' => 'Avanzado'],
                ['musculo_id' => 3, 'nombre' => 'Mountain Climbers', 'descripcion' => 'Posición de plancha. Lleva rodillas al pecho alternadamente rápido.', 'video_url' => 'https://www.youtube.com/embed/nmwgirgXLYM', 'dificultad' => 'Intermedio'],
                ['musculo_id' => 3, 'nombre' => 'Russian Twist', 'descripcion' => 'Sentado con piernas elevadas. Gira el torso de lado a lado.', 'video_url' => 'https://www.youtube.com/embed/wkD8rjkodUI', 'dificultad' => 'Intermedio'],
                ['musculo_id' => 3, 'nombre' => 'Plancha Lateral', 'descripcion' => 'Apoya antebrazo y pie lateral. Mantén cuerpo recto en línea.', 'video_url' => 'https://www.youtube.com/embed/K2VljzCC16g', 'dificultad' => 'Intermedio'],
                ['musculo_id' => 3, 'nombre' => 'V-Ups', 'descripcion' => 'Tumbado completo. Eleva simultáneamente brazos y piernas formando V.', 'video_url' => 'https://www.youtube.com/embed/7UVgs18Y1P4', 'dificultad' => 'Avanzado'],
                ['musculo_id' => 3, 'nombre' => 'Dead Bug', 'descripcion' => 'Boca arriba, piernas y brazos elevados. Baja extremidades opuestas alternadamente.', 'video_url' => 'https://www.youtube.com/embed/g_BYB0R-4Ws', 'dificultad' => 'Principiante'],
                ['musculo_id' => 3, 'nombre' => 'Crunch Inverso', 'descripcion' => 'Piernas elevadas. Lleva rodillas hacia el pecho levantando cadera.', 'video_url' => 'https://www.youtube.com/embed/Rh2XQ9TOuH8?si=hxX2pA7kfYCDPo-L&amp', 'dificultad' => 'Intermedio'],
                ['musculo_id' => 3, 'nombre' => 'Plancha con Toque de Hombro', 'descripcion' => 'Posición de plancha. Toca hombro opuesto manteniendo estabilidad.', 'video_url' => 'https://www.youtube.com/embed/sou0wYVd-BM?si=B3JyVe3mNjj2wepA&amp', 'dificultad' => 'Intermedio'],
                ['musculo_id' => 3, 'nombre' => 'Hollow Hold', 'descripcion' => 'Tumbado con brazos y piernas elevados. Mantén posición de barco invertido.', 'video_url' => 'https://www.youtube.com/embed/LlDNef_Ztsc', 'dificultad' => 'Avanzado'],

                // ===== ESPALDA =====
                ['musculo_id' => 4, 'nombre' => 'Dominadas', 'descripcion' => 'Cuelga de una barra. Sube tu cuerpo hasta que la barbilla supere la barra. Baja controlado.', 'video_url' => 'https://www.youtube.com/embed/eGo4IYlbE5g', 'dificultad' => 'Avanzado'],
                ['musculo_id' => 4, 'nombre' => 'Remo con Barra', 'descripcion' => 'De pie, barra a la altura de las caderas. Tira hacia el abdomen. Baja lentamente.', 'video_url' => 'https://www.youtube.com/embed/T3N-TO4reLQ', 'dificultad' => 'Intermedio'],
                ['musculo_id' => 4, 'nombre' => 'Remo Sentado', 'descripcion' => 'Sentado en máquina de remo. Tira del manillar hacia el pecho. Extiende de forma controlada.', 'video_url' => 'https://www.youtube.com/embed/UCXxvVItLoM', 'dificultad' => 'Principiante'],
                ['musculo_id' => 4, 'nombre' => 'Peso Muerto', 'descripcion' => 'De pie, barra en el suelo. Agáchate manteniendo espalda recta. Sube con fuerza de piernas.', 'video_url' => 'https://www.youtube.com/embed/r4MzxtBKyNE', 'dificultad' => 'Avanzado'],
                ['musculo_id' => 4, 'nombre' => 'Remo con Mancuerna', 'descripcion' => 'Apoya una mano en banco. Con la otra tira mancuerna hacia la cadera.', 'video_url' => 'https://www.youtube.com/embed/roCP6wCXPqo', 'dificultad' => 'Intermedio'],
                ['musculo_id' => 4, 'nombre' => 'Jalón al Pecho', 'descripcion' => 'Sentado en máquina de jalones. Tira barra hacia el pecho contrayendo dorsales.', 'video_url' => 'https://www.youtube.com/embed/c6SZm7jawwE?si=3EoID-EKG-PXRkRV&amp', 'dificultad' => 'Principiante'],
                ['musculo_id' => 4, 'nombre' => 'Peso Muerto Rumano', 'descripcion' => 'Con barra, flexiona cadera manteniendo piernas semiflexionadas. Baja la barra y vuelve a subir.', 'video_url' => 'https://www.youtube.com/embed/jEy_czb3RKA', 'dificultad' => 'Intermedio'],
                ['musculo_id' => 4, 'nombre' => 'Encogimientos de Hombros', 'descripcion' => 'De pie con mancuernas o barra. Eleva los hombros hacia las orejas. Trabaja trapecios.', 'video_url' => 'https://www.youtube.com/embed/cJRVVxmytaM', 'dificultad' => 'Principiante'],
                ['musculo_id' => 4, 'nombre' => 'Remo en T', 'descripcion' => 'Barra anclada, de pie. Tira hacia el pecho con ambas manos.', 'video_url' => 'https://www.youtube.com/embed/j3Igk5nyZE4', 'dificultad' => 'Intermedio'],
                ['musculo_id' => 4, 'nombre' => 'Dominadas Supinas', 'descripcion' => 'Agarre inverso (palmas hacia ti). Mayor activación del dorsal inferior.', 'video_url' => 'https://www.youtube.com/embed/2xBAL-gPoEc?si=l9Zb-NY_QM1AkVOF&amp;start=7', 'dificultad' => 'Avanzado'],
                ['musculo_id' => 4, 'nombre' => 'Pullover con Polea', 'descripcion' => 'De pie frente a polea alta. Tira cable hacia abajo con brazos estirados.', 'video_url' => 'https://www.youtube.com/embed/A7R-FE6NqKg?si=w88WW4o8KUT2EEi9&amp', 'dificultad' => 'Intermedio'],
                ['musculo_id' => 4, 'nombre' => 'Remo en Polea Baja', 'descripcion' => 'Sentado en máquina. Tira del cable hacia el abdomen contrayendo omóplatos.', 'video_url' => 'https://www.youtube.com/embed/GZbfZ033f74', 'dificultad' => 'Principiante'],

                // ===== TRÍCEPS =====
                ['musculo_id' => 5, 'nombre' => 'Extensión de Tríceps con Barra', 'descripcion' => 'Tumbado en banco, barra sobre la cabeza. Flexiona los codos bajando la barra tras la cabeza.', 'video_url' => 'https://www.youtube.com/embed/nRiJVZDpdL0', 'dificultad' => 'Intermedio'],
                ['musculo_id' => 5, 'nombre' => 'Fondos entre Bancos', 'descripcion' => 'Manos en banco detrás. Baja el cuerpo flexionando los codos. Sube con fuerza.', 'video_url' => 'https://www.youtube.com/embed/0326dy_-CzM', 'dificultad' => 'Intermedio'],
                ['musculo_id' => 5, 'nombre' => 'Press Francés', 'descripcion' => 'De pie con mancuerna o barra sobre la cabeza. Flexiona codos bajando detrás de la cabeza.', 'video_url' => 'https://www.youtube.com/embed/d_KZxkY_0cM', 'dificultad' => 'Intermedio'],
                ['musculo_id' => 5, 'nombre' => 'Extensión de Tríceps con Cuerda', 'descripcion' => 'Máquina de poleas. Tira hacia abajo extendiendo los brazos. Contrae el tríceps.', 'video_url' => 'https://www.youtube.com/embed/2-LAMcpzODU', 'dificultad' => 'Principiante'],
                ['musculo_id' => 5, 'nombre' => 'Patada de Tríceps', 'descripcion' => 'Inclinado con mancuerna. Extiende el brazo hacia atrás manteniendo codo fijo.', 'video_url' => 'https://www.youtube.com/embed/6SS6K3lAwZ8', 'dificultad' => 'Intermedio'],
                ['musculo_id' => 5, 'nombre' => 'Press Cerrado', 'descripcion' => 'Press de banca con agarre estrecho. Mayor énfasis en tríceps.', 'video_url' => 'https://www.youtube.com/embed/oFWbsmfSR-o?si=D2G0LevbfOZQQ4IX&amp', 'dificultad' => 'Intermedio'],
                ['musculo_id' => 5, 'nombre' => 'Extensión Overhead con Mancuerna', 'descripcion' => 'De pie, mancuerna sobre la cabeza con ambas manos. Baja detrás de la cabeza.', 'video_url' => 'https://www.youtube.com/embed/YbX7Wd8jQ-Q', 'dificultad' => 'Principiante'],
                ['musculo_id' => 5, 'nombre' => 'Flexiones Diamante', 'descripcion' => 'Flexiones con manos juntas formando diamante. Enfoque en tríceps.', 'video_url' => 'https://www.youtube.com/embed/J0DnG1_S92I', 'dificultad' => 'Avanzado'],
                ['musculo_id' => 5, 'nombre' => 'Extensión con Banda Elástica', 'descripcion' => 'Banda anclada arriba. Tira hacia abajo extendiendo brazos.', 'video_url' => 'https://www.youtube.com/embed/v3uVtjVASzs?si=MGzb0xCgUNpYLzRW&amp', 'dificultad' => 'Principiante'],
                ['musculo_id' => 5, 'nombre' => 'Fondos en Paralelas', 'descripcion' => 'Barras paralelas, inclinación hacia adelante. Mayor énfasis en tríceps.', 'video_url' => 'https://www.youtube.com/embed/2z8JmcrW-As', 'dificultad' => 'Avanzado'],
                ['musculo_id' => 5, 'nombre' => 'JM Press', 'descripcion' => 'Híbrido entre press cerrado y extensión. Baja barra hacia garganta.', 'video_url' => 'https://www.youtube.com/embed/Tih5iHyELsE?si=0uYzPp0xBBkuia3q&amp', 'dificultad' => 'Avanzado'],
                ['musculo_id' => 5, 'nombre' => 'Extensión Unilateral con Polea', 'descripcion' => 'Un brazo, polea alta. Extiende brazo hacia abajo lateralmente.', 'video_url' => 'https://www.youtube.com/embed/2YcY-5-KFHA?si=93WF-IftQviEvWOe&amp', 'dificultad' => 'Intermedio'],

                // ===== PIERNAS =====
                ['musculo_id' => 6, 'nombre' => 'Sentadillas', 'descripcion' => 'De pie, pies a la anchura de los hombros. Baja el trasero como si te sentaras. Sube con fuerza.', 'video_url' => 'https://www.youtube.com/embed/ultWZbUMPL8', 'dificultad' => 'Intermedio'],
                ['musculo_id' => 6, 'nombre' => 'Prensa de Piernas', 'descripcion' => 'Máquina de prensa. Empuja con las piernas extendiendo. Baja controlado.', 'video_url' => 'https://www.youtube.com/embed/xvCynwyNoP4', 'dificultad' => 'Principiante'],
                ['musculo_id' => 6, 'nombre' => 'Peso Muerto Rumano', 'descripcion' => 'Con barra, flexiona cadera manteniendo piernas semiflexionadas. Baja la barra y vuelve a subir.', 'video_url' => 'https://www.youtube.com/embed/jEy_czb3RKA', 'dificultad' => 'Intermedio'],
                ['musculo_id' => 6, 'nombre' => 'Zancadas', 'descripcion' => 'De pie, da un paso largo hacia adelante. Flexiona ambas rodillas. Vuelve a la posición inicial.', 'video_url' => 'https://www.youtube.com/embed/QOVaHwm-Q6U', 'dificultad' => 'Intermedio'],
                ['musculo_id' => 6, 'nombre' => 'Extensiones de Cuádriceps', 'descripcion' => 'Sentado en máquina. Extiende piernas levantando el peso.', 'video_url' => 'https://www.youtube.com/embed/YyvSfVjQeL0', 'dificultad' => 'Principiante'],
                ['musculo_id' => 6, 'nombre' => 'Curl Femoral', 'descripcion' => 'Tumbado boca abajo en máquina. Flexiona piernas llevando talones hacia glúteos.', 'video_url' => 'https://www.youtube.com/embed/ELOCsoDSmrg', 'dificultad' => 'Principiante'],
                ['musculo_id' => 6, 'nombre' => 'Sentadilla Búlgara', 'descripcion' => 'Una pierna elevada atrás en banco. Baja con la pierna delantera.', 'video_url' => 'https://www.youtube.com/embed/2C-uNgKwPLE', 'dificultad' => 'Avanzado'],
                ['musculo_id' => 6, 'nombre' => 'Elevación de Gemelos', 'descripcion' => 'De pie en máquina. Eleva talones contrayendo gemelos.', 'video_url' => 'https://www.youtube.com/embed/1BL4681pIz4?si=fbHSFhz4KVk8EI7g', 'dificultad' => 'Principiante'],
                ['musculo_id' => 6, 'nombre' => 'Sentadilla Frontal', 'descripcion' => 'Barra en hombros delanteros. Baja manteniendo torso vertical.', 'video_url' => 'https://www.youtube.com/embed/uYumuL_G_V0', 'dificultad' => 'Avanzado'],
                ['musculo_id' => 6, 'nombre' => 'Hip Thrust', 'descripcion' => 'Hombros en banco, barra en cadera. Empuja cadera hacia arriba.', 'video_url' => 'https://www.youtube.com/embed/xDmFkJxPzeM', 'dificultad' => 'Intermedio'],
                ['musculo_id' => 6, 'nombre' => 'Zancadas Caminando', 'descripcion' => 'Zancadas avanzando hacia adelante. Mayor activación glútea.', 'video_url' => 'https://www.youtube.com/embed/L8fvypPrzzs', 'dificultad' => 'Intermedio'],
                ['musculo_id' => 6, 'nombre' => 'Sentadilla Sumo', 'descripcion' => 'Pies muy separados, puntas hacia afuera. Mayor énfasis en aductores.', 'video_url' => 'https://www.youtube.com/embed/gTQDBTb4u10?si=Nglg0iege1dkcA2U;start=6', 'dificultad' => 'Intermedio'],

                // ===== HOMBROS =====
                ['musculo_id' => 7, 'nombre' => 'Press Militar', 'descripcion' => 'De pie, barra a la altura de los hombros. Empuja hacia arriba. Baja con control.', 'video_url' => 'https://www.youtube.com/embed/wol7Hko8RhY', 'dificultad' => 'Intermedio'],
                ['musculo_id' => 7, 'nombre' => 'Elevaciones Laterales', 'descripcion' => 'De pie con mancuernas. Eleva los brazos hasta la altura de los hombros. Baja lentamente.', 'video_url' => 'https://www.youtube.com/embed/kDqklk1ZESo', 'dificultad' => 'Principiante'],
                ['musculo_id' => 7, 'nombre' => 'Press Arnold', 'descripcion' => 'Sentado con mancuernas. Rota las palmas mientras empujas hacia arriba. Baja controlado.', 'video_url' => 'https://www.youtube.com/embed/6Z15_WdXmVw', 'dificultad' => 'Avanzado'],
                ['musculo_id' => 7, 'nombre' => 'Face Pull', 'descripcion' => 'Máquina de poleas alta. Tira hacia la cara separando las manos. Contrae deltoides posterior.', 'video_url' => 'https://www.youtube.com/embed/rep-qVOkqgk', 'dificultad' => 'Principiante'],
                ['musculo_id' => 7, 'nombre' => 'Elevaciones Frontales', 'descripcion' => 'Con mancuerna o barra. Eleva brazos al frente hasta altura de hombros.', 'video_url' => 'https://www.youtube.com/embed/q5sNYB1Q6aM', 'dificultad' => 'Principiante'],
                ['musculo_id' => 7, 'nombre' => 'Pájaros con Mancuernas', 'descripcion' => 'Inclinado hacia adelante. Abre brazos lateralmente trabajando deltoides posterior.', 'video_url' => 'https://www.youtube.com/embed/ttvfGg9d76c', 'dificultad' => 'Intermedio'],
                ['musculo_id' => 7, 'nombre' => 'Press con Mancuernas', 'descripcion' => 'Sentado, empuja mancuernas hacia arriba simultáneamente.', 'video_url' => 'https://www.youtube.com/embed/qEwKCR5JCog', 'dificultad' => 'Intermedio'],
                ['musculo_id' => 7, 'nombre' => 'Remo al Mentón', 'descripcion' => 'Con barra o mancuernas. Tira hacia arriba hasta el mentón.', 'video_url' => 'https://www.youtube.com/embed/WEV2yyzhEmI?si=5BGgRUUepxFO37Du&amp;start=51', 'dificultad' => 'Intermedio'],
                ['musculo_id' => 7, 'nombre' => 'Elevaciones Laterales en Polea', 'descripcion' => 'Cable bajo lateral. Eleva brazo lateralmente hasta altura de hombro.', 'video_url' => 'https://www.youtube.com/embed/PPrzBWZDOhA', 'dificultad' => 'Intermedio'],
                ['musculo_id' => 7, 'nombre' => 'Press Trasnuca', 'descripcion' => 'Barra detrás de la cabeza. Empuja hacia arriba. Mayor énfasis deltoides posterior.', 'video_url' => 'https://www.youtube.com/embed/K_krNSr5FzE?si=CME60M6B6_XoZNax&amp', 'dificultad' => 'Avanzado'],
                ['musculo_id' => 7, 'nombre' => 'Elevaciones en Y', 'descripcion' => 'Inclinado, brazos formando Y. Eleva mancuernas hacia arriba y afuera.', 'video_url' => 'https://www.youtube.com/embed/KSsY6zGJuzA?si=AvpWLI1uCcJ_SE1l&amp', 'dificultad' => 'Avanzado'],
                ['musculo_id' => 7, 'nombre' => 'Encogimientos de Hombros', 'descripcion' => 'Con mancuernas o barra. Eleva hombros hacia las orejas trabajando trapecios.', 'video_url' => 'https://www.youtube.com/embed/cJRVVxmytaM', 'dificultad' => 'Principiante'],
            ]);
        }
    }
}
