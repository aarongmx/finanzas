<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Cuenta extends Model
{
    use HasFactory;

    protected $table = 'cuentas';

    protected $fillable = [
        'efectivo', 'a_cuenta', 'fecha_captura', 'fecha_venta', 'sucursal_id',
    ];

    protected $attributes = [
        'efectivo' => 0.0,
        'a_cuenta' => 0.0
    ];

    public function sucursal(): BelongsTo
    {
        return $this->belongsTo(Sucursal::class);
    }

    public function itemsCuenta(): HasMany
    {
        return $this->hasMany(ItemCuenta::class);
    }

    public function salidas(): HasMany
    {
        return $this->hasMany(Salida::class);
    }
}
