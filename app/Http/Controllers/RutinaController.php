<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Str;

class RutinaController extends Controller
{
    /**
     * Muestra la página de crear rutina.
     */
    public function crear(Request $request)
    {
        if (!Session::has('usuario_id')) {
            return redirect()->route('index')->with(['toast_msg' => '🔒 Debes iniciar sesión', 'toast_type' => 'error']);
        }

        $nombre = $request->input('nombre', 'Nueva rutina');
        $descripcion = $request->input('descripcion', '');

        // ✅ Validar nombre duplicado ANTES de mostrar la página
        $existe = DB::table('rutinas')
            ->where('usuario_id', Session::get('usuario_id'))
            ->where('nombre', $nombre)
            ->exists();

        if ($existe) {
            return redirect()->route('index')
                ->with([
                    'toast_msg' => '⚠️ Ya tienes una rutina con el nombre "' . $nombre . '". Por favor, elige otro nombre.',
                    'toast_type' => 'error'
                ]);
        }

        // Obtener ejercicios agrupados por músculo
        $musculos = DB::table('musculos')
            ->select('id', 'nombre')
            ->get()
            ->map(function($m) {
                $m->ejercicios = DB::table('ejercicios')
                    ->where('musculo_id', $m->id)
                    ->select('id', 'nombre')
                    ->get();
                return $m;
            });

        return view('crear_rutina', compact('nombre', 'descripcion', 'musculos'));
    }

    /**
     * Guarda la nueva rutina.
     */
    public function guardar(Request $request)
    {
        if (!Session::has('usuario_id')) {
            return redirect()->route('auth');
        }

        $usuario_id = Session::get('usuario_id');
        $nombre = $request->input('nombre');
        $descripcion = $request->input('descripcion', '');
        $descanso = $request->input('descanso', []);
        $ejercicios = $request->input('ejercicios', []);
        $series = $request->input('series', []);
        $repeticiones = $request->input('repeticiones', []);

        // ✅ Doble validación antes de guardar
        $existe = DB::table('rutinas')
            ->where('usuario_id', $usuario_id)
            ->where('nombre', $nombre)
            ->exists();

        if ($existe) {
            return redirect()->route('index')
                ->with([
                    'toast_msg' => '⚠️ Ya tienes una rutina con el nombre "' . $nombre . '"',
                    'toast_type' => 'error'
                ]);
        }

        // Crear rutina
        $rutina_id = DB::table('rutinas')->insertGetId([
            'usuario_id' => $usuario_id,
            'nombre' => $nombre,
            'descripcion' => $descripcion,
            'fecha_creacion' => now(),
        ]);

        // Guardar ejercicios por día en rutinas_finalizadas
        $orden = 1;
        foreach ($ejercicios as $dia => $ejercicios_dia) {
            if (in_array($dia, $descanso)) continue; // Saltar días de descanso
            
            foreach ($ejercicios_dia as $ejercicio_id) {
                $num_series = $series[$dia][$ejercicio_id] ?? 3;
                $reps = $repeticiones[$dia][$ejercicio_id] ?? 10;
                
                // Crear un registro por cada serie
                for ($i = 1; $i <= $num_series; $i++) {
                    DB::table('rutinas_finalizadas')->insert([
                        'rutina_id' => $rutina_id,
                        'dia_semana' => $dia,
                        'ejercicio_id' => $ejercicio_id,
                        'numero_serie' => $i,
                        'repeticiones' => $reps,
                        'peso_kg' => null,
                        'orden' => $orden,
                        'fecha_finalizacion' => null,
                        'created_at' => now(),
                        'updated_at' => now()
                    ]);
                }
                $orden++;
            }
        }

        return redirect()->route('index')->with(['toast_msg' => '✅ Rutina "' . $nombre . '" creada correctamente', 'toast_type' => 'success']);
    }

