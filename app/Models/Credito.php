<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphMany;

class Credito extends Model
{
    use HasFactory;

    protected $fillable = [
        'monto', 'saldo', 'fecha_credito', 'fecha_vencimiento', 'cliente_id', 'cuenta_id', 'estatus_id',
    ];

    public function cliente(): BelongsTo
    {
        return $this->belongsTo(Cliente::class);
    }

    public function cuenta(): BelongsTo
    {
        return $this->belongsTo(Cuenta::class);
    }

    public function estatus(): BelongsTo
    {
        return $this->belongsTo(Estatus::class);
    }

    public function pagos(): MorphMany
    {
        return $this->morphMany(Pago::class, 'pagable');
    }
}
