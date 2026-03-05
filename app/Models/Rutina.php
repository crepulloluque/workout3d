<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rutina extends Model
{
    use HasFactory;

    protected $table = 'rutinas';
    protected $fillable = ['usuario_id', 'nombre', 'descripcion', 'fecha_creacion'];

    public function usuario()
    {
        return $this->belongsTo(Usuario::class, 'usuario_id');
    }

    public function ejercicios()
    {
        return $this->belongsToMany(Ejercicio::class, 'rutina_ejercicios', 'rutina_id', 'ejercicio_id')
                    ->withPivot('series', 'repeticiones');
    }
}
