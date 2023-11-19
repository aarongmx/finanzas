<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Salida extends Model
{
    use HasFactory;

    protected $fillable = [
        'monto', 'cantidad', 'total', 'sucursal_destino_id', 'producto_id', 'cuenta_id',
    ];

    public function sucursalDestino(): BelongsTo
    {
        return $this->belongsTo(Sucursal::class, 'sucursal_destino_id');
    }

    public function producto(): BelongsTo
    {
        return $this->belongsTo(Producto::class);
    }

    public function cuenta(): BelongsTo
    {
        return $this->belongsTo(Cuenta::class);
    }
}