    /**
     * Muestra la página de editar rutina.
     */
    public function editar(Request $request)
    {
        if (!Session::has('usuario_id')) {
            return redirect()->route('auth');
        }

        $rutina_id = $request->input('rutina_id');
        $usuario_id = Session::get('usuario_id');

        $rutina = DB::table('rutinas')
            ->where('id', $rutina_id)
            ->where('usuario_id', $usuario_id)
            ->first();

        if (!$rutina) {
            return redirect()->route('index');
        }

        // Obtener musculos y ejercicios (igual que en crear)
        $musculos = DB::table('musculos')
            ->select('id', 'nombre')
            ->get()
            ->map(function($m) {
                $m->ejercicios = DB::table('ejercicios')
                    ->where('musculo_id', $m->id)
                    ->select('id', 'nombre')
                    ->get();
                return $m;
            });

        // Inicializar arrays con todos los días
        $dias = ['Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado', 'Domingo'];
        $ejerciciosPorDia = array_fill_keys($dias, []);
        $ejerciciosIds = array_fill_keys($dias, []);
        
        try {
            $ejercicios = DB::table('rutinas_finalizadas')
                ->join('ejercicios', 'rutinas_finalizadas.ejercicio_id', '=', 'ejercicios.id')
                ->where('rutinas_finalizadas.rutina_id', $rutina_id)
                ->select(
                    'rutinas_finalizadas.ejercicio_id',
                    'ejercicios.nombre',
                    'rutinas_finalizadas.dia_semana',
                    'rutinas_finalizadas.repeticiones',
                    'rutinas_finalizadas.peso_kg'
                )
                ->distinct()
                ->orderBy('rutinas_finalizadas.orden')
                ->get();

            // Agrupar por día y contar series
            $seriesPorEjercicio = DB::table('rutinas_finalizadas')
                ->where('rutina_id', $rutina_id)
                ->select('dia_semana', 'ejercicio_id', DB::raw('MAX(numero_serie) as total_series'))
                ->groupBy('dia_semana', 'ejercicio_id')
                ->get();
            
            $seriesMap = [];
            foreach ($seriesPorEjercicio as $s) {
                $seriesMap[$s->dia_semana][$s->ejercicio_id] = $s->total_series;
            }

            // Agrupar por día
            foreach ($ejercicios as $e) {
                $dia = $e->dia_semana ?? 'Lunes';
                $numSeries = $seriesMap[$dia][$e->ejercicio_id] ?? 3;
                
                $ejerciciosPorDia[$dia][] = [
                    'id' => $e->ejercicio_id,
                    'nombre' => $e->nombre,
                    'series' => $numSeries,
                    'repeticiones' => $e->repeticiones ?? 10,
                    'peso' => $e->peso_kg ?? 0
                ];
                // Agregar ID a array plano para chequeo simple
                if (!in_array($e->ejercicio_id, $ejerciciosIds[$dia] ?? [])) {
                    $ejerciciosIds[$dia][] = $e->ejercicio_id;
                }
            }
        } catch (\Exception $e) {
            \Log::error('Error al obtener ejercicios: ' . $e->getMessage());
        }

        return view('editar_rutina', compact('rutina', 'ejerciciosPorDia', 'ejerciciosIds', 'musculos'));
    }

    /**
     * Guarda los cambios de la rutina editada.
     */
    public function guardarEditar(Request $request)
    {
        if (!Session::has('usuario_id')) {
            return redirect()->route('auth');
        }

        $usuario_id = Session::get('usuario_id');
        $rutina_id = (int)$request->input('rutina_id');

        // Verificar que el usuario es dueño de la rutina
        $rutina = DB::table('rutinas')
            ->where('id', $rutina_id)
            ->where('usuario_id', $usuario_id)
            ->first();

        if (!$rutina) {
            return redirect()->route('index');
        }

        $descanso = $request->input('descanso', []);
        $ejercicios = $request->input('ejercicios', []);
        $series = $request->input('series', []);
        $repeticiones = $request->input('repeticiones', []);

        // Borrar ejercicios anteriores de esta rutina
        DB::table('rutinas_finalizadas')->where('rutina_id', $rutina_id)->delete();

        // Guardar nuevos ejercicios por día en rutinas_finalizadas
        $orden = 1;
        foreach ($ejercicios as $dia => $ejercicios_dia) {
            if (in_array($dia, $descanso)) continue; // Saltar días de descanso
            
            foreach ($ejercicios_dia as $ejercicio_id) {
                $num_series = $series[$dia][$ejercicio_id] ?? 3;
                $reps = $repeticiones[$dia][$ejercicio_id] ?? 10;
                
                // Crear un registro por cada serie
                for ($i = 1; $i <= $num_series; $i++) {
                    DB::table('rutinas_finalizadas')->insert([
                        'rutina_id' => $rutina_id,
                        'dia_semana' => $dia,
                        'ejercicio_id' => $ejercicio_id,
                        'numero_serie' => $i,
                        'repeticiones' => $reps,
                        'peso_kg' => null,
                        'orden' => $orden,
                        'fecha_finalizacion' => null,
                        'created_at' => now(),
                        'updated_at' => now()
                    ]);
                }
                $orden++;
            }
        }

        return redirect()->route('index')
            ->with('toast_msg', '✏️ Rutina "' . $rutina->nombre . '" actualizada correctamente.')
            ->with('toast_type', 'success');
    }

