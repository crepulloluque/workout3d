<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Usuario extends Model
{
    use HasFactory;

    protected $table = 'usuarios';
    protected $fillable = ['usuario', 'email', 'password', 'edad', 'peso', 'altura'];
    protected $hidden = ['password'];

    public function rutinas()
    {
        return $this->hasMany(Rutina::class, 'usuario_id');
    }

    public function progresos()
    {
        return $this->hasMany(Progreso::class, 'usuario_id');
    }

    public function compras()
    {
        return $this->hasMany(Compra::class, 'usuario_id');
    }
}
