<?php

namespace Domain\Cuentas\Data;

use Spatie\LaravelData\Attributes\MapName;
use Spatie\LaravelData\Data;
use Spatie\LaravelData\Mappers\SnakeCaseMapper;

#[MapName(SnakeCaseMapper::class)]
class CuentaData extends Data
{
    public function __construct(
        public float $efectivo,
        public float $aCuenta,
        public int $sucursalId,
    ) {
    }
}