    /**
     * Elimina una rutina del usuario.
     */
    public function eliminar($id)
    {
        if (!Session::has('usuario_id')) {
            return redirect()->route('auth');
        }

        DB::table('rutinas')
            ->where('id', $id)
            ->where('usuario_id', Session::get('usuario_id'))
            ->delete();

        return redirect()->route('index')
            ->with('toast_msg', '🗑️ Rutina eliminada correctamente.')
            ->with('toast_type', 'success');
    }

    /**
     * Inicia una rutina existente.
     */
    public function iniciar($id)
    {
        if (!Session::has('usuario_id')) {
            return redirect()->route('auth');
        }

        $usuario_id = Session::get('usuario_id');

        $rutina = DB::table('rutinas')
            ->where('id', $id)
            ->where('usuario_id', $usuario_id)
            ->first();

        if (!$rutina) {
            return redirect()->route('index')->with('error', 'Rutina no encontrada');
        }

        $ejercicios_rutina = DB::table('rutinas_finalizadas as rf')
            ->join('ejercicios as e', 'rf.ejercicio_id', '=', 'e.id')
            ->where('rf.rutina_id', $id)
            ->select(
                'rf.dia_semana',
                'rf.ejercicio_id',
                'rf.orden',
                'e.nombre',
                'e.descripcion',
                'e.video_url',
                'e.dificultad',
                DB::raw('MAX(rf.numero_serie) as total_series')
            )
            ->groupBy('rf.dia_semana', 'rf.ejercicio_id', 'rf.orden', 'e.nombre', 'e.descripcion', 'e.video_url', 'e.dificultad')
            ->orderBy('rf.dia_semana')
            ->orderBy('rf.orden')
            ->get();

        $ejercicios_por_dia = [];
        foreach ($ejercicios_rutina as $ej) {
            // Obtener series de la ÚLTIMA finalización (fecha más reciente con peso != null)
            $ultima_fecha = DB::table('rutinas_finalizadas')
                ->where('rutina_id', $id)
                ->where('ejercicio_id', $ej->ejercicio_id)
                ->where('dia_semana', $ej->dia_semana)
                ->whereNotNull('peso_kg')
                ->max('fecha_finalizacion');

            if ($ultima_fecha) {
                // Cargar series de esa fecha específica
                $series_detalle = DB::table('rutinas_finalizadas')
                    ->where('rutina_id', $id)
                    ->where('ejercicio_id', $ej->ejercicio_id)
                    ->where('dia_semana', $ej->dia_semana)
                    ->where('fecha_finalizacion', $ultima_fecha)
                    ->orderBy('numero_serie')
                    ->get();
            } else {
                // Primera vez: cargar plantilla sin pesos
                $series_detalle = DB::table('rutinas_finalizadas')
                    ->where('rutina_id', $id)
                    ->where('ejercicio_id', $ej->ejercicio_id)
                    ->where('dia_semana', $ej->dia_semana)
                    ->orderBy('numero_serie')
                    ->get();
            }

            $ej->series_detalle = $series_detalle;

            if (!isset($ejercicios_por_dia[$ej->dia_semana])) {
                $ejercicios_por_dia[$ej->dia_semana] = [];
            }
            $ejercicios_por_dia[$ej->dia_semana][] = $ej;
        }

        return view('iniciar_rutina', compact('rutina', 'ejercicios_por_dia'));
    }

