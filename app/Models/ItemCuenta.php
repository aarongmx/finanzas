<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ItemCuenta extends Model
{
    use HasFactory;

    protected $table = 'item_cuentas';

    protected $fillable = [
        'precio', 'cantidad_existencia', 'importe_existencia', 'cantidad_entrada', 'importe_entrada', 'cantidad_salida', 'importe_salida', 'cantidad_sobrante', 'importe_sobrante', 'producto_id', 'cuenta_id',
    ];
}
