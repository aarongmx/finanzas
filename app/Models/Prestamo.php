<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphMany;

class Prestamo extends Model
{
    use HasFactory;

    protected $fillable = [
        'monto', 'saldo', 'fecha_prestamo', 'fecha_vencimiento', 'cuenta_id', 'estatus_id', 'empleado_id',
    ];

    public function cuenta(): BelongsTo
    {
        return $this->belongsTo(Cuenta::class);
    }

    public function estatus(): BelongsTo
    {
        return $this->belongsTo(Estatus::class);
    }

    public function empleado(): BelongsTo
    {
        return $this->belongsTo(Empleado::class);
    }

    public function pagos(): MorphMany
    {
        return $this->morphMany(Pago::class, 'pagable');
    }
}
