<?php

namespace Domain\Productos\Data;

use Spatie\LaravelData\Data;

class CategoriaData extends Data
{

    public function __construct(
        public readonly string $nombre,
        public readonly ?int $id,
    )
    {
    }
}
