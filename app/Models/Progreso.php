<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Progreso extends Model
{
    use HasFactory;

    protected $table = 'progreso';
    protected $fillable = ['usuario_id', 'fecha', 'peso', 'grasa', 'musculo', 'imc'];
    public $timestamps = true;

    public function usuario()
    {
        return $this->belongsTo(Usuario::class, 'usuario_id');
    }
}
