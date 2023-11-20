<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class GastoFijo extends Model
{
    use HasFactory;

    protected $fillable = [
        'precio',
        'concepto',
    ];

    public function concepto(): Attribute
    {
        return Attribute::make(
            set: fn ($value) => strtoupper(trim($value)),
        );
    }

    public function cuentas(): BelongsToMany
    {
        return $this->belongsToMany(Cuenta::class)->withTimestamps();
    }
}
