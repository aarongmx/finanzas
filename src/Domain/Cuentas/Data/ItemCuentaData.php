<?php

namespace Domain\Cuentas\Data;

use Spatie\LaravelData\Attributes\MapName;
use Spatie\LaravelData\Data;
use Spatie\LaravelData\Mappers\SnakeCaseMapper;

#[MapName(SnakeCaseMapper::class)]
class ItemCuentaData extends Data
{

    public function __construct(
        public readonly float $precio,
        public readonly float $cantidadExistencia,
        public readonly float $importeExistencia,
        public readonly float $cantidadEntrada,
        public readonly float $importeEntrada,
        public readonly float $cantidadSalida,
        public readonly float $importeSalida,
        public readonly float $cantidadSobrante,
        public readonly float $importeSobrante,
        public readonly int   $productoId,
        public readonly ?int  $cuentaId,
    )
    {
    }
}
