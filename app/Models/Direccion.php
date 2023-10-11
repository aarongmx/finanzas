<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Direccion extends Model
{
    use HasFactory;

    protected $table = 'direcciones';

    protected $fillable = [
        'codigo_postal', 'colonia', 'estado', 'numero_interior', 'numero_exterior', 'calle',
    ];

    public function clientes(): HasMany
    {
        return $this->hasMany(Cliente::class);
    }

    public function sucursales(): HasMany
    {
        return $this->hasMany(Sucursal::class);
    }
}
