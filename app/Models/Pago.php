<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class Pago extends Model
{
    use HasFactory;

    protected $fillable = [
        'monto', 'fecha_pago', 'pagable_id', 'pagable_type',
    ];

    public function pagable(): MorphTo
    {
        return $this->morphTo();
    }
}
