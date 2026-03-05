<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ejercicio extends Model
{
    use HasFactory;

    protected $table = 'ejercicios';
    protected $fillable = ['musculo_id', 'nombre', 'descripcion', 'video_url', 'dificultad'];

    public function musculo()
    {
        return $this->belongsTo(Musculo::class, 'musculo_id');
    }

    public function rutinas()
    {
        return $this->belongsToMany(Rutina::class, 'rutina_ejercicios', 'ejercicio_id', 'rutina_id')
                    ->withPivot('series', 'repeticiones');
    }
}
