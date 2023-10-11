<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ItemCuenta extends Model
{
    use HasFactory;

    protected $table = 'item_cuentas';

    protected $fillable = [
        'precio', 'cantidad_existencia', 'importe_existencia', 'cantidad_entrada', 'importe_entrada', 'cantidad_salida', 'importe_salida', 'cantidad_sobrante', 'importe_sobrante', 'producto_id', 'cuenta_id',
    ];

    public function producto(): BelongsTo
    {
        return $this->belongsTo(Producto::class);
    }

    public function cuenta(): BelongsTo
    {
        return $this->belongsTo(Cuenta::class);
    }
}
