<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Producto extends Model
{
    use HasFactory;

    protected $table = 'productos';

    protected $fillable = [
        'nombre', 'categoria_id',
    ];

    public function nombre(): Attribute
    {
        return Attribute::make(
            set: fn($value) => strtoupper(trim($value))
        );
    }

    public function itemsCuenta(): HasMany
    {
        return $this->hasMany(ItemCuenta::class);
    }

    public function itemCuenta(): HasOne
    {
        return $this->hasOne(ItemCuenta::class)->latestOfMany();
    }

    public function categoria(): BelongsTo
    {
        return $this->belongsTo(Categoria::class);
    }

    public function salidas(): HasMany
    {
        return $this->hasMany(Salida::class);
    }
}
