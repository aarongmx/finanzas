<?php

namespace Domain\Clientes\Data;

use Spatie\LaravelData\Attributes\MapName;
use Spatie\LaravelData\Data;
use Spatie\LaravelData\Mappers\SnakeCaseMapper;

#[MapName(SnakeCaseMapper::class)]
class ClienteData extends Data
{
    public function __construct(
        public readonly ?int $id,
        public readonly string $rfc,
        public readonly string $razonSocial,
        public readonly ?string $nombreComercial,
        public readonly int $direccionId,
        public readonly int $sucursalId
    )
    {

    }
}
