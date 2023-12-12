<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Entrada extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'precio',
        'precio_envio',
        'cantidad',
        'sucursal_id',
        'sucursal_envio_id',
        'producto_id',
        'salida_id',
        'fecha',
    ];

    public function sucursal(): BelongsTo
    {
        return $this->belongsTo(Sucursal::class);
    }

    public function sucursalEnvio(): BelongsTo
    {
        return $this->belongsTo(Sucursal::class, 'sucursal_envio_id');
    }

    public function producto(): BelongsTo
    {
        return $this->belongsTo(Producto::class);
    }

    public function salida(): BelongsTo
    {
        return $this->belongsTo(Salida::class);
    }
}
