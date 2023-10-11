<?php

namespace Domain\Cuentas\Data;

use Spatie\LaravelData\Attributes\DataCollectionOf;
use Spatie\LaravelData\Attributes\MapName;
use Spatie\LaravelData\Data;
use Spatie\LaravelData\DataCollection;
use Spatie\LaravelData\Mappers\SnakeCaseMapper;

#[MapName(SnakeCaseMapper::class)]
class CuentaData extends Data
{
    public function __construct(
        public readonly float $efectivo,
        public readonly float $aCuenta,
        public readonly int   $sucursalId,
        #[DataCollectionOf(ItemCuentaData::class)]
        public readonly DataCollection $items,
    )
    {
    }
}
