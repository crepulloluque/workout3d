<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
    use HasFactory;

    protected $table = 'productos';
    protected $fillable = ['nombre', 'descripcion', 'precio', 'imagen_url', 'categoria'];

    public function compraDetalles()
    {
        return $this->hasMany(CompraDetalle::class, 'producto_id');
    }
}
