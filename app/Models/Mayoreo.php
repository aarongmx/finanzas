<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mayoreo extends Model
{
    use HasFactory;

    public $fillable = [
        'fecha_venta',
        'precio',
        'cantidad',
        'total',
        'producto_id',
        'sucursal_id',
    ];

    public function producto()
    {
        return $this->belongsTo(Producto::class);
    }

    public function sucursal()
    {
        return $this->belongsTo(Sucursal::class);
    }
}
