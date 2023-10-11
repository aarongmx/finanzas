<?php

namespace Domain\Productos\Data;

use Spatie\LaravelData\Attributes\MapName;
use Spatie\LaravelData\Data;
use Spatie\LaravelData\Mappers\SnakeCaseMapper;

#[MapName(SnakeCaseMapper::class)]
class ProductoData extends Data
{
    public function __construct(
        public readonly string $nombre,
        public readonly ?int   $categoriaId,
        public readonly ?int   $id,
    )
    {

    }
}