    /**
     * Exporta la rutina a PDF.
     */
    public function exportPdf($id)
    {
        if (!Session::has('usuario_id')) {
            return redirect()->route('auth');
        }

        $usuario_id = Session::get('usuario_id');

        $rutina = DB::table('rutinas')
            ->where('id', $id)
            ->where('usuario_id', $usuario_id)
            ->first();

        if (!$rutina) {
            return redirect()->route('index')->with('error', 'Rutina no encontrada');
        }

        $ejercicios = DB::table('rutinas_finalizadas as rf')
            ->join('ejercicios as e', 'rf.ejercicio_id', '=', 'e.id')
            ->where('rf.rutina_id', $id)
            ->select(
                'rf.dia_semana',
                'e.nombre as ejercicio',
                DB::raw('MAX(rf.numero_serie) as total_series'),
                DB::raw('MAX(rf.repeticiones) as repeticiones')
            )
            ->groupBy('rf.dia_semana', 'e.nombre')
            ->orderBy('rf.dia_semana')
            ->orderBy('e.nombre')
            ->get();

        $ejercicios_por_dia = [];
        foreach ($ejercicios as $row) {
            if (!isset($ejercicios_por_dia[$row->dia_semana])) {
                $ejercicios_por_dia[$row->dia_semana] = [];
            }
            $ejercicios_por_dia[$row->dia_semana][] = $row;
        }

        $safeName = Str::slug($rutina->nombre) ?: 'rutina';
        $fileName = 'rutina-' . $safeName . '.pdf';

        $pdf = Pdf::loadView('pdf.rutina', [
            'rutina' => $rutina,
            'ejercicios_por_dia' => $ejercicios_por_dia
        ])->setPaper('a4', 'portrait');

        return $pdf->download($fileName);
    }

    /**
     * Finaliza el entrenamiento de una rutina.
     */
    public function finalizar(Request $request)
    {
        if (!Session::has('usuario_id')) {
            return redirect()->route('auth');
        }

        $datos_ejercicios = json_decode($request->input('datos_ejercicios'), true);
        $duracion = $request->input('duracion_minutos', 0);
        $dia_semana = $request->input('dia_semana');
        $fecha_hoy = now()->toDateString();

        // Actualizar pesos y reps en rutinas_finalizadas
        if (!empty($datos_ejercicios)) {
            foreach ($datos_ejercicios as $ej_id => $series) {
                foreach ($series as $num_serie => $data) {
                    DB::table('rutinas_finalizadas')
                        ->where('rutina_id', $request->input('rutina_id'))
                        ->where('ejercicio_id', $ej_id)
                        ->where('numero_serie', $num_serie)
                        ->where('dia_semana', $dia_semana)
                        ->update([
                            'peso_kg' => $data['peso'],
                            'repeticiones' => $data['reps'],
                            'fecha_finalizacion' => $fecha_hoy,
                            'updated_at' => now()
                        ]);
                }
            }
        }

        return redirect()->route('index')
            ->with('toast_msg', '🎉 ¡Entrenamiento completado! Buen trabajo.')
            ->with('toast_type', 'success');
    }

    /**
     * Guarda el orden de los ejercicios en una rutina.
     */
    public function guardarOrden(Request $request)
    {
        if (!Session::has('usuario_id')) {
            return response()->json(['error' => 'No autorizado'], 401);
        }

        $usuario_id = Session::get('usuario_id');
        $rutina_id = $request->input('rutina_id');
        $dia_semana = $request->input('dia_semana');
        $orden = $request->input('orden');

        $rutina = DB::table('rutinas')
            ->where('id', $rutina_id)
            ->where('usuario_id', $usuario_id)
            ->first();

        if (!$rutina) {
            return response()->json(['error' => 'Rutina no encontrada'], 404);
        }

        foreach ($orden as $item) {
            DB::table('rutinas_finalizadas')
                ->where('rutina_id', $rutina_id)
                ->where('dia_semana', $dia_semana)
                ->where('ejercicio_id', $item['ejercicio_id'])
                ->update(['orden' => $item['orden']]);
        }

        return response()->json(['success' => true]);
    }
}