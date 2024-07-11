<?php

namespace Domain\Direcciones\Data;

use Spatie\LaravelData\Attributes\MapName;
use Spatie\LaravelData\Data;
use Spatie\LaravelData\Mappers\SnakeCaseMapper;

#[MapName(SnakeCaseMapper::class)]
class DireccionData extends Data
{
    public function __construct(
        public readonly ?int $id,
        public readonly string $codigoPostal,
        public readonly ?string $colonia,
        public readonly ?string $estado,
        public readonly ?string $numeroInterior,
        public readonly ?string $numeroExterior,
        public readonly ?string $calle,
    ) {}
}
