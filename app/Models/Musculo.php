<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Musculo extends Model
{
    use HasFactory;

    protected $table = 'musculos';
    protected $fillable = ['nombre', 'modelo_3d_url', 'descripcion'];

    public function ejercicios()
    {
        return $this->hasMany(Ejercicio::class, 'musculo_id');
    }
}
