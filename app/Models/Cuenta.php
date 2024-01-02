<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Cuenta extends Model
{
    use HasFactory;

    protected $table = 'cuentas';

    protected $fillable = [
        'efectivo_pollo',
        'efectivo_marinado',
        'efectivo_total',
        'saldo',
        'fecha_captura',
        'fecha_venta',
        'sucursal_id',
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

    public function gastosFijos(): HasMany
    {
        return $this->hasMany(GastoFijo::class);
    }
}
