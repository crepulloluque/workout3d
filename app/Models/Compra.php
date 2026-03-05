<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Compra extends Model
{
    use HasFactory;

    protected $table = 'compras';
    protected $fillable = ['usuario_id', 'nombre', 'apellidos', 'telefono', 'direccion_envio', 'pais', 'provincia', 'codigo_postal', 'tipo_entrega', 'metodo_pago', 'total', 'fecha_compra'];
    public $timestamps = false;

    public function usuario()
    {
        return $this->belongsTo(Usuario::class, 'usuario_id');
    }

    public function detalles()
    {
        return $this->hasMany(CompraDetalle::class, 'compra_id');
    }
}
