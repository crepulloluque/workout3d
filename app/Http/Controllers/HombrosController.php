<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HombrosController extends Controller
{
    public function index(Request $request)
    {
        $porPagina = 4;
        $pagina = max(1, (int)$request->get('pagina', 1));
        $offset = ($pagina - 1) * $porPagina;

        $ejercicios = DB::table('ejercicios')
            ->where('musculo_id', 7)
            ->orderBy('id')
            ->limit($porPagina)
            ->offset($offset)
            ->get();

        $total = DB::table('ejercicios')->where('musculo_id', 7)->count();
        $totalPaginas = (int)ceil($total / $porPagina);

        return view('hombros', compact('ejercicios', 'pagina', 'totalPaginas'));
    }
}
