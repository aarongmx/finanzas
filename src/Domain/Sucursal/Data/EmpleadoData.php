<?php

namespace Domain\Sucursal\Data;

use Spatie\LaravelData\Attributes\MapName;
use Spatie\LaravelData\Data;
use Spatie\LaravelData\Mappers\SnakeCaseMapper;

#[MapName(SnakeCaseMapper::class)]
class EmpleadoData extends Data
{
    public function __construct(
        public readonly ?int $id,
        public readonly string $nombre,
        public readonly string $apellidoPaterno,
        public readonly ?string $apellidoMaterno,
        public readonly int $sucursalId,
        public readonly int $userId,
    ) {}
}
