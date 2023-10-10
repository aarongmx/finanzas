<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Direccion extends Model
{
    use HasFactory;

    protected $table = 'direcciones';

    protected $fillable = [
        'codigo_postal', 'colonia', 'estado', 'numero_interior', 'numero_exterior', 'calle',
    ];
}
