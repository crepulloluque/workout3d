<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AbdomenController extends Controller
{
    /**
     * Muestra los ejercicios de abdomen.
     */
    public function index(Request $request)
    {
        $porPagina = 4;
        $pagina = max(1, (int)$request->get('pagina', 1));
        $offset = ($pagina - 1) * $porPagina;

        $ejercicios = DB::table('ejercicios')
            ->where('musculo_id', 3) // 3 = Abdomen
            ->orderBy('id')
            ->limit($porPagina)
            ->offset($offset)
            ->get();

        $total = DB::table('ejercicios')->where('musculo_id', 3)->count();
        $totalPaginas = (int)ceil($total / $porPagina);

        return view('abdomen', compact('ejercicios', 'pagina', 'totalPaginas'));
    }
}